<?php

class Quote extends My_Controller {

	function Quote()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('quote_model');
	}
	function index()
	{
		redirect('admin/view_companies', 'refresh');
	}
	function main()
	{
		$data['quoteuser_id'] = $this->session->userdata('user_id');
		$data['quotecompany_id'] = $this->session->userdata('company_id');
		$segment_active = $this->uri->segment(3);
		if($segment_active!=NULL)
		{
			
			$config['base_url'] = base_url().'quote/results/'.$this->uri->segment(3);
		}
		else if($segment_active==NULL)
		{
			
			$config['base_url'] = base_url().'quote/results/0/';
		}
		
		$config['total_rows'] = $this->db->count_all('quote');
		$config['per_page'] = '8'; 
		$config['full_tag_open'] = '<div align="center"><p>';
    	$config['full_tag_close'] = '</div></p>';
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config); 
		$data['page_segment'] = $this->uri->segment(4);
		
		// $data['quote_list'] = $this->quote_model->list_entries($data['quotecompany_id'], $config['per_page'],$data['page_segment']);
		$data['quote_list'] = $this->quote_model->list_entries_by_user();
		$data['rowcount'] = 0;
		foreach($data['quote_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		
						$data['quote_ref'] ='';
						$data['capital'] ='';
						$data['capital_type'] ='';
						$data['amount_type'] ='';
						$data['interest_type'] = '';
						$data['calculate_by'] = '';
						$data['interest_rate'] = '';
						$data['rate_per_1000'] = '';
						$data['periodic_payment'] = '';
						$data['payment_type'] = '';
						$data['payment_frequency'] = '';
						$data['initial'] = '';
						$data['regular'] = '';
						$data['number_of_ports'] = '';
						$data['annual_support_costs'] = '';
						$data['other_monthly_costs'] = '';
						$data['user_id'] = '';
						
		$data['main'] = '/quote/main';
		$data['title'] = 'Lease Rate Calculator';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function results()
	{
		$data['quoteuser_id'] = $this->session->userdata('user_id');
		$data['quotecompany_id'] = $this->session->userdata('company_id');
		$segment_active = $this->uri->segment(3);
		if($segment_active!=NULL)
		{
			
			$config['base_url'] = base_url().'quote/results/'.$this->uri->segment(3);
		}
		else if($segment_active==NULL)
		{
			
			$config['base_url'] = base_url().'quote/results/0/';
		}
		
		$config['total_rows'] = $this->db->count_all('quote');
		$config['per_page'] = '8'; 
		$config['full_tag_open'] = '<div align="center"><p>';
    	$config['full_tag_close'] = '</div></p>';
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config); 
		$data['page_segment'] = $this->uri->segment(4);
		//$data['quote_list'] = $this->quote_model->list_entries($data['quotecompany_id'], $config['per_page'],$data['page_segment']);
		$data['quote_list'] = $this->quote_model->list_entries_by_user();
		$data['rowcount'] = 0;
		foreach($data['quote_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		
		//validate the calculator entries
		$this->form_validation->set_rules('quote_ref', 'quote reference', 'trim|required');
		$this->form_validation->set_rules('amount_type', 'capital type', 'trim|required');
		$this->form_validation->set_rules('calculate_by', 'calculate by', 'trim|required');
		$this->form_validation->set_rules('payment_type', 'payment type', 'trim|integer|required');
		$this->form_validation->set_rules('payment_frequency', 'payment_frequency', 'trim|integer|required');
		$this->form_validation->set_rules('initial', 'initial', 'trim|integer|required');
		$this->form_validation->set_rules('regular', 'regular', 'trim|integer|required');
		
		
		
		$data['quote_ref'] = $this->input->post('quote_ref');
		$data['capital'] = $this->input->post('capital');
		$data['capital_type'] = $this->input->post('capital_type');
		$data['amount_type'] = $this->input->post('amount_type');
		$data['interest_type'] = $this->input->post('interest_type');
		$data['calculate_by'] = $this->input->post('calculate_by');
		$data['payment_type'] = $this->input->post('payment_type');
		$data['payment_frequency'] = $this->input->post('payment_frequency');
		$data['initial'] = $this->input->post('initial');
		$data['regular'] = $this->input->post('regular');
		$data['number_of_ports'] = $this->input->post('number_of_ports');
		$data['annual_support_costs'] = $this->input->post('annual_support_costs');
		$data['other_monthly_costs'] = $this->input->post('other_monthly_costs');
		$data['date_added'] = $this->input->post('date_added');
		$data['user_id'] = $this->input->post('user_id');
		
		$submitted = $this->input->post('submit');
		
		$segment_active = $this->uri->segment(3);
		
		if($segment_active>0)
			{
				$data['quote_id'] = $this->uri->segment(3);
				$quote_id = $data['quote_id'];
				
				
				$data2['quote_numbers'] = $this->quote_model->get_data("$quote_id");
				$this->load->vars($data2);
				
				foreach($data2['quote_numbers'] as $key => $row)
					{
						//if there is an error is may be caused here.
						$data['quote_id'] = $row['quote_id'];
						
						$data['quote_ref'] = $row['quote_ref'];
						$data['capital_type'] = $row['capital_type'];
						$data['amount_type'] = $row['amount_type'];
						$data['interest_type'] = $row['interest_type'];
						$data['capital'] = $row['capital'];
						$data['interest_rate'] = $row['interest_rate'];
						$data['rate_per_1000'] = $row['rate_per_1000'];
						$data['periodic_payment'] = $row['periodic_payment'];
						$data['payment_type'] = $row['payment_type'];
						$data['payment_frequency'] = $row['payment_frequency'];
						$data['initial'] = $row['initial'];
						$data['regular'] = $row['regular'];
						$data['calculate_by'] = $row['calculate_by'];
						$data['number_of_ports'] = $row['number_of_ports'];
						$data['annual_support_costs'] = $row['annual_support_costs'];
						$data['other_monthly_costs'] = $row['other_monthly_costs'];
						
						$data['user_id'] = $row['user_id'];
						$data['company_id'] = $row['company_id'];
						$data['date_added'] = $row['date_added'];
						
						
						$run = 'yes';
					}
			}
			else
			{
			if($this->form_validation->run() == FALSE)
				{
					$errors=validation_errors();
					$data['main'] = '/quote/main';
					$data['title'] = 'Quote Calculator';
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
		$data['quote_results'] = $this->calculator->quote($data['capital_type'], 
						$data['amount_type'], 
						$data['interest_type'],
						$data['calculate_by'],
						$data['payment_type'],
						$data['payment_frequency'],
						$data['initial'],
						$data['regular'],
						$data['number_of_ports'],
						$data['annual_support_costs'],
						$data['other_monthly_costs']);
		//CALCULATION ENDS HERE
		
		if($submitted=='Submit')
			{
				$this->quote_model->add_data();
				$data['quote_id'] = mysql_insert_id();
			}
			
		
			
		if($submitted=='Update')
			{
				$data['quote_id'] = $this->input->post('quote_id');
				$this->quote_model->update_data($data['quote_id']);
				
			}
		if($submitted=='Reset')
			{
				redirect('quote/main', 'refresh');
				
			}
		
			
		
		
		
		$data['main'] = 'quote/results';
		$data['title'] = 'Quote Results';
		
		$this->load->vars($data);
		$this->load->view('template');
		
		}
		
	}
		function delete_quote()
		{
			$data['quote_id'] = $this->uri->segment(3);
			$this->quote_model->delete_quote($data['quote_id']);
		$this->session->set_flashdata('message', 'Quote Deleted');
		redirect('quote/main', 'refresh');
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