  <style type="text/css">
    /* Hide scrollbar for Chrome, Safari and Opera */
    .left_col::-webkit-scrollbar {
      display: none;
    }

    /* Hide scrollbar for IE and Edge */
    .left_col {
      -ms-overflow-style: none;
      /*background-color: red*/
    }

    .dropdown {
        display: inline-block;
    }

    .dropdown-menu{
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      padding: 1px 1px;
      z-index: 999;

      position: fixed;
      top: 1em;
      right: 1em;
      width: 300px;
    }

    #dropdownAll{
      padding: 0;
      border: none;
      background: none;
      color: white;
    }



    .items {
      /*width: 300px;*/
      /*background: #fffffe;*/
      box-shadow: 0 3px 6px rgba(black,0.16), 0 3px 6px rgba(black,0.23);
      border-top: 0px solid #0B5AA2;

    }

    .items-body {
      padding: 5px;
      margin: 10px;
      display: grid;
      grid-gap: 5px;
    }

    .items-body-content {
      padding: 3px;
      padding-right: 0px;
      display: grid;
      grid-template-columns: 10fr 1fr;
      // background-color: lightblue;
      font-size: 13px;
      grid-gap: 10px;
      border: 1px solid transparent;
      cursor: pointer;
      width: 1000px
      z-index: 999;
    }

    .items-body-content:hover {
      border-radius: 15px;
      border: 1px solid #0B5AA2;
      background-color: #2ECC71;
      color: white;
    }

    .items-body-content i {
      align-self: center;
      font-size: 15px;
      color: #0B5AA2;
      font-weight: bold;
      animation: icon 1.5s infinite forwards;
    }

    @keyframes icon {
      0%,100%{
        transform: translate(0px);
      }
      50% {
        transform: translate(3px);
      }
    }

  </style>
  <div class="col-md-3 left_col menu_fixed" >
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;background-color: #297bb9">
        <a href="<?php echo base_url(); ?>" class="site_title">
          <img src="<?php echo base_url('images/logo.png');?>" style="width: 40px;height: 40px" >
          <span style="font-family: Bookman">Quản Lý Thiết Bị</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <!-- <div class="profile_pic">
          <img src="<?php echo base_url();?>images/logo.png" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
          <span>Welcome,</span>
          <h2>Admin</h2>
        </div> -->
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <ul class="nav side-menu">
            <?php if ($this->session->userdata('quyenhan') == "1"): ?>
              <li><a><i class="fa fa-university"></i> Quản lý đơn vị <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url();?>index.php/donvi/donvicontroller/index">Đơn vị</a></li>
                    <li><a href="<?php echo donvi_url('phong_khocontroller/index');?>">Phòng - kho</a></li>
                </ul>
              </li>
            <?php endif ?>
            

            <li><a><i class="fa fa-desktop"></i> Máy móc thiết bị <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    

                    <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                      <li>
                        <a href="<?php echo maymocthietbi_url('nhommaymocthietbicontroller/index');?>">Nhóm máy móc thiết bị</a>
                      </li>
                      <li>
                        <a href="<?php echo maymocthietbi_url('loaimaymocthietbicontroller/index');?>">Loại máy móc thiết bị</a>
                      </li>
                    <?php endif ?>

                    <li data-toggle="modal" data-target="#modal-mm-donvi"><a>Danh sách thiết bị</a></li>

                    <?php if ($this->session->userdata('quyenhan') == "1" || $this->session->userdata('quyenhan') == "2"): ?>
                      <li data-toggle="modal" data-target="#modal-mm-kiemke"><a>Danh mục kiểm kê</a></li>
                    <?php endif ?>
                      
                </ul>
            </li>

            <li><a><i class="fa fa-desktop"></i> Đồ nội thất <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                        

                        <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                          <li>
                            <a href="<?php echo thietbidogo_url('loaithietbidogocontroller/index');?>">Loại đồ nội thất</a>  
                          </li>
                        <?php endif ?>

                    <li data-toggle="modal" data-target="#modal-dg-donvi"><a>Danh sách đồ gỗ</a></li>

                    <?php if ($this->session->userdata('quyenhan') == "1" || $this->session->userdata('quyenhan') == "2"): ?>

                      <li data-toggle="modal" data-target="#modal-dg-kiemke"><a>Danh mục kiểm kê</a></li> 
                    <?php endif ?> 
                        
                </ul>
            </li>

            <li><a><i class="fa fa-file"></i> Biểu mẫu<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                  <li><a href="<?php echo nguoidung_url('bieumaucontroller/index');?>">Biểu mẫu thiết bị</a></li>
                  <li><a href="<?php echo nguoidung_url('bieumaucontroller/nhatkyphongmay');?>">Nhật ký phòng máy</a></li>
                  <li><a href="<?php echo nguoidung_url('bieumaucontroller/hienthisokho');?>">Sổ quản lý kho</a></li>
              </ul>
            </li>

            <?php if ($this->session->userdata('quyenhan') == "1"): ?>
              <li><a><i class="fa fa-users"></i> Quản lý người dùng <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                        <li><a href="<?php echo nguoidung_url('loaitaikhoancontroller/index');?>">Loại tài khoản</a></li>
                        <li><a href="<?php echo nguoidung_url('taikhoancontroller/index');?>">Tài khoản</a></li>
                  </ul>
              </li>
            <?php endif ?>

            <li><a><i class="fa fa-file"></i>Ghi sổ nhật ký<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                  <li><a href="<?php echo nguoidung_url('nhatkycontroller/index');?>">Quản lý học kỳ</a></li>
                  <li><a href="<?php echo nguoidung_url('sokhocontroller/index');?>">Sổ quản lý kho</a></li>
                  <li><a href="<?php echo nguoidung_url('vattuhoctapcontroller/index');?>">Vật tư học tập</a></li>
                  <li><a href="<?php echo nguoidung_url('muasamvattucontroller/index');?>">Mua sắm vật tư</a></li>
                <?php endif ?>

                <?php if ($this->session->userdata('quyenhan') == "2"): ?>
                  <li><a href="<?php echo nguoidung_url('sokhocontroller/index');?>">Sổ quản lý kho</a></li>
                  <li><a href="<?php echo nguoidung_url('vattuhoctapcontroller/index');?>">Vật tư học tập</a></li>
                  <li><a href="<?php echo nguoidung_url('muasamvattucontroller/index');?>">Mua sắm vật tư</a></li>
                <?php endif ?>

                <li><a href="<?php echo nguoidung_url('nhatkycontroller/hienthinhatky');?>">Nhật ký phòng máy</a></li>
                
                
              </ul>
            </li>

          </ul>
        </div>

      </div>
      <!-- /sidebar menu -->

    </div>
  </div>
