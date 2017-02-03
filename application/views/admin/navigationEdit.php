

      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">
          <ol class="breadcrumb"><?php echo $breadcrumb;?></ol>

            <?php foreach($datas_navigation->result() as $row){ ?>
            <?php echo form_open('admin/navigationEdit'); ?>

              <input type="hidden" name="id" value="<?php echo $row->Id;?>">
              <div class="table-responsive">
                <table class="table">
                  <thead><tr>
                    <th width="8%">排序</th>
                    <th width="25%">类型</th>
                    <th width="42%">标题</th>
                    <th width="25%">链接</th>
                  </tr></thead>
                  <tbody>
                  <tr>
                    <td width="8%"><input type="text" value="<?php echo $row->Position;?>" name="position" placeholder='0' class="form-control"/></td>
                    <td width="25%">
                      <select id="navigation-typeSelect" class="form-control" name='type'>
                        <option value='1' <?php if($row->Type==1){ echo 'selected';} ?>>跳转链接</option>
                        <option value='2' <?php if($row->Type==2){ echo 'selected';} ?>>内容单页</option>
                      </select>
                    </td>
                    <td width="42%">
                      <div id="navigation-typeSelectContent">

                        <?php if($row->Type==1){ ?>
                          <input type="text" value="<?php echo $row->Title;?>" name="title" placeholder='输入标题' class="form-control" required/>
                        <?php }else if($row->Type==2){ ?>
                          <select id="navigation-linkSelect" class="form-control" name="title">
                            <?php foreach($datas_pages_cate->result() as $rowCate){ ?>
                              <option value="<?php echo $rowCate->PageName; ?>" title="<?php echo $rowCate->PageCate; ?>" <?php if($row->Title==$rowCate->PageName){ echo 'selected';} ?> ><?php echo $rowCate->PageName; ?></option>
                            <?php } ?>
                          </select>
                        <?php } ?>
                      </div>
                    </td>
                    
                    <td width="25%">
                      <input type="text" value="<?php echo $row->Link;?>" name="link" placeholder='输入链接' class="form-control" required <?php if($row->Type==2){ echo 'readonly';} ?>/>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="5">
                      <button class="btn btn-primary">修改</button>&nbsp;&nbsp;
                      <a href="javascript:history.go(-1);" class="btn btn-secondary">返回</a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </form>
            <?php } ?>

            

          </div>


        </div>
        <!-- end main-container -->
      </div>

  
  <?php $this->load->view('admin/common/confirm/navigationEditModel'); ?>
  <?php $this->load->view('admin/common/confirm/navigationDeleteModel'); ?>
