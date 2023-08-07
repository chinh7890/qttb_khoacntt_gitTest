<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">
    <title>Nhật ký sử dụng phòng máy</title>

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

    <!-- keyboard -->
    <link rel="stylesheet" href="<?= base_url() ?>vendors/keyboard/jqbtk.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendors/keyboard/jqbtk.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>build/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/toggle.css?v=1') ?>">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style type="text/css">
      

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

      

      @media only screen and (max-width: 600px) {
          .khung{
          height: 100%;
          width: 100%;
          border-style: solid;
          padding: 5px;
          text-align: center;
          background-color: #D3D3D3;
          border-radius: 5px;
        }
      }

      @media only screen and (min-width: 600px) {
          .khung{
          height: 100%;
          width: 70%;
          border-style: solid;
          padding: 10px;
          /*margin-left: 35%;*/
          text-align: center;
          background-color: #D3D3D3;
          border-radius: 5px;
        }
      }

      .title{
        text-align: center;
        font-size: 20px;
        color: #e60000;
        font-weight: bold;
      }

      .autocomplete {
          /*the container must be positioned relative:*/
          position: relative;
          display: inline-block;
          width: 100%;
        }
        input {
          border: 1px solid transparent;
          background-color: #f1f1f1;
          padding: 10px;
          font-size: 16px;
        }
        input[type=text] {
          background-color: #f1f1f1;
          width: 100%;
        }

        .autocomplete-items {
          position: absolute;
          border: 1px solid #d4d4d4;
          border-bottom: none;
          border-top: none;
          z-index: 99;
          /*position the autocomplete items to be the same width as the container:*/
          top: 100%;
          left: 0;
          right: 0;
        }
        .autocomplete-items div {
          padding: 10px;
          cursor: pointer;
          background-color: #fff;
          border-bottom: 1px solid #d4d4d4;

        }
        .autocomplete-items div:hover {
          /*when hovering an item:*/
          background-color: #e9e9e9;
        }
        .autocomplete-active {
          /*when navigating through the items using the arrow keys:*/
          background-color: DodgerBlue !important;
          color: #ffffff;
        }


        /*ui autocomple*/

        .ui-autocomplete .ui-menu-item{
          font-style:italic;
          color:gray;
          background-color: white;
          width: 100%;
        }

        .ui-autocomplete .ui-menu-item:hover{
          font-style:italic;
          color: white;
          font-weight: bold;
          font-size: 17px;
          background-color: #3498DB;
        }
        .ui-autocomplete {
          z-index:2147483647;
        }
        .ui-helper-hidden-accessible { display:none; }

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
                <h3>Quản lý nhật ký phòng máy</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            


            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Ghi sổ nhật ký</a></li>
              <li><a data-toggle="tab" href="#menu1">Danh sách thiết bị</a></li>
              <li><a data-toggle="tab" href="#menu2">Nhật ký bảo trì, sửa chữa</a></li>
            </ul>

            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <h3>Ghi sổ nhật ký</h3>
                
                <div class="row">
            
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      
                      <!-- <button class="btn btn-primary">
                        <i class="fa fa-wrench"></i> 
                          Lịch sử sửa chữa
                      </button> -->
                      <span style="float: right;">
                        <label>GIÁO VIÊN QUẢN LÝ: <span id="gvql" style="color:red"></span></label>
                      </span>

                      <div class="x_content">

                        <div class="row">
                          <div class="col-xs-6">
                            <div id="sodo" class="khung" style="margin:0 auto;"></div>
                          </div>
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>HỌC KỲ</label>
                              <select id="hockysearch" class="form-control" onchange="laydulieu()">
                                <?php foreach ($hocky as $val): ?>
                                  <?php if ($val->current == 1): ?>
                                    <option value="<?= $val->id ?>" selected>
                                      Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>) - Học kỳ hiện tại
                                    </option>
                                  <?php else: ?>
                                    <option value="<?= $val->id ?>">
                                      Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                                    </option>
                                  <?php endif ?>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>PHÒNG MÁY</label>
                              <input id="phongsearch" required="required" type="text" placeholder="Nhập tên phòng (VD: A201)" class="keyboard form-control">
                            </div>

                            <?php if ($this->session->userdata('quyenhan') == "1"): ?>
                              <button class="btn btn-primary" data-toggle="modal" data-target="#modalthemcu">
                                <i class="fa fa-calendar"></i> 
                                  Thêm lịch cũ
                              </button>
                            <?php endif ?>

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalthem">
                              <i class="fa fa-calendar"></i> 
                                Thêm lịch sử dụng
                            </button>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalin">
                              <i class="fa fa-file"></i> 
                                In sổ nhật ký
                            </button>
                          </div>
                        </div>
                        

                        <!-- <div class="line">
                          <div id="sodo" class="khung">
                          </div>
                        </div> -->
                        <br>

                        <table id="datatable-buttons" class="table table-striped" style="font-size: 15px">
                          <thead>
                            <tr>
                              <th>STT</th>
                              <th>Ngày</th>
                              <th>Giờ vào</th>
                              <th>Giờ ra</th>
                              <th>Mục đích sử dụng</th>
                              <th>Tình trạng trước khi sử dụng</th>
                              <th>Tình trạng sau khi sử dụng</th>
                              <th>Giáo viên sử dụng</th>
                              <th>Thao tác</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div id="menu1" class="tab-pane fade">
                <h3>Danh sách thiết bị</h3>
                <div class="x_content">

                    <div class="row" style="background-color: white;">
                      <div class="x_content">

                        <div style="float: right;">
                          <input class="toggle" type="checkbox" id="mode_show" checked />
                          <label class="label_toggle" for="mode_show" style="float: left;">Toggle</label>Xem dạng nhóm
                        </div>
                        <br><br>

                        <div class="row seven-cols center page-hero d-flex align-items-center justify-content-center">
                        <div class="col-md-3 col-5">
                          <label>Phòng:</label>
                          <select id="phongkhoLoc" class="form-control">
                            <?php foreach ($phong as $value): ?>
                              <option value="<?php echo $value['id'] ?>">
                                <?php echo $value['maphong'] ?>
                              </option>
                            <?php endforeach ?>
                          </select>
                        </div>

                 
                        <div class="col-md-3 col-5">
                            <label >Tình trạng:</label>
                            <select id="tinhtrangLoc" class="form-control">
                              <option value="" selected>Xem tất cả</option>
                              <?php foreach ($tinhtrang as $value): ?>
                                <option value="<?= $value['tinhtrang']?>"><?= $value['tinhtrang']?></option>
                              <?php endforeach ?> 
                            </select>
                        </div>

                        <div class="col-md-3 col-5">
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
                        <div class="col-md-3 col-5">
                          <label>Loại:</label>
                          <select id="loaiLoc" class="form-control">
                            <option value="" selected>Xem tất cả</option>
                            <?php foreach ($loaimay as $value): ?>
                              <option value="<?= $value['tenloai']?>"><?= $value['tenloai']?></option>
                            <?php endforeach ?> 
                          </select>
                        </div> 


                      </div>

                     


                    <div class="row seven-cols center page-hero d-flex align-items-center justify-content-center" style="padding: 1em; float: right;">
                      <div class="col-md-4 col-2">
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
                    </div>
                </div>

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

              <div id="menu2" class="tab-pane fade">
                <h3>Nhật ký bảo trì</h3>
                <div class="x_content">

                  <div class="row">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>HỌC KỲ</label>
                        <select id="hocky_baotri" class="form-control" onchange="laydulieubaotri()">
                          <?php foreach ($hocky as $val): ?>
                            <?php if ($val->current == 1): ?>
                              <option value="<?= $val->id ?>" selected>
                                Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>) - Học kỳ hiện tại
                              </option>
                            <?php else: ?>
                              <option value="<?= $val->id ?>">
                                Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                              </option>
                            <?php endif ?>
                          <?php endforeach ?>
                        </select>
                      </div>

                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">
                        <label>PHÒNG MÁY</label>
                        <input id="phongbaotri_loc" required="required" type="text" placeholder="Nhập tên phòng (VD: A201)" class="keyboard form-control">
                      </div>

                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalthembaotri">
                        <i class="fa fa-calendar"></i> 
                          Thêm lịch bảo trì
                      </button>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalin_baotri">
                        <i class="fa fa-file"></i> 
                          In sổ bảo trì
                      </button>
                    </div>


                  </div>

                    <table id="bangbaotri" class="table table-striped table-bordered" style="font-size: 10px;width: 100%;">
                      <thead>
                        <tr>
                          <th>#</th> 
                          <th>Tên TB</th>
                          <th>Ngày bảo trì</th>
                          <th>Mô tả hư hỏng</th>
                          <th>Nội dung bảo trì</th>
                          <th>Người bảo trì</th>
                          <th>Người kiểm tra</th>
                          <th>Ghi chú</th>
                          <th>Ngày tạo</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>


                      
                    </table>
                  </div>
              </div>
              
            </div>




          </div>
        </div>
        
        <!-- /page content -->
