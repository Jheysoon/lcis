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
		function get_colleges($id)
		{
			return $this->db->query("SELECT a.id, a.shortname, a.description dsc, c.id col, b.id sch
									 FROM `tbl_course` a, tbl_party b, tbl_college c 
									 WHERE c.id = a.college 
									 AND b.id = a.own AND a.id = '$id'")->row_array();
		}
		function get_major()
		{
			return $this->db->query("SELECT * FROM tbl_major")->result_array();
		}
		function get_mid($id)
		{
			return $this->db->query("SELECT * FROM tbl_major WHERE id = $id")->row_array();
		}
		function check_exist($n)
		{
			return $this->db->query("SELECT * FROM tbl_major WHERE description = '$n'")->num_rows();
		}
		function check_m($id)
		{
			return $this->db->query("SELECT major FROM tbl_coursemajor WHERE major = '$id'")->num_rows();
		}
		function chk_by_id($id, $m)
		{
			return $this->db->query("SELECT * FROM tbl_major WHERE description = '$m' AND id != $id")->num_rows();
		}
	}