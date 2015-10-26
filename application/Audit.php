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
        $this->session->set_userdata('audit', 0);
        $data['headertitle'] = 'List of Billing';
        $this->load->view('billing/list_billing', $data);
        $this->load->view('templates/footer');
    }
    function view_std($id)
    {
        redirect('/billing/view_studentbilling/'.$id);
    }

}