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
}