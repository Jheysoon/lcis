<?php
/*
| -------------------------------------
| @file  : Audit.php
| @date  : 3/25/2015
| @author: Jayson Martinez
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

}