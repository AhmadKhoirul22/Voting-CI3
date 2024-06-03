<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')<>'Admin'){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Page of User';
		$this->db->from('admin');
		$data['admin'] = $this->db->get()->result_array();
		$this->load->view('admin/user',$data);
	}
	public function tambah(){
		$this->db->from('admin');
        $this->db->where('username',$this->input->post('username'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert','<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Username Sudah Digunakan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
      	redirect('admin/user');
        }

		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'level' => $this->input->post('level'),
			'password' => md5($this->input->post('username')),
		); 
		$this->db->insert('admin',$data);
		$this->session->set_flashdata('notifikasi','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menambahkan Data Admin
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/user');
	}

	public function update(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'level' => $this->input->post('level'),
			'password' => md5($this->input->post('password')),
		);
		$where = array(
			'id_admin' => $this->input->post('id_admin')
		);

		// var_dump($data);
		// die;
		$this->db->update('admin',$data,$where);
		$this->session->set_flashdata('notifikasi','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Mengupdate Data Admin
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/user');
	}

	public function delete($id){
		$data = array(
			'id_admin' => $id
		);
		$this->db->delete('admin',$data);
		$this->session->set_flashdata('notifikasi','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menghapus Data Admin
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/user');
	}
}
