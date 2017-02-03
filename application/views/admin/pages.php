

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>
          
          <?php echo $this->session->flashdata('state') ?>

          <div class="row">
            <div class="col-md-3">
            
              <div class="list-group mb10">
                <?php foreach($datas_pagesCate['result'] as $row){ ?>
                  <a href="<?php echo base_url('admin/pages/'.$row->PageCate); ?>" class="list-group-item <?php if($pageCate==$row->PageCate) echo 'active'; ?>"><span class="label label-default"><?php echo $row->Position; ?></span>&nbsp;&nbsp;<?php echo $row->PageName; ?></a>
                <?php } ?>
              </div>
              
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  添加
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="<?php echo base_url('admin/pages/add/'.$pageCate); ?>">添加单页</a>
                  <a class="dropdown-item" href="<?php echo base_url('admin/pages/addcate'); ?>">添加单页分类</a>
                </div>
              </div>

            </div>
            <div class="col-md-9">

              <div class="row">
                <h5 class="col-xs-5">
                  <?php echo $pageName;?>&nbsp;&nbsp;
                  <small><a href="<?php echo base_url('admin/pages/editcate/'.$pageCate);?>">修改</a>&nbsp;&nbsp;</small>
                  <small><a href="javascript:;" class="delete_click" data-tip="<?php echo $pageCate;?>" data-model="pageCateDelete" data-url="<?php echo base_url('admin/pageDeleteCate/'.$datas_pagesCate['id'].'/'.$pageCate);?>">删除</a></small>
                </h5>
                <div class="col-xs-7 text-right">
                  <a href="<?php echo base_url('admin/pages/add/'.$pageCate); ?>">添加单页</a>
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
                    <?php foreach($datas_pages as $row){ ?> 
                    <tr>
                      <td><?php echo $row->Position; ?></td>
                      <td><a href="<?php echo base_url('admin/pages/edit/'.$row->PageCate.'/'.$row->Id); ?>"><?php echo $row->PageTitle; ?></a></td>
                      <td>
                        <a href="<?php echo base_url('admin/pages/edit/'.$row->PageCate.'/'.$row->Id); ?>">修改</a>&nbsp;
                        <a href="javascript:;" class="delete_click" data-tip="<?php echo $row->PageTitle;?>" data-model="pageDelete" data-url="<?php echo base_url('admin/pageDelete/'.$row->Id.'/'.$row->PageCate);?>">删除</a>
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