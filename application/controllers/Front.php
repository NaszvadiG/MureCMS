<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct() {
    parent::__construct ();
		$this->load->database();
    $this->load->helper(array('form','url'));
		$this->load->library(array('session','breadcrumb'));
		//----------------------------------------------------------
		
	}

	public function config($p){
		$site_config = $this->config->item('site_config');
		$data = array_merge_recursive($site_config,
			array(
				'page' => $p,
				'datas_nav' => $this->db->query("SELECT * FROM sys_navigation ORDER BY Position ASC;")
			)
		);
		return $data;
	}

	
	public function index($p='首页')
	{
		$data = $this->config($p);
		$this->load->view('common/header', $data);
		$this->load->view('index');
		$this->load->view('common/footer', $data);
	}




	
}
