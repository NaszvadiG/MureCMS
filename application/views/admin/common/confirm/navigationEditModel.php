<div id="navigationEdit" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h6 class="modal-title">修改导航菜单</h6>
      </div>
      <div class="modal-body">

        <form class="form-inline">
          <div class="form-group" style='width:10%'>
            <input type="text" name="edit_position" style='width:100%' class="form-control" placeholder="0">
          </div>
          <div class="form-group" style='width:32%'>
            <input type="text" name="edit_title" style='width:100%' class="form-control" placeholder="输入标题">
          </div>
          <select class="form-control" style='width:20%' name='edit_type'>
            <option value='1'>内容单页</option>
            <option value='2'>资讯页</option>
            <option value='3'>跳转链接</option>
          </select>
          <div class="form-group" style='width:32%'>
            <input type="text" name="edit_link" style='width:100%' class="form-control" placeholder="输入链接">
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">否</button>
        <button id='navigationEdit_Yes' type="button" class="btn btn-primary" data-dismiss="modal">是</button>
      </div>
    </div>
  </div>
</div>