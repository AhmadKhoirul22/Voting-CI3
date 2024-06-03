<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')<>'Admin'){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Page of Voting';
		$this->db->from('kandidat');
		$data['kandidat'] = $this->db->get()->result_array();
		$this->db->from('voting');

		$data['voting'] = $this->db->get()->row();
		$this->db->from('ikut_kandidat');

		$this->db->join('voting','voting.id_voting = ikut_kandidat.id_voting','left');
		$this->db->join('kandidat','ikut_kandidat.id_kandidat = kandidat.id_kandidat','left');
		$data['ikt'] = $this->db->get()->result_array();
	
		$this->load->view('admin/voting',$data);
	}

	public function tambah(){
		$voting = $this->input->post('voting');
		$kandidat = $this->input->post('kandidat[]');

		$data = array('nama_voting' => $voting);
		$this->db->insert('voting',$data);

		$id_voting = $this->db->insert_id();
		foreach($kandidat as $k){
			$ikut_kandidat = ['id_voting' => $id_voting, 'id_kandidat' => $k];
			$this->db->insert('ikut_kandidat',$ikut_kandidat);
		}
		$this->session->set_flashdata('notifikasi','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menambahkan Data Voting
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/voting');
	}

	public function update(){
		$data = array(
			'nama_voting' => $this->input->post('nama_voting'),
		);
		$where = array(
			'id_voting' => $this->input->post('id_voting'),
		);
		$this->db->update('voting',$data,$where);
		$this->session->set_flashdata('notifikasi','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Mengupdate Data Voting
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/voting');
	}

	public function delete($id){
		$this->db->where('id_voting', $id);
        $this->db->delete('ikut_kandidat');

        // Hapus data dari tabel ikut
        $this->db->where('id_voting', $id);
        $this->db->delete('ikut');

        // Hapus data dari tabel voting
        $this->db->where('id_voting', $id);
        $this->db->delete('voting');

		$this->session->set_flashdata('notifikasi','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menghapus Data Voting
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/voting');
	}
}
