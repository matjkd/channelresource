<?php

class Test extends My_Controller {

	function Test()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('roi_model');
	}
function index()
	{
		redirect('admin/view_companies', 'refresh');
	}
	function main()
	{
		$data['roiuser_id'] = $this->session->userdata('user_id');
		$data['roicompany_id'] = $this->session->userdata('company_id');
		$data['roi_list'] = $this->roi_model->list_entries($data['roicompany_id']);
		$data['roi_ref'] ='';
		$data['number_of_salespeople'] ='';
						$data['appts_per_month'] = '';
						$data['hours_per_appt'] = '';
						$data['appt_sale_ratio'] = '';
						$data['average_salary'] = '';
						$data['average_deal'] = '';
						$data['lease_penetration'] = '';
						$data['acceptance_ratio'] = '';
						$data['average_term'] = '';
						$data['subscription'] = '';
						$data['user_id'] = '';
		$data['main'] = '/roi/main';
		$data['title'] = 'ROI Calculator';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function results()
	{
		$data['roiuser_id'] = $this->session->userdata('user_id');
		$data['roicompany_id'] = $this->session->userdata('company_id');
		$data['roi_list'] = $this->roi_model->list_entries($data['roicompany_id']);
		
		//validate the calculator entries
		$this->form_validation->set_rules('number_of_salespeople', 'number_of_salespeople', 'trim|integer|required');
		$this->form_validation->set_rules('appts_per_month', 'appts_per_month', 'trim|integer|required');
		$this->form_validation->set_rules('hours_per_appt', 'hours_per_appt', 'trim|integer|required');
		$this->form_validation->set_rules('appt_sale_ratio', 'appt_sale_ratio', 'trim|integer|required');
		$this->form_validation->set_rules('average_salary', 'average_salary', 'trim|integer|required');
		$this->form_validation->set_rules('average_deal', 'average_deal', 'trim|integer|required');
		$this->form_validation->set_rules('lease_penetration', 'lease_penetration', 'trim|integer|required');
		$this->form_validation->set_rules('acceptance_ratio', 'acceptance_ratio', 'trim|integer|required');
		$this->form_validation->set_rules('average_term', 'average_term', 'trim|integer|required');
		$this->form_validation->set_rules('subscription', 'subscription', 'trim|integer|required');
		
		$data['roi_ref'] = $this->input->post('roi_ref');
		$data['number_of_salespeople'] = $this->input->post('number_of_salespeople');
		$data['appts_per_month'] = $this->input->post('appts_per_month');
		$data['hours_per_appt'] = $this->input->post('hours_per_appt');
		$data['appt_sale_ratio'] = $this->input->post('appt_sale_ratio');
		$data['average_salary'] = $this->input->post('average_salary');
		$data['average_deal'] = $this->input->post('average_deal');
		$data['lease_penetration'] = $this->input->post('lease_penetration');
		$data['acceptance_ratio'] = $this->input->post('acceptance_ratio');
		$data['average_term'] = $this->input->post('average_term');
		$data['subscription'] = $this->input->post('subscription');
		$data['date_added'] = $this->input->post('date_added');
		$data['user_id'] = $this->input->post('user_id');
		
		$submitted = $this->input->post('submit');
		$segment_active = $this->uri->segment(3);
		
		if($segment_active!=NULL)
			{
				$data['roi_id'] = $this->uri->segment(3);
				$roi_id = $data['roi_id'];
				
				
				$data2['roi_numbers'] = $this->roi_model->get_data("$roi_id");
				$this->load->vars($data2);
				
				foreach($data2['roi_numbers'] as $key => $data)
					{
						
						$run = 'yes';
					}
			}
			else
			{
			if($this->form_validation->run() == FALSE)
				{
					$errors=validation_errors();
					//$this->session->set_flashdata('message', 'There was a validation issue');
					$data['main'] = '/roi/main';
					$data['title'] = 'ROI Calculator';
					$this->load->vars($data);
					$this->load->view('template');
					$run = 'no';
				}
				else
				{
					
					$run = 'yes';
				}
			}
		
		
		
			
		if($run=='yes')
		
		{
		
		//CALCULATION STARTS HERE
		$this->load->library('calculator');
		$data['roi_results'] = $this->calculator->roi($data['number_of_salespeople'],
						$data['appts_per_month'],
						$data['hours_per_appt'],
						$data['appt_sale_ratio'],
						$data['average_salary'],
						$data['average_deal'],
						$data['lease_penetration'],
						$data['acceptance_ratio'],
						$data['average_term'],
						$data['subscription']);
		//CALCULATION ENDS HERE
		
		
		if($submitted=='submit')
			{
				$this->roi_model->add_data();
				$data['roi_id'] = mysql_insert_id();
			}
			
		
			
		if($submitted=='update')
			{
				$data['roi_id'] = $this->input->post('roi_id');
				$this->roi_model->update_data($data['roi_id']);
				//$this->session->set_flashdata('message', "Calculation Updated! $test3");
			}
		
			
		
		
		
		$data['main'] = 'roi/results';
		$data['title'] = 'ROI Results';
		
		$this->load->vars($data);
		$this->load->view('template');
		
		}
		
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