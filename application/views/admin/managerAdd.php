

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>
          
          <?php echo form_open('admin/managerAdd'); ?>
            
            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">账号名称<span class="text-danger">*</span></label>
                  <input type="text" value='<?php echo set_value('username'); ?>' name="username" class="form-control" placeholder="输入账号" require autofocus>
                  <small class="text-muted">4-20 位字符，英文字母(区分大小写)、数字 和 '_'（下划线）</small>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">真实姓名</label>
                  <input type="text" value='<?php echo set_value('realname'); ?>' name="realname" class="form-control" placeholder="输入真实姓名">
                  <small class="text-muted">&nbsp;</small>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">密码<span class="text-danger">*</span></label>
                  <input type="password" name="password" class="form-control" placeholder="输入密码" require>
                  <small class="text-muted">4-20 位字符，英文字母(区分大小写)、数字</small>
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group mb10">
                  <label for="formGroupExampleInput">确认密码<span class="text-danger">*</span></label>
                  <input type="password" name="passconf" class="form-control" placeholder="再次输入密码" require>
                  <small class="text-muted">&nbsp;</small>
                </fieldset>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mt10">
                  <input type="submit" name="submit" class="btn btn-primary" value="添加账号">
                  <a href="javascript:history.go(-1)" class="btn">返回</a>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-12">
                <?php echo $this->session->flashdata('state') ?>
                <?php echo validation_errors('<div class="alert alert-danger mt20">', '</div>'); ?>
              </div>
            </div>

          </form>

        </div>
        <!-- end main-container -->
      </div>


