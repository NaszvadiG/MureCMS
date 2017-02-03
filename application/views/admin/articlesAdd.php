

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>
          
          <div class="row">
            <div class="col-md-3">
              <div class="list-group mb10">
                <?php foreach($datas_articleCate['result'] as $index=>$row){ ?>
                  <a href="<?php echo base_url('admin/articles/'.$row->ArticleCate); ?>" class="list-group-item <?php if($articleCate==$row->ArticleCate) echo 'active'; ?>"><span class="label label-default"><?php echo $row->Position; ?></span>&nbsp;&nbsp;<?php echo $row->ArticleTitle; ?></a>
                  <ul class="list-group-child">
                    <?php foreach($datas_articleCate['childList'][$index+1] as $indexChild=>$rowChild){ ?>
                    <li><a class="<?php if($id == $rowChild->Id) echo 'active'; ?>" href="<?php echo base_url('admin/articles/'.$row->ArticleCate.'/'.$rowChild->Id); ?>"><?php echo $rowChild->ArticleTitle;?></a></li>
                    <?php } ?>
                  </ul>
                <?php } ?>
              </div>
            </div>
            <div class="col-md-9">

              
              <h5 class="mb20">在 <b class="text-info"><?php echo $articleName;?></b> 分类下添加单页</h5>
              
              <?php echo form_open('admin/articlesAdd/'.$articleCate); ?>

                <fieldset class="form-group mb10">

                  <div class="row">
                    <div class="col-md-10"><input type="text" name="title" class="form-control" placeholder="输入内容标题" require autofocus></div>
                    <div class="col-md-2"><input type="number" name="position" class="form-control" placeholder="0" require></div>
                  </div>

                </fieldset>
                <fieldset class="form-group mb10">
                  
                  <script src="<?php echo base_url('js/ueditor/ueditor.config.js') ?>"></script>
                  <script src="<?php echo base_url('js/ueditor/ueditor.all.min.js') ?>"></script>
                  <script id="editor" name="content" type="text/plain" style="width:100%;height:300px;"></script>
                  <script>
                    var ue = UE.getEditor('editor');
                    ue.ready(function(){
                      var tempContent = UE.getEditor('editor').execCommand("getlocaldata") || '';
                      ue.setContent(tempContent);
                    });
                  </script>

                </fieldset>

                <div class="mt10">
                  <input type="submit" name="submit" class="btn btn-primary" value="添加内容">
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
