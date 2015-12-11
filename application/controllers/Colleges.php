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
        $this->load->view('admin/college');
		$this->load->view('templates/footer');
	}
}

?>