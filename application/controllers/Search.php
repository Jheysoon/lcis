<?php

class Search extends CI_Controller
{
    function search_by_id($id)
    {
        $this->load->model('registrar/party');

        // clean the url since the request is a get method
        $id         = urldecode($id);
        $data       = array();
        $results_id = $this->party->searchId($id);
        $stat       = $this->session->userdata('status');

        foreach ($results_id as $r) {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
        }

        echo json_encode($data);
    }

    function search_forpayment($id)
    {
        $this->load->model('registrar/party');
        $id         = urldecode($id);
        $data       = array();
        $results_id = $this->party->search_pay($id);

        foreach ($results_id as $r) {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
        }

        echo json_encode($data);
    }

    function search_sub($txt)
    {
        $txt    = urldecode($txt);
        $data   = array();
        $r      = $this->db->query("SELECT name, descriptivetitle FROM tbl_subject
                      WHERE code LIKE '%$txt%'
                      OR descriptivetitle
                      LIKE '%$txt%'
                      ORDER BY code LIMIT 10 ")->result_array();

        foreach ($r as $rr) {
            $data[] = array('value' =>  $rr['code'], 'name' => $rr['descriptivetitle']);
        }

        echo json_encode($data);
    }
}