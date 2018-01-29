  <body class="login">
    <div>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              <form id="login_form">
              <h1>Universal Engineer Login</h1>
              <div>
                  <input type="email" class="form-control" placeholder="Email" name="email" required="" />
              </div>
              <div>
                  <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div>
                  <a class="btn btn-round btn-primary submit" id="login_button" onclick="login_submit()">Log in</a>
                  <span id="login_error" class="red"></span>
                  <span id="login_success" class="green"></span>
                  <img src="build/images/loader.gif" id="login_spinner" style="display: none">
<!--                <a class="reset_pass" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <div><p>©2017-18 All Rights Reserved.</p></div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
          <!-- jQuery -->
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
    <script src="<?php echo base_url(); ?>build/js/login.js"></script>
    <link href="<?php echo base_url(); ?>build/css/login.css" rel="stylesheet">
  </body>
</html>