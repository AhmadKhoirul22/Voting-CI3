<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index(){
		$this->load->view('auth');
	}

	public function login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$this->db->from('ikut');
		$this->db->join('admin','admin.id_admin = ikut.id_admin','left');
		$hai = $this->db->get()->result_array();

		$this->db->from('admin')->where('username',$username);
		$cek = $this->db->get()->row();
		if($cek == null){
			$this->session->set_flashdata('alert','<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Username Tidak ditemukan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
      	redirect('auth');
		} else if ($cek->password==$password){
			$data = array(
				'nama' => $cek->nama,
				'level' => $cek->level,
				'username' => $cek->username,
				'password' => $cek->password,
				'id_admin' => $cek->id_admin
			);
			$this->session->set_userdata($data);
			if($this->session->userdata('level')=='Admin'){
				redirect('admin/index');
			} else if ($this->session->userdata('level')=='Pemilih'){
				if (!empty($hai)) {
					foreach ($hai as $row) {
						if ($cek->id_admin == $row['id_admin']) {
							redirect('admin/pemilih/sudah_memilih');
						}
					}
				}
				redirect('admin/pemilih');
			}
			// redirect('admin/index');
		} else {
			$this->session->set_flashdata('alert','<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Password Salah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
      	redirect('auth');
		}

		
	}

	public function logout(){
		$this->session->Sess_destroy();
		redirect('auth');
	}
}
