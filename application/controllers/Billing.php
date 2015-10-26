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

    function view_bill($legacyid)
	{
		$this->head();
		$this->load->model('cashier/assesment');
		$data['legacyid'] = $legacyid;
		$this->load->view('audit/view_assesment', $data);
    }

    function view_studentbilling($legacyid)
	{
	    $this->head();
    	$this->load->model(array('cashier/assesment', 'dean/student'));
    	$data['legacyid'] = $legacyid;
    	$data['type'] = 'installment';
    	$this->load->view('audit/view_studentbilling', $data);
		$this->load->view('templates/footer');
    }

    function searcheds()
	{
		redirect('/billing/view_studentbilling/'.$this->input->post('stats'));
    }

	function posting()
	{
		$uid 		= $this->session->userdata('uid');
		$getAcad 	= $this->api->systemValue();
		$phase 		= $getAcad['phase'];
		$phaseterm 	= $getAcad['phaseterm'];
		$amountpaid = $this->input->post('amount_paid');
		$override 	= $this->input->post('override');
		$enrolid 	= $this->input->post('enrolid');
		$legacyid 	= $this->input->post('legacyid');
		$total_due 	= $this->input->post('total_due');
		$type 		= $this->input->post('type');
		$or_no 		= $this->input->post('or_no');
		$fullpay 	= $this->input->post('fullpay');

		//BILLING POSTING AND PAYMENT POSTING..
		$suc = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
		$alerts = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
		if ($override == "")
		{
			if ($amountpaid < $total_due)
			{
				$this->session->set_flashdata('message', $alerts . 'Not Enoug payment.</div>');
				redirect('/billing/view_studentbilling/' . $legacyid);
			}
			else
			{
				$this->do_posting($amountpaid, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid);
			}
		}
		else
		{

			if ($amountpaid < $override)
			{
				$this->session->set_flashdata('message', $alerts . 'Not Enoug payment.</div>');
				redirect('/billing/view_studentbilling/' . $legacyid);
			}
			else
			{
				if ($amountpaid >= $fullpay AND $fullpay != "") {
					//$amountpaid = $amountpaid - $total_due;
					$ful = 1;
					$this->do_posting($fullpay, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid, $ful);
				}
				else
				{
					$ful = 0;
					$this->do_posting($amountpaid, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid, $ful);
				}
			}
		}
	}
	function do_posting($amountpaid, $override, $enrolid, $legacyid, $total_due, $type, $or_no, $phase, $phaseterm, $uid, $ful)
	{
		$this->load->model('cashier/assesment');
		$billid = $this->assesment->getBillingIds($enrolid);
		$coursemajor = $this->assesment->getCrs($enrolid);
		$checking = $this->assesment->checkpayment($billid);
		$or_date = Date('Y-m-d');
		if ($checking > 0)
		{
			echo $ful;
			echo $amountpaid;
			$this->assesment->insertpayment($billid, $amountpaid, $or_no, $phaseterm, $phase, $uid, $or_date);
			$paymentid = $this->db->insert_id();
			$am = '-'.$amountpaid;
			$counted = 0;
			$this->assesment->paymentmovement($am, $paymentid, $billid, $counted);
		}
		else
		{
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
	function billcalculation($enid)
	{
			$this->load->model('dean/student');
			$this->load->model('cashier/assesment');
			//Function to get the coursemajor and the party id of the student
			$enr_info = $this->student->enr_info($enid);
			$coursemajor = $enr_info['coursemajor'];
			$partyid = $enr_info['partyid'];
			$billid = 0;
			$updates = 0;
			// ---------------------------- //


			$check_billclass = $this->student->check_billclass($enid);
			if ($check_billclass > 0) {
				//Get Bill Id
					$billid = $this->student->get_billid($enid);
					$updates = 1;
			}
			else
			{
				//Function Insert Into Tbl_bill firstname
				$data_bill = array('requestedby' => $partyid,
													 'datecreated' => Date('Y-m-d'),
													 'enteredby' => $this->session->userdata('uid'),
													 'status' => 'R',
													 'type' => '1');
				$billid = $this->student->insert_bill($data_bill);
				// ------------------------------ //
			}
			//Function to get all fees based on coursemajor of the student
		foreach ($this->student->get_fees($coursemajor) as $key => $value)
			{
					$the_rate = 0;
					extract($value);
					if ($feetype == 1)
					{
						//Get Total Units. And Calculate for the Matriculation
						$units = $this->student->get_sub_unit($enid);
						$the_rate = $units * $rate;
					}
					elseif ($feetype == 2)
					{
						//Get Total Units. And Calculate for the Tution
						$units = $this->student->get_sub_unit($enid);
						$the_rate = $units * $rate;
					}
					elseif ($feetype == 18)
					{
						//Get No. of Subject and Calculate by no. of subject * rate * per exam
						$nosubject = $this->student->get_total_subj($enid);
						$the_rate = $nosubject * $rate * 4;
					}
					elseif ($feetype == 20)
					{
						//Get Chem Lab.
						$chem_lab = $this->student->get_chem($enid);
						if ($chem_lab > 0)
						{
							$the_rate = $rate;
						}
						else
						{
							$the_rate = 0;
						}
					}
					elseif ($feetype == 17)
					{
						//Get No. of computer subject and calculate computer subject by no. of computersubject * rate;
						$get_comp = $this->student->get_comp($enid);
						if ($get_comp > 0)
						{
							$the_rate = $get_comp * $rate;
						}
						else
						{
							$the_rate = 0;
						}
					}
					elseif ($feetype == 15)
					{
						//NSTP.
						$get_nstp = $this->student->get_nstp($enid);
						if ($get_nstp > 0)
						{
							$the_rate = $get_nstp * $rate;
						}
						else
						{
							$the_rate = 0;
						}
					}
					else
					{
							$the_rate = $rate;
					}

					if ($the_rate > 0)
					{
						$data = array('bill' => $billid, 'fee' => $fid, 'amount' => $the_rate);
						$this->student->insertbilldetail($data);
					}
			}
			if ($billid != 0)
			{
					$tui = 0;
					$int = 0;
					$boo = 0;
					$comp = 0;
					$netenrol = 0;
					$id = 0;
					$get_billdetail = $this->student->getdetail($billid);
					foreach ($get_billdetail as $key => $value)
					{

						extract($value);
						if ($id == 2)
						{
							 $tui = $amount / 5;
						}
						elseif ($id == 16)
						{
							$int = $amount / 4;
						}
						elseif ($id == 18)
						{
							$boo = $amount / 4;
						}
						elseif ($id == 17)
						{
							$comp = $amount / 5;
						}
						else
						{
							$netenrol += $amount;
						}
					
					}

					$netpr = $tui + $int + $boo + $comp;
					$ens = $netenrol + $tui;
					echo $ens . "<br />";
					$data = array('id' => $billid, 'enrolment' => $enid,
												'netenrolment' => $ens, 'netprelim' => $netpr,
												'netmidterm' => $netpr, 'netsemi' => $netpr, 'netfinal' => $netpr);
						if ($updates == 1)
						{
							$this->student->update_billclass($data, $billid);
							//$this->assesment->revertPosting($billid);
						}
						else
						{
							$this->student->insert_billclass($data);
						}
			}
		}
		// function get_all_enrolment()
		// {
		// 	$x = $this->db->query("SELECT * FROM out_enr")->result_array();
		// 	foreach ($x as $key => $value) {
		// 			$this->billcalculation($value['id']);
		// 	}
		// }
		// function delete_bills()
		// {
		// 	$x = $this->db->query("SELECT  tbl_billclass.id, tbl_billclass.enrolment, tbl_enrolment.coursemajor, tbl_enrolment.numberofsubject
		// 					  FROM tbl_studentgrade, tbl_billclass, tbl_enrolment
		// 					  WHERE tbl_billclass.netenrolment =842
		// 					  AND tbl_billclass.enrolment = tbl_studentgrade.enrolment
		// 					  AND tbl_enrolment.id = tbl_billclass.enrolment")->result_array();
		// 	foreach ($x as $key => $value) {
		// 		$this->db->where('id', $value['id']);
		// 		$this->db->delete('tbl_bill');

		// 		$this->db->where('id', $value['id']);
		// 		$this->db->where('enrolment', $value['enrolment']);
		// 		$this->db->delete('tbl_billclass');

		// 		$this->db->where('bill', $value['id']);
		// 		$this->db->delete('tbl_billclassdetail');


		// 		$this->db->where('id', $value['enrolment']);
		// 		$this->db->delete('tbl_enrolment');
		// 	}
		// }
}