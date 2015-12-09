<?php 

/**
* 
*/

class Admin extends CI_Controller
{
	private function head()
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/student'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

	function designation()
	{
		$this->head();
		$this->load->model('admin/designation');
        $this->load->view('admin/designation');
		$this->load->view('templates/footer');
	}

	function update_designation($id = '')
	{
		$this->head();
		$this->load->model('admin/designation');

		$res 	= $this->designation->getSpecificDesig($id);
		$val 	= $res['description'];
		$data 	= array('id' => $id, 'val' => $val);

        $this->load->view('admin/designation', $data);
		$this->load->view('templates/footer');
	}

	function addDesignation()
	{
		$this->load->model('admin/designation');
		$desig = strtoupper($this->input->post('designation'));
		$this->designation->addDesignation($desig);
		redirect('/designation');
	}

	function updateDesignation()
	{	
		$this->load->model('admin/designation');
		$desig 	= strtoupper($this->input->post('designation'));
		$id 	= $this->input->post('id');
		$this->designation->updateDesignation($id, $desig);
		redirect('/designation');
	}
}

?>