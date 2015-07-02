<?php

class Api
{
	protected $CI;

	//initialize the $CI variable
	function __construct()
	{
		$this->CI =& get_instance();
	}

	/* ***** to be removed ********** */
	function getCourse($id)
	{
		$this->CI->load->model('registrar/course');
		return $this->CI->course->getCourse($id);
	}

	function getMajor($id)
	{
		return $this->CI->db->query("SELECT * FROM tbl_major WHERE id = (SELECT major FROM tbl_coursemajor WHERE id = $id)");
	}
	#######################

	function getCourseMajor($id)
	{
		$this->CI->load->model('registrar/course');
		$m = '';
		$course = $this->CI->course->getCourse($id);
		$major 	= $this->CI->db->query("SELECT * FROM tbl_major WHERE id = (SELECT major FROM tbl_coursemajor WHERE id = $id)");
		if($major->num_rows() > 0)
		{
			$mm = $major->row_array();
			$m = '('.$mm['description'].')';
		}
		return $course.' '.$m;
	}

	function getUserCollege()
	{
		$this->CI->load->model(array(
            'dean/subject',
            'dean/common_dean'
        ));
        $uid = $this->CI->session->userdata('uid');

        $col = $this->CI->common_dean->countAcam($uid);
        if($col > 0)
        {
            $owner = $this->CI->common_dean->getColAcam($uid);
            return $owner['college'];
        }
        else
        {
            $c = $this->CI->common_dean->countAdmin($uid);
            if($c > 0)
            {
                $owner = $this->CI->common_dean->getColAdmin($uid);
                $o = $owner['office'];
                $of = $this->CI->common_dean->getOffice($o);
                return $of['college'];
            }
            else
            {
                return 0;
            }
        }
	}

	// get the tbl_systemvalue table values
	function systemValue()
	{
		return $this->CI->db->get('tbl_systemvalues')->row_array();
	}

	// this function checks if the user has the right/access for that menu
	function verifyUserAccess($url)
	{
		$user = $this->CI->session->userdata('uid');
		$this->CI->db->where('link',$url);
		$q = $this->CI->db->get('tbl_option');
		if($q->num_rows() > 0)
		{
			$option = $q->row_array();
			$option_id = $option['id'];
			$this->CI->db->where('optionid',$option_id);
			$this->CI->db->where('userid',$user);
			$count = $this->CI->count_all_results('tbl_useroption');
			if($count > 0)
				return 'ok';
			else
				return 'error';
		}
		else
			return 'error';
	}


	// load the user menu
	function userMenu()
	{
		$this->CI->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));

        $this->CI->load->view('templates/header');
        $this->CI->load->view('templates/header_title2');
	}

	// 1:00-3:00 / 2:00-5:00

	//$from = 1:00,	$from_compare 	= 2:00
	//$to 	= 3:00,	$to_compare 	= 5:00
    function intersectCheck($from, $from_compare, $to, $to_compare){
        $from = strtotime($from);
        $from_compare = strtotime($from_compare);
        $to = strtotime($to);
        $to_compare = strtotime($to_compare);
        $intersect = min($to, $to_compare) - max($from, $from_compare);
            if ( $intersect < 0 ) $intersect = 0;
            $overlap = $intersect / 3600;
            if ( $overlap <= 0 ):
                // There are no time conflicts
                return FALSE;
                else:
                // There is a time conflict
                // echo '<p>There is a time conflict where the times overlap by ' , $overlap , ' hours.</p>';
                return TRUE;
            endif;
    }

    function getYearLevel($id){
    	$this->CI->load->model('dean/student');

		$yr = $this->CI->student->getYearLevel($id);
		$year['count'] = $yr;
		if ($yr == 0) {
			$level = 0;
		}
		else if ($yr == 1 || $yr == 2) {
			$level = 1;
		}
		else if ($yr == 3 || $yr == 4) {
			$level = 2;
		}
		else if ($yr == 5 || $yr == 6) {
			$level = 3;
		}
		else{
			$level = 4;
		}
		$year['level'] = $level;
		return $year;

    }

    function set_session_message($type = 'success',$message,$name = 'message')
    {
    	$this->CI->session->set_flashdata($name,'<div class="alert alert-'.$type.'">'.$message.'</div>');
    }

	//function to determine the year level
	function yearLevel($partyid, $course)
	{
		$systemVal 	= $this->systemValue();
		$sy     	= $systemVal['nextacademicterm'];

		$this->CI->db->where('id',$sy);
        $tt     = $this->CI->db->get('tbl_academicterm')->row_array();
        $term   = $tt['term'];

        $acamd  = $this->CI->db->query("SELECT * FROM `tbl_academicterm` where systart <= {$tt['systart']} order by systart ASC,term")->result_array();
		$cur1 	= 0;
		foreach($acamd as $acams)
		{
			$c = $this->CI->db->query("SELECT * FROM tbl_curriculum,tbl_coursemajor WHERE
				tbl_coursemajor.id = tbl_curriculum.coursemajor AND
				tbl_coursemajor.course = $course AND academicterm = {$acams['id']}");
			if($c->num_rows() > 0)
			{
				$cur    = $c->row_array();
				$cur1   = $cur['id'];
				break;
			}
		}
		if($cur1 == 0) {
			return CUR_NOT_FOUND;
		}
		else
		{
			$units 			= 0;
			$student_units 	= 0;
			for ($i=1; $i <= 4; $i++)
			{

				$this->CI->where('curriculum', $cur1);
				$this->CI->where('yearlevel',  $i);
				$cur_detail = $this->CI->db->get('tbl_curriculumdetail')->result_array();
				foreach ($cur_detail as $detail)
				{
					$this->CI->db->where('id',$detail['subject']);
					$sub 	= $this->CI->db->get('tbl_subject')->row_array();
					$units += $sub['units'];
				}

				$this->CI->where('student', $partyid);
				$enrol = $this->CI->get('tbl_enrolment')->result_array();
				foreach ($enrol as $val)
				{
					$threshold_grade = NOT_FAILED_GRADE;
					$stud = $this->CI->db->query("SELECT * FROM tbl_studentgrade
						WHERE (semgrade < $threshold_grade
							OR reexamgrade < $threshold_grade)
							AND enrolment = {$val['id']}")->result_array();

					foreach ($stud as $stud_subj)
					{
						$this->CI->where('curriculum', $cur1);
						$this->CI->where('yearlevel',  $i);
						$cur_detail1 = $this->CI->db->get('tbl_curriculumdetail')->result_array();
						foreach ($cur_detail1 as $detail1)
						{
							$stu = $this->CI->db->query("SELECT * FROM tbl_subject
								WHERE id = (SELECT subject FROM tbl_classallocation WHERE id = {$stud_subj['classallocation']} AND subject = {$detail1['subject']})");
							if($stu->num_rows() > 0)
							{
								$stu1 			= $stu->row_array();
								$student_units += $stu1['units'];
							}
						}
						// $this->CI->db->query("SELECT * FROM tbl_subject
						// 	WHERE id = (SELECT subject FROM tbl_classallocation WHERE id = {$stud_subj['classallocation']})")->row_array();
					}
				}

				// get the range for students units
				$min_units = $units * (1 - TOLERANCE);

				if($student_units <= $units AND $student_units >= $min_units)
				{
					return $i;
				}
			}
		}
	}
	// end for yearLevel function
}
