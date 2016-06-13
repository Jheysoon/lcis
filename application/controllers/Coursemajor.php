<?php 
	
	/**
	* Adding Course Major
	*/
	class Coursemajor extends CI_Controller
	{
		function add_course()
		{
			$data['cid'] = 0;
			$this->load->helper('form');
			$this->load->model('courses/coursemajormd');
			$this->load->view('templates/header');
			$this->api->userMenu();
			$this->load->view('course/coursemajor', $data);
			$this->load->view('templates/footer');
		}
		function insert_course()
		{
			$desc = $this->input->post('desc');
			$shortname = $this->input->post('shortname');
			$college = $this->input->post('college');
			$school = $this->input->post('school');
			$cids = $this->input->post('cid');
			$data = array('description' => strtoupper($desc), 'shortname' => strtoupper($shortname), 'college' => $college, 'own' => $school);


			if ($this->input->post('cid') == 0) 
			{
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
					$this->db->insert('tbl_course', $data);
					$courseid = $this->db->insert_id();
					$this->db->insert('tbl_coursemajor', array('course' => $courseid));
					$this->api->set_session_message('success','Successfully Added', 'messages');
					redirect('/add_course');
				}
			}
			else
			{
				$this->api->set_session_message('success','Successfully Updated', 'messages');
				$this->db->where('id', $cids);
				$this->db->update('tbl_course', $data);
				redirect('/add_course');
			}
			
		
		}
		function delete_course($id)
		{
			$x = $this->db->query("SELECT course FROM tbl_coursemajor WHERE course = $id")->num_rows();
			
			if ($x > 0) {
				$this->api->set_session_message('danger','This course is in use. It cannot be deleted.', 'messages');
			}else{
				$this->api->set_session_message('success','Successfully Deleted', 'messages');
				$this->db->where('id', $id);
				$this->db->delete('tbl_course');
			}
			
			redirect('/add_course');
		}
		function update_course($id)
		{
			$data['cid'] = $id;
			$this->load->helper('form');
			$this->load->model('courses/coursemajormd');
			$this->load->view('templates/header');
			$this->api->userMenu();
			$this->load->view('course/coursemajor', $data);
			$this->load->view('templates/footer');
		}
		function add_major()
		{
			$data['mid'] = 0;
			$this->load->helper('form');
			$this->load->model('courses/coursemajormd');
			$this->load->view('templates/header');
			$this->api->userMenu();
			$this->load->view('course/major', $data);
			$this->load->view('templates/footer');
		}
		function insert_major()
		{
			$this->load->model('courses/coursemajormd');
			$mid = $this->input->post('mid');
			$major = ucwords(strtolower($this->input->post('major')));
			$chk = $this->coursemajormd->check_exist($major);
			
			if ($mid == 0) 
			{
				if ($chk > 0) 
				{
					$this->api->set_session_message('danger','Major already Exist.', 'messages');
					$this->add_major();
				}
				else
				{
					$this->api->set_session_message('success','Major successfuly added.', 'messages');
					$this->db->insert('tbl_major', array('description' => $major));
					redirect('/add_major');
				}
			}
			else
			{
				$chk = $this->coursemajormd->chk_by_id($mid, $major);
				if ($chk > 0) {
					$this->api->set_session_message('danger','Major already Exist.', 'messages');
					$this->add_major();
				}else{
					$this->api->set_session_message('success','Major successfuly updated.', 'messages');
					$this->db->where('id', $mid);
					$this->db->update('tbl_major', array('description' => $major));
					redirect('/add_major');
				}
			}
		}
		function delete_major($id)
		{
			$this->load->model('courses/coursemajormd');
			$chk = $this->coursemajormd->check_m($id);
			if ($chk > 0) {
				$this->api->set_session_message('danger','This major is in use. It cannot be deleted.', 'messages');
				$this->add_major();
			}
			else{
				$this->api->set_session_message('success','Major Successfuly deleted.', 'messages');
				$this->db->where('id', $id);
				$this->db->delete('tbl_major');
				redirect('/add_major');
			}
		}
		function update_major($id)
		{
			$data['mid'] = $id;
			$this->load->helper('form');
			$this->load->model('courses/coursemajormd');
			$this->load->view('templates/header');
			$this->api->userMenu();
			$this->load->view('course/major', $data);
			$this->load->view('templates/footer');
		}
	}

