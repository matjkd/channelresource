<?php
class Profile extends MY_Controller {

function Profile()
	{
		parent::MY_Controller();
		
		$this->load->library(array('encrypt', 'form_validation'));
		$this->is_logged_in();
	}
	
	function view_user()
	{
		$segment_active = $this->uri->segment(3);
		if ($segment_active!=NULL)
		{
			$data['user_id'] = $this->uri->segment(3);
			$data['user_info'] = $this->Membership_model->get_user($data['user_id']);
		}
		else
		{
			$data['user_id'] = $this->session->userdata('user_id');
			$data['user_info'] = $this->Membership_model->get_user($data['user_id']);
		}
		$data['customercompany_id'] = $this->session->userdata('company_id');
		$data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);
		
		$data['rowcount'] = 0;
		if($data['ticket_list']!=NULL)
		{
		foreach($data['ticket_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		}
		$data['main'] = '/admin/view_user';
		$data['title'] = "User Details";
		$this->load->vars($data);
		$this->load->view('template');
		
		
	}
function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('welcome/');
		}		
	}	

}