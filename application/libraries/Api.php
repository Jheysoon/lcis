<?php 

class Api
{
	protected $CI;

	function __construct()
	{
		$this->CI =& get_instance(); 
	}
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

        $col = $this->CI->common_dean->countAcam($this->session->userdata('uid'));
        if($col > 0)
        {
            $owner = $this->CI->common_dean->getColAcam($this->session->userdata('uid'));
            return $college = $owner['college'];
        }
        else
        {
            $c = $this->CI->common_dean->countAdmin($this->session->userdata('uid'));
            if($c > 0)
            {
                $owner = $this->CI->common_dean->getColAdmin($this->session->userdata('uid'));
                $o = $owner['office'];
                $of = $this->CI->common_dean->getOffice($o);
                return $college = $of['college'];
            }
            else
            {
                return $college = 0;
            }
        }
	}
}