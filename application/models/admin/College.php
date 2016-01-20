<?php 

class College extends CI_Model
{
	
	function getColleges()
	{
		$this->db->order_by('description');
		$this->db->where('a.dean = b.id');
		$this->db->select('a.*, b.lastname, b.firstname');
		return $this->db->get('tbl_college a, tbl_party b')->result_array();
	}

	function getDeans(){
		$this->db->order_by('b.lastname, b.firstname');
		$this->db->where('a.id = b.id AND a.designation = d.id AND d.description = "DEAN"');
		$this->db->select('b.id, b.lastname, b.firstname');
		return $this->db->get('tbl_academic a, tbl_party b, tbl_designation d')->result_array();
	}

	function addCollege($arr){
		$this->db->insert('tbl_college', $arr);
	}

	function updateCollege($id, $arr){
		$this->db->where('id', $id);
		$this->db->update('tbl_college', $arr);
	}

	function getSpecificCollege($id){
		$this->db->where('id', $id);
		return $this->db->get('tbl_college')->row_array();
	}

	function checkExistinse($id){
		$this->db->where('college', $id);
		$res = $this->db->get('tbl_course')->num_rows();

		if ($res == 0) {
			return false;
		}
		else{
			return true;
		}
	}

	function checkCollege($desig){
		$this->db->where('description', $desig);
		$res = $this->db->get('tbl_college')->num_rows();
		return $res;
	}

	function checkCollege2($id, $desig){
		$this->db->where('id !='.$id);
		$this->db->where('description', $desig);
		$res = $this->db->get('tbl_college')->num_rows();
		return $res;
	}

	function deleteCollege($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_college');
	}
}


 ?>