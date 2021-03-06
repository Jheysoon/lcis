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
    // @deprecated move this function to Search class
    // retain only for backward compatibility
    function search_by_id($id)
    {
        $this->load->model('registrar/party');

        // clean the url since the request is a get method
        $id         = urldecode($id);
        $data       = array();
        $results_id = $this->party->searchId($id);
        $stat       = $this->session->userdata('status');

        foreach ($results_id as $r) {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
        }

        echo json_encode($data);
    }

    // @deprecated move this function to Search class
    // retain only for backward compatibility
    function search_forpayment($id)
    {
        $this->load->model('registrar/party');
        $id         = urldecode($id);
        $data       = array();
        $results_id = $this->party->search_pay($id);

        foreach ($results_id as $r) {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
        }

        echo json_encode($data);
    }

    // @deprecated move this function to Search class
    // retain only for backward compatibility
    function search_sub($txt)
    {
        $txt    = urldecode($txt);
        $data   = array();
        $r      = $this->db->query("SELECT name, descriptivetitle FROM tbl_subject
                    WHERE code LIKE '%$txt%'
                    OR descriptivetitle LIKE '%$txt%'
                    ORDER BY code LIMIT 10 ")->result_array();

        foreach ($r as $rr) {
            $data[] = array('value' =>  $rr['code'], 'name' => $rr['descriptivetitle']);
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

    public function insert_subject()
    {
        $data['code']               = strtoupper($this->input->post('code'));
        $data['descriptivetitle']   = strtoupper($this->input->post('descriptivetitle'));
        $data['units']              = $this->input->post('units');
        $data['own']                = $this->input->post('school_id');

        $where = "(code = {$data['code']} OR descriptivetitle = {$data['descriptivetitle']}) AND own = {$data['own']}";

        $this->db->where($where);
        $count = $this->db->count_all_results('tbl_subject');

        if ($count > 0) {
            $this->api->set_session_message('danger', 'Duplicate Subject Code Or Descriptivetitle', 'message1');
        } else {
            $this->db->insert('tbl_subject', $data);
            $this->api->set_session_message('success', 'Successfully Inserted', 'message1');
        }

        redirect('/rgstr_build/'.$this->input->post('legacyid').'#academic_wrapper');
    }

    function permanentRecord($id)
    {

        $this->load->model(array(
            'registrar/tor'
        ));

        $this->api->userMenu();

        $data['id'] = $id;
        $this->load->view('registrar/view_permanent_record', $data);
        $this->load->view('templates/footer');
    }

    function search()
    {
        $this->load->model('registrar/party');
        $id     = $this->input->post('search');
        $id1    = $this->party->existsID($id);

        if ($id1 > 0) {
            redirect('/rgstr_build/' . $id);
        } else {
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

        $data['subject']        = $subjid;
        $data['academicterm']   = $academicid;
        //$count = $this->classallocation->whereCount($data);

        // we can prevent user from entering duplicate subj within a academicterm but
        // the studentgrade table will be a mess
        // cause we will not create a new record in tbl_classallocation
        // just fetch the first record that is found
        $this->db->where('enrolment', $enrolmentid);
        $this->db->where('subject', $subjid);
        $q = $this->db->count_all_results('views_studentgrade');

        if ($q < 1) {
            $id = $this->classallocation->insert_ca_returnId($subjid, $academicid);

            if (is_numeric($id)) {
                $data['subj']           = $subjid;
                $data['grade_user']     = $grade;
                $data['enrolmentid']    = $enrolmentid;
                $data['academicterm']   = $academicid;
                $data['schoolid']       = $schoolid;
                $p                      = $this->enrollment->getID($enrolmentid);
                $this->log_student->insert_not_exists($p['student'],'E');
                $data['sid']            = $this->studentgrade->save_grade_returnId($id, $grade, $enrolmentid);
                $this->load->view('registrar/ajax/add_subject', $data);
            } else
                echo 'error';
        } else
            echo 'Subject Already exists';
    }

    function insert_flag()
    {
        $this->load->model(array(
            'registrar/common',
            'registrar/log_student'
        ));
        $partyid        = $this->input->post('partyid');
        $url            = $this->input->post('url');
        $flag_status    = $this->input->post('flag_status');

        $curtm = $this->log_student->getLatestTm($partyid);

        if ($flag_status == 'C') {
            $tm = $this->input->post('tm');

            if ($tm == $curtm) {
                $this->add_flag($partyid, $flag_status);
                $data['user']       = $this->session->userdata('uid');
                $data['dte']        = date('Y-m-d');
                $data['student']    = $partyid;
                $data['status']     = $flag_status;
                $data['tm']         = time();
                $this->db->insert('log_student');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">
                <h4>A update has been occurred before you submit.
                    Please review again and then submit</h4>
            </div>');
                redirect($url);
            }
        } else {
            $this->log_student->ins_stat($partyid, $flag_status);
            $this->add_flag($partyid, $flag_status);
        }
    }

    private function add_flag($partyid, $status)
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
        $val    = $this->input->post('val');
        $cat    = explode('_', $val);
        $i      = 0;

        foreach ($cat as $c) {
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

        if ($stat['status'] != 'S') {
            $this->log_student->insert_not_exists($q['student'], 'E');
            $this->studentgrade->update_grade($studgrade, $grade_id);
        } else
            echo 'This record is already submitted';
    }

    function delete_record()
    {
        $this->load->model(array(
            'registrar/studentgrade',
            'registrar/enrollment'
        ));

        $val        = $this->input->post('value');
        $cat        = explode('-', $val);
        $enrolid    = $cat[0];
        $studgrade  = $cat[1];
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
        if ($stat['status'] != 'S') {
            $count = $this->enrollment->whereCount($db);

            if ($count < 1) {
                $d['student']       = $partyid;
                $d['coursemajor']   = $cid;
                $d['academicterm']  = $syid;
                $this->registration->ins_not_exist($d);
                $this->log_student->insert_not_exists($partyid, 'E');
                $id = $this->enrollment->insert_return_id($data);
                $data['id'] = $id;
                $this->load->view('registrar/ajax/add_academicterm', $data);
            } else {
                echo 'Academic Term Already Exists';
            }
        } else {
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

        if ($stat['status'] != 'S') {
            $this->log_student->insert_not_exists($p['student'], 'E');
            $this->enrollment->delete_enroll($enrolmentid);

            // after the classallocation has been deleted
            // its time to deleted the subjects grade
            $this->studentgrade->delete($enrolmentid);
        } else {
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

        if ($stat['status'] != 'S') {
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

        if ($stat['status'] != 'S') {
            $grade_id               = $this->input->post('grad');
            $data['enrolmentid']    = $enrol_id;
            $data['sid']            = $this->input->post('stugrade');

            $this->studentgrade->update_grade($data['sid'],$grade_id);
            $this->log_student->insert_not_exists($pid, 'E');
            $this->load->view('registrar/ajax/re_exam',$data);
        } else {
            echo 'This record is already submitted';
        }
    }

    function update_studinfo()
    {
        //update in tbl_party
        $partyid    = $this->input->post('partyid');
        $firstname  = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $lastname   = $this->input->post('lastname');
        $dob        = $this->input->post('dob');
        $pob        = $this->input->post('pob');
        $address1   = $this->input->post('address1');
        $address2   = $this->input->post('address2');

       //update in tbl_student
        $primary        = $this->input->post('primary');
        $elementary     = $this->input->post('elementary');
        $highschool     = $this->input->post('highschool');
        $primaryyear    = $this->input->post('primaryyear');
        $elementaryyear = $this->input->post('elementaryyear');
        $highschoolyear = $this->input->post('highschoolyear');

        //latest registration to be updated
        $url            = $this->input->post('url');
        $course         = $this->input->post('course');
        $dateregistered = $this->input->post('dateregistered');
        $dor            = $this->input->post('dor');
        $dat = date('Y');

        $start  = new DateTime($dob);
        $end    = new DateTime(date('Y-m-d'));
        $dDiff  = $start->diff($end);
        $dif    = $dDiff->format('%Y');
        $alerts = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $suc    = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';

        if ($dif < 10) {
            $this->session->set_flashdata('message', $alerts . 'Invalid Date of Birth.</div>');
        } elseif ($pob == '') {
            $this->session->set_flashdata('message',  $alerts . 'Please Fill-up Place of Birth</div>');
        } elseif ($address1 == '') {
            $this->session->set_flashdata('message',  $alerts . 'Please Fill-up Address</div>');
        } elseif ($elementary == '' OR $elementary == 'Select') {
            $this->session->set_flashdata('message',  $alerts . 'Please Select First Elementary School</div>');
        } elseif ($primary == '' OR $primary == 'Select') {
            $this->session->set_flashdata('message',  $alerts . 'Please Select First Primary School</div>');
        } elseif ($highschool == '' OR $highschool == 'Select') {
            $this->session->set_flashdata('message', $alerts . 'Please Select First High School</div>');
        } elseif ($primaryyear == '' OR $primaryyear > $dat) {
            $this->session->set_flashdata('message',  $alerts . 'Please Select First Year of Completion in Primary School</div>');
        } elseif ($elementaryyear == '' OR $elementaryyear > $dat) {
            $this->session->set_flashdata('message', $alerts . 'Please Select First Year of Completion in Elementary School</div>');
        } elseif ($highschoolyear == '' OR $highschoolyear > $dat) {
            $this->session->set_flashdata('message', $alerts . 'Please Select First Year of Completion in High School</div>');
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-success">'. $suc . 'Information Successfuly Saved.</div>');
            $data = array(
                'firstname'     => $firstname,
                'middlename'    => $middlename,
                'lastname'      => $lastname,
                'dateofbirth'   => $dob,
                'placeofbirth'  => $pob,
                'address1'      => $address1,
                'address2'      => $address2,
            );
            $this->db->where('id', $partyid);
            $this->db->update('tbl_party', $data);

            $data2 = array(
                'primary'               => $primary,
                'elementary'            => $elementary,
                'secondary'             => $highschool,
                'completionprimary'     => $primaryyear,
                'completionelementary'  => $elementaryyear,
                'completionsecondary'   => $highschoolyear
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
            'firstname'             => $firstname,
            'middlename'            => $middlename,
            'lastname'              => $lastname,
            'dob'                   => $dob,
            'pob'                   => $pob,
            'address1'              => $address1,
            'address2'              => $address2,
            'primary'               => $primary,
            'elementaryss'          => $elementary,
            'secondary'             => $highschool,
            'completionprimary'     => $primaryyear,
            'completionelementary'  => $elementaryyear,
            'completionsecondary'   => $highschoolyear
        );
        $_SESSION['infos'] = $x;
        // print_r($_SESSION['infos']);
        redirect('/rgstr_build/' . $url);
    }

    function add_school()
    {
        if ($this->input->post('ajax')) {
            $msg = 'message1';
        }
        else{
            $msg = 'message';
        }
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


            if ($this->input->post('action') == 'add') {
                $this->db->insert('tbl_party', $data1);
                $id = $this->db->insert_id();
            } else {
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

                $this->session->set_flashdata($msg, '
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Success! </strong> School successfully added!.
                    </div>

                ');

                if ($this->input->post('ajax')) {
                    redirect('/rgstr_build/'.$this->input->post('student').'#academic_wrapper');
                }
                else{
                    redirect('/menu/registrar-sys_param/');
                }
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

                $this->session->set_flashdata($msg, '
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Success! </strong> School successfully updated!.
                    </div>

                ');

                redirect('/menu/registrar-sys_param/');
            }


        }
        else{
            $this->session->set_flashdata($msg, '
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Stop! </strong> School name already exist.
                </div>

            ');
            $_SESSION['data'] = $data;
            if ($this->input->post('action') == 'add') {
                if ($this->input->post('ajax')) {
                    redirect('/rgstr_build/'.$this->input->post('student').'#academic_wrapper');
                }
                else{
                    redirect('/menu/registrar-sys_param/');
                }
            }
            else{
                redirect('/menu/registrar-sys_param/'.$this->input->post('id'));
            }
        }

    }

    function delete_school($id)
    {
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

    function search_student_det($sid)
    {
        $sid = urldecode($sid);
        $this->load->model(array(
            'registrar/tor'
        ));
        $s          = $this->tor->getStudent($sid);
        $data       = array();

        foreach ($s as $r)
        {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['lastname'].' '.$r['firstname']);
        }
        echo json_encode($data);
    }

    function tor($sid = '')
    {
        $sid = array('sid' => $sid);
        $this->load->model('registrar/tor');
        $this->load->view('registrar/tor_preview', $sid);
    }

    function tor_preview()
    {
        redirect('/registrar_tor/'.$this->input->post('search'));
    }

    // this function will be for the new student registration
    function registration()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $field = array(
                    'lastname'      => 'Lastname',
                    'firstname'     => 'Firstname',
                    'middlename'    => 'Middlename',
                    'course'        =>'Course',
                    'gender'        =>'Gender',
                    'religion'      =>'Religion',
                    'dob'           =>'Date of Birth',
                    'mailadd'       =>'Mailing Address',
                    'username'      => 'Username',
                    'password'      =>'Password',
                    'rpass'         =>'Repeat Password',
                    'emailadd'      =>'Email Address'
                );

        foreach ($field as $key => $value) {
            $this->form_validation->set_rules($key, $value, 'required');
        }
        // nationality not found in tbl_party
        //$this->form_validation->set_rules('nationality', 'Nationality','required');
        $d['error'] = '';

        if ($this->form_validation->run() === FALSE) {
            $this->api->userMenu();
            $d['fname']     = set_value('firstname');
            $d['lname']     = set_value('lastname');
            $d['mname']     = set_value('middlename');
            $d['legacyid']  = ($this->input->post('sid')    ? $this->input->post('sid') : 0);
            $d['course']    = ($this->input->post('course') ? $this->input->post('course') : 0);
            $this->load->view('registrar/newstudent_registration', $d);
            $this->load->view('templates/footer2');
        } else {
            $email = $this->input->post('emailadd');
            //check if the email add is valid
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $password = $this->input->post('password');

                // check if the password and repeat password is equal
                if ($password == $this->input->post('rpass')) {
                    $this->db->trans_begin();
                    $systemVal              = $this->api->systemValue();
                    $data['firstname']      = ucwords($this->input->post('firstname'));
                    $data['lastname']       = ucwords($this->input->post('lastname'));
                    $data['middlename']     = ucwords($this->input->post('middlename'));
                    $data['sex']            = $this->input->post('gender');
                    $data['religion']       = $this->input->post('religion');
                    $data['dateofbirth']    = $this->input->post('dob');
                    $data['placeofbirth']   = ucwords($this->input->post('pob'));
                    $data['emailaddress']   = $email;
                    //check if the legacyid exists
                    $stud_id                = $this->student_id($systemVal['laststudentid']);
                    $data['legacyid']       = $stud_id;

                    $this->db->insert('tbl_party', $data);
                    $id = $this->db->insert_id();

                    // update the laststudent id in systemvalues
                    $lid = explode('-', $stud_id);
                    $inc = $lid[1] + 1;
                    $sys['laststudentid'] = $lid[0].'-'.$inc;
                    $this->db->update('tbl_systemvalues', $sys);

                    // get the coursemajor
                    $course_m = $this->input->post('course');

                    // get the latest curriculum for that student
                    $reg['coursemajor']     = $course_m;
                    $reg['academicterm']    = $systemVal['currentacademicterm'];
                    $reg['datecreated']     = date('Y-m-d');
                    $reg['date']            = date('Y-m-d');
                    $reg['student']         = $id;
                    $reg['curriculum']      = $this->get_current_curriculum($course_m, $systemVal['currentacademicterm']);
                    $reg['status']          = 'E';
                    $this->db->insert('tbl_registration', $reg);

                    $acc['partyid']  = $id;
                    $acc['username'] = $this->input->post('username');
                    $acc['password'] = password_hash($password, PASSWORD_BCRYPT);
                    $this->db->insert('tbl_useraccess', $acc);


                    // insert into tbl_student
                    $stud['id']                 = $id;
                    $stud['fathername']         = $this->input->post('father');
                    $stud['fatherproffesion']   = $this->input->post('occupation');
                    $stud['mothername']         = $this->input->post('mother');
                    $stud['motherproffesion']   = $this->input->post('moccupation');
                    $this->db->insert('tbl_student', $stud);

                    // insert tbl_account, useroption
                    $name = $data['firstname'].' '.$data['lastname'];
                    $this->insert_account($id, $name);

                    $menu = array(
                        'optionid'  => STUD_MENU_GRADES,
                        'optionid'  => STUD_MENU_BILL,
                        'userid'    => $id,
                        'userid'    => $id
                    );

                    $this->db->insert('tbl_useroption', $menu);

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                    }

                    redirect(base_url('take_photo/'.$id));
                } else {
                    $error = '<div class="alert alert-danger center-block" style="max-width:400px;">
                                    Password and Re-peat password did not match
                                </div>';
                    $this->error_reg($error);
                }
            } else {
                // send a invalid email error
                $error = '<div class="alert alert-danger center-block" style="max-width:400px;">
                                Invalid email address
                            </div>';
                $this->error_reg($error);
            }
        }
    }

    function get_current_curriculum($coursemajor, $systart)
    {
        $cur1       = 0;
        $acamd      = $this->db->query("SELECT * FROM `tbl_academicterm` WHERE systart <= $systart ORDER BY systart DESC,term")->result_array();

        foreach ($acamd as $acams) {
            $c = $this->db->query("SELECT id FROM tbl_curriculum WHERE coursemajor = $coursemajor AND academicterm = {$acams['id']}");

            if ($c->num_rows() > 0) {
                $cur    = $c->row_array();
                $cur1   = $cur['id'];
                break;
            }
        }

        if ($cur1 == 0) {
            $cur    = $this->db->query("SELECT * FROM tbl_curriculum a,tbl_academicterm b WHERE coursemajor = $coursemajor and b.id = a.academicterm ORDER BY b.systart DESC LIMIT 1 ")->row_array();
            $cur1   = $cur['id'];
        }

        return $cur1;
    }

    function student_id($id)
    {
        $value  = $id;
        $this->db->where('legacyid', $value);
        $c      = $this->db->count_all_results('tbl_party');

        while ($c > 0) {
            $value += 1;
            $this->db->where('legacyid', $value);
            $c = $this->db->count_all_results('tbl_party');
        }

        return $value;
    }

    function error_reg($error)
    {
        $d['error']     = $error;
        $d['id']        = 0;
        $d['fname']     = set_value('firstname');
        $d['lname']     = set_value('lastname');
        $d['mname']     = set_value('middlename');
                            // inline if statement
        $d['legacyid']  = ($this->input->post('sid')    ? $this->input->post('sid') : 0);
        $d['course']    = ($this->input->post('course') ? $this->input->post('course') : 0);
        $this->api->userMenu();
        $this->load->view('registrar/newstudent_registration', $d);
        $this->load->view('templates/footer2');
    }

    function take_photo($id = '')
    {
        if ( ! empty($id) ) {
            $this->api->userMenu();
            $data['id'] = $id;
            $this->db->where('id', $id);
            $this->db->select('legacyid');
            $r = $this->db->get('tbl_party')->row_array();
            $data['student_id'] = $r['legacyid'];
            $this->load->view('registrar/take_photo', $data);
            $this->load->view('templates/footer2');
        } else
            show_error('Did you type the url by yourself ?');
    }

    function save_photo()
    {
        $id     = $this->input->post('id');
        $image  = $this->input->post('image');
        $bin    = base64_decode($image);
        $result = file_put_contents('./assets/images/profile/'.$id.'.jpg', $bin);

        if (!$result) {
            die('Could not save image! Check file permissions.');
        } else {
            $d['pic'] = $id.'.jpg';
            $this->db->where('id', $id);
            $this->db->update('tbl_party', $d);
            redirect(base_url('registration'));
        }
    }

    function find_stu()
    {
        $this->db->where('legacyid', $this->input->post('student_search'));
        $this->db->select('id');
        $r = $this->db->get('tbl_party')->row_array();
        redirect('/update_registration/'.$r['id']);
    }

    function update_reg($id)
    {
        $this->load->model('registrar/registration');
        $this->load->helper('form');
        $this->db->where('student', $id);
        $this->db->where('status', 'E');
        $tt = $this->db->count_all_results('tbl_registration');

        if ($tt < 1) {
            $data['id'] = $id;
            $this->db->where('id', $id);
            $this->db->select('firstname,lastname,middlename,placeofbirth,dateofbirth,emailaddress,legacyid,sex');
            $p = $this->db->get('tbl_party')->row_array();
            $data['fname']      = $p['firstname'];
            $data['lname']      = $p['lastname'];
            $data['mname']      = $p['middlename'];
            $data['pob']        = $p['placeofbirth'];
            $data['dob']        = $p['dateofbirth'];
            $data['emailadd']   = $p['emailaddress'];
            $data['error']      = '';
            $data['legacyid']   = $p['legacyid'];
            $data['gender']     = $p['sex'];

            $t              = $this->registration->getLatestCM($id);
            $tt             = $this->db->get_where('tbl_coursemajor', array('id' => $t['coursemajor']))->row_array();
            $data['course'] = $tt['course'];
            $data['major']  = $tt['major'];

            $this->api->userMenu();
            $this->load->view('registrar/update_registration', $data);
        }
        else
            $this->set_error('Cannot open status is pending', 'menu/registrar-update_student');
    }

    function form_update_reg()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('middlename', 'Middlename', 'required');
        $this->form_validation->set_rules('pob', 'Place of Birth', 'required');
        $this->form_validation->set_rules('mailadd', 'Mailing Address', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['id']         = set_value('id');
            $data['fname']      = set_value('fname');
            $data['lname']      = set_value('lname');
            $data['mname']      = set_value('mname');
            $data['pob']        = set_value('pob');
            $data['dob']        = set_value('dob');
            $data['emailadd']   = set_value('emailadd');
            $data['error']      = '';
            $data['legacyid']   = set_value('legacyid');
            $data['gender']     = set_value('gender');
            $data['course']     = set_value('course');
            $data['major']      = set_value('major');
            $this->api->userMenu();
            $this->load->view('registrar/update_registration', $data);
        } else {
            $this->load->model('registrar/registration');
            $t['firstname']     = ucwords($this->input->post('firstname'));
            $t['lastname']      = ucwords($this->input->post('lastname'));
            $t['middlename']    = ucwords($this->input->post('middlename'));
            $t['placeofbirth']  = ucwords($this->input->post('pob'));
            $t['dateofbirth']   = $this->input->post('dob');
            $t['sex']           = $this->input->post('gender');
            $t['emailaddress']  = $this->input->post('emailadd');
            $id                 = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update('tbl_party', $t);
            $p = $this->registration->getLatestCM($id);

            // update the tbl_registration status
            $this->ch_stat_reg($p['id']);
            $this->api->set_session_message('success', 'Successfully Updated');
            redirect('/menu/registrar-update_student');
        }
    }

    function ch_stat_reg($reg_id, $stat = 'E')
    {
        $this->db->where('id', $reg_id);
        $i['status'] = $stat;
        $this->db->update('tbl_registration', $i);
    }

    function find_shift()
    {
        $this->db->where('legacyid', $this->input->post('student_search'));
        $this->db->select('id');
        $r = $this->db->get('tbl_party')->row_array();
        redirect('/shiftee/'.$r['id']);
    }

    function shiftee_form()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('middlename', 'Middlename', 'required');

        if ($this->form_validation->run() == FALSE) {
            $d['course']    = $this->input->post('course');
            $this->load->view('registrar/shiftee', $d);
        } else {

            $t                  = $this->db->get('tbl_coursemajor')->row_array();
            $r['student']       = $this->input->post('id');
            $r['coursemajor']   = $this->input->post('course');
            $systemVal          = $this->api->systemValue();
            $r['academicterm']  = $systemVal['currentacademicterm'];
            $r['curriculum']    = $this->get_current_curriculum($this->input->post('course'), $systemVal['currentacademicterm']);
            $r['createdby']     = $this->session->userdata('uid');
            $r['datecreated']   = date('Y-m-d');
            $this->db->insert('tbl_registration', $r);
            $this->ch_stat_reg($this->db->insert_id());
            redirect('/menu/registrar-shift_student');
        }
    }

    function shiftee($id = '')
    {
        if (!empty($id)) {
            $systemVal = $this->api->systemValue();

            if ($systemVal['phase'] == ENR) {
                $this->load->helper('form');
                $this->db->where('status', 'E');
                $this->db->where('student', $id);
                $rr = $this->db->count_all_results('tbl_registration');

                if ($rr < 1) {
                    $this->load->model('registrar/registration');
                    $this->db->where('id', $id);
                    $this->db->select('firstname,middlename,lastname,legacyid');
                    $p                  = $this->db->get('tbl_party')->row_array();
                    $data['firstname']  = $p['firstname'];
                    $data['lastname']   = $p['lastname'];
                    $data['middlename'] = $p['middlename'];
                    $data['legacyid']   = $p['legacyid'];

                    $r = $this->registration->getLatestCM($id);

                    $this->db->where('id', $r['coursemajor']);
                    $this->db->select('course');
                    $c = $this->db->get('tbl_coursemajor')->row_array();

                    $data['id']     = $id;
                    $data['course'] = $c['course'];
                    $this->api->userMenu();
                    $this->load->view('registrar/shiftee', $data);
                    $this->load->view('templates/footer');
                } else {
                    $this->set_error('Cannot open status is pending','menu/registrar-shift_student');
                }
            } else {
                show_error('Phase term is not enrollment');
            }
        } else {
            show_error('Did you type the url by yourself ?');
        }
    }

    function pending_reg($id)
    {
        $this->load->model(array(
            'registrar/registration',
            'registrar/course')
        );
        $data['id'] = $id;
        $p = $this->registration->getLatestCM($id);
        $this->db->where('id', $p['student']);
        $pp                 = $this->db->get('tbl_party')->row_array();
        $data['fname']      = $pp['firstname'];
        $data['lname']      = $pp['lastname'];
        $data['mname']      = $pp['middlename'];
        $data['gender']     = $pp['sex'];
        $data['legacyid']   = $pp['legacyid'];
        $data['pob']        = $pp['placeofbirth'];
        $data['cid']        = $p['coursemajor'];
        $data['reg']        = $p['id'];
        $this->api->userMenu();
        $this->load->view('registrar/pending_reg', $data);
        $this->load->view('templates/footer');
        // load the students info
    }

    function approve()
    {
        $t['status']        = 'A';
        $t['dateverified']  = date('Y-m-d');
        $this->db->where('id', $this->input->post('reg_id'));
        $this->db->update('tbl_registration', $t);
        $this->api->set_session_message('success', 'Successfully updated');
        redirect('/menu/registrar-pending_registration');
    }

    function disapprove($id)
    {
        $t['status'] = 'D';
        $this->db->where('id', $id);
        $this->db->update('tbl_registration', $t);
        redirect('/menu/registrar-pending_registration');
    }

    function set_error($message, $back)
    {
        $data['back']       = $back;
        $data['message']    = $message;
        $this->api->userMenu();
        $this->load->view('registrar/error_message', $data);
    }

    function print_fields($sid)
    {
        $arr = array('sid' => $sid );
        $this->load->model('registrar/tor');
        $this->load->view('templates/header');
        $this->load->view('templates/header_title1');
        $this->load->view('registrar/print_fields',$arr);
        $this->load->view('templates/footer');
    }

    function set_print_for($sid, $for)
    {
        $this->session->set_userdata('for', $for);
        redirect(base_url('registrar_tor/'.$sid));
    }

    function updateFields()
    {
        $this->load->model('registrar/tor');

        $f11 = $this->input->post('f-1-1');
        $f12 = $this->input->post('f-1-2');
        $this->tor->updateFields($f11, $f12, 1);
        $f21 = $this->input->post('f-2-1');
        $f22 = $this->input->post('f-2-2');
        $this->tor->updateFields($f21, $f22, 2);
        $f31 = $this->input->post('f-3-1');
        $f32 = $this->input->post('f-3-2');
        $this->tor->updateFields($f31, $f32, 3);
        $f41 = $this->input->post('f-4-1');
        $f42 = $this->input->post('f-4-2');
        $this->tor->updateFields($f41, $f42, 4);

        $order_title   = $this->input->post('order_title');
        $order         = $this->input->post('order');
        $series        = $this->input->post('series');
        $remarks       = $this->input->post('remarks');

        $fields = array(
            'order_title' => $order_title,
            'order_no'    => $order,
            'series'      => $series,
            'remarks'     => $remarks
        );

        $this->session->set_userdata('fields', $fields);

        $sid = $this->input->post('sid');

        redirect('/registrar_tor/'.$sid);
    }

    function legacy_matching()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tbl_subject', 'Subject', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('legacy_matching');
        } else {
            $legacy = $this->input->post('legacy');

            foreach ($legacy as $c) {
                $data['subject_id'] = $this->input->post('tbl_subject');
                $this->db->where('grouping', $c);
                $this->db->update('tbl_enrolment_legacy', $data);
            }

            $this->load->view('legacy_matching');
        }

    }

    function insert_account($partyid, $name)
    {
        $data = array('party' => $partyid, 'accounttype' => 4, 'seq' => 0, 'ccy' => 1, 'description' => $name);
        $this->db->insert('tbl_account', $data);
    }

    function register()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('student_id', 'Student ID', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('course', 'Course', 'required');
        $this->form_validation->set_rules('academicterm', 'Academicterm', 'required');

        $courseMajor = $this->db->get('tbl_coursemajor')->result();

        if ($this->form_validation->run() === false) {
            $this->api->userMenu();
            $data['error']          = '';
            $data['coursemajors']   = $courseMajor;
            $this->load->view('registrar/register', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->where('legacyid', $this->input->post('student_id'));
            $c = $this->db->count_all_results('tbl_party');

            if ($c > 0) {
                $this->api->userMenu();
                $data['error']          = '<div class="alert alert-danger">Student ID Already Exists</div>';
                $data['coursemajors']   = $courseMajor;
                $this->load->view('registrar/register', $data);
                $this->load->view('templates/footer');
            } else {
                $this->db->trans_begin();

                $course_m = $this->input->post('course');

                $d['firstname']     = strtoupper($this->input->post('firstname'));
                $d['lastname']      = strtoupper($this->input->post('lastname'));
                $d['middlename']    = strtoupper($this->input->post('middlename'));
                $d['legacyid']      = $this->input->post('student_id');
                $d['partytype']     = 3;
                $this->db->insert('tbl_party', $d);
                $id = $this->db->insert_id();

                $student['id'] = $id;
                $this->db->insert('tbl_student', $student);

                $data['student']        = $id;
                $data['coursemajor']    = $course_m;
                $data['academicterm']   = $this->input->post('academicterm');
                $data['date']           = date('Y-m-d');

                $this->db->where('id', $this->input->post('academicterm'));
                $acam_id = $this->db->get('tbl_academicterm')->row();

                $data['curriculum']     = $this->get_current_curriculum($course_m, $acam_id->systart);
                $data['status']         = 'A';
                $this->db->insert('tbl_registration', $data);

                $menu = array(
                    'optionid'  => STUD_MENU_GRADES,
                    'optionid'  => STUD_MENU_BILL,
                    'userid'    => $id,
                    'userid'    => $id
                );

                $this->db->insert('tbl_useroption', $menu);

                if ($this->db->trans_status() === FALSE) {
                     $this->db->trans_rollback();
                     $this->session->set_flashdata('message', '<div class="alert alert-danger text-center">Something Went Wrong</div>');
                } else {
                    $this->db->trans_commit();
                    $this->insert_account($id, $d['firstname'].' '.$d['lastname']);
                    $this->session->set_flashdata('message', '<div class="alert alert-success text-center">Successfully Registered</div>');
                }

                redirect('/register');
            }
        }
    }
}
