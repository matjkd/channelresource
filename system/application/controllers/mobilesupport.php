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
        $this->load->library('s3');
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
            $data['support_id'] = $support_id;
            $data['user_id'] = $row['user_id'];
            $data['company_id'] = $row['company_id'];
            $data['telephone'] = $row['telephone'];
            $data['email_address'] = $row['email_address'];
            $data['support_subject'] = $row['support_subject'];

            $data['support_issue'] = $row['support_issue'];
            $data['support_description'] = $row['support_description'];

            $data['completion_date'] = $row['completion_date'];
            $data['support_priority'] = $row['support_priority'];

//TODO make this more elegant as it currently requires changes on multiple pages if a change is made
            if (($row['support_type']) == 1) {
                $type = "Lease-Desk.com";
            }
            if (($row['support_type']) == 2) {
                $type = "Channel-Resource";
            }
            if (($row['support_type']) == 3) {
                $type = "Customer-Resource";
            }
            if (($row['support_type']) == 4) {
                $type = "Training";
            }
            if (($row['support_type']) == 5) {
                $type = "Account Review";
            }

            $data['support_type'] = $type;

            if (($row['support_priority']) == 1) {
                $priority = "<span style='color:red;'>URGENT</span>";
            }
            if (($row['support_priority']) == 2) {
                $priority = "High";
            }
            if (($row['support_priority']) == 3) {
                $priority = "Medium";
            }
            if (($row['support_priority']) == 4) {
                $priority = "Low";
            }

            $data['support_priority'] = $priority;

            if (($row['support_status']) == 1) {
                $status = "Submitted";
            }
            if (($row['support_status']) == "Submitted") {
                $status = "Submitted";
            }
            if (($row['support_status']) == 2) {
                $status = "Assigned";
            }
            if (($row['support_status']) == 3) {
                $status = "Closed";
            }

            if (($row['support_status']) == 4) {
                $status = "Accepted";
            }

            if (($row['support_status']) == 5) {
                $status = "Awaiting Customer";
            }

            if (($row['support_status']) == 6) {
                $status = "Resolved";
            }

            if (($row['support_status']) == 7) {
                $status = "Development";
            }
            $data['support_status'] = $status;
        endforeach;

        //convert channel partner id into the name
        $data['channel_detail'] = $this->Membership_model->get_company_detail($data['company_id']);
        foreach ($data['channel_detail'] as $row):
            $data['channel_partner_name'] = $row['company_name'];
        endforeach;
        //end of conversion
        //
        //
        //List File attachments
        $bucketname = "lease-desk";
        $data['mainbucket'] = "lease-desk";
        $data['bucket_name'] = $data['ticket_id'];
        $data['bucket_contents'] = $this->s3->getBucket($bucketname);

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