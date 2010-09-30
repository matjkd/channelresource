<?php 

class Ajax extends My_Controller {

	function Ajax()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('prospect_model');
	}
	function index()
	{
		
	}
	function get_customers()
	{
	$data['items'] = $this->prospect_model->list_customers($this->uri->segment(3));
	$this->load->vars($data);
	$this->load->view('ajax/list');
	}
	function get_customers2()
	{
	$data['items'] = $this->prospect_model->list_customers($this->uri->segment(3));
	$this->load->vars($data);
	$this->load->view('ajax/listcustomers');
	}
	function get_companies()
	{
	$data['items'] = $this->Membership_model->get_companies('','');
	$this->load->vars($data);
	$this->load->view('ajax/listcompanies');
	}
	
	
	
	
function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('message', 'you are not logged in');
			redirect('user/login');
                       
		}		
	}	
	
}