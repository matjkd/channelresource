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

        $data['prioritylist'] = $this->support_model->get_statuses('Priority');
        $data['type'] = $this->support_model->get_statuses('Issue');
        $data['areas'] = $this->support_model->get_statuses('Type');
        $data['statuslist'] = $this->support_model->get_statuses('status');

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
        $data['ticket_id'] = $support_id;
        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');

        //get ticket data
        $data['ticket_data'] = $this->support_model->get_ticket($support_id);
        foreach ($data['ticket_data'] as $row):
            $data['support_id'] = $support_id;
            $data['user_id'] = $row['user_id'];
            $data['assigned'] = $row['assigned_to'];
            $data['assigned_id'] = $row['assigned_to'];

            $data['company_id'] = $row['company_id'];
            $data['telephone'] = $row['telephone'];
            $data['email_address'] = $row['email_address'];
            $data['support_subject'] = $row['support_subject'];
            $data['support_description'] = $row['support_description'];
            $data['completion_date'] = $row['completion_date'];
            $data['start_date'] = $row['start_date'];

            $support_type = $row['support_type'];
            $support_issue = $row['support_issue'];
            $support_priority = $row['support_priority'];
            $support_status = $row['support_status'];


            //Turn the assigned user id into the full name then get the company details
            if ($data['assigned'] != 0 && $data['assigned'] != NULL) {

                $customer['assigned_info'] = $this->Membership_model->get_employee_detail($data['assigned']);
                foreach ($customer['assigned_info'] as $key => $row) {
                    $data['assigned_name'] = "" . $row['firstname'] . " " . $row['lastname'] . "";
                    $data['assigned_company'] = $row['company_id'];
                    $data['assigned_email'] = $row['email_address'];
                    $data['assigned_email_2'] = $row['email_address'];
                }
            } else {

                $customer['assigned_info'] = $this->Membership_model->get_employee_detail($data['user_id']);
                foreach ($customer['assigned_info'] as $key => $row) {
                    $data['assigned_name'] = "" . $row['firstname'] . " " . $row['lastname'] . "";
                    $data['assigned_company'] = $row['company_id'];
                    $data['assigned_email'] = $row['email_address'];
                    $data['assigned_email_2'] = "no";
                }
            }

