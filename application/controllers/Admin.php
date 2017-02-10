<?php
class Admin extends CI_Controller {

  // 文档
  // http://codeigniter.org.cn/user_guide

  public function __construct() {
    parent::__construct ();
    date_default_timezone_set('PRC');
    $this->load->database();
    $this->load->helper(array('form','url'));
    $this->load->library(array('session','breadcrumb'));
    //-------------------------------------------------------------
    $this->breadcrumb->change_link(''); //&nbsp;&frasl;&nbsp;
    $this->load->model('Model_CheckLogin');
  }

  public function signin($title='后台-登录')
  {
    
    if($this->session->user_info) redirect('admin/index');
    $data['title'] = $title;
    $this->load->view('admin/signin', $data);
  }
  public function signinPost($title='后台-登录')
  {
    $this->load->model('Model_SignIn');
    $this->session->set_userdata('user_info');
    if ($this->Model_SignIn->CheckLocal() == FALSE){ // 本地验证
      $this->signin();
    }else{
      $this->Model_SignIn->CheckServer($_POST['username'],$_POST['password']); // 服务器验证
    }
  }


  public function logout(){ $this->load->model('Model_SignIn');$this->Model_SignIn->Logout();}

  /*---------------------------- 首页 Start -------------------------------*/
  public function index($title='首页')
  {
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb($title);

    $data = array(
      'title' => $title,
      'currentNav' => 'index',
      'breadcrumb' => $this->breadcrumb->output()
    );

    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('admin/common/footer', $data);
  }

