<?php
/*
| -------------------------------------
| @file  : Dean.php
| @date  : 3/26/2015
| @author:
| -------------------------------------
*/

class Dean extends CI_Controller
{

    private function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

    function listSubjectSectioning()
    {
        $this->head();
        $this->load->view('dean/list_subjectsectioning');
        $this->load->view('templates/footer');
    }

    function ClassAllocation()
    {
        $this->head();
        $this->load->view('dean/dean_classAllocation');
        $this->load->view('templates/footer');
    }

    function adddelete_Section()
    {
        $this->head();
        $this->load->view('dean/adddelete_section');
        $this->load->view('templates/footer');
    }

    function PreEnrolment()
    {
        $this->head();
        $this->load->view('dean/dean_preEnroll');
        $this->load->view('templates/footer');
    }

    function updateStudentLoad()
    {
        $this->head();
        $this->load->view('dean/update_studentload');
        $this->load->view('templates/footer');
    }

    function listGradingList()
    {
        $this->head();
        $this->load->view('dean/grading_list');
        $this->load->view('templates/footer');
    }

    function listINCsubject()
    {
        $this->head();
        $this->load->view('dean/incsubject_list');
        $this->load->view('templates/footer');
    }

    function listAttest()
    {
        $this->head();
        $this->load->view('dean/attest_list');
        $this->load->view('templates/footer');
    }

    function listCompletedINC()
    {
        $this->head();
        $this->load->view('dean/completedinc_list');
        $this->load->view('templates/footer');
    }

    function listSubject()
    {
        $this->head();
        $this->load->view('dean/subject_list');
        $this->load->view('templates/footer');
    }

    function listCurriculum()
    {
        $this->head();
        $this->load->view('dean/curriculum_list');
        $this->load->view('templates/footer');
    }

    function edit_subject($sid)
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/subject',
            'dean/group'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

        $sub = $this->subject->find($sid);
        extract($sub);
        $data['code']               = $code;
        $data['descriptivetitle']   = $descriptivetitle;
        $data['units']              = $units;
        $data['shortname']          = $shortname;
        $data['majorsubject']       = $majorsubject;
        $data['hours']              = $hours;
        $data['bookletcharge']      = $bookletcharge;
        $data['sid']                = $sid;

        $this->load->view('dean/subjects',$data);
        $this->load->view('templates/footer');
    }

    function save_subject()
    {
        $data['code'] = $this->input->post('code');
        $data['descriptivetitle'] = $this->input->post('title');
        $data['shortname'] = $this->input->post('shortname');
        $data['units'] = $this->input->post('units');
        $data['hours'] = $this->input->post('hours');
        $data['bookletcharge'] = $this->input->post('booklet');
        $data['majorsubject'] = $this->input->post('major');
        $data['group'] = $this->input->post('group');
        $id = $this->input->post('sid');
        $this->load->model(array(
            'dean/subject'
        ));
        $this->subject->update($id,$data);
        redirect(base_url('edit_subject/'.$id));
    }
    function delete_subject()
    {
        $id = $this->input->post('value');
        $this->db->where('id',$id);
        $this->db->delete('tbl_subject');
    }
}