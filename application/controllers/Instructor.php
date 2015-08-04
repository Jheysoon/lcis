<?php

class Instructor extends CI_Controller
{

    function student_grade($id = '')
    {
        $this->load->model('instructor/party');
        if(!empty($id))
        {
            $this->api->userMenu();
            $data['id'] = $id;
            $this->load->view('instructor/student_grade', $data);
        }
        else
            show_404();
    }
}
