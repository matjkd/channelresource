<?php

class Edit extends My_Controller {

	function Edit()
	{
		parent::Controller();
		$this->load->library(array('encrypt', 'form_validation'));	
		$this->is_logged_in();
	}
	function index()
	{
		redirect('admin/view_companies', 'refresh');
	}
	function edit_user()
	{
		
		//need to work out how to get the user id to here, i used 7 as a test
		$data['user_id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->Membership_model->edit_user($data['user_id'], $data['field'], $data['value']);
		
		
		$update = $this->input->post('value');
		$this->output->set_output($update);
		
		
	}
	function edit_password()
	{
		$userid = $this->input->post('user_id');
		if ($this->input->post('password'))
		{
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE)
				{
					$errors=validation_errors();
					$this->session->set_flashdata('message', $errors);
				redirect("profile/view_user/$userid", 'refresh');
				}
		
			else
				{
					
					$this->Membership_model->update_password($userid);
					$this->session->set_flashdata('message', 'Password Changed');
					redirect("profile/view_user/$userid", 'refresh');
				}
		
		
		}
		else
		{
			$this->session->set_flashdata('message', 'You must enter a password');
					redirect("profile/view_user/$userid", 'refresh');
		}
		
	}
	
function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('message', 'You do not have permission to do that');
			redirect('welcome', 'refresh');
                       
		}
		
			
	}	
	
}