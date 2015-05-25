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
}