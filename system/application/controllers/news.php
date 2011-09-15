<?php

class News extends MY_Controller {

	 function __construct()
    {
        parent::__construct();
	
        $this->load->model('news_model');
        $this->logged_in();

	}

	function index()
	{
		redirect('news/item');
	}
	function logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if($is_logged_in!=NULL && $role ==1)
			{
			$globaldata['edit'] = "yes";
			$globaldata['create_news'] = site_url("admin/create_news");
			$this->load->vars($globaldata);
	        }

	}
	function item()
	{

		if(($this->uri->segment(3))==NULL)
			{
				$id = "news";
			}
		else
			{
				$id = $this->uri->segment(3);
			}


		
		$data['news'] = $this->news_model->list_news();

	

		$data['page'] = $id;
		$is_logged_in = $this->session->userdata('is_logged_in');

		

		$data['main'] = "news/news";

		$is_logged_in = $this->session->userdata('is_logged_in');




         $data['title'] = 'Latest News';


		
		$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}
function post($post)
	{

		$id = 'news';
		
		
		$data['news'] = $this->news_model->get_news($post);

		$data['page'] = $id;
		$is_logged_in = $this->session->userdata('is_logged_in');

		

		$data['main'] = "news/newsitem";

		$is_logged_in = $this->session->userdata('is_logged_in');

		//$data['widecolumn'] = 'global/mainbuttons';
		//$data['captcha'] = $this->captcha_model->initiate_captcha();
		$data['widecolumntop'] = 'sidebar/request_sidebar';

		foreach($data['news'] as $row):


			$data['title'] = $row['news_title'];
		endforeach;


		$data['info'] = "infoblock/times";
	$this->load->vars($data);
		$this->load->view('leasedesktemplate');
	}

}

/* End of file news.php */
/* Location: ./system/application/controllers/news.php */