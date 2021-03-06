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
		if ($id == '') {
			$id =0;
		}
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

	function getUserOffice()
	{
		$this->CI->load->model('dean/common_dean');

		if(! $this->CI->session->has_userdata('uid'))
		{
			redirect(base_url());
		}
        $uid = $this->CI->session->userdata('uid');

        $office = $this->CI->common_dean->getUserOffice($uid);

        if ($office)
        	$office = $office['office'];
        else
        	$office = '';

        return $office;
	}

	function getUserCollege()
	{
		$this->CI->load->model(array(
            'dean/subject',
            'dean/common_dean'
        ));

		if(! $this->CI->session->has_userdata('uid'))
		{
			redirect(base_url());
		}
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
		$q = $this->CI->db->query("SELECT * FROM tbl_option WHERE link LIKE '%$url%'");

		if ($q->num_rows() > 0) {
			$option = $q->row_array();
			$option_id = $option['id'];
			$this->CI->db->where('optionid',$option_id);
			$this->CI->db->where('userid',$user);
			$count = $this->CI->db->count_all_results('tbl_useroption');

			if($count < 1)
				show_error('Unathorized Access');
		}
		else
			show_error($url);
	}

	// load the user menu
	function userMenu()
	{
		if($this->CI->session->has_userdata('uid'))
		{
			$this->CI->load->model(array(
	            'home/option',
	            'home/option_header',
	            'home/useroption'
	        ));
	        $this->CI->load->view('templates/header');
	        $this->CI->load->view('templates/header_title2');
		}
		else
		{
			redirect(base_url());
		}
	}

	// 1:00-3:00 / 2:00-5:00

	//$from = 1:00,	$from_compare 	= 2:00
	//$to 	= 3:00,	$to_compare 	= 5:00
    function intersectCheck($from, $from_compare, $to, $to_compare)
	{
		if ($from == $from_compare AND $to == $to_compare) {
			return true;
		}

        $from 			= strtotime($from);
        $from_compare 	= strtotime($from_compare);
        $to 			= strtotime($to);
        $to_compare 	= strtotime($to_compare);
        $intersect 		= min($to, $to_compare) - max($from, $from_compare);

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

    function set_session_message($type = 'success', $message, $name = 'message')
    {
    	$this->CI->session->set_flashdata($name,'<div class="alert alert-'.$type.'">'.$message.'</div>');
    }

	// update enrolment after payment
	function updateEnrolmentStatus($enid){
		$data1['status'] = 'E';
		$this->db->where('id', $enid);
		$this->db->update('tbl_enrolment');
	}

	//function to determine the year level echo $this->api->yearLevel(172,4);
	function yearLevel($partyid, $eval = true)
	{
		$systemVal 	= $this->systemValue();
		$sy     	= $systemVal['nextacademicterm'];
		$tolerance 	= (int) $systemVal['cutoffpercentage'];

		$cur_id 	= 0;
		$cur 		= $this->CI->db->query("SELECT * FROM tbl_registration WHERE student = $partyid");

		// check if the student has a registration record
		if($cur->num_rows() > 0)
		{
			$c 		= $cur->row_array();
			$cur_id = $c['curriculum'];
		}
		else
		{
			$b['comment'] = 'not found tbl_registration';
			$b['student'] = $partyid;
			$this->CI->db->insert('out_exception',$b);
			return 'Does not have a registration';
		}

		$t = $this->CI->db->query("SELECT * FROM tbl_registration WHERE student = $partyid AND (academicterm = NULL OR academicterm = 0)")->num_rows();

		if($t > 0)
		{
			$g['comment'] = 'no valid academicterm tbl_registration';
			$g['student'] = $partyid;
			$this->CI->db->insert('out_exception',$g);
			return 'error';
		}


		if($cur_id != 0)
		{
			$units 			= 0;
			$sum_units 		= array(0 => 0, 1 => 0, 2 => 0, 3 => 0);
			$student_units 	= 0;

			// check if the curriculum is found in tbl_year_units
			$this->CI->db->where('curriculum',$cur_id);
			$u1 = $this->CI->db->count_all_results('tbl_year_units');
			if($u1 < 1) {
				$f['comment'] = 'not found tbl_curriculum';
				$f['student'] = $partyid;
				$this->CI->db->insert('out_exception',$f);
				return 'Error';
			}


			for ($i=1; $i <=4 ; $i++)
			{
				// get the total units by yearlevel
				// add validation if the curriculum does not exist in tbl_year_units
				$this->CI->db->where('curriculum',$cur_id);
				$this->CI->db->where('yearlevel',  $i);
				$u = $this->CI->db->get('tbl_year_units')->row_array();
				$units += $u['totalunits'];

				$sum_units[$i - 1] = $units;
			}

			$this->CI->db->where('student', $partyid);
			$enrol = $this->CI->db->get('tbl_enrolment')->result_array();

			foreach ($enrol as $val)
			{
				// NOT_FAILED_GRADE @ application/config/constants.php
				$threshold_grade = NOT_FAILED_GRADE;
				$stud = $this->CI->db->query("SELECT * FROM tbl_studentgrade
					WHERE (semgrade <= $threshold_grade OR semgrade = 44
						OR reexamgrade <= $threshold_grade)
						AND enrolment = {$val['id']}")->result_array();


				foreach ($stud as $stud_subj)
				{

					$stu = $this->CI->db->query("SELECT * FROM tbl_subject
						WHERE id = (SELECT subject FROM tbl_classallocation WHERE id = {$stud_subj['classallocation']})")->row_array();


					$this->CI->db->where('curriculum', $cur_id);
					$this->CI->db->where('subject', $stu['id']);
					$cur_detail1 = $this->CI->db->get('tbl_curriculumdetail');

					//if ($cur_detail1->num_rows() > 0)
					//{
						$student_units += $stu['units'];
					//}
				}

			}
			
			if ( ! $eval) {
				$h['comment'] = 'OK';
				$h['student'] = $partyid;
				$h['student_units'] = $student_units;
				$h['totalunits'] = $units;
				$this->CI->db->insert('out_exception',$h);
			}

			for ($q=0; $q <= 3 ; $q++)
			{
				$m_units = (int) ($sum_units[$q] * ($tolerance / 100));

				if($student_units <= $sum_units[$q])
				{
					if($student_units >= $m_units AND $student_units <= $sum_units[$q])
					{
						$u = $q + 2;
						if($u >= 4)
							return 4;
						else
							return $u;
					}
					else
						return $q+1;
				}
			}
			return 'end if function';
		}
		else
		{
			$b['comment'] = 'no curriculum tbl_registration';
			$b['student'] = $partyid;
			$this->CI->db->insert('out_exception',$b);
			return CUR_NOT_FOUND;
		}

		return 'end function';
		////////////////////////////////////////////////////////////////////////////
	}
	// end for yearLevel function
	function get_subcode()
	{
		$col = $this->getUserCollege();
		if ($col == 1) {
			return "(SUBSTRING(SUBCODE, 1, 2) = 'GE' OR SUBSTRING(SUBCODE, 1, 2) = 'AB')";
		}
		elseif ($col == 2){
			return "SUBSTRING(SUBCODE, 1, 2) = 'ED'";
		}
		elseif ($col == 3){
			return "SUBSTRING(SUBCODE, 1, 2) = 'CR'";
		}
		elseif ($col == 4){
			return "SUBSTRING(SUBCODE, 1, 1) = 'L'";
		}
		elseif ($col == 5){
			return "(SUBSTRING(SUBCODE, 1, 2) = 'OA' OR SUBSTRING(SUBCODE, 1, 2) = 'CM')";
		}
	}

	// function for counting no. of pages in tor
	function countPage($sid)
	{
		$this->CI->load->model('registrar/tor');

        $t = $this->CI->tor->countPage($sid);
        $page = $t/26;
        if ($t%26 != 0) {
            $page = intval($page) + 1;
        }

        return $page;
	}

	function checkConflict($instructor, $time, $day)
	{
		$this->CI->load->model('dean/common_dean');
		$all_cl 	= $this->CI->common_dean->getAllCl($instructor);
		$subj_t 	= explode(' / ', $time);
		$subj_day 	= explode(' / ', $day);

		foreach ($all_cl as $cl1) {
			$dd = $this->CI->db->get_where('tbl_day', array('id' => $cl1['day']))->row_array();

			// dont check if the subject day is TBA
			if ( !in_array('TBA', $subj_day)) {

				// checking for day
				if (in_array($dd['shortname'], $subj_day)) {
					// instructor time
					$f      = $this->CI->db->get_where('tbl_time', array('id' => $cl1['from_time']))->row_array();
					$t      = $this->CI->db->get_where('tbl_time', array('id' => $cl1['to_time']))->row_array();
					$from   = $f['time'];
					$to     = $t['time'];

					// subject time looping
					foreach ($subj_t as $key) {
						$key1       = explode('-', $key);
						$isConflict =  $this->intersectCheck($from, $key1[0], $to, $key1[1]);

						if($isConflict == true)
							return true;
					}
				}
			}

		}
		return false;
	}

}
