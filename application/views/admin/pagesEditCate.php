

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>
          
          <div class="row">
            <div class="col-md-3">

              <div class="list-group mb10">
                <?php foreach($datas_pagesCate['result'] as $row){ ?>
                  <a href="<?php echo base_url('admin/pages/'.$row->PageCate); ?>" class="list-group-item <?php if($pageCate==$row->PageCate) echo 'active'; ?>"><span class="label label-default"><?php echo $row->Position; ?></span>&nbsp;&nbsp;<?php echo $row->PageName; ?></a>
                <?php } ?>
              </div>

            </div>
            <div class="col-md-9">
              
              <h5 class="mb20">修改 <span class="text-danger"><?php echo $datas_pagesCate['pageName'];?></span> 分类</h5>
              <?php echo form_open('admin/pagesEditCate/'.$datas_pagesCate['id'].'/'.$datas_pagesCate['pageCate']); ?>

                <div class="row">
                  <div class="col-md-6">
                    <fieldset class="form-group mb10">
                      <label for="formGroupExampleInput">分类名称<span class="text-danger">*</span></label>
                      <input type="text" value="<?php echo $datas_pagesCate['pageName']; ?>" name="pageName" class="form-control" placeholder="输入分类名称" require autofocus>
                      <small class="text-muted">例如: 关于我们</small>
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset class="form-group mb10">
                      <label for="formGroupExampleInput">分类路径名称<span class="text-danger">*</span></label>
                      <input type="text" value="<?php echo $datas_pagesCate['pageCate']; ?>" name="pageCate" class="form-control" placeholder="输入分类路径名称" require disabled>
                      <small class="text-muted">路径不能修改，必须重新创建</small>
                    </fieldset>
                  </div>
                  <div class="col-md-4">
                    <fieldset class="form-group mb10">
                      <label for="formGroupExampleInput">输入位置<span class="text-danger">*</span></label>
                      <input type="text" value="<?php echo $datas_pagesCate['position']; ?>" name="position" class="form-control" placeholder="0">
                    </fieldset>
                  </div>
                </div>

                <div class="mt10">
                  <input type="submit" name="submit" class="btn btn-primary" value="修改分类">
                  <a href="javascript:history.go(-1)" class="btn">返回</a>
                </div>

                <?php echo validation_errors('<div class="alert alert-danger mt20">', '</div>'); ?>

              </form>
              
            </div>
          </div>
         
          <?php echo $this->session->flashdata('state') ?>

        </div>
        <!-- end main-container -->
      </div>


  <?php $this->load->view('admin/common/confirm/navigationDeleteModel'); ?>
