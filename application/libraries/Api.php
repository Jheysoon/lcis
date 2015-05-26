<?php 

class Api
{
	protected $CI;

	//initialize the $CI variable
	function __construct()
	{
		$this->CI =& get_instance(); 
	}

	/*	getCourse by id
	*	@param id int
	*	@return int course id
	*/
	function getCourse($id)
	{
		$this->CI->load->model('registrar/course');
		return $this->CI->course->getCourse($id);
	}

	function getMajor($id)
	{
		return $this->CI->db->query("SELECT * FROM tbl_major WHERE id = (SELECT major FROM tbl_coursemajor WHERE id = $id)");
	}

	function getUserCollege()
	{
		$this->CI->load->model(array(
            'dean/subject',
            'dean/common_dean'
        ));

        $col = $this->CI->common_dean->countAcam($this->CI->session->userdata('uid'));
        if($col > 0)
        {
            $owner = $this->CI->common_dean->getColAcam($this->CI->session->userdata('uid'));
            return $owner['college'];
        }
        else
        {
            $c = $this->CI->common_dean->countAdmin($this->CI->session->userdata('uid'));
            if($c > 0)
            {
                $owner = $this->CI->common_dean->getColAdmin($this->CI->session->userdata('uid'));
                $o = $owner['office'];
                $of = $this->CI->common_dean->getOffice($o);
                return $of['college'];
            }
            else
            {
                return 0;
            }
        }
	}

	function systemValue()
	{
		return $this->CI->db->get('tbl_systemvalues')->row_array();
	}

	// this function checks if the user has the right/access for that menu
	function verifyUserAccess($url)
	{
		$user = $this->CI->session->userdata('uid');
		$this->CI->db->where('link',$url);
		$q = $this->CI->db->get('tbl_option');
		if($q->num_rows() > 0)
		{
			$option = $q->row_array();
			$option_id = $option['id'];
			$this->CI->db->where('optionid',$option_id);
			$this->CI->db->where('userid',$user);
			$count = $this->CI->count_all_results('tbl_useroption');
			if($count > 0)
				return 'ok';
			else
				return 'error';
		}
		else
		{
			return 'error';
		}
	}

	function userMenu()
	{
		$this->CI->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));
        
        $this->CI->load->view('templates/header');
        $this->CI->load->view('templates/header_title2');
	}
}