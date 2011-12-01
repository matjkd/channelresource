<?php

class MY_Controller extends Controller {

	function MY_Controller () {
	parent::Controller();
	
        
        //TODO make the data on this page come from database...
	$config_data['config_company_name'] = "Lease-Desk Ltd";
	$config_data['config_company_short'] = "Lease-Desk";
	$config_data['config_address'] = "";
	$config_data['config_address1'] = "Lake View Drive";
	$config_data['config_address2'] = "Sherwood Park";
	$config_data['config_address3'] = "Nottingham";
	$config_data['config_address4'] = "NG15 0DT";
	$config_data['config_address5'] = "";
	$config_data['config_version'] = "0.0.9";
	$config_data['config_email'] = "support@lease-desk.com";
	$config_data['config_website'] = "www.lease-desk.com";
	$config_data['config_phone'] = "01302 245310";
	//$config_data['currency'] = "&pound;";
	
	$this->config_email = 'support@lease-desk.com';
	
	$this->config_company_name = 'Lease-Desk Ltd';
               
	$this->load->vars($config_data);
	
	}
	

}