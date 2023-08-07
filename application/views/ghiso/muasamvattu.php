<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Mua sắm vật tư</title>

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
                <h3>Danh sách đề nghị mua sắm vật tư</h3>
              </div>

              
              
              <div class="title_right">
                <div class="form-group pull-right top_search">
                  <div class="input-group" data-toggle="modal" data-target="#modalthem">
                    <a class="btn btn-primary">
                      <i class="fa fa-plus"></i> Thêm mới
                    </a>
                  </div>
                </div>
                 <div class="form-group pull-right top_search">
                  <div class="input-group" data-toggle="modal" data-target="#modalthemexcel">
                    <a class="btn btn-primary">
                      <i class="fa fa-file-excel-o"></i> Thêm bằng file excel
                    </a>
                  </div>
                </div>
              </div>
              

            </div>

            <div class="clearfix"></div>

            <div class="row">
              



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
               
                  <div class="x_content">

                    <div class="row">
                      <div class="col-xs-8">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">HỌC KỲ</label>
                          <div class="col-sm-10">
                            <select id="hockysearch" class="form-control" onclick ="laydulieu()">
                            <?php foreach ($hocky as $val): ?>
                                <option value="<?= $val->id ?>">
                                  Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                                </option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-4" style="text-align: right;">
                        <div style="font-weight: bold;color: red">
                          Tổng giá trị trong học kỳ: 
                          <span id="tonggiatri"></span> VND
                        </div>
                      </div>
                    </div>

                    
                    <table id="datatable-buttons" class="table table-striped" style="font-size: 15px">
                      <thead>
                        <tr>
                          <th>Tên đề nghị</th>
                          <th>Xem</th>
                          <th>In đề nghị</th>
                          <th>Tình trạng</th>
                          <!-- <th>Giá trị</th> -->
                          <th>GV đề nghị</th>
                          <th>Thời gian tạo</th>
                          <th>Tên tập tin</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>


                      <tbody class="them">
                         <?php foreach ($vt as $value): ?>
                          <tr>
                            <td><?= $value->tendenghi ?></td>
                            <td>
                              <a href="<?php echo nguoidung_url('muasamvattucontroller/xemchitiet/').$value->idvt; ?>">
                                Xem chi tiết
                              </a> 
                            </td>
                            <td><a href="<?php echo nguoidung_url('muasamvattucontroller/indenghi/').$value->idvt; ?>">
                                In
                              </a> 
                            </td>
                            <td>
                             <?php if ($value->tinhtrang == "damua"): ?>
                                Đã mua
                              <?php else: ?>
                                Chưa mua
                              <?php endif ?> 
                            </td>
                            <!-- <td><?= number_format($value->giatri, 0, '', ',') ?></td> -->

                            
                            <td><?= $value->hoten ?></td>
                            <td><?= date("H:i:s d-m-Y",$value->create_at) ?></td>
                            <td style="text-decoration: underline;">
                              <a href="<?= public_url('muasamvattu/').$value->tentaptin ?>">
                                <?= $value->tentaptin ?></a>  
                            </td> 
                              <?php if ($this->session->userdata("id") == $value->magv): ?>
                                <td>
                                    <a 
                                      id="<?= $value->idvt?>" 
                                      tendenghi="<?= $value->tendenghi ?>"
                                      tinhtrang="<?= $value->tinhtrang ?>"
                                      giatri="<?= $value->giatri ?>"
                                      onclick="setvalue(this)">
                                      <i class="fa fa-pencil-square-o" style="color:blue"></i>
                                    </a>

                                    <a onclick="return dialogDelete()" 
                                      href="<?php echo nguoidung_url('muasamvattucontroller/xoadenghi/').$value->idvt; ?>">
                                      <i class="fa fa-trash" style="color:red"></i>
                                    </a> 
                                </td>
                              <?php else: ?>
                                <td></td>
                              <?php endif ?>



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
<!-- Modal thêm thủ công-->
<div class="modal fade" id="modalthem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="font-size: 20px; float: left;"><p>THÊM ĐỀ NGHỊ</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal form-label-left" action="<?= nguoidung_url("muasamvattucontroller/themdenghi") ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên đề nghị</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="text" name="tendenghi" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tình trạng
             </label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control" name="tinhtrang" required="required">
                <option value="damua">Đã mua</option>
                <option value="chuamua">Chưa mua</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tổng giá trị</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="number" name="giatri" required="required" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Loại giấy</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="kygiaonhan" name="kygiaonhan" >
                <label class="form-check-label" for="flexCheckChecked">
                  Ký giao nhận
                </label>

                <input class="form-check-input" type="checkbox" value="1" id="kythanhtoan" name="kythanhtoan">
                <label class="form-check-label" for="flexCheckChecked">
                  Ký thanh toán
                </label>
              </div>

            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đề nghị (Dạng file)</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="file" name="filedenghi" required="required" class="form-control" accept=
                ".doc, .docx, .pdf, image/*">
            </div>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">LƯU</button>
          <button type="reset" class="btn btn-secondary" >LÀM LẠI</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal thêm bằng file excel-->
