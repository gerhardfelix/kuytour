<?php

class Pesanan_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
            $this->load->model('mobil_model');
            $this->load->model('pelanggan_model');
    }

    public function get_pesanan_mobil($kode_booking = FALSE)
    {
        if ($kode_booking === FALSE) 
        {
            $this->db->select('*');
            $this->db->from('pemesanan_mobil');
            $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan_mobil.id_pelanggan', 'left');
            $this->db->join('mobil', 'mobil.id = pemesanan_mobil.id_mobil');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select('pemesanan_mobil.*, pelanggan.nama, mobil.tipe, mobil.merk, mobil.nopol, supir.nama_supir, pelanggan.chat_id, pelanggan.username');
        $this->db->from('pemesanan_mobil');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan_mobil.id_pelanggan');
        $this->db->join('mobil', 'mobil.id = pemesanan_mobil.id_mobil');
        $this->db->join('supir', 'supir.id_supir = pemesanan_mobil.id_sopir', 'left');
        $this->db->where('pemesanan_mobil.kode_booking', $kode_booking);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_pesanan_mobil_by_date($mobil = FALSE, $tgl_berangkat = FALSE, $tgl_pulang=FALSE, $kode_booking = FALSE)
    {
        if ($kode_booking === FALSE) {
            $this->db->select('id_pemesanan');
            $this->db->from('pemesanan_mobil');
            $this->db->join('mobil', 'mobil.id = pemesanan_mobil.id_mobil');
            $this->db->where('mobil.slug', $mobil);
            $this->db->where('DATE_FORMAT("'.$tgl_berangkat.'", "%Y-%m-%d %H:%i:%s") between tgl_berangkat and tgl_pulang');
            $this->db->or_where('DATE_FORMAT("'.$tgl_pulang.'", "%Y-%m-%d %H:%i:%s") between tgl_berangkat and tgl_pulang');
            $this->db->or_where('(tgl_berangkat > DATE_FORMAT("'.$tgl_berangkat.'", "%Y-%m-%d %H:%i:%s")) and (tgl_pulang < DATE_FORMAT("'.$tgl_pulang.'", "%Y-%m-%d %H:%i:%s"))');

            $query = $this->db->get();
            return $query->result_array();        
        } else {
            $this->db->select('id_pemesanan');
            $this->db->from('pemesanan_mobil');
            $this->db->join('mobil', 'mobil.id = pemesanan_mobil.id_mobil');
            $this->db->where('pemesanan_mobil.kode_booking <> ', $kode_booking);
            $this->db->where('mobil.slug', $mobil);
            $this->db->where('DATE_FORMAT("'.$tgl_berangkat.'", "%Y-%m-%d %H:%i:%s") between tgl_berangkat and tgl_pulang');
            $this->db->or_where('DATE_FORMAT("'.$tgl_pulang.'", "%Y-%m-%d %H:%i:%s") between tgl_berangkat and tgl_pulang');
            $this->db->or_where('(tgl_berangkat > DATE_FORMAT("'.$tgl_berangkat.'", "%Y-%m-%d %H:%i:%s")) and (tgl_pulang < DATE_FORMAT("'.$tgl_pulang.'", "%Y-%m-%d %H:%i:%s"))');

            $query = $this->db->get();
            return $query->result_array();        
        }
    }

    public function get_pesanan_mobil_by_supir($supir = FALSE, $tgl_berangkat = FALSE, $tgl_pulang=FALSE)
    {
      
        $this->db->distinct();
        $this->db->select('id_sopir');
        $this->db->from('pemesanan_mobil');        
        $this->db->where('DATE_FORMAT("'.$tgl_berangkat.'", "%Y-%m-%d %H:%i:%s") between tgl_berangkat and tgl_pulang');
        $this->db->or_where('DATE_FORMAT("'.$tgl_pulang.'", "%Y-%m-%d %H:%i:%s") between tgl_berangkat and tgl_pulang');
        $this->db->or_where('(tgl_berangkat > DATE_FORMAT("'.$tgl_berangkat.'", "%Y-%m-%d %H:%i:%s")) and (tgl_pulang < DATE_FORMAT("'.$tgl_pulang.'", "%Y-%m-%d %H:%i:%s"))');
        $query = $this->db->get();
        $names = array('0');
        foreach ($query->result() as $value) {
            if (isset($value->id_sopir)) {
                array_push($names, $value->id_sopir);
            }
        }

        $this->db->select('supir.id_supir');
        $this->db->from('supir');
        $this->db->where_not_in('id_supir', $names);
        $this->db->order_by('rand()');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function set_pesanan_mobil()
    {
        $this->load->helper('url');

        $total_biaya = 0;
        $mobil = $this->mobil_model->get_mobil_by_id($this->input->post('id_mobil'));
        if ($this->input->post('durasi_pesan')==12) {
            $total_biaya = $mobil['harga12'];
        }else {
            $total_biaya = $this->input->post('durasi_pesan')/24*$mobil['harga24'];
        }

        $tgl_berangkat = date("Y-m-d H:i:s", strtotime($this->input->post('tgl_berangkat')));
        $tgl_pulang = date("Y-m-d H:i:s", strtotime('+'.$this->input->post('durasi_pesan').' hours', strtotime($tgl_berangkat)));
        
        $data = array(
            'id_mobil' => $this->input->post('id_mobil'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'lokasi_jemput' => $this->input->post('lokasi_jemput'),
            'tgl_bayar' => $this->input->post('tgl_bayar'),
            'durasi_pesan' => $this->input->post('durasi_pesan'),
            'total_biaya' => $total_biaya,
            'status_bayar' => 'Belum Bayar',
            'id_sopir' => $this->input->post('id_supir'),
            'tgl_berangkat' => $this->input->post('tgl_berangkat'),
            'tgl_booking' => 'now()',
        );

        $this->db->insert('pemesanan_mobil', $data);
        $insert_id = $this->db->insert_id();
        $kode_booking = 'KUYM'.$insert_id;
        $data = array(
            'kode_booking' => $kode_booking,
        );
        $this->db->where('id_pemesanan', $insert_id);
        $this->db->set($data);
        $this->db->update('pemesanan_mobil');

    }

    public function set_pesanan_mobil_by_webhook()
    {
        $this->load->helper('url');

        $total_biaya = 0;
        $mobil = $this->mobil_model->get_mobil($this->input->post('slug_mobil'));
        if ($this->input->post('durasi_pesan')==12) {
            $total_biaya = $mobil['harga12'];
        }else {
            $total_biaya = $this->input->post('durasi_pesan')/24*$mobil['harga24'];
        }

        $pelanggan = $this->pelanggan_model->get_pelanggan($this->input->post('chat_id'));

        $tgl_berangkat = date("Y-m-d H:i:s", strtotime($this->input->post('tgl_berangkat').' '.$this->input->post('jam_berangkat')));
        $tgl_pulang = date("Y-m-d H:i:s", strtotime('+'.$this->input->post('durasi_pesan').' hours', strtotime($tgl_berangkat)));

        $supir = NULL;
        if ($this->input->post('supir')=='yes') {
            $total_biaya = $total_biaya + ($this->input->post('durasi_pesan')*$mobil['dengansupir']);
            $supir = $this->get_pesanan_mobil_by_supir('true', $tgl_berangkat, $tgl_pulang);
            $supir = $supir['id_supir'];
        }
    
        $data = array(
            'id_mobil' => $mobil['id'],
            'lokasi_jemput' => $this->input->post('lokasi_jemput'),
            'durasi_pesan' => $this->input->post('durasi_pesan'),
            'total_biaya' => $total_biaya,
            'status_bayar' => 'Belum Bayar',
            'tgl_berangkat' => $tgl_berangkat,
            'tgl_pulang' => $tgl_pulang,
            'id_sopir' => $supir,
            'tgl_booking' => date('Y-m-d H:i:s'),
            'id_pelanggan' => $pelanggan['id_pelanggan']
        );
        
        $this->db->insert('pemesanan_mobil', $data);
        $insert_id = $this->db->insert_id();
        $kode_booking = 'KUYM'.$insert_id;
        $data = array(
            'kode_booking' => $kode_booking,
        );
        $this->db->where('id_pemesanan', $insert_id);
        $this->db->set($data);
        $this->db->update('pemesanan_mobil');

        $message = [
            'id' => $insert_id, // Automatically generated by the model
            'kode_booking' =>  $kode_booking,
            'total' => $total_biaya,
            'message' => 'Added a resource'
        ];

        return $message;

    }

    public function delete_pesanan_mobil($kode_booking)
    {
        $this->db->where('kode_booking', $kode_booking);
        return $this->db->delete('pemesanan_mobil');
    }

    public function edit_pesanan_mobil()
    {
        $kode_booking = $this->input->post('kode_booking');
        $pesanan = $this->get_pesanan_mobil($kode_booking);
        if ($pesanan['status_bayar'] != $this->input->post('status_bayar')) {
            if ($this->input->post('status_bayar')=='Sudah Bayar') {
                $pelanggan = $this->pelanggan_model->get_pelanggan_by_id($this->input->post('id_pelanggan'));
                $reply = "Pemesanan%20anda%20nomor%20".$kode_booking."%20telah%20terverifikasi%2C%20silahkan%20cek%20status%20pemesanan%20anda%20pada%20menu%20%2Fstatus_pemesanan";
                $sendto = "https://api.telegram.org/bot846509582:AAFBoWalOIRpA2uMpxWm5nyiT2Y2WNrVrdQ/sendmessage?chat_id=" . $pelanggan['chat_id'] . "&text=" . $reply . "&parse_mode=html";
                file_get_contents($sendto);
            } elseif ($this->input->post('status_bayar')=='Belum Bayar') {
                $pelanggan = $this->pelanggan_model->get_pelanggan_by_id($this->input->post('id_pelanggan'));
                $reply = "Pemesanan%20anda%20nomor%20".$kode_booking."%20gagal%20terverifikasi%2C%20silahkan%20kirim%20ulang%20bukti%20transfer%20anda.%0A";
                $sendto = "https://api.telegram.org/bot846509582:AAFBoWalOIRpA2uMpxWm5nyiT2Y2WNrVrdQ/sendmessage?chat_id=" . $pelanggan['chat_id'] . "&text=" . $reply . "&parse_mode=html";
                file_get_contents($sendto);
            }
        }
        
        if ($pesanan['refund'] != $this->input->post('refund')) {
            if ($this->input->post('refund')=='Done') {
                $pelanggan = $this->pelanggan_model->get_pelanggan_by_id($this->input->post('id_pelanggan'));
                $reply = "Pengembalian%20dana%20anda%20telah%20selesai%20diproses%2C%20silahkan%20cek%20mutasi%20rekening%20anda.";
                $sendto = "https://api.telegram.org/bot846509582:AAFBoWalOIRpA2uMpxWm5nyiT2Y2WNrVrdQ/sendmessage?chat_id=" . $pelanggan['chat_id'] . "&text=" . $reply . "&parse_mode=html";
                file_get_contents($sendto);
            } elseif ($this->input->post('refund')=='Invalid') {
                $pelanggan = $this->pelanggan_model->get_pelanggan_by_id($this->input->post('id_pelanggan'));
                $reply = "Nama%20bank%2C%20nomor%20rekening%20atau%20nama%20pemilik%20rekening%20anda%20tidak%20sesuai.%20Silahkan%20batalkan%20ulang%20pesanan%20dengan%20lengkap";
                $sendto = "https://api.telegram.org/bot846509582:AAFBoWalOIRpA2uMpxWm5nyiT2Y2WNrVrdQ/sendmessage?chat_id=" . $pelanggan['chat_id'] . "&text=" . $reply . "&parse_mode=html";
                file_get_contents($sendto);
            }
        }

        

        
        $data = array(
            'id_mobil' => $this->input->post('id_mobil'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'lokasi_jemput' => $this->input->post('lokasi_jemput'),
            'durasi_pesan' => $this->input->post('durasi_pesan'),
            'status_bayar' => $this->input->post('status_bayar'),
            'id_sopir' => $this->input->post('id_sopir'),
        );
        
        $this->db->where('kode_booking', $kode_booking);
        $this->db->set($data);
        $this->db->update('pemesanan_mobil');
    }

    public function edit_pesanan_mobil_by_webhook($id, $data)
    {
        $this->db->where('kode_booking', $id);
        $this->db->set($data);
        $this->db->update('pemesanan_mobil');
    }

    public function cron_delete(){
        $this->db->select('pemesanan_mobil.*, pelanggan.chat_id');
        $this->db->from('pemesanan_mobil');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan_mobil.id_pelanggan');
        $this->db->where('pemesanan_mobil.status_bayar', 'Belum Bayar');
        $this->db->where('pemesanan_mobil.tgl_booking < (now() - interval 120 minute)');
        $query = $this->db->get();
        foreach ($query->result() as $value) {

            $reply = rawurlencode('Pesanan anda dengan kode booking '.$value->kode_booking.' dibatalkan secara otomatis dikarenakan telah melewati batas waktu pembayaran.');
            $sendto = "https://api.telegram.org/bot846509582:AAFBoWalOIRpA2uMpxWm5nyiT2Y2WNrVrdQ/sendmessage?chat_id=" . $value->chat_id . "&text=" . $reply . "&parse_mode=html";
            file_get_contents($sendto);
        }

        $this->db->where('pemesanan_mobil.status_bayar', 'Belum Bayar');
        $this->db->where('pemesanan_mobil.tgl_booking < (now() - interval 120 minute)');
        return $this->db->delete('pemesanan_mobil');
    }
}