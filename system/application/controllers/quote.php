<?php

class Quote extends My_Controller {

    function __construct() {
        parent::__construct();

        $this->is_logged_in();
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('quote_model');
        $this->load->model('membership_model');
        $this->load->plugin('to_pdf');
    }

    function index() {
        redirect('admin/view_companies', 'refresh');
    }

    function main() {
        $data['quoteuser_id'] = $this->session->userdata('user_id');
        $data['quotecompany_id'] = $this->session->userdata('company_id');
        $segment_active = $this->uri->segment(3);
        if ($segment_active != NULL) {

            $config['base_url'] = base_url() . 'quote/results/' . $this->uri->segment(3);
        } else if ($segment_active == NULL) {

            $config['base_url'] = base_url() . 'quote/results/0/';
        }

        $config['total_rows'] = $this->db->count_all('quote');
        $config['per_page'] = '8';
        $config['full_tag_open'] = '<div align="center"><p>';
        $config['full_tag_close'] = '</div></p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $data['page_segment'] = $this->uri->segment(4);


        $data['quote_list'] = $this->quote_model->list_entries_by_user();
        $data['rowcount'] = 0;
        foreach ($data['quote_list'] as $countrow):
            $data['rowcount'] = $data['rowcount'] + 1;
        endforeach;


        //get user data and set defaults
        $userdata = $this->membership_model->get_employee_detail($data['quoteuser_id']);
        foreach ($userdata as $row):
            if ($row['user_currency'] == NULL) {
                $currency = '&pound;';
            } else {
                $currency = $row['user_currency'];
            }

            if ($row['user_interestrate'] == NULL) {
                $interestrate = '';
            } else {
                $interestrate = $row['user_interestrate'];
            }


            if ($row['user_initial'] == NULL) {
                $initial = '';
            } else {
                $initial = $row['user_initial'];
            }

            if ($row['user_regular'] == NULL) {
                $regular = '';
            } else {
                $regular = $row['user_regular'];
            }

        endforeach;

        $data['quote_ref'] = '';
        $data['assigned'] = '';
        $data['assigned_name'] = '';
        $data['assigned_id'] = '';
        $data['capital'] = '';
        $data['capital_type'] = '';
        $data['amount_type'] = '';
        $data['interest_type'] = '';
        $data['calculate_by'] = $interestrate;
        $data['interest_rate'] = '';
        $data['rate_per_1000'] = '';
        $data['periodic_payment'] = '';
        $data['payment_type'] = '';
        $data['payment_frequency'] = '';
        $data['initial'] = $initial;
        $data['regular'] = $regular;
        $data['number_of_ports'] = '';
        $data['annual_support_costs'] = '';
        $data['other_monthly_costs'] = '';
        $data['user_id'] = '';
        $data['currency'] = $currency;
        $data['items'] = $this->Membership_model->get_all_employees();
        $data['main'] = '/quote/main';
        $data['title'] = 'Quoting Tool';
        
         $data['desktop'] = 'quote';
        $this->load->vars($data);
        $this->load->view('leasedesktemplate');
    }

