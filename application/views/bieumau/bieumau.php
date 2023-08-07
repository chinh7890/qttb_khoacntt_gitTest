<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Biểu mẫu</title>

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
                <h3>DANH SÁCH BIỂU MẪU</h3>
              </div>

              
              <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                <div class="title_right">
                  <div class="form-group pull-right top_search">
                    <div class="input-group" data-toggle="modal" data-target="#modalthem">
                      <a class="btn btn-primary">
                        <i class="fa fa-plus"></i> Thêm mới
                      </a>
                    </div>
                  </div>
                </div>
              <?php endif ?>
              


            </div>

            <div class="clearfix"></div>

            <div class="row">
              



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
               
                  <div class="x_content">

                    <table id="datatable-buttons" class="table table-striped" style="font-size: 15px">
                      <thead>
                        <tr>
                          
                          <th>Tên biểu mẫu</th>
                          <th>Tên tập tin</th>
                          <?php if ($this->session->userdata("quyenhan") == 1): ?>
                            <th>Thao tác</th>
                          <?php endif ?>
                        </tr>
                      </thead>


                      <tbody class="them">
                         <?php foreach ($bm as $value): ?>
                          <tr>
                            <td><?= $value->tenbieumau ?></td>
                            <td style="text-decoration: underline;">
                              <a href="<?= public_url('bieumaunguoidung/').$value->tentaptin ?>">
                                <?= $value->tentaptin ?></a>  
                            </td>
                            <?php if ($this->session->userdata("quyenhan") == 1): ?>
                              <td>
                                  <a 
                                    id="<?= $value->id?>" 
                                    tenbieumau="<?= $value->tenbieumau ?>"
                                    onclick="setvalue(this)">
                                    <i class="fa fa-pencil-square-o" style="color:blue"></i>
                                  </a>

                                  <a onclick="return dialogDelete()" 
                                    href="<?php echo nguoidung_url('bieumaucontroller/xoabieumau/').$value->id; ?>">
                                    <i class="fa fa-trash" style="color:red"></i>
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
        <h2 class="modal-title" style="font-size: 20px; float: left;"><p>THÊM ĐỀ NGHỊ</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal form-label-left" action="<?= nguoidung_url("bieumaucontroller/thembieumau") ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên biểu mẫu</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="text" name="tendenghi" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Biểu mẫu (Dạng file)</label>
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


<!-- Modal sửa-->
<div class="modal fade" id="modalsua" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>CẬP NHẬT BIỂU MẪU</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="<?= nguoidung_url("bieumaucontroller/capnhatbieumau") ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên biểu mẫu</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
              <input type="text" id="tendenghiUpdate" name="tendenghi" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Biểu mẫu (Dạng file)</label>
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
      var tendenghi=($("#"+id).attr("tenbieumau"));

      document.getElementById("tendenghiUpdate").value = tendenghi;
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