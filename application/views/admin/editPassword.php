

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>
          

          <?php foreach($datas_user->result() as $row){ ?>
          <?php echo form_open('admin/passwordEdit'); ?>
            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">账号名称<span class="text-danger">*</span></label>
                  <input type="text" value='<?php echo $row->UserName; ?>' name="username" class="form-control" placeholder="输入账号" require disabled>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">原密码<span class="text-danger">*</span></label>
                  <input type="password" name="oldpassword" class="form-control" placeholder="输入原密码" require autofocus>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">新密码<span class="text-danger">*</span></label>
                  <input type="password" name="newpassword" class="form-control" placeholder="输入新密码" require>
                  <small class="text-muted">4-20 位字符，英文字母(区分大小写)、数字</small>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">确认密码<span class="text-danger">*</span></label>
                  <input type="password" name="passconf" class="form-control" placeholder="再次输入新密码" require>
                  <small class="text-muted">&nbsp;</small>
                </fieldset>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mt10">
                  <input type="submit" name="submit" class="btn btn-primary" value="修改密码">
                  <a href="javascript:history.go(-1)" class="btn">返回</a>
                </div>
              </div>
              <div class="col-md-12">
                <div class="alert alert-warning mt10" role="alert">注意! 修改密码后将会注销重新登录，请记好新密码</div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-12">
                <?php echo $this->session->flashdata('state') ?>
                <?php echo validation_errors('<div class="alert alert-danger mt20">', '</div>'); ?>
              </div>
            </div>
          </form>
          <?php } ?>

        </div>
        <!-- end main-container -->
      </div>


