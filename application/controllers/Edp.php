<?php
/*
| -------------------------------------
| @file  : Edp.php
| @date  : 3/26/2015
| @author: Jayson Martinez
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
}