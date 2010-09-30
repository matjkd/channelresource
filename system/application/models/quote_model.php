<?php

class Quote_model extends Model {

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
				
    	
    				$new_quote_insert_data = array(
    				'quote_ref' => $this->input->post('quote_ref'),
					'capital' => $this->input->post('capital'),
    				'capital_type' => $this->input->post('capital_type'),
    				'amount_type' => $this->input->post('amount_type'),
    				'interest_type' => $this->input->post('interest_type'),
    				'calculate_by' => $this->input->post('calculate_by'),
    				'payment_type' => $this->input->post('payment_type'),
    				'payment_frequency' => $this->input->post('payment_frequency'),
    				'initial' => $this->input->post('initial'),
    				'regular' => $this->input->post('regular'),
    				'number_of_ports' => $this->input->post('number_of_ports'),
    				'annual_support_costs' => $this->input->post('annual_support_costs'),
    				'other_monthly_costs' => $this->input->post('other_monthly_costs'),
    				'date_added' => $this->input->post('date_added'),
					'user_id' => $this->input->post('user_id'),
    				'company_id' => $row['company_id']	
					);
		
				$insert = $this->db->insert('quote', $new_quote_insert_data);
				return $insert;
		}
		
    }
   function update_data($id)
    {
    	
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			
    				$quote_update_data = array(
    				'quote_ref' => $this->input->post('quote_ref'),
					'capital' => $this->input->post('capital'),
    				'capital_type' => $this->input->post('capital_type'),
    				'amount_type' => $this->input->post('amount_type'),
    				'interest_type' => $this->input->post('interest_type'),
    				'calculate_by' => $this->input->post('calculate_by'),
    				'payment_type' => $this->input->post('payment_type'),
    				'payment_frequency' => $this->input->post('payment_frequency'),
    				'initial' => $this->input->post('initial'),
    				'regular' => $this->input->post('regular'),
    				'number_of_ports' => $this->input->post('number_of_ports'),
    				'annual_support_costs' => $this->input->post('annual_support_costs'),
    				'other_monthly_costs' => $this->input->post('other_monthly_costs'),
    				'date_added' => $this->input->post('date_added'),
					//'user_id' => $this->input->post('user_id'),
    				//'company_id' => $row['company_id']	
					);
		}
		$this->db->where('quote_id', $id);
		$update = $this->db->update('quote', $quote_update_data);
		return $update;
    }
	function list_entries($id, $num, $offset)
	{
		$data = array();
		$company = $this->session->userdata('company_id');
		
		if(!isset($company)|| $company > 2)
					{
					$this->db->where('quote.company_id', $id);
					$this->db->join('users', 'users.user_id=quote.user_id', 'right');
					}
					else if(!isset($company)|| $company < 3)
					{
					$this->db->join('users', 'users.user_id=quote.user_id');	
					}
		$Q = $this->db->get('quote');
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
function list_entries_by_user()
	{
		$data = array();
		$company = $this->session->userdata('company_id');
		$user = $this->session->userdata('user_id');
		if(!isset($company)|| $company > 2)
					{
					$this->db->where('quote.user_id', $user);
					$this->db->join('users', 'users.user_id=quote.user_id', 'right');
					}
					else if(!isset($company)|| $company < 3)
					{
					$this->db->join('users', 'users.user_id=quote.user_id');	
					}
		$Q = $this->db->get('quote');
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
			$this->db->where('quote_id', $id);
			$query = $this->db->get('quote');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
    }
    function delete_quote($id)
    {
    	$this->db->where('quote_id', $id);
		$this->db->delete('quote');
    }
    
}