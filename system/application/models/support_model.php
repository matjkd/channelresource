<?php

class Support_model extends Model {

    function __construct() {
        parent::__construct();
    }

    function add_ticket() {
        $this->db->select('company_id');
        $this->db->where('user_id', $this->input->post('user_id'));
        $query = $this->db->get('users');

        $owner = $this->input->post('company_owner');

        if ($owner != NULL) {
            $company_owner = $this->input->post('company_owner');
        } else {
            $company_owner = $this->session->userdata('company_id');
        }


        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row):




                $new_ticket_insert_data = array(
                    'telephone' => $this->input->post('telephone'),
                    'email_address' => $this->input->post('email_address'),
                    'support_subject' => $this->input->post('support_subject'),
                    'support_description' => $this->input->post('support_description'),
                    'support_type' => $this->input->post('support_type'),
                    'support_issue' => $this->input->post('support_issue'),
                    'support_priority' => $this->input->post('support_priority'),
                    'assigned_to' => $this->input->post('assigned_id'),
                    'completion_date' => $this->input->post('completion_date'),
                    'support_status' => 1,
                    'company_id' => $company_owner,
                    'user_id' => $this->input->post('user_id'),
                    'responsible' => $this->input->post('responsible'),
                    'date_added' => $this->input->post('date_added'),
                    'date_updated' => $this->input->post('date_added')
                );
            endforeach;
        }
        $insert = $this->db->insert('support', $new_ticket_insert_data);
        return $insert;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function update_ticket($id) {


        $this->db->where('support_id', $id);
        $Q = $this->db->get('support');
        foreach ($Q->result_array() as $row):
            $date_opened = $row['date_opened'];
        endforeach;

        $this->db->flush_cache();


        $this->db->select('company_id');
        $this->db->where('user_id', $this->input->post('user_id'));
        $query = $this->db->get('users');

        //if support status is closed  set closed date
        if ($this->input->post('support_status') == 3) {

            $closeddate = $this->input->post('date_added');
        } else {
            $closeddate = NULL;
        }

        //set assigned date unless it has been assigned already
        if ($this->input->post('support_status') == 2 && !isset($date_opened)) {

            $openeddate = $this->input->post('date_added');
        } else {
            $openeddate = $date_opened;
        }

        //set completion date if it isn't set
        if ($this->input->post('completion_date') == "0000-00-00" || $this->input->post('completion_date') == "") {
            $completion_date = "";
        } else {
            $completion_date = $this->input->post('completion_date');
        }

        $owner = $this->input->post('company_owner');
        if ($owner != NULL) {
            $company_owner = $this->input->post('company_owner');
        } else {
            $company_owner = $this->session->userdata('company_id');
        }
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row):


                $support_update_data = array(
                    'telephone' => $this->input->post('telephone'),
                    'email_address' => $this->input->post('email_address'),
                    'support_description' => $this->input->post('support_description'),
                    'support_type' => $this->input->post('support_type'),
                    'support_issue' => $this->input->post('support_issue'),
                    'support_priority' => $this->input->post('support_priority'),
                    'completion_date' => $completion_date,
                    'support_status' => $this->input->post('support_status'),
                    'assigned_to' => $this->input->post('assigned_id'),
                    'support_subject' => $this->input->post('support_subject'),
                    'company_id' => $company_owner,
                    'responsible' => $this->input->post('responsible'),
                    'date_closed' => $closeddate,
                    'date_opened' => $openeddate,
                    'date_updated' => $this->input->post('date_added')
                );
            endforeach;
        }
        $this->db->where('support_id', $id);
        $update = $this->db->update('support', $support_update_data);
        return $update;
    }

    /**
     *
     * @param type $id
     * @param type $comment
     * @return type 
     */
    function update_note($id, $comment) {

        $support_update_data = array(
            'comment' => $comment,
        );
        $this->db->where('comments_id', $id);
        $update = $this->db->update('support_comments', $support_update_data);
        return $update;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function delete_note($id) {


        $this->db->where('comments_id', $id);
        $update = $this->db->delete('support_comments');
        return $update;
    }

    /**
     *
     * @param type $id
     * @return string 
     */
    function list_tickets($id) {
        $data = array();

        $company = $this->session->userdata('company_id');
        $user = $this->session->userdata('user_id');

        $this->db->order_by('support_priority', 'asc');
        $this->db->having('support_status !=', 3);
        if (!isset($company) || $company > 2) {
            $this->db->where('support.company_id', $id);
            $this->db->or_where('support.assigned_to', $user);
            $this->db->join('users', 'users.user_id=support.user_id', 'right');
            $this->db->join('company', 'company.company_id=support.company_id', 'left');
        } else if (!isset($company) || $company < 3) {
            $this->db->join('users', 'users.user_id=support.user_id');
            $this->db->join('company', 'company.company_id=support.company_id', 'left');
        }
        $Q = $this->db->get('support');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row):

                $results[] = $row;


            endforeach;
        }
        else {
            $results = NULL;
        }
        $Q->free_result();


        return $results;
    }

    /**
     *
     * @param type $id
     * @return string 
     */
    function list_closed_tickets($id) {
        $data = array();

        $company = $this->session->userdata('company_id');
        $user = $this->session->userdata('user_id');

        $this->db->order_by('support_priority', 'asc');

        if (!isset($company) || $company > 2) {
            $this->db->where('support.company_id', $id);
            $this->db->or_where('support.assigned_to', $user);
            $this->db->having('support_status', 3);
            $this->db->join('users', 'users.user_id=support.user_id', 'right');
            $this->db->join('company', 'company.company_id=support.company_id', 'left');
        } else if (!isset($company) || $company < 3) {
            $this->db->where('support_status', 3);
            $this->db->join('users', 'users.user_id=support.user_id');
            $this->db->join('company', 'company.company_id=support.company_id', 'left');
        }
        $Q = $this->db->get('support');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row):

                $results[] = $row;


            endforeach;
        }
        else {
            $results = NULL;
        }
        $Q->free_result();


        return $results;
    }

    /**
     * Auto make priority closed if  ticket is closed. 
     * @param type $id 
     */
    function close_priority($id) {

        $close_priority = array(
            'support_priority' => '99'
        );
        $this->db->where('support_id', $id);
        $update = $this->db->update('support', $close_priority);
        return $update;
    }

    function get_ticket($id) {
        $data = array();
        $this->db->where('support_id', $id);
        $query = $this->db->get('support');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_all_ticket_data($id) {

        $data = array();
        $this->db->where('support_id', $id);

        //get company name
        $this->db->join('company', 'company.company_id = support.company_id', 'left');

        //get assigned to
        $this->db->join('users as assigned', 'assigned.user_id = support.assigned_to', 'left');

        //get responsible
        $this->db->join('users as responsible', 'responsible.user_id = support.responsible', 'left');

        //get contact person
        $this->db->join('users as contactPerson', 'contactPerson.user_id = support.contact_person', 'left');

        //get user id
        $this->db->join('users as userID', 'userID.user_id = support.user_id', 'left');

        $this->db->select('assigned.user_id as assignedID, assigned.firstname as assignedfirstname, assigned.lastname as assignedlastname');
        $this->db->select('responsible.user_id as responsibleuserID, responsible.firstname as responsiblefirstname, responsible.lastname as responsiblelastname');
        $this->db->select('contactPerson.user_id as contactID, contactPerson.firstname as contactfirstname, contactPerson.lastname as contactlastname');
        $this->db->select('userID.user_id as userID, userID.firstname as userfirstname, userID.lastname as userlastname');
        $this->db->select('company.company_name');
        $this->db->select('support.support_id, support.telephone, support.email_address, support.support_subject, support.support_description, support.date_added, support.date_updated');
        $this->db->select('support.support_priority, support.support_issue, support.support_type,   support.completion_date, support.date_closed');

        $query = $this->db->get('support');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_customer($id) {
        $data = array();
        $this->db->where('customer_id', $id);
        $query = $this->db->get('customers');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function add_reply($id) {
        $now = unix_to_human(now(), TRUE, 'eu');
        $new_reply_insert_data = array(
            'support_id' => $id,
            'comment' => $this->input->post('comment'),
            'added_by' => $this->session->userdata('user_id'),
            'date_added' => $now,
            'date_updated' => $now
        );
        $update_date = array(
            'date_updated' => $now
        );

        $insert = $this->db->insert('support_comments', $new_reply_insert_data);
        $this->db->where('support_id', $id);
        $this->db->update('support', $update_date);
        return $insert;
    }

    function list_replies($id) {
        $comments = array();

        $company = $this->session->userdata('company_id');
        //$this->db->order_by('roi.roi_ref');

        $this->db->where('support_id', $id);
        $this->db->join('users', 'users.user_id=support_comments.added_by', 'right');


        $Q = $this->db->get('support_comments');



        foreach ($Q->result_array() as $row):

            $comments[] = $row;

        endforeach;




        $Q->free_result();
        return $comments;
    }

    /**
     *
     * @param type $type
     * @param type $value 
     */
    function name_status($type, $value) {


        $this->db->limit(1);
        $this->db->where('status_type', $type);
        $this->db->where('status_value', $value);
        $query = $this->db->get('support_status');
        return $query->row('status_name');
    }

    function get_statuses($type) {

        $this->db->where('status_type', $type);
        $this->db->order_by('status_id');
        $query = $this->db->get('support_status');


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function edit_reply($id) {
        $now = unix_to_human(now(), TRUE, 'eu');
        $comments_id = $this->input->post('comments_id');
        $new_reply_update_data = array(
            'support_id' => $id,
            'comment' => $this->input->post('comment'),
            'added_by' => $this->session->userdata('user_id'),
            'date_added' => $now,
            'date_updated' => $now
        );
        $update_date = array(
            'date_updated' => $now
        );
        $this->db->where('comments_id', $comments_id);
        $update = $this->db->update('support_comments', $new_reply_update_data);

        $this->db->where('support_id', $id);
        $update = $this->db->update('support', $update_date);


        return $update;
    }

    function delete_reply($id) {

        $comments_id = $this->input->post('comments_id');


        $this->db->where('comments_id', $comments_id);
        $insert = $this->db->delete('support_comments');

        return $insert;
    }

    function delete_ticket($id) {

        $is_logged_in = $this->session->userdata('is_logged_in');
        $company_of_user = $this->session->userdata('company_id');
        $role = $this->session->userdata('role');
        if (!isset($is_logged_in) || $role != 1) {

            $this->db->where('company_id', $company_of_user);
            $this->db->where('support_id', $id);
            $this->db->limit(1);
            $this->db->delete('support');
        } else {
            $this->db->where('support_id', $id);
            $this->db->limit(1);
            $this->db->delete('support');
        }
    }

}