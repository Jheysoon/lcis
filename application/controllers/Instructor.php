<?php

class Instructor extends CI_Controller
{

    function student_grade($id = '')
    {
        $this->load->model('instructor/party');

        if (!empty($id)) {
            $where = array(
                'id'            => $id,
                'instructor'    => $this->session->userdata('uid')
            );

            $this->db->where($where);
            $r = $this->db->count_all_results('tbl_classallocation');

            if ($r > 0) {
                $this->api->userMenu();
                $data['id'] = $id;

                $data['subject'] = $this->db->query("SELECT code,descriptivetitle FROM tbl_subject
                        WHERE id = (
                            SELECT subject FROM tbl_classallocation
                            WHERE id = $id)")->row_array();

                $data['all_grade'] = $this->db->get('tbl_grade')->result_array();

                $this->db->order_by('lastname ASC, firstname ASC, middlename ASC');
                $this->db->where('classallocation', $id);
                $data['g'] = $this->db->get('views_class_list')->result_array();

                $this->load->vars($data);

                $this->load->view('instructor/student_grade');
                $this->load->view('templates/footer2');
            }
            else
                show_error('You do not handle this class');
        }
        else
            show_404();
    }

    function register_employee()
    {
        $this->load->model('instructor/party');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $field = array(
                    'lastname'      =>  'Lastname',
                    'firstname'     =>  'Firstname',
                    'middlename'    =>  'Middlename',
                    'gender'        =>  'Gender',
                    'religion'      =>  'Religion',
                    'dob'           =>  'Date of Birth',
                    'mailadd'       =>  'Mailing Address',
                    'password'      =>  'Password',
                    'rpass'         =>  'Repeat Password',
                    'office'        =>  'Office'
                );

        foreach($field as $key => $value)
        {
            $this->form_validation->set_rules($key, $value, 'required');
        }

        if ($this->form_validation->run() == false) {
            $this->api->userMenu();
            $data['error'] = '';
            $this->load->view('instructor/register_employee', $data);
            $this->load->view('templates/footer');

        } elseif($this->input->post('password') != $this->input->post('rpass')) {
            $this->api->userMenu();
            $data['error'] = '<div class="alert alert-danger text-center">Please confirm your password</div>';
            $this->load->view('instructor/register_employee', $data);
            $this->load->view('templates/footer');

        } else {
            $this->db->trans_begin();
            
            // insert into tbl_party
            $fname              = strtolower($this->input->post('firstname'));
            $lname              = strtolower($this->input->post('lastname'));
            $data['firstname']  = ucwords($fname);
            $data['lastname']   = ucwords($lname);
            $data['middlename'] = ucwords($this->input->post('middlename'));
            $data['religion']   = $this->input->post('religion');
            $this->db->insert('tbl_party', $data);
            $id = $this->db->insert_id();

            // insert into tbl_academic or tbl_administration

            // insert into tbl_useraccess
            $data['username']   = $this->createUsername($fname, $lname);
            $data['partyid']    = $id;
            $data['password']   = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $this->db->insert('tbl_useraccess');
            
            if ($thid->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center">Something Went Wrong</div>');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success text-center">Successfully registered <br/> Your Username is '.$data['username'].'</div>');
            }

            redirect('/register_employee');
        }
    }

    // TODO: Api for this function

    function createUsername($fname, $lname)
    {
        if(strlen($lname) >= 6)
            $username = substr($lname, 0, 6);
        else
            $username = $lname;

        $username = $username.substr($fname, 0, 2);

        // check if the username already exists in database
        $this->db->where('username', $username);
        $count  = $this->db->count_all_results('tbl_useraccess');
        $ctr    = 0;
        $suffix = '00';

        // find an alternative username
        while ($count > 0)
        {
            $ctr++;
            if($ctr < 10)
                $suffix = '0'.$ctr;
            else
                $suffix = $ctr;

            $username = $username.$suffix;
            $this->db->where('username', $username);
            $count  = $this->db->count_all_results('tbl_useraccess');
        }
        return $username;
    }

    function update_grade()
    {
        $grade = $this->input->post('grade');
        $cl    = $this->input->post('classallocation');
        $id    = $this->input->post('studentgrade_id');

        // for security purposes
        // check if the classallocation id match with the instructor
        $where = array(
            'id'            => $cl,
            'instructor'    => $this->session->userdata('uid')
        );
        $this->db->where($where);
        $r = $this->db->count_all_results('tbl_classallocation');

        if ($r > 0) {
            $data['semgrade'] = $grade;
            $this->db->where('id', $id);
            $this->db->update('tbl_studentgrade', $data);
        }
    }

    function all_sched()
    {
        $this->api->userMenu();
        $owner = $this->api->getUserCollege();

        $data['instruc'] = $this->db->query("SELECT firstname, lastname, middlename, a.id as partyid
            FROM tbl_party a,tbl_academic b
            WHERE b.id = a.id AND b.college = $owner")->result_array();
        $this->load->view('instructor/instruc_all', $data);
        $this->load->view('templates/footer2');
    }

    function instruc_sched($id = '')
    {
        if(!empty($id))
        {
            $this->api->userMenu();

            $data['owner']          = $this->api->getUserCollege();

            $this->load->model(array('edp/edp_classallocation', 'dean/subject'));
            $this->db->where('id', $id);
            $this->db->select('firstname,lastname,middlename');
            $data['name']       = $this->db->get('tbl_party')->row_array();
            $data['systemVal']  = $this->api->systemValue();
            $acam               = $this->session->userdata('assign_sy');
            $where = array(
                        'academicterm'  => $acam,
                        'instructor'    => $id
                    );
            $this->db->where($where);
            $data['class']  = $this->db->get('tbl_classallocation')->result_array();
            $data['time1']  = $this->db->get('tbl_time')->result_array();
            $data['day1']   = $this->db->get('tbl_day')->result_array();

            $this->load->view('instructor/sched', $data);
        }
        else
            show_error('Did you type the url by yourself ?');
    }

    function match_subject()
    {
        $this->load->view('match_subject');
    }

    function combine_subject()
    {
        $cur_subj       = $this->input->post('cur_sub');
        $legacy_name    = $this->input->post('legacyname');

        foreach ($legacy_name as $key => $value) {
            $this->db->where('grouping', $legacy_name[$key]);
            $data['subject_id'] = $cur_subj;
            $this->db->update('tbl_enrolment_legacy', $data);
        }

        redirect('/match_subject');
    }

    function undo_subject($id)
    {
        $data['subject_id'] = 0;
        $this->db->where('subject_id', $id);
        $this->db->update('tbl_enrolment_legacy', $data);
        redirect('/match_subject');
    }

}
