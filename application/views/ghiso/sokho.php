<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">
    <title>Sổ quản lý kho</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
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
    <style type="text/css">
      thead{background-color: #2980B9;}
      th{
        text-align: center;
        color:black;
      }
      td{
        text-align: center;
        color:#47476b;
      }
      .modal-header{
        background-color: #2980B9; color: white
      }
    </style>
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
                <h3>Sổ quản lý kho</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modalthem">
                    <i class="fa fa-calendar"></i> 
                      Thêm lịch sử dụng
                  </button>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modalin">
                    <i class="fa fa-file"></i> 
                      In sổ nhật ký
                  </button>
                  

                  <div class="x_content">

                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>HỌC KỲ</label>
                          <select id="hockysearch" class="form-control" onchange="laydulieu()">
                            <?php foreach ($hocky as $val): ?>
                              <option value="<?= $val->id ?>">
                                Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                              </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>PHÒNG MÁY</label>
                          <select class="form-control" id="phongsearch" required="required" class="form-control" onchange="laydulieu()">
                            <option value="0">Chọn phòng</option>
                            <?php foreach ($phong as $value): ?>
                              <option value="<?= $value->id ?>"><?= $value->maphong ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    

                    <table id="datatable-buttons" class="table table-striped" style="font-size: 15px">
                      <thead>
                        <tr>
                          <th>Thiết bị</th>
                          <th>Ngày mượn</th>
                          <th>Ngày trả</th>
                          <th>Mục đích sử dụng</th>
                          <th>Tình trạng trước khi sử dụng</th>
                          <th>Tình trạng sau khi sử dụng</th>
                          <th>Giáo viên sử dụng</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
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
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('sokhocontroller/themsokho') ?>" method="POST">
        <div class="modal-body">

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>GIÁO VIÊN SỬ DỤNG</label>
                <select class="form-control" id="gvsd" name="gvsd" required="required" class="form-control">
                  <option></option>
                  <?php foreach ($giaovien as $value): ?>
                    <option value="<?= $value->id ?>"><?= $value->hoten ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>PHÒNG MÁY</label>
                <select class="form-control" id="phongmay" name="phongmay" required="required" class="form-control"
                  onchange="chonphong(this)">
                  <option></option>
                  <?php foreach ($phong as $value): ?>
                    <option value="<?= $value->id ?>"><?= $value->maphong ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>THIẾT BỊ</label>
            <select class="form-control" id="thietbi" name="thietbi" required="required" class="form-control">
            </select>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGÀY MƯỢN</label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" size="8" class="form-control" id="ngaymuon" name="ngaymuon" required="required">
                    <div class="input-group-addon">
                        <span class="fa fa-th"></span>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGÀY TRẢ</label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" size="8" class="form-control" id="ngaytra" name="ngaytra">
                    <div class="input-group-addon">
                        <span class="fa fa-th"></span>
                    </div>
                </div>
              </div>
            </div>
          </div>

          

          

          <div class="form-group">
            <label>MÔN HỌC/MỤC ĐÍCH SỬ DỤNG</label>
            <textarea id="mucdich" name="mucdich" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG TRƯỚC KHI SỬ DỤNG</label>
            <textarea id="tinhtrangtruoc" name="tinhtrangtruoc" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG SAU KHI SỬ DỤNG</label>
            <textarea id="tinhtrangsau" name="tinhtrangsau" class="form-control" rows="3"></textarea>
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

<!-- Modal cập nhật--> 
<div class="modal fade" id="modalsua" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Cập nhật</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('sokhocontroller/capnhatnhatky') ?>" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <label>TÊN THIẾT BỊ</label>
            <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
            <input id="tentbUpdate" type="text" class="form-control" disabled="disabled">
          </div>

          <div class="form-group">
            <label>NGÀY MƯỢN</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" size="8" class="form-control" id="ngaymuonUpdate" name="ngaymuon" required="required">
                <div class="input-group-addon">
                    <span class="fa fa-th"></span>
                </div>
            </div>
          </div>

          <div class="form-group">
            <label>NGÀY TRẢ</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" size="8" class="form-control" id="ngaytraUpdate" name="ngaytra" required="required">
                <div class="input-group-addon">
                    <span class="fa fa-th"></span>
                </div>
            </div>
          </div>

          <div class="form-group">
            <label>MÔN HỌC/MỤC ĐÍCH SỬ DỤNG</label>
            <textarea id="mucdichUpdate" name="mucdich" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG TRƯỚC KHI SỬ DỤNG</label>
            <textarea id="tinhtrangtruocUpdate" name="tinhtrangtruoc" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG SAU KHI SỬ DỤNG</label>
            <textarea id="tinhtrangsauUpdate" name="tinhtrangsau" required="required" class="form-control" rows="3"></textarea>
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

<!-- Modal in-->
<div class="modal fade" id="modalin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>In nhật ký</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('sokhocontroller/xuatsonhatky') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>HỌC KỲ</label>
            <select name="hockyin" class="form-control">
              <?php foreach ($hocky as $val): ?>
                <option value="<?= $val->id ?>">
                  Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>PHÒNG MÁY</label>
            <select class="form-control" name="phongmayin" required="required" class="form-control">
              <?php foreach ($phong as $value): ?>
                <option value="<?= $value->id ?>"><?= $value->maphong ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">In</button>
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
     <!-- datepicker -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js" integrity="sha512-o+RlJQ7OEtgCdvdgOJfjEASLgiLB9mA8bfWF4JnyA0cWHy7wtb4S4GRxgPor4iqKKLx0CoIFRcMecGnKSTTY1g==" crossorigin="anonymous"></script>
<script type="text/javascript">
  window.onload = function() {
         $('.dataTables_filter input[type="search"]').css(
           {'width':'8em','display':'inline-block'}
        );
    }
  // DATETIME PICKER
  $.fn.datepicker.defaults.language = 'vi';
  $.fn.datepicker.defaults.autoclose = true;
  // END DATETIME PICKER

  function chonphong(obj) {
    var maphong = obj.value;
    $.ajax({
      url: "<?= nguoidung_url('sokhocontroller/laythietbi') ?>",
      method:"POST",
      data:{
        maphong: maphong,
      },
      success:function(data){
        var arrTinh = JSON.parse(data);
        var sel = document.getElementById('thietbi');
        // clear select box
        $('#thietbi')
            .find('option')
            .remove()
            .end()
        ;

        // add option for select
        arrTinh.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['maso'] + " - "+ element['tentb']));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

    
    $( document ).ready(function() {
        idphong = sessionStorage.getItem("idphong");
        document.getElementById("phongsearch").value = idphong;
        laydulieu();
        $("#datatable-buttons").css("width", "100%");
    });
    function laydulieu()
    {
      // $("#loadbar").modal('show');
      setTimeout(function(){ 
        sessionStorage.setItem("idphong", $('#phongsearch').val());
        idphong = sessionStorage.getItem("idphong");
        idhocky = $( "#hockysearch" ).val();

        $.ajax({
          url: "<?= nguoidung_url('sokhocontroller/laydulieu') ?>",
          method: "POST",
          async: false,
          data: {
            idphong: idphong,
            idhocky: idhocky
          },
          type: "application/json",
          success: function (data) {
              var data = JSON.parse(data);
              var mangketqua = data.mangketqua;
              var baseurl = "<?= nguoidung_url('sokhocontroller/') ?>";
              
              const bangKetQua = $('#datatable-buttons').DataTable();

              if (mangketqua.length != 0) {
                  bangKetQua.clear();
                  for (let x of mangketqua) {

                    // xác định đường dẫn xóa
                    var urlXoa = baseurl + "xoanhatky/";
                    urlXoa = urlXoa+ x.idNhatKy;
                    var thaotac = "";
                    if(x.hoten == "<?= $this->session->userdata("hoten") ?>"){
                      thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.idNhatKy+'" ngaymuon="'+x.ngaymuon+'" ngaytra="'+x.ngaytra+'" mucdichsd="'+x.mucdichsd+'" tinhtrangtruoc="'+x.tinhtrangtruoc+'" tinhtrangsau="'+x.tinhtrangsau+'" maso="'+x.maso+'" tentb="'+x.tentb+'" onclick="hienthilichsu(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                          +
                          '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';
                    }
                      var rowNode = bangKetQua.row.add([
                          x.maso + " - " +x.tentb,
                          x.ngaymuon,
                          x.ngaytra,
                          x.mucdichsd,
                          x.tinhtrangtruoc,
                          x.tinhtrangsau,
                          x.hoten,
                          thaotac
                          
                      ])
                      .draw(false);
                  }
              }
              else
              {
                bangKetQua.clear().draw();
              }
              sessionStorage.setItem("idphong", $('#phongsearch').val());
              // $("#loadbar").modal('hide');
          },
      });
       }, 500);
      
    }

    function dialogDelete()
    {
      if(window.confirm("Bạn có chắc xóa")==true){
        return true;
      }
      return false;
    }

    function hienthilichsu(obj)
    {
      var id=obj.id;

      var maso=($("#"+id).attr("maso"));
      var tentb=($("#"+id).attr("tentb"));
      var ngaymuonUpdate=($("#"+id).attr("ngaymuon"));
      var ngaytraUpdate=($("#"+id).attr("ngaytra"));
      var mucdichUpdate=($("#"+id).attr("mucdichsd"));
      var tinhtrangtruocUpdate=($("#"+id).attr("tinhtrangtruoc"));
      var tinhtrangsauUpdate=($("#"+id).attr("tinhtrangsau")); 

      document.getElementById("tentbUpdate").value = maso + " - " + tentb;
      document.getElementById("ngaymuonUpdate").value = ngaymuonUpdate;
      document.getElementById("ngaytraUpdate").value = ngaytraUpdate;
      document.getElementById("mucdichUpdate").value = mucdichUpdate;
      document.getElementById("tinhtrangtruocUpdate").value = tinhtrangtruocUpdate;
      document.getElementById("tinhtrangsauUpdate").value = tinhtrangsauUpdate;
      document.getElementById("idUpdate").value = id;
      $("#modalsua").modal();
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
   <!--  <script type="text/javascript">
      $( document ).ready(function() {

              $('body').removeClass('nav-md').addClass('nav-sm');
              $('.left_col').removeClass('scroll-view').removeAttr('style');
              $('#sidebar-menu li').removeClass('active');
              $('#sidebar-menu li ul').slideUp();


             
        });
    </script> -->
  </body>
</html>