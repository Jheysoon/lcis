<?php

class Test_dean extends CI_Controller
{
	// --------------------------------------------------------------------------------------

    function create_reg()
    {
        $leg = $this->db->query("SELECT * FROM tbl_enrolment_legacy
                        GROUP BY IDNO , COURSE ORDER BY SCH_YR,SEMESTER")->result_array();

        $template = '';
        $template .= '<table>
                        <tr>
                            <td>Party ID</td>
                            <td>Academicterm</td>
                            <td>Date</td>
                            <td>COURSE</td>
                            <td>SCH_YR</td>
                            <td>Semester</td>
                            <td>Curriculum</td>
                            <td>Coursemajor</td>
                            <td style="text-align:center">NAME</td>
                        </tr>
        ';
        foreach($leg as $legacy)
        {
            $semester   = ($legacy['SEMESTER'] == 'S') ? '3' : $legacy['SEMESTER'];
            $year       = explode('-', $legacy['SCH_YR']);
            $s          = explode('/', $legacy['DATE_ENROL']);
            $s1         = explode('-', $legacy['IDNO']);
            $d          = '';
            $p          = $this->db->get_where('tbl_party', array('legacyid' => $legacy['IDNO']))->row_array();
            $systart = '';
            $syend = '';
            if($s1[0] == $s[2])
            {
                $d          = $s[2].'-'.$s[1].'-'.$s[0];
                $systart = $year[0];
                $syend = $year[1];
                //$sy         = $this->db->get_where('tbl_academicterm', array('systart' => $year[0], 'syend' => $year[1], 'term' => $semester))->row_array();
            }
            else
            {

                $this->db->where('student', $p['id']);
                $i = $this->db->count_all_results('tbl_registration');
                if($i > 0)
                {
                    $d          = $s[2].'-'.$s[1].'-'.$s[0];
                    $systart = $s[2];
                    $syend = $systart + 1;
                }
                else {
                    if($semester == 1){
                        $d = $s1[0].'-06-01';
                    }
                    elseif($semester == 2){
                        $d = $s1[0].'-11-01';
                    }

                    else{
                        $d = $s1[0].'-04-01';
                    }
                    $systart = $s1[0];
                    $syend = $systart + 1;
                }
            }

            $sy    = $this->db->get_where('tbl_academicterm', array('systart' => $systart, 'syend' => $syend, 'term' => $semester))->row_array();

            if($legacy['COURSE'] == 'BSOA' OR $legacy['COURSE'] == 'BSC')
            {
                $coursemajor = 7;
            }
            elseif ($legacy['COURSE'] == 'BEED') {
                $coursemajor = 18;
            }
            elseif ($legacy['COURSE'] == 'BSA') {
                $coursemajor = 21;
            }
            elseif ($legacy['COURSE'] == 'BSBA') {
                // for temporary
                $coursemajor = 19;
            }
            elseif ($legacy['COURSE'] == 'BSCRIM') {
                $coursemajor = 5;
            }
            elseif ($legacy['COURSE'] == 'LLB')
            {
                $coursemajor = 6;
            }
            elseif($legacy['COURSE'] == 'AB')
            {
                $coursemajor = 16;
            }

            $acamd  = $this->db->query("SELECT * FROM `tbl_academicterm` WHERE systart <= $systart ORDER BY systart DESC,term")->result_array();

            $cur1 = 0;
            if($legacy['COURSE'] == 'BSED')
            {
                $coursemajor = 17;
                $cur1 = 55;
            }
            else {
                foreach($acamd as $acams)
                {
                    $c = $this->db->query("SELECT id FROM tbl_curriculum WHERE
                        coursemajor = $coursemajor AND academicterm = {$acams['id']}");
                    if($c->num_rows() > 0)
                    {
                        $cur    = $c->row_array();
                        $cur1   = $cur['id'];
                        break;
                    }
                }
            }

            if($cur1 == 0)
            {
                if($coursemajor == 21)
                {
                    $cur1 = 0;
                }
                else {
                    $cur = $this->db->query("SELECT * FROM tbl_curriculum a,tbl_academicterm b WHERE coursemajor = $coursemajor and b.id = a.academicterm ORDER BY b.systart ASC LIMIT 1 ")->row_array();
                    $cur1 = $cur['id'];
                }

            }

            $template .= '<tr>
                            <td style="width:100px;">'.$p['id'].'</td>
                            <td style="width:100px;">'.$sy['id'].'</td>
                            <td style="width:100px;">'.$d.'</td>
                            <td style="width:100px;">'.$legacy['COURSE'].'</td>
                            <td style="width:100px;">'.$legacy['SCH_YR'].'</td>
                            <td style="width:100px;">'.$legacy['SEMESTER'].'</td>
                            <td style="width:100px;">'.$cur1.'</td>
                            <td style="width:100px;">'.$coursemajor.'</td>
                            <td style="width:300px;text-align:justify">'.$legacy['LNAME'].' , '.$legacy['FNAME'].'</td>
                        </tr>';
            $data = array('coursemajor' => $coursemajor, 'curriculum' => $cur1, 'date' => $d, 'student' => $p['id'], 'academicterm' => $sy['id'], 'status' => 'A');
            $this->db->insert('tbl_registration', $data);
        }
        $template .= '</table>';

        echo $template;
    }

    // function to fill up classallocation
    function fill_classallocation()
    {
        $room = $this->db->get('tbl_classroom')->result_array();

        $t = $this->db->get('tbl_time')->result_array();
        //$c = $this->db->get('tbl_classallocation')->result_array();

        $c = $this->db->query("SELECT * FROM tbl_classallocation WHERE academicterm = 50")->result_array();


        $d = $this->db->get('tbl_day')->result_array();

        $univ = 0;
        $univ_day = 0;
        $r = 0;
        $ctr2 = 0;
        foreach ($c as $cl)
        {
            $this->db->query("DELETE FROM tbl_dayperiod WHERE classallocation = {$cl['id']}");

            $this->db->where('id', $cl['subject']);

            $s          = $this->db->get('tbl_subject')->row_array();
            $units      = $s['units'];
            $units_heap = $units;
            $ctr        = 0;
            $ctr1       = 0;

            if($univ == 28)
            {
                $univ       = 0;
                $univ_day   = $univ_day + 1;
                //$ctr2++;
            }

            $o = $univ + $units_heap;

            if($o >= 28)
            {
                $univ = 0;
                $univ_day++;
                if($univ_day >= 3)
                {
                    $univ_day = 0;
                }
                if($r >= 69)
                {
                    $r = 0;
                }
                $o = $univ + $units_heap;
            }

            $start = $t[$univ]['id'];

            $end = $t[$o]['id'];

            $univ = $univ + $units_heap;

            if($univ_day == 0)
            {
                $data['classallocation'] = $cl['id'];
                $data['from_time']  = $start;
                $data['to_time']    = $end;
                $data['day']        = 1;
                $data['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data);

                $data1['classallocation'] = $cl['id'];
                $data1['from_time']  = $start;
                $data1['to_time']    = $end;
                $data1['day']        = 3;
                $data1['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data1);
            }
            elseif($univ_day == 1)
            {
                $data['classallocation'] = $cl['id'];
                $data['from_time']  = $start;
                $data['to_time']    = $end;
                $data['day']        = 2;
                $data['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data);

                $data1['classallocation'] = $cl['id'];
                $data1['from_time']  = $start;
                $data1['to_time']    = $end;
                $data1['day']        = 4;
                $data1['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data1);
            }
            elseif($univ_day == 2)
            {
                $data['classallocation'] = $cl['id'];
                $data['from_time']  = $start;
                $data['to_time']    = $end;
                $data['day']        = 5;
                $data['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data);

                $data1['classallocation'] = $cl['id'];
                $data1['from_time']  = $start;
                $data1['to_time']    = $end;
                $data1['day']        = 6;
                $data1['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data1);
                $r++;
                if($r >= 69)
                {
                    $r = 0;
                }
            }

            if($r >= 69)
            {
                $r = 0;
            }
            if($univ_day >= 3)
            {
                $univ_day = 0;
            }
        }
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

    function enrolmentLegacyGrouping(){
        $this->load->model('dean/group');
        $this->load->view('dean/enrolment_grouping');
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
}
