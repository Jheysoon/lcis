<?php 

class Edp_classallocation extends CI_Model
{
	function allocByRoom($rid)
	{
		$systemVal = $this->api->systemValue();
		$nxt = $systemVal['nextacademicterm'];
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
	function getAlloc($acam)
	{
		$this->db->where('academicterm',$acam);
		return $this->db->get('tbl_classallocation')->result_array();
	}
	function find($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('tbl_classallocation')->row_array();
	}

	function getEmptyRoom()
	{
		$systemVal = $this->api->systemValue();
		$this->db->where('academicterm',$systemVal['nextacademicterm']);
		return $this->db->get('tbl_classallocation')->result_array();
	}

	function getDayShort($cid)
	{
		$d = array();
		$this->db->order_by('day ASC');
		$this->db->where('classallocation',$cid);
		$s = $this->db->get('tbl_dayperiod')->result_array();
		foreach($s as $ss)
		{
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
		foreach($d as $dd1)
		{
			$start = $this->db->get_where('tbl_time',array('id'=>$dd1['from_time']))->row_array();
			$st = $start['time'];
			$end = $this->db->get_where('tbl_time',array('id'=>$dd1['to_time']))->row_array();
			$en = $end['time'];
			$array[] = $st.'-'.$en;
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
		$nxt 		= $systemVal['nextacademicterm'];
		$this->db->where('academicterm',$nxt);
		$this->db->where('classroom',$rid);
		return $this->db->count_all_results('tbl_classallocation');
	}
	function getClid($rid)
	{
		$systemVal 	= $this->api->systemValue();
		$nxt 		= $systemVal['nextacademicterm'];
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
		$q = $this->db->get('tbl_dayperiod')->result_array();
		$ar = array();
		foreach($q as $qq)
		{
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
	
}