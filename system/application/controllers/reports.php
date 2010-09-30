<?php 

class Reports extends My_Controller {

	function Reports()
	{
		parent::Controller();
			
		$this->is_logged_in();
		$this->load->library(array('encrypt', 'form_validation'));
	 $this->load->plugin('to_pdf');

	}
	function pdf_create()
	{
				
	    
	     // page info here, db calls, etc.
	  $this->load->view('reports/test');
		   
	     $html = $this->output->get_output();
	     pdf_create($html, 'filename2');
	//$this->load->view('reports/test');
	}
	
	
	
function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('message', 'You are not logged in');
			redirect('user/login');
                       
		}		
	}
	
}