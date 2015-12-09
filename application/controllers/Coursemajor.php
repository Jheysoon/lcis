<?php 
	
	/**
	* Adding Course Major
	*/
	class Coursemajor extends CI_Controller
	{
		function add_course()
		{

			$this->load->helper('form');
			$this->load->model('courses/coursemajormd');
			$this->load->view('templates/header');
			$this->api->userMenu();
			$this->load->view('course/coursemajor');
			$this->load->view('templates/footer');
		}
		function insert_course()
		{
			$desc = $this->input->post('desc');
			$shortname = $this->input->post('shortname');
			$college = $this->input->post('college');
			$school = $this->input->post('school');

			if ($college == 0 ) 
			{
				$this->api->set_session_message('danger','Please Select College', 'messages');
				$this->add_course();
			}
			elseif ($school == 0)
			{
				$this->api->set_session_message('danger','Please Select School', 'messages');
				$this->add_course();
			}
			else
			{
				$data = array('description' => strtoupper($desc), 'shortname' => strtoupper($shortname), 'college' => $college, 'own' => $school);

				// print_r($data);
				$this->db->insert('tbl_course', $data);
				$this->api->set_session_message('success','Succesfuly Added', 'messages');
				redirect('/add_course');
			}
		
		}
		function delete_course($id)
		{
			$this->api->set_session_message('success','Succesfuly Deleted', 'messages');
			$this->db->where('id', $id);
			$this->db->delete('tbl_course');
			redirect('/add_course');
		}
	}
