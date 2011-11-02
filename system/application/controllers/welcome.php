<?php

class Welcome extends My_Controller {

	function Welcome()
	{
		parent::Controller();	
		$this->is_logged_in();
                $this->load->library('user_agent');
	}
	
	function index()
	{
		if(SITE=="customer")
			{
			$title = "Customer-Resource";
			$data['main'] = '/main/main_customer';
                        $data['slideshow'] = "slideshow/slideshow";
			}
		else if(SITE=="channel")
			{
			$title = "Channel-Resource";
			$data['main'] = '/main/main_channel';
                        $data['slideshow'] = "slideshow/slideshow";
			}
			else
			{
			$title = "Welcome";
			}
                        
                        if ($this->agent->is_mobile())
                                        {
                                        $data['main'] = '/main/mainmobile';
                                         $data['title'] = $title;
                                         $this->load->vars($data);
		$this->load->view('mobile_template');
                                        }
		else
                                    {
                                  $data['title'] = $title;
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
                                    }
		
		
	}
	function guides()
	{
		$data['main'] = '/guides/main';
		$data['flash'] = 'yes';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	
// Customer Resource Links
	function quote()
	{
		$data['main'] = '/quote/main';
		$data['title'] = 'Quoting Tool';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function support()
	{
		$data['main'] = '/support/main';
		$data['title'] = 'Support Request';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function news()
	{
		$data['main'] = '/news/main';
		$data['title'] = 'Latest News';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function directory()
	{
		$data['main'] = '/directory/main';
		$data['title'] = 'Lease Company Directory';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function fla()
	{
		$data['main'] = '/fla/main';
		$data['title'] = 'FLA Business Finance Code';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
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
		$this->load->view('leasedesktemplate');
	}
	function pricelists()
	{
		$data['main'] = '/pricelists/main';
		$data['title'] = 'Price Lists & Proposals';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function conference()
	{
		$data['main'] = '/conference/main';
		$data['title'] = 'Conference Facilities';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function prospect()
	{
		$data['main'] = '/prospect/main';
		$data['title'] = 'Prospect Registration';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
	function presentations()
	{
		$data['main'] = '/presentations/main';
		$data['title'] = 'Document Library';
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
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