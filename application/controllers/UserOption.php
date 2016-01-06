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
                $data['header'] = set_value('header');

                $this->api->userMenu();
                $this->load->view('admin/option');
                $this->load->view('templates/footer');
            } else {
                $data['link']   = $path;
                $data['desc']   = $option;
                $data['header'] = $this->input->post('header');

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

    public function delete($id)
    {
        $this->db->where('optionid', $id);
        $p = $this->db->count_all_results('tbl_useroption');

        if ($p > 0) {
            $this->api->set_session_message('danger', 'Option is in Used');

            redirect('/menu/admin-option');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('tbl_option');

            $this->api->set_session_message('success', 'Option Deleted');

            redirect('/menu/admin-option');
        }

    }

    public function add_option_header()
    {
        $header = ucwords($this->input->post('header'));

        // check for duplicate
        $this->db->where('name', $header);
        $c = $this->db->count_all_results('tbl_option_header');

        if ($c > 0) {
            $this->api->set_session_message('danger', 'Option Header Already Exists');
        } else {
            $data['name'] = $header;
            $this->db->insert('tbl_option_header', $data);

            $this->api->set_session_message('success', 'Successfully Inserted');
        }

        redirect('/menu/admin-header');
    }

    public function delete_header($id)
    {
        $this->db->where('header', $id);
        $c = $this->db->count_all_results('tbl_useroption');

        if ($c > 0) {
            $this->api->set_session_message('danger', 'Option Header In Use', 'message2');
        } else {

            // check first if the header id exists in table
            $this->db->where('id', $id);
            $c = $this->db->count_all_results('tbl_option_header');

            if ($c > 0) {
                $this->db->where('id', $id);
                $this->db->delete('tbl_option_header');
            }

            $this->api->set_session_message('success', 'Successfully Deleted', 'message2');
        }

        redirect('/menu/admin-header');
    }
}
