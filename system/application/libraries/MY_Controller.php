<?php

class MY_Controller extends Controller {

	function MY_Controller () {
	parent::Controller();
	
	$config_data['config_company_name'] = "Proctor Consulting";
	$config_data['config_company_short'] = "Company";
	$config_data['config_address'] = "Address";
	$config_data['config_address1'] = "Lake View Drive";
	$config_data['config_address2'] = "Sherwood Park";
	$config_data['config_address3'] = "Nottingham";
	$config_data['config_address4'] = "NG15 0DT";
	$config_data['config_address5'] = "Address";
	$config_data['config_version'] = "0.0.9";
	$config_data['config_email'] = "support@lease-desk.com";
	$config_data['config_website'] = "www.proctorconstulting.co.uk";
	$config_data['config_phone'] = "01302 245310";
	$config_data['currency'] = "&pound;";
	
	$this->config_email = 'email@email.com';
	$this->config_smtp_host = 'smtp.googlemail.com';
	$this->config_smtp_port = 25;
	$this->config_smtp_user = 'email@email.com';
	$this->config_smtp_pass = 'password';
	$this->config_company_name = 'Company';
	$this->load->vars($config_data);
	
	}
	

}