<!-- Modal thêm mới-->
<div class="modal fade" id="modalthem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
          action="<?= nguoidung_url('nhatkycontroller/themnhatky') ?>" method="POST" onsubmit="return validate()">
        <div class="modal-body">

          <div class="form-group autocomplete">
            <label>PHÒNG MÁY</label>
            <input id="idphong" hidden="hidden" name="idphong" required="required" type="text">
            <input id="phongmay" name="phongmay" required="required" type="text" placeholder="Nhập tên phòng" class="keyboard form-control">
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>GIỜ VÀO</label>
                <input autocomplete="off" id="giovao" name="giovao" required="required" class="form-control" placeholder="Chọn giờ vào" onchange="kiemtragio()">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>GIỜ RA</label>
                <input autocomplete="off" id="giora" name="giora" class="form-control" placeholder="Chọn giờ ra">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>MÔN HỌC/MỤC ĐÍCH SỬ DỤNG</label>
            <textarea id="mucdich" name="mucdich" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG TRƯỚC KHI SỬ DỤNG</label>
            <textarea id="tinhtrangtruoc" name="tinhtrangtruoc" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG SAU KHI SỬ DỤNG</label>
            <textarea id="tinhtrangsau" name="tinhtrangsau" class="form-control" rows="3"></textarea>
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

