<?php 

class Curriculum extends CI_Model
{
	function getCur($id,$cid)
	{
		$this->db->where('academicterm',$id);
		$this->db->where('coursemajor',$cid);
		$q = $this->db->count_all_results('tbl_curriculum');
		if($q > 0)
		{
			$this->db->where('academicterm',$id);
			$q = $this->db->get('tbl_curriculum');
			$q = $q->row_array();
			return $q['id'];
		}
		else
		{
			return 'repeat';
		}
	}
}