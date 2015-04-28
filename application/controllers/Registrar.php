<?php
/*
| -------------------------------------
| @file  : Registrar.php
| @date  : 3/24/2015
| @author:
| -------------------------------------
*/

class Registrar extends CI_Controller
{

    private function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

    function addNewStudent()
    {
        $this->head();
        $this->load->view('registrar/newstudent_registration');
        $this->load->view('templates/footer');
    }

    function addTransferee()
    {
        $this->head();
        $this->load->view('registrar/transferee_registration');
        $this->load->view('templates/footer');
    }

    function addCrossEnrolee()
    {
        $this->head();
        $this->load->view('registrar/crossenrollee_registration');
        $this->load->view('templates/footer');
    }

    function updateOldStudents()
    {
        $this->head();
        $this->load->view('registrar/student_list');
        $this->load->view('templates/footer');
    }

    function permanentRecord()
    {
        $this->head();
        $this->load->view('registrar/student_list');
        $this->load->view('templates/footer');
    }

    function listCHED()
    {
        $this->head();
        $this->load->view('registrar/ched_list');
        $this->load->view('templates/footer');
    }

    function listRequestedServices()
    {
        $this->head();
        $this->load->view('registrar/requestedservices_list');
        $this->load->view('templates/footer');
    }

    function updateSystemValue()
    {
        $this->head();
        $this->load->view('registrar/systemvalue_list');
        $this->load->view('templates/footer');
    }

    function listSchool()
    {
        $this->head();
        $this->load->view('registrar/school_list');
        $this->load->view('templates/footer');
    }

    function listCollege()
    {
        $this->head();
        $this->load->view('registrar/college_list');
        $this->load->view('templates/footer');
    }

    function listCourse()
    {
        $this->head();
        $this->load->view('registrar/course_list');
        $this->load->view('templates/footer');
    }

    function listScholasticPeriod()
    {
        $this->head();
        $this->load->view('registrar/scholasticperiod_list');
        $this->load->view('templates/footer');
    }

    function listCollegiateCalendar()
    {
        $this->head();
        $this->load->view('registrar/collegiatecalendar_list');
        $this->load->view('templates/footer');
    }

    function listHoliday()
    {
        $this->head();
        $this->load->view('registrar/holiday_list');
        $this->load->view('templates/footer');
    }

    function listNonCreditedSubject()
    {
        $this->head();
        $this->load->view('registrar/noncreditedsubject_list');
        $this->load->view('templates/footer');
    }

    function listSubjectGrouping()
    {
        $this->head();
        $this->load->view('registrar/subjectgrouping_list');
        $this->load->view('templates/footer');
    }

    function listServices()
    {
        $this->head();
        $this->load->view('registrar/services_list');
        $this->load->view('templates/footer');
    }

