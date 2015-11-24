<?
class Discount extends CI_Controller
{
	
	function student_list()
	{
		$this->api->userMenu();
		$this->load->library('pagination');
		$this->load->model('registrar/enrollment');
		$this->load->model('registrar/party');
		$this->load->model('registrar/course');
		$this->load->view('discount/discount_list');
		$this->load->view('templates/footer');
	}
	
	function view_discounts($legacyid)
	{
		$this->load->model('discount/discountmd');
		$this->api->userMenu();
		$data['legacyid'] = $legacyid;
		$this->load->view('discount/add_discount', $data);
		$this->load->view('templates/footer');

	}
	
	function disc_submit()
	{
		redirect('/view_discount/'. $this->input->post('stats'));
	}
}