<?php

class Mobile extends My_Controller {

	function __construct()
	{
		parent::__construct();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('quote_model');
                                $this->load->model('membership_model');
		$this->load->plugin('to_pdf');
                  $this->load->library('user_agent');
		
	}
        
        
        function quote()
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
            $data['quote_list'] = $this->quote_model->list_entries_by_user();
            
            
             //get user data and set defaults
                                 $userdata = $this->membership_model->get_employee_detail($data['quoteuser_id']);   
                                 foreach($userdata as $row):
                                     if($row['currency'] == NULL)
                                     {
                                         $currency = '&pound;';
                                     }
                                     else
                                     {
                                         $currency = $row['currency'];
                                     }
                                     
                                      if($row['interestrate'] == NULL)
                                     {
                                         $interestrate = '';
                                     }
                                     else
                                     {
                                         $interestrate = $row['interestrate'];
                                     }
                                     
                                     
                                      if($row['initial'] == NULL)
                                     {
                                         $initial = '';
                                     }
                                     else
                                     {
                                         $initial = $row['initial'];
                                     }
                                     
                                       if($row['regular'] == NULL)
                                     {
                                         $regular = '';
                                     }
                                     else
                                     {
                                         $regular = $row['regular'];
                                     }
                                     
                                 endforeach;
                                 
                                                                                                $data['quote_ref'] ='';
						$data['assigned'] = '';
						$data['assigned_name'] = '';
                                                                                                $data['assigned_id'] = '';
						$data['capital'] ='';
						$data['capital_type'] ='';
						$data['amount_type'] ='';
						$data['interest_type'] = '';
						$data['calculate_by'] = $interestrate;
						$data['interest_rate'] = '';
						$data['rate_per_1000'] = '';
						$data['periodic_payment'] = '';
						$data['payment_type'] = '';
						$data['payment_frequency'] = '';
						$data['initial'] = $initial;
						$data['regular'] = $regular;
						$data['number_of_ports'] = '';
						$data['annual_support_costs'] = '';
						$data['other_monthly_costs'] = '';
						$data['user_id'] = '';
                                                                                                $data['currency'] = $currency;
                                 
                                $data['items'] = $this->Membership_model->get_all_employees();	
                                $data['main'] = '/quote/mobile/quotemain';
                                $data['title'] = 'Quoting Tool';
                                if ($this->agent->is_mobile('blackberry'))
                                    {
                                        $data['blackberry'] = "yes";
                                    }
                                   
                                $this->load->vars($data);
		$this->load->view('mobile_template');
            
        }
        function quote_results()
        {
            //validate the calculator entries
		$this->form_validation->set_rules('quote_ref', 'quote reference', 'trim|required');
		$this->form_validation->set_rules('amount_type', 'capital type', 'trim|required');
		$this->form_validation->set_rules('calculate_by', 'calculate by', 'trim|required');
		$this->form_validation->set_rules('payment_type', 'payment type', 'trim|integer|required');
		$this->form_validation->set_rules('payment_frequency', 'payment_frequency', 'trim|integer|required');
		$this->form_validation->set_rules('initial', 'initial', 'trim|integer|required');
		$this->form_validation->set_rules('regular', 'regular', 'trim|integer|required'); 
            
                
                //set variables
                                $data['quote_ref'] = $this->input->post('quote_ref');
                                $data['assigned'] = $this->input->post('assigned');
                                $data['assigned_id'] = $this->input->post('assigned_id');
                                $data['assigned_name'] = $this->input->post('assigned_name');
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
                                $data['currency'] = $this->input->post('currency');
           
                      
		if($segment_active!=NULL)
		{
			
			$config['base_url'] = base_url().'quote/results/'.$this->uri->segment(3);
		
			
		}         

        //Turn the assigned user id into the full name then get the company details
                    if($data['assigned'] == FALSE)
                    {

                            $customer['assigned_info'] = $this->membership_model->get_employee_detail($data['user_id']);
                            foreach($customer['assigned_info'] as $key => $row)
                                            {
                                                    $data['assigned_name'] = "".$row['firstname']." ".$row['lastname']."";
                                                    $data['assigned_company'] = $row['company_id'];
                                                    $data['assigned_email'] = $row['email_address'];
                                            }

                    }
                    else
                    {

                    $customer['assigned_info'] = $this->membership_model->get_employee_detail($data['assigned']);
                    foreach($customer['assigned_info'] as $key => $row)
                                            {
                                                    $data['assigned_name'] = "".$row['firstname']." ".$row['lastname']."";
                                                    $data['assigned_company'] = $row['company_id'];
                                                    $data['assigned_email'] = $row['email_address'];
                                            }
                    }

                    $customer['assigned_company_details'] = $this->membership_model->get_company_detail($data['assigned_company']);
                    foreach($customer['assigned_company_details'] as $key => $row)
                                            {

                                                    $data['assigned_company_name'] = $row['company_name'];
                                            }
                    
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
                                $this->quote_model->add_data();
				$data['quote_id'] = mysql_insert_id();
				$this->session->set_flashdata('message', "Calculation Added");
				     
            
            $data['main'] = '/quote/mobile/results';
                                $data['title'] = 'Quoting Tool';
                                $this->load->vars($data);
		$this->load->view('mobile_template');
        }
        
        
        function view_quote_results($id)
        {
            $quote_id = $id;
				
				
				$data2['quote_numbers'] = $this->quote_model->get_data($quote_id);
				$this->load->vars($data2);
				
				foreach($data2['quote_numbers'] as $key => $row)
					{
					
                                    
						$data['quote_id'] = $row['quote_id'];
						$data['assigned'] = $row['assigned'];
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
						$data['currency'] = $row['currency'];
						$data['user_id'] = $row['user_id'];
						$data['company_id'] = $row['company_id'];
						$data['date_added'] = $row['date_added'];
                                        }
                                        
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
                
                                $data['main'] = '/quote/mobile/results';
                                $data['title'] = 'Quoting Tool';
                                $this->load->vars($data);
		$this->load->view('mobile_template');
            
            
        }
        function list_quotes()
        {
              
            $data['quote_list'] = $this->quote_model->list_entries_by_user();
            $data['main'] = '/quote/mobile/list_quotes';
                                $data['title'] = 'Quotes';
                                $this->load->vars($data);
		$this->load->view('mobile_template');
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