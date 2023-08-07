<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Tài khoản</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <!--menu-->
				 <?php $this->load->view('master/menu')?>
			<!--end menu-->
        <!-- top navigation -->
        	<?php $this->load->view('master/header')?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Danh sách tài khoản</h3>
              </div>

              
              <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                <div class="title_right">
                  <div class="form-group pull-right top_search">
                    <div class="input-group" data-toggle="modal" data-target="#modalthem">
                      <a class="btn btn-primary">
                        <i class="fa fa-plus"></i> Thêm tài khoản
                      </a>
                      
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>

            <div class="clearfix"></div>

            <div class="row">


              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
               
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 15px">
                      <thead>
                        <tr>
                          <th>Họ tên</th>
                          <th>Chứng minh nhân dân</th>
                          <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                            <!-- <th>Mật khẩu</th> -->
                          <?php endif ?>
                          <th>Email</th>
                          <th>Chức vụ</th>
                          <th>Loại tài khoản</th>
                          <th>Đơn vị</th>
                          <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                            <th>Thao tác</th>
                          <?php endif; ?>
                        </tr>
                      </thead>

                      <tbody class="them">
                      	 <?php foreach ($tk['mangtk'] as $value): ?>
	                        <tr>
	                          
	                          <td><?= $value['hoten']?></td>
	                          <td><?= $value['cmnd']?></td>
                            <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                            <!-- <td><?= $value['matkhau']?></td> -->
                            <?php endif ?>
	                          <td><?= $value['email']?></td>
	                          <td><?= $value['chucvu']?></td>
	                          <td>
                              <?php  
                                foreach ($loaitk['mangloaitk'] as $loaitaikhoan) {
                                  if($loaitaikhoan['id'] == $value['maloaitk'])
                                  {
                                      echo $loaitaikhoan['tenloai'];
                                  }
                                }
                              ?>
                            </td>
                            <td>
                              <?php  
                                foreach ($dv['mangdv'] as $donvi) {
                                    if($donvi['id'] == $value['madonvi'])
                                    {
                                        echo $donvi['tendonvi'];
                                    }
                                }
                              ?>
                            </td>
                            <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                              <td width="200px">
                                  <button class="btn btn-primary" 
                                    id="<?= $value['id']?>" 
                                    hoten="<?= $value['hoten']?>"
                                    cmnd="<?= $value['cmnd']?>"
                                    matkhau="<?= $value['matkhau']?>"
                                    email="<?= $value['email']?>"
                                    chucvu="<?= $value['chucvu']?>"
                                    maloaitk="<?= $value['maloaitk']?>"
                                    madonvi="<?= $value['madonvi']?>"
                                    onclick="setvalue(this)"
                                    style="width: 90px;">
                                    Cập nhật
                                  </button>

                                  <a class="btn btn-danger" onclick="return dialogDelete()" 
                                    href="<?php echo nguoidung_url('taikhoancontroller/xoataikhoan/').$value['id']; ?>"
                                    style="width: 90px">Xóa</a>
                              </td>
                            <?php endif; ?>
	                          
	                        </tr>
                         <?php endforeach ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        
        <!-- /page content -->
<!-- Modal thêm-->
<div class="modal fade" id="modalthem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Thêm tài khoản</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left">
        <div class="modal-body">
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Họ tên </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="hoten" name="hoten" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Chứng minh nhân dân
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="cmnd" name="cmnd" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Mật khẩu
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="matkhau" name="matkhau" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Email
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Chức vụ
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="chucvu" name="chucvu" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Loại tài khoản
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <select name="loaitaikhoan" class="form-control" id="loaitaikhoan">
                      <?php foreach ($loaitk['mangloaitk'] as $value): ?>
                        <option value="<?= $value['id'] ?>" > <?= $value['tenloai']?></option>
                      <?php endforeach ?> 
                    </select>
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đơn vị quản lí
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <select name="donvi" class="form-control" id="donvi">
                      <option value="" > </option>
                      <?php foreach ($dv['mangdv'] as $value): ?>
                        <option value="<?= $value['id'] ?>" > <?= $value['tendonvi']?></option>
                      <?php endforeach ?> 
                    </select>
                </div>
          </div>
         
         
        </div>
        <div class="modal-footer">
         
          <button type="button" class="btn btn-primary" onclick="themajax()">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal cập nhật-->
