<?php
/*
| -------------------------------------
| @file  : Main.php
| @date  : 3/24/2015
| @author:
| -------------------------------------
*/

class Main extends CI_Controller
{
    function index()
    {
        // if the session is set
        if($this->session->has_userdata('uid'))
        {
            // go to home page
            $this->home();
        }
        else
        {
            // go to login page
            $this->login();
        }

    }

    function login()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        //set the rules for the login validation
        $this->form_validation->set_rules('username','Username','trim|required',
            array('required' => 'Please enter a username'));
        $this->form_validation->set_rules('password','Password','trim|required',
            array('required' => 'Please enter a password'));

        //test the rules
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
        }
        else
        {

            $this->load->model('useraccess');

            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('password'));

            // check if the user exists
            $count = $this->useraccess->chkLogin($username,$password);

            if($count > 0)
            {
                // set the session uid value
                $this->session->set_userdata('uid',$this->useraccess->getUserId($username,$password));

                redirect(base_url());
            }
            else
            {
                // display a error message to the user
                $this->session->set_flashdata('message','
                    <div class="alert alert-danger text-center">Authentication Failed</div>
                ');
                redirect(base_url());
            }
        }
    }

    function home()
    {
        $this->head();
        $this->load->view('home');
        $this->load->view('templates/footer');
    }

    private function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

    function account()
    {
        $this->head();
        $this->load->view('account_settings');
        $this->load->view('templates/footer');
    }
    function menu($page)
    {
        $this->head();
        $page = str_replace('-', '/', $page);

        if(file_exists('./application/views/'.$page.'.php'))
        {
            $this->load->view($page);
            $this->load->view('templates/footer');
        }
        else
        {

        }

    }
    function logout()
    {
        // Unset some SESSION variable
        $this->session->unset_userdata('uid');

        redirect(base_url());
    }

}