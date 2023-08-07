<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Nhóm máy móc thiết bị</title>

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
                <h3>Danh sách nhóm máy móc thiết bị</h3>
              </div>

              
              <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                <div class="title_right">
                  <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" data-toggle="modal" data-target="#modalthem">
                      <a class="btn btn-app">
                        <i class="fa fa-plus"></i> Thêm mới
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
                          
                          <th>Tên nhóm</th>
                         
                          <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                            <th>Thao tác</th>
                          <?php endif; ?>
                        </tr>
                      </thead>


                      <tbody class="them">
                      	 <?php foreach ($mangketqua as $value): ?>
	                        <tr>
	                          
	                          <td><?= $value['tennhom']?></td>
	                         
                            <?php if ($this->session->userdata('quyenhan') == "1") : ?>
                              <td>

                                  <button class="btn btn-primary" 
                                    id="<?= $value['id']?>" 
                                    tennhom="<?= $value['tennhom']?>"
                                    onclick="setvalue(this)"
                                    style="width: 90px">
                                    Cập nhật
                                  </button>

                                  <a class="btn btn-danger" onclick="return dialogDelete()" 
                                    href="<?php echo maymocthietbi_url('nhommaymocthietbicontroller/xoanhommaymocthietbi/').$value['id']; ?>"
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
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Thêm nhóm máy móc thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left">
        <div class="modal-body">
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên nhóm </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input type="text" id="tennhom" name="tennhom" required="required" class="form-control col-md-7 col-xs-12">
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

<!-- Modal câp nhật-->
<div class="modal fade" id="modalsua" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Sửa nhóm thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="capnhatnhomthietbi" method="POST">
        <div class="modal-body">
          <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên nhóm </label>
                <div class="col-md-9 col-sm-6 col-xs-12">
                  <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
                  <input type="text" id="tennhomUpdate" name="tennhomUpdate" required="required" class="form-control col-md-7 col-xs-12">
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
      var tennhomUpdate=($("#"+id).attr("tennhom"));
      document.getElementById("tennhomUpdate").value = tennhomUpdate;
      document.getElementById("idUpdate").value = id;
      $("#modalsua").modal();
    }
    
      function themajax(){
          $.ajax({
            url: 'themnhommaymocthietbi',
            type: 'POST',
            // dataType: 'json',
            data: {
              tennhom: $('#tennhom').val(),
            
            },
          })
          .done(function() {
            console.log("success");
          })
          .fail(function(jqXHR, textStatus) {
             console.log( "Request failed: " + textStatus );
          })
          .always(function() {
            console.log("complete");
            nd='<tr>';
            nd+='<td>'+$('#tennhom').val()+'</td>';
          
           
            nd+='<td>';
            // nd+='<i class="fa fa-pencil-square-o" style="color: blue"></i>  &nbsp &nbsp &nbsp';
            // nd+='<i class="fa fa-trash" style="color: red"></i>';
            nd+='</td>';
            nd+='</tr>';
            $('.them').append(nd);
            $('#tennhom').val('');
           
                           
                          
          });
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