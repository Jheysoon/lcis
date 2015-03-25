<?php
/*
| -------------------------------------
| @file  : Main.php
| @date  : 3/24/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Main extends CI_Controller{

    function index()
    {
        $this->load->library('form_validation');

        //set the rules for the login validation

        $this->form_validation->set_rules('username','Username','required',
            array('required' => 'Please enter a username'));
        $this->form_validation->set_rules('password','Password','required',
            array('required' => 'Please enter a password'));

        //test the rules

        if($this->form_validation->run() == FALSE){
            $this->load->view('login');
        }
        else{
            echo 'hello world';
        }

    }

    function home()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
        $this->load->view('home');
        $this->load->view('templates/footer');
    }

    function logout()
    {
        // Unset some SESSION variable

        redirect(base_url());
    }

}