<div class="modal fade" id="modalsua" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Cập nhật tài khoản</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="capnhattaikhoan" method="POST">
        <div class="modal-body">
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Họ tên </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
                  <input type="text" id="hotenUpdate" name="hotenUpdate" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Chứng minh nhân dân
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="cmndUpdate" name="cmndUpdate" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Mật khẩu
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="matkhauUpdate" name="matkhauUpdate" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Email
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="email" id="emailUpdate" name="emailUpdate" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Chức vụ
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="chucvuUpdate" name="chucvuUpdate" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Loại tài khoản
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <select name="loaitaikhoanUpdate" class="form-control" id="loaitaikhoanUpdate">
                      <?php foreach ($loaitk['mangloaitk'] as $value): ?>
                        <option value="<?= $value['id'] ?>" > <?= $value['tenloai']?></option>
                      <?php endforeach ?> 
                    </select>
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đơn vị quản lí
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <select name="donviUpdate" class="form-control" id="donviUpdate">
                      <option value="" > --Chọn-- </option>
                      <?php foreach ($dv['mangdv'] as $value): ?>
                        <option value="<?= $value['id'] ?>" > <?= $value['tendonvi']?></option>
                      <?php endforeach ?> 
                    </select>
                </div>
          </div>
         
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>
        <!-- footer content -->
        <footer>
          <?php $this->load->view('master/footer')?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script type="text/javascript">

    function dialogDelete()
    {
      if(window.confirm("Bạn có chắc xóa")==true){
        return true;
      }
      return false;
    }

    function setvalue(obj)
    {
      var id=obj.id;
      var hotenUpdate=($("#"+id).attr("hoten"));
      var cmndUpdate=($("#"+id).attr("cmnd"));
      var matkhauUpdate=($("#"+id).attr("matkhau"));
      var emailUpdate=($("#"+id).attr("email"));
      var chucvuUpdate=($("#"+id).attr("chucvu"));
      var loaitaikhoanUpdate=($("#"+id).attr("maloaitk"));
      var donviUpdate=($("#"+id).attr("madonvi"));

      document.getElementById("hotenUpdate").value = hotenUpdate;
      document.getElementById("cmndUpdate").value = cmndUpdate;
      document.getElementById("matkhauUpdate").value = matkhauUpdate;
      document.getElementById("emailUpdate").value = emailUpdate;
      document.getElementById("chucvuUpdate").value = chucvuUpdate;
      document.getElementById("loaitaikhoanUpdate").value = loaitaikhoanUpdate;
      document.getElementById("donviUpdate").value = donviUpdate;
      document.getElementById("idUpdate").value = id;
      $("#modalsua").modal();
    }
    
      function themajax(){
          $.ajax({
            url: 'themtaikhoan',
            type: 'POST',
            // dataType: 'json',
            data: {
              hoten: $('#hoten').val(),
              cmnd: $('#cmnd').val(),
              matkhau: $('#matkhau').val(),
              email: $('#email').val(),
              chucvu: $('#chucvu').val(),
              loaitaikhoan: $('#loaitaikhoan').val(),
              donvi: $('#donvi').val()
            },
            success: function (data) {
              window.location.href = data;
            },
          })
          .done(function() {
            console.log("success");
          })
          .fail(function() {
            console.log("error");
          })
          
          $('#modalthem').modal('toggle');
      }


    </script>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>vendors/jquery/dist/jquery.min.js"> </script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>build/js/custom.min.js"></script>

  </body>
</html>