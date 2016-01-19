<?php
	/**
	* 
	*/
	class Viewing extends CI_Controller
	{
		
		function view_grades()
		{
			$x = $this->session->userdata('uid');
			$this->db->where('id', $x);
			$this->db->select('legacyid');
			$leg = $this->db->get('tbl_party')->row_array();
			$legacyid = $leg['legacyid'];


			$this->load->model(array(
            'registrar/tor'
	        ));

	        $this->api->userMenu();

	        $data['id'] = $legacyid;
	        $this->load->view('registrar/view_permanent_record', $data);
	        $this->load->view('templates/footer');


			//redirect('/registrar/permanentRecord/'.$legacyid);
		}
		function view_bills()
		{

			$x = $this->session->userdata('uid');
			$this->db->where('id', $x);
			$this->db->select('legacyid');
			$leg = $this->db->get('tbl_party')->row_array();
			$legacyid = $leg['legacyid'];



			$this->api->userMenu();
		    $this->load->model('cashier/account');
		    $data['param'] = $legacyid;
		    $data['ident'] = 1;
		    $this->load->view('audit/view_student_movement', $data);
		    $this->load->view('templates/footer');
		}
	}