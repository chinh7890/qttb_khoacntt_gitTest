<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">
    <title>Trang chủ </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url();?>vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>build/css/custom.min.css?v=1" rel="stylesheet">
    <link href="<?php echo base_url('css/loadbar.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/menu.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/filter.css');?>" rel="stylesheet">
    <style type="text/css" media="screen">
        /* Create two equal columns that floats next to each other */
        .column {
          float: left;
          width: 50%;
          padding: 10px;
          height: 300px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }

        .huge{
            font-size: 30px;
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
              </div>
            </div>
          </div>

        <div class="row">
          <div class="x_panel tile">
            <div class="x_title">
              <h2>SỐ LƯỢNG MÁY MÓC THIẾT BỊ</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div style="text-align: center;width: 100%;">
                    <canvas id="maymocChart" style="margin: 0 auto;"></canvas>
                </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="x_panel tile">
            <div class="x_title">
              <h2>SỐ LƯỢNG THIẾT BỊ ĐỒ GỖ</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div style="text-align: center;width: 100%;">
                    <canvas id="dogoChart" style="margin: 0 auto;"></canvas>
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
    
<!-- start script -->
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <script>
        
        var maymoc = '<?php echo json_encode($maymoc); ?>';
        var maymoc = JSON.parse(maymoc);
        var manglabel = [];
        var mangdata = [];
        var mangcolor = [];
        maymoc.forEach(function(item){
            manglabel.push(item['tenviettat']);
            mangdata.push(item['soluong']);
            mangcolor.push(random_rgba());
        });   
        

        //máy móc
        var ctxL = document.getElementById("maymocChart").getContext('2d');
        var chartMayMoc = new Chart(ctxL, {
            type: 'horizontalBar',
            data: {
                labels: manglabel,
                datasets: [{
                    label: "MÁY MÓC THIẾT BỊ",
                    data: mangdata,
                    backgroundColor: mangcolor
                }
                ]
            },
            options: {
                responsive: true
            }
        });


        var maymoc = '<?php echo json_encode($dogo); ?>';
        var maymoc = JSON.parse(maymoc);
        var manglabel = [];
        var mangdata = [];
        var mangcolor = [];
        maymoc.forEach(function(item){
            manglabel.push(item['tenviettat']);
            mangdata.push(item['soluong']);
            mangcolor.push(random_rgba());
        });   
        

        //đồ gỗ
        var ctxL = document.getElementById("dogoChart").getContext('2d');
        var chartMayMoc = new Chart(ctxL, {
            type: 'horizontalBar',
            data: {
                labels: manglabel,
                datasets: [{
                    label: "ĐỒ GỖ",
                    data: mangdata,
                    backgroundColor: mangcolor
                }
                ]
            },
            options: {
                responsive: true
            }
        });

        function random_rgba() {
            var o = Math.round, r = Math.random, s = 255;
            return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
        }
    </script>

<!-- end script -->
  </body>
</html>	