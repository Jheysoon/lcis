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
                $this->api->set_session_message('success', 'Successfully Inserted');
            }
        }
    }
    
    public function update_option()
    {
        $id     = $this->input->post('id');
        $path   = $this->input->post('form_path');
        $desc   = $this->input->post('form_desc');
        
        $this->db->where('link', $path);
        $pp = $this->db->count_all_results('tbl_option');
        
        if ($pp > 0) {
            $this->api->set_session_message('danger', 'Path already exists');
            
            redirect('/menu/admin-option');
        } else {
            
            $this->db->where('desc', $desc);
            $d = $this->db->count_all_results('tbl_option');
            
            if ($d > 0) {
                $this->api->set_session_message('danger', 'Description already exists');
                
                redirect('/menu/admin-option');
            } else {
                $data = array('link' => $path, 'desc' => $desc);
                $this->db->where('id', $id);
                $this->db->update('tbl_option', $data);
                
                redirect('/menu/admin-option');
            }
            
        }
    }
}