<!-- Modal thêm cũ-->
<div class="modal fade" id="modalthemcu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
          action="<?= nguoidung_url('nhatkycontroller/themnhatky_cu') ?>" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <label>HỌC KỲ</label>
            <select id="hockycu" name="hockycu" class="form-control">
              <?php foreach ($hocky as $val): ?>
                <option value="<?= $val->id ?>">
                  Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group autocomplete">
            <label>PHÒNG MÁY</label>
            <input id="idphongcu" hidden="hidden" name="idphongcu" required="required" type="text">
            <input id="phongmaycu" name="phongmaycu" required="required" type="text" placeholder="Nhập tên phòng" class="keyboard form-control">
          </div>

          <div class="form-group autocomplete">
            <label>GIÁO VIÊN</label>
            <select id="gvcu" name="gvcu" class="form-control" required>
              <option value="">----Chọn----</option>
              <?php foreach ($user as $val): ?>
                <?php if ($val['madonvi'] == 1): ?>
                  <option value="<?= $val['id'] ?>">
                    <?= $val['hoten'] ?> 
                  </option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>NGÀY</label>
            <input type="date" id="ngaycu" name="ngaycu" class="form-control">
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>GIỜ VÀO</label>
                <input autocomplete="off" id="giovaocu" name="giovaocu" required="required" class="form-control" placeholder="Chọn giờ vào" onchange="kiemtragio()">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>GIỜ RA</label>
                <input autocomplete="off" id="gioracu" name="gioracu" class="form-control" placeholder="Chọn giờ ra">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>MÔN HỌC/MỤC ĐÍCH SỬ DỤNG</label>
            <textarea id="mucdichcu" name="mucdichcu" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG TRƯỚC KHI SỬ DỤNG</label>
            <textarea id="tinhtrangtruoccu" name="tinhtrangtruoccu" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG SAU KHI SỬ DỤNG</label>
            <textarea id="tinhtrangsaucu" name="tinhtrangsaucu" class="form-control" rows="3"></textarea>
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

