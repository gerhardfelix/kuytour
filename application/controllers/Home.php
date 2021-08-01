<?php
class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pesanan_model');
        $this->load->model('mobil_model');
        $this->load->model('pelanggan_model');
        $this->load->model('supir_model');
        $this->load->helper('url_helper');
            
    }
    public function index()
    {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('home/index');
            $this->load->view('templates/footer');
    }

    public function delete_order_cron(){
        $this->pesanan_model->cron_delete();
    }
}