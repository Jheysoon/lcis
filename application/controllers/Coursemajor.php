<?php 
	
	/**
	* Adding Course Major
	*/
	class Coursemajor extends CI_Controller
	{
		function add_course()
		{
			$this->load->view('templates/header');
			$this->api->userMenu();
			$this->load->view('course/coursemajor');
			$this->load->view('templates/footer');

			
		}
	}
