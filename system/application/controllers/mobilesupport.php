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
            $data['support_description'] = $row['support_description'];
            $data['completion_date'] = $row['completion_date'];

            $support_type = $row['support_type'];
            $support_issue = $row['support_issue'];
            $support_priority = $row['support_priority'];
            $support_status = $row['support_status'];

//convert to text names
            $data['support_issue'] = $this->support_model->name_status('Issue', $support_issue);
            $data['support_priority'] = $this->support_model->name_status('priority', $support_priority);
            $data['support_type'] = $this->support_model->name_status('type', $support_type);
            if ($support_status == "Submitted") {
                $data['support_status'] = "Submitted";
            } else {
                $data['support_status'] = $this->support_model->name_status('status', $support_type);
            }
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
        $data['bucket_name'] = $support_id;
        $data['bucket_contents'] = $this->s3->getBucket($bucketname);

        //fetch notes
        $data['comments'] = $this->support_model->list_replies($support_id);


        $data['desktop'] = 'support';
        $data['main'] = '/support/mobile/view_request';
        $data['title'] = 'Support Requests';
        $this->load->vars($data);
        $this->load->view('mobile_template');
    }

    function addnote() {
        $id = $this->input->post('supportid');

        $data['ticket_details'] = $this->support_model->get_ticket($id);
        foreach ($data['ticket_details'] as $row5):

            $support_type = $row5['support_type'];
            $support_issue = $row5['support_issue'];
            $support_priority = $row5['support_priority'];
            $support_status = $row5['support_status'];
            $email_address = $row5['email_address'];
            $company_id = $row5['company_id'];
            $user_id = $row5['user_id'];
            $support_subject = $row5['support_subject'];
        endforeach;

        $data['support_issue'] = $this->support_model->name_status('Issue', $support_issue);
        $data['support_priority'] = $this->support_model->name_status('priority', $support_priority);
        $data['support_type'] = $this->support_model->name_status('type', $support_type);
        if ($support_status == "Submitted") {
            $data['support_status'] = "Submitted";
        } else {
            $data['support_status'] = $this->support_model->name_status('status', $support_type);
        }
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