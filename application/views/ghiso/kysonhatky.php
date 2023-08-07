<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">
    <title>Học kỳ sổ nhật ký</title>

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

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/toastr/build/toastr.min.css">

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
                <h3>Học kỳ sổ nhật ký</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <?php if ($this->session->userdata("quyenhan") == 1 ||
                            $this->session->userdata("quyenhan") == 2  ): ?>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalthem">
                      <i class="fa fa-university"></i> 
                        Thêm học kỳ
                    </button>
                    <button class="btn btn-primary" id="btnLuuHocKy">
                      <i class="fa fa-save"></i> 
                        Lưu học kỳ hiện tại
                    </button>
                  <?php endif ?>
                  

                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped" style="font-size: 15px">
                      <thead>
                        <tr>
                          <th>Học kỳ</th>
                          <th>Từ năm</th>
                          <th>Đến năm</th>
                          <th>Học kỳ hiện tại</th>
                          <?php if ($this->session->userdata("quyenhan") == 1 ||
                                    $this->session->userdata("quyenhan") == 2  ): ?>
                            <th>Thao tác</th>
                          <?php endif ?>
                        </tr>
                      </thead>

                      <tbody class="them">
                         <?php foreach ($hocky as $value): ?>
                          <tr>
                            <td><?= $value->hocky ?></td>
                            <td><?= $value->tunam ?></td>
                            <td><?= $value->dennam ?></td>
                            <td>
                              <?php if ($value->current == 1): ?>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="hockyhientai" id="hockyhientai" value="<?php echo $value->id ?>" checked>
                                  <label class="form-check-label" for="hockyhientai">
                                    Học kỳ hiện tại
                                  </label>
                                </div>
                              <?php else: ?>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="hockyhientai" value="<?php echo $value->id ?>">
                                </div>
                              <?php endif ?>
                            </td>
                            <?php if ($this->session->userdata("quyenhan") == 1 ||
                                    $this->session->userdata("quyenhan") == 2  ): ?>
                              <td style="text-align: center;">
                                  <button 
                                    class="btn btn-primary"
                                    id="<?= $value->id ?>" 
                                    hocky="<?= $value->hocky ?>"
                                    tunam="<?= $value->tunam ?>"
                                    dennam="<?= $value->dennam ?>"
                                    onclick="setvalue(this)">
                                    Sửa
                                  </button>
                                  <a 
                                      class="btn btn-danger"
                                      onclick="return dialogDelete()"
                                      href="<?php echo nguoidung_url('nhatkycontroller/xoahocky/').$value->id; ?>">
                                      Xóa
                                  </a>  

                              </td>
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
      <form class="form-horizontal form-label-left">
        <div class="modal-body">
          
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Học kỳ</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control" id="hocky" name="hocky" 
                  required="required" class="form-control col-md-7 col-xs-12">
                <option value="1">Học kỳ 1</option>
                <option value="2">Học kỳ 2</option>
                <option value="phụ 1">Học kỳ phụ 1</option>
                <option value="phụ 2">Học kỳ phụ 2</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Từ năm</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="number" id="tunam" name="tunam" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đến năm</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="number" id="dennam" name="dennam" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

        </div>
        <div class="modal-footer">
         
          <button type="button" class="btn btn-primary" onclick="them()">Lưu</button>
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
      <form class="form-horizontal form-label-left" action="capnhathocky" method="POST">
        <div class="modal-body">
          
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Học kỳ</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
              <select class="form-control" id="hockyUpdate" name="hockyUpdate" 
                  required="required" class="form-control col-md-7 col-xs-12">
                <option value="1">Học kỳ 1</option>
                <option value="2">Học kỳ 2</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Từ năm</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="number" id="tunamUpdate" name="tunamUpdate" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Đến năm</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="number" id="dennamUpdate" name="dennamUpdate" required="required" class="form-control col-md-7 col-xs-12">
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
    window.onload = function() {
         $('.dataTables_filter input[type="search"]').css(
           {'width':'8em','display':'inline-block'}
        );
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
      var hockyUpdate=($("#"+id).attr("hocky"));
      var tunamUpdate=($("#"+id).attr("tunam"));
      var dennamUpdate=($("#"+id).attr("dennam"));

      document.getElementById("hockyUpdate").value = hockyUpdate;
      document.getElementById("tunamUpdate").value = tunamUpdate;
      document.getElementById("dennamUpdate").value = dennamUpdate;
      document.getElementById("idUpdate").value = id;
      $("#modalsua").modal();
    }

    function them(){
      $.ajax({
        url: 'themhocky',
        type: 'POST',
        data: {
          hocky: $("#hocky").val(),
          tunam: $("#tunam").val(),
          dennam: $("#dennam").val()
        },
        success: function (data) {
          window.location.href = data;
        },
        error: function (xhr, status, errorThrown) {
          alert("Có lỗi xảy ra");
        }
      });
      $('#modalthem').modal('toggle');
    }

    $("#btnLuuHocKy").click(function(){
      $('#modalLoading').modal('show');
      let selected = $("input[type='radio'][name='hockyhientai']:checked");
      let idhocky = selected.val();

      setTimeout(function(){ 
        $.ajax({
            url: "luuhockyhientai",
            method: "POST",
            async: false,
            data: {
              idhocky: idhocky,
            },
            success: function (data) {
              $('#modalLoading').modal('hide');
              toastr.success("Cập nhật thành công", 'Thông báo');
              window.location.href = data;
            },
            error: function (xhr, status, errorThrown) {
              toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
            }
        });
      }, 500);
    });


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

    <!-- Toastr -->
    <script src="<?= base_url() ?>/assets/toastr/build/toastr.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>build/js/custom.min.js"></script>

  </body>
</html>