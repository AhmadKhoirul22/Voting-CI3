<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilih extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')==Null){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Page of Pemilih';
		$this->db->from('voting');
		$data['voting'] = $this->db->get()->row();
		$this->db->from('ikut_kandidat');
		$this->db->join('voting','voting.id_voting = ikut_kandidat.id_voting','left');
		$this->db->join('kandidat','ikut_kandidat.id_kandidat = kandidat.id_kandidat','left');
		$data['ikt'] = $this->db->get()->result_array();
		
		$this->load->view('admin/pemilih',$data);
	}

	public function tambah(){
		date_default_timezone_set("Asia/Jakarta");
        $waktu = date('Y-m-d H:i:s');

		$id_voting = $this->input->post('id_voting');
		$id_admin = $this->session->userdata('id_admin');

		$id_kandidat = $this->input->post('id_kandidat');


		$this->db->from('ikut_kandidat')->where('id_kandidat',$id_kandidat);
		$poin = $this->db->get()->row()->poin;
		$poin_tambah = $poin + 1;
		// var_dump($poin_tambah);
		// die;
		$data2 = array(
			'poin' => $poin_tambah,
		);
		$where = array(
			'id_kandidat' => $id_kandidat,
		);
		$this->db->update('ikut_kandidat',$data2,$where);
		$data = array(
			'id_voting' => $id_voting,
			'id_admin' => $id_admin,
			'waktu' => $waktu,
		);
		$this->db->insert('ikut',$data);
		$this->session->set_flashdata('notifikasi','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menambahkan Data Admin
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/pemilih/sudah_memilih');
	}

	public function sudah_memilih(){
		$data['title'] = 'Pemilih';
		$this->load->view('admin/sudah_milih',$data);
	}
}
