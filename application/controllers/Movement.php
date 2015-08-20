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
      $params = $this->input->post('search');
      $data['param'] = $this->input->post('search');
      redirect('/student-movement/view_movement/'.$params);
      // $this->load->view('audit/view_student_movement', $data);
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
           echo $dates = $this->input->post('d-'.$i);
           $this->db->query("UPDATE tbl_movement SET amount = '$vals', systemdate = '$dates', valuedate = '$dates' WHERE id = '$movid'");
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
    function add_movement()
    {
        $this->load->model('cashier/account');
        $type = $this->input->post('type');
        $dates = $this->input->post('dates');
        $amount = $this->input->post('amount');
        $academicterm = $this->input->post('academicterm');
        $ref = $this->input->post('referencetype');
        $desc = $this->input->post('description');
        $partyid = $this->input->post('party');

        $checking = $this->account->checkexist($type, $dates, $amount, $academicterm, $ref, $desc, $partyid);
        echo $checking;
        if ($checking == 1)
        {
            if ($type == "D")
            {
                $this->account->insertBill($type, $dates, $amount, $academicterm, $ref, $desc, $partyid);

            }
            elseif ($type == "C")
            {
              # code...
            }
        }


        //$this->db->query();
        // echo $type . "<br />";
        // echo $partyid . "<br />";
        // echo $dates. "<br />";
        // echo $amount. "<br />";
        // echo $academicterm. "<br />";
        // echo $ref. "<br />";
        // echo $desc. "<br />";
    }
    function view_ref()
    {
      $this->load->model('cashier/account');
      $data['reftype'] = $this->input->post('reftype');
      $data['refid'] = $this->input->post('refid');
      if ($this->input->post('reftype') <= 5) {
            $this->load->view('audit/view_ref', $data);
      }else{

            $this->load->view('audit/view_payment', $data);
      }

    }
}
