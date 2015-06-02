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
		return $this->db->get('tbl_dayperiod1')->result_array();
	}
}