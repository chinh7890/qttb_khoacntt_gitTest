<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">

    <title>Danh sách máy móc thiết bị</title>

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

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/toastr/build/toastr.min.css">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url('css/loadbar.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/menu.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/filter.css');?>" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('css/toggle.css?v=1') ?>">

    <style type="text/css" media="screen">
      .row {
        width: 100%;
        margin: 0 auto;
        display: flex;
        justify-content: center; /* for centering 3 blocks in the center */
        /* justify-content: space-between; for space in between */ 
      }
      .block {
        width: 250px;
        padding-left: 20px;
      }

      .wFilter{
        width: 250px;
      }

      th, td { text-align: center; }

      .modal {
        overflow-y:auto;
      }

      .modal-content{
          -webkit-box-shadow: 0 5px 15px rgba(0,0,0,0);
          -moz-box-shadow: 0 5px 15px rgba(0,0,0,0);
          -o-box-shadow: 0 5px 15px rgba(0,0,0,0);
          box-shadow: 0 5px 15px rgba(0,0,0,0);
          border: 0px;
      }

      .modal-dialog {
        min-height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: auto;
        @media(max-width: 768px) {
          min-height: calc(100vh - 20px);
        }
      }


      .dropdown {
        display: inline-block;

    }

    .dropdown-menu{
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      padding: 1px 1px;
      z-index: 1;
    }

    #dropdownAll{
      padding: 0;
      border: none;
      background: none;
      color: white;
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
                <h3>Danh sách máy móc thiết bị</h3>
              </div>

              <div class="title_right">
                <?php if ($this->session->userdata('quyenhan') == "1" || $this->session->userdata('quyenhan') == "2"): ?>

                  <div class="form-group pull-right top_search" style="float:left;">
                    <div class="input-group" >
                      <a class="btn btn-primary" href="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/hienthitrangthem') ?>">
                        <i class="fa fa-plus"></i> Thêm danh sách
                      </a>
                      
                    </div>
                  </div>

                  <div class="form-group pull-right top_search" style="float:left;">
                    <div class="input-group" data-toggle="modal" data-target="#modalthem">
                      <a class="btn btn-primary">
                        <i class="fa fa-plus"></i> Thêm mới
                      </a>
                    </div>
                  </div>
                <?php endif ?>

                <div class="form-group pull-right top_search" style="float:left;" data-toggle="tooltip" data-placement="top" title="Xuất thiết bị theo từng khoa">
                  <div class="input-group" data-toggle="modal" data-target="#modalXuatFile">
                    <a class="btn btn-primary">
                      <i class="fa fa-file-excel-o"></i> Xuất excel
                    </a>
                    
                  </div>
                </div>

                <div class=" form-group pull-right top_search" style="float:left;">
                  
                  <form action="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/xuatexceldaloc') ?>">
                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Chọn Show All để hiển thị tất cả dữ liệu tìm được trước khi xuất">
                    <i class="fa fa-file-excel-o"></i> Xuất excel đang hiển thị
                    </button>
                  </form>
                </div>

              </div>
            </div>

            
            

            <div class="clearfix"></div>

            <div class="row">       

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div style="float: right;">
                    <input class="toggle" type="checkbox" id="mode_show" checked />
                    <label class="label_toggle" for="mode_show" style="float: left;">Toggle</label>Xem dạng nhóm
                  </div>
                  <br><br>


                  <div class="x_content">

                    <div class="row">
                      
                    <div class="x_content">



                    <div class="row seven-cols center page-hero d-flex align-items-center justify-content-center">
                        <div class="col-md-3 col-3">
                          <label>Phòng:</label>
                          <select id="phongkhoLoc" class="form-control">
                          </select>
                        </div>

                 
                        <div class="col-md-3 col-3">
                            <label >Tình trạng:</label>
                            <select id="tinhtrangLoc" class="form-control">
                              <option value="">Xem tất cả</option>
                              <?php foreach ($tinhtrang['mangtinhtrang'] as $value): ?>
                                <option value="<?= $value['tinhtrang']?>"><?= $value['tinhtrang']?></option>
                              <?php endforeach ?> 
                            </select>
                        </div>

                      <div class="col-md-3 col-3">
                        <label>Giá:</label>
                        <select id="giaLoc" class="form-control">
                          <option value="">Xem tất cả</option>
                          <option value="1999999">Dưới 2 triệu</option>
                          <option value="2000000-4999999">Từ 2 triệu - 5 triệu</option>
                          <option value="5000000-9999999">Từ 5 triệu - 10 triệu</option>
                          <option value="10000000-14999999">Từ 10 triệu - 15 triệu</option>
                          <option value="15000000">Từ 15 triệu trở lên</option>
                        </select>
                      </div>
                      <div class="col-md-3 col-3">
                        <label>Loại:</label>
                        <select id="loaiLoc" class="form-control">
                          <option value="">Xem tất cả</option>
                          <?php foreach ($loaimay['mangloaimay'] as $value): ?>
                            <option value="<?= $value['tenloai']?>"><?= $value['tenloai']?></option>
                          <?php endforeach ?> 
                        </select>
                      </div> 

                    </div>
                    </div>
                  </div>

                    <div class="row" style="padding: 1em;justify-content: right;">

                      <div>
                        <div class="dropdown" style="height: 100%;">
                          <button style="margin-top: 1vh;color: blue" class="btn btn-primary dropdown-toggle" type="button" id="dropdownAll" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tính năng <i class="fa fa-caret-down"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownAll" style="position: absolute;top: 2em;right: 0em;width: 100%;">
                            <form style="color: black">
                              
                              <div class="form-group">
                                <label>Nguồn gốc:</label>
                                <select class="form-control" id="nguongocLoc">
                                  <option value="" >Xem tất cả</option>
                                  <option value="NS">Ngân sách</option>
                                  <option value="DA">Dự án</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Năm sử dụng:</label>
                                <select class="form-control" id="namLoc">
                                  <option value="" >Xem tất cả</option>
                                  <?php foreach ($namsd['mangNam'] as $value): ?>
                                    <?php if ($value['namsd'] != NULL && $value['namsd'] != "0"): ?>
                                      <option value="<?= $value['namsd']?>"><?= $value['namsd']?></option>
                                    <?php endif ?>
                                  <?php endforeach ?> 
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Chất lượng:</label>
                                <select class="form-control" id="chatLuongLoc">
                                  <option value="">Xem tất cả</option>
                                  <option value="0">0</option>
                                  <option value="5-15">5 - 15</option>
                                  <option value="16-30">16 - 30</option>
                                  <option value="31-50">31 - 50</option>
                                  <option value="51-70">51 - 70</option>
                                  <option value="71-100">71 - 100</option>
                                </select>
                              </div>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                      


                    <?php if ($this->session->userdata('quyenhan') == "1" || 
                      $this->session->userdata('quyenhan') == "2"): ?>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTinhTrang"><i class="fa fa-bullseye"></i> 
                          Đổi tình trạng
                        </button>
                        <!-- <button class="btn btn-primary" id="btnModalNhom"><i class="fa fa-filter"></i> 
                          Phân nhóm
                        </button> -->
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalThongKe"><i class="fa fa-filter"></i> 
                          Thống kê
                        </button>
                        <button class="btn btn-primary btn-sm" id="btnModalLoai"><i class="fa fa-filter"></i> 
                          Phân loại
                        </button>
                        
                        <?php if ($this->session->userdata('quyenhan') != "2"): ?>
                          <button class="btn btn-primary btn-sm" id="btnXoa" onclick="return dialogDelete()"><i class="fa fa-trash"></i> 
                            Xóa thiết bị
                          </button>
                        <?php endif ?>

                        <button class="btn btn-primary btn-sm" id="btnLichSu"><i class="fa fa-history"></i> 
                          Lịch sử di chuyển
                        </button>
                        <button class="btn btn-primary btn-sm" id="btnModalDiChuyen"><i class="fa fa-arrows"></i> 
                          Di chuyển
                        </button>
                        
                        <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                          <button class="btn btn-primary btn-sm" id="btnModalQR"><i class="fa fa-qrcode"></i> 
                            In QRCode
                          </button>

                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSoDoTuDong"><i class="fa fa-map-marker"></i> 
                            Tạo sơ đồ máy
                          </button>
                        <?php endif ?>
                        
                    <?php endif ?>


                    <table id="user_data" class="table table-striped table-bordered" style="font-size: 10px;width: 100%;">
                      <thead>
                        <tr>
                          <th>#</th> 
                          
                          <?php if (($this->session->userdata("tendonvi") == "<script>window.localStorage.getItem('tendonvi')</script>" && $this->session->userdata("quyenhan") == "2") || $this->session->userdata("quyenhan") == "1"): ?>
                            <th>Chọn hết<br><input type="checkbox" id="check_all"></th>
                          <?php endif ?>

                          <th>Mã số</th>

                          <th>Tên thiết bị</th>

                          <th>Số máy</th>
                         
                          <th>Mô tả</th>

                          <th>Số lượng</th>

                          <th>Năm sử dụng</th>

                          <th>Nguồn gốc</th>

                          <th>Đơn vị tính</th>

                          <th>Giá</th>

                          <th> Phòng kho </th>

                          <th>Chất lượng</th>

                          <th>Ghi chú</th>

                          <th>Loại</th>

                          <th>Tình trạng</th>

                          <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                            <th>Thao tác</th>
                          <?php endif ?>
                          
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

