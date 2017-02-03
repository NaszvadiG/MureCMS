$(document).ready(function(){
  
  // 询问是否删除[通用]
  (function(){
    $('.delete_click').on('click',function(){
      $url = $(this).data('url');
      $model = $('#'+$(this).data('model'));
      $model_yes = $('#'+$(this).data('model')+'_Yes');
      $model.find('.tip').html($(this).data('tip'));
      $model.modal('show');
      $('body').css('padding-right',0); //弹窗滚动出现BUG

      // 确定
      $model_yes.on('click',function(){
        window.location.href = $url;
        $model_yes.off('click');
      });
    });
  })();

  // 内容页（Select 内容类型选择事件）
  (function(){

    $("#navigation-typeSelect").on("change",function(){

      $thisVal = $(this).val();
      $content = $("#navigation-typeSelectContent");

      if($thisVal=='1'){ //跳转链接
        $('input[name="link"]').val('').attr('readonly',false);
        $content.html('<input type="text" name="title" placeholder="输入标题" class="form-control" required/>');
      }

      if($thisVal=='2'){ //内容单页
        $content.html('<select class="form-control" id="navigation-linkSelect" name="title"></select>');
        $("#navigation-linkSelect").on("change",function(){
          $('input[name="link"]').val('/pages/' + $(this).find('option:selected').attr('title'));
        });

        $.get("/admin/getPagesCate", function(res){
          res.forEach(function(item){
            $content.find('select').append('<option value="' + item.PageName + '" title="' + item.PageCate + '">' + item.PageName + '</option>');
          });
        }).done(function(){
          $('input[name="link"]').attr('readonly',true);
          $('input[name="link"]').val('/pages/' + $content.find('select option:selected').attr('title'));
        });
      }
    });
    
    $("#navigation-linkSelect").on("change",function(){
      $('input[name="link"]').val('/pages/' + $(this).find('option:selected').attr('title'));
    });


  })();

  

})