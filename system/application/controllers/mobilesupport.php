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


            //get bucket contents
            //List File attachments
            $bucketname = "lease-desk";
            $data['mainbucket'] = "lease-desk";
            $data['bucket_contents'] = $this->s3->getBucket($bucketname);

            if ($support_status == 3) {
                //convert priority to closed
                $this->support_model->close_priority($support_id);
            }

//convert to text names
            $data['support_issue'] = $this->support_model->name_status('Issue', $support_issue);
            $data['support_priority'] = $this->support_model->name_status('priority', $support_priority);
            $data['support_type'] = $this->support_model->name_status('type', $support_type);
            if ($support_status == "Submitted") {
                $data['support_status'] = "Submitted";
            } else {
                $data['support_status'] = $this->support_model->name_status('status', $support_status);
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

    /**
     * 
     */
    function addnote() {
        $id = $this->input->post('supportid');
        $this->support_model->add_reply($id);
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

        $comment = strip_tags($this->input->post('comment'));

        //get company detail - Try and make this a separate function. Some isn't needed here
        //get details of company/channel partner, this could be trimmed down a touch
        $data['company_details'] = $this->Membership_model->get_company_detail($company_id);
        $initials = "JWS";
        foreach ($data['company_details'] as $row3):

            if ($row3['agent_id'] == NULL) {
                $agent_id = 1;
            } else {
                $agent_id = $row3['agent_id'];
                if ($row3['company_id'] == 2) {
                    $first_initial = substr($this->session->userdata('firstname'), 0, 1);
                    $last_initial = substr($this->session->userdata('lastname'), 0, 1);
                    $initials = "$first_initial" . "" . "$last_initial";
                    //quick fix for julian having 3 initials in webCRM
                    if ($initials == "JS") {
                        $initials = "JWS";
                    }
                } else {
                    $initials = "JWS";
                }
            }

            $company_id_agent = $row3['company_id'];
            $company_name = $row3['company_name'];
        endforeach;


        //email
        $this->postmark->clear();
        $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');
        $this->postmark->to('chloe@lease-desk.com');
        $this->postmark->cc($email_address);
        $this->postmark->bcc('mat@redstudio.co.uk');
        $this->postmark->subject('Reply to Support Request Ticket No ' . $id . '');
        $this->postmark->message_html("Subject: $support_subject<br/><br/>
Company: $company_name<br/><br/>
Reply: $comment
					");
        $this->postmark->send();

        //redirect back
        redirect('mobilesupport/view_support_request/' . $id . '', 'refresh');
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