<!-- Modal thêm mới nhật ký bảo trì-->
<div class="modal fade" id="modalthembaotri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm nhật ký bảo trì</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
        action="<?= nguoidung_url('nhatkytinhtrangtbcontroller/themnhatky') ?>" method="POST">
        <div class="modal-body">

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>HỌC KỲ</label>
                <select name="hocky" class="form-control">
                  <?php foreach ($hocky as $val): ?>
                    <?php if ($val->current == 1): ?>
                      <option value="<?= $val->id ?>" selected>
                        Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>) - Học kỳ hiện tại
                      </option>
                    <?php else: ?>
                      <option value="<?= $val->id ?>">
                        Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                      </option>
                    <?php endif ?>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group autocomplete">
                <label>PHÒNG MÁY</label>
                <input id="idphong_baotri" hidden="hidden" name="idphong" required="required" type="text">
                <input id="phongmay_baotri" name="phongmay" required="required" type="text" placeholder="Nhập tên phòng" class="keyboard form-control">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label>DANH SÁCH THIẾT BỊ</label>
            <div class="form-group">
              <select class="form-control" id="thietbi" name="thietbi[]" required="required" class="form-control" multiple size="10">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>NGÀY BẢO TRÌ</label>
            <input type="date" name="ngaybaotri" required="required" class="form-control">
          </div>

          <div class="form-group">
            <label>MÔ TẢ HƯ HỎNG, NGUYÊN NHÂN</label>
            <textarea name="motabaotri" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>NỘI DUNG BẢO TRÌ, SỬA CHỮA</label>
            <textarea name="noidungbaotri" class="form-control" rows="3"></textarea>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI BẢO TRÌ/SỬA CHỮA</label>
                <input name="nguoibaotri" class="form-control" />
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI KIỂM TRA</label>
                <input name="nguoikiemtra" class="form-control" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>GHI CHÚ</label>
            <input name="ghichubaotri" class="form-control" />
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
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('nhatkycontroller/capnhatnhatky') ?>" method="POST" onsubmit="return validate_update()">
        <div class="modal-body">

          <div class="form-group">
            <label>PHÒNG MÁY</label>
            <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
            <input name="idKhoUpdate" id="idKhoUpdate" type="hidden" class="form-control" hidden="hidden" >
            <input id="phongmayUpdate" name="phongmay" required="required" type="text" class="keyboard form-control">
          </div>

          <div class="form-group">
            <label>GIỜ VÀO</label>
            <input autocomplete="off" id="giovaoUpdate" name="giovao" required="required" class="form-control" placeholder="Chọn giờ vào">
          </div>

          <div class="form-group">
            <label>GIỜ RA</label>
            <input autocomplete="off" id="gioraUpdate" name="giora" required="required" class="form-control" placeholder="Chọn giờ ra">
          </div>

          <div class="form-group">
            <label>MÔN HỌC/MỤC ĐÍCH SỬ DỤNG</label>
            <textarea id="mucdichUpdate" name="mucdich" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG TRƯỚC KHI SỬ DỤNG</label>
            <textarea id="tinhtrangtruocUpdate" name="tinhtrangtruoc" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG SAU KHI SỬ DỤNG</label>
            <textarea id="tinhtrangsauUpdate" name="tinhtrangsau" required="required" class="form-control" rows="3"></textarea>
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

<!-- Modal cập nhật nhật ký bảo trì-->
<div class="modal fade" id="modalcapnhatbaotri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Chỉnh sửa nhật ký bảo trì</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
        action="<?= nguoidung_url('nhatkytinhtrangtbcontroller/capnhat') ?>" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <input name="idUpdate" id="idUpdate_baotri" type="hidden" class="form-control" hidden="hidden" >
            <label>NGÀY BẢO TRÌ</label>
            <input type="date" id="ngaybaotri_update" name="ngaybaotri" required="required" class="form-control">
          </div>

          <div class="form-group">
            <label>MÔ TẢ HƯ HỎNG, NGUYÊN NHÂN</label>
            <textarea id="motabaotri_update" name="motabaotri" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>NỘI DUNG BẢO TRÌ, SỬA CHỮA</label>
            <textarea id="noidungbaotri_update" name="noidungbaotri" class="form-control" rows="3"></textarea>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI BẢO TRÌ/SỬA CHỮA</label>
                <input id="nguoibaotri_update" name="nguoibaotri" class="form-control" />
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI KIỂM TRA</label>
                <input id="nguoikiemtra_update" name="nguoikiemtra" class="form-control" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>GHI CHÚ</label>
            <input id="ghichubaotri_update" name="ghichubaotri" class="form-control" />
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

