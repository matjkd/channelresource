<?php 

class Guide_model extends Model {

	function __construct()
    {
        parent::__construct();
        
      
    }
    function get_guide($id)
    {
    	$data = array();
			$this->db->where('user_guide_id', $id);
			$query = $this->db->get('user_guides');
			if ($query->num_rows() == 1)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
    }
 	function get_guides($section)
    {
    	$data = array();
			$this->db->where('guide_section', $section);
			$query = $this->db->get('user_guides');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
    }
function update_guide($id)
    {
    	
    	
		$this->db->where('user_guide_id', $id);
		$query = $this->db->get('user_guides');
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			
    				$guide_update = array(
    				'filename' => $this->input->post('filename'),
    				'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
    				'date_modified' => now()
					);
		}
		$this->db->where('user_guide_id', $id);
		$update = $this->db->update('user_guides', $guide_update);
		return $update;
    }
function get_all_tags()
    {
    	$data = array();
		
			
			$query = $this->db->get('tags');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
    }
function get_assigned_tags($id)
    {
    	$data = array();
			$this->db->where('guide_id', $id);
			$this->db->join('tags', 'tags.tag_id = tag_links.tag_id', 'LEFT');
			$query = $this->db->get('tag_links');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				
				$data[] = $row;
				
			}
		$query->free_result();
		
		return $data;
    }
 
}