<!-- Modal máy móc -->
<div class="modal fade" id="modal-mm-donvi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 10000">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>CHỌN ĐƠN VỊ</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/index') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>TỔ CHỨC</label>
            <select class="form-control" required="required" class="form-control"
              onchange="chonloaidonvi_mm(this)">
              <option>Chọn tổ chức</option>
              <option value="1">Khoa</option>
              <option value="2">Phòng</option>
              <option value="3">Trung tâm</option>
            </select>
          </div>

          <div class="form-group">
            <label>ĐƠN VỊ</label>
            <select class="form-control" id="iddv" name="iddv" required="required" class="form-control" onchange="chondonvi(this)">
            </select>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">XEM</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal máy móc danh mục kiểm kê-->
<div class="modal fade" id="modal-mm-kiemke" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 10000">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>CHỌN ĐƠN VỊ</p></h2>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="<?= maymocthietbi_url('ketsomaymoccontroller/index') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>TỔ CHỨC</label>
            <select class="form-control" id="loaidv" required="required" class="form-control"
              onchange="chonloaidonvi_mmkk(this)">
              <option>Chọn tổ chức</option>
              <option value="1">Khoa</option>
              <option value="2">Phòng</option>
              <option value="3">Trung tâm</option>
            </select>
          </div>

          <div class="form-group">
            <label>ĐƠN VỊ</label>
            <select class="form-control" id="iddvmmkk" name="iddv" required="required" class="form-control" onchange="chondonvimmkk(this)">
            </select>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">XEM</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal đồ gỗ-->
<div class="modal fade" id="modal-dg-donvi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 10000">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>CHỌN ĐƠN VỊ</p></h2>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="<?= thietbidogo_url('danhsachthietbidogocontroller/index') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>TỔ CHỨC</label>
            <select class="form-control" required="required" class="form-control"
              onchange="chonloaidonvi_dg(this)">
              <option>Chọn tổ chức</option>
              <option value="1">Khoa</option>
              <option value="2">Phòng</option>
              <option value="3">Trung tâm</option>
            </select>
          </div>

          <div class="form-group">
            <label>ĐƠN VỊ</label>
            <select class="form-control" id="iddvdg" name="iddv" required="required" class="form-control" onchange="chondonvidg(this)">
            </select>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">XEM</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal đồ gỗ danh mục kiểm kê-->
