<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Thêm danh sách thiết bị đồ gỗ</title>

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

    <link rel="stylesheet" href="<?= base_url('js/loadbar/style.css') ?>">
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
                <h3>Thêm danh sách thiết bị đồ gỗ</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              
              <form class="form-horizontal form-label-left" method="post" id="import_form" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Chọn file excel </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <input type="file" name="file" id="file" required accept=".xls, .xlsx" class="form-control col-md-7 col-xs-12"/>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Đơn vị </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="donvi" class="form-control" id="donvi" required="required"> 
                          <option value="" > --Chọn--</option>
                          <?php foreach ($dv as $value): ?>
                            <option value="<?= $value['id'] ?>" > <?= $value['tendonvi']?></option>
                          <?php endforeach ?> 
                        </select>
                      </div>
                  </div>

                  <div class="form-group" style="text-align: center;">
                      <a style="font-style: italic;color: red; font-weight:bold" href="<?= public_url('bieumau/BM_THEM.xls') ?>">Tải biểu mẫu thêm</a> <br>
                      <button type="button" class="btn btn-success" onclick="importAjax()"><i class="fa fa-upload" aria-hidden="true"></i> Tải lên</button>
                  </div>

                </div>

              </form>
              <form class="form-horizontal form-label-left" method="post" action="<?= thietbidogo_url('danhsachthietbidogocontroller/luuthietbi') ?>">
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu dữ liệu</button>
                </div>
                <div id="dongloi" style="color: red; font-weight: bold"></div>
                <table class="table table-striped table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col" style="text-align: center">Chọn hết<br><input type="checkbox" id="check_all"></th>
                      <th>#</th>
                      <th>Tên thiết bị</th>
                      <th>Mô tả</th>
                      <th>Model</th>
                      <th>Năm sử dụng</th>
                      <th>Nguồn gốc</th>
                      <th>Đơn vị tính</th>
                      <th>Giá</th>
                      <th> Phòng kho </th>
                      <th>Chất lượng</th>
                      <th>Ghi chú</th>
                      <th>Loại</th>
                      <th>Tình trạng</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><td colspan='14' align="center">Chưa có dữ liệu</td></tr>
                  </tbody>
                </table>

                
              </form>

            </div>
          </div>
        </div>
        

        <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cf1d16"/></svg></div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <?php $this->load->view('master/footer')?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script type="text/javascript">

      function chonDonVi(obj){
          let madonvi = obj.value;
          let arrPhong = JSON.parse(mangphong);
          let sel = document.getElementById('maphongkho');

          // clear select box
          let length = sel.length;
          if(length >= 1)
          {
            sel.options.length = 0;
          }

          // add option for select
          let opt = document.createElement('option');
          opt.appendChild( document.createTextNode('--Chọn--'));
          opt.value = ""; 
          sel.appendChild(opt); 
          arrPhong.forEach(function(element) {
            if(madonvi == element['madonvi'])
            {
                if(element['id'] == maphongkho)
                {
                  let opt = document.createElement('option');
                  opt.appendChild( document.createTextNode(element['maphong']));
                  opt.value = element['id']; 
                  opt.selected = true;
                  sel.appendChild(opt);
                }
                else
                {
                  let opt = document.createElement('option');
                  opt.appendChild( document.createTextNode(element['maphong']));
                  opt.value = element['id']; 
                  sel.appendChild(opt);
                }
            }
          });    
      }

      $("#check_all").change(function() {
        $("input[name='mangthietbi[]'").prop( "checked" , this.checked );
      });

      $('form').submit(function() 
      {
          $('#loader').addClass('show');
      }) 


      function importAjax(){
        $('#loader').addClass('show');

        var fd = new FormData();    
        fd.append( 'file', file.files[0] );
        var e = document.getElementById("donvi");
        fd.append( 'madonvi', e.options[e.selectedIndex].value);

        $.ajax({
          url:"<?php echo thietbidogo_url('danhsachthietbidogocontroller/loadDataExcel'); ?>",
          method:"POST",
          data:fd,
          contentType:false,
          cache:false,
          processData:false,
          success:function(data){
            $('#file').val('');
            var data = JSON.parse(data);
            var arr = data.data;
            
            // hiển thị dòng bị lỗi
            strError = "";
            data.error.forEach(element => strError+= "<br>"+element);
            $( "#dongloi" ).html("Dòng dữ liệu không đọc: "+strError);

            // dữ liệu được load
            $("table tbody tr").remove(); 
            var lineNo = 1;
            tableBody = $("table tbody"); 
            if (arr.length != 0) {
                for (let x of arr) {
                  let stringJson = '{"tentb": "'+x.tentb+'", "mota": "'+x.mota+'", "namsd": "'+x.namsd+'", "nguongoc": "'+x.nguongoc+'", "donvitinh": "'+x.donvitinh+'", "soluong": "'+x.soluong+'", "gia": "'+x.gia+'", "ghichu": "'+x.ghichu+'", "model": "'+x.model+'", "maphongkho": "'+x.maphongkho+'", "maloai": "'+x.maloai+'", "tinhtrang": "'+x.tinhtrang+'", "chatluong": "'+x.chatluong+'", "tontai": "'+x.tontai+'"}';

                  markup = "<tr>"; 
                  markup += "<td><input type='checkbox' name='mangthietbi[]' value='"+stringJson+"' /></td>";
                  markup += "<th scope='row'>"+ lineNo + "</td>"; 
                  markup += "<td>"+ x.tentb + "</td>"; 

                  let mota = (x.mota !== null) ? x.mota : "";
                  let namsd = (x.namsd !== null) ? x.namsd : "";
                  let gia = (x.gia !== null) ? dinhdangtiente(x.gia) : "";
                  let ghichu = (x.ghichu !== null) ? x.ghichu : "";

                  markup += "<td>"+ mota + "</td>"; 
                  markup += "<td>"+ x.model + "</td>"; 
                  markup += "<td>"+ namsd + "</td>"; 
                  markup += "<td>"+ x.nguongoc + "</td>"; 
                  markup += "<td>"+ x.donvitinh + "</td>"; 

                  markup += "<td>"+ gia + "</td>"; 
                  markup += "<td>"+ x.tenphongkho + "</td>"; 
                  markup += "<td>"+ x.chatluong + "</td>"; 
                  markup += "<td>"+ ghichu + "</td>"; 
                  markup += "<td>"+ x.tenloai + "</td>"; 
                  markup += "<td>"+ x.tinhtrang + "</td>"; 

                  markup += "</tr>"; 
                  tableBody = $("table tbody"); 
                  tableBody.append(markup); 
                  lineNo++; 
                }
            }
            else
            {
              tableBody.append("<tr><td colspan='14' align='center'>Chưa có dữ liệu</td></tr>"); 
            }


            $('#loader').removeClass('show');
          },
          error: function (jqXHR, exception) {
            $('#loader').removeClass('show');
          }
        });

        
      }

    function dinhdangtiente(nStr) {
      if(nStr == null){
        return "-";
      }else{
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        x2 = x2.substring(0,3);
        return x1 + x2;
      } 
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
    <script src="<?= base_url('js/loadbar/aos.js') ?>"></script>
    <script src="<?= base_url('js/loadbar/main.js') ?>"></script>

  </body>
</html>