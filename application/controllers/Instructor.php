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
            $data['name'] = $this->db->get('tbl_party')->row_array();
            $data['systemVal'] = $this->api->systemValue();
            $where = array(
                        'academicterm'  => $data['systemVal']['currentacademicterm'],
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
    function load_enrolment()
    {
        $template = '';
         $template .= '<table>
                        <tr>
                            <td style="border:1px solid black">IDNO</td>
                            <td style="border:1px solid black">Party ID</td>
                            <td style="border:1px solid black">Start</td>
                            <td style="border:1px solid black">End</td>
                            <td style="border:1px solid black">COURSE</td>
                            <td style="border:1px solid black">SCH_YR</td>
                            <td style="border:1px solid black">Semester</td>
                            <td style="border:1px solid black">Coursemajor</td>
                            <td style="border:1px solid black">School</td>
                            <td style="border:1px solid black">Total Unit</td>
                            <td style="border:1px solid black">Total Subject</td>
                            <td style="border:1px solid black">Date Enrolled</td>
                            <td style="border:1px solid black">Registration ID</td>
                            <td style="border:1px solid black">Academicterm</td>
                            <td style="text-align:center;border:1px solid black">NAME</td>
                        </tr>
        ';
        $x = $this->db->query("SELECT * FROM tbl_enrolment_legacy GROUP by SCH_YR, SEMESTER, IDNO, COURSE")->result_array();
        foreach ($x as $key => $value) {
            extract($value);
            $a = explode('-', $SCH_YR);


            if($COURSE == 'BSOA' OR $COURSE == 'BSC')
            {
                $coursemajor = 7;
            }
            elseif ($COURSE == 'BEED') {
                $coursemajor = 18;
            }
            elseif ($COURSE == 'BSA') {
                $coursemajor = 21;
            }
            elseif ($COURSE == 'BSBA') {
                // for temporary
                $coursemajor = 25;
            }
            elseif ($COURSE == 'BSCRIM') {
                $coursemajor = 5;
            }
            elseif ($COURSE == 'BEED') {
                $coursemajor = 18;  
            }
            elseif ($COURSE == 'LLB')
            {
                $coursemajor = 6;
            }
            elseif ($COURSE == 'BSED')
            {
                $coursemajor = 17;
            }
            elseif ($COURSE == 'AB') {
                $coursemajor = 16;
            }
            else{
                $coursemajor = 0;
            }


            $sub        = $this->db->query("SELECT SUM(units) as totalunit, COUNT(IDNO) as totalsub FROM tbl_enrolment_legacy WHERE SEMESTER = '$SEMESTER' AND SCH_YR = '$SCH_YR' AND IDNO = '$IDNO'")->row_array();
            $p          = $this->db->get_where('tbl_party', array('legacyid' => $IDNO))->row_array();
            $st = $p['id'];
            $start = $a[0];
            $end = $a[1];
            $reg        = $this->db->query("SELECT id FROM tbl_registration WHERE student = '$st' AND coursemajor = '$coursemajor'")->row_array();
            $acad       = $this->db->query("SELECT id FROM tbl_academicterm WHERE systart = '$start' AND  syend = '$end' AND term = '$SEMESTER'")->row_array();
            $template .= '<tr>

                            <td style="width:100px;border:1px solid black">'.$IDNO.'</td>
                            <td style="width:100px;border:1px solid black">'.$p['id'].'</td>
                            <td style="width:100px;border:1px solid black">'.$a[0].'</td>
                            <td style="width:100px;border:1px solid black">'.$a[1].'</td>
                            <td style="width:100px;border:1px solid black">'.$COURSE.'</td>
                            <td style="width:100px;border:1px solid black">'.$SCH_YR.'</td>
                            <td style="width:100px;border:1px solid black">'.$SEMESTER.'</td>
                            <td style="width:100px;border:1px solid black">'.$coursemajor.'</td>
                            <td style="width:100px;border:1px solid black">1</td>
                            <td style="width:100px;border:1px solid black">'.$sub['totalunit'].'</td>
                            <td style="width:100px;border:1px solid black">'.$sub['totalsub'].'</td>
                            <td style="width:100px;border:1px solid black">'.$DATE_ENROL.'</t>
                            <td style="width:100px;border:1px solid black">'.$reg['id'].'</td>
                            <td style="width:100px;border:1px solid black">'.$acad['id'].'</td>
                            <td style="width:300px;text-align:justify;border:1px solid black">'.$LNAME.' , '.$FNAME.'</td>
                        </tr>';
         $data = array('student' => $p['id'], 'registration' => $reg['id'], 
                       'coursemajor' => $coursemajor, 'school' => 1, 
                       'academicterm' => $acad['id'], 'numberofsubject' =>  $sub['totalsub'],
                       'totalunit' => $sub['totalunit'], 'dte' => $DATE_ENROL);
       $this->db->insert('tbl_enrolment', $data);
        }
       echo $template;
    }
}
