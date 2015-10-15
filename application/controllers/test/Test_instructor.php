<?php 

class Test_instructor extends CI_Controller
{
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
                $coursemajor = 19;
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