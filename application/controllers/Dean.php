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

        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
        ));
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
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

        $this->load->view('dean/dean_classAllocation');
        $this->load->view('templates/footer');
    }
    function qwe()
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

        $this->load->view('edp/edpScheduling');
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

    function edit_subject($sid,$param = '')
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
        $data['comp']               = $computersubject;
        $data['ge']                 = $gesubject;
        $data['academic']           = $nonacademic;
        $data['error']              = '';
        $data['param']              = $param;

        $this->load->view('dean/subjects',$data);
        $this->load->view('templates/footer');
    }

    function add_subject()
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/subject',
            'dean/group','dean/college'
        ));

        $this->load->library('form_validation');
        $this->load->helper('form');

        // rules
        $this->form_validation->set_rules('code','Subject Code','trim|required|is_unique[tbl_subject.code]',
            array('is_unique'=>'Subject Code already exists'));
        $this->form_validation->set_rules('title','Descriptive Title','trim|required');
        $this->form_validation->set_rules('units','Subject Units','trim|required|integer');
        $this->form_validation->set_rules('hours','Subject Hours','trim|required|integer');

        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/header_title2');
            $this->load->view('dean/add_subject');
            $this->load->view('templates/footer');
        }
        else
        {
            $data['code']               = strtoupper($this->input->post('code'));
            $data['descriptivetitle']   = strtoupper($this->input->post('title'));
            $data['shortname']          = trim($this->input->post('shortname'));
            $data['units']              = $this->input->post('units');
            $data['hours']              = $this->input->post('hours');
            $data['bookletcharge']      = $this->input->post('booklet');
            $data['majorsubject']       = $this->input->post('major');
            $data['group']              = $this->input->post('group');
            $data['owner']              = $this->input->post('owner');
            $data['nonacademic']        = $this->input->post('academic');
            $data['gesubject']          = $this->input->post('ge');
            $data['computersubject']    = $this->input->post('comp');

            // check if the subject code already exists

            $this->subject->insert($data);
            $this->session->set_flashdata('message',
            '<div class="alert alert-success" style="margin:20px;">
                Subject Successfully Inserted
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect(base_url('menu/dean-subject_list'));
        } 
    }

    function save_subject()
    {

        $data['code']               = strtoupper($this->input->post('code'));
        $data['descriptivetitle']   = strtoupper($this->input->post('title'));
        $data['shortname']          = trim($this->input->post('shortname'));
        $data['units']              = $this->input->post('units');
        $data['hours']              = $this->input->post('hours');
        $data['bookletcharge']      = $this->input->post('booklet');
        $data['majorsubject']       = $this->input->post('major');
        $data['group']              = $this->input->post('group');
        $data['owner']              = $this->input->post('owner');
        $data['nonacademic']        = $this->input->post('academic');
        $data['gesubject']          = $this->input->post('ge');
        $data['computersubject']    = $this->input->post('comp');
        $id                         = $this->input->post('sid');

        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/subject',
            'dean/group','dean/college'
        ));

        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->form_validation->set_rules('title','Descriptive Title','trim|required');
        $this->form_validation->set_rules('units','Subject Units','trim|required|integer');
        $this->form_validation->set_rules('hours','Subject Hours','trim|required|integer');

        $q = $this->subject->whereCode($data['code']);
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/header_title2');
            $this->load->view('dean/ed_subj');
            $this->load->view('templates/footer');
        }
        elseif($q > 0)
        {
            $q = $this->subject->count($data['code']);
            if($q['id'] == $id)
            {
                $this->subject->update($id,$data);
                $this->session->set_flashdata('message','<div class="alert alert-success">
                        Subject Successfully Updated
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="color:#000;">&times;</span>
                        </button>
                    </div>');
                redirect(base_url('dean/edit_subject/'.$id));
            }
            else
            {
                $d['error'] = '<div class="alert alert-danger">Subject Code Already Exists</div>';
                $this->load->view('templates/header');
                $this->load->view('templates/header_title2');
                $this->load->view('dean/ed_subj',$d);
                $this->load->view('templates/footer');
            }
        }
        else
        {
            $this->subject->update($id,$data);
            $this->session->set_flashdata('message','<div class="alert alert-success">
                    Subject Successfully Updated
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true" style="color:#000;">&times;</span>
                    </button>
                </div>');
            redirect(base_url('dean/edit_subject/'.$id));
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
        $this->load->model(array(
            'dean/subject',
            'dean/common_dean'
        ));

        $col = $this->common_dean->countAcam($this->session->userdata('uid'));
        if($col > 0)
        {
            
            $owner = $this->common_dean->getColAcam($this->session->userdata('uid'));
            $college = $owner['college'];
        }
        else
        {
            $c = $this->common_dean->countAdmin($this->session->userdata('uid'));
            if($c > 0)
            {
                $owner = $this->common_dean->getColAdmin($this->session->userdata('uid'));
                $o = $owner['office'];
                $of = $this->common_dean->getOffice($this->session->userdata('uid'));
                $college = $of['college'];
            }
            else
            {
                $college = 0;
            }
        }
        

        $s = $this->subject->search($sid,$college);
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

    function evaluation($id){
        $this->head();
        $this->load->view('dean/dean_preEnroll');
        $this->load->view('templates/footer');
    }

    function ident_subj($id)
    {
        $this->load->model(array(
            'dean/subject','dean/common_dean'
        ));

        $col = $this->common_dean->countAcam($this->session->userdata('uid'));
        if($col > 0)
        {
            $owner = $this->common_dean->getColAcam($this->session->userdata('uid'));
            $college = $owner['college'];
        }
        else
        {

            $c = $this->common_dean->countAdmin($this->session->userdata('uid'));
            if($c > 0)
            {
                $owner = $this->common_dean->getColAdmin($this->session->userdata('uid'));
                $o = $owner['office'];
                $of = $this->common_dean->getOffice($o);
                $college = $of['college'];
            }
            else
            {
                $college = 0;
            }
        }
        $s = $this->subject->find($id);
        if($college == 0 OR $s['owner'] == 0)
        {
           redirect(base_url('edit_subject/'.$id.'/view'));
        }
        elseif($s['owner'] == $college)
        {
            redirect(base_url('edit_subject/'.$id));
        }
    }
}