//human completion date
            if ($data['completion_date'] != NULL && $data['completion_date'] != "0000-00-00") {
                $humandate = new DateTime($data['completion_date']);
                $data['humandate'] = date_format($humandate, 'D, d M Y');
            } else {
                $data['humandate'] = "N/A";
            }

            //human start date
            if ($data['start_date'] != NULL && $data['start_date'] != "0000-00-00") {
                $starthumandate = new DateTime($data['start_date']);
                $data['starthumandate'] = date_format($starthumandate, 'D, d M Y');
            } else {
                $data['starthumandate'] = "N/A";
            }


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

        $reply_id = $this->support_model->add_reply($id);
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


        $subject = 'Reply to Support Request Ticket No ' . $id;
        $this->send_email($email_address, $reply_id, $subject, $type = 'emails/newReply', $support = 'reply');

        //redirect back
        redirect('mobilesupport/view_support_request/' . $id . '', 'refresh');
    }

    /*
     *  Function for handling all emails.. This needs to be moved into a helper or 
     * model because it is the same as the one in the support controller
     * 
     */

    function send_email($to, $support_id, $subject, $type='emails/newRequest', $support = 'support') {

        if ($support == 'support') {
            $data['supportRequest'] = $this->support_model->get_all_ticket_data($support_id);
            foreach ($data['supportRequest'] as $row):

                $data['support_issue'] = $this->support_model->name_status('Issue', $row['support_issue']);
                $data['support_priority'] = $this->support_model->name_status('priority', $row['support_priority']);
                $data['support_type'] = $this->support_model->name_status('type', $row['support_type']);
                $data['support_status'] = $this->support_model->name_status('status', $row['support_status']);

            endforeach;

            //get log of current support request
            $data['supportRequestLog'] = $this->support_model->get_all_ticket_data($support_id, 'support_log');
            foreach ($data['supportRequestLog'] as $row):

                $data['support_issueLog'] = $this->support_model->name_status('Issue', $row['support_issue']);
                $data['support_priorityLog'] = $this->support_model->name_status('priority', $row['support_priority']);
                $data['support_typeLog'] = $this->support_model->name_status('type', $row['support_type']);
                $data['support_statusLog'] = $this->support_model->name_status('status', $row['support_status']);

            endforeach;
        }

        if ($support == 'reply') {
            $data['supportReply'] = $this->support_model->get_all_reply_data($support_id);
        }

        $data['emailType'] = $type;
        $data['title'] = $subject;
        $this->load->vars($data);
        $msg = $this->load->view('emails/emailTemplate', $data, true);
        $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');
        $this->postmark->to('customer-resource@lease-desk.com');
        $this->postmark->bcc('mat@redstudio.co.uk');
        $this->postmark->subject($data['title']);
        $this->postmark->cc($to);
        $this->postmark->message_html("
                       
                        $msg
                       
                                               
                        ");

        $this->postmark->send();
        $this->postmark->clear();
    }

    function add_request() {
        //get current user info
        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');

        //if admin get all employees, if not just get from user company
        if ($this->session->userdata('role') < 3) {
            $data['items'] = $this->Membership_model->get_all_employees();
        } else {

            $owner_company_id = $this->session->userdata('company_id');
            $data['items'] = $this->Membership_model->get_employees($owner_company_id);
        }

        //get members of proctor consulting
        $data['responsibleusers'] = $this->Membership_model->get_employees('2');

        $data['companies'] = $this->Membership_model->get_companies();
        //get list of related tickets
        $data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);

        $data['channel_partner'] = '';

        $data['user_id'] = '';
        $data['ticket_id'] = '';
        $data['assigned'] = '';
        $data['assigned_name'] = '';
        $data['assigned_id'] = '';
        $data['telephone'] = '';
        $data['email_address'] = '';
        $data['support_subject'] = '';
        $data['support_type'] = '';
        $data['support_issue'] = '';
        $data['support_priority'] = '';
        $data['completion_date'] = '';
        $data['start_date'] = '';
        $data['support_description'] = '';
        $data['support_status'] = 'Submitted';
        $data['title'] = 'New Support-Request';

        $data['desktop'] = 'support';

        $data['prioritylist'] = $this->support_model->get_statuses('Priority');
        $data['type'] = $this->support_model->get_statuses('Issue');
        $data['areas'] = $this->support_model->get_statuses('Type');
        $data['resultsview'] = 0;
        $data['main'] = '/support/mobile/add_request';
        $data['title'] = 'Support Requests';
        $this->load->vars($data);
        $this->load->view('mobile_template');
    }

    function edit_request() {
        $data['ticket_id'] = $this->uri->segment(3);
        $data['ticket_data'] = $this->support_model->get_ticket($data['ticket_id']);
        //get current user info
        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');

        //if admin get all employees, if not just get from user company
        if ($this->session->userdata('role') < 3) {
            $data['items'] = $this->Membership_model->get_all_employees();
        } else {

            $owner_company_id = $this->session->userdata('company_id');
            $data['items'] = $this->Membership_model->get_employees($owner_company_id);
        }

        //get members of proctor consulting
        $data['responsibleusers'] = $this->Membership_model->get_employees('2');

        $data['companies'] = $this->Membership_model->get_companies();
        //get list of related tickets
        $data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);

        $data['channel_partner'] = '';

        foreach ($data['ticket_data'] as $row):


            $data['user_id'] = $row['user_id'];
            $data['assigned'] = $row['assigned_to'];
            $data['assigned_id'] = $row['assigned_to'];
            $data['responsible'] = $row['responsible'];
            $data['company_id'] = $row['company_id'];
            $data['telephone'] = $row['telephone'];
            $data['email_address'] = $row['email_address'];
            $data['support_subject'] = $row['support_subject'];
            $data['support_type'] = $row['support_type'];
            $data['support_issue'] = $row['support_issue'];
            $data['support_description'] = $row['support_description'];
            $data['support_status'] = $row['support_status'];
            $data['completion_date'] = $row['completion_date'];
            $data['start_date'] = $row['start_date'];
            $data['support_priority'] = $row['support_priority'];
        endforeach;

        //Turn the assigned user id into the full name then get the company details
        if ($data['assigned'] != 0 && $data['assigned'] != NULL) {

            $customer['assigned_info'] = $this->Membership_model->get_employee_detail($data['assigned']);
            foreach ($customer['assigned_info'] as $key => $row) {
                $data['assigned_name'] = "" . $row['firstname'] . " " . $row['lastname'] . "";
                $data['assigned_company'] = $row['company_id'];
                $data['assigned_email'] = $row['email_address'];
                $data['assigned_email_2'] = $row['email_address'];
            }
        } else {

            $customer['assigned_info'] = $this->Membership_model->get_employee_detail($data['user_id']);
            foreach ($customer['assigned_info'] as $key => $row) {
                $data['assigned_name'] = "" . $row['firstname'] . " " . $row['lastname'] . "";
                $data['assigned_company'] = $row['company_id'];
                $data['assigned_email'] = $row['email_address'];
                $data['assigned_email_2'] = "no";
            }
        }

        $data['title'] = 'Edit Support-Request';

        $data['desktop'] = 'support';

        $data['prioritylist'] = $this->support_model->get_statuses('Priority');
        $data['type'] = $this->support_model->get_statuses('Issue');
        $data['areas'] = $this->support_model->get_statuses('Type');
        $data['statuslist'] = $this->support_model->get_statuses('status');

        $data['resultsview'] = 1;
        $data['main'] = '/support/mobile/add_request';
        $data['title'] = 'Support Requests';
        $this->load->vars($data);
        $this->load->view('mobile_template');
    }

    function post_request() {
        
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