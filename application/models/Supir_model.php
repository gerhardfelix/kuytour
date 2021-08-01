<?php

class Supir_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

	public function get_supir($slug = FALSE)
	{
		if ($slug === FALSE) 
		{
			$query = $this->db->get('supir');
			return $query->result_array();
		}

		$query = $this->db->get_where('supir', array('slug' => $slug));
		return $query->row_array();
	}

	public function set_supir()
	{
    	$this->load->helper('url');

    	$slug = url_title($this->input->post('no_sim'), 'dash', TRUE);

		$data = array(
    		'slug' => $slug,
    		'nama_supir' => $this->input->post('nama_supir'),
    		'no_sim' => $this->input->post('no_sim'),
    		'hp_supir' => $this->input->post('hp_supir')
		);

    	return $this->db->insert('supir', $data);
	}	

	public function delete_supir($slug)
	{
		$this->db->where('slug', $slug);
		$this->db->delete('supir');
	}

	public function edit_supir()
	{
		$data = array(
	        'nama_supir' => $this->input->post('nama_supir'),
    		'no_sim' => $this->input->post('no_sim'),
    		'hp_supir' => $this->input->post('hp_supir')
   		);
   		$slug = $this->input->post('slug');
    	$this->db->where('slug', $slug);
    	$this->db->set($data);
    	$this->db->update('supir');
	}
}

/* End of file supir_model.php */
/* Location: ./application/models/supir_model.php */