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
							$this->student->getCalculation(21758);
			    		$this->load->view('audit/view_assesment', $data);

			    }
			    function view_studentbilling($legacyid){
				    	$this->head();
				    	$this->load->model('cashier/assesment');
				    	$data['legacyid'] = $legacyid;
				    	$data['type'] = 'installment';
							// $this->load->model('dean/student');
							// $this->student->getCalculation(36868);
				    	$this->load->view('audit/view_studentbilling', $data);
							$this->load->view('templates/footer');

			    }
			    function search(){
			    		redirect('/billing/view_studentbilling/'.$this->input->post('search'));
			    }
			    function posting(){
						$uid = $this->session->userdata('uid');
						$getAcad = $this->api->systemValue();
						$phase = $getAcad['phase'];
						$phaseterm = $getAcad['phaseterm'];
					 	$amountpaid = $this->input->post('amount_paid');
						$override = $this->input->post('override');
					 	$enrolid = $this->input->post('enrolid');
						$legacyid = $this->input->post('legacyid');
						$total_due = $this->input->post('total_due');
						$type = $this->input->post('type');
						$or_no = $this->input->post('or_no');
						$fullpay = $this->input->post('fullpay');


					$suc = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
					$alerts = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
									if ($override == ""){
											if ($amountpaid < $total_due) {
											 $this->session->set_flashdata('message', $alerts . 'Not Enoug payment.</div>');
												redirect('/billing/view_studentbilling/' . $legacyid);

										}else{
												$this->do_posting($amountpaid, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid);
										}
									}else{

											if ($amountpaid < $override) {
													$this->session->set_flashdata('message', $alerts . 'Not Enoug payment.</div>');
													redirect('/billing/view_studentbilling/' . $legacyid);
												}
												else{
													if ($amountpaid >= $fullpay AND $fullpay != "") {
														//$amountpaid = $amountpaid - $total_due;
															$ful = 1;
															$this->do_posting($fullpay, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid, $ful);
													}else{
														 	$ful = 0;
															$this->do_posting($amountpaid, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid, $ful);
													}

												}
										}
					}
					function do_posting($amountpaid, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid, $ful){
							$this->load->model('cashier/assesment');
							$billid = $this->assesment->getBillingIds($enrolid);
							$coursemajor = $this->assesment->getCrs($enrolid);
							$checking = $this->assesment->checkpayment($billid);
							$or_date = Date('Y-m-d');
							if ($checking > 0) {

								echo $ful;
								echo $amountpaid;

								$this->assesment->insertpayment($billid, $amountpaid, $or_no, $phaseterm, $phase, $uid, $or_date);
								$paymentid = $this->db->insert_id();
								$am = '-'.$amountpaid;
								$counted = 0;
								$this->assesment->paymentmovement($am, $paymentid, $billid, $counted);
							}else{
										$this->assesment->insertpayment($billid, $amountpaid, $or_no, $phaseterm, $phase, $uid, $or_date);
										$paymentid = $this->db->insert_id();
										$this->assesment->insertmovement($billid, $coursemajor,$amountpaid, $ful);
										$am = '-'.$amountpaid;
										$counted = 1;
										echo $ful;
										$this->assesment->paymentmovement($am, $paymentid, $billid, $counted);
							}
							 $leg = $this->assesment->getLeg($enrolid);
							redirect("billing/view_studentbilling/".$leg);
					}
					function endphase()
					{
								$this->load->model('cashier/assesment');
								$this->assesment->endofPhaseBillingPosting();
					}


	}
