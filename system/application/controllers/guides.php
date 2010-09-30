<?php 

class Guides extends My_Controller {

	function Guides()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('guide_model');
	}
	function index()
	{
		$data['title'] = 'Introduction To Lease-Desk';
		$this->load->vars($data);
		$data['main'] = '/guides/main';
		$data['flash'] = 'yes';
		$guide_id = $this->uri->segment(3);
		$data['guide'] = $this->guide_model->get_guide($guide_id);
		$this->load->vars($data);
		$this->load->view('template');
	}
	function viewguide()
	{
		$guide_id = $this->uri->segment(3);
		$data['guide'] = $this->guide_model->get_guide($guide_id);
		$data['main'] = '/guides/main';
		$data['flash'] = 'yes';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	
	
function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('message', 'You are not logged in');
			redirect('user/login');
                       
		}		
	}	
	
}