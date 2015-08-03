<?php
/**
 *
 */
class Movement extends CI_Controller
{
  private function head()
  {
      $this->api->userMenu();
  }
    function asset($param){
      $this->load->library('pagination');
      $this->head();
      $data['param'] = $param;
      $this->load->model('cashier/account');
      $this->load->view('audit/accountlist', $data);
      $this->load->view('templates/footer');

    }
    function income($param){
      $this->head();
      $data['param'] = $param;
      $this->load->model('cashier/account');
      $this->load->view('audit/incomeaccount', $data);
      $this->load->view('templates/footer');

    }
    function view_movement($param){
      $this->head();
      $this->load->model('cashier/account');
      $data['param'] = $param;
      $this->load->view('audit/view_student_movement', $data);
      $this->load->view('templates/footer');

    }

}
