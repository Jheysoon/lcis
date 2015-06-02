<?php 

class Out_section extends CI_Model
{
	function count($acam,$cid,$subj,$yearlevel)
	{
		$this->db->where('academicterm',$acam);
		$this->db->where('coursemajor',$cid);
		$this->db->where('subject',$subj);
		$this->db->where('yearlevel',$yearlevel);
		return $this->db->get('out_section')->row_array();
	}

	function whereCount($acam,$cid,$subj,$yearlevel)
	{
		$this->db->where('academicterm',$acam);
		$this->db->where('coursemajor',$cid);
		$this->db->where('subject',$subj);
		$this->db->where('yearlevel',$yearlevel);
		return $this->db->count_all_results('out_section');
	}
}