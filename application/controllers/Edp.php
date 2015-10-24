<?php
/*
| -------------------------------------
| @file  : Edp.php
| @date  : 3/26/2015
| @author:
| -------------------------------------
*/

class Edp extends CI_Controller
{
    public $numberOfStudents;
    public $yearL = array(0 => 0,1 => 0,2 => 0,3 => 0);

    function add_room()
    {
        $this->api->userMenu();

        $this->load->library('form_validation');
        $this->load->helper('form');

        //rules
        $this->form_validation->set_rules('room', 'Classroom', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('mincapacity', 'Minimum Capacity', 'trim|required|integer');
        $this->form_validation->set_rules('maxcapacity', 'Maximun Capacity', 'trim|required|integer');

        if ($this->form_validation->run() === FALSE) {
            $data['error'] = '';
            $this->load->view('edp/edit_classroom', $data);
        } else {
            $min = $this->input->post('mincapacity');
            $max = $this->input->post('maxcapacity');

            if ($min > $max OR $min == $max) {
                $data['error'] = 'error';
                $this->load->view('edp/edit_classroom',$data);
            } else {
                $dat['legacycode']     = $this->input->post('room');
                $dat['mincapacity']    = $this->input->post('mincapacity');
                $dat['maxcapacity']    = $this->input->post('maxcapacity');
                $dat['location']       = $this->input->post('location');
                $dat['status']         = $this->input->post('status');

                $this->db->insert('tbl_classroom',$dat);
            }
        }
        $this->load->view('templates/footer', array('orig_page' => ''));
    }

    function load_stat()
    {
        $systemVal = $this->api->systemValue();

        //check if the phase term is FINALS
        if ($systemVal['phase'] == FIN) {
            $this->load->model(array(
                'edp/edp_classallocation',
                'registrar/academicterm'
            ));

            $this->load->view('edp/ajax_studentCount');
        } else {
            echo 'Not final';
        }
    }

    function studentc($isFirstYear = TRUE)
    {
        // check if the term is summer
        if ($term == 3) {
            // if term is summer . get the students enrolled in last 2nd sem.
            if($isFirstYear)
                $acam   = $current_academicterm - 2;
            else
                $acam   = $current_academicterm - 1;

            $e      = $this->edp_classallocation->getStudEnrol($cid, $acam);
        } else {
            // if not get the students in enrolled in current academicterm
            $e = $this->edp_classallocation->getStudEnrol($cid, $current_academicterm);
        }

        foreach ($e as $stud) {
            $yearlevel = $this->api->yearLevel($stud['student'], $course);

            // API return curriculum not found if the course does not have a curriculum
            if ($yearlevel != CUR_NOT_FOUND) {
                if ($isFirstYear) {
                    if ($yearlevel == 1)
                        $this->yearL[0] += 1;
                } else {
                    if($yearlevel > 1)
                        $this->yearL[$yearlevel - 1] += 1;
                }
            }
        }
    }

    function load_stat1()
    {
        $this->load->model(array(
            'edp/out_studentcount',
            'registrar/course',
            'registrar/curriculum',
            'registrar/academicterm',
            'registrar/curriculumdetail',
            'edp/edp_classallocation'
        ));
        $this->load->view('edp/ajax_stu');
    }

    // function for student statistics
    function studentcount()
    {
        // collect all the post variable
        $acam           = $this->input->post('acam');
        $coursemajor    = $this->input->post('coursemajor');
        $year_level     = $this->input->post('year_level');
        $count          = $this->input->post('count');

        $this->load->model('edp/out_studentcount');

        //truncate table before inserting
        $this->db->query("TRUNCATE out_studentcount");

        foreach ($coursemajor as $key => $value) {
            $data                   = array();
            $data['course']         = $value;
            $data['yearlevel']      = $year_level[$key];
            $data['studentcount']   = $count[$key];
            $data['academicterm']   = $acam;
            $this->out_studentcount->insert($data);
        }

        $this->out_section();

        // update the system value in tbl_systemvalues
        $this->db->update('tbl_systemvalues', array('classallocationstatus' => 1));

        $this->session->set_flashdata('message', '<div class="alert alert-success">
            Successfully Created
        </div>');
        redirect(base_url());
    }

    function out_section()
    {
        //truncate table before inserting
        $this->db->query("TRUNCATE out_section");

        $systemVal  = $this->api->systemValue();
        $sy         = $systemVal['phaseterm'];
        $this->numberOfStudents = $systemVal['numberofstudent'];

        $this->db->where('id', $sy);
        $tt     = $this->db->get('tbl_academicterm')->row_array();
        $term   = $tt['term'];

        $acamd  = $this->db->query("SELECT * FROM `tbl_academicterm` WHERE systart <= {$tt['systart']} ORDER BY systart DESC,term")->result_array();

        $stuC   = $this->db->query("SELECT * FROM out_studentcount GROUP BY course")->result_array();

        foreach ($stuC as $studentC) :
            
            $coursemajor    = $studentC['course'];
            $acam           = $studentC['academicterm'];
            $cur1           = 0;

            if ($coursemajor != 8 AND $coursemajor != 9 AND $coursemajor != 10 AND $coursemajor != 11) :

                if ($coursemajor == 2) {
                    $sql = "SELECT id FROM tbl_coursemajor WHERE course = $coursemajor AND major != 0";
                } else {
                    $sql = "SELECT id FROM tbl_coursemajor WHERE course = $coursemajor";
                }

                $c = $this->db->query($sql)->result_array();
                
                foreach ($c as $curs) :
                    $course         = 0;
                    $cur1           = 0;

                    foreach ($acamd as $acams) {
                    $this->db->where('coursemajor', $curs['id']);
                    $this->db->where('academicterm', $acams['id']);
                    $c1 = $this->db->get('tbl_curriculum');

                        if ($c1->num_rows() > 0) {
                            $course = $curs['id'];
                            $cc = $c1->row_array();
                            $cur1 = $cc['id'];
                            break;
                        }

                    }

                    if ($course != 0 AND $cur1 != 0 AND $cur1 != 55) {
                        //echo $course.' '.$cur1.' <br/>';

                        //get the curriculum within 4 years
                        $cur_range1 = $acam - 12;
                        $cur_range  = $this->db->query("SELECT tbl_curriculum.id as id FROM tbl_curriculum,tbl_coursemajor WHERE academicterm BETWEEN $cur_range1 AND $acam AND tbl_curriculum.coursemajor = tbl_coursemajor.id AND course = $coursemajor")->num_rows();

                        // if there are more than 1 curriculums
                        if ($cur_range > 1) :
                            $c = $this->db->get_where('out_studentcount', array('course' => $coursemajor))->result_array();

                            foreach ($c as $cc) :
                                $y      = $cc['yearlevel'];
                                $cou    = $cc['studentcount'];

                                $cur_range2  = $this->db->query("SELECT tbl_curriculum.id as id FROM tbl_curriculum,tbl_coursemajor WHERE academicterm between $cur_range1 and $acam and tbl_curriculum.coursemajor = tbl_coursemajor.id AND course = $coursemajor")->result_array();

                                foreach ($cur_range2 as $ra) :
                                    $e = $this->db->get_where('tbl_curriculumdetail', array('curriculum' => $ra['id'], 'yearlevel' => $y, 'term' => $term))->result_array();

                                    foreach ($e as $ee):
                                        $this->insert_section($sy, $coursemajor, $ee['subject'], $y, $cou, $course);
                                    endforeach;

                                endforeach;

                            endforeach;

                        elseif ($cur1 != 0) :
                            $c = $this->db->get_where('out_studentcount', array('course' => $coursemajor))->result_array();
                            
                            foreach ($c as $cc) :
                                $y      = $cc['yearlevel'];
                                $cou    = $cc['studentcount'];
                                $e      = $this->db->get_where('tbl_curriculumdetail', array('curriculum' => $cur1, 'yearlevel' => $y, 'term' => $term))->result_array();

                                foreach ($e as $ee) :
                                    $this->insert_section($sy, $coursemajor, $ee['subject'], $y, $cou, $course);
                                endforeach;

                            endforeach;

                        endif;

                    }

                endforeach;

            endif;
            
        endforeach;

    }

    // function for populate the out_section table
    private function insert_section($sy, $course, $subject, $yearlevel, $count, $cc)
    {

        //@TODO: max capacity for computersubjects is 15 average
        $d['academicterm']  = $sy;
        $d['coursemajor']   = $course;
        $d['subject']       = $subject;
        $d['yearlevel']     = $yearlevel;
        $d['studentcount']  = $count;

        // nstp subject must have 1 section only
        if ($subject == 298 OR $subject == 299) {
            $d['section'] = 1;
        } else {

            // if the count is less than the numberofstudent system value set it to 0
            if ($count == 0 OR $count < $this->numberOfStudents) {
                // if the student count is less than 10
                // default no. of section is 0
                if($count <= 10)
                    $d['section'] = 0;
                else
                    $d['section'] = 1;
            } else {
                // force the result to be an integer
                $d['section'] = (int) ($count / $this->numberOfStudents);
            }

        }

        $this->db->where('coursemajor', $course);
        $this->db->where('yearlevel', $yearlevel);
        $this->db->where('subject', $subject);
        $c = $this->db->count_all_results('out_section');

        if ($c < 1) {
            $this->db->where('coursemajor', $course);
            $this->db->where('subject', $subject);
            $coun = $this->db->count_all_results('out_section');

            if ($subject == 299 OR $subject == 298) {
                $where = "(subject = 299 OR subject = 298)";
                $this->db->where($where);
                $cc = $this->db->count_all_results('out_section');

                if ($cc < 1) {
                    $this->db->insert('out_section', $d);
                }

            } elseif ($coun > 0) {
                $section = $d['section'];
                $this->db->query("UPDATE out_section SET section = section + $section WHERE coursemajor = $course AND subject = $subject");
            } elseif($coun < 1) {
                $this->db->insert('out_section', $d);
            }

        } 
    }

    function view_sched($roomId = '')
    {
        if ( ! empty($roomId) AND is_numeric($roomId) ) {
            $this->load->model(array(
                'edp/classroom',
                'edp/edp_classallocation',
                'dean/subject'
            ));

            $data['roomId']     = $roomId;
            $room               = $this->classroom->find($roomId);
            $data['room_name']  = $room['legacycode'];
            $data['location']   = $room['location'];
            $this->api->userMenu();

            $this->load->view('edp/view_room_sched', $data);
            $this->load->view('templates/footer');
        } else {
            show_error('Did you type the url by yourself ?');
        }

    }

    function add_sched($sid = '')
    {
        if ( ! empty($sid) ) {
            $this->api->userMenu();
            $data['roomId'] = $sid;

            $this->load->model(array(
                'edp/edp_classallocation'
            ));
            $this->load->view('edp/select_subj', $data);
            $this->load->view('templates/footer');
        }
        else
            show_error('Did you type the url by yourself ?');
    }

    function assign_room($cid = '')
    {
        if ( !empty($cid) ) {
            $this->api->userMenu();
            $this->load->model(array(
                'edp/classroom',
                'edp/edp_classallocation',
                'dean/subject'
            ));
            $this->load->helper('form');
            $data['cid']    = $cid;
            $data['error']  = '';
            $data['num']    = $this->input->post('days_count') ? $this->input->post('days_count') - 1 : 0;
            $this->load->view('edp/assign_subj_room', $data);
            $this->load->view('templates/footer');
        }
        else
            show_error('Did you type the url by yourself ?');

    }

    function add_room_class()
    {
        // puydi ku ini ikadto ha http://lcis.dev.com/assign_room/45009
        // para ipa show la it available na room para iton na sched

        $this->load->model(array(
            'edp/edp_classallocation'
        ));

        $dayPeriodId    = $this->input->post('dayperiodId');
        $day            = $this->input->post('day');
        $from_time      = $this->input->post('from_time');
        $to_time        = $this->input->post('to_time');
        $room           = $this->input->post('room');
        $conflict       = FALSE;
        $cid            = $this->input->post('cid');

        foreach ($dayPeriodId as $key => $value) {
            $this->edp_classallocation->updateClassroom($room[$key], $value);
            /*$f = $this->db->get_where('tbl_period',array('id' => $from_time[$key]))->row_array();
            $ff = $f['time'];
            $t = $this->db->get_where('tbl_period',array('id' => $to_time[$key]))->row_array();
            $tt = $t['time'];

            $r = $this->db->get_where('tbl_dayperiod',array('classroom' => $room[$key]))->result_array();

            foreach($r as $rr)
            {
                if($rr['day'] == $day[$key])
                {
                    $r_f = $this->db->get_where('tbl_period',array('id' => $rr['from_time']))->row_array();
                    $r_f1 = $r_f['time'];
                    $r_t = $this->db->get_where('tbl_period',array('id' => $rr['to_time']))->row_array();
                    $r_t1 = $r_t['time'];

                    $rs = $this->api->intersectCheck($ff,$r_f1,$tt,$r_t1);
                    if($rs == TRUE)
                    {
                        $conflict = TRUE;
                    }
                }
            }*/
        }
        $d['status'] = 'O';
        $this->db->where('id', $cid);
        $this->db->update('tbl_classallocation', $d);
        redirect(base_url('menu/edp-room_subj'));
       /* $this->db->where('id',$cid);
        $this->db->update('tbl_classallocation',$data);*/
       /* $this->session->set_flashdata('message','<div class="alert alert-success">Successfully Assigned</div>');
        */
    }

    function sorting()
    {
        $this->load->model(array(
            'edp/edp_classallocation',
            'registrar/academicterm',
            'dean/subject'
        ));
        $cid = $this->input->post('cid');
        
        if ($cid == 1) {
            $this->load->view('edp/ajax_edp_all');
        } elseif ($cid == 2) {
            $this->load->view('edp/ajax_edp_assigned');
        } elseif ($cid == 3) {
            $this->load->view('edp/ajax_edp_notassigned');
        } else {
            // this is a error message
            $this->load->view('edp/ajax_edp_bydean');
        }
    }

    function preview($roomId)
    {
        $this->load->model(array(
            'edp/classroom',
            'edp/edp_classallocation',
            'dean/subject'
        ));
        $data['roomId']     = $roomId;
        $room               = $this->classroom->find($roomId);
        $data['room_name']  = $room['legacycode'];
        $data['location']   = $room['location'];

        $this->load->view('edp/preview',$data);
    }

    function cl_inc()
    {
        $stat['classallocationstatus'] = $this->input->post('name');
        $this->db->update('tbl_systemvalues', $stat);
        $this->api->set_session_message('success', 'Successfully Attested');
        redirect(base_url());
    }

    function cre_reg($student, $coursemajor)
    {
        $d['student']       = $student;
        $d['coursemajor']   = $coursemajor;
        //$d['curriculum'] = $curriculum;
        $this->db->insert('tbl_registration', $d);
        $id = $this->db->insert_id();

        $f['registration'] = $id;
        $this->db->where('student', $student);
        $this->db->where('coursemajor', $coursemajor);
        $this->db->update('tbl_enrolment', $f);
        return $id;
    }

}
