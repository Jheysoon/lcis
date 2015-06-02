<?php
/**
* @author : Gregorio Sonit
*/
class Scholarship extends CI_Controller
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
    function viewscholarship(){
    	$this->head();
    	$this->load->view('scholarship/scholarshipinfo');
    }
     function search()
    {
        $this->load->model('registrar/party');
        $id = $this->input->post('search');
        $id1 = $this->party->existsID($id);
        if ($id1 > 0)
        {
            redirect('/scholarshipinfo/' . $id);
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Unable to find student id</div>');
            redirect($this->input->post('cur_url'));
        }
    }
    function search_by_id($id)
    {
        $id = urldecode($id);
        $data = array();
        $this->load->model('scholar/scholarship');
        $results_id = $this->scholarship->searchId($id);
        foreach ($results_id as $r)
        {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['firstname'] . ' ' . $r['lastname']);
        }
        echo json_encode($data);
    }
}