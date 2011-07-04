<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datasource extends Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

        function Datasource()
	{
		parent::__construct();
                $this->load->model('guide_model');
		$this->is_logged_in();
	}

	public function index()
	{
          
	}

        public function json_cats()
        {
            $term = $this->input->post('term');
            $data['source'] = $this->guide_model->get_guide_cats($term);
            $this->load->vars($data);
            $this->load->view('json/guide_cats');
        }

        function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['message'] = "You don't have permission";
			redirect('user/login');

		}
	}
}

/* End of file datasource.php */
/* Location: ./application/controllers/datasource.php */