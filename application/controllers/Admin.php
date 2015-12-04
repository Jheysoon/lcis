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
        $this->load->view('admin/designation');
		$this->load->view('templates/footer');
	}
}

?>