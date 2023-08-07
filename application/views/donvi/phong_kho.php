<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Phòng - Kho</title>

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

  <body class="nav-md" onload="laydulieu()">
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
                <h3>Danh sách phòng kho</h3>
              </div>

              <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                <div class="title_right">
                  <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group"  data-toggle="modal" data-target="#modalthem">
                      <a class="btn btn-primary">
                        <i class="fa fa-plus"></i> Thêm kho
                      </a>
                      
                    </div>
                  </div>

                  <div class="form-group pull-right top_search">
                    <div class="input-group">
                      <a class="btn btn-primary" href="<?= public_url('bieumau/BM_KHO.xls') ?>">
                        <i class="fa fa-file"></i> Biểu mẫu thêm
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

                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Đơn vị quản lí</label>
                      <select class="form-control" id="donviLoc" onchange="laydulieu()">
                        <?php foreach ($dv['mangdv'] as $value): ?>
                          <option value="<?= $value['id'] ?>"><?= $value['tendonvi'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 15px">
                      <thead>
                        <tr>
                          <th>Mã phòng</th>
                          <th>Tên phòng</th>
                          <th>Khu</th>
                          <th>Lầu</th>
                          <th>Số phòng</th>
                          <th>Giáo viên quản lý</th>
                          <th>Đơn vị</th>
                          <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                            <th>Thao tác</th>
                          <?php endif; ?>
                        </tr>
                      </thead>

                      <!-- <tbody class="them">
                      	 <?php foreach ($phong['mangphong'] as $value): ?>
	                        <tr>
	                          
	                          <td><?= $value['maphong']?></td>
	                          <td><?= $value['tenphong']?></td>
	                          <td><?= $value['khu']?></td>
	                          <td><?= $value['lau']?></td>
	                          <td><?= $value['sophong']?></td>
	                          <td>
                              <?php  
                                foreach ($tk['mangtk'] as $taikhoan) {
                                  if($taikhoan['id'] == $value['magvql'])
                                  {
                                      echo $taikhoan['hoten'];
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
                              <td>
                       

                                  <button class="btn btn-primary" 
                                    id="<?= $value['id']?>" 
                                    maphong="<?= $value['maphong']?>"
                                    tenphong="<?= $value['tenphong']?>"
                                    khu="<?= $value['khu']?>"
                                    lau="<?= $value['lau']?>"
                                    sophong="<?= $value['sophong']?>"
                                    magvql="<?= $value['magvql']?>"
                                    madonvi="<?= $value['madonvi']?>"
                                    onclick="setvalue(this)"
                                    style="width: 90px">
                                    Cập nhật
                                  </button>

                                  <a class="btn btn-danger" onclick="return dialogDelete()" 
                                    href="<?php echo donvi_url('phong_khocontroller/xoaphongkho/').$value['id']; ?>"
                                    style="width: 90px">Xóa</a>

                              </td>
                            <?php endif; ?>
	                          
	                        </tr>
                         <?php endforeach ?>
                        
                      </tbody> -->
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
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Thêm phòng kho mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left">
        <div class="modal-body">
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Chọn file excel
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <input type="file" name="file" id="file" required accept=".xls, .xlsx" class="form-control col-md-7 col-xs-12"/>
                </div>
          </div>

          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Giáo viên quản lý
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <select name="magv" class="form-control" id="magv">
                      <?php foreach ($tk['mangtk'] as $value): ?>
                        <option value="<?= $value['id'] ?>" > <?= $value['hoten']?></option>
                      <?php endforeach ?> 
                    </select>
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đơn vị
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  	<select name="donvi" class="form-control" id="donvi">
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
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Cập nhật phòng kho</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="capnhatphongkho" method="POST">
        <div class="modal-body">
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Mã phòng </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
                  <input type="text" id="maphongUpdate" name="maphongUpdate" required="required" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên phòng
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="tenphongUpdate" name="tenphongUpdate" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Khu
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="khuUpdate" name="khuUpdate" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Lầu
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="lauUpdate" name="lauUpdate" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Số phòng
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="sophongUpdate" name="sophongUpdate" class="form-control col-md-7 col-xs-12">
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Giáo viên quản lý
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <select name="magvUpdate" class="form-control" id="magvUpdate">
                      <?php foreach ($tk['mangtk'] as $value): ?>
                        <option value="<?= $value['id'] ?>" > <?= $value['hoten']?></option>
                      <?php endforeach ?> 
                    </select>
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đơn vị
                 </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <select name="donviUpdate" class="form-control" id="donviUpdate">
                      <?php foreach ($dv['mangdv'] as $value): ?>
                        <option value="<?= $value['id'] ?>" > <?= $value['tendonvi']?></option>
                      <?php endforeach ?> 
                    </select>
                </div>
          </div>
         
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary" >Lưu</button>
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
      var maphongUpdate=($("#"+id).attr("maphong"));
      var tenphongUpdate=($("#"+id).attr("tenphong"));
      var khuUpdate=($("#"+id).attr("khu"));
      var lauUpdate=($("#"+id).attr("lau"));
      var sophongUpdate=($("#"+id).attr("sophong"));
      var magvUpdate=($("#"+id).attr("magvql"));
      var donviUpdate=($("#"+id).attr("madonvi"));

      document.getElementById("maphongUpdate").value = maphongUpdate;
      document.getElementById("tenphongUpdate").value = tenphongUpdate;
      document.getElementById("khuUpdate").value = khuUpdate;
      document.getElementById("lauUpdate").value = lauUpdate;
      document.getElementById("sophongUpdate").value = sophongUpdate;
      document.getElementById("magvUpdate").value = magvUpdate;
      document.getElementById("donviUpdate").value = donviUpdate;
      document.getElementById("idUpdate").value = id;
      $("#modalsua").modal();
    }
    
    function themajax(){
      var fd = new FormData();    
      fd.append( 'file', file.files[0] );

      var e = document.getElementById("donvi");
      fd.append( 'donvi', e.options[e.selectedIndex].value);

      var e = document.getElementById("magv");
      fd.append( 'magv', e.options[e.selectedIndex].value);

      $.ajax({
        url: 'themphongkhomoi',
        type: 'POST',
        data: fd,
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          $('#file').val('');
          window.location.href = data;
        }
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      });
      $('#modalthem').modal('toggle');
    }

  var quyenhan = "<?php echo $this->session->userdata('quyenhan');?>";

  function laydulieu()
  {
    $.ajax({
        url: "<?= donvi_url('phong_khocontroller/laydulieu') ?>",
        method: "POST",
        async: false,
        data: {
          madonvi: $('#donviLoc').val(),
        },
        type: "application/json",
        success: function (data) {
            var data = JSON.parse(data);
            // var baseurl = window.location.origin+"/quanlythietbi/maymocthietbi/danhsachmaymocthietbicontroller/";
            
            const bangKetQua = $('#datatable-buttons').DataTable();

            if (data.length != 0) {
                bangKetQua.clear();
                for (let x of data) {

                  // xác định đường dẫn xóa thiết bị
                  // var urlCapNhat = baseurl + "loadmaymocthietbi/";
                  // var urlXoa = baseurl + "xoamaymocthietbi/";
                  // urlCapNhat = urlCapNhat+ x.id;
                  // urlXoa = urlXoa+ x.id;


                  var thaotac = '<button class="btn btn-primary btn-sm" id="'+x.id+'" maphong="'+x.maphong+'" tenphong="'+x.tenphong+'" khu="'+x.khu+'" lau="'+x.lau+'" sophong="'+x.sophong+'" magvql="'+x.magvql+'" madonvi="'+x.madonvi+'" onclick="setvalue(this)"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>'+
                                '<a class="btn btn-danger btn-sm" onclick="return dialogDelete()" href="<?php echo donvi_url('phong_khocontroller/xoaphongkho/'); ?>'+x.id+'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                    var rowNode = bangKetQua.row.add([
                        x.maphong,
                        x.tenphong,
                        x.khu,
                        x.lau,
                        x.sophong,
                        x.hoten,
                        x.tendonvi,
                        thaotac
                    ])
                    .draw(false);
                }
            }
            else
            {
              bangKetQua.clear().draw();
            }
        },
    });
    
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