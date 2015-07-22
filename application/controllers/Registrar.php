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
        $stat = $this->session->userdata('status');

        foreach ($results_id as $r)
        {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
        }
        echo json_encode($data);
    }
    function search_forpayment($id){
        $id = urldecode($id);
        $data = array();
        $this->load->model('registrar/party');
        $results_id = $this->party->search_pay($id);

        foreach ($results_id as $r)
        {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
        }
        echo json_encode($data);

    }
    function edit_grades($code, $subject, $grade)
    {
        $data['code'] = $code;
        $data['subject'] = $subject;
        $data['grade'] = $grade;
        $this->head();
        $this->load->view('registrar/edit_gades', $data);
        $this->load->view('templates/footer');
    }

    function buildup($id)
    {
        $this->load->model(array(
            'registrar/course', 'home/useroption',
            'registrar/grade', 'registrar/common',
            'registrar/subject', 'registrar/party',
            'registrar/academicterm', 'registrar/log_student',
            'registrar/enrollment','registrar/studentgrade',
            'registrar/registration','registrar/curriculum',
            'registrar/curriculumdetail'
        ));

        $this->api->userMenu();

        $data['id'] = $id;
        $this->load->view('registrar/buildstudRecord', $data);
        $this->load->view('templates/footer');
    }

    function search()
    {
        $this->load->model('registrar/party');
        $id = $this->input->post('search');
        $id1 = $this->party->existsID($id);
        if ($id1 > 0)
        {
            redirect('/rgstr_build/' . $id);
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Unable to find student id</div>');
            redirect($this->input->post('cur_url'));
        }
    }
    function save_grade()
    {
        $enrolmentid    = $this->input->post('enrolmentid');
        $subjid         = $this->input->post('add_subj');
        $grade          = $this->input->post('sub_grade');
        $academicid     = $this->input->post('academictermid');
        $schoolid       = $this->input->post('schoolid');

        $this->load->model(array(
            'registrar/classallocation',
            'registrar/studentgrade',
            'registrar/subject',
            'registrar/grade',
            'registrar/log_student',
            'registrar/enrollment'
        ));
        $data['subject'] = $subjid;
        $data['academicterm'] = $academicid;
        //$count = $this->classallocation->whereCount($data);

        // we can prevent user from entering duplicate subj within a academicterm but
        // the studentgrade table will be a mess
        // cause we will not create a new record in tbl_classallocation
        // just fetch the first record that is found
        $q = $this->db->query("SELECT * FROM views_studentgrade WHERE enrolment=$enrolmentid AND subject=$subjid")->num_rows();
        if ($q < 1)
        {
            $id = $this->classallocation->insert_ca_returnId($subjid, $academicid);
            if (is_numeric($id))
            {
                $data['subj'] = $subjid;
                $data['grade_user'] = $grade;
                $data['enrolmentid'] = $enrolmentid;
                $data['academicterm'] = $academicid;
                $data['schoolid'] = $schoolid;
                $p = $this->enrollment->getID($enrolmentid);
                $this->log_student->insert_not_exists($p['student'],'E');
                $data['sid'] = $this->studentgrade->save_grade_returnId($id, $grade, $enrolmentid);
                $this->load->view('registrar/ajax/add_subject', $data);
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
        $this->load->model(array(
            'registrar/common',
            'registrar/log_student'
        ));
        $partyid = $this->input->post('partyid');
        $url = $this->input->post('url');
        $flag_status = $this->input->post('flag_status');

        $curtm = $this->log_student->getLatestTm($partyid);
        if($flag_status == 'C')
        {
            $tm = $this->input->post('tm');
            if ($tm == $curtm)
            {
                $this->add_flag($partyid,$flag_status);
                $data['user'] = $this->session->userdata('uid');
                $data['dte'] = date('Y-m-d');
                $data['student'] = $partyid;
                $data['status'] = $flag_status;
                $data['tm'] = time();
                $this->db->insert('log_student');
            }
            else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">
                <h4>A update has been occurred before you submit.
                    Please review again and then submit</h4>
            </div>');
                redirect($url);
            }
        }
        else
        {
            $this->log_student->ins_stat($partyid, $flag_status);
            $this->add_flag($partyid, $flag_status);
        }
    }

    private function add_flag($partyid,$status)
    {
        $this->load->model('registrar/common');
        $data2 = array('status' => $status);
        $this->db->where('id', $partyid);
        $this->db->update('tbl_party', $data2);
        redirect('/');
    }

    function save_edit_grade()
    {
        $this->load->model(array(
            'registrar/studentgrade',
            'registrar/log_student',
            'registrar/enrollment'
        ));
        $val = $this->input->post('val');
        $cat = explode('_', $val);
        $i = 0;
        foreach ($cat as $c)
        {
            $v = explode('-', $c);
            if ($i == 0)
                $studgrade = $v[1];
            elseif ($i == 1)
                $grade_id = $v[1];
            else
                $enroll = $v[1];
            $i++;
        }
        $q = $this->enrollment->getID($enroll);
        $pid = $q['student'];

        $stat = $this->log_student->chkStatus($pid);
        if($stat['status'] != 'S')
        {
            $this->log_student->insert_not_exists($q['student'], 'E');
            $this->studentgrade->update_grade($studgrade, $grade_id);
        }
        else
        {
            echo 'This record is already submitted';
        }

    }

    function delete_record()
    {
        $this->load->model(array(
            'registrar/studentgrade',
            'registrar/enrollment'
        ));

        $val = $this->input->post('value');

        $cat = explode('-', $val);
        $enrolid = $cat[0];
        $studgrade = $cat[1];
        $this->studentgrade->delete_grade($studgrade);
        $this->enrollment->update_record($enrolid);
    }

    function add_acam()
    {
        $partyid    = $this->input->post('partyid');
        $sch_id     = $this->input->post('school_id');
        $cid        = $this->input->post('course_id');
        $syid       = $this->input->post('sy_id');

        $this->load->model(array(
            'registrar/enrollment', 'registrar/party',
            'registrar/course', 'registrar/academicterm',
            'registrar/subject', 'registrar/grade',
            'registrar/log_student','registrar/registration',
            'registrar/curriculum','registrar/curriculumdetail'
        ));

        $data['student']            = $partyid;
        $data['coursemajor']        = $cid;
        $data['academicterm']       = $syid;
        $data['school']             = $sch_id;
        $data['numberofsubject']    = 1;

        $db['academicterm'] = $syid;
        $db['student']      = $partyid;

        $stat = $this->log_student->chkStatus($partyid);
        if($stat['status'] != 'S')
        {
            $count = $this->enrollment->whereCount($db);
            if ($count < 1)
            {
                $d['student']       = $partyid;
                $d['coursemajor']   = $cid;
                $d['academicterm']  = $syid;
                $this->registration->ins_not_exist($d);
                $this->log_student->insert_not_exists($partyid, 'E');
                $id = $this->enrollment->insert_return_id($data);
                $data['id'] = $id;
                $this->load->view('registrar/ajax/add_academicterm', $data);
            }
            else
            {
                echo 'Academic Term Already Exists';
            }
        }
        else
        {
            echo 'This record is already submitted';
        }

    }

    function add_session()
    {
        $value = $this->input->post('value');
        $this->session->set_userdata('status', $value);
        $data['param'] = $this->input->post('param');
        $this->load->model(array(
            'registrar/enrollment',
            'registrar/party',
            'registrar/course'
        ));
        $this->load->view('registrar/ajax/tbl_studlist', $data);
    }
    function delete_acam()
    {
        $enrolmentid = $this->input->post('eid');
        $this->load->model(array(
            'registrar/enrollment',
            'registrar/studentgrade',
            'registrar/classallocation',
            'registrar/log_student'
        ));

        $p      = $this->enrollment->getID($enrolmentid);
        $pid    = $p['student'];
        $stat   = $this->log_student->chkStatus($pid);

        if($stat['status'] != 'S')
        {
            $this->log_student->insert_not_exists($p['student'], 'E');
            $this->enrollment->delete_enroll($enrolmentid);

            // after the classallocation has been deleted
            // its time to deleted the subjects grade
            $this->studentgrade->delete($enrolmentid);
        }
        else
        {
            echo 'This record is already submitted';
        }
    }
    function add_re_exam()
    {
        $this->load->model(array(
            'registrar/studentgrade',
            'registrar/log_student',
            'registrar/enrollment'
        ));

        $val    = $this->input->post('val');
        $cat    = explode('_', $val);
        $i      = 0;

        foreach ($cat as $c)
        {
            $v = explode('-', $c);
            if ($i == 0)
                $studgrade = $v[1];
            elseif ($i == 1)
                $grade_id = $v[1];
            else
                $enroll = $v[1];
            $i++;
        }

        $q      = $this->enrollment->getID($enroll);
        $pid    = $q['student'];
        $stat   = $this->log_student->chkStatus($pid);

        if($stat['status'] != 'S')
        {
            $this->log_student->insert_not_exists($q['student'], 'E');
            $this->studentgrade->update_reexam_grade($studgrade, $grade_id);
        }
        else
            echo 'This record is already submitted';
    }

    function re_exam()
    {
        $this->load->model(array(
            'registrar/log_student',
            'registrar/enrollment',
            'registrar/grade',
            'registrar/studentgrade'
        ));

        $enrol_id   = $this->input->post('enrol');
        $q          = $this->enrollment->getID($enrol_id);
        $pid        = $q['student'];
        $stat       = $this->log_student->chkStatus($pid);

        if($stat['status'] != 'S')
        {
            $grade_id               = $this->input->post('grad');
            $data['enrolmentid']    = $enrol_id;
            $data['sid']            = $this->input->post('stugrade');

            $this->studentgrade->update_grade($data['sid'],$grade_id);
            $this->log_student->insert_not_exists($pid, 'E');
            $this->load->view('registrar/ajax/re_exam',$data);
        }
        else
        {
            echo 'This record is already submitted';
        }
    }

    function update_studinfo(){
                //update in tbl_party
                    $partyid = $this->input->post('partyid');
                    $firstname = $this->input->post('firstname');
                    $middlename = $this->input->post('middlename');
                    $lastname = $this->input->post('lastname');
                    $dob = $this->input->post('dob');
                    $pob = $this->input->post('pob');
                    $address1 = $this->input->post('address1');
                    $address2 = $this->input->post('address2');

                   //update in tbl_student
                    $primary = $this->input->post('primary');
                    $elementary = $this->input->post('elementary');
                    $highschool = $this->input->post('highschool');
                    $primaryyear = $this->input->post('primaryyear');
                    $elementaryyear = $this->input->post('elementaryyear');
                    $highschoolyear = $this->input->post('highschoolyear');
                   //latest registration to be updated
                    $url = $this->input->post('url');
                    $course = $this->input->post('course');
                     $dateregistered = $this->input->post('dateregistered');
                     echo $dor = $this->input->post('dor');
                   $dat = date('Y');



                $start = new DateTime($dob);
                $end  = new DateTime(date('Y-m-d'));
                $dDiff = $start->diff($end);
                $dif = $dDiff->format('%Y');
                $alerts = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
                $suc = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
                   if ($dif < 10) {
                      $this->session->set_flashdata('message', $alerts . 'Invalid Date of Birth.</div>');
                   }elseif($pob == ''){
                      $this->session->set_flashdata('message',  $alerts . 'Please Fill-up Place of Birth</div>');
                   }elseif($address1 == ''){
                    $this->session->set_flashdata('message',  $alerts . 'Please Fill-up Address</div>');
                   }
                   elseif ($elementary == '' OR $elementary == 'Select') {
                    $this->session->set_flashdata('message',  $alerts . 'Please Select First Elementary School</div>');
                   }elseif ($primary == '' OR $primary == 'Select') {
                      $this->session->set_flashdata('message',  $alerts . 'Please Select First Primary School</div>');
                   }elseif ($highschool == '' OR $highschool == 'Select') {
                    $this->session->set_flashdata('message', $alerts . 'Please Select First High School</div>');
                   }elseif ($primaryyear == '' OR $primaryyear > $dat) {
                    $this->session->set_flashdata('message',  $alerts . 'Please Select First Year of Completion in Primary School</div>');
                   }elseif ($elementaryyear == '' OR $elementaryyear > $dat) {
                    $this->session->set_flashdata('message', $alerts . 'Please Select First Year of Completion in Elementary School</div>');
                   }elseif ($highschoolyear == '' OR $highschoolyear > $dat) {
                     $this->session->set_flashdata('message', $alerts . 'Please Select First Year of Completion in High School</div>');
                   }else{

                           $this->session->set_flashdata('message', '<div class="alert alert-success">'. $suc . 'Information Successfuly Saved.</div>');
                            $data = array(
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'lastname' => $lastname,
                            'dateofbirth' => $dob,
                            'placeofbirth' => $pob,
                            'address1' => $address1,
                            'address2' => $address2,
                            );
                            $this->db->where('id', $partyid);
                            $this->db->update('tbl_party', $data);

                            $data2 = array(
                                'primary' => $primary,
                                'elementary' => $elementary,
                                'secondary' => $highschool,
                                'completionprimary' => $primaryyear,
                                'completionelementary' => $elementaryyear,
                                'completionsecondary' => $highschoolyear
                                );
                            $this->db->where('id', $partyid);
                            $this->db->update('tbl_student', $data2);
                            $coursmaj = $this->db->query("SELECT course, id FROM tbl_coursemajor WHERE course = '$course'");
                            $x = $coursmaj->row_array();
                            $x['id'];
                            $data3 = array('coursemajor' => $course,
                                            'date' => $dor
                                            );
                            $this->db->where('student', $partyid);
                            $this->db->where('date',$dateregistered);
                            $this->db->update('tbl_registration', $data3);

                     }
                             $x = array(
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'lastname' => $lastname,
                            'dob' => $dob,
                            'pob' => $pob,
                            'address1' => $address1,
                            'address2' => $address2,
                            'primary' => $primary,
                            'elementaryss' => $elementary,
                            'secondary' => $highschool,
                            'completionprimary' => $primaryyear,
                            'completionelementary' => $elementaryyear,
                            'completionsecondary' => $highschoolyear
                        );
                           $_SESSION['infos'] = $x;
                          // print_r($_SESSION['infos']);
                           redirect('/rgstr_build/' . $url);
    }

    function add_school(){

        $sch    = strtoupper($this->input->post('school'));
        $add    = strtoupper($this->input->post('address'));
        $short  = strtoupper($this->input->post('short'));
        $name   = strtoupper($this->input->post('name'));
        $lvl1   = strtoupper($this->input->post('lvl1'));
        $lvl2   = strtoupper($this->input->post('lvl2'));
        $lvl3   = strtoupper($this->input->post('lvl3'));
        $lvl4   = strtoupper($this->input->post('lvl4'));

        $data = array(
            'sch'   => $sch,
            'add'   =>$add,
            'short' =>$short,
            'name'  =>$name,
            'lvl1'  =>$lvl1,
            'lvl2'  =>$lvl2,
            'lvl3'  =>$lvl3,
            'lvl4'  =>$lvl4
        );

        if($this->input->post('action') == 'add'){
            $query = $this->db->query("SELECT COUNT(*) as ctr FROM tbl_party, tbl_school
                              WHERE firstname = '$sch' AND tbl_party.id = tbl_school.id");
            $query = $query->row_array();
            $query = $query['ctr'];
        }
        else{
            $sname   = strtoupper($this->input->post('sname'));
            if ($sname == $sch) {
                $query = 0;
            }
            else{
                $query = $this->db->query("SELECT COUNT(*) as ctr FROM tbl_party, tbl_school
                                 WHERE firstname = '$sch' AND firstname = '$sch' AND tbl_party.id = tbl_school.id");
                $query = $query->row_array();
                $query = $query['ctr'];
            }
        }

        if ($query == 0) {

            $data1 = array(
                'firstname' => $sch,
                'address1'  => $add,
                'shortname' => $short
            );


            if($this->input->post('action') == 'add'){
                $this->db->insert('tbl_party', $data1);
                $id = $this->db->insert_id();
            }
            else{
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('tbl_party', $data1);
            }

            $data2 = array(
                'id'            => $id,
                'registrarname' => $name,
                'primary'       => $lvl1,
                'elementary'    => $lvl2,
                'secondary'     => $lvl3,
                'tertiary'      => $lvl4
            );

            if($this->input->post('action') == 'add'){

                $this->db->insert('tbl_school', $data2);

                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Success! </strong> School successfully added!.
                    </div>

                ');
                redirect('/menu/registrar-sys_param/');
            }
            else{

                $data3 = array(
                    'registrarname' => $name,
                    'primary'       => $lvl1,
                    'elementary'    => $lvl2,
                    'secondary'     => $lvl3,
                    'tertiary'      => $lvl4
                );
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('tbl_school', $data3);

                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Success! </strong> School successfully updated!.
                    </div>

                ');

                redirect('/menu/registrar-sys_param/');
            }


        }
        else{
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Stop! </strong> School name already exist.
                </div>

            ');
            $_SESSION['data'] = $data;
            if ($this->input->post('id' == 'add')) {
                redirect('/menu/registrar-sys_param/');
            }
            else{
                redirect('/menu/registrar-sys_param/'.$this->input->post('id'));
            }
        }

    }

    function delete_school($id){
        $this->load->model('registrar/common');
        $query = $this->common->check_school($id);

        if($query == 0){
                $this->common->delete_school($id);

                $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Success! </strong> School successfully deleted!.
                    </div>

                ');
        }
        else{
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Unable to delete school still in use !.
                    </div>

                ');
        }
        redirect('/menu/registrar-sys_param/');
    }

    function registration($id = 0)
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->form_validation->set_rules('lastname', 'Lastname','required');
        $this->form_validation->set_rules('firstname', 'Firstname','required');
        $this->form_validation->set_rules('middlename', 'Middlename','required');
        $this->form_validation->set_rules('course', 'Course','required');
        $this->form_validation->set_rules('gender', 'Gender','required');
        // $this->form_validation->set_rules('religion', 'Religion','required');
        // nationality not found in tbl_party
        // $this->form_validation->set_rules('nationality', 'Nationality','required');
        // $this->form_validation->set_rules('dob', 'Date of Birth','required');
        // $this->form_validation->set_rules('pob', 'Place of Birth','required');
        // $this->form_validation->set_rules('mailadd', 'Mailing Address','required');
        // $this->form_validation->set_rules('father', 'Fathers Name','required');
        // $this->form_validation->set_rules('mother', 'Mothers Name','required');
        // $this->form_validation->set_rules('middlename', 'Middlename','required');
        // $this->form_validation->set_rules('username', 'Username','required');
        // $this->form_validation->set_rules('password', 'Password','required');
        // $this->form_validation->set_rules('rpass', 'Repeat Password','required');
        // $this->form_validation->set_rules('emailadd', 'Email Address', 'required');
        // $this->form_validation->set_rules('sid', 'Student Id', 'required');
        $d['error'] = '';

        if($this->form_validation->run() === FALSE)
        {
            if($id == 0 OR $this->input->post('firstname'))
            {
                $this->api->userMenu();
                $d['id']        = 0;
                $d['fname']     = set_value('firstname');
                $d['lname']     = set_value('lastname');
                $d['mname']     = set_value('middlename');
                                    // inline if statement
                $d['legacyid']  = ($this->input->post('sid')    ? $this->input->post('sid') : 0);
                $d['course']    = ($this->input->post('course') ? $this->input->post('course') : 0);
                $d['major']     = ($this->input->post('major')  ? $this->input->post('major') : 0);
                $this->load->view('registrar/newstudent_registration', $d);
                $this->load->view('templates/footer2');
            }
            else
            {
                //get the student id
                $this->db->where('id', $id);
                $p = $this->db->get('tbl_party')->row_array();

                $this->db->where('id', $id);
                $r = $this->db->get('tbl_registration')->row_array();

                $this->db->where('id', $r['coursemajor']);
                $c = $this->db->get('tbl_coursemajor')->row_array();

                //update/display only the important fields

                $l['id']        = $id;
                $l['fname']     = $p['firstname'];
                $l['lname']     = $p['lastname'];
                $l['mname']     = $p['middlename'];
                $l['legacyid']  = $p['legacyid'];
                $l['course']    = $c['course'];
                $l['major']     = $c['major'];
                $l['error']     = '';

                $this->api->userMenu();
                $this->load->view('registrar/newstudent_registration', $l);
                $this->load->view('templates/footer2');
            }
        }
        else
        {
            $email = $this->input->post('emailadd');
            if (filter_var($email, FILTER_VALIDATE_EMAIL) OR $this->input->post('emailadd') == NULL)
            {
                $data['firstname']      = ucwords($this->input->post('firstname'));
                $data['lastname']       = ucwords($this->input->post('lastname'));
                $data['middlename']     = ucwords($this->input->post('middlename'));
                $data['sex']            = $this->input->post('gender');
                $data['religion']       = $this->input->post('religion');
                $data['dateofbirth']    = $this->input->post('dob');
                $data['placeofbirth']   = ucwords($this->input->post('pob'));
                $data['emailaddress']   = $email;

                $this->db->insert('tbl_party', $data);
                $id = $this->db->insert_id();

                $systemVal              = $this->api->systemValue();
                $reg['coursemajor']     = $this->input->post('course');
                $reg['academicterm']    = $systemVal['currentacademcterm'];
                $reg['datecreated']     = date('Y-m-d');
                $reg['dateverified']    = date('Y-m-d');
                $reg['student']         = $id;
                $this->db->insert('tbl_registration', $reg);

                redirect(base_url('registration'));
            }
            else
            {
                // send a invalid email error
                $d['error'] = '<div class="alert alert-danger center-block" style="max-width:400px;">
            					Invalid email address
            				</div>';
                $d['id']        = 0;
                $d['fname']     = set_value('firstname');
                $d['lname']     = set_value('lastname');
                $d['mname']     = set_value('middlename');
                                    // inline if statement
                $d['legacyid']  = ($this->input->post('sid')    ? $this->input->post('sid') : 0);
                $d['course']    = ($this->input->post('course') ? $this->input->post('course') : 0);
                $d['major']     = ($this->input->post('major')  ? $this->input->post('major') : 0);
                $this->api->userMenu();
                $this->load->view('registrar/newstudent_registration', $d);
                $this->load->view('templates/footer2');
            }

        }
    }

    function find_stu()
    {
        $this->db->where('legacyid', $this->input->post('student_search'));
        $r = $this->db->get('tbl_party')->row_array();
        redirect('/registration/'.$r['id']);
    }

}
