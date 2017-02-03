<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_CheckLogin extends CI_Model {
  function __construct()
  {
      parent::__construct();
      $this->load->library('session');
  }

  function Check(){
    if(!$this->session->user_info){
      redirect('admin/signin');
    }
  }

}