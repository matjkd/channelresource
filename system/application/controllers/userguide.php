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
		$data['all_guides'] =  $this->guide_model->get_all_guides();
		$data['basic_guides'] =  $this->guide_model->get_guides(0);
		$data['normal_guides'] =  $this->guide_model->get_guides(1);
		$data['main_guides'] =  $this->guide_model->get_guides(2);
		$data['super_guides'] =  $this->guide_model->get_guides(3);
		$data['categories'] = $this->guide_model->get_guide_categories();
		$guide_id = $this->uri->segment(3);
		$data['guide'] = $this->guide_model->get_guide($guide_id);
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function viewguide()
	{
		$data['categories'] = $this->guide_model->get_guide_categories();	
		$data['all_guides'] =  $this->guide_model->get_all_guides();
		$data['basic_guides'] =  $this->guide_model->get_guides(0);
		$data['normal_guides'] =  $this->guide_model->get_guides(1);
		$data['main_guides'] =  $this->guide_model->get_guides(2);
		$data['super_guides'] =  $this->guide_model->get_guides(3);
		$data['main'] = '/guides/user_guide';
		
		
		
		$data['flash'] = 'yes';
		$guide_id = $this->uri->segment(3);
		$data['guide_id'] = $guide_id;
		$data['tags'] = $this->guide_model->get_all_tags();
		$data['assigned_tags'] = $this->guide_model->get_assigned_tags($guide_id);
		$data['guide'] = $this->guide_model->get_guide($guide_id);
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function addguide()
        {
            $this->guide_model->add_guide();
	    redirect('userguide/viewguide/');

        }
	function editguide($id)
	{
		$this->guide_model->update_guide($id);
		redirect('userguide/viewguide/'.$id);
	}
	
	function add_tag()
	{
	$segment_active = $this->uri->segment(3);
		if($segment_active==NULL)
		{
			redirect('welcome', 'refresh');
		}
		else
		{
			$this->guide_model->add_tag($segment_active);
			redirect('userguide/viewguide/'.$segment_active.'');   
		}
	}
	
	function delete_tag($id)
	{
			$data['guide_id'] = $this->guide_model->delete_assigned_tag($id);
			foreach($data['guide_id'] as $key => $row):
			$guide = $row['guide_id'];
			endforeach;
		
		redirect('userguide/viewguide/'.$guide.'', 'refresh');
		
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