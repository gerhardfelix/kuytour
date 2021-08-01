<?php
class Mobil extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('mobil_model');
                $this->load->helper('url_helper');
                if (!$this->ion_auth->logged_in())
				{
					redirect('auth/login');
				}
	
        }

        public function index()
        {
                $data['mobil'] = $this->mobil_model->get_mobil();
                $data['nopol'] = 'mobil archive';

		        $this->load->view('templates/header');
		        $this->load->view('templates/sidebar');
		        $this->load->view('mobil/index', $data);
		        $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $data['mobil_item'] = $this->mobil_model->get_mobil($slug);
                if (empty($data['mobil_item']))
       		{
                	show_404();
        	}

		        $data['nopol'] = $data['mobil_item']['nopol'];

		        $this->load->view('templates/header');
		        $this->load->view('templates/sidebar');
		        $this->load->view('mobil/view', $data);
		        $this->load->view('templates/footer');
        }

        public function create()
		{
			    $data['nopol'] = 'Create a mobil item';

			    $this->form_validation->set_rules('nopol', 'Nomor Kendaraan', 'required');
			    $this->form_validation->set_rules('merk', 'Merk Kendaraan', 'required');
			    $this->form_validation->set_rules('tipe', 'Tipe Kendaraan', 'required');
			    $this->form_validation->set_rules('harga12', 'Harga Sewa 12 Jam', 'required');
			    $this->form_validation->set_rules('harga24', 'Harga Sewa 24 Jam', 'required');

			    if ($this->form_validation->run() === FALSE)
			    {
			        $this->load->view('templates/header', $data);
			        $this->load->view('templates/sidebar');
			        $this->load->view('mobil/create');
			        $this->load->view('templates/footer');

			    }
			    else
			    {
			        $this->mobil_model->set_mobil();
			        redirect('mobil','refresh');
			    }
		}

		public function delete($slug)
		{
			$data['mobil_item'] = $this->mobil_model->delete_mobil($slug);
			redirect('mobil','refresh');
		}

		public function edit_mobil($slug= NULL)
		{
		    $data['nopol'] = 'Edit mobil item';

 			$this->form_validation->set_rules('nopol', 'Nomor Kendaraan', 'required');
			$this->form_validation->set_rules('merk', 'Merk Kendaraan', 'required');
		    $this->form_validation->set_rules('tipe', 'Tipe Kendaraan', 'required');
		    $this->form_validation->set_rules('harga12', 'Harga Sewa 12 Jam', 'required');
		    $this->form_validation->set_rules('harga24', 'Harga Sewa 24 Jam', 'required');

		    if ($this->form_validation->run() === FALSE)
		    {
		    	
		    	$data['mobil'] = $this->mobil_model->get_mobil($slug);
		        $this->load->view('templates/header', $data);
		        $this->load->view('templates/sidebar');
		        $this->load->view('mobil/edit');
		        $this->load->view('templates/footer');

		    }
		    else
		    {
		        $this->mobil_model->edit_mobil();
		        redirect('mobil','refresh');
		    }
		}
}