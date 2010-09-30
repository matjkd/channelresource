<?php 

class Prospect_model extends Model {

	function __construct()
    {
        parent::__construct();
        
      
    }
    function add_customer()
    {
    	
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
			{
				foreach ($query->result_array() as $row)
					
	    	
	    				$new_customer_insert_data = array(
	    				
						'customer_name' => $this->input->post('customer_name'),
	    				'customer_address1' => $this->input->post('customer_address1'),
	    				'customer_address2' => $this->input->post('customer_address2'),
	    				'customer_address3' => $this->input->post('customer_address3'),
	    				'customer_address4' => $this->input->post('customer_address4'),
	    				'customer_postcode' => $this->input->post('customer_postcode'),
	    				'customer_status' => $this->input->post('customer_status'),
	    				'customer_tel' => $this->input->post('customer_tel'),
	    				'date_added' => $this->input->post('date_added'),
	    				
	    				'customer_registration_date' => $this->input->post('customer_registration_date'),
						'channel_partner' => $this->session->userdata('company_id'),
						'customer_registration_date' => $this->input->post('customer_registration_date'),
						'customer_subscription_date' => $this->input->post('customer_subscription_date'),
						'customer_subscription_type' => $this->input->post('customer_subscription_type'),
						'customer_subscription_price' => $this->input->post('customer_subscription_price'),
						'customer_prof_services' => $this->input->post('customer_prof_services'),
						'customer_annual_support' => $this->input->post('customer_annual_support'),
						'customer_next_renewal' => $this->input->post('customer_next_renewal'),
						'customer_renewal_type' => $this->input->post('customer_renewal_type'),
			    				
	    				
	    				
						'user_id' => $this->input->post('user_id'),
	    				'company_id' => $row['company_id']	
						);
				$insert = $this->db->insert('customers', $new_customer_insert_data);
				return $insert;
			}
    	
    }
    
    
    
    
    function update_customer($id)
    {
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			
    				$customer_update_data = array(
    				'customer_name' => $this->input->post('customer_name'),
    				'customer_address1' => $this->input->post('customer_address1'),
    				'customer_address2' => $this->input->post('customer_address2'),
    				'customer_address3' => $this->input->post('customer_address3'),
    				'customer_address4' => $this->input->post('customer_address4'),
    				'customer_postcode' => $this->input->post('customer_postcode'),
    				'customer_status' => $this->input->post('customer_status'),
    				'customer_tel' => $this->input->post('customer_tel'),
    				'date_updated' => $this->input->post('date_added'),
    				
    				'channel_partner' => $this->input->post('channel_partner'),
					'customer_registration_date' => $this->input->post('customer_registration_date'),
					'customer_subscription_date' => $this->input->post('customer_subscription_date'),
					'customer_subscription_type' => $this->input->post('customer_subscription_type'),
					'customer_subscription_price' => $this->input->post('customer_subscription_price'),
					'customer_prof_services' => $this->input->post('customer_prof_services'),
					'customer_annual_support' => $this->input->post('customer_annual_support'),
					'customer_next_renewal' => $this->input->post('customer_next_renewal'),
					'customer_renewal_type' => $this->input->post('customer_renewal_type'),
					//'company_id' => $row['company_id']
					);
		}
		$this->db->where('customer_id', $id);
		$update = $this->db->update('customers', $customer_update_data);
		return $update;
    }
    function list_customers($id)
    {
    	$data = array();
		$this->db->from('customers');
		$this->db->order_by('customer_name');
		$company = $this->session->userdata('company_id');
				if(!isset($company)|| $company > 2)
					{
					$this->db->where('customers.company_id', $id);
					$this->db->join('users', 'users.user_id=customers.user_id', 'right');
					}
					else if(!isset($company)|| $company < 3)
					{
						
						$this->db->join('users', 'users.user_id=customers.user_id');
						
					}
					
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row):
			$results[] = $row;
			endforeach;	
			
		}
		else
		{
			$results = NULL;
		}
		
		$Q->free_result();
		
	
	return $results;
    }
    
    function get_customer($id)
    {
    	$data = array();
			$this->db->where('customer_id', $id);
			$query = $this->db->get('customers');
			if ($query->num_rows() > 0)
				{
					foreach ($query->result_array() as $row)
					$data[] = $row;
					
				}
			else if ($query->num_rows() < 1)
				{
					$data['customer_name'] = 'Company Deleted';
				}
		
		$query->free_result();
		return $data;
    }
    function check_duplicate($name)
    {
    	 	$match = substr(str_replace(' ', '', strtolower($name)), 0, 7);
			
    	 
    	 	
			$this->db->like('SUBSTRING(REPLACE(LOWER(customer_name), " ", ""), 1, 7)', $match);
			$query = $this->db->get('customers');
			if ($query->num_rows() > 0)
				
				{
					foreach ($query->result_array() as $row)
					$data[] = $row;
					return $data;
				}
			else if ($query->num_rows() == 0)
				{
					$data['customer_name'] = NULL;
					return $data;
				}
	
    }
 	function delete_customer($id)
    {
    	$this->db->where('customer_id', $id);
		$this->db->delete('customers');
    }
   
}