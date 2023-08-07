<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Chi tiết mua sắm</title>

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
                <h3>Danh sách vật tư đề nghị</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
               
                  <div class="x_content">

                    <form action="<?= nguoidung_url("muasamvattucontroller/luuthietbi_denghi") ?>" method="POST">
                      <input name="key" value="<?php echo $key ?>" type="hidden" hidden="hidden" >
                      
                      <div class="form-group">
                        <label>Về việc đề nghị:</label>
                        <textarea name="veviecdenghi" class="form-control"><?php echo $denghi->veviecdenghi ?></textarea>
                      </div>

                      <div class="form-group">
                        <label>Nội dung đề nghị:</label>
                        <textarea name="noidungdenghi" class="form-control"><?php echo $denghi->noidungdenghi ?></textarea>
                      </div>

                      <table class="table" style="font-size: 15px">
                        <thead>
                          <tr>
                            <th>Tên thiết bị</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                          </tr>
                        </thead>


                        <tbody class="them">
                          <?php foreach ($mangtb as $item): ?>
                            <input name="idtbmua[]" value="<?php echo $item['id'] ?>" type="hidden" hidden="hidden" >
                            <tr>
                              <td style="vertical-align: middle;">
                                <textarea name="tentb[]" class="form-control" style="border: none;" rows="4"><?php echo $item['tentb'] ?>
                                </textarea>
                              </td>
                              <td style="vertical-align: middle;">
                                <textarea name="mota[]" class="form-control" style="border: none;width: auto;" rows="5" cols="42"><?php echo $item['mota'] ?>
                                </textarea>
                              </td>
                              <td style="vertical-align: middle;">
                                <textarea name="gia[]" class="form-control" style="border: none;width: auto;" cols="8">
                                  <?= number_format($item['gia'], 0, '', ',') ?>
                                </textarea>  
                              </td>
                              <td style="vertical-align: middle;">
                                <input type="number" class="form-control" name="soluong[]" style="border: none;width: 40%;text-align: center;" value="<?= number_format($item['soluong'], 0, '', ',') ?>">
                              </td>
                              <td style="vertical-align: middle;">
                                <select name="trangthai[]" class="form-control">
                                  <option value="chuamua" <?php if($item['trangthai'] == "chuamua") echo "selected" ?>>Chưa mua</option>
                                  <option value="damua" <?php if($item['trangthai'] == "damua") echo "selected" ?>>Đã mua</option>
                                  
                                </select>
                              </td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>

                      <button type="submit" class="btn btn-primary" style="float: right">LƯU LẠI</button>
                    </form>
                    
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
    <script type="text/javascript">
    window.onload = function() {
        $('.dataTables_filter input[type="search"]').css(
           {'width':'8em','display':'inline-block'}
        );
    }

    $( document ).ready(function() {
      
    });

    $('body').on('click', '[data-editable]', function(){
  
      var $el = $(this);
                  
      var $input = $('<textarea/>').val( $el.text() );
      $el.replaceWith( $input );
      $input.focus();
      var save = function(){
        $el.text($input.val());
        $input.replaceWith( $el );
      };
      
      $input.one('blur', save);
      
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

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>build/js/custom.min.js"></script>

  </body>
</html>