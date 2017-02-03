  


      <div class="col-md-10 col-md-offset-2">
        <div class="main-container">


          <h4 style="margin-top:20px;">欢迎登录, <?php if(isset($this->session->user_info['realname'])) echo $this->session->user_info['realname'] ?></h4>
          <br>
          
          <p>当前登录IP：<span class="text-info"><?php echo $this->session->user_info['ip'] ?></span></p>
          <p>上次登录IP：<span class="text-info"><?php if(isset($this->session->user_info['lastloginip'])){ echo $this->session->user_info['lastloginip']; }else{ echo "第一次登录";} ?></span></p>
          <p>上次登录时间：<span class="text-info"><?php if(isset($this->session->user_info['lastlogintime'])){ echo date('Y-m-d H:i:s', $this->session->user_info['lastlogintime']); }else{ echo "第一次登录";} ?></span></p>

        <!--
        <h1 class="page-header">Dashboard</h1>

        <div class="row placeholders">
          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
          </div>
        </div>

        -->

        </div>
        <!-- end main-container -->
      </div>

    


