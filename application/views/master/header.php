<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- thanh ngang tin nhắn-->
  
  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu" style="background-color: #2980B9">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars" style="color:white"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
              <img src="<?php echo base_url();?>images/logo.png" >
                <span style="color:white"><?php echo $this->session->userdata('hoten'); ?></span>
              <span class=" fa fa-angle-down" style="color:white"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="<?php echo login_url('logincontroller/doimatkhau') ?>"> Đổi mật khẩu</a></li>
              <li><a href="<?php echo login_url('logincontroller/logout') ?>"><i class="fa fa-sign-out pull-right" ></i>Đăng xuất</a></li>
            </ul>
          </li>


        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->