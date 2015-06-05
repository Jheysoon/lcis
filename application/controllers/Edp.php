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
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));

        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

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
            'edp/edp_classallocation'
        ));
        $data['cid'] = $cid;
        $this->load->view('edp/assign_subj_room',$data);
        $this->load->view('templates/footer');
    }
}