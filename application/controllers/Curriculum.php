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
class Curriculum extends CI_Controller
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
}