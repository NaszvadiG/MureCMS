<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_SignIn extends CI_Model {
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
    $this->form_validation->set_rules('password', '密码', 'required|min_length[4]|max_length[20]');
    return $this->form_validation->run();
  }

  function CheckServer($u, $p)
  {
    // 表单验证成功后，开始数据库验证
    $data = array( 'username' => $u, 'password' => md5($p) );
    $query = $this->db->get_where('sys_user', array( 'UserName' => $data['username'] ));
    if($query->result()){
      foreach($query->result() as $row){
        $password = $row->PassWord;
        $realname = $row->RealName;
        $lastloginip = $row->LastLoginIP;
        $lastlogintime = $row->LastLoginTime;
        $id = $row->Id;
      }
      if($password == $data['password']){

        $ip = $_SERVER['REMOTE_ADDR'];
        $time = time();
        // 验证成功
        $this->session->set_userdata('user_info', array(
          'id' => $id,
          'user' => $u,
          'ip' => $ip,
          'realname' => $realname,
          'lastloginip' => $lastloginip,
          'lastlogintime'=> $lastlogintime
        ));

        $update_data = array( 'LastLoginIP' => $ip, 'LastLoginTime' => $time);
        $this->db->update('sys_user', $update_data, array('UserName'=>$data['username'], 'PassWord'=>$data['password'], ));

        redirect('admin/index');
      }else{
        // 密码错误
        $data['db_error'] = '用户名或密码错误!';$this->load->view('admin/signin', $data);
      }
    }else{
      // 用户名错误
      $data['db_error'] = '用户名或密码错误!';$this->load->view('admin/signin', $data);
    }
  }

  function Logout($i)
  {
    $this->session->sess_destroy();
    redirect('admin/index');
  }

}