<?php 

class Edp_classallocation extends CI_Model
{
	function allocByRoom($rid)
	{
		$systemVal = $this->api->systemValue();
		$nxt = $systemVal['nextacademicterm'];
		$this->db->where('academicterm',$nxt);
		$this->db->where('classroom',$rid);
		return $this->db->get('tbl_classallocation')->result_array();
	}
	function getDayPeriod($cid)
	{
		$this->db->where('classallocation',$cid);
		return $this->db->get('tbl_dayperiod')->result_array();
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
		$this->db->where('classroom',NULL);
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
			$dd = $this->db->get_where('tbl_period',array('id'=>$dd1['period']))->row_array();
			$start = $this->db->get_where('tbl_time',array('id'=>$dd['from_time']))->row_array();
			$st = $start['time'];
			$end = $this->db->get_where('tbl_time',array('id'=>$dd['to_time']))->row_array();
			$en = $end['time'];
			$array[] = $st.'-'.$en;
		}
		return implode(' / ', $array);
	}

	function getPeriodId($pid)
	{
		$this->db->where('id',$pid);
		return $this->db->get('tbl_period')->row_array();
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
	function getDays($cid)
	{
		$this->db->where('classallocation',$cid);
		$this->db->select('day');
		return $this->db->get('tbl_dayperiod')->result_array();
	}
}