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
}