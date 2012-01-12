<?php

class Mobilesupport extends My_Controller {

    /**
     * Controller for the mobile areas of the site
     * At this stage just the Quote.
     * 
     *
     *
     */
    function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('support_model');
        $this->load->model('membership_model');
        $this->load->plugin('to_pdf');
        $this->load->library('user_agent');
    }

    function index() {
        //get current user info
        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');

        //get list of related tickets
        $data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);

        $data['desktop'] = 'support';
        $data['main'] = '/support/mobile/list';
        $data['title'] = 'Support Requests';
        $this->load->vars($data);
        $this->load->view('mobile_template');
    }

    function view_support_request($support_id) {
        //get current user info
        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');

        //get ticket data
        $data['ticket_data'] = $this->support_model->get_ticket($support_id);
        foreach ($data['ticket_data'] as $row):
            
            $data['user_id'] = $row['user_id'];
            $data['company_id'] = $row['company_id'];
            $data['telephone'] = $row['telephone'];
            $data['email_address'] = $row['email_address'];
            $data['support_subject'] = $row['support_subject'];
            $data['support_type'] = $row['support_type'];
            $data['support_issue'] = $row['support_issue'];
            $data['support_description'] = $row['support_description'];
            $data['support_status'] = $row['support_status'];
            $data['completion_date'] = $row['completion_date'];
            $data['support_priority'] = $row['support_priority'];
            
        endforeach;
        
         //convert channel partner id into the name
        $data['channel_detail'] = $this->Membership_model->get_company_detail($data['company_id']);
        foreach ($data['channel_detail'] as $row):
            $data['channel_partner_name'] = $row['company_name'];
        endforeach;
        //end of conversion

        $data['desktop'] = 'support';
        $data['main'] = '/support/mobile/view_request';
        $data['title'] = 'Support Requests';
        $this->load->vars($data);
        $this->load->view('mobile_template');
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $role = $this->session->userdata('role');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            $data['message'] = "You don't have permission";
            redirect('welcome', 'refresh');
        }
    }

}