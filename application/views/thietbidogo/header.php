<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- thanh ngang tin nhắn-->
  
  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu" style="background-color: #00a65a">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars" style="color:white"></i></a>
        </div>

        <ul class="nav navbar-nav chonDonVi" style="margin-top: 1.5vh">
            <li>
              <div class="dropdown">
                <button class="dropbtn">Khoa</button>
                <div class="dropdown-content">
                  <a>Khoa công nghệ thông tin</a>
                  <a>Khoa cơ khí</a>
                  <a>Khoa cơ khí động lực</a>
                  <a>Khoa khoa học sinh học ứng dụng</a>
                  <a>Khoa điện - điện tử</a>
                  <a>Khoa Khoa học cơ bản</a>
                  <a>Khoa lý luận chính trị</a>
                  <a>Khoa SPKT & XHNV</a>
                </div>
              </div>
            </li>

            <li>
              <div class="dropdown">
                <button class="dropbtn">Phòng</button>
                <div class="dropdown-content">
                  <a>Phòng công tác sinh viên</a>
                  <a>Phòng đào tạo</a>
                  <a>Phòng khảo thí - ĐBCLGD</a>
                  <a>Phòng kế hoạch tài chính</a>
                  <a>Phòng QLKH - HTQT</a>
                  <a>Phòng quản trị thiết bị</a>
                  <a>Phòng tổ chức hành chính</a>
                </div>
              </div>
            </li>

            <li>
              <div class="dropdown">
                <button class="dropbtn">Trung tâm</button>
                <div class="dropdown-content">
                  <a>Trung tâm GDTC - QPAN</a>
                  <a>Trung tâm ngoại ngữ</a>
                  <a>Trung tâm đào tạo sau đại học</a>
                  <a>Trung tâm truyền thông - thông tin thư viện</a>
                  <a>Trung tâm thực hành</a>
                </div>
              </div>
            </li>
          </ul>

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