<?php

class Roi_model extends Model {

	function __construct()
    {
        parent::__construct();
       
    }
   function add_data()
    {
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
				
    	
    				$new_roi_insert_data = array(
    				'roi_ref' => $this->input->post('roi_ref'),
    				'customer_id' => $this->input->post('customer_id'),
			    	'number_of_salespeople' => $this->input->post('number_of_salespeople'),
					'appts_per_month' => $this->input->post('appts_per_month'),
					'hours_per_appt' => $this->input->post('hours_per_appt'),
					'appt_sale_ratio' => $this->input->post('appt_sale_ratio'),
					'average_salary' => $this->input->post('average_salary'),
					'average_deal' => $this->input->post('average_deal'),
					'lease_penetration' => $this->input->post('lease_penetration'),
					'acceptance_ratio' => $this->input->post('acceptance_ratio'),
					'average_term' => $this->input->post('average_term'),
					'subscription' => $this->input->post('subscription'),
					'user_id' => $this->input->post('user_id'),
    				'date_added' => $this->input->post('date_added'),
    				'date_updated' => $this->input->post('date_added'),
    				'company_id' => $row['company_id']			
					);
		
				
		}
		$insert = $this->db->insert('roi', $new_roi_insert_data);
		return $insert;
    }
   function update_data($id)
    {
    	
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			
    				$roi_update_data = array(
    				'roi_ref' => $this->input->post('roi_ref'),
    				'customer_id' => $this->input->post('customer_id'),
					'number_of_salespeople' => $this->input->post('number_of_salespeople'),
					'appts_per_month' => $this->input->post('appts_per_month'),
					'hours_per_appt' => $this->input->post('hours_per_appt'),
					'appt_sale_ratio' => $this->input->post('appt_sale_ratio'),
					'average_salary' => $this->input->post('average_salary'),
					'average_deal' => $this->input->post('average_deal'),
					'lease_penetration' => $this->input->post('lease_penetration'),
					'acceptance_ratio' => $this->input->post('acceptance_ratio'),
					'average_term' => $this->input->post('average_term'),
					'subscription' => $this->input->post('subscription'),
    				'date_updated' => $this->input->post('date_added'),
					
					);
		}
		$this->db->where('roi_id', $id);
		$update = $this->db->update('roi', $roi_update_data);
		return $update;
    }
		
function list_entries($id)
	{
		$data = array();
		
		$company = $this->session->userdata('company_id');
		//$this->db->order_by('roi.roi_ref');
		if(!isset($company)|| $company > 2)
					{
					$this->db->where('roi.company_id', $id);
					$this->db->join('users', 'users.user_id=roi.user_id', 'right');
					}
					else if(!isset($company)|| $company < 3)
					{
					$this->db->join('users', 'users.user_id=roi.user_id');	
					}
		$Q = $this->db->get('roi');
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row):
			
			$results[] = $row;
			
			
			endforeach;	
			
			
			
		}
		else
		{
			$results[] = "X";
		}
		$Q->free_result();
		
	
	return $results;
	}
function list_entries_per_prospect($customer)
	{
		$data = array();
		
		$company = $this->session->userdata('company_id');
		
		
		$this->db->where('customer_id', $customer);
					
		$Q = $this->db->get('roi');
		
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row):
			
			$results[] = $row;
			
			
			endforeach;	
			
			
			
		}
		else
		{
			$results[] = "X";
		}
		$Q->free_result();
		
	
	return $results;
	}
	
   	function get_data($id)
    {
    	$data = array();
			$this->db->where('roi_id', $id);
			$query = $this->db->get('roi');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
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
		$query->free_result();
		
		return $data;
	}
 function delete_roi($id)
    {
    	
    	$is_logged_in = $this->session->userdata('is_logged_in');
    	$company_of_user = $this->session->userdata('company_id');
    	$role = $this->session->userdata('role');
    	if(!isset($is_logged_in) || $role != 1)
		{
			
			$this->db->where('company_id', $company_of_user);
			$this->db->where('roi_id', $id);
			$this->db->limit(1);
			$this->db->delete('roi');           
		}		
    	else
    	{
	    	$this->db->where('roi_id', $id);
	    	$this->db->limit(1);
			$this->db->delete('roi');	
    	}
    	
    }
    
}