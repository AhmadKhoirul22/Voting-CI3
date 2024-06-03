<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')<>'Admin'){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Page of Admin';
		$this->load->view('admin/index',$data);
	}
}