<div class="modal fade" id="modalthemexcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="font-size: 20px; float: left;"><p>THÊM ĐỀ NGHỊ</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal form-label-left" action="<?= nguoidung_url("muasamvattucontroller/themdenghi_excel") ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên đề nghị</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="text" name="tendenghi" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tình trạng
             </label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control" name="tinhtrang" required="required">
                <option value="damua">Đã mua</option>
                <option value="chuamua">Chưa mua</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đề nghị (Dạng file)</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="file" name="filedenghi" required="required" class="form-control" accept=
                ".xls, .xlsx">
              <a href="<?php echo public_url('bieumau/DeNghi.xlsx') ?>">Tải file mẫu</a>
            </div>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">LƯU</button>
          <button type="reset" class="btn btn-secondary" >LÀM LẠI</button>
        </div>

      </form>
      
    </div>
  </div>
</div>


<!-- Modal sửa-->
<div class="modal fade" id="modalsua" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>CẬP NHẬT ĐỀ NGHỊ</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="<?= nguoidung_url("muasamvattucontroller/capnhatdenghi") ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên đề nghị</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
              <input type="text" id="tendenghiUpdate" name="tendenghi" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tình trạng
             </label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control" id="tinhtrangUpdate" name="tinhtrang" required="required">
                <option value="damua">Đã mua</option>
                <option value="chuamua">Chưa mua</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tổng giá trị</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="number" id="giatriUpdate" name="giatri" required="required" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đề nghị (Dạng file)</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="file" name="filedenghi" class="form-control" accept=
                ".doc, .docx, .pdf, image/*">
            </div>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">LƯU</button>
          <button type="reset" class="btn btn-secondary" >LÀM LẠI</button>
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
    window.onload = function() {
        $('.dataTables_filter input[type="search"]').css(
           {'width':'8em','display':'inline-block'}
        );
    }

    $( document ).ready(function() {
      idhocky = sessionStorage.getItem("idhocky");
      if(idhocky != null){
        $("#hockysearch").val(idhocky);
      }
      laydulieu();
    });

    function laydulieu()
    {
      // $("#loadbar").modal('show');
      idhocky = $( "#hockysearch" ).val();
      sessionStorage.setItem("idhocky", idhocky);
      setTimeout(function(){ 
        $.ajax({
          url: "<?= nguoidung_url('muasamvattucontroller/laydulieu') ?>",
          method: "POST",
          async: false,
          data: {
            idhocky: idhocky
          },
          type: "application/json",
          success: function (data) {
              let dollarUSLocale = Intl.NumberFormat('en-US');
              var data = JSON.parse(data);
              var mangketqua = data.mangketqua;

              $("#tonggiatri").text(dollarUSLocale.format(data.tonggiatri));
              var baseurl = "<?= nguoidung_url('muasamvattucontroller/') ?>";
              
              const bangKetQua = $('#datatable-buttons').DataTable();

              if (mangketqua.length != 0) {
                  bangKetQua.clear();
                  for (let x of mangketqua) {

                    // xác định đường dẫn xóa
                    var urlXoa = baseurl + "xoadenghi/"+ x.idvt;
                    var urlChiTiet = baseurl + "xemchitiet/"+x.idvt;
                    var urlIn = baseurl + "indenghi/"+x.idvt;

                    xemchitiet = '<a href="'+urlChiTiet+'">Xem chi tiết</a>';
                    indenghi = '<a href="'+urlIn+'">In</a>';

                    thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.idvt+'" tendenghi="'+x.tendenghi+'" tinhtrang="'+x.tinhtrang+'" giatri="'+x.giatri+'" onclick="setvalue(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                      +
                      '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';

                      if(x.tinhtrang == "damua"){tinhtrang = "Đã mua";}
                      else {tinhtrang = "Chưa mua";}

                      

                      if(x.giaonhan == "1" && x.thanhtoan == "1")
                        loaigiay = "Giao nhận - Thanh toán";
                      else if(x.giaonhan == "1")
                        loaigiay = "Giao nhận";
                      else if(x.thanhtoan == "1")
                        loaigiay = "Thanh toán";
                      else loaigiay = "";


                      var ts = x.create_at;
                      var ts_ms = ts * 1000;
                      // initialize new Date object
                      var date_ob = new Date(ts_ms);
                      var year = date_ob.getFullYear();
                      var month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
                      var date = ("0" + date_ob.getDate()).slice(-2);
                      var hours = ("0" + date_ob.getHours()).slice(-2);
                      var minutes = ("0" + date_ob.getMinutes()).slice(-2);
                      var seconds = ("0" + date_ob.getSeconds()).slice(-2);

                      formatted_date = hours+":"+minutes+":"+seconds+" "+date+"/"+month+"/"+year;

                      var public_url = "<?= public_url('muasamvattu/') ?>";
                      taptin = '<a href="'+ public_url + x.tentaptin + '">'+x.tentaptin+'</a>';

                      var rowNode = bangKetQua.row.add([
                          x.tendenghi,
                          xemchitiet,
                          indenghi,
                          tinhtrang,
                          // dollarUSLocale.format(x.giatri),
                          x.hoten,
                          formatted_date,
                          taptin,
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
       }, 500);
      
    }

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
      var tendenghi=($("#"+id).attr("tendenghi"));
      var tinhtrang=($("#"+id).attr("tinhtrang"));
      var giatri=($("#"+id).attr("giatri"));

      document.getElementById("tendenghiUpdate").value = tendenghi;
      document.getElementById("tinhtrangUpdate").value = tinhtrang;
      document.getElementById("giatriUpdate").value = giatri;
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

  </body>
</html>