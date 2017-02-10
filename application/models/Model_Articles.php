<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Articles extends CI_Model {
  function __construct()
  {
      parent::__construct();
      $this->load->library(array('session','form_validation'));
      $this->load->database();
  }
  
  function GetCate($articleCate='')
  {
    $query = $this->db->query("SELECT * FROM sys_articles_cate WHERE isChild = 0 ORDER BY Position ASC");
    foreach($query->result() as $row){
      if(!empty($articleCate)){
        if($articleCate==$row->ArticleCate){
          $data = array(
            'result'=>$query->result(),
            'articleTitle'=>$row->ArticleTitle,
            'articleCate'=>$row->ArticleCate,
            'position'=>$row->Position,
            'id'=>$row->Id,
            'childList'=> array("")
          );
          foreach($data['result'] as $rowCate){
            $query_child = $this->db->query("SELECT * FROM sys_articles_cate WHERE isChild = 1 AND ArticleCate = '".$rowCate->ArticleCate."' ORDER BY Position ASC");
            array_push($data['childList'], $query_child->result());
          }
        }
      }else{
        if($row->Position==1){
          $data = array(
            'result'=>$query->result(),
            'articleTitle'=>$row->ArticleTitle,
            'articleCate'=>$row->ArticleCate,
            'position'=>$row->Position,
            'id'=>$row->Id,
            'childList'=> array("")
          );
          foreach($data['result'] as $rowCate){
            $query_child = $this->db->query("SELECT * FROM sys_articles_cate WHERE isChild = 1 AND ArticleCate = '".$rowCate->ArticleCate."' ORDER BY Position ASC");
            array_push($data['childList'], $query_child->result());
          }
        }
      }
    }
    return $data;
  }

  function GetList($articleCate='', $id='')
  {
    if(!empty($id)){
      $query = $this->db->query("SELECT * FROM sys_articles WHERE ArticleCate = '".$articleCate."' AND ArticleCateId = '".$id."' ORDER BY Position ASC;");
    }else{
      $query = $this->db->query("SELECT * FROM sys_articles WHERE ArticleCate = '".$articleCate."' ORDER BY Position ASC;");
    }
    return $query->result();
  }

  function GetDetail($articleCate='', $id, $articleId){
    if(!empty($articleId)){
      $query = $this->db->query("SELECT * FROM sys_articles WHERE ArticleCate = '".$articleCate."' AND ArticleCateId = '". $id ."' AND Id = '".$articleId."' ORDER BY Position ASC;");
    }else{
      $query = $this->db->query("SELECT * FROM sys_articles WHERE ArticleCate = '".$articleCate."' AND Id = '". $id ."' ORDER BY Position ASC;");
    }
    return $query->result();
  }


  function AddRules(){
    // 表单验证规则
    $this->form_validation->set_rules('title', '标题', 'required');
    $this->form_validation->set_rules('content', '内容', 'required');
    return $this->form_validation->run();
  }

  function Add($data){
    $this->db->insert('sys_articles', $data);
    if($this->db->affected_rows()!=0){
      $this->session->set_flashdata('state', '<div class="alert alert-success mb10" role="alert">添加成功!</div>');
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    redirect('admin/articles/'.$data['ArticleCate']);
  }

  function Update($data){

    var_dump($data);
    
    // $data_before = $this->db->get_where('sys_articles', array( 'Id'=>$data['Id'] ))->result_array()[0];
    // if(count(array_diff($data_before, $data))!=0 || count(array_diff($data_before, $data))!=0){
      
    //   $this->db->update('sys_pages', $data, array( 'Id' => $data['Id'] ));
    //   if($this->db->affected_rows()!=0){
    //     $this->session->set_flashdata('state', '<div class="alert alert-success fade in mb10" role="alert">'.
    //       '修改成功!'.
    //       '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
    //         '<span aria-hidden="true">&times;</span>'.
    //       '</button>'.
    //     '</div>'
    //     );
    //   }else{
    //     $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">数据库操作失败!</div>'.$this->db->affected_rows());
    //   }
    //   // echo '有改';
    // }
    // redirect('admin/pages/'.$data['PageCate']);
    // return false;

  }


  // function AddCateRules($bool=false){
  //   // 分类 表单验证规则
  //   $this->form_validation->set_rules('pageName', '分类名称', 'required');
  //   if(!$bool){
  //     $this->form_validation->set_rules('pageCate', '分类路径名称', 'required');
  //   }
  //   return $this->form_validation->run();
  // }

  // function AddCate($data){
  //   $this->db->insert('sys_pages_cate', $data);
  //   if($this->db->affected_rows()!=0){
  //     $this->session->set_flashdata('state', '<div class="alert alert-success mb10" role="alert">添加成功!</div>');
  //   }else{
  //     $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
  //   }
  //   redirect('admin/pages');
  // }

  

  // function UpdateCate($data){

  //   $data_before = $this->db->get_where('sys_pages_cate', array( 'Id'=>$data['Id'] ))->result_array()[0];

  //   if(count(array_diff($data_before, $data))!=0 || count(array_diff($data, $data_before))!=0){
      
  //     $this->db->update('sys_pages_cate', $data, array( 'Id' => $data['Id'] ));
  //     if($this->db->affected_rows()!=0){
  //       $this->session->set_flashdata('state', '<div class="alert alert-success fade in mb10" role="alert">'.
  //         '修改成功!'.
  //         '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  //           '<span aria-hidden="true">&times;</span>'.
  //         '</button>'.
  //       '</div>'
  //       );
  //     }else{
  //       $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">数据库操作失败!</div>'.$this->db->affected_rows());
  //     }
  //     // echo '有改';

  //   }
    
  //   redirect('admin/pages/'.$data['PageCate']);
  //   return false;

  // }


}