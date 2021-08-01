<?php

class Mobil_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_mobil($slug = FALSE)
    {
        if ($slug === FALSE) 
        {
            
            $this->db->select('*');
            $this->db->from('mobil');
            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('mobil', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_mobil_by_id($id = FALSE)
    {
        if ($id === FALSE) 
        {
            
            $this->db->select('*');
            $this->db->from('mobil');
            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('mobil', array('id' => $id));
        return $query->row_array();
    }

    public function set_mobil()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('nopol'), 'dash', TRUE);

        $data = array(
            'nopol' => $this->input->post('nopol'),
            'slug' => $slug,
            'merk' => $this->input->post('merk'),
            'tipe' => $this->input->post('tipe'),
            'harga12' => $this->input->post('harga12'),
            'harga24' => $this->input->post('harga24'),
            'dengansupir' => $this->input->post('dengansupir'),



        );

        return $this->db->insert('mobil', $data);
    }   

    public function delete_mobil($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->delete('mobil');
    }

    public function edit_mobil()
    {
        $data = array(
            'nopol' => $this->input->post('nopol'),
            'merk' => $this->input->post('merk'),
            'tipe' => $this->input->post('tipe'),
            'harga12' => $this->input->post('harga12'),
            'harga24' => $this->input->post('harga24'),
            'dengansupir' => $this->input->post('dengansupir'),

        );
        $slug = $this->input->post('slug');
        $this->db->where('slug', $slug);
        $this->db->set($data);
        $this->db->update('mobil');
    }
}

/* End of file mobil_model.php */
/* Location: ./application/models/mobil_model.php */