    function oldstudent_reg()
    {
        $this->head();
        $this->load->view('registrar/oldstudent_registration');
        $this->load->view('templates/footer');
    }
    function insert_stud()
    {
        $data = "x";
        $this->load->model("registrar/tbl_party");
        $this->tbl_party->insert_students($data);
        // $data = array(

        //     );
        // $thi
    }
     function buildperrecord()
    {
        $this->head();
        $this->load->view('registrar/buildstudRecord');
        $this->load->view('templates/permanent_record_footer');
    }
    function search_by_id($id)
    {
        // clean the url since the request is a get method
        $id = urldecode($id);

        $data = array();

        $this->load->model('registrar/party');
        $results_id = $this->party->searchId($id);

        foreach($results_id as $r)
        {
            $data[] = array('value'=>$r['legacyid'],'name'=>$r['firstname'].' '.$r['lastname'],'status'=>'ok');
        }
        echo json_encode($data);
    }
    function edit_grades($code, $subject, $grade)
    {
        $data['code']=$code;
        $data['subject']=$subject;
        $data['grade']=$grade;
        $this->head();
        $this->load->view('registrar/edit_gades', $data);
        $this->load->view('templates/footer');
    }
    function buildup($id){
        $this->load->model('registrar/course');
        $this->load->model('home/option');
        $this->load->model('home/option_header');
        $this->load->model('home/useroption');
        $this->load->model('registrar/grade');
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
        $this->load->model('registrar/common');
        $this->load->model('registrar/subject');
        $this->load->model('registrar/party');
        $this->load->model('registrar/academicterm');
        $this->load->model('registrar/log_student');
        $data['id'] = $id;
        $this->load->view('registrar/buildstudRecord',$data);
        $this->load->view('templates/footer');
    }
    function search()
    {
        $this->load->model('registrar/party');
        $id = $this->input->post('search');
        $id = $this->party->existsID($id);
        if($id > 0)
        {
            redirect('/rgstr_build/'.$id);
        }
        else
        {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Unable to find student id</div>');
            redirect($this->input->post('cur_url'));
        }
    }
    function save_grade()
    {
        $enrolmentid =  $this->input->post('enrolmentid');
        $subjid = $this->input->post('add_subj');
        $grade = $this->input->post('sub_grade');
        $academicid = $this->input->post('academictermid');
        $schoolid = $this->input->post('schoolid');
        $this->load->model('registrar/classallocation');
        $this->load->model('registrar/studentgrade');
        $this->load->model('registrar/subject');
        $this->load->model('registrar/grade');


        $data['subject'] = $subjid;
        $data['academicterm'] = $academicid;
        $count = $this->classallocation->whereCount($data);
        if($count < 1)
        {
            $id = $this->classallocation->insert_ca_returnId($subjid,$academicid);
            if(is_numeric($id))
            {
                $db['enrolmentid'] = $enrolmentid;

                $data['subj'] = $subjid;
                $data['grade_user'] = $grade;
                $data['enrolmentid'] = $enrolmentid;
                $data['academicterm'] = $academicid;
                $data['schoolid'] = $schoolid;
                $data['sid'] = $this->studentgrade->save_grade_returnId($id,$grade,$enrolmentid);
                $this->load->view('registrar/ajax/add_subject',$data);
            }
            else
            {
                echo 'error';
            }
        }
        else
        {
            echo 'Subject Already exists';
        }

    }
    function insert_flag()
    {
        $partyid =  $this->input->post('partyid');
        $data = array('flag' => '1',
                    'partyid' => $partyid);
        $this->load->model('registrar/common');

        $result = $this->common->theflag($partyid);
        if ($result < 1) {
             $this->db->insert('tbl_confirmflag', $data);
        }else{
            
            $this->db->query("UPDATE tbl_confirmflag SET flag = 1 WHERE partyid = '$partyid'");
        }
        
        redirect('/');

}
    function save_edit_grade()
    {
        $this->load->model('registrar/studentgrade');
        $val = $this->input->post('val');
        $cat = explode('_',$val);
        $i = 0;
        foreach($cat as $c)
        {
            $v = explode('-',$c);
            if($i == 0)
            {
                $studgrade = $v[1];
            }
            elseif($i == 1)
            {
                $grade_id = $v[1];
            }
            else
            {
                $subid = $v[1];
            }
            $i++;
        }
        $this->studentgrade->update_grade($studgrade,$grade_id);
    }

    function delete_record()
    {
        $this->load->model('registrar/studentgrade');
        $this->load->model('registrar/enrollment');

        $val = $this->input->post('value');

        $cat = explode('-',$val);
        $enrolid = $cat[0];
        $studgrade = $cat[1];
        $this->studentgrade->delete_grade($studgrade);
        $this->enrollment->update_record($enrolid);
    }
    function add_acam()
    {
        $partyid = $this->input->post('partyid');
        $sch_id = $this->input->post('school_id');
        $cid = $this->input->post('course_id');
        $syid = $this->input->post('sy_id');
        $this->load->model('registrar/enrollment');
        $this->load->model('registrar/party');
        $this->load->model('registrar/course');
        $this->load->model('registrar/academicterm');
        $this->load->model('registrar/subject');
        $this->load->model('registrar/grade');
        $data['student'] = $partyid;
        $data['coursemajor'] = $cid;
        $data['academicterm'] = $syid;
        $data['school'] = $sch_id;
        $data['numberofsubject'] = 0;

        $db['academicterm'] = $syid;
        $db['student'] = $partyid;
        $count = $this->enrollment->whereCount($db);
        if($count < 0)
        {
            $id = $this->enrollment->insert_return_id($data);
            $data['id'] = $id;
            $this->load->view('registrar/ajax/add_academicterm',$data);
        }
        else
        {
            echo 'Academic Term Already Exists';
        }
    }
}