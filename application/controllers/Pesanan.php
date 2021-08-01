<?php
class Pesanan extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('pesanan_model');
                $this->load->model('mobil_model');
                $this->load->model('pelanggan_model');
                $this->load->model('supir_model');
                $this->load->helper('url_helper');
                if (!$this->ion_auth->logged_in())
				{
					redirect('auth/login');
				}
	
        }

        public function index()
        {
                $data['pesanan_m'] = $this->pesanan_model->get_pesanan_mobil();
                $data['judul'] = 'Pemesanan';

		        $this->load->view('templates/header');
		        $this->load->view('templates/sidebar');
		        $this->load->view('pesanan_mobil/index', $data);
		        $this->load->view('templates/footer');
        }

        public function view_pesanan_mobil($kode_booking = NULL)
        {
                $data['detail_pesanan_mobil'] = $this->pesanan_model->get_pesanan_mobil($kode_booking);
                if (empty($data['detail_pesanan_mobil']))
       		{
                	show_404();
        	}

		        $data['kode_booking'] = $data['detail_pesanan_mobil']['kode_booking'];

		        $this->load->view('templates/header');
		        $this->load->view('templates/sidebar');
		        $this->load->view('pesanan_mobil/view', $data);
		        $this->load->view('templates/footer');
        }

        public function create_pesanan_mobil()
		{
			    $data['judul'] = 'Create a pesanan item';

			    $this->form_validation->set_rules('id_mobil', 'Mobil', 'required');
			    $this->form_validation->set_rules('id_supir', 'Sopir', 'required');
			    $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required');
			    $this->form_validation->set_rules('lokasi_jemput', 'Lokasi', 'required');
			    $this->form_validation->set_rules('tgl_berangkat', 'Tanggal Berangkat', 'required');
			    $this->form_validation->set_rules('durasi_pesan', 'Durasi Pesan', 'required');

			    if ($this->form_validation->run() === FALSE)
			    {
			    	$data['mobil'] = $this->mobil_model->get_mobil();
			    	$data['pelanggan'] = $this->pelanggan_model->get_pelanggan();
			    	$data['supir'] = $this->supir_model->get_supir();
			        $this->load->view('templates/header', $data);
			        $this->load->view('templates/sidebar');
			        $this->load->view('pesanan_mobil/create');
			        $this->load->view('templates/footer');

			    }
			    else
			    {
			        $this->pesanan_model->set_pesanan_mobil();
			        redirect('pesanan','refresh');
			    }
		}

		public function delete_pesanan_mobil($kode_booking)
		{
			$this->pesanan_model->delete_pesanan_mobil($kode_booking);
			redirect('pesanan_mobil','refresh');
		}

		public function edit_pesanan_mobil($kode_booking= NULL)
		{
		    $data['kode_booking'] = 'Edit Pesanan item';

			$this->form_validation->set_rules('id_mobil', 'Mobil', 'required');
		    $this->form_validation->set_rules('id_supir', 'Sopir', 'required');
		    $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required');
		    $this->form_validation->set_rules('lokasi_jemput', 'Lokasi', 'required');
		    $this->form_validation->set_rules('tgl_berangkat', 'Tanggal Berangkat', 'required');
		    $this->form_validation->set_rules('durasi_pesan', 'Durasi Pesan', 'required');

		    if ($this->form_validation->run() === FALSE)
		    {
		    	$data['pesanan_mobil_item'] = $this->pesanan_model->get_pesanan_mobil($kode_booking);
		    	$data['mobil'] = $this->mobil_model->get_mobil();
		    	$data['pelanggan'] = $this->pelanggan_model->get_pelanggan();
		    	$data['supir'] = $this->supir_model->get_supir();
		        $this->load->view('templates/header', $data);
		        $this->load->view('templates/sidebar');
		        $this->load->view('pesanan_mobil/edit');
		        $this->load->view('templates/footer');

		    }
		    else
		    {
		        $this->pesanan_model->edit_pesanan_mobil();
		        redirect('pesanan','refresh');
		    }
		}
}