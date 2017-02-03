

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>
          
          <?php echo $this->session->flashdata('state') ?>
          <div class="row">
            <div class="col-md-3">
              <div class="list-group mb10">
                <?php foreach($datas_articleCate['result'] as $index=>$row){ ?>
                  <a href="<?php echo base_url('admin/articles/'.$row->ArticleCate); ?>" class="list-group-item <?php if($articleCate==$row->ArticleCate) echo 'active'; ?>"><span class="label label-default"><?php echo $row->Position; ?></span>&nbsp;&nbsp;<?php echo $row->ArticleTitle; ?></a>
                  <?php if(!empty($datas_articleCate['childList'][$index+1])){ ?>
                    <ul class="list-group-child">
                        <?php foreach($datas_articleCate['childList'][$index+1] as $indexChild=>$rowChild){ ?>
                          <li><a class="<?php if($id == $rowChild->Id) echo 'active'; ?>" href="<?php echo base_url('admin/articles/'.$row->ArticleCate.'/'.$rowChild->Id); ?>"><?php echo $rowChild->ArticleTitle;?></a></li>
                        <?php } ?>
                    </ul>
                  <?php } ?>
                <?php } ?>
              </div>
              
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  添加
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="<?php echo base_url('admin/articles/add/'.$articleCate.'/'.$id); ?>">添加资讯</a>
                  <!--<a class="dropdown-item" href="<?php echo base_url('admin/articles/addcate'); ?>">添加资讯分类</a>-->
                </div>
              </div>

            </div>
            <div class="col-md-9">
            
              <div class="row">
                <h5 class="col-xs-8">
                  <?php echo $articleName;if(!empty($id)){ echo '<small class="text-muted"> - '.$articleChildName.'</small>';} ?>&nbsp;&nbsp;
                  <small><a href="<?php echo base_url('admin/articles/editcate/'.$articleCate);?>">修改分类</a></small>&nbsp;&nbsp;
                  <small><a href="javascript:;" class="delete_click" data-tip="<?php echo $articleCate;?>" data-model="articleCateDelete" data-url="">删除分类</a></small>
                </h5>
                <div class="col-xs-4 text-right">
                  <a href="<?php echo base_url('admin/articles/add/'.$articleCate.'/'.$id); ?>">添加资讯</a>
                </div>
              </div>

              <div class="table-respon'sive">
                <table class="table table-hover">
                  <thead><tr>
                    <th width="15%">排序</th>
                    <th width="60%">内容</th>
                    <th width="25%">操作</th>
                  </tr></thead>
                  <tbody>


                    <?php foreach($datas_articles as $row){ ?> 
                    <tr>
                      <td><?php echo $row->Position; ?></td>
                      <td><a href="<?php echo base_url('admin/articles/edit/'.$row->ArticleCate.'/'.$row->Id); ?>"><?php echo $row->ArticleTitle; ?></a></td>
                      <td>
                        <a href="<?php echo base_url('admin/articles/edit/'.$row->ArticleCate.'/'.$row->Id); ?>">修改</a>&nbsp;
                        <a href="javascript:;" class="delete_click" data-tip="<?php echo $row->ArticleTitle;?>" data-model="articleDelete" data-url="<?php echo base_url('admin/articleDelete/'.$row->Id.'/'.$row->ArticleCate);?>">删除</a>
                      </td>
                    </tr>
                    <?php } ?>
                    
                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
         
          

          


        </div>
        <!-- end main-container -->
      </div>


  <?php $this->load->view('admin/common/confirm/pageDeleteModel'); ?>
  <?php $this->load->view('admin/common/confirm/pageCateDeleteModel'); ?>