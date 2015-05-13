<?php
/*
| -------------------------------------
| @file  : Curriculum.php
| @date  : 05/11/2015
| @author: Greg
| -------------------------------------

*/
/**
* 
*/
class Lc_curriculum extends CI_Controller
{
	function viewcurriculum($partyid, $date, $coursemajor)

	{

		$this->load->model('registrar/common');
		  $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));

        $data['partyid'] = $partyid;
        $data['date'] = $date;
        $data['coursemajor'] = $coursemajor;

        $this->load->view('templates/header');
        $this->load->view('curriculum/curriculum', $data);
		$this->load->view('templates/footer');
	}
    function addsubcur(){

        $this->load->model('registrar/curriculum');
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));

        $this->load->view('templates/header_title2');
        $this->load->view('templates/header');
        $this->load->view('dean/add_subcurr');
        $this->load->view('templates/footer');

    }
    function insertcurr(){
        $suc = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $alerts = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $accad_id = $this->input->post('acad_id');
        $coursemajor = $this->input->post('coursemajor');
        $remarks = $this->input->post('remarks');
        $result = $this->db->query("SELECT COUNT(*) as totalcount FROM tbl_curriculum WHERE coursemajor = '$coursemajor' AND academicterm = '$accad_id'");
        $x = $result->row_array();
        if ($x['totalcount'] == 0) {
            echo 1;
            $data = array('description' => $remarks, 
                'coursemajor' => $coursemajor, 
                'academicterm' => $accad_id);
            $this->db->insert('tbl_curriculum', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Curriculum Added.</div>');
        }else{
            $this->session->set_flashdata('message', $alerts . 'Curriculum Already Exist.</div>');
        }
       redirect('/menu/dean-add_curriculum');
    }
    function deletecur($currid){
        $suc = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $this->db->delete('tbl_curriculum', array('id' => $currid));
        $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Curriculum Deleted.</div>');
        redirect('/menu/dean-add_curriculum');
    }
}