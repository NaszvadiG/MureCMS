<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="<?php if($currentNav=='index') echo 'active'; ?>"><a href="<?php echo base_url('admin/index')?>">概况</a></li>
  </ul>
  <ul class="nav nav-sidebar">
    <?php if($this->session->user_info['id']==1){ ?>
      <li class="<?php if($currentNav=='navigation') echo 'active'; ?>"><a href="<?php echo base_url('admin/navigation')?>">主导航</a></li>
    <?php } ?>
  </ul>
  <ul class="nav nav-sidebar">
    <li class="<?php if($currentNav=='pages') echo 'active'; ?>"><a href="<?php echo base_url('admin/pages')?>">内容单页管理</a></li>
    <li class="<?php if($currentNav=='articles') echo 'active'; ?>"><a href="<?php echo base_url('admin/articles')?>">资讯管理</a></li>
  </ul>
  <ul class="nav nav-sidebar">
    <?php if($this->session->user_info['id']==1){ ?>
      <li class="<?php if($currentNav=='manager') echo 'active'; ?>"><a href="<?php echo base_url('admin/manager')?>">管理员账号</a></li>
    <?php } ?>
    <li class="<?php if($currentNav=='password') echo 'active'; ?>"><a href="<?php echo base_url('admin/password')?>">修改密码</a></li>
  </ul>
</div>