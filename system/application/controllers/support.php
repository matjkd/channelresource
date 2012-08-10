<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Support extends My_Controller {

    function Support() {
        parent::Controller();

        $this->is_logged_in();
        $this->load->library('user_agent');
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('support_model');
        $this->load->library('upload');
        $this->load->library('s3');

        if ($this->session->userdata('company_id') == 75) {
            $this->template = "redbox_template";
        } else {
            $this->template = "leasedesktemplate";
        }
    }

    function index() {
        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');
        $data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);
        $data['closed_ticket_list'] = $this->support_model->list_closed_tickets($data['customercompany_id']);

        //if admin get all employees, if not just get from user company
        if ($this->session->userdata('role') < 3) {
            $data['items'] = $this->Membership_model->get_all_employees();
        } else {

            $owner_company_id = $this->session->userdata('company_id');
            $data['items'] = $this->Membership_model->get_employees($owner_company_id);
        }


        //get members of proctor consulting
        $data['responsibleusers'] = $this->Membership_model->get_employees('2');

        if ($data['ticket_list'] != NULL) {
            $data['rowcount'] = 0;
            foreach ($data['ticket_list'] as $countrow):
                $data['rowcount'] = $data['rowcount'] + 1;
            endforeach;
        }

        if ($data['closed_ticket_list'] != NULL) {
            $data['rowcount'] = 0;
            foreach ($data['closed_ticket_list'] as $countrow):
                $data['rowcount'] = $data['rowcount'] + 1;
            endforeach;
        }
        $data['channel_detail'] = $this->Membership_model->get_company_detail($data['customercompany_id']);
        foreach ($data['channel_detail'] as $row):

            $data['channel_partner_name'] = $row['company_name'];

        endforeach;


        $data['channel_partner'] = '';

        $data['user_id'] = '';
        $data['ticket_id'] = '';
        $data['assigned'] = '';
        $data['responsible'] = '';
        $data['assigned_name'] = '';
        $data['assigned_id'] = '';
        $data['telephone'] = '';
        $data['email_address'] = '';
        $data['support_subject'] = '';
        $data['support_type'] = '';
        $data['support_issue'] = '';
        $data['support_priority'] = '';
        $data['start_date'] = '';
        $data['completion_date'] = '';
        $data['support_description'] = '';
        $data['support_status'] = 'Submitted';
        $data['title'] = 'New Support-Request';

        $data['prioritylist'] = $this->support_model->get_statuses('Priority');
        $data['type'] = $this->support_model->get_statuses('Issue');
        $data['areas'] = $this->support_model->get_statuses('Type');
        $data['statuslist'] = $this->support_model->get_statuses('status');

        $data['companies'] = $this->Membership_model->get_companies();

        $this->load->vars($data);
        $data['main'] = '/support/main';
        $this->load->vars($data);
        $this->load->view($this->template);
    }

    function emailonscreen($support_id) {

        $data['supportRequest'] = $this->support_model->get_all_ticket_data($support_id);
        print_r($data['supportRequest']);
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
        $data['emailType'] = 'emails/newRequest';
        $data['title'] = "Support Request Ticket No. " . $support_id;
        $this->load->vars($data);
        $this->load->view('emails/emailTemplate');
    }

    /*
     *  Function for handling all emails.. Hopefully.
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

    function create_ticket() {
//validate form entry

        $this->form_validation->set_rules('support_subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required');

        $data['prioritylist'] = $this->support_model->get_statuses('Priority');
        $data['type'] = $this->support_model->get_statuses('Issue');
        $data['areas'] = $this->support_model->get_statuses('Type');
        $data['statuslist'] = $this->support_model->get_statuses('status');

        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');
        $data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);
        $data['closed_ticket_list'] = $this->support_model->list_closed_tickets($data['customercompany_id']);
        $data['companies'] = $this->Membership_model->get_companies();
        $data['items'] = $this->Membership_model->get_all_employees();
        $mobile = $this->input->post('mobile');
        $data['rowcount'] = 0;



        if ($data['ticket_list'] != NULL) {
            $data['rowcount'] = 0;
            foreach ($data['ticket_list'] as $countrow):
                $data['rowcount'] = $data['rowcount'] + 1;
            endforeach;
        }

        if ($data['closed_ticket_list'] != NULL) {
            $data['rowcount'] = 0;
            foreach ($data['closed_ticket_list'] as $countrow):
                $data['rowcount'] = $data['rowcount'] + 1;
            endforeach;
        }


//get details of company/channel partner
        $data['company_details'] = $this->Membership_model->get_company_detail($data['customercompany_id']);
        $initials = "JWS";
        foreach ($data['company_details'] as $row3):


            $contact_person = $this->input->post('assigned_id');
            if ($contact_person > 0) {
                //get assigned usename 
                $contact_person_data = $this->Membership_model->get_employee_detail($contact_person);
                foreach ($contact_person_data as $key => $row) :

                    $contact_person_name = $row['firstname'] . " " . $row['lastname'];

                endforeach;
            } else {

                $contact_person_name = '';
            }

            $responsible = $this->input->post('responsible');

            if ($responsible > 0) {
                //get resopnsible name 
                $responsible_data = $this->Membership_model->get_employee_detail($responsible);
                foreach ($responsible_data as $key => $row) :

                    $first_initial = substr($row['firstname'], 0, 1);
                    $last_initial = substr($row['lastname'], 0, 1);

                endforeach;
            } else {

                $first_initial = substr($this->session->userdata('firstname'), 0, 1);
                $last_initial = substr($this->session->userdata('lastname'), 0, 1);
            }
            $initials = "$first_initial" . "" . "$last_initial";

//quick fix for julian having 3 initials in webCRM
            if ($initials == "JS") {
                $initials = "JWS";
            }



            $company_id_agent = $row3['company_id'];
            $company_name = $row3['company_name'];
        endforeach;



        $submitted = $this->input->post('submit');
        if ($this->form_validation->run() == FALSE) {

            $owner = $this->input->post('company_owner');



            if ($owner != NULL) {
                $data['company_id'] = $this->input->post('company_owner');

                $data['owner_company_details'] = $this->Membership_model->get_company_detail($data['company_id']);
                foreach ($data['owner_company_details'] as $row4):
                    $company_name = $row4['company_name'];
                endforeach;
            } else {
                $data['company_id'] = $this->session->userdata('company_id');
            }

            $data['telephone'] = $this->input->post('telephone');
            $data['assigned'] = $this->input->post('assigned');
            $data['responsible'] = $this->input->post('responsible');
            $data['assigned_id'] = $this->input->post('assigned_id');
            $data['assigned_name'] = $this->input->post('assigned_name');
            $data['email_address'] = $this->input->post('email_address');
            $data['support_subject'] = $this->input->post('support_subject');
            $data['support_description'] = $this->input->post('support_description');
            $data['support_type'] = $this->input->post('support_type');
            $data['support_issue'] = $this->input->post('support_issue');
            $data['support_priority'] = $this->input->post('support_priority');
            $data['completion_date'] = $this->input->post('completion_date');
            $data['start_date'] = $this->input->post('start_date');
            $data['channel_partner_name'] = $company_name;
            $data['support_status'] = $this->input->post('support_status');

            $data['user_id'] = $this->input->post('user_id');
            $data['date_added'] = $this->input->post('date_added');
            $data['date_updated'] = $this->input->post('date_added');
            $data['ticket_id'] = '';
            $errors = validation_errors();



//determine if request comes from mobile site and redirect accordingly
            if ($mobile == 1) {
                $data['message'] = $errors;
                $data['main'] = '/support/mobile/add_request';
                $data['title'] = 'Support Requests';
                $this->load->vars($data);
                $this->load->view('mobile_template');
            } else if ($mobile == 0) {

                $data['main'] = '/support/main';
                $data['title'] = 'Support Request';
                $this->load->vars($data);
                $this->load->view($this->template);
            }
        } else {


            //get user that added it
            $customer['added_by_info'] = $this->Membership_model->get_employee_detail($this->input->post('user_id'));
            foreach ($customer['added_by_info'] as $key => $row) {
                $ticket_added_by = "" . $row['firstname'] . " " . $row['lastname'] . "";
                $data['added_by_company'] = $row['company_id'];
                $data['added_by_company_details'] = $this->Membership_model->get_company_detail($data['added_by_company']);
                foreach ($data['added_by_company_details'] as $row4):
                    $added_by_company_name = $row4['company_name'];
                endforeach;
            }


            $telephone = $this->input->post('telephone');
            $email_address = $this->input->post('email_address');
            $support_subject = $this->input->post('support_subject');


            $support_description = strip_tags($this->input->post('support_description'));


            $owner = $this->input->post('company_owner');
            if ($owner != NULL) {
                $company_id = $this->input->post('company_owner');

                $data['owner_company_details'] = $this->Membership_model->get_company_detail($company_id);
                foreach ($data['owner_company_details'] as $row4):
                    $company_name = $row4['company_name'];
                endforeach;
            } else {
                $company_id = $this->session->userdata('company_id');
            }



            $support_type = $this->input->post('support_type');
            $support_issue = $this->input->post('support_issue');
            $support_priority = $this->input->post('support_priority');
            $completion_date = $this->input->post('completion_date');

            $user_id = $this->input->post('user_id');
            $date_added = $this->input->post('date_added');
            $date_updated = $this->input->post('date_added');

//work out how many days till completion date
            $daystillcomplete = (strtotime($completion_date)) - (time());
            $daystillcomplete = ceil($daystillcomplete / 86400);

//human completion date
            if ($completion_date != NULL) {
                $humandate = new DateTime($completion_date);
                $humandate = date_format($humandate, 'D, d M Y');
            } else {
                $humandate = "N/A";
            }

//convert to text names
            $support_issue1 = $this->support_model->name_status('Issue', $support_issue);
            $support_priority1 = $this->support_model->name_status('priority', $support_priority);
            $support_type1 = $this->support_model->name_status('type', $support_type);



            if ($submitted == 'Submit') {
                $this->support_model->add_ticket();
                $ticket_id = mysql_insert_id();

//create a new bucket
                $subbucketname = "support_id" . $ticket_id;
                $bucketname = "lease-desk";
                if ($this->s3->putBucket($bucketname, S3::ACL_PUBLIC_READ)) {
//upload success
                } else {
//upload failed
                }


//retrieve uploaded file
                if (!empty($_FILES) && $_FILES['file']['error'] != 4) {

                    $fileName = $_FILES['file']['name'];
                    $tmpName = $_FILES['file']['tmp_name'];
                    $filelocation = $ticket_id . "/" . $fileName;

                    $thefile = file_get_contents($tmpName, true);

//print_r($_FILES['file']);
//move the file

                    if ($this->s3->putObject($thefile, "lease-desk", $filelocation, S3:: ACL_PUBLIC_READ)) {
//echo "We successfully uploaded your file.";
                        $this->session->set_flashdata('message', 'Ticket Added and file uploaded successfully');
                    } else {
//	echo "Something went wrong while uploading your file... sorry.";
                        $this->session->set_flashdata('message', 'Ticket Added, but your file did not upload');
                    }
                } else {

                    $this->session->set_flashdata('message', 'Ticket Added');
                }



//start normal support email
                $subject = "Support Request Ticket No. " . $ticket_id;
                $this->send_email($email_address, $ticket_id, $subject, 'emails/newRequest');

// $email1 = $this->email->print_debugger();
//end normal email
// send email to webCRM
                $webCRMyear = date('Y');
                $webCRMmonth = date('n');
                $webCRMday = date('j');
                $webCRMhour = date('G');
                $webCRMminute = date('i');
                $webCRMseconds = date('s');
                $webCRMGMT = str_replace(0, '', date('O'));
                $this->postmark->clear();

                $this->postmark->to('cm3208SPoYUg@b2b-email.net');
                $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');

                $this->postmark->cc('mat@redstudio.co.uk');






                $this->postmark->subject('/*/AUTO/*/');
                $this->postmark->message_plain("Start:DateTime
 
End
Start:Organisation
A:99:0
A:01:$company_name
End
Start:Person

End
Start:Activity
A:99:1
A:01:1
A:02:0
A:03:Support Request
A:04:$initials 
A:05:Support Request $ticket_id
A:07: $contact_person_name
A:30:$support_description
C:01:$support_type
C:08:$completion_date
C:03:$support_issue
C:05:$support_priority
C:07:$ticket_id
End
Start:OpportunityDelivery

End
				
				");
                $this->postmark->send();

//end mailto webCRM


                $data['title'] = 'Support Request';
                $data['main'] = '/prospect/main';
                $this->load->vars($data);
                $this->load->view($this->template);


                if ($mobile == 1) {
                    redirect("mobilesupport/view_support_request/$ticket_id", 'refresh');
                } else if ($mobile == 0) {
                    redirect("support/results/$ticket_id", 'refresh');
                }
            }
//This is if the support message is being updated


            if ($submitted == 'Update') {
                $data['ticket_id'] = $this->input->post('ticket_id');
                $ticket_id = $data['ticket_id'];

                $this->support_model->update_ticket($data['ticket_id']);

//create a new bucket
                $subbucketname = "support_id" . $ticket_id;
                $bucketname = "lease-desk";
                $this->s3->putBucket($bucketname, S3::ACL_PUBLIC_READ);


//retrieve uploaded file
                if (!empty($_FILES) && $_FILES['file']['error'] != 4) {

                    $fileName = $_FILES['file']['name'];
                    $tmpName = $_FILES['file']['tmp_name'];
                    $filelocation = $ticket_id . "/" . $fileName;

                    $thefile = file_get_contents($tmpName, true);

//print_r($_FILES['file']);
//move the file

                    if ($this->s3->putObject($thefile, "lease-desk", $filelocation, S3:: ACL_PUBLIC_READ)) {
//echo "We successfully uploaded your file.";

                        $message = 'Ticket Updated and file uploaded successfully';
                    } else {
//	echo "Something went wrong while uploading your file... sorry.";

                        $message = 'Ticket Updated, but your file did not upload';
                    }
                } else {


                    $message = 'Ticket Updated';
                }
if( $this->input->post('support_status') == '3' ) {
    $message = $message.".  Please ensure the Version control document is updated with dev additions";
}

                $this->session->set_flashdata('message', $message);




// normal email update if email checkbox is checked


                if ($this->input->post('email_changes') == TRUE) {
                    $this->postmark->clear();

                    //start normal update support email
                    $subject = "Support Request Ticket No. " . $ticket_id . " UPDATED";
                    $this->send_email($email_address, $ticket_id, $subject, 'emails/updateTicket');




// end normal email update
// send email to webCRM for update

                    $this->postmark->to('cm3208SPoYUg@b2b-email.net');
                    $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');
                    $this->postmark->cc('mat@redstudio.co.uk');


                    $this->postmark->subject('/*/AUTO/*/');
                    $this->postmark->message_plain("Start:DateTime

End
Start:Organisation
A:99:0
A:01:$company_name
End
Start:Person

End

Start:Activity
A:99:2
A:01:1
A:02:1                            
A:03:Support Request
A:04:CW
A:05:Support Request $ticket_id
A:30:$support_description
C:01:$support_type
C:02:$completion_date
C:03:$support_issue
C:05:$support_priority
C:07:$ticket_id

End

Start:OpportunityDelivery

End				
		
   
                            
                            ");
// $this->postmark->send();
//end mailto webCRM for update
                }




                if ($mobile == 1) {
                    redirect("mobilesupport/view_support_request/$ticket_id", 'refresh');
                } else if ($mobile == 0) {
                    redirect("support/results/$ticket_id", 'refresh');
                }
            }
            if ($submitted == 'Reset') {
                redirect('support', 'refresh');
            }
        }
    }

    function delete_ticket() {

        $data['ticket_id'] = $this->uri->segment(3);
        $is_logged_in = $this->session->userdata('is_logged_in');
        $role = $this->session->userdata('role');
        if (!isset($is_logged_in) || $role != 1) {
            $this->session->set_flashdata('message', 'You do not have permission to delete');
            redirect('/support/results/' . $data['ticket_id'] . '', 'refresh');
        } else {
            $this->support_model->delete_ticket($data['ticket_id']);
            $this->session->set_flashdata('message', 'Ticket Deleted');
            redirect('support', 'refresh');
        }
    }

    /**
     * 
     */
    function results() {
        $data['ticket_id'] = $this->uri->segment(3);
        $data['ticket_data'] = $this->support_model->get_ticket($data['ticket_id']);

        $data['prioritylist'] = $this->support_model->get_statuses('Priority');
        $data['type'] = $this->support_model->get_statuses('Issue');
        $data['areas'] = $this->support_model->get_statuses('Type');
        $data['statuslist'] = $this->support_model->get_statuses('status');

        $data['companies'] = $this->Membership_model->get_companies();
        $data['responsibleusers'] = $this->Membership_model->get_employees('2');
        //if admin get all employees, if not just get from user company
        if ($this->session->userdata('role') < 3) {
            $data['items'] = $this->Membership_model->get_all_employees();
        } else {

            $owner_company_id = $this->session->userdata('company_id');
            $data['items'] = $this->Membership_model->get_employees($owner_company_id);
        }


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


//convert channel partner id into the name
        $data['channel_detail'] = $this->Membership_model->get_company_detail($data['company_id']);
        foreach ($data['channel_detail'] as $row):
            $data['channel_partner_name'] = $row['company_name'];
        endforeach;

//end of conversion
//List File attachments
        $bucketname = "lease-desk";
        $data['mainbucket'] = "lease-desk";
        $data['bucket_name'] = $data['ticket_id'];
        $data['bucket_contents'] = $this->s3->getBucket($bucketname);





        $data['customeruser_id'] = $this->session->userdata('user_id');
        $data['customercompany_id'] = $this->session->userdata('company_id');
        $data['ticket_list'] = $this->support_model->list_tickets($data['customercompany_id']);
        $data['closed_ticket_list'] = $this->support_model->list_closed_tickets($data['customercompany_id']);
        $data['rowcount'] = 0;

        if ($data['ticket_list'] != NULL) {
            foreach ($data['ticket_list'] as $countrow):
                $data['rowcount'] = $data['rowcount'] + 1;

                $support_statusx = $countrow['support_status'];
                $support_idx = $countrow['support_id'];
                if ($support_statusx == 3) {
//convert priority to closed
                    $this->support_model->close_priority($support_idx);
                }
            endforeach;
        }

        if ($data['closed_ticket_list'] != NULL) {
            foreach ($data['closed_ticket_list'] as $countrow):
                $data['rowcount'] = $data['rowcount'] + 1;

                $support_statusx = $countrow['support_status'];
                $support_idx = $countrow['support_id'];
                if ($support_statusx == 3) {
//convert priority to closed
                    $this->support_model->close_priority($support_idx);
                }
            endforeach;
        }

//fetch comments
        $data['comments'] = $this->support_model->list_replies($data['ticket_id']);

        $data['title'] = 'Support Request';
        $this->load->vars($data);
        $data['main'] = '/support/results';
        $this->load->vars($data);
        $this->load->view($this->template);
    }

    /**
     * 
     */
    function delete_file() {

        $bucket = "lease-desk";
        $folder = $this->input->post('folder');
        $file = $this->input->post('filename');
        $this->s3->deleteObject($bucket, $folder . "/" . $file);

//echo "$bucket $folder $file";

        redirect($this->agent->referrer());
    }

    function reply($id) {
        $data['ticket_id'] = $id;
        $this->load->vars($data);
        $this->load->view('/support/reply_ajax');
    }

    function add_reply($id) {

        if ($this->input->post('comment')) {

            $reply_id = $this->support_model->add_reply($id);
            $this->session->set_flashdata('message', 'Reply added');


// send email to webCRM and certain admins
//get other support data
            $data['ticket_details'] = $this->support_model->get_ticket($id);
            foreach ($data['ticket_details'] as $row5):

                $support_type = $row5['support_type'];
                $support_issue = $row5['support_issue'];
                $support_priority = $row5['support_priority'];
                $email_address = $row5['email_address'];
                $company_id = $row5['company_id'];
                $user_id = $row5['user_id'];
                $support_subject = $row5['support_subject'];
            endforeach;

//get company detail
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

//convert to text names
            $support_issue1 = $this->support_model->name_status('Issue', $support_issue);
            $support_priority1 = $this->support_model->name_status('priority', $support_priority);
            $support_type1 = $this->support_model->name_status('type', $support_type);





            $comment = strip_tags($this->input->post('comment'));
//start normal email
            if ($this->input->post('email_changes') == TRUE) {

                $subject = 'Reply to Support Request Ticket No ' . $id;
                $this->send_email($email_address, $reply_id, $subject, $type = 'emails/newReply', $support = 'reply');
            }

//start webcrm email		

            $this->postmark->clear();

            $this->postmark->to('cm3208SPoYUg@b2b-email.net');
            $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');
            $this->postmark->cc('mat@redstudio.co.uk');


            $this->postmark->subject('/*/AUTO/*/');
            $this->postmark->message_plain("Start:DateTime

End
Start:Organisation
A:99:0
A:01:$company_name
End
Start:Person

End
Start:Activity
A:99:0
A:01:0
A:03:Support Request
A:04:CW
A:05:Note on Request $id
A:30:$comment
C:01:$support_type
C:03:$support_issue
C:05:$support_priority

End
Start:OpportunityDelivery

End
				
				");


//   $this->postmark->send();
//end mailto webCRM
            redirect('support/results/' . $id . '', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Nothing Entered');
            redirect('support/results/' . $id . '', 'refresh');
        }
    }

    function edit_reply($id) {
        $submitted = $this->input->post('submit');
        if ($submitted == 'Edit Note') {
            if ($this->input->post('comment')) {
                $this->support_model->edit_reply($id);
                $this->session->set_flashdata('message', 'Reply Changed');
//redirect('support/results/'.$id.'', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Nothing Changed');
//redirect('support/results/'.$id.'', 'refresh');
            }
        }
        if ($submitted == 'Delete') {
            if ($this->input->post('comment')) {
                $this->support_model->delete_reply($id);
                $this->session->set_flashdata('message', 'Reply Deleted');
//redirect('support/results/'.$id.'', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Nothing Deleted');
//redirect('support/results/'.$id.'', 'refresh');
            }
        }
        redirect('support/results/' . $id . '', 'refresh');
    }

    function edit_note() {
        $id = $this->input->post('noteid');
        $supportid = $this->input->post('supportID');
        $comment = strip_tags($this->input->post('notecomment'));
        $checkbox = $this->input->post('checkbox');

//set email address, company name support subject, support ticket id


        if ($this->support_model->update_note($id, $comment)) {

            if ($checkbox) {

//get other support data
                $data['ticket_details'] = $this->support_model->get_ticket($supportid);
                foreach ($data['ticket_details'] as $row5):

                    $support_type = $row5['support_type'];
                    $support_issue = $row5['support_issue'];
                    $support_priority = $row5['support_priority'];
                    $email_address = $row5['email_address'];
                    $company_id = $row5['company_id'];
                    $user_id = $row5['user_id'];
                    $support_subject = $row5['support_subject'];
                endforeach;
//get company name from company id
                $data['company_details'] = $this->Membership_model->get_company_detail($company_id);
                foreach ($data['company_details'] as $row3):

                    $company_id_agent = $row3['company_id'];
                    $company_name = $row3['company_name'];

                endforeach;
//start normal email


                $subject = 'Note updated on Support Request Ticket No ' . $supportid;
                $this->send_email($email_address, $id, $subject, $type = 'emails/editReply', $support = 'reply');




                echo "Email Sent $supportid";
            } else {

                echo "Note Updated";
            }
        } else {
            echo "Error updating note. Please contact technical support";
        }

        return;
    }

    function delete_note() {
        $id = $this->input->post('noteid');
        if ($this->support_model->delete_note($id)) {
            echo $id . " deleted";
        } else {
            echo "Error deleting note. Please contact technical support";
        }

        return;
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