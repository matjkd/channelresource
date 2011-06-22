<?php

class Admin extends My_Controller {

	function Admin()
	{
		parent::Controller();
		$this->load->library(array('encrypt', 'form_validation'));	
		$this->is_logged_in();
	}
	function index()
	{
		redirect('admin/view_companies', 'refresh');
	}
	function create_company()
	{
		
		if ($this->input->post('company_name'))
		{
			$this->Membership_model->create_company();
			$this->session->set_flashdata('message', 'Company Created');
			redirect('admin', 'refresh');
		}
		else
		{
			$this->load->view('/admin/add_company');
		}
	}
	function view_companies()
	{
		
		
		
		$data['company_data'] = $this->Membership_model->get_companies();
		$data['rowcount'] = 0;
		foreach($data['company_data'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		$segment_active = $this->uri->segment(3);
		if($segment_active!=NULL)
		{
		$data['company_id'] = $this->uri->segment(3);
		$data['company_info'] = $this->Membership_model->get_company_detail($data['company_id']);
		$data['employees_detail'] = $this->Membership_model->get_employees($data['company_id']);
		}
		$data['main'] = '/admin/main';
		$data['title'] = 'Administration';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function view_company()
	{
		$data['company_id'] = $_POST['limit'];
		$data['company_info'] = $this->Membership_model->get_company_detail($data['company_id']);
		$data['employees_detail'] = $this->Membership_model->get_employees($data['company_id']);
		$this->load->vars($data);
		$this->load->view('/admin/view_company');
	}
	
	function delete_company()
	{
		$data['company_id'] = $this->uri->segment(3);
		$this->Membership_model->delete_company($data['company_id']);
		$this->session->set_flashdata('message', 'Company Deleted');
		redirect('admin/view_companies', 'refresh');
	}
	function create_user()
	{
	if ($this->input->post('username'))
		{
			$this->form_validation->set_rules('firstname', 'Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		
		
			if($this->form_validation->run() == FALSE)
				{
					$errors=validation_errors();
					$this->session->set_flashdata('message', $errors);
				redirect('admin/view_companies', 'refresh');
				}
		
			else
				{
					$this->Membership_model->create_member();
					$this->session->set_flashdata('message', 'Member Created');
					redirect('admin', 'refresh');
				}
		}
		else
		{
			$this->session->set_flashdata('message', 'There was a problem adding a user. Please make a note of everything you did and contact support');
			redirect('admin/view_companies', 'refresh');
				
		}
	}
	function username_check($str)
	{
		
		$this->db->where('username', $str);
		$query = $this->db->get('users');
		if($query->num_rows == 1)
		{
			$message = "The username $str is already taken";
			$this->form_validation->set_message('username_check', $message);
			return FALSE;
		}
		else
		{
			return TRUE;
		}
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
		
		if($data['ticket_list'] > 0)
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
	function delete_user()
	{
		//get user id from link
		$data['user_id'] =  $this->uri->segment(3);
		$this->Membership_model->delete_user($data['user_id']);
		//set flashdata
		$this->session->set_flashdata('message', 'User Deleted');
		
		redirect('admin/view_companies', 'refresh');
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if(!isset($is_logged_in) || $role != 1)
		{
			$data['message'] = "You don't have permission";
			redirect('welcome', 'refresh');
                       
		}	
			
	}	
	
}