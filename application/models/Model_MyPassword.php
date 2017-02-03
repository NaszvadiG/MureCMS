<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_MyPassword extends CI_Model {
  function __construct()
  {
      parent::__construct();
      $this->load->library(array('session','form_validation'));
      $this->load->database();
  }

  function CheckLocal()
  {
    // 表单验证规则
    $this->form_validation->set_message('differs', '{field} 和 {param} 不能相同');
    $this->form_validation->set_rules('oldpassword', '旧密码', 'required|min_length[4]|max_length[20]|differs[newpassword]');
    $this->form_validation->set_rules('newpassword', '新密码', 'required|min_length[4]|max_length[20]|matches[passconf]');
    $this->form_validation->set_rules('passconf', '确认密码', 'required|min_length[4]|max_length[20]');
    return $this->form_validation->run();
  }
  
  function ChangePassword($u)
  {
      $data = array( 'username' => $u );
      $query = $this->db->get_where('sys_user', array( 'UserName' => $data['username'] ));

      foreach($query->result() as $row){
        if($row->PassWord==md5($_POST['oldpassword'])){
          $data = array(
            'PassWord' => md5($_POST['newpassword']),
          );
          $this->db->update('sys_user', $data);
          if($this->db->affected_rows()!=0){
            $this->session->set_flashdata('state',
            '<div class="alert alert-success mt10" role="alert">修改成功! 需要重新登录 <span id="alert-time"></span></div>'.
            '<script>'.
              'var n = 3;'.
              'var timeElement = document.getElementById("alert-time");'.
              'timeElement.innerHTML = n;'.
              'var timer = setInterval(function(){'.
                'n--;'.
                'if(n <= 0){'.
                  'clearInterval();window.location.href = "/admin/logout";'.
                '}'.
                'timeElement.innerHTML = n'.
              '},1000);'.
            '</script>'
            );
          }else{
            $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">数据库操作失败!</div>'.$this->db->affected_rows());
          }
        }else{
          $this->session->set_flashdata('state', '<div class="alert alert-danger mt10" role="alert">原密码不正确!</div>');
        }
      }
      redirect('admin/password');
  }

}