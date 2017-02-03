<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticlePages extends CI_Controller {

	public function __construct() {
    parent::__construct ();
		$this->load->database();
    $this->load->helper(array('form','url'));
		$this->load->library(array('session','breadcrumb'));
		
	}

	public function GetArticle($articleCate, $id=''){

		$site_config = $this->config->item('site_config');
		$datas_nav = $this->db->query("SELECT * FROM sys_navigation ORDER BY Position ASC;");
		
		$this->load->model('Model_Articles');
    $datas_articleCate = $this->Model_Articles->GetCate($articleCate);
    $datas_articles = $this->Model_Articles->GetList($datas_articleCate['articleCate'], $id);
    
    $data = array_merge_recursive($site_config,
			array(
				'id' => $id,
				'datas_nav' => $datas_nav,
				'currentNav' => 'articles',
				'breadcrumb' => $this->breadcrumb->output(),
				'articleCate' => $datas_articleCate['articleCate'],
				'articleName' => $datas_articleCate['articleTitle'],
				'datas_articleCate' => $datas_articleCate,
				'datas_articles' => $datas_articles
			));

    if(!empty($id)){
      foreach($datas_articles as $row){
        if($id == $row->ArticleCateId){ $data['articleChildName'] = $row->ArticleCateName;break; }
      }
    }
		return $data; 
	}

	
	public function index($articleCate='', $param='')
	{
		$data = $this->GetArticle($articleCate, $param);

		$this->load->view('common/header', $data);
		$this->load->view('articles');
		$this->load->view('common/footer', $data);
	}
	
}
