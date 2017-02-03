<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

  <title><?php echo $title; ?></title>
  <link href="<?php echo base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('css/dist/dashboard.css') ?>" rel="stylesheet">
  <script src="<?php echo base_url('js/jquery-1.12.4.min.js') ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('js/common.js') ?>"></script>
</head>

<body>

  <nav class="navbar navbar-dark navbar-fixed-top bg-primary">
    <a class="navbar-brand" href="<?php echo base_url('admin/index')?>">后台管理中心</a>
    <div class="pull-right">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="<?php echo base_url('/')?>">前台预览</a>
        </li>
        <li class="nav-item" style="display:none;">
          <a class="nav-link" href="#"><?php echo $this->session->user_info['user'] ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('admin/logout')?>">注销</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid">

      <?php $this->load->view('admin/common/side-nav'); ?>