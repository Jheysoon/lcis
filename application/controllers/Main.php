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
    /*function validate()
    {
         Load the model/query for this function
        $this->load->model(array('User_account'));

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        Just for now just redirect it

        $data['username'] = $username;
        if($username == 'edp' && $password == 'edp')
        {
            $data['id']=6;
        }
        elseif($username == '' && $password == '')
        {
            $data['id']=12121;
        }
        $row = $this->User_account->getEmpInfo(1);
        print_r($row);
        //$this->load->view('home',$data);
    }*/
}