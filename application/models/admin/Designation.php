<?php 

/**
* 
*/
class Designation extends CI_Model
{
	
	function getDesignations()
	{
		$this->db->order_by('description');
		return $this->db->get('tbl_designation')->result_array();
	}

	function addDesignation($desig){
		$arr = array('description' => $desig);
		$this->db->insert('tbl_designation', $arr);
	}

	function updateDesignation($id, $desig){
		$arr = array('description' => $desig);
		$this->db->where('id', $id);
		$this->db->update('tbl_designation', $arr);
	}

	function getSpecificDesig($id){
		$this->db->where('id', $id);
		return $this->db->get('tbl_designation')->row_array();
	}

	function checkExistinse($id){
		$this->db->where('designation', $id);
		$res = $this->db->get('tbl_administration')->num_rows();

		if ($res == 0) {
			$this->db->where('designation', $id);
			$res = $this->db->get('tbl_academic')->num_rows();
			if ($res == 0) {
				return false;
			}
			else{
				return true;
			}
		}
		else{
			return true;
		}
	}

	function checkDesignation($desig){
		$this->db->where('description', $desig);
		$res = $this->db->get('tbl_designation')->num_rows();
		return $res;
	}

	function checkDesignation2($id, $desig){
		$this->db->where('id !='.$id);
		$this->db->where('description', $desig);
		$res = $this->db->get('tbl_designation')->num_rows();
		return $res;
	}

	function deleteDesignation($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_designation');
	}
}


 ?>