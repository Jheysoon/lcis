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
