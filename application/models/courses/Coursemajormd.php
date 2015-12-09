<?php 


	/**
	* 
	*/
	class Coursemajormd extends CI_Model
	{
		function get_college()
		{
			// $this->db->get('tbl_college')->result_array();
			return $this->db->query("SELECT * FROM tbl_college")->result_array();
		}
		function get_school()
		{
			return $this->db->query('SELECT tbl_party.firstname, tbl_school.id 
									 FROM `tbl_school`, tbl_party 
									 WHERE tertiary = 1 
									 AND tbl_school.id = tbl_party.id
									 ORDER BY tbl_party.firstname')->result_array();
		}
		function get_allcourse()
		{
			return $this->db->query("SELECT a.id, a.shortname, a.description dsc, c.description col, b.firstname 
									 FROM `tbl_course` a, tbl_party b, tbl_college c 
									 WHERE c.id = a.college 
									 AND b.id = a.own")->result_array();
		}
		
	}