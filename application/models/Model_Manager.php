<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Manager extends CI_Model {
  function __construct()
  {
      parent::__construct();
      $this->load->library(array('session','form_validation'));
      $this->load->database();
  }

  function CheckLocal()
  {
    // 表单验证规则
    $this->form_validation->set_rules('username', '用户名', 'required|min_length[4]|max_length[12]');
    $this->form_validation->set_rules('password', '密码', 'required|min_length[4]|max_length[20]|matches[passconf]');
    $this->form_validation->set_rules('passconf', '确认密码', 'required|min_length[4]|max_length[20]');
    return $this->form_validation->run();
  }
  
  function CheckServer($u)
  {
    // 表单验证成功后，开始数据库验证
    $data = array( 'username' => $u );
    $query = $this->db->get_where('sys_user', array( 'UserName' => $data['username'] ));
    
    if(count($query->result())==0){ //不存在用户名，可以使用

      $data = array(
        'UserName' => $_POST['username'],
        'PassWord' => md5($_POST['password']),
        'RealName' => $_POST['realname'],
        'UserType' => 'normal'
      );
      $this->db->insert('sys_user', $data);
      if($this->db->affected_rows()!=0){
        $this->session->set_flashdata('state', '<div class="alert alert-success mt10" role="alert">添加成功!</div>');
      }else{
        $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">数据库操作失败!</div>');
      }
      redirect('admin/manager');
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">用户名已存在!</div>');
      redirect('admin/manager/add');
    }

  }

}