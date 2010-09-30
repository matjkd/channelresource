<?php 

class Pricelist_model extends Model {

	function __construct()
    {
        parent::__construct();
        
      
    }
	function add_pricelist()
    {
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
				
    	
    				$new_pricelist_insert_data = array(
    				'pricelist_ref' => $this->input->post('pricelist_ref'),
    				'customer_id' => $this->input->post('customer_id'),
			    	'pricelist_users' => $this->input->post('pricelist_users'),
					'pricelist_discount' => $this->input->post('pricelist_discount'),
    				'additionalservices' => $this->input->post('additionalservices'),
					'user_id' => $this->input->post('user_id'),
    				'date_added' => $this->input->post('date_added'),
    				'date_updated' => $this->input->post('date_added'),
    				'company_id' => $row['company_id']			
					);
		
				
		}
		$insert = $this->db->insert('pricelists', $new_pricelist_insert_data);
		return $insert;
    }
    function update_pricelist($id)
    {
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			
    				$pricelist_update_data = array(
    				'pricelist_ref' => $this->input->post('pricelist_ref'),
    				'customer_id' => $this->input->post('customer_id'),
			    	'pricelist_users' => $this->input->post('pricelist_users'),
    				'additionalservices' => $this->input->post('additionalservices'),
					'pricelist_discount' => $this->input->post('pricelist_discount'),
					'date_updated' => $this->input->post('date_added'),
    					
					);
		}
		$this->db->where('pricelist_id', $id);
		$update = $this->db->update('pricelists', $pricelist_update_data);
		return $update;
    }
	function get_pricelist($id)
    {
    	$data = array();
			$this->db->where('pricelist_id', $id);
			$query = $this->db->get('pricelists');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
    }    
	function list_entries($id)
	{
		$data = array();
		
		$company = $this->session->userdata('company_id');
		//$this->db->order_by('roi.roi_ref');
		if(!isset($company)|| $company > 2)
					{
					$this->db->where('pricelists.company_id', $id);
					$this->db->join('users', 'users.user_id=pricelists.user_id', 'right');
					}
					else if(!isset($company)|| $company < 3)
					{
					$this->db->join('users', 'users.user_id=pricelists.user_id');	
					}
		$Q = $this->db->get('pricelists');
		
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
	
	function list_entries_per_customer($customer)
	{
		$data = array();
		
		$company = $this->session->userdata('company_id');
		
					
		$this->db->where('customer_id', $customer);
					
		$Q = $this->db->get('pricelists');
		
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
	function delete_pricelist($id)
	{
		$this->db->where('pricelist_id', $id);
		$this->db->delete('pricelists');
	}
}