<!-- Modal sơ đồ phòng -->
<div id="modalSoDoTuDong" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  style="font-size: 20px; float: left;">Tạo sơ đồ phòng máy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/taosodophongmay') ?>">
      <div class="modal-body">
        <div class="form-group">
          <label>Phòng kho</label>
          <select class="form-control" name="idkho">
            <?php foreach ($phongkho as $value): ?>
              <option value="<?= $value['id'] ?>"><?= $value['maphong'] ?></option>
            <?php endforeach ?>
          </select>
          <small class="form-text text-muted">
            Tất cả những thiết bị có Phân loại là máy tính sẽ đánh số máy tự động để hiển thị lên sơ đồ phòng máy.
          </small>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Tạo</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal thống kê -->
<div id="modalThongKe" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  style="font-size: 20px; float: left;">Thống kê thiết bị</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Phòng kho</label>
          <select class="form-control" id="tkKho">
            <option value=""></option>
            <?php foreach ($phongkho as $value): ?>
              <option value="<?= $value['id'] ?>"><?= $value['maphong'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label>Tổng thiết bị</label>
          <input type="text" class="form-control" id="tongtb" disabled="disabled">
        </div>


        <table class="table" id="bangthongke">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Tên thiết bị</th>
              <th scope="col">Model</th>
              <th scope="col">Số lượng</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>


        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal thông tin -->
<div id="modalThongTin" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  style="font-size: 20px; float: left;">Thông tin thiết bị</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Tên thiết bị</label>
            <span id="tentb" class="form-control"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <textarea id="mota" class="form-control" rows="4"></textarea >
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Đơn vị</label>
            <span id="tendonvi" class="form-control"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Phòng kho</label>
            <span id="phongkho" class="form-control"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Chất lượng</label>
            <span id="chatluong" class="form-control"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Loại</label>
            <span id="phanloai" class="form-control"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nhóm</label>
            <span id="phannhom" class="form-control"></span>
          </div>
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal thêm từng thiết bị-->
<div class="modal fade" id="modalthem" tabindex="10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Thêm máy móc thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/themthietbi') ?>">
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tên TB:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" name="tentb" required class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Mô tả:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" name="mota" class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Năm sử dụng:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" name="namsd" required class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Nguồn gốc:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" name="nguongoc">
                  <option value="NS">Ngân sách</option>
                  <option value="DA">Dự án</option>
                </select>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Đơn vị tính:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" name="donvitinh">
                  <option value="Cái">Cái</option>
                  <option value="Bộ">Bộ</option>
                  <option value="Thùng">Thùng</option>
                  <option value="Cuộn">Cuộn</option>
                </select>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Số lượng:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="number" name="soluong" required class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Nguyên giá:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="number" name="nguyengia" class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Chất lượng:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="number" name="chatluong" required class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Ghi chú:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" name="ghichu" class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Model:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" name="model" required class="form-control col-md-7 col-xs-12"/>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tình trạng:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-7 col-xs-12" name="tinhtrang">
                  <option value="Đang sử dụng">Đang sử dụng</option>
                  <option value="Chưa sử dụng">Chưa sử dụng</option>
                  <option value="Chờ thanh lý">Chờ thanh lý</option>
                  <option value="Đã thanh lý">Đã thanh lý</option>
                  <option value="Hư hỏng">Hư hỏng</option>
                </select>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Phòng kho: </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="phongkho" class="form-control">
                  <option value="" > --Chọn--</option>
                  <?php foreach ($phongkho as $value): ?>
                    <option value="<?= $value['id'] ?>" > <?= $value['maphong']?></option>
                  <?php endforeach ?> 
                </select>
             </p>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Loại thiết bị </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="maloai" class="form-control">
                  <option value="" > --Chọn--</option>
                  <?php foreach ($loaimay['mangloaimay'] as $value): ?>
                    <option value="<?= $value['id'] ?>" > <?= $value['tenloai']?></option>
                  <?php endforeach ?> 
                </select>
             </p>
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

<!-- Modal xuất excel -->
<div class="modal fade" id="modalXuatFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Xuất file danh sách máy móc thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" method="post" action="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/xuatfile') ?>">
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Đơn vị </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="donviExcel" class="form-control" id="donviExcel">
                  <option value="" > --Chọn--</option>
                  <?php foreach ($dv['mangdv'] as $value): ?>
                    <option value="<?= $value['id'] ?>" > <?= $value['tendonvi']?></option>
                  <?php endforeach ?> 
                </select>
             </p>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Hình thức </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <div class="form-check">
                  <input type="radio" class="form-check-input" name="hinhthuc" value="tungtb">
                  <label class="form-check-label">Từng thiết bị</label>
                </div>

                <div class="form-check">
                  <input type="radio" class="form-check-input" name="hinhthuc" value="tonghop" checked>
                  <label class="form-check-label">Tổng hợp số lượng</label>
                </div>
             </p>
              </div>
          </div>

          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Xuất</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal lịch sữ -->
<div class="modal fade" id="modalLichSu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 90%">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;">Lịch sử di chuyển thiết bị<p></p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <table id="banglichsu" class="table table-striped table-bordered" style="font-size: 15px">
              <thead>
              <tr>
                  <th>Tên thiết bị</th>
                  <th>Mã số</th>
                  <th>Ngày thực hiện</th>
                  <th>Mô tả</th>
              </tr>
              </thead>
              <tbody class="them">
              </tbody>
          </table>
        </div>
    </div>
  </div>
</div>


<!-- Modal phân nhóm-->
<div class="modal fade" id="modalPhanNhom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Phân nhóm cho thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Nhóm thiết bị </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="idNhom" class="form-control" id="idNhom">
                  <option value="" > --Chọn--</option>
                  <?php foreach ($nhommay['mangnhommay'] as $value): ?>
                    <option value="<?= $value['id'] ?>" > <?= $value['tennhom']?></option>
                  <?php endforeach ?> 
                </select>
             </p>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnPhanNhom">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal phân loại-->
<div class="modal fade" id="modalPhanLoai" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Phân loại cho thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Loại thiết bị </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="idLoai" class="form-control" id="idLoai">
                  <option value="" > --Chọn--</option>
                  <?php foreach ($loaimay['mangloaimay'] as $value): ?>
                    <option value="<?= $value['id'] ?>" > <?= $value['tenloai']?></option>
                  <?php endforeach ?> 
                </select>
             </p>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnPhanLoai">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal di chuyển-->
<div class="modal fade" id="modalDiChuyen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Di chuyển thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="row">
            <div class="form-group block">
              <label for="exampleInputEmail1">Đơn vị quản lí mới</label>
              <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                <select name="donvimoi" class="form-control" id="donvimoi" style="border-radius: 10px" onchange="hienthiphongkho(this, 'phongkhomoi')">
                <option value="" ></option>
                <?php foreach ($dv['mangdv'] as $value): ?>
                  <option value="<?= $value['id']?>"><?= $value['tendonvi']?></option>
                <?php endforeach ?> 
              </select>
              <?php else: ?>
                <select name="donvimoi" class="form-control" id="donvimoi" style="border-radius: 10px" onchange="hienthiphongkho(this, 'phongkhomoi')">
                  <option value="" ></option>
                  <?php foreach ($dv['mangdv'] as $value): ?>
                    <?php if ($this->session->userdata('tendonvi')== $value['tendonvi']): ?>
                       <option value="<?= $value['id']?>"><?= $value['tendonvi']?></option>
                    <?php endif ?>
                  <?php endforeach ?> 
                </select>
              <?php endif ?>
            </div>
            <div class="form-group block">
              <label for="exampleInputEmail1">Phòng kho mới</label>
              <select name="phongkhomoi" class="form-control radius" id="phongkhomoi">
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnDiChuyen">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal xuất QR code -->
<div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Xuất mã QR máy móc thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formQR"class="form-horizontal form-label-left" method="post" enctype="multipart/form-data"
      action="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/inqr') ?>">
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Đơn vị </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="donviQR" class="form-control" id="donviQR">
                  <option value="" > --Chọn--</option>
                  <?php foreach ($dv['mangdv'] as $value): ?>
                    <option value="<?= $value['id'] ?>" > <?= $value['tendonvi']?></option>
                  <?php endforeach ?> 
                </select>
             </p>
              </div>
          </div>

          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">In</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal tình trạng -->
<div class="modal fade" id="modalTinhTrang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Thay đổi tình trạng thiết bị</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left">
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Tình trạng</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" id="tinhTrangDoi">
                  <?php foreach ($tinhtrang['mangtinhtrang'] as $value): ?>
                    <option value="<?= $value['tinhtrang'] ?>" > <?= $value['tinhtrang']?></option>
                  <?php endforeach ?> 
                </select>
             </p>
              </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" id="btnTinhTrang" class="btn btn-primary">Thay Đổi</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal cập nhật số máy-->
<div class="modal fade" id="modalSuaSoMay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Cập nhật số máy</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" action="<?= maymocthietbi_url('danhsachmaymocthietbicontroller/capnhatsomay') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên thiết bị</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input name="idUpdate" id="idUpdateSoMay" type="hidden" class="form-control" hidden="hidden" >
              <input type="text" id="tentbUpdate" name="tentbUpdate" required="required" class="form-control col-md-7 col-xs-12" disabled="disabled">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Số máy
             </label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input type="number" id="somayUpdate" name="somayUpdate" required="required" class="form-control col-md-7 col-xs-12">
              <small  class="form-text text-muted">Nếu có nhiều thiết bị cùng loại dùng số để phân biệt.<br> (Ví dụ: nhập 1 - Sẽ được lưu Thiết bị 1) .</small>
            </div>
          </div>
         
        </div>
        <div class="modal-footer">
         
          <button id="btnCapNhatSoMay" type="button" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>


<!-- Modal loader  -->
<div class="modal fade" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document" >
    <div class="modal-content" style="background-color: rgba(0,0,0,.0001) !important;">
        <div class="modal-body" style="text-align: center;width: 100%">
          <img src='<?php echo base_url('images/load.gif');?>' style="object-fit: cover;width: 30%" />
        </div>
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

<!-- end script -->

 <script type="text/javascript" language="javascript" >  
 $(document).ready(function(){  
    let code = window.localStorage.getItem("iddv");
    reload();
    hienthiphongkhotendonvi(code);
    hienthinamloc(code);

      $('#modalLoading').modal('hide');

      $('#formQR').submit(function(e){
        $('#modalQR').modal('hide');
        e.preventDefault(); // dont submit multiple times
        this.submit(); // use native js submit
      });

      $(document).ready(function(){
        $("#menu_toggle").click();
      });

      function filterData(donvi, tenloai, tennhom, nguongoc, gia,tinhtrang,maphong, namloc, chatLuongLoc){

        $('#modalLoading').modal('show');
        $('.nav-md').css('padding-right', "0");
        $('#user_data').DataTable().destroy();
        
        var dataTable = $('#user_data').DataTable({  
            "processing":true,  
            "serverSide":true,  
            "fixedHeader": true,
            "responsive": true,
            "bFilter": false,
            "bAutoWidth": false,
            "bProcessing" : false,
            "dom": 'Blfrtip',
            "buttons": [
                'excel', 'pdf', 'print'
            ],
            "lengthMenu": [
              [ 10, 25, 50, -1 ],
              [ '10', '25', '50', 'Show all' ]
            ], 
            "drawCallback": function(settings) {
              $('#modalLoading').modal('hide');
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
            }, 
            "iDisplayLength": -1,
            "ajax":{  
                url:"<?= maymocthietbi_url('danhsachmaymocthietbicontroller/fetch_user') ?>",  
                type:"POST",
                data:{
                  donvi: donvi,
                  tenloai: tenloai,
                  tennhom: tennhom,
                  nguongoc: nguongoc,
                  gia: gia,
                  tinhtrang: tinhtrang,
                  maphong:maphong,
                  namsd: namloc,
                  chatluong: chatLuongLoc,
                  mode_show: $('#mode_show').is(":checked")
                },  
                error: function(jqXHR, ajaxOptions, thrownError) {
                  toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
                  $('#modalLoading').modal('hide');
                }
            },  
            "columnDefs": [ {
            "targets": 1,
            "orderable": false
            } ]
        });  
        // $('#modalLoading').modal('hide');
      }

      function reload(){

        let code = window.localStorage.getItem("iddv");
        let pk = window.localStorage.getItem("phongkholoc");
        let tt = window.localStorage.getItem("tinhtrangLoc");
        let loai = window.localStorage.getItem("loaiLoc");

        $('#modalLoading').modal('show');
        filterData(code, loai, "", "", "", tt, pk,"","");
        $('#modalLoading').modal('hide');
        setTimeout(function(){ 
          $("#phongkhoLoc").val((pk == null) ? "": pk).change();
          $("#tinhtrangLoc").val(tt).change();
          $("#loaiLoc").val(loai).change();
        }, 1000);
      }


      // hiển thị thống kê
      $('#tkKho').on('change', function() {
        
        $('#modalLoading').modal('show');
        $.ajax({
              url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/laythongke1phong') ?>",
              method: "POST",
              async: false,
              data: {
                maphongkho: $('#tkKho option:selected').val(),
              },
              success: function (data) {
                $('#modalLoading').modal('hide');
                var data = JSON.parse(data);
                var mangthietbi = data.mangthietbi;
                $("#bangthongke > tbody").empty(); 
                $("#tongtb").val( (mangthietbi[0] != null) ? mangthietbi[0].tong : 0);
                for (let x of mangthietbi){
                  $("#bangthongke tbody").append('<tr><td>'+x.tentb+'</td><td>'+x.model+'</td><td>'+x.soluong+'</td></tr>');
                }
              },
              error: function (xhr, status, errorThrown) {
                toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
              }
        });


      });

      //lọc
      function loc(){
        let code = window.localStorage.getItem("iddv");
        var maphong = $('#phongkhoLoc option:selected').val();
        var tinhtrangLoc = $('#tinhtrangLoc option:selected').text();
        var loaiLoc = $('#loaiLoc option:selected').text();
        var nhomLoc = $('#nhomLoc option:selected').text();
        var giaLoc = $('#giaLoc option:selected').val();
        var nguongocLoc = $('#nguongocLoc option:selected').val();
        var namloc = $('#namLoc option:selected').val();
        var chatLuongLoc = $('#chatLuongLoc option:selected').val();
        
        filterData(code, loaiLoc, nhomLoc, nguongocLoc,giaLoc,tinhtrangLoc,maphong, namloc, chatLuongLoc);
      }

      $('#phongkhoLoc').on('change', function() {
        window.localStorage.setItem('phongkholoc', $('#phongkhoLoc option:selected').val());
        loc();
      });

      $('#tinhtrangLoc').on('change', function() {
        window.localStorage.setItem('tinhtrangLoc', $('#tinhtrangLoc option:selected').text());
        loc();
      });

      $('#loaiLoc').on('change', function() {
        window.localStorage.setItem('loaiLoc', $('#loaiLoc option:selected').text());
        loc();
      });

      $('#nhomLoc').on('change', function() {
        loc();
      });

      $('#giaLoc').on('change', function() {
        loc();
      });

      $('#nguongocLoc').on('change', function() {
        loc();
      });

      $('#namLoc').on('change', function() {
        loc();
      });

      $('#chatLuongLoc').on('change', function() {
        loc();
      });

      $('#mode_show').on('change', function() {
        loc();
      });

      //end lọc

      // btn cập nhật số máy
      $("#btnCapNhatSoMay").click(function(){
        $('#modalLoading').modal('show');
        $('#modalSuaSoMay').modal('hide');

        id = $("#idUpdateSoMay").val();
        somay = $("#somayUpdate").val();
        setTimeout(function(){ 
          $.ajax({
              url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/capnhatsomay') ?>",
              method: "POST",
              async: false,
              data: {
                idUpdate: id,
                somayUpdate: somay
              },
              success: function (data) {
                $('#modalLoading').modal('hide');
                $('#'+id).text("Thiết bị "+somay); 
                toastr.success("Cập nhật thành công", 'Thông báo');
              },
              error: function (xhr, status, errorThrown) {
                toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
                $('#modalLoading').modal('hide');
              }
          });
        }, 500);
      });

      

      $("#btnXoa").click(function(){
        $('#modalLoading').modal('show');
        // lấy mãng đề nghị
        var mangthietbi = [];
        $.each($("input[name='idThietbi']:checked"), function(){
            mangthietbi.push($(this).val());
        });

        setTimeout(function(){ 
          $.ajax({
              url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/xoamaymocthietbi') ?>",
              method: "POST",
              async: false,
              data: {
                mangthietbi: mangthietbi,
              },
              success: function (data) {
                $('#modalLoading').modal('hide');
                toastr.success("Xóa thành công", 'Thông báo');
                window.location.href = data;
              },
              error: function (xhr, status, errorThrown) {
                toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
              }
          });
        }, 500);
      });

      $("#btnPhanNhom").click(function(){
        $('#modalPhanNhom').modal('hide');
        $('#modalLoading').modal('show');
        // lấy mãng đề nghị
        var mangthietbi = [];
        $.each($("input[name='idThietbi']:checked"), function(){
            mangthietbi.push($(this).val());
        });

        if(mangthietbi.length == 0){
          toastr.error("Chưa chọn thiết bị", 'Thông báo');
          $('#modalLoading').modal('hide');
        }else{
          setTimeout(function(){ 
            $.ajax({
                url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/phannhom') ?>",
                method: "POST",
                async: false,
                data: {
                  mangthietbi: mangthietbi,
                  idnhom: $('#idNhom').val(),
                },
                success: function (data) {
                  toastr.success("Phân nhóm thành công", 'Thông báo');
                  window.location.href = data;
                  $('#modalLoading').modal('hide');
                },
                error: function (xhr, status, errorThrown) {
                  toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
                }
            });
          }, 500);
        }
      });

      $("#btnPhanLoai").click(function(){
        $('#modalPhanLoai').modal('hide');
        $('#modalLoading').modal('show');
        // lấy mãng đề nghị
        var mangthietbi = [];
        $.each($("input[name='idThietbi']:checked"), function(){
            mangthietbi.push($(this).val());
        });

        if(mangthietbi.length == 0){
          toastr.error("Chưa chọn thiết bị", 'Thông báo');
          $('#modalLoading').modal('hide');
        }else{
          setTimeout(function(){ 
            $.ajax({
                url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/phanloai') ?>",
                method: "POST",
                async: false,
                data: {
                  mangthietbi: mangthietbi,
                  idloai: $('#idLoai').val(),
                  mode_show: $('#mode_show').is(":checked")
                },
                success: function (data) {
                  toastr.success("Phân loại thành công", 'Thông báo');
                  window.location.href = data;
                  $('#modalLoading').modal('hide');
                },
                error: function (xhr, status, errorThrown) {
                  toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
                }
            });
          }, 500);
        }
      });

      $("#btnTinhTrang").click(function(){
        $('#modalTinhTrang').modal('hide');
        $('#modalLoading').modal('show');
        // lấy mãng đề nghị
        var mangthietbi = [];
        $.each($("input[name='idThietbi']:checked"), function(){
            mangthietbi.push($(this).val());
        });

        if(mangthietbi.length == 0){
          toastr.error("Chưa chọn thiết bị", 'Thông báo');
          $('#modalLoading').modal('hide');
        }else{
          setTimeout(function(){ 
            $.ajax({
                url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/thaydoitinhtrang') ?>",
                method: "POST",
                async: false,
                data: {
                  mangthietbi: mangthietbi,
                  idTinhTrang: $('#tinhTrangDoi').val(),
                  mode_show: $('#mode_show').is(":checked")
                },
                success: function (data) {
                  toastr.success("Thay đổi tình trạng thành công", 'Thông báo');
                  window.location.href = data;
                  $('#modalLoading').modal('hide');
                },
                error: function (xhr, status, errorThrown) {
                  toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
                }
            });
          }, 500);
        }
      });


    $("#check_all").change(function() {
      $("input[name='idThietbi'").prop( "checked" , this.checked );
    });


      $("#btnModalQR").click(function(){
        $('#modalQR').modal('toggle');
      });


      $("#btnLichSu").click(function(){
         hienthilichsu();
      });

      $("#btnImport").click(function(){
        importAjax();
      });

      $("#btnDiChuyen").click(function(){
        dichuyenthietbi();
      });

      $("#btnModalNhom").click(function(){
        $('#modalPhanNhom').modal('toggle');
      });

      $("#btnModalLoai").click(function(){
        $('#modalPhanLoai').modal('toggle');
      });

      $("#btnModalDiChuyen").click(function(){
        $('#modalDiChuyen').modal('toggle');
      });
 });  
 </script>  

<script >

function setvalue(obj)
{
  var id=obj.id;
  var tentb=($("#"+id).attr("tentb"));
  var mota=($("#"+id).attr("mota"));
  var tendonvi=($("#"+id).attr("tendonvi"));
  var maphong=($("#"+id).attr("maphong"));

  var chatluong=($("#"+id).attr("chatluong"));
  var tenloai=($("#"+id).attr("tenloai"));
  var tennhom=($("#"+id).attr("tennhom"));

  $("#tentb").text(tentb);
  $("#mota").val(mota);
  $("#tendonvi").text(tendonvi);
  $("#phongkho").text(maphong);

  $("#chatluong").text(chatluong);
  $("#phanloai").text(tenloai);
  $("#phannhom").text(tennhom);

  $("#modalThongTin").modal();
}

function setSoMay(obj)
{
  var id=obj.id;
  var tentb=($("#"+id).attr("tentb"));
  var somay=($("#"+id).attr("somay"));

  $("#tentbUpdate").val(tentb);
  $("#somayUpdate").val(somay);
  $("#idUpdateSoMay").val(id);
  $("#modalSuaSoMay").modal();
}


function hienthinamloc(tendonvi) {

    $.ajax({
      url:"<?php echo maymocthietbi_url('danhsachmaymocthietbicontroller/layNamSD'); ?>",
      method:"POST",
      data:{
        tendonvi: tendonvi,
      },
      success:function(data){
        var arrLop = JSON.parse(data);
        var sel = document.getElementById('namLoc');

        // clear select box
        $('#namLoc')
            .find('option')
            .remove()
            .end()
        ;

        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode(""));
        opt.value = ""; 
        sel.appendChild(opt);

        // add option for select
        arrLop.forEach(function(element) {
          if(element['namsd'] != null && element['namsd'] != "0"){
            var opt = document.createElement('option');
            opt.appendChild( document.createTextNode(element['namsd']) );
            opt.value = element['namsd']; 
            sel.appendChild(opt); 
          }
        });
      },
      error: function (xhr, status, errorThrown) {
        toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
}

function hienthiphongkho(obj, selName) {
    var iddonvi = obj.value;

    $.ajax({
      url:"<?php echo maymocthietbi_url('danhsachmaymocthietbicontroller/layphongkho'); ?>",
      method:"POST",
      data:{
        tendonvi: iddonvi,
      },
      success:function(data){
        var arrLop = JSON.parse(data);
        var sel = document.getElementById(selName);

        // clear select box
        $('#'+selName)
            .find('option')
            .remove()
            .end()
        ;

        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode(""));
        opt.value = ""; 
        sel.appendChild(opt);

        // add option for select
        arrLop.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['maphong']) );
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
}

function hienthiphongkhotendonvi(tendonvi) {

    $.ajax({
      url:"<?php echo maymocthietbi_url('danhsachmaymocthietbicontroller/layphongkhobangten'); ?>",
      method:"POST",
      data:{
        tendonvi: tendonvi,
      },
      success:function(data){
        var arrLop = JSON.parse(data);
        var sel = document.getElementById("phongkhoLoc");

        // clear select box
        $('#phongkhoLoc')
            .find('option')
            .remove()
            .end()
        ;

        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode("Xem tất cả"));
        opt.value = ""; 
        sel.appendChild(opt);

        // add option for select
        arrLop.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['maphong']) );
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
}

function dichuyenthietbi(){
  $('#modalDiChuyen').modal('toggle');
  $('#modalLoading').modal('show');
  // lấy mãng thiết bị
  var mangthietbi = [];
  $.each($("input[name='idThietbi']:checked"), function(){
      mangthietbi.push($(this).val());
  });

  if(mangthietbi.length == 0){
    toastr.error("Chưa chọn thiết bị", 'Thông báo');
    $('#modalLoading').modal('hide');
  }else{
    $.ajax({
      url:"<?php echo maymocthietbi_url('danhsachmaymocthietbicontroller/dichuyenthietbi'); ?>",
      method:"POST",
      data:{
        donvimoi: $("#donvimoi option:selected").html(),
        tenpkmoi: $("#phongkhomoi option:selected").html(),
        mapkmoi: $('#phongkhomoi').val(),
        check_list: mangthietbi,
        mode_show: $('#mode_show').is(":checked")
      },
      success:function(data){
        // alert(data);
        toastr.success("Di chuyển thành công", 'Thông báo');
        window.location.href = data;
        $('#modalLoading').modal('hide');
      },
      error: function (xhr, status, errorThrown) {
        toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }
}


function xuatfile(){
  $('#modalXuatFile').modal('toggle');
  $('#modalLoading').modal('show');
    $.ajax({
      url: 'xuatfile',
      type: 'POST',
      data: {
        madonvi: $('#donviExcel').val(),
        hinhthuc: $("input[name='hinhthuc']:checked").val()
      },
      success: function (data) {
        // alert(data);
        
        $('#modalLoading').modal('hide');
        var baseurl = window.location.origin+"/quanlythietbi/";
        window.location.href = baseurl + data;
      },
    })
    .done(function() {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    });
}
  
function laydulieu()
{
  $("#loadbar").modal('show');
  setTimeout(function(){ 
    $.ajax({
      url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/laydulieu') ?>",
      method: "POST",
      async: false,
      data: {
        madonvi: $('#donviLoc').val(),
        maloai: $('#loaiLoc').val(),
        manhom: $('#nhomLoc').val(),
      },
      type: "application/json",
      success: function (data) {
          var data = JSON.parse(data);
          var mangthietbi = data.mangthietbi;
          var baseurl = window.location.origin+"/quanlythietbi/maymocthietbi/danhsachmaymocthietbicontroller/";
          
          const bangKetQua = $('#datatable-buttons').DataTable();

          if (mangthietbi.length != 0) {
              bangKetQua.clear();
              for (let x of mangthietbi) {

                // xác định đường dẫn xóa thiết bị
                var urlCapNhat = baseurl + "loadmaymocthietbi/";
                var urlXoa = baseurl + "xoamaymocthietbi/";
                urlCapNhat = urlCapNhat+ x.id;
                urlXoa = urlXoa+ x.id;
                  var rowNode = bangKetQua.row.add([
                      x.tentb,
                      x.mota,
                      x.maso,
                      x.namsd,
                      x.nguongoc,
                      x.donvitinh,
                      x.gia,
                      x.chatluong,
                      x.tendonvi,
                      x.tenphong,
                      x.ghichu,
                      x.tenloai,
                      x.tennhom,
                      x.tinhtrang,
                      '<a href="'+urlCapNhat+'"><i class="fa fa-pencil-square-o" style="color: blue"></i>&nbsp &nbsp &nbsp</a>'+
                      '<a onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:red"></i>&nbsp &nbsp &nbsp</a>'+
                      '<a id="'+x.id+'" tentb="'+x.tentb+'" maso="'+x.maso+'" onclick="hienthilichsu(this)"><i class="fa fa-history" style="color:green"></i></a>'
                  ])
                  .draw(false);
              }
          }
          else
          {
            bangKetQua.clear().draw();
          }
          $("#loadbar").modal('hide');
      },
  });
   }, 1000);
  
}

function hienthilichsu()
{
  // lấy mãng thiết bị
  var mangthietbi = [];
  $.each($("input[name='idThietbi']:checked"), function(){
      mangthietbi.push($(this).val());
  });

  if(mangthietbi.length == 0){
    toastr.error("Chưa chọn thiết bị", 'Thông báo');
  }else if(mangthietbi.length > 1){
    toastr.error("Chỉ chọn được một thiết bị", 'Thông báo');
  }else{
    $.ajax({
        url: "<?= maymocthietbi_url('danhsachmaymocthietbicontroller/laylichsu') ?>",
        method: "POST",
        async: false,
        data: {
          mangthietbi: mangthietbi,
        },
        type: "application/json",
        success: function (data) {
            var data = JSON.parse(data);
            var arrLichSu = data.manglichsu;
            console.log(arrLichSu);

            const banglichsu = $('#banglichsu').DataTable();
            if (arrLichSu.length != 0) {
                banglichsu.clear();
                for (let x of arrLichSu) {
                    var rowNode = banglichsu.row.add([
                        x.tentb,
                        x.maso,
                        x.ngaycapnhat,
                        x.noidung
                    ])
                    .draw(false);
                }
            }
            $('#modalLichSu').modal('toggle');
        },
    });
  }
}

function dialogDelete()
{
  if(window.confirm("Bạn có chắc xóa")==true){
    return true;
  }
  return false;
}

function importAjax(){
  var fd = new FormData();    
  fd.append( 'file', file.files[0] );
  var e = document.getElementById("donvi");
  fd.append( 'donvi', e.options[e.selectedIndex].value);
  fd.append( 'tendonvi', e.options[e.selectedIndex].text);

  // var e = document.getElementById("maloai");
  // fd.append( 'maloai', e.options[e.selectedIndex].value);

  // var e = document.getElementById("manhom");
  // fd.append( 'manhom', e.options[e.selectedIndex].value);

  $('#modalthem').modal('toggle');
  $('#modalLoading').modal('show');

    $.ajax({
      url:"<?php echo maymocthietbi_url(); ?>danhsachmaymocthietbicontroller/importExcel",
      method:"POST",
      data:fd,
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('#file').val('');

        var data = JSON.parse(data);
        
        alert(data.soluongthem+" thiết bị được thêm \n" + "Dòng bị lỗi: "+ data.dongloi);
        $('#modalLoading').modal('hide');
        location.reload();
      }
    });
}

    $( document ).ready(function() {

            $('body').removeClass('nav-md').addClass('nav-sm');
            $('.left_col').removeClass('scroll-view').removeAttr('style');
            $('#sidebar-menu li').removeClass('active');
            $('#sidebar-menu li ul').slideUp();
            $("#user_data").css("width", "100%");

           
    });
    </script>




  </body>
</html>