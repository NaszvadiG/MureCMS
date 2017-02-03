<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontPages extends CI_Controller {

	public function __construct() {
    parent::__construct ();
		$this->load->database();
    $this->load->helper(array('form','url'));
		$this->load->library(array('session','breadcrumb'));
		//----------------------------------------------------------
		
	}

	public function GetPage($pageCate, $param){

		

		$site_config = $this->config->item('site_config');
		$datas_nav = $this->db->query("SELECT * FROM sys_navigation ORDER BY Position ASC;");
		$datas_pages = $this->db->query("SELECT * FROM sys_pages WHERE PageCate = '$pageCate' ORDER BY Position ASC;");
		$datas_pagesCate = $this->db->query("SELECT * FROM sys_pages_cate");

		if(empty($datas_pages->result())) show_404();

		$data = array_merge_recursive($site_config,
			array(
				'param' => $param,
				'pageCate' => $pageCate,
				'datas_nav' => $datas_nav,
				'datas_pages' => $datas_pages
			)
		);
		
		$data['pageContent'] = $datas_pages->result()[0]->PageContent;
		foreach($datas_pages->result() as $row){
			if(isset($param) && $param==$row->Id){
				$data['pageTitle'] = $row->PageTitle;
				$data['pageContent'] = $row->PageContent;
			}
		}

		foreach($datas_pagesCate->result() as $row){
			if($row->PageCate==$pageCate){
				$data['pageName'] = $row->PageName;
			}
		}

		return $data; 
	}
	
	public function index($pageCate='', $param='')
	{
		$data = $this->GetPage($pageCate, $param);

		$this->load->view('common/header', $data);
		$this->load->view('pages');
		$this->load->view('common/footer', $data);
	}




	
}
