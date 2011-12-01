<?php

class Edit extends My_Controller {

    function Edit() {
        parent::Controller();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('membership_model');
        $this->is_logged_in();
    }

    function index() {
        redirect('admin/view_companies', 'refresh');
    }

    function edit_user() {

        //need to work out how to get the user id to here, i used 7 as a test
        $data['user_id'] = $this->input->post('id');
        $data['field'] = $this->input->post('elementid');
        $data['value'] = $this->input->post('value');
        $this->Membership_model->edit_user($data['user_id'], $data['field'], $data['value']);


        $update = $this->input->post('value');
        $this->output->set_output($update);
    }

    function edit_password() {
        $userid = $this->input->post('user_id');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $errors = validation_errors();
                $this->session->set_flashdata('message', $errors);
                redirect("profile/view_user/$userid", 'refresh');
            } else {

                $this->Membership_model->update_password($userid);

                //send an email to the user
                //first obtain their email address
                if (SITE == "customer") {
                    $site = "Customer-Resource";
                    $weburl = "www.customer-resource.com";
                } else if (SITE == "channel") {
                    $site = "Channel-Resource";
                    $weburl = "www.channel-resource.com";
                }
                $userdata = $this->membership_model->get_employee_detail($userid);

                foreach ($userdata as $row):
                    $email_address = $row['email_address'];
                    $fullname = $row['firstname'] . " " . $row['lastname'];
                    $name = $row['firstname'];
                    $username = $row['username'];
                    $password = $this->input->post('password');
                endforeach;

                //send to user
                $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');
                $this->postmark->to($email_address);
                //$this->postmark->to('mat@redstudio.co.uk');
                //$this->postmark->cc($email_address);

                $this->postmark->subject("$site - Your Login Information");
                $this->postmark->message_html("Dear $name,<br/><br/>
                                                

This is your customer login for $site. Now you can access $site instantly online via your desktop or via the mobile web app.      <br/><br/>                                          
<strong>Username</strong>: $username<br/>
<strong>Password</strong>: $password<br/>
<strong>$site Address</strong>: $weburl    <br/>
        <br/><br/>                
Customer Resource provides you with access to our quoting tool which allows you to calculate payments for customers with
transparency of true cost of funds together with the ability to remove complexity in calculating cost per user pricing.  In addition, 
Customer Resource provides you with video tutorials on how to use all areas of Lease-Desk.com. You will also find video tutorials
on how to use Customer Resource from within the homepage.<br/><br/>
 
If you require any further assistance or have any additional questions please contact us at <a href='mailto:info@lease-desk.com'>info@lease-desk.com</a>
				
					");
                $this->postmark->send();
                $this->postmark->clear();


                //send to admin
                $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');
                $this->postmark->to('chloe.maxwell@lease-desk.com');
                $this->postmark->cc('mat@redstudio.co.uk');
                //$this->postmark->cc($email_address);

                $this->postmark->subject("$site Password changed");
                $this->postmark->message_plain("Hello Admin, 
                                                
$fullname has updated their login details for $site as per below,
                                                
username: $username
password: ***********
				
					");
                $this->postmark->send();
                $this->postmark->clear();


                $this->session->set_flashdata('message', 'Password Changed');

                redirect("profile/view_user/$userid", 'refresh');
            }
        }
        else {
            $this->session->set_flashdata('message', 'You must enter a password');
            redirect("profile/view_user/$userid", 'refresh');
        }
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $role = $this->session->userdata('role');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            $this->session->set_flashdata('message', 'You do not have permission to do that');
            redirect('welcome', 'refresh');
        }
    }

}