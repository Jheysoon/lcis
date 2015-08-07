<?php

class Instructor extends CI_Controller
{

    function student_grade($id = '')
    {
        $this->load->model('instructor/party');
        if(!empty($id))
        {
            $where = array(
                'id'            => $id,
                'instructor'    => $this->session->userdata('uid')
            );
            $this->db->where($where);
            $r = $this->db->count_all_results('tbl_classallocation');
            if($r > 0)
            {
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
        if($r > 0)
        {
            $data['semgrade'] = $grade;
            $this->db->where('id', $id);
            $this->db->update('tbl_studentgrade', $data);
        }
    }

    function all_sched()
    {
        $this->load->view('');

    }
}
