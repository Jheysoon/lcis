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

            $username = stripslashes($this->input->post('username'));
            $password = stripslashes($this->input->post('password'));

            // check if the user exists
            $count = $this->useraccess->chkLogin($username,$password);

            if($count == 'ok')
            {
                // set the session uid value
                $userid     = $this->useraccess->getUserId($username,$password);
                $position   = $this->useraccess->getposition($userid);
                if($position == 'C')
                {
                    $status = 'S';
                }
                else
                {
                    $status = 'N';
                }
                $this->session->set_userdata(array(
                    'uid'               =>$userid,
                    'datamanagement'    =>$position,
                    'sy'                =>'2014-2015',
                    'sem'               =>'1st Semester',
                    'cur_id'            =>'46',
                    'status'            =>$status,
                    'username'          =>$username
                ));
            }
            else
            {
                // display a error message to the user
                $this->session->set_flashdata('message','
                    <div class="alert alert-danger text-center">Authentication Failed</div>
                ');
            }
            redirect(base_url());
        }
    }

    function home()
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'home/party'
        ));

        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

        $this->load->view('home');
        $this->load->view('templates/footer',array('orig_page'=>''));
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
    function menu($page,$param = '')
    {
        // redirect if the session has expired
        //@todo verify if the user has really the right to that menu
        if(!$this->session->has_userdata('uid'))
        {
            redirect(base_url());
        }

        $this->api->userMenu();

        $data['orig_page'] = $page;

        $page = str_replace('-', '/', $page);

        if(file_exists('./application/views/'.$page.'.php'))
        {

            //@todo double check if the user really has the access

            $load_model = explode('/',$page);

            $data['param'] = $param;
            if($load_model[0]=='registrar')
            {
                $this->registrar();
            }
            elseif($load_model[0] == 'dean')
            {
                $this->dean();
            }
            elseif($load_model[0] == 'edp')
            {
                $this->edp();
            }elseif ($load_model[0] == 'billing') {
                $this->dean();
            }

            $this->load->view($page,$data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            show_error('cannot find file');
        }

    }

    function registrar()
    {
        $this->load->model(array(
            'registrar/common','registrar/party',
            'registrar/registration','registrar/course',
            'registrar/enrollment'
        ));
        $this->load->library('pagination');
    }

    function dean()
    {
        $this->load->model(array(
            'dean/subject',
            'registrar/curriculum',
            'dean/college',
            'dean/common_dean',
            'registrar/common',
            'registrar/party',
            'registrar/registration',
            'registrar/course',
            'dean/student',
            'registrar/enrollment',
            'edp/out_studentcount',
            'registrar/classallocation',
            'dean/out_section',
            'edp/edp_classallocation',
            'registrar/academicterm'
        ));
        $this->load->library('pagination');
    }

    function edp()
    {
        $this->load->model(array(
            'edp/out_studentcount',
            'registrar/course',
            'registrar/curriculum',
            'registrar/academicterm',
            'edp/classroom'
        ));
    }

    function createUsername($fname,$lname)
    {
        if(strlen($lname)>=6)
        {
            $username='';
            for($i=0;$i<6;$i++)
            {
                $username .= $lname[$i];
            }
        }
    }

    function setSy_session()
    {
        $sy     = $this->input->post('sy');
        $sem    = $this->input->post('sem');

        if(is_numeric($sy) AND is_numeric($sem) AND $sy > 0 AND $sem > 0 AND $sem < 4 )
        {
            $this->load->model('home/academicterm');
            $val = $this->academicterm->getSY_id($sy,$sem);

            if($val['term'] == '1')
                $sem = '1st Semester';
            elseif($val['term'] == '2')
                $sem = '2nd Semester';
            else
                $sem = 'Summer';

            $this->session->set_userdata(array('sy'=>$val['systart'].'-'.$val['syend'],'sem'=>$sem,'cur_id'=>$val['id']));
            echo 'ok';
        }
        else
        {
            echo 'invalid';
        }
    }

    function logout()
    {
        // Unset some SESSION variable
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata(array('sy','sem','cur_id','datamanagement','status'));

        redirect(base_url());
    }

}