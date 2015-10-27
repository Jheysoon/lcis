<?php
/*
| -------------------------------------
| @file  : Audit.php
| @date  : 3/25/2015
| @author:
| -------------------------------------
*/

class Audit extends CI_Controller {

    private function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }
    function viewtStudentBilling()
    {
        $this->head();
        $this->load->view('audit/view_studentbilling');
        $this->load->view('templates/footer');
    }
    function listAllAccount()
    {
        $this->head();
        $this->load->view('audit/account_list');
        $this->load->view('templates/footer');
    }
    function viewCashierAccountMovement()
    {
        $this->head();
        $this->load->view('audit/view_cashieraccountmovement');
        $this->load->view('templates/footer');
    }
    function payment_override()
    {
        $this->api->userMenu();
        $this->load->library('pagination');
        $this->load->model('registrar/enrollment');
        $this->load->model('registrar/party');
        $this->load->model('registrar/course');
        $this->session->set_userdata('audit', 1);
        $data['headertitle'] = 'Paymen Override';
        $this->load->view('billing/list_billing', $data);
        $this->load->view('templates/footer');

    }
    function list_billing()
    {
        $this->api->userMenu();
        $this->load->library('pagination');
        $this->load->model('registrar/enrollment');
        $this->load->model('registrar/party');
        $this->load->model('registrar/course');
        $this->session->set_userdata('audit', 0);
        $data['headertitle'] = 'List of Billing';
        $this->load->view('billing/list_billing', $data);
        $this->load->view('templates/footer');
    }
    function view_std($id)
    {


        $this->api->userMenu();
        $this->load->model(array('cashier/assesment', 'dean/student'));
        $data['legacyid'] = $id;
        $data['type'] = 'installment';
        $this->load->view('audit/view_studentbilling', $data);
        $this->load->view('templates/footer');

            // $this->head();
            // $this->load->model(array('cashier/assesment', 'dean/student'));
            // $data['legacyid'] = $legacyid;
            // $data['type'] = 'installment';
            // $this->load->view('audit/view_studentbilling', $data);
            // $this->load->view('templates/footer');
             // redirect('/billing/view_studentbilling/'.$id);
    }
    function view_override($id)
    {
        $this->api->userMenu();
        $this->load->model(array('cashier/assesment', 'dean/student'));
        $data['legacyid'] = $id;
        $data['type'] = 'installment';
        $this->load->view('audit/view_override', $data);
        $this->load->view('templates/footer');
    }
    function insert_override()
    {

        $this->load->model('cashier/assesment');
        $enrolid = $this->input->post('enrolid');
        $academ = $this->input->post('academ');
        $student = $this->input->post('student');
        $billid = $this->input->post('billid');
        $phase = $this->input->post('phase');
        $amount = $this->input->post('override');


        $data = array('academicterm' => $academ,
                      'enrolment' => $enrolid,
                      'student' => $student,
                      'billing' => $billid,
                      'phase' => $phase,
                      'amount' => $amount,
                      'dateapplied' => Date('Y-m-d'),
                      'approvedby' => $this->session->userdata('uid'));

        $this->assesment->insert_override($data);

        echo $enrolid . " | ". $academ . " | ". $student . " | ". $billid . " | ". $phase . " | ". $amount;
        redirect('/view_over/'.$this->input->post('legacyid'));
    }
}