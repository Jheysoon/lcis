<?php
class Billing extends CI_Controller
	{
		  private function head()
			    {
			    	 $this->load->model(array(
			            'home/option',
			            'home/option_header',
			            'home/useroption'
			        ));
			        $this->load->view('templates/header');
			        $this->load->view('templates/header_title2');
			    }
			    function view_bill($legacyid){
			    		$this->head();
			    		$this->load->model('cashier/assesment');
			    		$data['legacyid'] = $legacyid;
							$this->load->model('dean/student');
							$this->student->getCalculation(32864);
			    		$this->load->view('audit/view_assesment', $data);

			    }
			    function view_studentbilling($type, $legacyid){
				    	$this->head();
				    	$this->load->model('cashier/assesment');
				    	$data['legacyid'] = $legacyid;
				    	$data['type'] = $type;
				    	$this->load->view('audit/view_studentbilling', $data);

			    }
			    function search(){
			    	redirect('/billing/view_bill/'.$this->input->post('search'));
			    }
			    function posting(){
						 $amountpaid = $this->input->post('payment');
						 $override = $this->input->post('override');
						 $enrolid = $this->input->post('enrolid');
			    }
					function payments_posting(){

					}
	}
