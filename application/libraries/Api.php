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
	/* ***** to be removed ********** */
	function getCourse($id)
	{
		$this->CI->load->model('registrar/course');
		return $this->CI->course->getCourse($id);
	}

	function getMajor($id)
	{
		return $this->CI->db->query("SELECT * FROM tbl_major WHERE id = (SELECT major FROM tbl_coursemajor WHERE id = $id)");
	}
	#######################

	function getCourseMajor($id)
	{
		$this->CI->load->model('registrar/course');
		$m = '';
		$course = $this->CI->course->getCourse($id);
		$major 	= $this->CI->db->query("SELECT * FROM tbl_major WHERE id = (SELECT major FROM tbl_coursemajor WHERE id = $id)");
		if($major->num_rows() > 0)
		{
			$mm = $major->row_array();
			$m = '('.$mm['description'].')';
		}
		return $course.' '.$m;
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
			return 'error';
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

	// 1:00-3:00 / 2:00-5:00

	//$from = 1:00,	$from_compare 	= 2:00
	//$to 	= 3:00,	$to_compare 	= 5:00
    function intersectCheck($from, $from_compare, $to, $to_compare){
        $from = strtotime($from);
        $from_compare = strtotime($from_compare);
        $to = strtotime($to);
        $to_compare = strtotime($to_compare);
        $intersect = min($to, $to_compare) - max($from, $from_compare);
            if ( $intersect < 0 ) $intersect = 0;
            $overlap = $intersect / 3600;
            if ( $overlap <= 0 ):
                // There are no time conflicts
                return FALSE;
                else:
                // There is a time conflict
                // echo '<p>There is a time conflict where the times overlap by ' , $overlap , ' hours.</p>';
                return TRUE;
            endif;
    }

    function getYearLevel($id){
    	$this->CI->load->model('dean/student');
		$yr = $this->CI->student->getYearLevel($id);
		if ($yr == 0) {
			$yr = 0;
		}
		else if ($yr == 1 || $yr == 2) {
			$yr = 1;
		}
		else if ($yr == 3 || $yr == 4) {
			$yr = 2;
		}
		else if ($yr == 5 || $yr == 6) {
			$yr = 3;
		}
		else{
			$yr = 4;
		}

		return $yr;

    }

    function set_session_message($type = 'success',$message,$name = 'message')
    {
    	$this->CI->session->set_flashdata($name,'<div class="alert alert-'.$type.'">'.$message.'</div>');
    }
}