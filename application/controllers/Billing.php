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
			    function view_bill(){
			    		$this->head();
			    		$this->load->view('audit/view_assesment');
			    }
			    function view_studentbilling($param, $x){
			    	$this->head();
			    	$data['param'] = $param;
			    	$data['x'] = $x;	
			    	$this->load->view('audit/view_studentbilling', $data);
			    }
	}



	 