<!-- Modal in-->
<div class="modal fade" id="modalin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>In nhật ký</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('nhatkycontroller/xuatsonhatky') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>HỌC KỲ</label>
            <select class="form-control" name="hockyin" required="required" class="form-control">
              <?php foreach ($hocky as $val): ?>
                <option value="<?= $val->id ?>">
                  Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>PHÒNG MÁY</label>
            <select class="form-control" name="phongmayin" required="required" class="form-control">
              <?php foreach ($phong as $value): ?>
                <option value="<?= $value['id'] ?>"><?= $value['maphong'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">In</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal in nhật ký bảo trì-->
<div class="modal fade" id="modalin_baotri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>In sổ bảo trì/sửa chữa</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('nhatkytinhtrangtbcontroller/xuatsonhatky') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>HỌC KỲ</label>
            <select class="form-control" name="hockyin" required="required" class="form-control">
              <?php foreach ($hocky as $val): ?>
                <option value="<?= $val->id ?>">
                  Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>PHÒNG MÁY</label>
            <select class="form-control" name="phongmayin" required="required" class="form-control">
              <?php foreach ($phong as $value): ?>
                <option value="<?= $value['id'] ?>"><?= $value['maphong'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">In</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal cập nhật tình trạng-->
<div class="modal fade" id="modalCapNhatTinhTrang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px; float: left;"><p>Cập nhật tình trạng</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form class="form-horizontal form-label-left" action="<?= nguoidung_url('nhatkycontroller/capnhattinhtrang') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tên thiết bị</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <input name="idUpdate" id="idUpdateSoMay" type="hidden" class="form-control" hidden="hidden" >
              <input type="text" id="tentbUpdate" name="tentbUpdate" required="required" class="form-control col-md-7 col-xs-12" disabled="disabled">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Mô tả</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <textarea rows="3" id="motaUpdate" disabled="disabled" class="form-control col-md-7 col-xs-12"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Ghi chú</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <textarea rows="5" id="ghichuUpdate" name="ghichuUpdate" class="form-control col-md-7 col-xs-12"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Tình trạng
             </label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select id="tinhtrangUpdate" name="tinhtrangUpdate" required="required" class="form-control col-md-7 col-xs-12">
                <option value="Đang sử dụng">Đang sử dụng</option>
                <option value="Hư hỏng">Hư hỏng</option>
              </select>
              <small  class="form-text text-muted">Nếu thiết bị đã được sửa thì cập nhật tình trạng mới.</small>
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
    <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

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
    <!-- keyboard -->
    <script src="<?= base_url() ?>vendors/keyboard/jqbtk.js"></script>
    <script src="<?= base_url() ?>vendors/keyboard/jqbtk.min.js"></script>
  <!-- autocomplete -->
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

    

<script type="text/javascript">
  $(function() {
    $(document).ready(function () {   

      reload();         

      $('.dataTables_filter input[type="search"]').css(
         {'width':'8em','display':'inline-block'}
      );

      //lưu lại tab
      $('a[data-toggle="tab"]').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
          // $('#modalLoading').modal('show');
          reload();
          // $('#modalLoading').modal('hide');
      });

      $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
          var id = $(e.target).attr("href");
          localStorage.setItem('selectedTab', id)
      });

      var selectedTab = localStorage.getItem('selectedTab');
      if (selectedTab != null) {
          $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
      }
    });
    


      $( "#phongmay" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $('#idphong').val(ui.item.value);
              $("#phongmay").val(ui.item.label);
              return false;
          }
      });

      $( "#phongmaycu" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $('#idphongcu').val(ui.item.value);
              $("#phongmaycu").val(ui.item.label);
              return false;
          }
      });
      $( "#phongsearch" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $("#phongsearch").val(ui.item.label);
              sessionStorage.setItem("idphong", ui.item.value);
              sessionStorage.setItem("tenphong", ui.item.label);
              $("#phongkhoLoc").val(ui.item.value);
              laydulieu();
              return false;
          }
      });
      $( "#phongmayUpdate" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $("#phongmayUpdate").val(ui.item.label);
              $("#idKhoUpdate").val(ui.item.value);
              return false;
          }
      });

      $( "#phongbaotri_loc" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $("#phongbaotri_loc").val(ui.item.label);
              sessionStorage.setItem("idphong", ui.item.value);
              sessionStorage.setItem("tenphong", ui.item.label);
              laydulieubaotri();
              return false;
          }
      });

      $( "#phongmay_baotri" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $("#phongmay_baotri").val(ui.item.label);
              $("#idphong_baotri").val(ui.item.value);
              loadthietbibaotri(ui.item.value);
              return false;
          }
      });
  });  

  // TIME PICKER
    var times = {};
    var timepicker = new TimePicker(['giovao', 'giora','giovaocu', 'gioracu', 'giovaoUpdate', 'gioraUpdate'], {
      theme: 'blue-grey',
      lang: 'en'
    });

    timepicker.on('change', function(evt){
      var value = (evt.hour || '00') + ':' + (evt.minute || '00');
      evt.element.value = value;
      
      var id = evt.element.id;
      times[id] = value;

    });
  // END TIME PICKER


  //DATE PICKER
  $("#ngaycu").datepicker("option", "dateFormat", "dd/mm/yy");

  //END DATE PICKER

    
    $( document ).ready(function() {
        idphong = sessionStorage.getItem("idphong");
        tenphong = sessionStorage.getItem("tenphong");
        // alert(idphong);
        document.getElementById("phongsearch").value = tenphong;
        document.getElementById("phongbaotri_loc").value = tenphong;
        laydulieubaotri();
        laydulieu();
        $("#datatable-buttons").css("width", "100%");
    });


    function validate(){
      giovao = $("#giovao").val();
      giora = $("#giora").val();

      var regex = new RegExp(':', 'g');
      if(parseInt(giovao.replace(regex, ''), 10) < parseInt(giora.replace(regex, ''), 10)){
        return true;
      } else {
        alert("Giờ vào phải trước giờ ra");
        return false;
      }
    }

    function validate_update(){
      giovao = $("#giovaoUpdate").val();
      giora = $("#gioraUpdate").val();

      var regex = new RegExp(':', 'g');
      if(parseInt(giovao.replace(regex, ''), 10) < parseInt(giora.replace(regex, ''), 10)){
        return true;
      } else {
        alert("Giờ vào phải trước giờ ra");
        return false;
      }
    }


    function laydulieu()
    {
      setTimeout(function(){ 
        idphong = sessionStorage.getItem("idphong");
        idhocky = $( "#hockysearch" ).val();

        if(idphong != null){
          $('#modalLoading').modal('show');
            $.ajax({
            url: "<?= nguoidung_url('nhatkycontroller/laydulieu') ?>",
            method: "POST",
            async: false,
            data: {
              idphong: idphong,
              idhocky: idhocky
            },
            type: "application/json",
            success: function (data) {
                var data = JSON.parse(data);
                var mangketqua = data.mangketqua;
                var mangsodo = data.sodo;
                var tengv = data.tengv;

                var baseurl = "<?= nguoidung_url('nhatkycontroller/') ?>";
                
                const bangKetQua = $('#datatable-buttons').DataTable();

                if (mangketqua.length != 0) {
                    bangKetQua.clear();
                    stt = 1;
                    for (let x of mangketqua) {

                      // xác định đường dẫn xóa
                      var urlXoa = baseurl + "xoanhatky/";
                      urlXoa = urlXoa+ x.idNhatKy;
                      var thaotac = "";

                      if("1" == "<?= $this->session->userdata("quyenhan") ?>"){
                        thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.idNhatKy+'" giovao="'+x.giovao+'" giora="'+x.giora+'" mucdichsd="'+x.mucdichsd+'" tinhtrangtruoc="'+x.tinhtrangtruoc+'" tinhtrangsau="'+x.tinhtrangsau+'" phongmay="'+x.maphong+'" onclick="hienthilichsu(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                            +
                            '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';
                      }else if(x.hoten == "<?= $this->session->userdata("hoten") ?>"){
                        thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.idNhatKy+'" giovao="'+x.giovao+'" giora="'+x.giora+'" mucdichsd="'+x.mucdichsd+'" tinhtrangtruoc="'+x.tinhtrangtruoc+'" tinhtrangsau="'+x.tinhtrangsau+'" phongmay="'+x.maphong+'" onclick="hienthilichsu(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                            +
                            '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';
                      }
                        var rowNode = bangKetQua.row.add([
                            stt,
                            reformatDate(x.ngay),
                            x.giovao,
                            x.giora,
                            x.mucdichsd,
                            x.tinhtrangtruoc,
                            x.tinhtrangsau,
                            x.hoten,
                            (x.ngay >= getdate() || "<?= $this->session->userdata("quyenhan") ?>" == 1) ? thaotac : ""
                        ])
                        .draw(false);
                        stt++;
                    }
                }
                else
                {
                  bangKetQua.clear().draw();
                }

                // sơ đồ máy
                if (mangsodo.length != 0) {
                  $('#sodo').html("");
                   $("#sodo").append("<div class='title'>Sơ đồ phòng máy</div>");
                  for (let x of mangsodo) {
                    if (x.tinhtrang == "Hư hỏng") {
                      somay = x.somay;
                      if(x.somay < 10){
                        somay = "0"+x.somay;
                      }
                      $("#sodo").append('<button class="btn btn-danger btn-sm" id="'+x.id+'" tentb="'+x.tentb+'" mota="'+x.mota+'" tinhtrang="'+x.tinhtrang+'" ghichutinhtrang="'+x.ghichutinhtrang+'" onclick="setTinhTrang(this)" data-toggle="tooltip" data-placement="top" title="'+x.ghichutinhtrang+'">'+somay+'</button>');
                    }else{
                      somay = x.somay;
                      if(x.somay < 10){
                        somay = "0"+x.somay;
                      }
                      $("#sodo").append('<button class="btn btn-primary btn-sm" id="'+x.id+'" tentb="'+x.tentb+'" mota="'+x.mota+'" tinhtrang="'+x.tinhtrang+'" onclick="setTinhTrang(this)">'+somay+'</button>');
                    }
                  }
                }else
                  $('#sodo').html("");

                // set giao vien quan ly
                $('#gvql').text((tengv.tengv == "") ? "Chưa có": tengv.tengv);
                $('#modalLoading').modal('hide');
            },
            error: function (xhr, status, errorThrown) {
              // toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
              alert("Có lỗi xảy ra, thử lại!"+errorThrown);
              $('#modalLoading').modal('hide');
            }
          });
        }
        
       }, 500);
      //$('#modalLoading').modal('hide');
    }

    function laydulieubaotri()
    {
      setTimeout(function(){ 
        idphong = sessionStorage.getItem("idphong");
        idhocky = $( "#hocky_baotri" ).val();

        if(idphong != null){
          $('#modalLoading').modal('show');
            $.ajax({
            url: "<?= nguoidung_url('nhatkytinhtrangtbcontroller/laydulieu') ?>",
            method: "POST",
            async: false,
            data: {
              idphong: idphong,
              idhocky: idhocky
            },
            type: "application/json",
            success: function (data) {
                var data = JSON.parse(data);
                var mangketqua = data.mangketqua;

                var baseurl = "<?= nguoidung_url('nhatkytinhtrangtbcontroller/') ?>";
                
                const bangKetQua = $('#bangbaotri').DataTable();

                if (mangketqua.length != 0) {
                    bangKetQua.clear();
                    stt = 1;
                    for (let x of mangketqua) {

                      // xác định đường dẫn xóa
                      var urlXoa = baseurl + "xoa/";
                      urlXoa = urlXoa+ x.id;
                      var thaotac = "";

                      thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.id+'" ngaybaotri="'+x.ngaybaotri+'" motahuhong="'+x.motahuhong+'" noidungbaotri="'+x.noidungbaotri+'" nguoibaotri="'+x.nguoibaotri+'" nguoikiemtra="'+x.nguoikiemtra+'" ghichu="'+x.ghichu+'" onclick="capnhatbaotri(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                            +
                            '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';

                      var rowNode = bangKetQua.row.add([
                          stt,
                          x.maso+" - "+x.tentb,
                          reformatDate(x.ngaybaotri),
                          x.motahuhong,
                          x.noidungbaotri,
                          x.nguoibaotri,
                          x.nguoikiemtra,
                          x.ghichu,
                          x.ngay,
                          thaotac
                      ])
                      .draw(false);
                      stt++;
                    }
                }
                else
                {
                  bangKetQua.clear().draw();
                }

               
                $('#modalLoading').modal('hide');
            },
            error: function (xhr, status, errorThrown) {
              // toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
              alert("Có lỗi xảy ra, thử lại!"+errorThrown);
              $('#modalLoading').modal('hide');
            }
          });
        }
        
       }, 500);
      //$('#modalLoading').modal('hide');
    }

    function getdate(){
      var today = new Date();
      var dd = today.getDate();

      var mm = today.getMonth()+1; 
      var yyyy = today.getFullYear();
      if(dd<10) 
      {
          dd='0'+dd;
      } 

      if(mm<10) 
      {
          mm='0'+mm;
      } 
      today = yyyy+'-'+mm+'-'+dd;
      return today;
    }

    function setTinhTrang(obj)
    {
      var id=obj.id;
      var tinhtrang=($("#"+id).attr("tinhtrang"));
      var tentb=($("#"+id).attr("tentb"));
      var ghichu=($("#"+id).attr("ghichutinhtrang"));
      var mota=($("#"+id).attr("mota"));

      $("#motaUpdate").val(mota);
      $("#tinhtrangUpdate").val(tinhtrang);
      $("#tentbUpdate").val(tentb);
      $("#ghichuUpdate").val(ghichu);
      $("#idUpdateSoMay").val(id);
      $("#modalCapNhatTinhTrang").modal();
    }

    function reformatDate(dateStr)
    {
      dArr = dateStr.split("-");
      return dArr[2]+ "/" +dArr[1]+ "/" +dArr[0];
    }

    function dialogDelete()
    {
      if(window.confirm("Bạn có chắc xóa")==true){
        return true;
      }
      return false;
    }

    function hienthilichsu(obj)
    {
      var id=obj.id;

      var phongmayUpdate=($("#"+id).attr("phongmay"));
      
      $.ajax({
          url: "<?= nguoidung_url('nhatkycontroller/laytenphongkho') ?>",
          method: "POST",
          async: false,
          data: {
            idphong: phongmayUpdate
          },
          type: "application/json",
          success: function (data) {
              var data = JSON.parse(data);
              var giovaoUpdate=($("#"+id).attr("giovao"));
              var gioraUpdate=($("#"+id).attr("giora"));
              var mucdichUpdate=($("#"+id).attr("mucdichsd"));
              var tinhtrangtruocUpdate=($("#"+id).attr("tinhtrangtruoc"));
              var tinhtrangsauUpdate=($("#"+id).attr("tinhtrangsau")); 

              document.getElementById("idKhoUpdate").value = data.id;
              document.getElementById("phongmayUpdate").value = data.tenphong;
              document.getElementById("giovaoUpdate").value = giovaoUpdate;
              document.getElementById("gioraUpdate").value = gioraUpdate;
              document.getElementById("mucdichUpdate").value = mucdichUpdate;
              document.getElementById("tinhtrangtruocUpdate").value = tinhtrangtruocUpdate;
              document.getElementById("tinhtrangsauUpdate").value = tinhtrangsauUpdate;
              document.getElementById("idUpdate").value = id;

              $('#modalLoading').modal('hide');
              $("#modalsua").modal();              
          },
          error: function (xhr, status, errorThrown) {
            toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
            $('#modalLoading').modal('hide');
          }
      });
    }

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
            "aoColumnDefs": [{ "bVisible": false, "aTargets": [1] }],
            "lengthMenu": [
              [ 10, 25, 50, -1 ],
              [ '10', '25', '50', 'Tất cả' ]
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
        
      }

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
        // window.localStorage.setItem('phongkholoc', $('#phongkhoLoc option:selected').val());
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

      function reload(){
        let pk = window.localStorage.getItem("phongkholoc");
        let tt = window.localStorage.getItem("tinhtrangLoc");
        let loai = window.localStorage.getItem("loaiLoc");

        
        filterData(1, loai, "", "", "", tt, pk,"","");
        // $('#modalLoading').modal('hide');
        setTimeout(function(){ 
          // $("#phongkhoLoc").val((pk == null) ? "": pk).change();
          $("#tinhtrangLoc").val(tt).change();
          $("#loaiLoc").val(loai).change();
        }, 1000);

        $('.nav-md').css('padding-right', "0");
      }


    function loadthietbibaotri(maphong) {
      $.ajax({
        url: "<?= nguoidung_url('nhatkytinhtrangtbcontroller/laythietbi') ?>",
        method:"POST",
        data:{
          maphong: maphong,
        },
        success:function(data){
          var arrTinh = JSON.parse(data);
          var sel = document.getElementById('thietbi');
          // clear select box
          $('#thietbi')
              .find('option')
              .remove()
              .end()
          ;

          // add option for select
          arrTinh.forEach(function(element) {
            var opt = document.createElement('option');
            ghichu = (element['ghichu'] == "") ? "" : " - Ghi chú: "+ element['ghichu'];

            opt.appendChild( document.createTextNode("Mã TB: "+ element['maso']+ " - " +element['tentb']  + ghichu ));
            opt.value = element['id']; 
            sel.appendChild(opt); 
          });
        },
        error: function (xhr, status, errorThrown) {
          //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
        }
      });
    }

    function capnhatbaotri(obj)
    {
      var id=obj.id;
      var ngaybaotri=($("#"+id).attr("ngaybaotri"));
      var motahuhong=($("#"+id).attr("motahuhong"));
      var noidungbaotri=($("#"+id).attr("noidungbaotri"));
      var nguoibaotri=($("#"+id).attr("nguoibaotri"));
      var nguoikiemtra=($("#"+id).attr("nguoikiemtra"));
      var ghichu=($("#"+id).attr("ghichu"));

      $("#ngaybaotri_update").val(ngaybaotri);
      $("#motabaotri_update").val(motahuhong);
      $("#noidungbaotri_update").val(noidungbaotri);
      $("#nguoibaotri_update").val(nguoibaotri);
      $("#nguoikiemtra_update").val(nguoikiemtra);
      $("#ghichubaotri_update").val(ghichu);

      $("#idUpdate_baotri").val(id);
      $("#modalcapnhatbaotri").modal();
    }

    </script>

   <!--  <script type="text/javascript">
    $( document ).ready(function() {

            $('body').removeClass('nav-md').addClass('nav-sm');
            $('.left_col').removeClass('scroll-view').removeAttr('style');
            $('#sidebar-menu li').removeClass('active');
            $('#sidebar-menu li ul').slideUp();


           
      });
    </script> -->
  </body>
</html>