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

    private function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

    function ListUsers()
    {
        $this->head();
        $this->load->view('edp/list_users');
        $this->load->view('templates/footer');
    }

    function ClassroomList()
    {
        $this->head();
        $this->load->view('edp/list_classroom');
        $this->load->view('templates/footer');
    }

    function CalculateSubjectSection()
    {
        $this->head();
        $this->load->view('edp/calculate_subjectsection');
        $this->load->view('templates/footer');
    }

    function ClassAllocation()
    {
        $this->head();
        $this->load->view('edp/classRooms');
        $this->load->view('templates/footer');
    }

    function add_room()
    {
        $this->api->userMenu();

        $this->load->library('form_validation');
        $this->load->helper('form');

        //rules
        $this->form_validation->set_rules('room','Classroom','trim|required|max_length[10]');
        $this->form_validation->set_rules('mincapacity','Minimum Capacity','trim|required|integer');
        $this->form_validation->set_rules('maxcapacity','Maximun Capacity','trim|required|integer');

        if($this->form_validation->run() === FALSE)
        {
            $data['error'] = '';
            $this->load->view('edp/edit_classroom',$data);
        }
        else
        {
            $min = $this->input->post('mincapacity');
            $max = $this->input->post('maxcapacity');
            if($min > $max OR $min == $max)
            {
                $data['error'] = 'error';
                $this->load->view('edp/edit_classroom',$data);
            }
            else
            {
                $dat['legacycode']     = $this->input->post('room');
                $dat['mincapacity']    = $this->input->post('mincapacity');
                $dat['maxcapacity']    = $this->input->post('maxcapacity');
                $dat['location']       = $this->input->post('location');
                $dat['status']         = $this->input->post('status');

                $this->db->insert('tbl_classroom',$dat);
            }
        }
        $this->load->view('templates/footer',array('orig_page'=>''));
    }

    function load_stat()
    {
        $systemVal = $this->api->systemValue();

        //check if the phase term is FINALS
        if ($systemVal['phase'] == FIN)
        {
            $this->load->model(array(
                'edp/edp_classallocation',
                'registrar/academicterm'
            ));

            // $c = array();
            // $curs = $this->db->get('tbl_course')->result_array();
            // foreach($curs as $cu)
    		// {
            //     $c[] = ;
            //     $this->yearL = array(0 => 0,1 => 0,2 => 0,3 => 0);
    		// 	$course = $cu['id'];
            //
    		// 	$cid 	= $cu['id'];
    		// 	$year_l = $i;
    		//
            //
            //     $this->studentc(FALSE);
            //     $this->studentc();
            //
            // }
            $this->load->view('edp/ajax_studentCount');
        }
        else
        {
            echo 'Not final';
        }
    }

    function studentc($isFirstYear = TRUE)
    {
        // check if the term is summer
        if ($term == 3)
        {
            // if term is summer . get the students enrolled in last 2nd sem.
            if($isFirstYear)
                $acam 	= $current_academicterm - 2;
            else
                $acam 	= $current_academicterm - 1;

            $e 		= $this->edp_classallocation->getStudEnrol($cid, $acam);
        }
        // if not get the students in enrolled in current academicterm
        else
            $e = $this->edp_classallocation->getStudEnrol($cid, $current_academicterm);

        foreach ($e as $stud)
        {
            $yearlevel = $this->api->yearLevel($stud['student'], $course);

            // API return curriculum not found if the course does not have a curriculum
            if ($yearlevel != CUR_NOT_FOUND)
            {
                if($isFirstYear){
                    if ($yearlevel == 1)
						$this->yearL[0] += 1;
                }
                else{
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

        foreach($coursemajor as $key => $value)
        {
            $data = array();
            $data['course']    = $value;
            $data['yearlevel']      = $year_level[$key];
            $data['studentcount']   = $count[$key];
            $data['academicterm']   = $acam;
            $this->out_studentcount->insert($data);
        }

        //truncate table before inserting
        $this->db->query("TRUNCATE out_section");

        $systemVal  = $this->api->systemValue();
        $sy         = $systemVal['nextacademicterm'];
        $this->numberOfStudents = $systemVal['numberofstudent'];

        $tt     = $this->db->query("SELECT * FROM tbl_academicterm WHERE id = $sy")->row_array();
        $term   = $tt['term'];

        $acamd  = $this->db->query("SELECT * FROM `tbl_academicterm` where systart <= {$tt['systart']} order by systart ASC,term")->result_array();

        $stuC   = $this->db->query("SELECT * FROM out_studentcount GROUP BY course")->result_array();
        foreach($stuC as $studentC)
        {
            $coursemajor    = $studentC['course'];
            $acam           = $studentC['academicterm'];
            $cur1           = 0;

            foreach($acamd as $acams)
            {
                $c = $this->db->query("SELECT * FROM tbl_curriculum,tbl_coursemajor WHERE
                    tbl_coursemajor.id = tbl_curriculum.coursemajor AND
                    tbl_coursemajor.course = $coursemajor AND academicterm = {$acams['id']}");
                if($c->num_rows() > 0)
                {
                    $cur    = $c->row_array();
                    $cur1   = $cur['id'];
                    break;
                }
            }

            //get the curriculum within 4 years
            $cur_range1 = $acam - 12;
            $cur_range  = $this->db->query("SELECT * FROM tbl_curriculum,tbl_coursemajor WHERE academicterm between $cur_range1 and $acam and tbl_curriculum.coursemajor = tbl_coursemajor.id AND course = $coursemajor")->num_rows();

            // if there are more than 1 curriculums
            if($cur_range > 1)
            {
                $c = $this->db->query("SELECT * FROM out_studentcount WHERE course = $coursemajor")->result_array();
                foreach($c as $cc)
                {
                    $y      = $cc['yearlevel'];
                    $cou    = $cc['studentcount'];

                    $cur_range2  = $this->db->query("SELECT tbl_curriculum.id FROM tbl_curriculum,tbl_coursemajor WHERE academicterm between $cur_range1 and $acam and tbl_curriculum.coursemajor = tbl_coursemajor.id AND course = $coursemajor")->result_array();
                    foreach($cur_range2 as $ra)
                    {
                        $e      = $this->db->query("SELECT * FROM tbl_curriculumdetail WHERE curriculum = {$ra['tbl_curriculum.id']} AND yearlevel = $y AND term = $term")->result_array();
                        foreach($e as $ee):
                            $this->insert_section($sy, $coursemajor, $ee['subject'], $y, $cou);
                        endforeach;
                    }
                }
            }

            elseif($cur1 != 0)
            {
                $c = $this->db->query("SELECT * FROM out_studentcount WHERE course = $coursemajor")->result_array();
                foreach($c as $cc)
                {
                    $y      = $cc['yearlevel'];
                    $cou    = $cc['studentcount'];
                    $e      = $this->db->query("SELECT * FROM tbl_curriculumdetail WHERE curriculum = $cur1 AND yearlevel = $y AND term = $term")->result_array();
                    foreach($e as $ee) :
                        $this->insert_section($sy, $coursemajor, $ee['subject'], $y, $cou);
                    endforeach;
                }
            }
        }

        // update the system value in tbl_systemvalues
        $this->db->update('tbl_systemvalues',array('classallocationstatus' => 1));

        $this->session->set_flashdata('message','<div class="alert alert-success">
            Successfully Created
        </div>');
        redirect(base_url());
    }

    // function for populate the out_section table
    private function insert_section($sy, $course, $subject, $yearlevel, $count)
    {
        $d['academicterm']  = $sy;
        $d['coursemajor']   = $course;
        $d['subject']       = $subject;
        $d['yearlevel']     = $yearlevel;
        $d['studentcount']  = $count;

        // if the count is less than the numberofstudent system value set it to 0
        if($count == 0 OR $count < $this->numberOfStudents)
            $d['section'] = 0;
        // force the result to be an integer
        else
            $d['section'] = (int) ($count / $this->numberOfStudents);

        $this->db->insert('out_section',$d);
    }

    function view_sched($roomId = '')
    {
        if(!empty($roomId) AND is_numeric($roomId))
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
            $this->api->userMenu();

            $this->load->view('edp/view_room_sched',$data);
            $this->load->view('templates/footer');
        }
        else
            show_error('Did you type the url by yourself ?');
    }

    function add_sched($sid = '')
    {
        if (!empty($sid))
        {
            $this->api->userMenu();
            $data['roomId'] = $sid;

            $this->load->model(array(
                'edp/edp_classallocation'
            ));
            $this->load->view('edp/select_subj',$data);
            $this->load->view('templates/footer');
        }
        else
            show_error('Did you type the url by yourself ?');
    }

    function assign_room($cid = '')
    {
        if (!empty($cid))
        {
            $this->api->userMenu();
            $this->load->model(array(
                'edp/classroom',
                'edp/edp_classallocation',
                'dean/subject'
            ));
            $data['cid'] = $cid;
            $this->load->view('edp/assign_subj_room',$data);
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

        foreach($dayPeriodId as $key => $value)
        {
            $this->edp_classallocation->updateClassroom($room[$key],$value);
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
        redirect(base_url('menu/edp-room_subj'));
       /* $this->db->where('id',$cid);
        $this->db->update('tbl_classallocation',$data);*/
       /* $this->session->set_flashdata('message','<div class="alert alert-success">Successfully Assigned</div>');
        */
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

    // test function
    function tryap()
    {
        $stud = $this->db->query("SELECT * FROM out_exception where comment = 'no curriculum tbl_registration' GROUP by student")->result_array();
        foreach ($stud as $val) {

            $reg = $this->db->query("SELECT min(academicterm) as academicterm,registration,coursemajor,id,student FROM tbl_enrolment WHERE student = {$val['student']} GROUP BY coursemajor")->result_array();
            $reg_id = 0;
            foreach ($reg as $keys) {

                $reg_id = $keys['registration'];
                if($reg_id == 0)
                {
                    $reg_id = $this->cre_reg($keys['student'], $keys['coursemajor']);
                }
                $course = $keys['coursemajor'];

                $t = $this->db->query("SELECT * FROM tbl_academicterm ORDER BY systart ASC,term")->result_array();
                foreach ($t as $acam) {

                    $c = $this->db->query("SELECT * FROM tbl_curriculum
                        WHERE coursemajor = $course
                        AND academicterm = {$acam['id']}");

                    if($c->num_rows() > 0)
                    {
                        $cur    = $c->row_array();
                        $dat['curriculum'] = $cur['id'];
                        $this->db->where('id',$reg_id);
                        $this->db->update('tbl_registration',$dat);
                        break;
                    }
                }
            }
        }
    }

    function cre_reg($student,$coursemajor)
    {
        $d['student'] = $student;
        $d['coursemajor'] = $coursemajor;
        //$d['curriculum'] = $curriculum;
        $this->db->insert('tbl_registration',$d);
        $id = $this->db->insert_id();

        $f['registration'] = $id;
        $this->db->where('student',$student);
        $this->db->where('coursemajor',$coursemajor);
        $this->db->update('tbl_enrolment',$f);
        return $id;
    }
    function tryap1($id)
    {
        //22518
        echo $this->api->yearLevel($id);
    }
    // test function
    function tryap2($id)
    {
        $this->db->where('coursemajor',$id);
        $q = $this->db->get('tbl_enrolment')->result_array();
        foreach ($q as $val) {

            $this->db->where('enrolment',$val['id']);
            $qq = $this->db->get('tbl_studentgrade')->result_array();

            foreach ($qq as $val1) {
                $this->db->where('id',$val1['classallocation']);
                $s = $this->db->get('tbl_classallocation')->row_array();

                $this->db->where('subject',$s['subject']);
                $this->db->where('coursemajor',$id);
                $i = $this->db->count_all_results('out_c');
                if($i < 1)
                {
                    $db['subject'] = $s['subject'];
                    $db['coursemajor'] = $id;
                    $this->db->insert('out_c',$db);
                }
            }
        }
    }

    function tt()
    {
        $this->db->where('comment','not found tbl_registration');
        $t = $this->db->get('out_exception')->result_array();
        foreach ($t as $val) {
            $tt = $this->db->query("SELECT * FROM tbl_enrolment
                WHERE academicterm = (SELECT MIN(academicterm)
                FROM tbl_enrolment WHERE student = {$val['student']})
                AND student = {$val['student']} LIMIT 1")->row_array();

            $acam = $tt['academicterm'];
            $coursemajor = $tt['coursemajor'];

            $t1 = $this->db->query("SELECT * FROM tbl_academicterm
                ORDER BY systart ASC,term")->result_array();

            foreach ($t1 as $k) {
                $this->db->where('coursemajor',$coursemajor);
                $this->db->where('academicterm',$k['id']);
                $c = $this->db->get('tbl_curriculum');

                if($c->num_rows() > 0)
                {
                    $ff = $c->row_array();
                    $data['student'] = $val['student'];
                    $data['coursemajor'] = $coursemajor;
                    $data['curriculum'] = $ff['id'];
                    $this->db->insert('tbl_registration',$data);
                    $reg_id = $this->db->insert_id();

                    $d['registration'] = $reg_id;
                    $this->db->where('student',$val['student']);
                    $this->db->update('tbl_enrolment',$d);
                    break;
                }
            }


        }
    }

    function up()
    {
        $this->db->where('comment','no curriculum tbl_registration');
        $r = $this->db->get('out_exception')->result_array();
        foreach ($r as $key) {
            $this->db->where('student',$key['student']);
            $this->db->where('coursemajor',22);
            $g = $this->db->count_all_results('tbl_registration');
            if($g > 0)
            {
                $d['coursemajor'] = 8;
                $this->db->where('student',$key['student']);
                $this->db->update('tbl_registration',$d);
            }
        }
    }

    function nocur()
    {
        $this->db->where('comment', 'no valid academicterm tbl_registration');
        $q = $this->db->get('out_exception')->result_array();

        foreach ($q as $key) {
            $t = $this->db->query("SELECT min(academicterm) as ac,student
                FROM tbl_enrolment WHERE student = {$key['student']} LIMIT 1")->row_array();

            $acam = $t['ac'];

            $f['academicterm'] = $acam;
            $this->db->where('student',$key['student']);
            $this->db->update('tbl_registration',$f);

        }
    }
}
