<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

  <title><?php echo $title; ?></title>
  <link href="<?php echo base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('css/dist/signin.css') ?>" rel="stylesheet">
  
</head>

<body>


  <div class="fixed-centered">
    <?php echo form_open('admin/signinPost', 'class="form-signin" id="form-signin"'); ?>
        <h4 class="form-signin-heading">后台登录</h4>
        <input value='<?php echo set_value('username'); ?>' name="username" type="text" id="inputEmail" class="form-control" placeholder="输入用户名" required autofocus>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="输入密码" required>
        <!--<div class="checkbox">
          <label class="c-input c-checkbox">
            <input type="checkbox">
            <span class="c-indicator"></span>记住我
          </label>
        </div>-->
        <input  type="submit" name="submit" value="登录" class="btn btn-primary btn-block">

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <?php if(isset($db_error)){ ?>
          <div class="alert alert-danger"><?php echo $db_error; ?></div>
        <?php } ?>

    </form>
  </div>



</body>
</html>
