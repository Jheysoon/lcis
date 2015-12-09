<?php 

class UserOption extends CI_Controller
{
    public function add_option()
    {
        $option = $this->input->post('option');
        $path   = ltrim($this->input->post('path'), '/');
        
        $this->db->where('link', $path);
        $p = $this->db->count_all_results('tbl_option');
        
        if ($p > 0) {
            $this->api->set_session_message('danger', 'Path already exists');
            $data['option'] = set_value('option');
            $data['path']   = set_value('path');
            
            $this->api->userMenu();
            $this->load->view('admin/option');
            $this->load->view('templates/footer');
        } else {
            $this->db->where('desc', $option);
            $op = $this->db->count_all_results('tbl_option');
            
            if ($op > 0) {
                $this->api->set_session_message('danger', 'Option already exists');
                $data['option'] = set_value('option');
                $data['path']   = set_value('path');
                
                $this->api->userMenu();
                $this->load->view('admin/option');
                $this->load->view('templates/footer');
            } else {
                $data['link'] = $path;
                $data['desc'] = $option;
                
                $this->db->insert('tbl_option', $data);
                $this->api->set_session_message('success', 'Option already exists');
            }
        }
    }
}