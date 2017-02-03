

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>
          
          
         
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="30%">子账号</th>
                  <th width="25%">最近一次登录IP</th>
                  <th width="25%">最近一次登录时间</th>
                  <th width="20%">操作</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($datas_manager->result() as $row){ ?>
                  <tr>
                    <td><?php echo $row->UserName ?></td>
                    <td><?php if(isset($row->LastLoginIP)){ echo $row->LastLoginIP; }else{ echo "<span class='text-muted'>未登录过</span>"; } ?></td>
                    <td><?php if(isset($row->LastLoginTime)){ echo date('Y-m-d H:i:s', $row->LastLoginTime); }else{ echo "<span class='text-muted'>未登录过</span>"; } ?></td>
                    <td>
                      <a href="javascript:;" class="delete_click" data-tip="<?php echo $row->UserName;?>" data-model="managerDelete" data-url="managerDelete/<?php echo $row->Id; ?>">删除</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>


          <p><a href="<?php echo base_url('admin/manager/add')?>" class="btn btn-primary">添加管理员</a></p>


        </div>
        <!-- end main-container -->
      </div>


  <?php $this->load->view('admin/common/confirm/managerDeleteModel'); ?>
