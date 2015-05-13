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

    function edit_subject($sid = 0)
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/subject',
            'dean/group',
            'dean/college'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
        if($sid != 0)
        {
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
            $data['owner']              = $owner;
        }
        else
        {
            $data['code']               = '';
            $data['descriptivetitle']   = '';
            $data['units']              = '';
            $data['shortname']          = '';
            $data['majorsubject']       = '';
            $data['hours']              = '';
            $data['bookletcharge']      = '';
            $data['sid']                = 0;
            $data['owner']              = 0;
        }

        $this->load->view('dean/subjects',$data);
        $this->load->view('templates/footer');
    }

    function save_subject()
    {

        $data['code']               = strtoupper($this->input->post('code'));
        $data['descriptivetitle']   = strtoupper($this->input->post('title'));
        $data['shortname']          = $this->input->post('shortname');
        $data['units']              = $this->input->post('units');
        $data['hours']              = $this->input->post('hours');
        $data['bookletcharge']      = $this->input->post('booklet');
        $data['majorsubject']       = $this->input->post('major');
        $data['group']              = $this->input->post('group');
        $data['owner']              = $this->input->post('owner');
        $id                         = $this->input->post('sid');

     
        $this->load->model(array(
        'dean/subject'
        ));
        if($id != 0)
        {
            $this->subject->update($id,$data);
            $this->session->set_flashdata('message',
                '<div class="alert alert-success">
                    Subject Successfully Updated
                </div>');
            redirect(base_url('dean/edit_subject/'.$id));
        }
        else
        {
            $count = $this->subject->whereCode($data['code']);
            if($count < 1)
            {
                $this->subject->insert($data);
                $this->session->set_flashdata('message',
                '<div class="alert alert-success" style="padding:20px;">
                    Subject Successfully Inserted
                </div>');
                redirect(base_url('menu/dean-subject_list'));
            }
            else
            {
                $this->session->set_flashdata('message',
                    '<div class="alert alert-danger">
                    Subject Code Already Exists
                    </div>');
                redirect(base_url('dean/edit_subject'));
            }
            
        }
            
    }
    function delete_subject()
    {
        $id = $this->input->post('value');
        $this->db->where('id',$id);
        $this->db->delete('tbl_subject');
    }
    function search_subject($sid)
    {

        $sid = urldecode($sid);
        $this->load->model('dean/subject');

        $s = $this->subject->search($sid);
        $data = array();

        foreach ($s as $r)
        {
            $data[] = array('value' => $r['code'], 'name' => $r['descriptivetitle']);
        }
        echo json_encode($data);
    }
    function search()
    {
        $code = $this->input->post('search');
        $url = $this->input->post('url');
        $this->load->model('dean/subject');
        $q = $this->subject->whereCode($code);
        if($q > 0)
        {
            $sid = $this->subject->count($code);
            redirect(base_url('edit_subject/'.$sid['id']));
        }
        else
        {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" style="margin:20px;">
                    Subject Not Found
                </div>');
            redirect($url);
        }
    }
    function load_sub()
    {
        $sid = $this->input->post('value');
        $this->load->model('dean/subject');
        $data['college'] = $sid;
        $this->load->view('dean/ajax/tbl_subject',$data);
    }
}