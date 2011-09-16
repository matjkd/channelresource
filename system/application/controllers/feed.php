<?php
class Feed extends MY_Controller 
{

    function Feed()
    {
        parent::Controller();
        $this->load->model('news_model', '', TRUE);
        $this->load->helper('xml');
    }
    
    function index()
    {
        $data['encoding'] = 'utf-8';
        $data['feed_name'] = 'lease-desk.com';
        $data['feed_url'] = 'http://www.lease-desk.com';
        $data['page_description'] = 'Lease Desk';
        $data['page_language'] = 'en-ca';
        $data['creator_email'] = 'info at lease-desk dot com';
        $data['posts'] = $this->news_model->list_recent_news();    
        header("Content-Type: application/rss+xml");
        $this->load->view('news/rss', $data);
    }
}