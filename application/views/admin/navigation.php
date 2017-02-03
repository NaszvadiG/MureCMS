

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>

          <?php echo $this->session->flashdata('state') ?>

          <div class="table-responsive">
            <table class="table table-hover">
              <thead><tr>
                <th width="8%">排序</th>
                <th width="15%">类型</th>
                <th width="40%">标题</th>
                <th width="22%">链接</th>
                <th width="15%">操作</th>
              </tr></thead>
              <tbody>
                <?php foreach ($datas_nav->result() as $row){ ?>
                  <tr>
                    <td><?php echo $row->Position; ?></td>
                    <td><?php echo $datas_navType[$row->Type]; ?></td>
                    <td><?php echo $row->Title; ?></td>
                    <td><?php echo $row->Link; ?></td>
                    <td>
                      <!--<a href="javascript:;" class="navigationEdit_click" data-model="navigationEdit" data-id="<?php echo $row->Id; ?>">修改</a>&nbsp;-->
                      <a href="<?php echo base_url('admin/navigationEditView/'.$row->Id); ?>">修改</a>&nbsp;
                      <a href="javascript:;" class="delete_click" data-tip="<?php echo $row->Title;?>" data-model="navigationDelete" data-url="navigationDelete/<?php echo $row->Id; ?>">删除</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>

            <?php echo form_open('admin/navigationAdd'); ?>
              <div class="table-responsive">
                <table class="table">
                  <thead><caoption><h5>快速添加</h5></caoption></thead>
                  
                  <tbody>
                    <tr>
                      <td width="8%"><input type="number" name="position" placeholder='0' class="form-control"/></td>
                      <td width="15%">
                        <select id="navigation-typeSelect" class="form-control" name='type'>
                          <option value='1'>跳转链接</option>
                          <option value='2' <?php if(empty($hasPagesCate->result())){ echo 'disabled';} ?>>内容单页</option>
                        </select>
                      </td>
                      <td width="40%">
                        <div id="navigation-typeSelectContent">
                          <input type="text" name="title" placeholder='输入标题' class="form-control" required/>
                        </div>
                      </td>
                      <td width="22%">
                        <input type="text" name="link" placeholder='输入链接' class="form-control" required/>
                      </td>
                      <td width="15%"><button class="btn btn-primary">添加</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>

            

          </div>


        </div>
        <!-- end main-container -->
      </div>

  
  <?php $this->load->view('admin/common/confirm/navigationEditModel'); ?>
  <?php $this->load->view('admin/common/confirm/navigationDeleteModel'); ?>
