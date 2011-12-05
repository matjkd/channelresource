<?php

class Guide_model extends Model {

    function __construct() {
        parent::__construct();
    }

    function get_guide($id) {
        $data = array();
        $this->db->where('user_guide_id', $id);
        $query = $this->db->get('user_guides');
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_guides($section) {
        $data = array();
        $this->db->where('guide_section', $section);
        $query = $this->db->get('user_guides');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function matchtags($tag) {
        $data = array();
        $this->db->where('tag', $tag);
        $this->db->join('tag_links', 'tag_links.tag_id = tags.tag_id');
        $query = $this->db->get('tags');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getguides_withtag($tag) {
        $data = array();

        $this->db->join('tag_links', 'user_guides.user_guide_id = tag_links.guide_id', 'LEFT');
        $this->db->join('tags', 'tags.tag_id = tag_links.tag_id', 'RIGHT');
        $this->db->where('tags.tag', $tag);
        $this->db->where('user_guides.guide_category >', 0);
        $query = $this->db->get('user_guides');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
            $query->free_result();

            return $data;
        } else {
            return FALSE;
        }
    }

    function getguides_notag($tag) {
        $data = array();
        $common_words = array("the", "of", "I", "and", "with");
        $trimtag = str_replace($common_words, "", $tag);

        if ($trimtag == NULL) {
            return FALSE;
        }
        $pieces = explode(" ", $trimtag);

        //$this->db->like('user_guides.description', $tag);
        foreach ($pieces as $row):

            $this->db->like('user_guides.description', $row);

        endforeach;


        $this->db->where('user_guides.guide_category >', 0);
        $query = $this->db->get('user_guides');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
            $query->free_result();

            return $data;
        } else {
            return FALSE;
        }
    }

    function get_all_guides() {
        $data = array();
        $this->db->order_by('date_modified', 'desc');
        $query = $this->db->get('user_guides');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_recent_guides($num = 8) {
        $data = array();
        $this->db->limit($num);
        $this->db->order_by('date_modified', 'desc');
        $query = $this->db->get('user_guides');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function delete_guide($id) {

        //delete tags linked to guide id $id
        $this->db->where('guide_id', $id);
        $query = $this->db->delete('tag_links');

        
        //Delete guide with guide id $id
        $this->db->where('user_guide_id', $id);
        $query = $this->db->delete('user_guides');
 
       

        return TRUE;
    }

    function match_category() {
        //match category
        $cat_name = $this->input->post('category');

        if ($cat_name == NULL) {
            return 0;
        }

        //check if uncategorised category exists, if not add it
        $data = array();
        $this->db->where('guide_cat', 'Uncategorised');
        $query = $this->db->get('guide_cat');
        if ($query->num_rows() == 0) {
            $uncat = array(
                'guide_cat' => 'Uncategorised',
            );
            $this->db->insert('guide_cat', $uncat);
            $new_id = $this->db->insert_id();

            $uncat2 = array(
                'guide_cat' => 'Uncategorised',
                'guide_cat_id' => '0'
            );
            $this->db->where('guide_cat_id', $new_id);
            $this->db->update('guide_cat', $uncat2);
        }
        if ($query->num_rows() == 1) {
            $id = $query->row('guide_cat_id');
            $uncat2 = array(
                'guide_cat' => 'Uncategorised',
                'guide_cat_id' => '0'
            );
            $this->db->where('guide_cat_id', $id);
            $this->db->update('guide_cat', $uncat2);
        }
        $query->free_result();


        //check category exists and return the id
        $data = array();
        $this->db->where('guide_cat', $cat_name);
        $query = $this->db->get('guide_cat');


        if ($query->num_rows() == 1) {
            return $query->row('guide_cat_id');
        }

        //if category doesn't exist add it and return the id
        if ($query->num_rows() == 0) {
            $new_cat = array(
                'guide_cat' => $this->input->post('category')
            );
            $this->db->insert('guide_cat', $new_cat);
            return $this->db->insert_id();
        }
        $query->free_result();
    }

    function add_guide() {

        $category = $this->match_category();




        //insert new guide
        $new_guide = array(
            'filename' => $this->input->post('filename'),
            'title' => $this->input->post('title'),
            'guide_category' => $category,
            'description' => $this->input->post('description'),
            'date_modified' => now()
        );
        $insert = $this->db->insert('user_guides', $new_guide);
        return $insert;
    }

    function update_guide($id) {

        $category = $this->match_category();
        //update guide
        $this->db->where('user_guide_id', $id);
        $query = $this->db->get('user_guides');
        if ($query->num_rows() == 1) {
            foreach ($query->result_array() as $row)
                $guide_update = array(
                    'filename' => $this->input->post('filename'),
                    'title' => $this->input->post('title'),
                    'guide_category' => $category,
                    'description' => $this->input->post('description'),
                    'date_modified' => now()
                );
        }
        $this->db->where('user_guide_id', $id);
        $update = $this->db->update('user_guides', $guide_update);
        return $update;
    }

    function get_guide_categories() {
        $data = array();


        $query = $this->db->get('guide_cat');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_all_tags() {
        $data = array();


        $query = $this->db->get('tags');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_linked_tags() {
        $data = array();

        $this->db->join('tags', 'tags.tag_id = tag_links.tag_id', 'LEFT');
        $this->db->group_by('tag_links.tag_id');
        $query = $this->db->get('tag_links');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_assigned_tags($id) {
        $data = array();
        $this->db->where('guide_id', $id);
        $this->db->join('tags', 'tags.tag_id = tag_links.tag_id', 'LEFT');
        $query = $this->db->get('tag_links');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function add_tag($id) {
        $tag = $this->input->post('newtag');
        $data = array();
        $this->db->from('tags');
        $this->db->where('tag', $tag);
        $Q = $this->db->get();
        // check if tag exists, if not add it to database
        if ($Q->num_rows() < 1) {
            $new_tag_data = array(
                'tag' => $tag
            );

            $this->db->insert('tags', $new_tag_data);
        }
        $Q->free_result();

        //now add tag to list of tags.	
        $this->db->from('tags');
        $this->db->where('tag', $tag);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row)
                $new_tag_link = array(
                    'tag_id' => $row['tag_id'],
                    'guide_id' => $id
                );
            $this->db->insert('tag_links', $new_tag_link);
        }

        return;
    }

    function delete_assigned_tag($id) {
        //grab the guide id before deleting feature, and return guide id to controller
        $data = array();
        $this->db->select('guide_id');
        $this->db->where('tag_link_id', $id);

        $Q = $this->db->get('tag_links');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();

        $this->db->where('tag_link_id', $id);
        $this->db->delete('tag_links');

        return $data;
    }

    function delete_category($id) {

        //find guides with this category and make their cat ID 0

        $this->db->where('guide_category', $id);
        $query = $this->db->get('user_guides');

        //convert ID's to 0
        if ($query->num_rows() > 0) {

            $delcat = array(
                'guide_category' => 0,
            );

            $this->db->where('guide_category', $id);
            $update = $this->db->update('user_guides', $delcat);
        }
        $query->free_result();
        //del category
        $this->db->where('guide_cat_id', $id);
        $query = $this->db->delete('guide_cat');
    }

    function get_guide_cats($param) {
        $data = array();



        $where = "guide_cat REGEXP '^$param'";
        $this->db->where($where);
        $query = $this->db->get('guide_cat');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

    function get_guide_tags($param) {
        $data = array();



        $where = "tag REGEXP '^$param'";
        $this->db->where($where);
        $query = $this->db->get('tags');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        }
        $query->free_result();

        return $data;
    }

}