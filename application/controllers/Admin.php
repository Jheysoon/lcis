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
		$exist = $this->designation->checkDesignation($desig);
		if ($exist == 0) {
			$this->designation->addDesignation($desig);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success! </strong> Designation successfully added!.
                </div>'
			);
		}
		else{
			$this->session->set_flashdata('message', 
				'<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Stop! </strong> Designation already exist!.
                </div>'
			);
		}
		redirect('/designation');
	}

	function updateDesignation()
	{	
		$this->load->model('admin/designation');
		$desig 	= strtoupper($this->input->post('designation'));
		$id 	= $this->input->post('id');
		$exist = $this->designation->checkDesignation2($id, $desig);
		if ($exist == 0) {
			$this->designation->updateDesignation($id, $desig);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success! </strong> Designation successfully updated!.
                </div>'
			);
			redirect('/designation');
		}
		else{
			$this->session->set_flashdata('message', 
				'<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Stop! </strong> Designation already exist!.
                </div>'
			);
			redirect('/update_designation/'.$id);
		}
	}

	function deleteDesignation($id)
	{
		$this->load->model('admin/designation');
		$exist = $this->designation->checkExistinse($id);

		if ($exist == true) {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Oops! </strong> Unable to delete! Designation in use!.
                </div>'
			);
		}
		else{
			$this->designation->deleteDesignation($id);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success! </strong> Designation successfully deleted!.
                </div>'
			);
		}
		redirect('/designation');
	}
}

?>