<?php 

class Userguide extends My_Controller {

	function __construct()
	{
		parent::__construct();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('guide_model');
	}
	function index()
	{
		
		$data['title'] = 'Introduction To Lease-Desk';
		$data['main'] = '/guides/user_guide';
		$data['flash'] = 'yes';
		
		$data['normal_guides'] =  $this->guide_model->get_guides(1);
		$data['main_guides'] =  $this->guide_model->get_guides(2);
		$data['super_guides'] =  $this->guide_model->get_guides(3);
		
		$guide_id = $this->uri->segment(3);
		$data['guide'] = $this->guide_model->get_guide($guide_id);
		$this->load->vars($data);
		$this->load->view('template');
	}
	function viewguide()
	{
		
		$data['normal_guides'] =  $this->guide_model->get_guides(1);
		$data['main_guides'] =  $this->guide_model->get_guides(2);
		$data['super_guides'] =  $this->guide_model->get_guides(3);
		$data['main'] = '/guides/user_guide';
		$data['flash'] = 'yes';
		$guide_id = $this->uri->segment(3);
		$data['guide'] = $this->guide_model->get_guide($guide_id);
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function editguide($id)
	{
		$this->guide_model->update_guide($id);
		redirect('userguide/viewguide/'.$id);
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