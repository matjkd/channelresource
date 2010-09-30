<?php

class Welcome extends My_Controller {

	function Welcome()
	{
		parent::Controller();	
		$this->is_logged_in();
	}
	
	function index()
	{
		if(SITE=="customer")
			{
			$title = "Customer-Resource";
			$data['main'] = '/main/main_customer';
			}
		else if(SITE=="channel")
			{
			$title = "Channel-Resource";
			$data['main'] = '/main/main_channel';
			}
			else
			{
			$title = "Welcome";
			}
		
		$data['title'] = $title;
		$this->load->vars($data);
		$this->load->view('template');
	}
	function guides()
	{
		$data['main'] = '/guides/main';
		$data['flash'] = 'yes';
		$this->load->vars($data);
		$this->load->view('template');
	}
	
// Customer Resource Links
	function quote()
	{
		$data['main'] = '/quote/main';
		$data['title'] = 'Quoting Tool';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function support()
	{
		$data['main'] = '/support/main';
		$data['title'] = 'Support Request';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function news()
	{
		$data['main'] = '/news/main';
		$data['title'] = 'Latest News';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function directory()
	{
		$data['main'] = '/directory/main';
		$data['title'] = 'Lease Company Directory';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function fla()
	{
		$data['main'] = '/fla/main';
		$data['title'] = 'FLA Business Finance Code';
		$this->load->vars($data);
		$this->load->view('template');
	}
// end of Customer Resource Links

// Channel Resource Links
	function roi()
	{
		$data['number_of_salespeople'] ='';
						$data['appts_per_month'] = '';
						$data['hours_per_appt'] = '';
						$data['appt_sale_ratio'] = '';
						$data['average_salary'] = '';
						$data['average_deal'] = '';
						$data['lease_penetration'] = '';
						$data['acceptance_ratio'] = '';
						$data['average_term'] = '';
						$data['subscription'] = '';
						$data['user_id'] = '';
		$data['main'] = '/roi/main';
		$data['title'] = 'ROI Calculator';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function pricelists()
	{
		$data['main'] = '/pricelists/main';
		$data['title'] = 'Price Lists & Proposals';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function conference()
	{
		$data['main'] = '/conference/main';
		$data['title'] = 'Conference Facilities';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function prospect()
	{
		$data['main'] = '/prospect/main';
		$data['title'] = 'Prospect Registration';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function presentations()
	{
		$data['main'] = '/presentations/main';
		$data['title'] = 'Document Library';
		$this->load->vars($data);
		$this->load->view('template');
	}
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('message', '');
			redirect('user/login');
                       
		}		
	}	
// end of channel resource links
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */