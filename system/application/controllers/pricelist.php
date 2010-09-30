<?php 

class Pricelist extends My_Controller {

	function Pricelist()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('pricelist_model');
		
	}
	function index()
	{
		redirect('pricelist/main', 'refresh');
		
	}
	
	function main()
	{
		
		$data['pricelistuser_id'] = $this->session->userdata('user_id');
		$data['pricelistcompany_id'] = $this->session->userdata('company_id');
		$segment_active = $this->uri->segment(3);
		
		if($segment_active!=NULL)
		{
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
			
			$data['customer_id'] ='';
			$data['customer_name'] ='';
		}
		
		
		
		$data['pricelist_list'] = $this->pricelist_model->list_entries($data['pricelistcompany_id']);
		
		
		$data['rowcount'] = 0;
		foreach($data['pricelist_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		
		
		$data['pricelist_ref'] = '';
		$data['pricelist_users'] = '';
		$data['pricelist_discount'] = '';
			$data['additionalservices'] = '';
		$data['title'] = 'Price Lists & Proposals';
		$this->load->vars($data);
		$data['main'] = '/pricelists/main';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function results()
	{
		$data['pricelistuser_id'] = $this->session->userdata('user_id');
		$data['pricelistcompany_id'] = $this->session->userdata('company_id');
		$data['pricelist_list'] = $this->pricelist_model->list_entries($data['pricelistcompany_id']);
		
		$data['rowcount'] = 0;
		foreach($data['pricelist_list'] as $countrow):
		$data['rowcount'] = $data['rowcount']+1;
		endforeach;
		//validate entries
		$this->form_validation->set_rules('pricelist_users', 'pricelist_users', 'trim|integer|required');
		$this->form_validation->set_rules('pricelist_ref', 'pricelist_ref', 'required');
		$this->form_validation->set_rules('customer_id', 'customer_id', 'trim');
		
		$data['customer_id'] = $this->input->post('customer_id');
		$data['pricelist_ref'] = $this->input->post('pricelist_ref');
		$data['pricelist_users'] = $this->input->post('pricelist_users');
		$data['pricelist_discount'] = $this->input->post('pricelist_discount');
		$data['additionalservices'] = $this->input->post('additionalservices');
		$data['date_added'] = $this->input->post('date_added');
		$data['user_id'] = $this->input->post('user_id');
		
		$submitted = $this->input->post('submit');
		$segment_active = $this->uri->segment(3);
		$data['customer_name'] = '';
		
		
		
	if($segment_active>0)
			{
				
				$pricelist_id = $this->uri->segment(3);
				
				
				$data2['pricelist_numbers'] = $this->pricelist_model->get_pricelist("$pricelist_id");
				$this->load->vars($data2);
				
				foreach($data2['pricelist_numbers'] as $key => $row)
					{
						$data['pricelist_ref'] = $row['pricelist_ref'];
						$data['customer_id']= $row['customer_id'];
						$data['pricelist_users'] =$row['pricelist_users'];
						$data['pricelist_discount'] = $row['pricelist_discount'];
						$data['additionalservices'] = $row['additionalservices'];
						$data['user_id'] = $row['user_id'];
						$data['company_id'] = $row['company_id'];
						$data['pricelist_id'] = $row['pricelist_id'];
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
					$data['main'] = '/pricelists/main';
					$data['title'] = 'Price Lists & Proposals';
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
				$customer['customer_info'] = $this->prospect_model->get_customer($data['customer_id']);
				foreach($customer['customer_info'] as $key => $row)
							{
								$data['customer_name'] = $row['customer_name'];
							}
				}
				
	if($run=='yes')
		
		{
		
		//CALCULATION STARTS HERE
		
		$discount = ($data['pricelist_discount']/100);
		$additionalservices = $data['additionalservices'];
		$this->db->order_by('maximum_users', 'desc');
		$query = $this->db->get('pricelist_data');
		if ($query->num_rows() > 1)
		{
			foreach ($query->result_array() as $key=>$row3):
			
    			if (($data['pricelist_users'] <= 100) && ($row3['maximum_users'] >= $data['pricelist_users']))	
	    			{
	    				$data['maximum_users'] = $row3['maximum_users'];
	    				$data['maximum_storage'] = $row3['maximum_storage'];
	    				$data['subscription_5_year'] = ($row3['subscription_5_year'])-($discount*$row3['subscription_5_year']);
	    				  				
	    				$data['services_5_year'] = ($row3['services_5_year'])-($discount*$row3['services_5_year']);
	    				$data['annual_support_5_year'] = ($row3['annual_support_5_year'])-($discount*$row3['annual_support_5_year']);
	    				
	    				$data['subscription_1_year'] = ($row3['subscription_1_year'])-($discount*$row3['subscription_1_year'])+$additionalservices;
	    			
	    			}
    			else if (($data['pricelist_users'] > 100) && ($row3['maximum_users']==100))
    				{
    					
    					$extrausersroundup = ceil(($data['pricelist_users']-100)/50);
    					$extrausers = $extrausersroundup*50;
    					$data['maximum_users'] = 100+$extrausers;
    					$data['maximum_storage'] = 'N/A';
    					$data['subscription_5_year'] = (($row3['subscription_5_year'])+($extrausersroundup*20000));
	    				$data['subscription_5_year'] = $data['subscription_5_year']-($discount*$data['subscription_5_year']);
	    				
	    				$data['services_5_year'] = $data['subscription_5_year']*0.1;
	    				$data['annual_support_5_year'] = $data['subscription_5_year']*0.1;
	    				   				
	    				$data['subscription_1_year'] = (($data['subscription_5_year']+$data['services_5_year']+($data['annual_support_5_year']*3))/3)+$additionalservices;
	    			
    				}
    			
				
					
			endforeach;	
		}
		
		//CALCULATION ENDS HERE
		
		
		if($submitted=='Submit')
			{
				$this->pricelist_model->add_pricelist();
				$data['pricelist_id'] = mysql_insert_id();
			}
			
		
			
		if($submitted=='Update')
			{
				$data['pricelist_id'] = $this->input->post('pricelist_id');
				$this->pricelist_model->update_pricelist($data['pricelist_id']);
				//$this->session->set_flashdata('message', "Calculation Updated! $test3");
			}
			if($submitted=='Reset')
			{
				redirect('pricelist/main', 'refresh');
				//$this->session->set_flashdata('message', "Calculation Updated! $test3");
			}
			
		
		
		
		$data['main'] = 'pricelists/results';
		$data['title'] = 'Pricelist';
		
		$this->load->vars($data);
		$this->load->view('template');
		
		}
		
	}
	
function delete_pricelist()
		{
		$data['pricelist_id'] = $this->uri->segment(3);
		$this->pricelist_model->delete_pricelist($data['pricelist_id']);
		$this->session->set_flashdata('message', 'Calculation Deleted');
		redirect('pricelist/main', 'refresh');
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