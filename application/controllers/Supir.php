<?php
class Supir extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('supir_model');
                $this->load->helper('url_helper');
                if (!$this->ion_auth->logged_in())
				{
					redirect('auth/login');
				}
	
        }

        public function index()
        {
                $data['supir'] = $this->supir_model->get_supir();
                $data['no_sim'] = 'supir archive';

		        $this->load->view('templates/header');
		        $this->load->view('templates/sidebar');
		        $this->load->view('supir/index', $data);
		        $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $data['supir_item'] = $this->supir_model->get_supir($slug);
                if (empty($data['supir_item']))
       		{
                	show_404();
        	}

		        $data['nosim'] = $data['supir_item']['no_sim'];

		        $this->load->view('templates/header');
		        $this->load->view('templates/sidebar');
		        $this->load->view('supir/view', $data);
		        $this->load->view('templates/footer');
        }

        public function create()
		{
			    $data['no_sim'] = 'Create a supir item';

			    $this->form_validation->set_rules('no_sim', 'No_sim', 'required');
			    $this->form_validation->set_rules('nama_supir', 'Nama_supir', 'required');
			    $this->form_validation->set_rules('hp_supir', 'Hp_supir', 'required');

			    if ($this->form_validation->run() === FALSE)
			    {
			        $this->load->view('templates/header', $data);
			        $this->load->view('templates/sidebar');
			        $this->load->view('supir/create');
			        $this->load->view('templates/footer');

			    }
			    else
			    {
			        $this->supir_model->set_supir();
			        redirect('supir','refresh');
			    }
		}

		public function delete($slug)
		{
			$data['supir_item'] = $this->supir_model->delete_supir($slug);
			redirect('supir','refresh');
		}

		public function edit_supir($slug= NULL)
		{
		    $data['no_sim'] = 'Edit supir item';

		    $this->form_validation->set_rules('no_sim', 'No_sim', 'required');
		    $this->form_validation->set_rules('nama_supir', 'Nama_supir', 'required');
		    $this->form_validation->set_rules('hp_supir', 'Hp_supir', 'required');

		    if ($this->form_validation->run() === FALSE)
		    {
		    	
		    	$data['supir'] = $this->supir_model->get_supir($slug);
		        $this->load->view('templates/header', $data);
		        $this->load->view('templates/sidebar');
		        $this->load->view('supir/edit');
		        $this->load->view('templates/footer');

		    }
		    else
		    {
		        $this->supir_model->edit_supir();
		        redirect('supir','refresh');
		    }
		}
}