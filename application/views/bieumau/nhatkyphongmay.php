<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Nhật ký phòng máy</title>

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
                <h3>Nhật ký phòng máy</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
               
                  <div class="x_content">
                    
                    <form action="<?= nguoidung_url('bieumaucontroller/xuatnhatky') ?>" method="POST">
                      <div class="form-group">
                        <label>CHỌN KHOA</label>
                        <select class="form-control" id="selKhoa" name="selKhoa" onchange="chonkhoa(this)" required="required">
                          <option></option>
                          <?php foreach ($donvi as $dv): ?>
                            <option value="<?= $dv['id'] ?>"><?= $dv['tendonvi'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>CHỌN PHÒNG</label>
                        <select class="form-control" id="selPhong" name="selPhong" required="required">
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary">IN SỔ NHẬT KÝ PHÒNG MÁY</button>
                    </form>
                      <a href="<?= public_url('bieumau/BM-TH-03-00 (Nhat Ky Phong May)-BIA - IN.docx') ?>">NHẬT KÝ PHÒNG MÁY (BÌA) (Chọn để tải về)
                              </a>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        
        <!-- /page content -->



        <!-- footer content -->
        <footer>
          <?php $this->load->view('master/footer')?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<!-- start jQuery -->
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
<!-- end jquery -->
<script type="text/javascript">
  function chonkhoa(obj) {
    var makhoa = obj.value;
    $.ajax({
      url: "layphong",
      method:"POST",
      data:{
        makhoa: makhoa,
      },
      success:function(data){
        var arrTinh = JSON.parse(data);
        var sel = document.getElementById('selPhong');
        // clear select box
        $('#selPhong')
            .find('option')
            .remove()
            .end()
        ;

        // add option for select
        arrTinh.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['tenphong']));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }
</script>

  </body>
</html>