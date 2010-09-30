<?php 

class Support extends My_Controller {

	function Support()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('support_model');
		
	}
	function index()
	{
		$data['customeruser_id'] = $this->session->userdata('user_id');
		$data['customercompany_id'] = $this->session->userdata('company_id');
		$data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);
		
		if($data['ticket_list']!=NULL)
		{
		$data['rowcount'] = 0;
		foreach($data['ticket_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		}
		$data['channel_detail'] = $this->Membership_model->get_company_detail($data['customercompany_id']);
		foreach ($data['channel_detail'] as $row):
			 
			$data['channel_partner_name'] = $row['company_name'];
			
			endforeach;
		
		$data['channel_partner'] = '';
		
		$data['user_id'] = '';
		$data['ticket_id'] = '';
		$data['telephone'] = '';
		$data['email_address'] = '';
		$data['support_subject'] = '';
		$data['support_type'] = '';
		$data['support_issue'] = '';
		$data['support_priority'] = '';
		$data['support_description'] = '';
		$data['support_status'] = 'Submitted';
		$data['title'] = 'New Support-Request';
		$this->load->vars($data);
		$data['main'] = '/support/main';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function create_ticket()
	{
		//validate form entry
		$this->form_validation->set_rules('support_subject', 'support_subject', 'trim|required');
		$this->form_validation->set_rules('email_address', 'email_address', 'trim|required');
		
		$data['customeruser_id'] = $this->session->userdata('user_id');
		$data['customercompany_id'] = $this->session->userdata('company_id');
		$data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);
		$data['rowcount'] = 0;
		
		
		
	if($data['ticket_list']!=NULL)
		{
		$data['rowcount'] = 0;
		foreach($data['ticket_list'] as $countrow):
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
		$company_name = $row3['company_name'];
		endforeach;
		
		
		
		$submitted = $this->input->post('submit');
		if($this->form_validation->run() == FALSE)
				{
					
					$data['telephone'] = $this->input->post('telephone');	
    				$data['email_address'] = $this->input->post('email_address');
    				$data['support_subject'] = $this->input->post('support_subject');
    				$data['support_description'] = $this->input->post('support_description');
    				$data['support_type'] =  $this->input->post('support_type');
    				$data['support_issue'] =  $this->input->post('support_issue');
    				$data['support_priority'] =  $this->input->post('support_priority');
    				$data['channel_partner_name'] =  $company_name;
    				$data['support_status'] =  $this->input->post('support_status');
    				$data['company_id'] =  $this->session->userdata('company_id');
    				$data['user_id'] =  $this->input->post('user_id');
    				$data['date_added'] =  $this->input->post('date_added');
    				$data['date_updated'] =  $this->input->post('date_added');
					$data['ticket_id'] = '';
					$errors=validation_errors();
					$data['main'] = '/support/main';
					$data['title'] = 'Support Request';
					$this->load->vars($data);
					$this->load->view('template');
					
				}
				else
				{
					
					$telephone = $this->input->post('telephone');	
    				$email_address = $this->input->post('email_address');
    				$support_subject = $this->input->post('support_subject');
    				
    				
    				$support_description = strip_tags($this->input->post('support_description'));
    				$support_type =  $this->input->post('support_type');
    				$support_issue =  $this->input->post('support_issue');
    				$support_priority =  $this->input->post('support_priority');
    				
    				$company_id =  $this->session->userdata('company_id');
    				$user_id =  $this->input->post('user_id');
    				$date_added =  $this->input->post('date_added');
    				$date_updated =  $this->input->post('date_added');
					
    				if($support_priority == 1)
	    				{
	    					$support_priority1 = "Urgent";
	    				}
					if($support_priority == 2)
	    				{
	    					$support_priority1 = "High";
	    				}
					if($support_priority == 3)
	    				{
	    					$support_priority1 = "Medium";
	    				}
					if($support_priority == 4)
	    				{
	    					$support_priority1 = "Low";
	    				}
	    				
					if($support_issue == 1)
	    				{
	    					$support_issue1 = "Data Error";
	    				}
					if($support_issue == 2)
	    				{
	    					$support_issue1 = "System Error";
	    				}
					if($support_issue == 3)
	    				{
	    					$support_issue1 = "System Crash";
	    				}
					if($support_issue == 4)
	    				{
	    					$support_issue1 = "Slow Response";
	    				}
					if($support_issue == 5)
	    				{
	    					$support_issue1 = "Other";
	    				}
	    				
	    				
					if($support_type == 1)
	    				{
	    					$support_type1 = "Lease Desk";
	    				}
					if($support_type == 2)
	    				{
	    					$support_type1 = "Channel Resource";
	    				}
					if($support_type == 3)
	    				{
	    					$support_type1 = "Customer Resource";
	    				}
					if($support_type == 4)
	    				{
	    					$support_type1 = "Training";
	    				}
					if($support_type == 5)
	    				{
	    					$support_type1 = "Account Review";
	    				}
	    				
	    				
	    				
					if ($submitted == 'Submit')
					{
					$this->support_model->add_ticket();
					$ticket_id = mysql_insert_id();
					$this->session->set_flashdata('message', 'Ticket Added');
					
//start normal support email
					
					
					
					$this->email->to('chloe@lease-desk.com, debra.taylor@proctorconsulting.co.uk');
					$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
					$this->email->cc('mat@redstudio.co.uk, '.$email_address.''); 
					$this->email->subject('Support Request Ticket No. '.$ticket_id.'');
					$this->email->message("Subject: $support_subject
					

Company: $company_name

Customer Tel: $telephone	
	

Description: $support_description
Support Type: $support_type1
Support Issue: $support_issue1
Priority: $support_priority1
				
					");	
					$this->email->send();
					
    $email1 = $this->email->print_debugger();
    
				
//end normal email
// send email to webCRM
				$this->email->clear();
				
				$this->email->to('cm3208SPoYUg@b2b-email.net');
				$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
				$this->email->cc('mat@redstudio.co.uk'); 
				
				$this->email->subject('/*/AUTO/*/');
				$this->email->message("Start:DateTime

End
Start:Organisation
A:99:0
A:01:$company_name
End
Start:Person

End
Start:Activity
A:99:1
A:01:1
A:02:3
A:03:Support Request
A:04:CW
A:05:Support Request $ticket_id
A:30:{unwrap}$support_description|CR||CR|{/unwrap}
C:01:$support_type
C:03:$support_issue
C:05:$support_priority

End
Start:OpportunityDelivery

End
				
				");	
				$this->email->send();
			
//end mailto webCRM
					
					
					
					
					
					
					
					$data['title'] = 'Support Request';
					$data['main'] = '/prospect/main';
					$this->load->vars($data);
					$this->load->view('template');
					
					redirect("support/results/$ticket_id", 'refresh');
					}
					
				if ($submitted == 'Update')
					{
						$data['ticket_id'] = $this->input->post('ticket_id');
						$ticket_id = $data['ticket_id'];
						$this->session->set_flashdata('message', 'Ticket Updated');
						
// normal email update
						if($this->input->post('email_changes')==TRUE)
						{
							$this->email->clear();
				
						$this->email->to('chloe@lease-desk.com, debra.taylor@proctorconsulting.co.uk');
					$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
					$this->email->cc('mat@redstudio.co.uk, '.$email_address.''); 
						
						$this->email->subject('Support Request Ticket No. '.$ticket_id.' Updated');
						$this->email->message("Subject: $support_subject
					

company: $company_name

Customer Tel: $telephone	
Description: {unwrap}$support_description{/unwrap}
Support Type: $support_type1
Support Issue: $support_issue1
Priority: $support_priority1
						
						");	
						$this->email->send();

// end normal email update
						
						// send email to webCRM for update
				$this->email->clear();
				
				$this->email->to('cm3208SPoYUg@b2b-email.net');
				$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
				$this->email->cc('mat@redstudio.co.uk'); 
				
				$this->email->subject('/*/AUTO/*/');
				$this->email->message("Start:DateTime

End
Start:Organisation
A:99:0
A:01:$company_name
End
Start:Person

End
Start:Activity
A:99:0
A:01:0
A:03:Support Request
A:04:CW
A:05:Support Request $ticket_id UPDATED
A:30:$support_description
C:01:$support_type
C:03:$support_issue
C:05:$support_priority

End
Start:OpportunityDelivery

End
				
				");	
				//$this->email->send();
			
//end mailto webCRM for update
						}
						
						
						$this->support_model->update_ticket($data['ticket_id']);
						redirect("support/results/$ticket_id", 'refresh');
						
						
					}
				if ($submitted == 'Reset')
					{
						redirect('support', 'refresh');
					}
				}
		
		
		
		
	}
	function delete_ticket()
		{
			
			$data['ticket_id'] = $this->uri->segment(3);
			$is_logged_in = $this->session->userdata('is_logged_in');
			$role = $this->session->userdata('role');
			if(!isset($is_logged_in) || $role != 1)
			{
		$this->session->set_flashdata('message', 'You do not have permission to delete');
			redirect('/support/results/'.$data['ticket_id'].'', 'refresh');
                       
			}	
			
			else
			{
			$this->support_model->delete_ticket($data['ticket_id']);
			$this->session->set_flashdata('message', 'Ticket Deleted');
			redirect('support', 'refresh');
			}
		}
	
	function results()
		{
			$data['ticket_id'] = $this->uri->segment(3);
			$data['ticket_data'] = $this->support_model->get_ticket($data['ticket_id']);
			
			foreach ($data['ticket_data'] as $row):
			
			
			$data['user_id'] = $row['user_id'];
			$data['company_id'] = $row['company_id'];
			$data['telephone'] = $row['telephone'];
			$data['email_address'] = $row['email_address'];
			$data['support_subject'] = $row['support_subject'];
			$data['support_type'] = $row['support_type'];
			$data['support_issue'] = $row['support_issue'];
			$data['support_description'] = $row['support_description'];
			$data['support_status'] = $row['support_status'];
			
			$data['support_priority'] = $row['support_priority'];
			endforeach;
			
			
			//convert channel partner id into the name
			$data['channel_detail'] = $this->Membership_model->get_company_detail($data['company_id']);
			foreach ($data['channel_detail'] as $row):
			$data['channel_partner_name'] = $row['company_name'];
			endforeach;
			//end of conversion
			
			$data['customeruser_id'] = $this->session->userdata('user_id');
			$data['customercompany_id'] = $this->session->userdata('company_id');
			$data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);
			$data['rowcount'] = 0;
			foreach($data['ticket_list'] as $countrow):
			$data['rowcount'] = $data['rowcount']+1;
			endforeach;
			
			//fetch comments
			$data['comments'] = $this->support_model->list_replies($data['ticket_id']);
						
			$data['title'] = 'Support Request';
			$this->load->vars($data);
			$data['main'] = '/support/results';
			$this->load->vars($data);
			$this->load->view('template');
		}
		
	function reply($id)
	{
		$data['ticket_id'] = $id;
		$this->load->vars($data);
		$this->load->view('/support/reply_ajax');
		
	}
	function add_reply($id)
	{
		
		if ($this->input->post('comment'))
		{
			
			$this->support_model->add_reply($id);
			$this->session->set_flashdata('message', 'Reply added');
			
			
			// send email to webCRM and certain admins
			
			//get other support data
			$data['ticket_details'] = $this->support_model->get_ticket($id);
			foreach($data['ticket_details'] as $row5):
			
				$support_type = $row5['support_type']; 
				$support_issue = $row5['support_issue']; 
				$support_priority = $row5['support_priority']; 
				$email_address = $row5['email_address'];
				$company_id = $row5['company_id'];
				$user_id = $row5['user_id'];
				$support_subject = $row5['support_subject'];
			endforeach;
			
			//get company detail
			//get details of company/channel partner, this could be trimmed down a touch
					$data['company_details'] = $this->Membership_model->get_company_detail($company_id);
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
					$company_name = $row3['company_name'];
					endforeach;

		if($support_priority == 1)
	    				{
	    					$support_priority1 = "Urgent";
	    				}
					if($support_priority == 2)
	    				{
	    					$support_priority1 = "High";
	    				}
					if($support_priority == 3)
	    				{
	    					$support_priority1 = "Medium";
	    				}
					if($support_priority == 4)
	    				{
	    					$support_priority1 = "Low";
	    				}
	    				
					if($support_issue == 1)
	    				{
	    					$support_issue1 = "Data Error";
	    				}
					if($support_issue == 2)
	    				{
	    					$support_issue1 = "System Error";
	    				}
					if($support_issue == 3)
	    				{
	    					$support_issue1 = "System Crash";
	    				}
					if($support_issue == 4)
	    				{
	    					$support_issue1 = "Slow Response";
	    				}
					if($support_issue == 5)
	    				{
	    					$support_issue1 = "Other";
	    				}
	    				
	    				
					if($support_type == 1)
	    				{
	    					$support_type1 = "Lease Desk";
	    				}
					if($support_type == 2)
	    				{
	    					$support_type1 = "Channel Resource";
	    				}
					if($support_type == 3)
	    				{
	    					$support_type1 = "Customer Resource";
	    				}
					if($support_type == 4)
	    				{
	    					$support_type1 = "Training";
	    				}
					if($support_type == 5)
	    				{
	    					$support_type1 = "Account Review";
	    				}
	    							
			
    						
		$comment = strip_tags($this->input->post('comment'));	
//start normal email
			$this->email->clear();		
			$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
			$this->email->to('chloe@lease-desk.com, debra.taylor@proctorconsulting.co.uk'); 
			$this->email->cc('mat@redstudio.co.uk, '.$email_address.''); 
			 
			$this->email->subject('Reply to Support Request Ticket No '.$id.'');
			$this->email->message("Subject: $support_subject
					
Company: $company_name

Reply: $comment

				
					");	
					$this->email->send();
			
//start webcrm email		
			
			$this->email->clear();
				
				$this->email->to('cm3208SPoYUg@b2b-email.net');
				$this->email->from('info@proctorconsulting.co.uk', 'Proctor Consulting');
				$this->email->cc('mat@redstudio.co.uk'); 
				
				$this->email->subject('/*/AUTO/*/');
				$this->email->message("Start:DateTime

End
Start:Organisation
A:99:0
A:01:$company_name
End
Start:Person

End
Start:Activity
A:99:0
A:01:0
A:03:Support Request
A:04:CW
A:05:Reply to Request $id
A:30:$comment
C:01:$support_type
C:03:$support_issue
C:05:$support_priority

End
Start:OpportunityDelivery

End
				
				");	
				//$this->email->send();
//end mailto webCRM
			redirect('support/results/'.$id.'', 'refresh');
			
		}
		else
		{
			$this->session->set_flashdata('message', 'Nothing Entered');
			redirect('support/results/'.$id.'', 'refresh');
		}
		
		
		
		
	}
	
	function edit_reply($id)
	{
		$submitted = $this->input->post('submit');
		if ($submitted == 'Update')
					{
						if ($this->input->post('comment'))
							{
								$this->support_model->edit_reply($id);
								$this->session->set_flashdata('message', 'Reply Changed');
								//redirect('support/results/'.$id.'', 'refresh');
							}
						else
							{
								$this->session->set_flashdata('message', 'Nothing Changed');
								//redirect('support/results/'.$id.'', 'refresh');
							}
					}
		if ($submitted == 'Delete')
					{
						if ($this->input->post('comment'))
							{
								$this->support_model->delete_reply($id);
								$this->session->set_flashdata('message', 'Reply Deleted');
								//redirect('support/results/'.$id.'', 'refresh');
							}
						else
							{
								$this->session->set_flashdata('message', 'Nothing Deleted');
								//redirect('support/results/'.$id.'', 'refresh');
							}
					}
		redirect('support/results/'.$id.'', 'refresh');
	}
	
		
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['message'] = "You don't have permission";
			redirect('welcome', 'refresh');
                       
		}	
			
	}	
	
}