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
                $data['legacycode']     = $this->input->post('room');
                $data['mincapacity']    = $this->input->post('mincapacity');
                $data['maxcapacity']    = $this->input->post('maxcapacity');
                $data['location']       = $this->input->post('location');
                $data['status']         = $this->input->post('status');
            }
        }
        $this->load->view('templates/footer',array('orig_page'=>''));
    }

    function load_stat()
    {
        $this->load->model(array(
            'edp/out_studentcount',
            'registrar/course',
            'registrar/curriculum',
            'registrar/academicterm',
            'registrar/curriculumdetail'
        ));
        $this->load->view('edp/ajax_studentCount');
    }

    function studentcount()
    {
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
            $data['coursemajor']    = $value;
            $data['yearlevel']      = $year_level[$key];
            $data['studentcount']   = $count[$key];
            $data['academicterm']   = $acam;
            $this->out_studentcount->insert($data);
        }
        $this->session->set_flashdata('message','<div class="alert alert-success">
            Successfully Created
        </div>');
        redirect(base_url());
    }

    function view_sched($roomId)
    {
        $this->load->model(array(
            'edp/classroom',
            'edp/edp_classallocation'
        ));
        
        $data['roomId']     = $roomId;
        $room               = $this->classroom->find($roomId);
        $data['room_name']  = $room['legacycode'];
        $data['location']   = $room['location'];
        $this->api->userMenu();


        $this->load->view('edp/view_room_sched',$data);
    }

    function add_sched($sid)
    {
        $this->api->userMenu();
        $data['roomId'] = $sid;

        $this->load->model(array(
            'edp/edp_classallocation'
        ));
        $this->load->view('edp/select_subj',$data);
        $this->load->view('templates/footer');
    }

    function assign_room($cid)
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
}