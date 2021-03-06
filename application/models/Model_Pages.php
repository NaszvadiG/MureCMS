<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Pages extends CI_Model {
  function __construct()
  {
      parent::__construct();
      $this->load->library(array('session','form_validation'));
      $this->load->database();
  }
  
  function GetCate($pageCate='')
  {
    $query = $this->db->query("SELECT * FROM sys_pages_cate ORDER BY Position ASC");
    foreach($query->result() as $row){

      if(!empty($pageCate)){
        if($pageCate==$row->PageCate){
          $data = array(
            'result'=>$query->result(),
            'pageName'=>$row->PageName,
            'pageCate'=>$row->PageCate,
            'position'=>$row->Position,
            'id'=>$row->Id
          );
        }
      }else{
        if($row->Position==1){
          $data = array(
            'result'=>$query->result(),
            'pageName'=>$row->PageName,
            'pageCate'=>$row->PageCate,
            'position'=>$row->Position,
            'id'=>$row->Id
          );
        }
      }


    }
    return $data;
  }

  function GetList($pageCate='')
  {
    $query = $this->db->query("SELECT * FROM sys_pages WHERE PageCate = '".$pageCate."' ORDER BY Position ASC;");
    return $query->result();
  }

  function GetPage($pageCate, $id){
    $query = $this->db->query("SELECT * FROM sys_pages WHERE PageCate = '".$pageCate."' AND Id = ".$id." ORDER BY Position ASC;");
    return $query->result();
  }


  function AddRules(){
    // 表单验证规则
    $this->form_validation->set_rules('title', '标题', 'required');
    $this->form_validation->set_rules('content', '内容', 'required');
    return $this->form_validation->run();
  }

  function AddCateRules($bool=false){
    // 分类 表单验证规则
    $this->form_validation->set_rules('pageName', '分类名称', 'required');
    if(!$bool){
      $this->form_validation->set_rules('pageCate', '分类路径名称', 'required');
    }
    return $this->form_validation->run();
  }

  function Add($data){
    $this->db->insert('sys_pages', $data);
    if($this->db->affected_rows()!=0){
      $this->session->set_flashdata('state', '<div class="alert alert-success mb10" role="alert">添加成功!</div>');
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    redirect('admin/pages/'.$data['PageCate']);
  }

  function AddCate($data){
    $this->db->insert('sys_pages_cate', $data);
    if($this->db->affected_rows()!=0){
      $this->session->set_flashdata('state', '<div class="alert alert-success mb10" role="alert">添加成功!</div>');
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    redirect('admin/pages');
  }

  function Update($data){

    $data_before = $this->db->get_where('sys_pages', array( 'Id'=>$data['Id'] ))->result_array()[0];
    if(count(array_diff($data_before, $data))!=0 || count(array_diff($data_before, $data))!=0){
      
      $this->db->update('sys_pages', $data, array( 'Id' => $data['Id'] ));
      if($this->db->affected_rows()!=0){
        $this->session->set_flashdata('state', '<div class="alert alert-success fade in mb10" role="alert">'.
          '修改成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
        );
      }else{
        $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">数据库操作失败!</div>'.$this->db->affected_rows());
      }
      // echo '有改';
    }
    redirect('admin/pages/'.$data['PageCate']);
    return false;

  }

  function UpdateCate($data){

    $data_before = $this->db->get_where('sys_pages_cate', array( 'Id'=>$data['Id'] ))->result_array()[0];

    if(count(array_diff($data_before, $data))!=0 || count(array_diff($data, $data_before))!=0){
      
      $this->db->update('sys_pages_cate', $data, array( 'Id' => $data['Id'] ));
      if($this->db->affected_rows()!=0){
        $this->session->set_flashdata('state', '<div class="alert alert-success fade in mb10" role="alert">'.
          '修改成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
        );
      }else{
        $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">数据库操作失败!</div>'.$this->db->affected_rows());
      }
      // echo '有改';

    }
    
    redirect('admin/pages/'.$data['PageCate']);
    return false;

  }


}