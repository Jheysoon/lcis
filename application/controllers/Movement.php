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
    function accmov()
    {
      $this->head();
      $this->load->model('cashier/account');
      $data['param'] = $this->input->post('search');
      $this->load->view('audit/view_student_movement', $data);
      $this->load->view('templates/footer');
    }
    function update_mov()
    {
        $counter = $this->input->post('count');
        $accountid = $this->input->post('accountid');
        $param = $this->input->post('param');
        for ($i=1; $i < $counter; $i++) {
           $vals = $this->input->post('am-'.$i);
           $movid = $this->input->post('id-'.$i);
           $this->db->query("UPDATE tbl_movement SET amount = '$vals' WHERE id = '$movid'");
        }
        $this->move_update($accountid);

        redirect('/student-movement/view_movement/' . $param);
    }
    function up_mo($param)
    {
      $this->head();
      $this->load->model('cashier/account');
      $data['param'] = $param;
      $this->load->view('audit/edit_movement', $data);
      $this->load->view('templates/footer');
    }

    function move_update($accountid)
    {
        $x = $this->db->query("SELECT * FROM tbl_movement WHERE account = '$accountid' ORDER BY academicterm ASC, id  ASC, referenceid ASC")->result_array();
        $this->db->query("UPDATE tbl_account SET currentbalance = '0' WHERE id = '$accountid'");
        
        foreach ($x as $key => $value) {
          extract($value);
          $m = $this->db->query("SELECT currentbalance FROM tbl_account WHERE id = '$accountid'")->row_array();
          $curr = $m['currentbalance'];
          $totalbal = $curr + $amount;
          $this->db->query("UPDATE tbl_movement SET previousbalance = '$curr', amount = '$amount', runbalance = '$totalbal' WHERE id = '$id' AND account = '$accountid'");
          $this->db->query("UPDATE tbl_account SET currentbalance = '$totalbal' WHERE id = '$accountid'");
          echo $curr . "|" . $amount ."|". $totalbal ."<br />";
        }
    }
}