    function results() {
        $data['quoteuser_id'] = $this->session->userdata('user_id');
        $data['quotecompany_id'] = $this->session->userdata('company_id');
        $data['items'] = $this->Membership_model->get_all_employees();
        $segment_active = $this->uri->segment(3);
        if ($segment_active != NULL) {

            $config['base_url'] = base_url() . 'quote/results/' . $this->uri->segment(3);
        } else if ($segment_active == NULL) {

            $config['base_url'] = base_url() . 'quote/results/0/';
            $data['customer_id'] = '';
            $data['customer_name'] = '';
        }

        $config['total_rows'] = $this->db->count_all('quote');
        $config['per_page'] = '8';
        $config['full_tag_open'] = '<div align="center"><p>';
        $config['full_tag_close'] = '</div></p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $data['page_segment'] = $this->uri->segment(4);
        //$data['quote_list'] = $this->quote_model->list_entries($data['quotecompany_id'], $config['per_page'],$data['page_segment']);
        $data['quote_list'] = $this->quote_model->list_entries_by_user();
        $data['rowcount'] = 0;
        foreach ($data['quote_list'] as $countrow):
            $data['rowcount'] = $data['rowcount'] + 1;
        endforeach;

        //validate the calculator entries
        $this->form_validation->set_rules('quote_ref', 'quote reference', 'trim|required');
        $this->form_validation->set_rules('amount_type', 'capital type', 'trim|required');
        $this->form_validation->set_rules('calculate_by', 'calculate by', 'trim|required');
        $this->form_validation->set_rules('payment_type', 'payment type', 'trim|integer|required');
        $this->form_validation->set_rules('payment_frequency', 'payment_frequency', 'trim|integer|required');
        $this->form_validation->set_rules('initial', 'initial', 'trim|integer|required');
        $this->form_validation->set_rules('regular', 'regular', 'trim|integer|required|is_natural_no_zero');



        $data['quote_ref'] = $this->input->post('quote_ref');
        $data['assigned'] = $this->input->post('assigned');
        $data['assigned_id'] = $this->input->post('assigned_id');
        $data['assigned_name'] = $this->input->post('assigned_name');
        $data['capital'] = $this->input->post('capital');
        $data['capital_type'] = $this->input->post('capital_type');
        $data['amount_type'] = $this->input->post('amount_type');
        $data['interest_type'] = $this->input->post('interest_type');
        $data['calculate_by'] = $this->input->post('calculate_by');
        $data['payment_type'] = $this->input->post('payment_type');
        $data['payment_frequency'] = $this->input->post('payment_frequency');
        $data['initial'] = $this->input->post('initial');
        $data['regular'] = $this->input->post('regular');
        $data['number_of_ports'] = $this->input->post('number_of_ports');
        $data['annual_support_costs'] = $this->input->post('annual_support_costs');
        $data['other_monthly_costs'] = $this->input->post('other_monthly_costs');
        $data['date_added'] = $this->input->post('date_added');
        $data['user_id'] = $this->input->post('user_id');
        $data['currency'] = $this->input->post('currency');



        $submitted = $this->input->post('submit');

        $segment_active = $this->uri->segment(3);

        if ($segment_active > 0) {
            $data['quote_id'] = $this->uri->segment(3);
            $quote_id = $data['quote_id'];


            $data2['quote_numbers'] = $this->quote_model->get_data("$quote_id");
            $this->load->vars($data2);

            foreach ($data2['quote_numbers'] as $key => $row) {


                $data['quote_id'] = $row['quote_id'];
                $data['assigned'] = $row['assigned'];
                $data['quote_ref'] = $row['quote_ref'];
                $data['capital_type'] = $row['capital_type'];
                $data['amount_type'] = $row['amount_type'];
                $data['interest_type'] = $row['interest_type'];
                $data['capital'] = $row['capital'];
                $data['interest_rate'] = $row['interest_rate'];
                $data['rate_per_1000'] = $row['rate_per_1000'];
                $data['periodic_payment'] = $row['periodic_payment'];
                $data['payment_type'] = $row['payment_type'];
                $data['payment_frequency'] = $row['payment_frequency'];
                $data['initial'] = $row['initial'];
                $data['regular'] = $row['regular'];
                $data['calculate_by'] = $row['calculate_by'];
                $data['number_of_ports'] = $row['number_of_ports'];
                $data['annual_support_costs'] = $row['annual_support_costs'];
                $data['other_monthly_costs'] = $row['other_monthly_costs'];
                $data['currency'] = $row['currency'];
                $data['user_id'] = $row['user_id'];
                $data['company_id'] = $row['company_id'];
                $data['date_added'] = $row['date_added'];


                $run = 'yes';
            }
        } else {
            if ($this->form_validation->run() == FALSE) {
                $errors = validation_errors();
                $data['main'] = '/quote/main';
                $data['title'] = 'Quoting tool';
                $this->load->vars($data);
                $this->load->view('leasedesktemplate');
                $run = 'no';
            } else {

                $run = 'yes';
            }
        }



        $this->load->model('membership_model');

        //Turn the assigned user id into the full name then get the company details
        if ($data['assigned'] != 0 && $data['assigned'] != NULL) {

            $customer['assigned_info'] = $this->membership_model->get_employee_detail($data['assigned']);
            foreach ($customer['assigned_info'] as $key => $row) {
                $data['assigned_name'] = "" . $row['firstname'] . " " . $row['lastname'] . "";
                $data['assigned_company'] = $row['company_id'];
                $data['assigned_email'] = $row['email_address'];
                $data['assigned_email_2'] = $row['email_address'];
            }
        } else {

            $customer['assigned_info'] = $this->membership_model->get_employee_detail($data['user_id']);
            foreach ($customer['assigned_info'] as $key => $row) {
                $data['assigned_name'] = "" . $row['firstname'] . " " . $row['lastname'] . "";
                $data['assigned_company'] = $row['company_id'];
                $data['assigned_email'] = $row['email_address'];
                $data['assigned_email_2'] = "no";
            }
        }

        if (isset($data['assigned_company'])) {
            $customer['assigned_company_details'] = $this->membership_model->get_company_detail($data['assigned_company']);
            foreach ($customer['assigned_company_details'] as $key => $row) {

                $data['assigned_company_name'] = $row['company_name'];
            }
        }

        if ($run == 'yes') {

            //CALCULATION STARTS HERE
            $this->load->library('calculator');
            $data['quote_results'] = $this->calculator->quote($data['capital_type'], $data['amount_type'], $data['interest_type'], $data['calculate_by'], $data['payment_type'], $data['payment_frequency'], $data['initial'], $data['regular'], $data['number_of_ports'], $data['annual_support_costs'], $data['other_monthly_costs']);
            //CALCULATION ENDS HERE


            if ($submitted == 'Submit') {
                $this->quote_model->add_data();
                $data['quote_id'] = mysql_insert_id();
                $this->session->set_flashdata('message', "Calculation Added");
                redirect('quote/results/' . $data['quote_id'] . '', 'refresh');
            }



            if ($submitted == 'Update') {
                $data['quote_id'] = $this->input->post('quote_id');
                $this->quote_model->update_data($data['quote_id']);
                $this->session->set_flashdata('message', "Calculation Updated");
                redirect('quote/results/' . $data['quote_id'] . '', 'refresh');
            }
            if ($submitted == 'Reset') {
                redirect('quote/main', 'refresh');
            }





            $data['main'] = 'quote/results';
            $data['title'] = 'Quote Results';

            //get added by from user ID
            $data['employee_detail'] = $this->membership_model->get_employee_detail($data['user_id']);

            foreach ($data['employee_detail'] as $key => $row):

                $data['quote_added_by'] = $row['firstname'] . " " . $row['lastname'];
            endforeach;

//Save a pdf to the users computer
            if ($this->uri->segment(4) == "pdf") {



                $data['quote_id'] = $this->uri->segment(3);
                $this->load->vars($data);
                $this->load->helper('file');
                $html = $this->load->view('pdf_template', $data, true);
                pdf_create($html, 'Quote_' . $data['quote_id'] . '');


                //send an email to assigned user    
            } else if ($this->uri->segment(4) == "email") {



//first create pdf
                $data['quote_id'] = $this->uri->segment(3);

                $this->load->vars($data);
                $this->load->helper('file');
                $stream = FALSE;
                $html = $this->load->view('pdf_template', $data, true);
                $data1 = pdf_create($html, 'Quote_' . $data['quote_id'], $stream);

                write_file('./images/quotes/Quote_' . $data['quote_id'] . '.pdf', $data1);



// now send the email
                $email_address = $this->input->post('email');
                $emessage = $this->input->post('emessage');
                $this->load->library('postmark');

//check if email address matches that of the assigned user of the quote
                if ($email_address == $data['assigned_email_2']) {
                    $extraMessage = "<br/>View your quote online <a href='".base_url()."quote/results/" . $data['quote_id'] . "'>here</a> ";
                } else {
                    $extraMessage = "";
                }
//get email values
                $config_email = $this->config_email;
                $config_company_name = $this->config_company_name;

//prepare email for sending
                $this->postmark->from('noreply@lease-desk.com', 'Lease-Desk.com');
                $this->postmark->to($email_address);
                $this->postmark->cc($config_email);
                $this->postmark->subject('Lease-Desk Quotation');

//send email
//email content
                $this->postmark->message_html("Attached is your quote from Lease-Desk.<br/>
				$extraMessage
                        <br/><br/>
                          $emessage
					");
//end of email content

                $this->postmark->attach('./images/quotes/Quote_' . $data['quote_id'] . '.pdf');


                $this->postmark->send();

                $this->postmark->clear();
                delete_files('./images/quotes/');
                write_file('./images/quotes/index.html', '<html></html>');

                $mobile = $this->input->post('mobile');


                if ($mobile == 1) {
                    $this->session->set_flashdata('message', 'Quote Emailed');
                    redirect('mobile/view_quote_results/' . $data['quote_id'], 'refresh');
                }

                echo "Email Sent to " . $email_address;

                return;
            } else {
                
                $data['desktop'] = 'quote';
                $this->load->vars($data);
                $this->load->view('leasedesktemplate');
            }
        }
    }

    function delete_quote() {
        $data['quote_id'] = $this->uri->segment(3);
        $this->quote_model->delete_quote($data['quote_id']);
        $this->session->set_flashdata('message', 'Quote Deleted');
        redirect('quote/main', 'refresh');
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            $this->session->set_flashdata('message', 'You are not logged in');
            $this->session->set_flashdata('url', current_url());
            redirect('user/login');
        }
    }

}