  /*---------------------------- 导航 Start -------------------------------*/
  // 查询 导航列表
  public function navigation($title='主导航')
  {
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb($title);

    $data = array(
      'title' => $title,
      'currentNav' => 'navigation',
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_nav' => $this->db->query("SELECT * FROM sys_navigation ORDER BY Position ASC;"),
      'hasPagesCate'=> $this->db->query("SELECT * FROM sys_pages_cate WHERE IsAdd=0;"),
      'datas_navType' => array(
        '1' => '跳转链接','2' => '内容单页','3' => '资讯页'
      )
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/navigation', $data);
    $this->load->view('admin/common/footer', $data);
    
  }


  // 修改 导航列表
  public function navigationEditView($id)
  {
    $title = '修改';
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb('主导航',base_url('admin/navigation'));
    $this->breadcrumb->add_crumb($title);

    $query_nav = $this->db->query("SELECT * FROM sys_navigation WHERE Id = '$id'  ;");
    $data = array(
      'id' => $id,
      'title' => $title,
      'currentNav' => 'navigation',
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_navigation' => $query_nav,
      'datas_pages_cate' => $this->db->query("SELECT * FROM sys_pages_cate WHERE IsAdd=0 OR PageName='". $query_nav->result()[0]->Title ."';")
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/navigationEdit', $data);
    $this->load->view('admin/common/footer', $data);
  }
  public function navigationEdit()
  {
    $this->load->model('Model_Navigation');
    $this->Model_Navigation->Update();
  }


  // 删除 导航
  public function navigationDelete($id){

    // 删除IsAdd
    $isAdd_Off = array( 'IsAdd' => 0 );
    $temp_res = $this->db->query('SELECT * FROM sys_navigation WHERE Id='.$id)->result()[0];
    $this->db->update('sys_pages_cate', $isAdd_Off, array( 'PageName' => $temp_res->Title));


    $this->db->where('Id',$id);
    $this->db->delete('sys_navigation');
    if($this->db->affected_rows()!=0){

      $this->session->set_flashdata('state',
        '<div class="alert alert-success fade in mb10" role="alert">'.
          '删除成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
      );
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    redirect('admin/navigation');
  }

  // 添加 导航
  public function navigationAdd(){

    $data = array(
      'Title' => $_POST['title'],
      'Type' => $_POST['type'],
      'Link' => $_POST['link'],
      'Position' => $_POST['position']
    );
    $this->db->insert('sys_navigation',$data);

    if($this->db->affected_rows()!=0){

      // 添加IsAdd
      $isAdd_On = array( 'IsAdd' => 1 );
      $this->db->update('sys_pages_cate', $isAdd_On, array( 'PageName' => $_POST['title'] ));

      $this->session->set_flashdata('state',
        '<div class="alert alert-success fade in mb10" role="alert">'.
          '添加成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
      );
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    redirect('admin/navigation');
  }

  /*---------------------------- 管理员账号 Start -------------------------------*/
  public function manager($title='管理员账号'){
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb($title);
    $data = array(
      'title' => $title,
      'currentNav' => $this->uri->segment(2, 0),
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_manager' => $this->db->query("SELECT * FROM sys_user WHERE UserType = 'normal'"),
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/manager', $data);
    $this->load->view('admin/common/footer', $data);
  }

  public function managerAddView($title='添加子账号'){
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb('管理员子账号',base_url('admin/manager'));
    $this->breadcrumb->add_crumb($title);

    $data = array(
      'title' => $title,
      'currentNav' => 'manager',
      'breadcrumb' => $this->breadcrumb->output()
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/managerAdd', $data);
    $this->load->view('admin/common/footer', $data);
  }
  // 添加 管理员 POST
  public function managerAdd(){
    $this->load->model('Model_Manager');
    if ($this->Model_Manager->CheckLocal() == FALSE){ // 本地验证
      $this->managerAddView();
    }else{
      $this->Model_Manager->CheckServer($_POST['username']);
    }
  }

  public function password($title='修改密码'){
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb($title);

    $user = $this->session->user_info['user'];
    $data = array(
      'title' => $title,
      'currentNav' => 'password',
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_user' => $this->db->query("SELECT * FROM sys_user WHERE UserName = '$user';"),
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/editPassword', $data);
    $this->load->view('admin/common/footer', $data);
  }

  // 修改 自身密码 POST
  public function passwordEdit(){
    $this->load->model('Model_MyPassword');
    if ($this->Model_MyPassword->CheckLocal() == FALSE){ // 本地验证
      $this->password();
    }else{
      $this->Model_MyPassword->ChangePassword($this->session->user_info['user']);
    }
  }
  
  // 删除 管理员
  public function managerDelete($id){
    $this->db->where('Id',$id);
    $this->db->delete('sys_user');
    if($this->db->affected_rows()!=0){
      $this->session->set_flashdata('state',
        '<div class="alert alert-success fade in mb10" role="alert">'.
          '删除成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
      );
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    redirect('admin/manager');
  }
  

  /*---------------------------- 资讯管理 Start -------------------------------*/
  // 不带参数
  public function articles($title='资讯管理'){
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb($title);

    $this->load->model('Model_Articles');
    $datas_articleCate = $this->Model_Articles->GetCate();
    $datas_articles = $this->Model_Articles->GetList($datas_articleCate['articleCate']);

    $data = array(
      'title' => $title,
      'id' => '',
      'currentNav' => 'articles',
      'breadcrumb' => $this->breadcrumb->output(),
      'articleCate' => $datas_articleCate['articleCate'],
      'articleName' => $datas_articleCate['articleTitle'],
      'datas_articleCate' => $datas_articleCate,
      'datas_articles' => $datas_articles
    );

    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/articles', $data);
    $this->load->view('admin/common/footer', $data);
  }
  // 带参数
  public function articlesList($articleCate, $id=''){

    $title = '资讯管理';
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb($title);

    $this->load->model('Model_Articles');
    $datas_articleCate = $this->Model_Articles->GetCate($articleCate);
    $datas_articles = $this->Model_Articles->GetList($datas_articleCate['articleCate'], $id);
    
    $data = array(
      'title' => $title,
      'id' => $id,
      'currentNav' => 'articles',
      'breadcrumb' => $this->breadcrumb->output(),
      'articleCate' => $datas_articleCate['articleCate'],
      'articleName' => $datas_articleCate['articleTitle'],
      'datas_articleCate' => $datas_articleCate,
      'datas_articles' => $datas_articles
    );

    if(!empty($id)){
      foreach($datas_articles as $row){
        if($id == $row->ArticleCateId){ $data['articleChildName'] = $row->ArticleCateName;break; }
      }
    }

    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/articles', $data);
    $this->load->view('admin/common/footer', $data);
  }

  // 添加 资讯管理
  public function articlesAddView($articleCate="news", $id=''){

    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页', base_url('admin/index'));
    $this->breadcrumb->add_crumb('资讯管理', base_url('admin/articles'));
    $this->breadcrumb->add_crumb('添加资讯');

    $this->load->model('Model_Articles');
    $datas_articleCate = $this->Model_Articles->GetCate($articleCate);
    $datas_articles = $this->Model_Articles->GetList($datas_articleCate['articleCate'], $id);

    $data = array(
      'title' => '资讯管理',
      'id' => $id,
      'currentNav' => 'articles',
      'breadcrumb' => $this->breadcrumb->output(),
      'articleCate' => $datas_articleCate['articleCate'],
      'articleName' => $datas_articleCate['articleTitle'],
      'datas_articleCate' => $datas_articleCate,
      'datas_articles' => $datas_articles
    );

    if(!empty($id)){
      foreach($datas_articles as $row){
        if($id == $row->ArticleCateId){ $data['articleChildName'] = $row->ArticleCateName;break; }
      }
    }

    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/articlesAdd', $data);
    $this->load->view('admin/common/footer', $data);
  }

  public function articlesAdd($cate, $id=''){
    $this->load->model('Model_Articles');
    if ($this->Model_Articles->AddRules() == FALSE){ // 本地验证
      $this->articlesAddView($cate);
    }else{
      if(empty($id)){
        $data = array(
          'ArticleCate'=>$cate,
          'ArticleCateId'=>$_POST['articleCateId'],
          'ArticleCateName'=>$_POST['articleCateName'],
          'ArticleTitle'=>$_POST['title'],
          'ArticleContent'=>$_POST['content'],
          'Position'=>$_POST['position']
        );
      }else{
        $data = array(
          'ArticleCate'=>$cate,
          'ArticleCateId'=>$id,
          'ArticleCateName'=>$_POST['articleCateName'],
          'ArticleTitle'=>$_POST['title'],
          'ArticleContent'=>$_POST['content'],
          'Position'=>$_POST['position']
        );
      }
      $this->Model_Articles->Add($data);
    }
  }

  // 删除 资讯页
  public function articleDelete($id, $cate, $cateChild){
    $this->db->where('Id',$id);
    $this->db->delete('sys_articles');
    if($this->db->affected_rows()!=0){
      $this->session->set_flashdata('state',
        '<div class="alert alert-success fade in mb10" role="alert">'.
          '删除成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
      );
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    if(isset($cate)){
      if(isset($cate)){
        redirect('admin/articles/'.$cate.'/'.$cateChild);
      }else{
        redirect('admin/articles/'.$cate);
      }
    }else{
      redirect('admin/articles');
    }
  }



  // 修改 资讯页
  public function articlesEditView($articleCate, $id, $articleId)
  {
    $title = '修改';
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb('内容单页管理',base_url('admin/pages'));
    $this->breadcrumb->add_crumb($title);

    $this->load->model('Model_Articles');
    $datas_articleCate = $this->Model_Articles->GetCate($articleCate);
    $datas_articles = $this->Model_Articles->GetList($datas_articleCate['articleCate']);

    $data = array(
      'title' => $title,
      'id' => $id,
      'currentNav' => 'articles',
      'breadcrumb' => $this->breadcrumb->output(),
      'articleCate' => $datas_articleCate['articleCate'],
      'articleName' => $datas_articleCate['articleTitle'],
      'datas_articleCate' => $datas_articleCate,
      'datas_articles' => $datas_articles
    );
    // var_dump($datas_articleCate); return false;
    
    if(!empty($id)){
      foreach($datas_articles as $row){
        if($id == $row->ArticleCateId){ $data['articleChildName'] = $row->ArticleCateName;break; }
      }
    }


    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/articlesEdit', $data);
    $this->load->view('admin/common/footer', $data);
  }




  /*---------------------------- 内容单页管理 Start -------------------------------*/
  // 不带参数
  public function pages($title='内容单页管理'){
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb($title);

    $this->load->model('Model_Pages');
    $datas_pagesCate = $this->Model_Pages->GetCate();
    $datas_pages = $this->Model_Pages->GetList($datas_pagesCate['pageCate']);

    $data = array(
      'title' => $title,
      'currentNav' => 'pages',
      'pageCate' => $datas_pagesCate['pageCate'],
      'pageName' => $datas_pagesCate['pageName'],
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_pagesCate' => $datas_pagesCate,
      'datas_pages' => $datas_pages
    );

    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/pages', $data);
    $this->load->view('admin/common/footer', $data);
  }

  // 带参数（about、content）
  public function pagesList($pageCate){
    $title = '内容单页管理';
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb($title);

    $this->load->model('Model_Pages');
    $datas_pagesCate = $this->Model_Pages->GetCate($pageCate);
    $datas_pages = $this->Model_Pages->GetList($pageCate);

    $data = array(
      'title' => $title,
      'currentNav' => 'pages',
      'pageCate' => $pageCate,
      'pageName' => $datas_pagesCate['pageName'],
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_pagesCate' => $datas_pagesCate,
      'datas_pages' => $datas_pages
    );

    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/pages', $data);
    $this->load->view('admin/common/footer', $data);
  }

  public function getPagesCate(){ //JSON
    header("Content-type: application/json");
    $allCate = $this->db->query("SELECT * FROM sys_pages_cate WHERE IsAdd=0;");
    echo json_encode($allCate->result());
  }

  // 删除 内容单页
  public function pageDelete($id, $cate){
    $this->db->where('Id',$id);
    $this->db->delete('sys_pages');
    if($this->db->affected_rows()!=0){
      $this->session->set_flashdata('state',
        '<div class="alert alert-success fade in mb10" role="alert">'.
          '删除成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
      );
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }
    isset($cate) ? redirect('admin/pages/'.$cate) : redirect('admin/pages');
  }

  // 添加 内容单页
  public function pagesAddCateView(){
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页', base_url('admin/index'));
    $this->breadcrumb->add_crumb('内容单页管理', base_url('admin/pages'));
    $this->breadcrumb->add_crumb('添加单页分类');

    $this->load->model('Model_Pages');
    $datas_pagesCate = $this->Model_Pages->GetCate();
    $data = array(
      'title' => '内容单页管理',
      'currentNav' => 'pages',
      'pageCate' => '',
      'pageName' => $datas_pagesCate['pageName'],
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_pagesCate' => $datas_pagesCate
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/pagesAddCate', $data);
    $this->load->view('admin/common/footer', $data);
  }

  public function pagesAddCate(){
    $this->load->model('Model_Pages');
    if ($this->Model_Pages->AddCateRules() == FALSE){ // 本地验证
      $this->pagesAddCateView();
    }else{
      $data = array(
        'PageCate'=>$_POST['pageCate'],
        'PageName'=>$_POST['pageName'],
        'Position'=>$_POST['position']
      );
      $this->Model_Pages->AddCate($data);
    }
  }

  // 修改 单页分类
  public function pagesEditCateView($pageCate)
  {
    $title = '修改分类';
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb('内容单页管理',base_url('admin/pages'));
    $this->breadcrumb->add_crumb($title);

    $this->load->model('Model_Pages');
    $datas_pagesCate = $this->Model_Pages->GetCate($pageCate);

    $data = array(
      'title' => '内容单页管理',
      'currentNav' => 'pages',
      'pageCate' => $pageCate,
      'pageName' => $datas_pagesCate['pageName'],
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_pagesCate' => $datas_pagesCate
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/pagesEditCate', $data);
    $this->load->view('admin/common/footer', $data);
  }

  public function pagesEditCate($id, $cate){
    $this->load->model('Model_Pages');
    if ($this->Model_Pages->AddCateRules(true) == FALSE){ // 本地验证
      $this->pagesEditCateView($cate);
    }else{
      $data = array(
        'Id'=>$id,
        'Position'=>$_POST['position'],
        'PageCate'=>$cate,
        'PageName'=>$_POST['pageName']
      );
      
      $this->Model_Pages->UpdateCate($data);
    }
  }

  // 删除 单页分类
  public function pageDeleteCate($id, $cate){

    $this->load->model('Model_Pages');
    $datas_pages = $this->Model_Pages->GetList($cate);
    if(count($datas_pages)!=0){
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">删除分类必须先清空分类下的内容!</div>');
      redirect('admin/pages/'.$cate);
      return false;
    }

    $this->db->where('Id',$id);
    $this->db->delete('sys_pages_cate');
    
    if($this->db->affected_rows()!=0){
      $this->session->set_flashdata('state',
        '<div class="alert alert-success fade in mb10" role="alert">'.
          '删除成功!'.
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span>'.
          '</button>'.
        '</div>'
      );
    }else{
      $this->session->set_flashdata('state', '<div class="alert alert-danger mb10" role="alert">数据库操作失败!</div>');
    }

    redirect('admin/pages');
  }

  // 添加 内容单页
  public function pagesAddView($pageCate='about'){

    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页', base_url('admin/index'));
    $this->breadcrumb->add_crumb('内容单页管理', base_url('admin/pages'));
    $this->breadcrumb->add_crumb('添加单页分类');

    $this->load->model('Model_Pages');
    $datas_pagesCate = $this->Model_Pages->GetCate($pageCate);
    $data = array(
      'title' => '内容单页管理',
      'currentNav' => 'pages',
      'pageCate' => $pageCate,
      'pageName' => $datas_pagesCate['pageName'],
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_pagesCate' => $datas_pagesCate
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/pagesAdd', $data);
    $this->load->view('admin/common/footer', $data);
  }

  public function pagesAdd($cate){
    $this->load->model('Model_Pages');
    if ($this->Model_Pages->AddRules() == FALSE){ // 本地验证
      $this->pagesAddView($cate);
    }else{
      $data = array(
        'PageCate'=>$cate,
        'PageTitle'=>$_POST['title'],
        'PageContent'=>$_POST['content'],
        'Position'=>$_POST['position']
      );
      $this->Model_Pages->Add($data);
    }
  }

  // 修改 内容单页
  public function pagesEditView($pageCate, $id)
  {
    $title = '修改';
    $this->Model_CheckLogin->Check();
    $this->breadcrumb->add_crumb('首页',base_url('admin/index'));
    $this->breadcrumb->add_crumb('内容单页管理',base_url('admin/pages'));
    $this->breadcrumb->add_crumb($title);

    $this->load->model('Model_Pages');
    $datas_pagesCate = $this->Model_Pages->GetCate($pageCate);
    $datas_page = $this->Model_Pages->GetPage($pageCate, $id);

    $data = array(
      'title' => '内容单页管理',
      'currentNav' => 'pages',
      'id' => $id,
      'pageCate' => $pageCate,
      'pageName' => $datas_pagesCate['pageName'],
      'breadcrumb' => $this->breadcrumb->output(),
      'datas_pagesCate' => $datas_pagesCate,
      'datas_page' => $datas_page
    );
    $this->load->view('admin/common/header', $data);
    $this->load->view('admin/pagesEdit', $data);
    $this->load->view('admin/common/footer', $data);
  }

  public function pageEdit($pageCate, $id)
  {
    $this->load->model('Model_Pages');
    if ($this->Model_Pages->AddRules() == FALSE){
      $this->pagesEditView($pageCate, $id);
    }else{
      $data = array(
        'Id'=>$_POST['id'],
        'PageCate'=>$pageCate,
        'PageTitle'=>$_POST['title'],
        'PageContent'=>$_POST['content'],
        'Position'=>$_POST['position']
      );
      $this->Model_Pages->Update($data);
    }
  }

  //上传文件 Simditor
  public function pagesUpload(){

    $config = array(
      'upload_path'=>'./uploads/',
      'allowed_types'=>'jpg|png|gif',
      'max_size'=>10000,
      'max_width'=>1200,
      'max_height'=>1200,
      'encrypt_name'=>true
    );
    $this->load->library('upload', $config);

    if(!$this->upload->do_upload('upload_file')){
      $data = array(
        'success'=>false,
        'msg' => $this->upload->display_errors(),
        'file_path'=>''
      );
      echo json_encode($data);
    }else{
      $up = $this->upload->data();
      $data = array(
        'success'=>true,
        'msg' => $up['file_name'].'上传成功!',
        'file_path'=>$up['file_path']
      );
      echo json_encode($data);
    }
  }


}