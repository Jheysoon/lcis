<?
	class Discountmd extends CI_Model
	{
		
		function get_info($legacyid)
		{
			return $this->db->query("SELECT a.id, b.coursemajor, CONCAT(a.firstname, ' ', a.lastname) as fullname 
								  	 FROM tbl_party a , tbl_registration b  
								  	 WHERE a.legacyid = '$legacyid' 
								  	 AND a.id = b.student")->row_array();
		}
	}