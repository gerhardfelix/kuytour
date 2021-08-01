<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Pesanan_api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('pesanan_model');
        $this->load->model('mobil_model');
        $this->load->model('pelanggan_model');
        $this->load->model('supir_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['pesanan_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['pesanan_post']['limit'] = 100; // 100 requests per hour per user/key
        
    }


    public function pesanan_get()
    {
        // Users from a data store e.g. database
        //$pesanan = $this->pesanan_model->get_pesanan_mobil($kode_booking = FALSE);

        $id = $this->get('kode_booking');
        $mobil = $this->get('mobil');
        $supir = $this->get('supir');
        $durasi = $this->get('durasi');
        $tgl_berangkat = $this->get('tgl_berangkat');
        $jam_berangkat = $this->get('jam_berangkat');


        $tgl_berangkat = date("Y-m-d H:i:s", strtotime($tgl_berangkat.' '.$jam_berangkat));
        $tgl_pulang = date("Y-m-d H:i:s", strtotime('+'.$this->input->post('durasi_pesan').' hours', strtotime($tgl_berangkat)));


        if (isset($mobil) && isset($durasi) && isset($tgl_berangkat))
        {
            $pesanan = $this->pesanan_model->get_pesanan_mobil_by_date($mobil, $tgl_berangkat, $tgl_pulang, $id);
            if ($pesanan)
            {
                // Set the response and exit
                $this->response($pesanan, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Pesanan tidak ditemukan 2'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
            
        }  

        elseif (isset($id)) {
            $pesanan = $this->pesanan_model->get_pesanan_mobil($kode_booking = $id);
            if ($pesanan)
            {
                // Set the response and exit
                $this->response($pesanan, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Pesanan tidak ditemukan 1'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
            
        }      

        elseif (($supir=='yes') && isset($durasi) && isset($tgl_berangkat))
        {
            $pesanan = $this->pesanan_model->get_pesanan_mobil_by_supir($supir, $tgl_berangkat, $tgl_pulang);
            if ($pesanan)
            {
                // Set the response and exit
                $this->response($pesanan, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Pesanan no ditemukan 3'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
            
        }  
        else {

            // Set the response and exit
            $pesanan = $this->pesanan_model->get_pesanan_mobil();
            if ($pesanan)
            {
                // Set the response and exit
                $this->response($pesanan, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            $this->response([
                'status' => FALSE,
                'message' => 'No order were found 4'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }

    public function pesanan_post()
    {
        $supir = (int) $this->post('supir');
        if (empty($supir)) {
            $pesanan = $this->pesanan_model->set_pesanan_mobil_by_webhook();
            $message = [
                'id' => $pesanan['id'], // Automatically generated by the model
                'kode_booking' =>  $pesanan['kode_booking'],
                'total' => $pesanan['total'],
                'message' => 'Added a resource'
            ];
        } else {
            $pesanan = $this->pesanan_model->set_pesanan_mobil_by_webhook();
            $message = [
                'id' => $pesanan['id'], // Automatically generated by the model
                'kode_booking' =>  $pesanan['kode_booking'],
                'total' => $pesanan['total'],
                'message' => 'Added a resource'
            ];
        }
        
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function pesanan_put()
    {
        $total_biaya = 0;
        $mobil = $this->mobil_model->get_mobil($this->input->get('slug_mobil'));
        if ($this->input->get('durasi_pesan')==12) {
            $total_biaya = $mobil['harga12'];
        }else {
            $total_biaya = $this->input->get('durasi_pesan')/24*$mobil['harga24'];
        }

        $pelanggan = $this->pelanggan_model->get_pelanggan($this->input->get('chat_id'));

        $tgl_berangkat = date("Y-m-d H:i:s", strtotime($this->input->get('tgl_berangkat').' '.$this->input->get('jam_berangkat')));
        $tgl_pulang = date("Y-m-d H:i:s", strtotime('+'.$this->input->get('durasi_pesan').' hours', strtotime($tgl_berangkat)));

        $supir = NULL;
        if ($this->input->get('supir')=='yes') {
            $total_biaya = $total_biaya + ($this->input->get('durasi_pesan')*$mobil['dengansupir']);
            $supir = $this->pesanan_model->get_pesanan_mobil_by_supir('true', $tgl_berangkat, $tgl_pulang);
            $supir = $supir['id_supir'];
        }
        
        $data = array(
            'lokasi_jemput' => $this->input->get('lokasi_jemput'),
            'durasi_pesan' => $this->input->get('durasi_pesan'),
            'id_mobil' => $mobil['id'],
            'id_sopir' => $supir,
            'total_biaya' => $total_biaya,
            'tgl_berangkat' => $tgl_berangkat,
            'tgl_pulang' => $tgl_pulang,
            'bukti_bayar' => $this->input->get('bukti_bayar'),
            'nama_bank' => $this->input->get('nama_bank'),
            'refund' => $this->input->get('refund'),
            'no_rekening' => $this->input->get('no_rekening'),
            'nama_rekening' => $this->input->get('nama_rekening'),
            'status_bayar' => $this->input->get('status_bayar')
        );
        $data = array_filter($data);
        if ($this->input->get('supir')=='no') {
            $data['id_sopir'] = NULL;
        }
        $kode_booking = $this->input->get('kode_booking');

        $pesanan = $this->pesanan_model->edit_pesanan_mobil_by_webhook($kode_booking, $data);
        file_put_contents('./webhook/log_'.date("j.n.Y").'.log', json_encode($this->db->last_query()), FILE_APPEND);
        $message = [
            'id' => $pesanan['id'], // Automatically generated by the model
            'kode_booking' =>  $kode_booking,
            'total' => $total_biaya,
            'message' => 'edited a resource',
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function pesanan_delete($id = '')
    {
        $this->pesanan_model->delete_pesanan_mobil($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
    }

}
