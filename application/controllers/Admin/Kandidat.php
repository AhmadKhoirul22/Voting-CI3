<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandidat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')<>'Admin'){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Page of Kandidat';
		$this->db->from('kandidat');
		$data['kandidat'] = $this->db->get()->result_array();
		$this->load->view('admin/kandidat',$data);
	}

	public function tambah(){
        // foto
        $namafoto = date('YmdHis').'.jpg';
        $config['upload_path']          = 'assets/upload/';
        $config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['allowed_types']        = '*';
        $config['file_name']            = $namafoto;
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024){
            $this->session->set_flashdata('notifikasi', '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            ukuran file lebih dari 500kb ulangi upload dengan ukuran foto kurang dari 500kb
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
                    ');
            redirect('admin/carousel');  
        }  elseif(!$this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
        } 
        // foto
        $data = array(
            'nama_kandidat' => $this->input->post('nama_kandidat'),
            'keterangan' => $this->input->post('keterangan'),
            'foto' => $namafoto,
        );
        $this->db->insert('kandidat',$data);
        $this->session->set_flashdata('notifikasi','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
         berhasil menambahkan kandidat
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
      redirect('admin/kandidat');
    }

	public function delete($id){
        $filename=FCPATH.'/assets/upload/'.$id;
        if(file_exists($filename)){
            unlink("./assets/upload/".$id);
        }
        $where = array(
                'foto' => $id
                );
            $this->db->delete('kandidat', $where);
            $this->session->set_flashdata('notifikasi','<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            berhasil menghapus kandidat
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('admin/kandidat');
    }

	public function update(){
        $namafoto = $this->input->post('nama_foto');
        $config['upload_path']          = 'assets/upload/';
        $config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['file_name']            = $namafoto;
        $config['overwrite']            = true;
        $config['allowed_types']        = '*';  
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024){
            $this->session->set_flashdata('alert', '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            ukuran file lebih dari 500kb ulangi upload dengan ukuran foto kurang dari 500kb
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
                    ');
        } elseif( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
        } 
        $data = array(
            'nama_kandidat' => $this->input->post('nama_kandidat'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $where = array(
            'foto' => $this->input->post('nama_foto')
        );
        $this->db->update('kandidat',$data, $where);

		$this->session->set_flashdata('notifikasi','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
         berhasil mengupdate carousel
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/kandidat');
    }
}
