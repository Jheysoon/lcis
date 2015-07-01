<?php 

class Out_studentcount extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('out_studentcount',$data);
	}

	function chkAcam($id)
	{
		$this->db->where('academicterm',$id);
		return $this->db->count_all_results('out_studentcount');
	}

	function all()
	{
		return $this->db->get('out_studentcount')->result_array();
	}

	function getGroup()
	{
		$sy = $this->api->systemValue();
		$syid = $sy['currentacademicterm'];
		return $this->db->query("SELECT * FROM out_studentcount  WHERE academicterm = $syid GROUP BY coursemajor")->result_array();
	}
}