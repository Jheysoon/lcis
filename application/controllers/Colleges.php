<?php 

/**
* 
*/

class Colleges extends CI_Controller
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

	function college()
	{
		$this->head();
		$this->load->model('admin/college');
        $this->load->helper('form');
        $this->load->view('admin/college');
		$this->load->view('templates/footer');
	}

    function update_college($id = '')
    {
        $this->head();
        $this->load->model('admin/college');
        $this->load->helper('form');

        $res    = $this->college->getSpecificCollege($id);
        $data   = array(
            'id'            => $id, 
            'description'   => $res['description'],
            'shortname'     => $res['shortname'],
            'dean'          => $res['dean']
        );

        $this->load->view('admin/college', $data);
        $this->load->view('templates/footer');
    }

    function addCollege()
    {
        $this->load->model('admin/college');
        $desig = strtoupper($this->input->post('description'));
        $short = strtoupper($this->input->post('shortname'));
        $dean  = $this->input->post('dean');
        $exist = $this->college->checkCollege($desig);

        if ($dean == 0){
            $this->session->set_flashdata('message', 
                '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Stop! </strong> Please select dean!.
                </div>'
            );
        }
        elseif ($exist == 0) {
            $desig = array(
                'description' => $desig,
                'shortname'   => $short,
                'dean'        => $dean  
            );
            $this->college->addCollege($desig);
            $this->session->set_flashdata('message', 
                '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success! </strong> Designation successfully added!.
                </div>'
            );
            redirect('/college');
        }
        else{
            $this->session->set_flashdata('message', 
                '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Stop! </strong> Designation already exist!.
                </div>'
            );
        }
        $this->college();
    }

    function updateCollege()
    {   
        $this->load->model('admin/college');
        $desig  = strtoupper($this->input->post('description'));
        $short  = strtoupper($this->input->post('shortname'));
        $dean   = $this->input->post('dean');
        $id     = $this->input->post('id');
        $exist  = $this->college->checkCollege2($id, $desig);
        if ($exist == 0) {
            $desig = array(
                'description' => $desig,
                'shortname'   => $short,
                'dean'        => $dean  
            );
            $this->college->updateCollege($id, $desig);
            $this->session->set_flashdata('message', 
                '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success! </strong> Designation successfully updated!.
                </div>'
            );
            redirect('/college');
        }
        else{
            $this->session->set_flashdata('message', 
                '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Stop! </strong> Designation already exist!.
                </div>'
            );
            redirect('/update_college/'.$id);
        }
    }

    function deleteCollege($id)
    {
        $this->load->model('admin/college');
        $exist = $this->college->checkExistinse($id);

        if ($exist == true) {
            $this->session->set_flashdata('message', 
                '<div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Oops! </strong> Unable to delete! College in use!.
                </div>'
            );
        }
        else{
            $this->college->deleteCollege($id);
            $this->session->set_flashdata('message', 
                '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success! </strong> College successfully deleted!.
                </div>'
            );
        }
        redirect('/college');
    }
}

?>