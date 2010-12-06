<?php

class Roi extends My_Controller {

	function Roi()
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
		$segment_active = $this->uri->segment(3);
		
		if($segment_active!=NULL)
		{
			$config['base_url'] = base_url().'roi/results/0/';
			
			//convert prospect id into the name
			$data['prospect_detail'] = $this->prospect_model->get_customer($this->uri->segment(3));
			foreach ($data['prospect_detail'] as $row):
			$data['customer_id'] =$row['customer_id'];
			$data['customer_name'] =$row['customer_name'];
			endforeach;
			//end of conversion
			
		}
		else if($segment_active==NULL)
		{
			$config['base_url'] = base_url().'roi/results/0/';
			$data['customer_id'] ='';
			$data['customer_name'] ='';
		}
		
		$config['total_rows'] = $this->db->count_all('roi');
		$config['per_page'] = '8'; 
		$config['full_tag_open'] = '<div align="center"><p>';
    	$config['full_tag_close'] = '</div></p>';
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config); 
		$data['page_segment'] = $this->uri->segment(4);
		$data['roi_list'] = $this->roi_model->list_entries($data['roicompany_id'], $config['per_page'],$data['page_segment']);
		
		$data['rowcount'] = 0;
		foreach($data['roi_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		
		
		
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
		$segment_active = $this->uri->segment(3);
		$data['roi_list'] = $this->roi_model->list_entries($data['roicompany_id']);
		
		$data['rowcount'] = 0;
		foreach($data['roi_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		
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
		$data['customer_id'] = $this->input->post('customer_id');
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
		
		$data['customer_name'] = '';
		
		
		if($segment_active>0)
			{
				
				$roi_id = $this->uri->segment(3);
				
				
				$data2['roi_numbers'] = $this->roi_model->get_data("$roi_id");
				$this->load->vars($data2);
				
				foreach($data2['roi_numbers'] as $key => $row)
					{
						$data['roi_ref'] = $row['roi_ref'];
						$data['customer_id']= $row['customer_id'];
						$data['number_of_salespeople'] =$row['number_of_salespeople'];
						$data['appts_per_month'] = $row['appts_per_month'];
						$data['hours_per_appt'] = $row['hours_per_appt'];
						$data['appt_sale_ratio'] = $row['appt_sale_ratio'];
						$data['average_salary'] = $row['average_salary'];
						$data['average_deal'] = $row['average_deal'];
						$data['lease_penetration'] = $row['lease_penetration'];
						$data['acceptance_ratio'] = $row['acceptance_ratio'];
						$data['average_term'] = $row['average_term'];
						$data['subscription'] = $row['subscription'];
						$data['user_id'] = $row['user_id'];
						$data['company_id'] = $row['company_id'];
						$data['roi_id'] = $row['roi_id'];
						$data['date_added'] = $row['date_added'];
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
		
	//Turn the customer id into the customer name
		if($data['customer_id']==NULL)
		{
			$data['customer_name'] = '';
		}
		else
		{
		$customer['customer_info'] = $this->roi_model->get_customer($data['customer_id']);
		foreach($customer['customer_info'] as $key => $row)
					{
						$data['customer_name'] = $row['customer_name'];
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
		
		
		if($submitted=='Submit')
			{
				$this->roi_model->add_data();
				$data['roi_id'] = mysql_insert_id();
			}
			
		
			
		if($submitted=='Update')
			{
				$data['roi_id'] = $this->input->post('roi_id');
				$this->roi_model->update_data($data['roi_id']);
				//$this->session->set_flashdata('message', "Calculation Updated! $test3");
			}
			if($submitted=='Reset')
			{
				redirect('roi/main', 'refresh');
				//$this->session->set_flashdata('message', "Calculation Updated! $test3");
			}
			
		
		
		
		$data['main'] = 'roi/results';
		$data['title'] = 'ROI Results';
		
		$this->load->vars($data);
		$this->load->view('template');
		
		}
		
	}
	

	
function delete_roi()
		{
		$data['roi_id'] = $this->uri->segment(3);
		$this->roi_model->delete_roi($data['roi_id']);
		$this->session->set_flashdata('message', 'Calculation Deleted');
		redirect('roi/main', 'refresh');
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