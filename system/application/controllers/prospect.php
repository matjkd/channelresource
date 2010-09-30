<?php 

class Prospect extends My_Controller {

	function Prospect()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('roi_model');
		$this->load->model('pricelist_model');
	}
	function index()
	{
		$data['customeruser_id'] = $this->session->userdata('user_id');
		$data['customercompany_id'] = $this->session->userdata('company_id');
		$data['customer_list'] = $this->prospect_model->list_customers($data['customercompany_id']);
		
		
	if($data['customer_list']!=NULL)
		{
		$data['rowcount'] = 0;
		foreach($data['customer_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		}
		
		//$data['rowcount'] = 0;
		//foreach($data['customer_list'] as $countrow):
		//$data['rowcount'] = $data['rowcount']+1;
		//endforeach;
		
		$data['channel_detail'] = $this->Membership_model->get_company_detail($data['customercompany_id']);
		foreach ($data['channel_detail'] as $row):
			 
			$data['channel_partner_name'] = $row['company_name'];
			endforeach;
		
		$data['channel_partner'] = '';
		$data['customer_name'] = '';
		$data['customer_address1'] = '';
		$data['customer_address2'] = '';
		$data['customer_address3'] = '';
		$data['customer_address4'] = '';
		$data['customer_postcode'] = '';
		$data['customer_tel'] = '';
		$data['customer_status'] = '';
		$data['customer_registration_date'] = '';
		
		$data['customer_registration_date'] = '';
		$data['customer_subscription_date'] = '';
		$data['customer_subscription_type'] = '';
		$data['customer_subscription_price'] = '';
		$data['customer_prof_services'] = '';
		$data['customer_annual_support'] = '';
		$data['customer_next_renewal'] = '';
		$data['customer_renewal_type'] = '';
		$data['user_id'] = '';
		
		
		$data['title'] = 'Prospect Registration';
		$this->load->vars($data);
		$data['main'] = '/prospect/main';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function create_customer()
	{
		//validate form entry
		$submitted = $this->input->post('submit');
		if ($submitted == 'Reset')
					{
						redirect('prospect', 'refresh');
					}
		$this->form_validation->set_rules('customer_name', 'customer_name', 'trim|required');
		
		$data['customeruser_id'] = $this->session->userdata('user_id');
		$data['customercompany_id'] = $this->session->userdata('company_id');
		$data['customer_list'] = $this->prospect_model->list_customers($data['customercompany_id']);
		
		
		if($data['customer_list']!=NULL)
		{
		$data['rowcount'] = 0;
		foreach($data['customer_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		}
		
		
		
		//get details of company/channel partner
		$data['company_details'] = $this->Membership_model->get_company_detail($data['customercompany_id']);
		$initials = "JWS";
		foreach($data['company_details'] as $row3):
		
			if($row3['agent_id'] == NULL )
				{
					$agent_id = 1;
				    
				}
			else
				{
					$agent_id = $row3['agent_id'];
						if ($row3['company_id']==2)
							{
							 	$first_initial = substr($this->session->userdata('firstname'), 0, 1);
							 	$last_initial = substr($this->session->userdata('lastname'), 0, 1);
							 	$initials = "$first_initial".""."$last_initial";
							 	//quick fix for julian having 3 initials in webCRM
							 	if ($initials=="JS")
							 	{
							 		$initials = "JWS";
							 	}
							}
							else
							{
								$initials = "JWS";
							}
				}
		
		$company_id_agent = $row3['company_id'];
		endforeach;
		
		$submitted = $this->input->post('submit');
		
		$data['channel_partner_name'] = $this->input->post('channel_partner_name');
		$data['customer_name'] = $this->input->post('customer_name');
		$data['customer_tel'] = $this->input->post('customer_tel');
		$data['customer_status'] = $this->input->post('customer_status');
		$data['customer_registration_date'] = $this->input->post('customer_registration_date');
		$data['customer_subscription_date'] = $this->input->post('customer_subscription_date');
		$data['customer_subscription_type'] = $this->input->post('customer_subscription_type');
		$data['customer_subscription_price'] = $this->input->post('customer_subscription_price');
		$data['customer_prof_services'] = $this->input->post('customer_prof_services');
		$data['customer_annual_support'] = $this->input->post('customer_annual_support');
		$data['customer_next_renewal'] = $this->input->post('customer_next_renewal');
		$data['customer_renewal_type'] = $this->input->post('customer_renewal_type');
		$data['channel_partner'] = $this->input->post('channel_partner');
		
		if ($data['customer_status']==1)
			{
			$customer_status_email = "Prospect";	
			}
		if ($data['customer_status']==2)
			{
			$customer_status_email = "Customer";		
			}
		if ($data['customer_subscription_type']==1)
			{
			$subscription_type = "Annual";	
			}
		if ($data['customer_subscription_type']==2)
			{
			$subscription_type = "5 Year";		
			}
	
		
		if($this->form_validation->run() == FALSE)
				{
				
					$errors=validation_errors();
					$data['main'] = '/prospect/main';
					$data['title'] = 'Prospect Registration';
					$this->load->vars($data);
					$this->load->view('template');
					
				}
				else
				{
					
					//check for duplicate Customer
					$overide = $this->input->post('duplicate_overide');
					
					if($overide != "yes")
					{
						$possible_dup = "";
						$duplicate['customer_dup'] = $this->prospect_model->check_duplicate($this->input->post('customer_name'));
						$option = array();
						$counter = 0;
						foreach($duplicate['customer_dup'] as $row4):
			
						if($row4['customer_name'] == NULL )
						
							{
								
							}
						else
							{
								$option['dup'] = $row4['customer_name'];
								$duplicates = "yes";
								
							}
						endforeach;
					
						if(isset($duplicates))
								{
										$data['duplicate_names'] = $this->prospect_model->check_duplicate($this->input->post('customer_name'));	
										$data['main'] = '/prospect/main';
										$data['title'] = 'Prospect Registration';
										
										$this->load->vars($data);
									
										$this->load->view('template', 'refresh');
										
										//stops the following statements running
										$submitted = "no";
								}
					
					}
				//end of duplicate check
					else
					{
						$possible_dup = "(Override)";
					}
					
					if ($submitted == 'Submit')
					{
					$this->prospect_model->add_customer();
					$this->session->set_flashdata("message", "".$data['customer_name']." Added");
					
					
					
					
					$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
					$this->email->to('chloe@lease-desk.com, debra.taylor@proctorconsulting.co.uk'); 
					$this->email->cc('mat@redstudio.co.uk'); 
					
					$this->email->subject('Channel-Resource: Prospect Added '.$possible_dup.'');
					$this->email->message("The following $customer_status_email has been added to Channel-Resource:

					
Channel Partner: ".$data['channel_partner_name']."
company id: $company_id_agent
$customer_status_email name: ".$data['customer_name']."
Customer Tel: ".$data['customer_tel']."
Agent Id: $agent_id	
Initials: $initials	
Registration Date: ".$data['customer_registration_date']."
Subscription Date: ".$data['customer_subscription_date']."
Subscription Type: $subscription_type
Subscription Price: ".$data['customer_subscription_price']."
				
					");	
					$this->email->send();
					
						// send email to webCRM
				$this->email->clear();
				
				$this->email->to('cm3208SPoYUg@b2b-email.net');
				$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
				$this->email->cc('mat@redstudio.co.uk'); 
				
				$this->email->subject('/*/AUTO/*/');
				$this->email->message("Start:DateTime

End
Start:Organisation
A:01:".$data['customer_name']."
A:06:".$data['customer_tel']."
A:10:Prospect Customer
A:13:$initials
A:15:$agent_id
End
Start:Person

End
Start:Activity
A:01:0
A:03:Qualify Agent Prospect Reg
A:04:$initials
A:05:$customer_status_email Added on Channel-Resource

End
Start:OpportunityDelivery
A:01:*
A:02:$initials
A:07:$customer_status_email Added on Channel-Resource
End
				
				");	
				$this->email->send();
				//end mailto webCRM
					
					
					
					$data['title'] = 'Quote Calculator';
					$data['main'] = '/prospect/main';
					$this->load->vars($data);
					$this->load->view('template');
					redirect('prospect', 'refresh');
					
					}
					if ($submitted == 'Update')
					{
						$data['customer_id'] = $this->input->post('customer_id');
						$customer_id = $data['customer_id'];
						$this->session->set_flashdata('message', 'Customer Updated');
						$this->prospect_model->update_customer($data['customer_id']);
						redirect("prospect/edit_customer/$customer_id", 'refresh');
					}
				if ($submitted == 'Reset')
					{
						redirect('prospect', 'refresh');
					}
				}
		
		
		
		
	}
	function delete_customer()
		{
			$data['customer_id'] = $this->uri->segment(3);
			$this->prospect_model->delete_customer($data['customer_id']);
			$this->session->set_flashdata('message', 'Customer Deleted');
			redirect('prospect', 'refresh');
		}
	
	function edit_customer()
		{
			$data['customer_id'] = $this->uri->segment(3);
			$data['customer_data'] = $this->prospect_model->get_customer($data['customer_id']);
			
			
			
			
			foreach ($data['customer_data'] as $row):
			$data['customer_id'] = $row['customer_id'];
			$data['customer_name'] = $row['customer_name'];
			$data['customer_address1'] = $row['customer_address1'];
			$data['customer_address2'] = $row['customer_address2'];
			$data['customer_address3'] = $row['customer_address3'];
			$data['customer_address4'] = $row['customer_address4'];
			$data['customer_postcode'] = $row['customer_postcode'];
			$data['customer_tel'] = $row['customer_tel'];
			$data['customer_status'] = $row['customer_status'];
			$data['customer_registration_date'] = $row['customer_registration_date'];
			$data['channel_partner'] = $row['channel_partner'];
			$data['customer_registration_date'] = $row['customer_registration_date'];
			$data['customer_subscription_date'] = $row['customer_subscription_date'];
			$data['customer_subscription_type'] = $row['customer_subscription_type'];
			$data['customer_subscription_price'] = $row['customer_subscription_price'];
			$data['customer_prof_services'] = $row['customer_prof_services'];
			$data['customer_annual_support'] = $row['customer_annual_support'];
			$data['customer_next_renewal'] = $row['customer_next_renewal'];
			$data['customer_renewal_type'] = $row['customer_renewal_type'];
			
			$data['user_id'] = $row['user_id'];
			endforeach;
			
			
			//convert channel partner id into the name
			$data['channel_detail'] = $this->Membership_model->get_company_detail($data['channel_partner']);
			foreach ($data['channel_detail'] as $row):
			$data['channel_partner_name'] = $row['company_name'];
			endforeach;
			//end of conversion
			
			$data['customeruser_id'] = $this->session->userdata('user_id');
			$data['customercompany_id'] = $this->session->userdata('company_id');
			$data['customer_list'] = $this->prospect_model->list_customers($data['customercompany_id']);
			$data['rowcount'] = 0;
			foreach($data['customer_list'] as $countrow):
			$data['rowcount'] = $data['rowcount']+1;
			endforeach;
			
			$data['roidata'] = $this->roi_model->list_entries_per_prospect($data['customer_id']);
			$data['rowcount2'] = 0;
			foreach($data['roidata'] as $countrow):
			$data['rowcount2'] = $data['rowcount2']+1;
			endforeach;
			
			
			$data['pricelistdata'] = $this->pricelist_model->list_entries_per_customer($data['customer_id']);
			$data['rowcount3'] = 0;
			foreach($data['pricelistdata'] as $countrow):
			$data['rowcount3'] = $data['rowcount3']+1;
			endforeach;
			
			$data['title'] = $data['customer_name'];
			$this->load->vars($data);
			$data['main'] = '/prospect/results';
			$this->load->vars($data);
			$this->load->view('template');
		}
		
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('message', 'You are not logged in');
			redirect('user/login');
                       
		}	
			
	}	
	
}