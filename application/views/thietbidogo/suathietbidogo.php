<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Cập nhật thiết bị đồ gỗ</title>

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

  <body class="nav-md" onload="loadPhongKho()">
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
                <h3>Cập nhật thiết bị đồ gỗ</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              

              <form method="post" 
              action="<?php echo thietbidogo_url('danhsachthietbidogocontroller/capnhatdogo') ?>">
                <div class="form-group">
                  <label for="exampleFormControlInput1">Mã số</label>
                  <input name="iddogo" type="hidden" class="form-control" hidden="hidden" 
                    value="<?php echo $dogo->id ?>" >
                  <input type="text" class="form-control" name='maso' value="<?php echo $dogo->maso ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Tên thiết bị</label>
                  <input type="text" class="form-control" name='tentb' value="<?php echo $dogo->tentb ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Mô tả</label>
                  <input type="text" class="form-control" name='mota' value="<?php echo $dogo->mota ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Chất lượng</label>
                  <input type="text" class="form-control" name='chatluong' value="<?php echo $dogo->chatluong ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Năm sử dụng</label>
                  <input type="text" class="form-control" name='namsd' value="<?php echo $dogo->namsd ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Nguồn gốc</label>
                  <input type="text" class="form-control" name='nguongoc' value="<?php echo $dogo->nguongoc ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Đơn vị tính</label>
                  <input type="text" class="form-control" name='donvitinh' value="<?php echo $dogo->donvitinh ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Số lượng</label>
                  <input type="text" class="form-control" name='soluong' value="<?php echo $dogo->soluong ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Giá</label>
                  <input type="text" class="form-control" name='gia' value="<?php echo $dogo->gia ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Ghi chú</label>
                  <input type="text" class="form-control" name='ghichu' value="<?php echo $dogo->ghichu ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Tình trạng</label>
                  <input type="text" class="form-control" value="<?php echo $dogo->tinhtrang ?>" readonly>

                  <select multiple class="form-control" name="tinhtrang[]" style="height: 100px">
                    <option value="Hư hỏng">Hư hỏng</option>
                    <option value="Đang sử dụng">Đang sử dụng</option>
                    <option value="Chưa sử dụng">Chưa sử dụng</option>
                    <option value="Chờ thanh lý">Chờ thanh lý</option>
                    <option value="Đã thanh lý">Đã thanh lý</option>
                  </select>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="text-center">
                      <button class="btn btn-primary form-control input-sm" style="width: 300px" type="submit">Lưu lại</button>
                    </div>
                  </div>
                </div>

              </form>

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


      let mangphong = '<?php echo json_encode($phong['mangphong']); ?>';
      let maphongkho = '<?php echo $dogo->maphongkho; ?>';

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
                  opt.appendChild( document.createTextNode(element['tenphong']));
                  opt.value = element['id']; 
                  opt.selected = true;
                  sel.appendChild(opt);
                }
                else
                {
                  let opt = document.createElement('option');
                  opt.appendChild( document.createTextNode(element['tenphong']));
                  opt.value = element['id']; 
                  sel.appendChild(opt);
                }
            }
          });    
      }

      function loadPhongKho()
      {
          let madonvi = document.getElementById('donvi').value;
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
                  opt.appendChild( document.createTextNode(element['tenphong']));
                  opt.value = element['id']; 
                  opt.selected = true;
                  sel.appendChild(opt);
                }
                else
                {
                  let opt = document.createElement('option');
                  opt.appendChild( document.createTextNode(element['tenphong']));
                  opt.value = element['id']; 
                  sel.appendChild(opt);
                }
            }
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