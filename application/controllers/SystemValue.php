<?php 

class SystemValue extends CI_Controller
{
    function index()
    {
        $this->api->userMenu();
        $this->load->view('registrar/systemvalue');
        $this->load->view('templates/footer');
    }
}