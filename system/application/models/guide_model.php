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
}