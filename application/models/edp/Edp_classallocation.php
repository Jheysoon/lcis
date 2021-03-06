<?php

class Edp_classallocation extends CI_Model
{
	function allocByRoom($rid)
	{
		$systemVal = $this->api->systemValue();
		$nxt = $systemVal['phaseterm'];
		$this->db->where('academicterm',$nxt);
		return $this->db->get('tbl_classallocation')->result_array();
	}

	function getDayPeriod($cid,$rid)
	{
		$this->db->where('classallocation',$cid);
		$this->db->where('classroom',$rid);
		return $this->db->get('tbl_dayperiod')->result_array();
	}

	function getDayPeriod1($cid)
	{
		$this->db->where('classallocation',$cid);
		return $this->db->get('tbl_dayperiod')->result_array();
	}

	function countDayPer($cid,$rid)
	{
		$this->db->where('classallocation',$cid);
		$this->db->where('classroom',$rid);
		return $this->db->count_all_results('tbl_dayperiod');
	}
	
	function getAllocs($systemVal, $owner, $phaseterm)
	{
		$user = $this->session->userdata('uid');
		
		if ($user == $systemVal['employeeid']) {
			return  $this->db->query("SELECT b.code as code,b.id as subj_id, b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id
				AND (b.computersubject = 1 OR b.nstp = 1)
				AND academicterm = $phaseterm ORDER BY title, instructor ASC")->result_array();
		} elseif($owner == 1) {
			return  $this->db->query("SELECT b.code as code,b.id as subj_id, b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id
				AND (b.owner = $owner OR b.gesubject = 1)
				AND b.computersubject = 0 AND b.nstp = 0
				AND academicterm = $phaseterm ORDER BY title, instructor ASC")->result_array();
		} else {
			return  $this->db->query("SELECT b.code as code,b.id as subj_id, b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id
				AND b.owner = $owner AND b.gesubject = 0
				AND b.computersubject = 0 AND b.nstp = 0
				AND academicterm = $phaseterm ORDER BY title, instructor ASC")->result_array();
		}
	}
	
	function getAlloc($acam)
	{
		$user 		= $this->session->userdata('uid');
		$systemVal 	= $this->api->systemValue();
		$owner 		= $this->api->getUserCollege();

		if ($user == $systemVal['employeeid']) {
			return $this->db->query("SELECT a.id as cid, coursemajor, descriptivetitle, code
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $acam
				AND (computersubject = 1 OR nstp = 1)
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC")->result_array();
		} elseif ($owner == 1) {
			return $this->db->query("SELECT a.id as cid, coursemajor, descriptivetitle, code
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $acam
				AND (owner = 1 OR gesubject = 1) AND computersubject = 0 AND nstp = 0
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC")->result_array();
		} else {
			return $this->db->query("SELECT a.id as cid, coursemajor, descriptivetitle, code
				FROM tbl_classallocation a, tbl_subject b
				WHERE a.subject = b.id AND academicterm = $acam
				AND computersubject = 0 AND gesubject = 0
				AND owner = $owner AND nstp = 0
				ORDER BY b.code ASC, coursemajor ASC, a.id ASC")->result_array();
		}
	}

	function getAlloc1($acam,$owner)
	{
		return $this->db->query("SELECT *,tbl_classallocation.id
						FROM tbl_classallocation,tbl_course
						WHERE academicterm = $acam
						AND tbl_classallocation.coursemajor = tbl_course.id
						AND college = $owner")->result_array();
	}

	function find($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('tbl_classallocation')->row_array();
	}

	function getEmptyRoom()
	{
		$systemVal = $this->api->systemValue();
		$this->db->where('academicterm', $systemVal['phaseterm']);
		return $this->db->get('tbl_classallocation')->result_array();
	}

	function getDayShort($cid)
	{
		$d = array();
		$this->db->order_by('day ASC');
		$this->db->where('classallocation',$cid);
		$s = $this->db->get('tbl_dayperiod')->result_array();

		foreach ($s as $ss) {
			$this->db->where('id',$ss['day']);
			$a = $this->db->get('tbl_day')->row_array();
			$d[] = $a['shortname'];
		}

		return implode(' / ', $d);
	}

	function chkDayPeriod($cid)
	{
		$this->db->where('classallocation',$cid);
		return $this->db->count_all_results('tbl_dayperiod');
	}

	function getPeriod($cid)
	{
		$array = array();
		$this->db->order_by('day ASC');
		$this->db->where('classallocation',$cid);
		$d = $this->db->get('tbl_dayperiod')->result_array();

		foreach ($d as $dd1) {
			$start 		= $this->db->get_where('tbl_time',array('id'=>$dd1['from_time']))->row_array();
			$st 		= $start['time'];
			$end 		= $this->db->get_where('tbl_time',array('id'=>$dd1['to_time']))->row_array();
			$en 		= $end['time'];
			$array[] 	= $st.'-'.$en;
		}

		return implode(' / ', $array);
	}

	function getRoom($cid)
	{
		$array = array();
		$this->db->order_by('day ASC');
		$this->db->where('classallocation',$cid);
		$d = $this->db->get('tbl_dayperiod')->result_array();

		foreach ($d as $dd1) {
			$room  		= $this->db->get_where('tbl_classroom',array('id'=>$dd1['classroom']))->row_array();
			$rname 		= $room['legacycode'];
			$lid   		= $room['location'];
			$location 	= $this->db->get_where('tbl_location',array('id'=>$lid))->row_array();
			$location 	= $location['description'];
			$array1[] 	= $rname;
			$array2[] 	= $location;
		}

		$room = implode(' / ', $array1);

		if ($location) {
			$location = implode(' / ', $array2);
		} else{
			$location = '';
		}

		$ret = array(
			'room' => $room,
			'location' => $location
		);

		return $ret;
	}

	function getRooms($cid)
	{
		$array = array();
		$this->db->order_by('day ASC');
		$this->db->where('classallocation', $cid);
		$d = $this->db->get('tbl_dayperiod')->result_array();

		foreach ($d as $dd) {
			$room  		= $this->db->get_where('tbl_classroom', array('id' =>$dd['classroom']))->row_array();
			$array[] 	= $room['legacycode'];
		}

		return implode(' / ', $array);
	}

	###### getPeriodId to be removed
	function getPeriodId($pid)
	{
		$this->db->where('id',$pid);
		return $this->db->get('tbl_period')->row_array();
	}

	function getTime($tid)
	{
		$this->db->where('id',$tid);
		return $this->db->get('tbl_time')->row_array();
	}

	function roomUsed($rid)
	{
		$systemVal 	= $this->api->systemValue();
		$nxt 		= $systemVal['phaseterm'];
		$this->db->where('academicterm',$nxt);
		$this->db->where('classroom',$rid);

		return $this->db->count_all_results('tbl_classallocation');
	}

	function getClid($rid)
	{
		$systemVal 	= $this->api->systemValue();
		$nxt 		= $systemVal['phasterm'];
		$this->db->where('academicterm',$nxt);
		$this->db->where('classroom',$rid);

		return  $this->db->get('tbl_classallocation')->result_array();
	}

	function getDP($cid)
	{
		$this->db->where('classallocation',$cid);
		$this->db->select('day,from_time,to_time');

		return $this->db->get('tbl_dayperiod')->result_array();
	}

	function getPer($cid)
	{
		$this->db->where('classallocation',$cid);
		$q 	= $this->db->get('tbl_dayperiod')->result_array();
		$ar = array();

		foreach ($q as $qq) {
			$this->db->where('id',$qq['period']);
			$w 		= $this->db->get('tbl_period')->row_array();
			$this->db->where('id',$w['from_time']);
			$st 	= $this->db->get('tbl_period')->row_array();
			$start 	= $st['time'];
			$this->db->where('id',$w['to_time']);
			$en 	= $this->db->get('tbl_period')->row_array();
			$end 	= $en['time'];
			$ar[]	= $start.'-'.$end;
		}

		return implode(',', $ar);
	}

	function findDay($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('tbl_day')->row_array();
	}

	function getPeriodRange($from,$to)
	{
		$this->db->where('id',$from);
		$f 	= $this->db->get('tbl_time')->row_array();
		$ff = $f['time'];
		$this->db->where('id',$to);
		$t 	= $this->db->get('tbl_time')->row_array();
		$tt = $t['time'];
		return $ff.' - '.$tt;
	}

	function getAllRoom()
	{
		return $this->db->get('tbl_classroom')->result_array();
	}

	function updateClassroom($room,$dpId)
	{
		$data['classroom']  = $room;
        $this->db->where('id',$dpId);
        $this->db->update('tbl_dayperiod',$data);
	}

	function getCourseShort($cid)
	{
		$q = $this->db->query("SELECT shortname FROM tbl_course WHERE id = (SELECT course FROM tbl_coursemajor WHERE id = $cid)")->row_array();
		return $q['shortname'];
	}

	function getAllCollege()
	{
		return $this->db->get('tbl_college')->result_array();
	}

	function count_complete($partyid,$stage)
	{
		$systemVal = $this->api->systemValue();
		$this->db->where('academicterm', $systemVal['phaseterm']);
		$this->db->where('stage', $stage);
		$this->db->where('completedby', $partyid);
		return $this->db->count_all_results('tbl_completion');
	}

	function get_status($partyid,$stage)
	{
		$systemVal = $this->api->systemValue();
		$this->db->where('academicterm', $systemVal['phaseterm']);
		$this->db->where('stage', $stage);
		$this->db->where('completedby', $partyid);
		return $this->db->get('tbl_completion')->row_array();
	}

	function getStudEnrol($cid, $acam)
	{
		return $this->db->query("SELECT * FROM tbl_enrolment,tbl_coursemajor
			WHERE tbl_coursemajor.id = tbl_enrolment.coursemajor
			AND tbl_coursemajor.course = $cid
			AND academicterm = $acam
			AND school = 1
			GROUP BY student")->result_array();
	}

	function getCM_groupBy()
	{
		$sy = $this->api->systemValue();
		return $this->db->query("SELECT * FROM tbl_classallocation WHERE academicterm = {$sy['phaseterm']} GROUP BY coursemajor")->result_array();
	}

	function getSubjectByCl($cid)
	{
		return $this->db->query("SELECT * FROM tbl_subject
			WHERE id = (
				SELECT subject FROM tbl_classallocation
				WHERE id = $cid)")->row_array();
	}
}
