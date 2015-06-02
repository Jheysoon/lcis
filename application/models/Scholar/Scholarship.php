<?php
class Scholarship extends CI_Model
{
	function searchId($id){
                $party_id = $this->db->query("SELECT * FROM tbl_party
                                              WHERE legacyid LIKE '$id%' OR CONCAT(firstname, ' ',  lastname) LIKE '%$id%'");
 
            $p = $party_id->result_array();
            $ite = 0;
            $data = array();
            foreach ($p as $party) {
                $this->db->where('id',$party['id']);
                $q = $this->db->count_all_results('tbl_student');
                if($q > 0)
                {
                    $data[]= array('firstname'=>$party['firstname'],
                                'lastname'=>$party['lastname'],
                                'middlename'=>$party['middlename'],
                                'legacyid'=>$party['legacyid']);
                    $ite++;
                }
                if($ite == 8)
                {
                    break;
                }
            }
            return $data;
	}
}