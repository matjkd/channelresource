<?php

class Support_model extends Model {

	function __construct()
    {
        parent::__construct();
       
    }
 function add_ticket()
    {
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
				
    	
    				$new_ticket_insert_data = array(
    				
    				'telephone'	=> $this->input->post('telephone'),	
    				'email_address'	=> $this->input->post('email_address'),
    				'support_subject'	=> $this->input->post('support_subject'),
    				'support_description' => $this->input->post('support_description'),
    				'support_type' => $this->input->post('support_type'),
    				'support_issue' => $this->input->post('support_issue'),
    				'support_priority' => $this->input->post('support_priority'),
    				'support_status' => 'Submitted',
    				'company_id' => $this->session->userdata('company_id'),	
    				'user_id' => $this->input->post('user_id'),
    				'date_added' => $this->input->post('date_added'),
    				'date_updated' => $this->input->post('date_added')				
					);
		
				
		}
		$insert = $this->db->insert('support', $new_ticket_insert_data);
		return $insert;
    }
   function update_ticket($id)
    {
    	
    	$this->db->select('company_id');
		$this->db->where('user_id', $this->input->post('user_id'));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			
    				$support_update_data = array(
    				
    				'telephone'	=> $this->input->post('telephone'),	
    				'email_address'	=> $this->input->post('email_address'),
    				'support_description' => $this->input->post('support_description'),
    				'support_type' => $this->input->post('support_type'),
    				'support_issue' => $this->input->post('support_issue'),
    				'support_priority' => $this->input->post('support_priority'),
    				'support_status' => $this->input->post('support_status'),
    				'date_updated' => $this->input->post('date_added')
					
					);
		}
		$this->db->where('support_id', $id);
		$update = $this->db->update('support', $support_update_data);
		return $update;
    }
		
function list_tickets($id)
	{
		$data = array();
		
		$company = $this->session->userdata('company_id');
		//$this->db->order_by('roi.roi_ref');
		if(!isset($company)|| $company > 2)
					{
					$this->db->where('support.company_id', $id);
					$this->db->join('users', 'users.user_id=support.user_id', 'right');
					$this->db->join('company', 'company.company_id=support.company_id', 'left');
					
					}
					else if(!isset($company)|| $company < 3)
					{
					$this->db->join('users', 'users.user_id=support.user_id');	
					$this->db->join('company', 'company.company_id=support.company_id', 'left');
					}
		$Q = $this->db->get('support');
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
	
   	function get_ticket($id)
    {
    	$data = array();
			$this->db->where('support_id', $id);
			$query = $this->db->get('support');
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
 
	function add_reply($id)
	{
		$now = unix_to_human(now(), TRUE, 'eu');
		$new_reply_insert_data = array(
    	'support_id'	=> $id,	
    	'comment' => $this->input->post('comment'),	
    	'added_by' => $this->session->userdata('user_id'),	
    	'date_added' => $now,
		'date_updated' => $now			
		);
		$update_date = array(
		'date_updated' => $now
		);
		
		$insert = $this->db->insert('support_comments', $new_reply_insert_data);
		$this->db->where('support_id', $id);
		$this->db->update('support', $update_date);
		return $insert;
	}
	function list_replies($id)
	{
		$comments = array();
			
		$company = $this->session->userdata('company_id');
		//$this->db->order_by('roi.roi_ref');
		
					$this->db->where('support_id', $id);
					$this->db->join('users', 'users.user_id=support_comments.added_by', 'right');
				
		
					$Q = $this->db->get('support_comments');
		
			
			
			foreach ($Q->result_array() as $row):
			
			$comments[] = $row;
			
			endforeach;	
			
			
		
	
		$Q->free_result();
		return $comments;
	}
	function edit_reply($id)
	{
		$now = unix_to_human(now(), TRUE, 'eu');
		$comments_id = $this->input->post('comments_id');
		$new_reply_update_data = array(
    	'support_id'	=> $id,	
    	'comment' => $this->input->post('comment'),	
    	'added_by' => $this->session->userdata('user_id'),	
    	'date_added' => $now,
		'date_updated' => $now			
		);
		$update_date = array(
		'date_updated' => $now
		);
		$this->db->where('comments_id', $comments_id);
		$update = $this->db->update('support_comments', $new_reply_update_data);
		
		$this->db->where('support_id', $id);
		$update = $this->db->update('support', $update_date);
		
		
		return $update;
	}
function delete_reply($id)
	{
		
		$comments_id = $this->input->post('comments_id');
	
		
		$this->db->where('comments_id', $comments_id);
		$insert = $this->db->delete('support_comments');
		
		return $insert;
	}
	
	
	function delete_ticket($id)
    {
    	
    	$is_logged_in = $this->session->userdata('is_logged_in');
    	$company_of_user = $this->session->userdata('company_id');
    	$role = $this->session->userdata('role');
    	if(!isset($is_logged_in) || $role != 1)
		{
			
			$this->db->where('company_id', $company_of_user);
			$this->db->where('support_id', $id);
			$this->db->limit(1);
			$this->db->delete('support');           
		}		
    	else
    	{
	    	$this->db->where('support_id', $id);
	    	$this->db->limit(1);
			$this->db->delete('support');	
    	}
    	
    }
}