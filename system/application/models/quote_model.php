<?php

class Quote_model extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     *
     * @return type
     *
     *
     */
    function add_data() {


        $currency = $this->input->post('currency');
        if ($currency == 'Â£') {
            $currency = '&#163;';
        }
        if ($currency == 'â&#65533;¬') {
            $currency = ' &#0128;';
        }

        $this->db->select('company_id');
        $this->db->where('user_id', $this->input->post('user_id'));
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $new_quote_insert_data = array('quote_ref' => $this->input->post('quote_ref'),
                    'currency' => $currency,
                    'assigned' => $this->input->post('assigned_id'),
                    'capital' => $this->input->post('capital'),
                    'capital_type' => $this->input->post('capital_type'),
                    'amount_type' => $this->input->post('amount_type'),
                    'interest_type' => $this->input->post('interest_type'),
                    'calculate_by' => $this->input->post('calculate_by'),
                    'payment_type' => $this->input->post('payment_type'),
                    'payment_frequency' => $this->input->post('payment_frequency'),
                    'initial' => $this->input->post('initial'),
                    'regular' => $this->input->post('regular'),
                    'number_of_ports' => $this->input->post('number_of_ports'),
                    'annual_support_costs' => $this->input->post('annual_support_costs'),
                    'other_monthly_costs' => $this->input->post('other_monthly_costs'),
                    'date_added' => $this->input->post('date_added'),
                    'user_id' => $this->input->post('user_id'),
                    'company_id' => $row['company_id']
                );

            $insert = $this->db->insert('quote', $new_quote_insert_data);
            return $insert;
        }
    }

    /**
     *
     * @param type $id
     * @return type
     */
    function update_data($id) {
        $currency = $this->input->post('currency');
        if ($currency == 'Â£') {
            $currency = '&#163;';
        }
        if ($currency == 'â&#65533;¬') {
            $currency = ' &#0128;';
        }
        $this->db->select('company_id');
        $this->db->where('user_id', $this->input->post('user_id'));
        $query = $this->db->get('users');

        $assigned_id = $this->input->post('assigned_id');

        if ($assigned_id == NULL) {
            $assigned = $this->input->post('assigned');
        } else {
            $assigned = $this->input->post('assigned_id');
        }

        $timenow = unix_to_human(now(), TRUE, 'eu');

        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $quote_update_data = array('quote_ref' => $this->input->post('quote_ref'),
                    'assigned' => $assigned,
                    'currency' => $currency,
                    'capital' => $this->input->post('capital'),
                    'capital_type' => $this->input->post('capital_type'),
                    'amount_type' => $this->input->post('amount_type'),
                    'interest_type' => $this->input->post('interest_type'),
                    'calculate_by' => $this->input->post('calculate_by'),
                    'payment_type' => $this->input->post('payment_type'),
                    'payment_frequency' => $this->input->post('payment_frequency'),
                    'initial' => $this->input->post('initial'),
                    'regular' => $this->input->post('regular'),
                    'number_of_ports' => $this->input->post('number_of_ports'),
                    'annual_support_costs' => $this->input->post('annual_support_costs'),
                    'other_monthly_costs' => $this->input->post('other_monthly_costs'),
                    'date_updated' => $timenow
                        //'user_id' => $this->input->post('user_id'),
                        //'company_id' => $row['company_id']
                );
        }
        $this->db->where('quote_id', $id);
        $update = $this->db->update('quote', $quote_update_data);
        return $update;
    }

    /**
     *
     * @param type $id
     * @param type $num
     * @param type $offset
     * @return string
     */
    function list_entries($id, $num, $offset) {
        $data = array();
        $company = $this->session->userdata('company_id');

        if (!isset($company) || $company > 2) {
            $this->db->where('quote.company_id', $id);
            $this->db->join('users', 'users.user_id=quote.user_id', 'right');
        } else if (!isset($company) || $company < 3) {
            $this->db->join('users', 'users.user_id=quote.user_id');
        }
        $Q = $this->db->get('quote');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row):

                $results[] = $row;


            endforeach;
        } else {
            $results[] = "X";
        }
        $Q->free_result();


        return $results;
    }

    /**
     *
     * @return string
     */
    function list_entries_by_user() {
        $data = array();
        $company = $this->session->userdata('company_id');
        $user = $this->session->userdata('user_id');

        if (!isset($company) || $company > 2) {
            $this->db->where('quote.user_id', $user);
            $this->db->or_where('quote.assigned', $user);
            $this->db->join('users as u', 'u.user_id=quote.user_id', 'right');
            $this->db->select('u.firstname, u.lastname, quote.date_added, quote.date_updated, quote.quote_ref, quote.quote_id');
        } else if (!isset($company) || $company < 3) {
            $this->db->join('users', 'users.user_id=quote.user_id');
            $this->db->join('users as a', 'a.user_id=quote.assigned', 'left');
            $this->db->select('a.firstname as fname, a.lastname as lname, a.email_address as aemail, users.firstname, users.lastname, quote.date_added, quote.date_updated, quote.quote_ref, quote.quote_id');
        }



        $this->db->order_by('quote.date_added', 'desc');
        $Q = $this->db->get('quote');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row):

                $results[] = $row;


            endforeach;
        } else {
            $results[] = "X";
        }
        $Q->free_result();


        return $results;
    }

    /**
     *
     * @return type 
     */
    function num_quotes() {
        $query = $this->db->count_all_results('quote');
        return $query;
    }

    /**
     * 
     */
    function listquotes_loadmore($offset=0) {
        $data = array();
        $company = $this->session->userdata('company_id');
        $user = $this->session->userdata('user_id');

        if (!isset($company) || $company > 2) {
            $this->db->where('quote.user_id', $user);
            $this->db->or_where('quote.assigned', $user);
            $this->db->join('users as u', 'u.user_id=quote.user_id', 'right');
            $this->db->select('u.firstname, u.lastname, quote.date_added, quote.quote_ref, quote.quote_id');
        } else if (!isset($company) || $company < 3) {
            $this->db->join('users', 'users.user_id=quote.user_id');
            $this->db->join('users as a', 'a.user_id=quote.assigned', 'left');
            $this->db->select('a.firstname as fname, a.lastname as lname, users.firstname, users.lastname, quote.date_added, quote.quote_ref, quote.quote_id');
        }



        $this->db->order_by('quote.date_added', 'desc');
        $Q = $this->db->get('quote', 10, $offset);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row):

                $results[] = $row;


            endforeach;
        } else {
            $results[] = "X";
        }
        $Q->free_result();


        return $results;
    }

    /**
     *
     * @param type $term
     * @return string 
     */
    function search_quotes($term) {
        $data = array();
        $company = $this->session->userdata('company_id');
        $user = $this->session->userdata('user_id');
        $pieces = explode(" ", $term);




        if (!isset($company) || $company > 2) {
            $this->db->where('quote.user_id', $user);
            $this->db->or_where('quote.assigned', $user);
            $this->db->join('users as u', 'u.user_id=quote.user_id', 'right');
            $this->db->select('u.firstname, u.lastname, quote.date_added, quote.quote_ref, quote.quote_id');


            foreach ($pieces as $row):

                $this->db->like('u.firstname', $row);
                $this->db->or_like('u.lastname', $row);

            endforeach;
        } else if (!isset($company) || $company < 3) {
            $this->db->join('users', 'users.user_id=quote.user_id');
            $this->db->join('users as a', 'a.user_id=quote.assigned', 'left');
            $this->db->select('a.firstname as fname, a.lastname as lname, users.firstname, users.lastname, quote.date_added, quote.quote_ref, quote.quote_id');

            foreach ($pieces as $row):

                $this->db->like('a.firstname', $row);
                $this->db->or_like('a.lastname', $row);
                $this->db->or_like('users.firstname', $row);
                $this->db->or_like('users.lastname', $row);

            endforeach;
        }
        foreach ($pieces as $row):

            $this->db->or_like('quote.quote_ref', $row);

        endforeach;



        $this->db->order_by('quote.date_added', 'desc');
        $Q = $this->db->get('quote');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row):

                $results[] = $row;


            endforeach;
        } else {
            $results[] = "X";
        }
        $Q->free_result();


        return $results;
    }

    /**
     *
     * @param type $id
     * @return type
     */
    function get_data($id) {
        $data = array();
        $this->db->where('quote_id', $id);
        $this->db->join('users', 'users.user_id=quote.user_id');
        $query = $this->db->get('quote');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    /**
     *
     * @param type $id
     */
    function delete_quote($id) {
        $this->db->where('quote_id', $id);
        $this->db->delete('quote');
    }

}