<div class="modal fade" id="modal-dg-kiemke" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 10000">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>CHỌN ĐƠN VỊ</p></h2>
        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="<?= thietbidogo_url('ketsodogocontroller/index') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>TỔ CHỨC</label>
            <select class="form-control" required="required" class="form-control"
              onchange="chonloaidonvi_dgkk(this)">
              <option>Chọn tổ chức</option>
              <option value="1">Khoa</option>
              <option value="2">Phòng</option>
              <option value="3">Trung tâm</option>
            </select>
          </div>

          <div class="form-group">
            <label>ĐƠN VỊ</label>
            <select class="form-control" id="iddvdgkk" name="iddv" required="required" class="form-control" onchange="chondonvidgkk(this)">
            </select>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">XEM</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>vendors/jquery/dist/jquery.min.js"> </script>
<script type="text/javascript" language="javascript">
  function chonloaidonvi_mm(obj) {
    var iddv = obj.value;
    $.ajax({
      url: "<?= donvi_url('donvicontroller/laydonvi') ?>",
      method:"POST",
      data:{
        iddv: iddv,
      },
      success:function(data){
        var arr = JSON.parse(data);
        var sel = document.getElementById('iddv');
        // clear select box
        $('#iddv')
            .find('option')
            .remove()
            .end()
        ;
        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode("Chọn đơn vị"));
        sel.appendChild(opt); 
        // add option for select
        arr.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['tendonvi']));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

  function chonloaidonvi_mmkk(obj) {
    var iddv = obj.value;
    $.ajax({
      url: "<?= donvi_url('donvicontroller/laydonvi') ?>",
      method:"POST",
      data:{
        iddv: iddv,
      },
      success:function(data){
        var arr = JSON.parse(data);
        var sel = document.getElementById('iddvmmkk');
        // clear select box
        $('#iddvmmkk')
            .find('option')
            .remove()
            .end()
        ;

        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode("Chọn đơn vị"));
        sel.appendChild(opt); 
        // add option for select
        arr.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['tendonvi']));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

  function chonloaidonvi_dg(obj) {
    var iddv = obj.value;
    $.ajax({
      url: "<?= donvi_url('donvicontroller/laydonvi') ?>",
      method:"POST",
      data:{
        iddv: iddv,
      },
      success:function(data){
        var arr = JSON.parse(data);
        var sel = document.getElementById('iddvdg');
        // clear select box
        $('#iddvdg')
            .find('option')
            .remove()
            .end()
        ;

        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode("Chọn đơn vị"));
        sel.appendChild(opt); 
        // add option for select
        arr.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['tendonvi']));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

  function chonloaidonvi_dgkk(obj) {
    var iddv = obj.value;
    $.ajax({
      url: "<?= donvi_url('donvicontroller/laydonvi') ?>",
      method:"POST",
      data:{
        iddv: iddv,
      },
      success:function(data){
        var arr = JSON.parse(data);
        var sel = document.getElementById('iddvdgkk');
        // clear select box
        $('#iddvdgkk')
            .find('option')
            .remove()
            .end()
        ;

        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode("Chọn đơn vị"));
        sel.appendChild(opt); 
        // add option for select
        arr.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['tendonvi']));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

  function chondonvi(obj) {
    var iddv = obj.value;
    window.localStorage.setItem("iddv", iddv);
  }

  function chondonvimmkk(obj) {
    var iddv = obj.value;
    window.localStorage.setItem("iddv", iddv);
  }

  function chondonvidg(obj) {
    var iddv = obj.value;
    window.localStorage.setItem("iddv", iddv);
  }

  function chondonvidgkk(obj) {
    var iddv = obj.value;
    window.localStorage.setItem("iddv", iddv);
  }

  // //lock right click
  //   $(document).on({
  //       "contextmenu": function(e) {
  //           console.log("ctx menu button:", e.which); 

  //           // Stop the context menu
  //           e.preventDefault();
  //       },
  //       "mousedown": function(e) { 
  //           console.log("normal mouse down:", e.which); 
  //       },
  //       "mouseup": function(e) { 
  //           console.log("normal mouse up:", e.which); 
  //       }
  //   });
  //   $(document).keydown(function (event) {
  //       if (event.keyCode == 123) { // Prevent F12
  //           return false;
  //       } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
  //           return false;
  //       }
  //   });
</script>