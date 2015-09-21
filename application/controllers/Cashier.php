<?php
/*
| -------------------------------------
| @file  : Cashier.php
| @date  : 3/25/2015
| @author:
| -------------------------------------
*/

class Cashier extends CI_Controller {

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
    function OpenCashWindow()
    {
        $this->head();
        $this->load->view('cashier/open_cashwindow');
        $this->load->view('templates/footer');
    }
    function addEnrolPayment()
    {
        $this->head();
        $this->load->view('cashier/add_enrolpayment');
        $this->load->view('templates/footer');
    }
    function addExamPayment()
    {
        $this->head();
        $this->load->view('cashier/add_exampayment');
        $this->load->view('templates/footer');
    }
    function listServiceRequested()
    {
        $this->head();
        $this->load->view('cashier/list_servicerequested');
        $this->load->view('templates/footer');
    }
    function viewCashierMovement()
    {
        $this->head();
        $this->load->view('cashier/view_cashiermovement');
        $this->load->view('templates/footer');
    }
    function addCashOut()
    {
        $this->head();
        $this->load->view('cashier/add_cashout');
        $this->load->view('templates/footer');
    }
    function addservicpayment()
    {
        $this->head();
        $this->load->view('cashier/add_servicepayment');
        $this->load->view('templates/footer');
    }
    function searchstud($id)
    {
      $id   = urldecode($id);
      $data = array();
      $this->load->model('cashier/account');
      $results_id = $this->account->search_account($id);
      foreach ($results_id as $r)
      {
          $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
      }
      echo json_encode($data);
    }
    function accmove()
    {
      $id = $this->load->model('cashier/account');
    }
}
