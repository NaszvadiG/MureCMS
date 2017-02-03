<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Navigation extends CI_Model {
  function __construct()
  {
      parent::__construct();
      $this->load->library(array('session','form_validation'));
      $this->load->database();
  }
  
  function Update()
  {
      $data_before = $this->db->get_where('sys_navigation', array( 'Id'=>$_POST['id'] ))->result_array()[0];

      $data = array(
        'Id' => $_POST['id'],
        'Title' => $_POST['title'],
        'Type' => $_POST['type'],
        'Link' => $_POST['link'],
        'Position' => $_POST['position']
      );

      if(count(array_diff($data_before, $data))!=0 || count(array_diff($data, $data_before))!=0){
        
        $this->db->update('sys_navigation', $data, array( 'Id' => $_POST['id'] ));
        if($this->db->affected_rows()!=0){
          
          // 删除IsAdd
          $isAdd_Off = array( 'IsAdd' => 0 );
          $this->db->update('sys_pages_cate', $isAdd_Off, array( 'PageName' => $data_before['Title']));
          // 添加IsAdd
          $isAdd_On = array( 'IsAdd' => 1 );
          $this->db->update('sys_pages_cate', $isAdd_On, array( 'PageName' => $_POST['title'] ));

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
        redirect('admin/navigation');

      }else{
        redirect('admin/navigation');
      }

  }

}