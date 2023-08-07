<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">
    <title>Sổ vật tư</title>

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
                <h3>Quản lý vật tư học tập</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                 <!--  <a class="btn btn-primary" href="<?= nguoidung_url('sokhocontroller/xuatsonhatky') ?>">
                    <i class="fa fa-file"></i> 
                      In sổ vật tư
                  </a>
                   -->



              <div id="tabs">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">Sổ vật tư</a></li>
                  <li><a data-toggle="tab" href="#menu1">Đơn vị tính</a></li>
                </ul>

                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <h3>Sổ vật tư</h3>
                    <div class="row">
                      <div class="form-group row col-xs-4">
                        <label class="col-sm-3">ĐƠN VỊ</label>
                        <div class="col-sm-9">
                          <select class="form-control" id="donvisearch"
                            required="required" class="form-control" onchange="laydulieu()">
                            <?php foreach ($donvi as $value): ?>
                              <option value="<?= $value['id'] ?>"><?= $value['tendonvi'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-xs-4">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">HỌC KỲ</label>
                          <div class="col-sm-8">
                            <select id="hockysearch" class="form-control" onchange="laydulieu()">
                            <?php foreach ($hocky as $val): ?>
                                <option value="<?= $val->id ?>">
                                  Học kỳ <?= $val->hocky ?> (<?= $val->tunam ?> - <?= $val->dennam ?>)
                                </option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>

                      </div>
                      
                      <div class="col-xs-4">
                        <div class="form-group">
                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalthem">
                          <i class="fa fa-calendar"></i> 
                            Thêm lịch sử dụng
                        </button>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalin">
                          <i class="fa fa-file"></i> 
                            In sổ vật tư
                        </button>
                        </div>
                      </div>
                    </div>


                    <div class="x_content">
                      

                      <table id="datatable-buttons" class="table table-striped" style="font-size: 15px">
                        <thead>
                          <tr>
                            <th>DANH MỤC</th>
                            <th>TIÊU HAO</th>
                            <th>ĐVT</th>
                            <th>SỐ LƯỢNG</th>
                            <th>NGÀY NHẬN</th>
                            <th>GHI CHÚ</th>
                            <th>GV NHẬN</th>
                            <th>THAO TÁC</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div id="menu1" class="tab-pane fade">
                    <h3>Đơn vị tính</h3>
                    <?php if ($this->session->userdata("quyenhan") == 1 ||
                            $this->session->userdata("quyenhan") == 2  ): ?>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalthemdonvi">
                        <i class="fa fa-university"></i> 
                          Thêm mới
                      </button>
                    <?php endif ?>
                    

                    <div class="x_content">
                      
                      <table id="datatable-buttons" class="table table-striped" style="font-size: 15px">
                        <thead>
                          <tr>
                            <th>Đơn vị tính</th>
                           
                            <?php if ($this->session->userdata("quyenhan") == 1 ||
                                      $this->session->userdata("quyenhan") == 2  ): ?>
                              <th>Thao tác</th>
                            <?php endif ?>
                          </tr>
                        </thead>

                        <tbody class="them">
                           <?php foreach ($donvitinh as $value): ?>
                            <tr>
                              <td><?= $value->tendonvi ?></td>
                              <?php if ($this->session->userdata("quyenhan") == 1 ||
                                      $this->session->userdata("quyenhan") == 2  ): ?>
                                <td style="text-align: center;">
                                    <button 
                                      class="btn btn-primary"
                                      id="<?= $value->id ?>_dvt" 
                                      tendonvi="<?= $value->tendonvi ?>"
                                      onclick="hienthicapnhat_dvt(this)">
                                      Sửa
                                    </button>
                                    <a 
                                        class="btn btn-danger"
                                        onclick="return dialogDelete()"
                                        href="<?php echo nguoidung_url('vattuhoctapcontroller/xoa_donvitinh/').$value->id; ?>">
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


            </div>
          </div>
        </div>
        
        <!-- /page content -->
<!-- Modal thêm vật tư-->
<div class="modal fade" id="modalthem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('vattuhoctapcontroller/themmoi') ?>" method="POST">
        <div class="modal-body">

          <input name="idhocky" id="idhocky_add" type="hidden" hidden="hidden" >

          <div class="form-group row">
            <label class="col-sm-3">ĐƠN VỊ</label>
            <div class="col-sm-9">
              <select class="form-control" id="donvi" name="donvithem" 
                required="required" class="form-control" onchange="chondonvi(this, 'phongmay')">
                <option></option>
                <?php foreach ($donvi as $value): ?>
                  <option value="<?= $value['id'] ?>"><?= $value['tendonvi'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3">PHÒNG MÁY</label>
            <div class="col-sm-9">
              <select class="form-control" id="phongmay" name="phongmay" 
                required="required" class="form-control" onchange="chonphong(this, 'thietbi')">
                
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3">THIẾT BỊ</label>
            <div class="col-sm-9">
              <select class="form-control" id="thietbi" name="thietbi[]" required="required" class="form-control" multiple size="10">
              </select>
              <small class="form-text text-muted">Chỉ hiện thị những thiết bị đang sử dụng.</small>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3">TIÊU HAO</label>
            <div class="col-sm-9">
              <input class="form-control" type="number" name="add_tieuhao">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3">ĐƠN VỊ TÍNH</label>
            <div class="col-sm-9">
              <select class="form-control" name="add_donvitinh">
                <?php foreach ($donvitinh as $value): ?>
                  <option value="<?php echo $value->tendonvi ?>"><?php echo $value->tendonvi ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-3">NGÀY NHẬN</label>
            <div class="col-sm-9">
              <div class="input-group date" data-provide="datepicker">
                  <input type="text" size="8" class="form-control" id="add_ngaynhan" name="add_ngaynhan" required="required">
                  <div class="input-group-addon">
                      <span class="fa fa-th"></span>
                  </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3">GHI CHÚ</label>
            <div class="col-sm-9">
              <input class="form-control" type="text" name="add_ghichu">
            </div>
          </div>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">GIÁO VIÊN 1</th>
                <th scope="col">GIÁO VIÊN 2</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">HỌ TÊN</th>
                <td>
                  <select class="form-control" name="add_gv1" required="required" class="form-control">
                    <option></option>
                    <?php foreach ($giaovien as $value): ?>
                      <option value="<?= $value->hoten ?>"><?= $value->hoten ?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                <td>
                  <select class="form-control" name="add_gv2" class="form-control">
                    <option></option>
                    <?php foreach ($giaovien as $value): ?>
                      <option value="<?= $value->hoten ?>"><?= $value->hoten ?></option>
                    <?php endforeach ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">SỐ LƯỢNG</th>
                <td>
                  <input class="form-control" type="number" id="add_soluong_gv1" name="add_soluong_gv1" value="1">
                </td>
                <td>
                  <input class="form-control" type="number" name="add_soluong_gv2">
                </td>
              </tr>
              <tr>
                <th scope="row">NGÀY NHẬN</th>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="add_ngaynhan_gv1" name="add_ngaynhan_gv1">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="add_ngaynhan_gv2" name="add_ngaynhan_gv2">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">NGÀY TRẢ</th>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="add_ngaytra_gv1" name="add_ngaytra_gv1">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="add_ngaytra_gv2" name="add_ngaytra_gv2">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

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
          action="<?= nguoidung_url('vattuhoctapcontroller/capnhat') ?>" method="POST">
        <div class="modal-body">
          <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
          <input name="update_tentb" id="update_tentb" type="hidden" class="form-control" hidden="hidden" >
          <!-- <div class="form-group row">
            <label class="col-sm-4">PHÒNG MÁY</label>
            <div class="col-sm-8">
              <select class="form-control" class="form-control" onchange="chonphong(this, 'update_thietbi')">
                <option></option>
                <?php foreach ($phong as $value): ?>
                  <option value="<?= $value->id ?>"><?= $value->maphong ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4">THIẾT BỊ</label>
            <div class="col-sm-8">
              <select class="form-control" id="update_thietbi" name="update_thietbi" required="required" class="form-control">
              </select>
            </div>
          </div> -->

          <div class="form-group row">
            <label class="col-sm-4">TIÊU HAO</label>
            <div class="col-sm-8">
              <input class="form-control" type="number" id="update_tieuhao" name="update_tieuhao">
            </div>


          </div>

          <div class="form-group row">
            <label class="col-sm-4">ĐƠN VỊ TÍNH</label>
            <div class="col-sm-8">
              <select class="form-control" id="update_donvitinh" name="update_donvitinh">
                <?php foreach ($donvitinh as $value): ?>
                  <option value="<?php echo $value->tendonvi ?>"><?php echo $value->tendonvi ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-4">NGÀY NHẬN</label>
            <div class="col-sm-8">
              <div class="input-group date" data-provide="datepicker">
                  <input type="text" size="8" class="form-control" id="update_ngaynhan" name="update_ngaynhan" required="required">
                  <div class="input-group-addon">
                      <span class="fa fa-th"></span>
                  </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4">GHI CHÚ</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="update_ghichu" name="update_ghichu">
            </div>
          </div>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">GIÁO VIÊN 1</th>
                <th scope="col">GIÁO VIÊN 2</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">HỌ TÊN</th>
                <td>
                  <select class="form-control" id="update_gv1" name="update_gv1" required="required" class="form-control">
                    <option></option>
                    <?php foreach ($giaovien as $value): ?>
                      <option value="<?= $value->hoten ?>"><?= $value->hoten ?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                <td>
                  <select class="form-control" id="update_gv2" name="update_gv2" class="form-control">
                    <option></option>
                    <?php foreach ($giaovien as $value): ?>
                      <option value="<?= $value->hoten ?>"><?= $value->hoten ?></option>
                    <?php endforeach ?>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">SỐ LƯỢNG</th>
                <td>
                  <input class="form-control" type="number" id="update_soluong_gv1" name="update_soluong_gv1">
                </td>
                <td>
                  <input class="form-control" type="number" id="update_soluong_gv2" name="update_soluong_gv2">
                </td>
              </tr>
              <tr>
                <th scope="row">NGÀY NHẬN</th>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="update_ngaynhan_gv1" name="update_ngaynhan_gv1">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="update_ngaynhan_gv2" name="update_ngaynhan_gv2">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">NGÀY TRẢ</th>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="update_ngaytra_gv1" name="update_ngaytra_gv1">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
                <td>
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" size="8" class="form-control" id="update_ngaytra_gv2" name="update_ngaytra_gv2">
                      <div class="input-group-addon">
                          <span class="fa fa-th"></span>
                      </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          
          

        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal thông tin-->
<div class="modal fade" id="modalthongtin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thông tin giáo viên</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">GIÁO VIÊN 1</th>
                <th scope="col">GIÁO VIÊN 2</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">HỌ TÊN</th>
                <td><input type="text" class="form-control" id="show_ten_gv1" disabled="disabled"></td>
                <td><input type="text" class="form-control" id="show_ten_gv2" disabled="disabled"></td>
              </tr>
              <tr>
                <th scope="row">SỐ LƯỢNG</th>
                <td><input type="text" class="form-control" id="show_sl_gv1" disabled="disabled"></td>
                <td><input type="text" class="form-control" id="show_sl_gv2" disabled="disabled"></td>
              </tr>
              <tr>
                <th scope="row">NGÀY NHẬN</th>
                <td><input type="text" class="form-control" id="show_ngaynhan_gv1" disabled="disabled"></td>
                <td><input type="text" class="form-control" id="show_ngaynhan_gv2" disabled="disabled"></td>
              </tr>
              <tr>
                <th scope="row">NGÀY TRẢ</th>
                <td><input type="text" class="form-control" id="show_ngaytra_gv1" disabled="disabled"></td>
                <td><input type="text" class="form-control" id="show_ngaytra_gv2" disabled="disabled"></td>
              </tr>
            </tbody>
          </table>
      
    </div>
  </div>
</div>

<!-- Modal thêm đơn vị tính-->
<div class="modal fade" id="modalthemdonvi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('vattuhoctapcontroller/themmoi_donvitinh') ?>" method="POST">
        <div class="modal-body">

          <div class="form-group row">
            <label class="col-sm-3">ĐƠN VỊ TÍNH</label>
            <div class="col-sm-9">
              <input class="form-control"  name="add_donvitinh" 
                required="required" class="form-control"/>
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

<!-- Modal cập nhật đơn vị tính--> 
<div class="modal fade" id="modalsua_donvitinh" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Cập nhật</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('vattuhoctapcontroller/capnhat_donvitinh') ?>" method="POST">
        <div class="modal-body">
          <input name="idUpdate_dvt" id="idUpdate_dvt" type="hidden" class="form-control" hidden="hidden" >

          
          <div class="form-group row">
            <label class="col-sm-3">ĐƠN VỊ TÍNH</label>
            <div class="col-sm-9">
              <input class="form-control" id="update_tendonvi" name="update_tendonvi" 
                required="required" class="form-control"/>
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

<!-- Modal in-->
<div class="modal fade" id="modalin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>In sổ vật tư</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('vattuhoctapcontroller/xuatsovattu') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>ĐƠN VỊ</label>
            <select class="form-control" name="donviin" required="required" class="form-control">
              <?php foreach ($donvi as $val): ?>
                <option value="<?= $val['id'] ?>">
                  <?= $val['tendonvi'] ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
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
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">In</button>
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
     <!-- datepicker -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js" integrity="sha512-o+RlJQ7OEtgCdvdgOJfjEASLgiLB9mA8bfWF4JnyA0cWHy7wtb4S4GRxgPor4iqKKLx0CoIFRcMecGnKSTTY1g==" crossorigin="anonymous"></script>


<script type="text/javascript">
  window.onload = function() {
        $('.dataTables_filter input[type="search"]').css(
           {'width':'8em','display':'inline-block'}
        );
  }

  $( document ).ready(function() {
    idhocky = sessionStorage.getItem("idhocky");
    madonvi = sessionStorage.getItem("madonvi");
    if(idhocky != null){
      $("#hockysearch").val(idhocky);
    }
    if(madonvi != null){
      $("#donvisearch").val(madonvi);
    }

    //lưu lại tab
    $('a[data-toggle="tab"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('selectedTab', id)
    });

    var selectedTab = localStorage.getItem('selectedTab');
    if (selectedTab != null) {
        $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
    }


    laydulieu();
  });

  // DATETIME PICKER
  $.fn.datepicker.defaults.language = 'vi';
  $.fn.datepicker.defaults.autoclose = true;
  // END DATETIME PICKER

  $('#thietbi').change(function(e) {
      var selected = $(e.target).val();
      $("#add_soluong_gv1").val(selected.length);
  }); 

  function chondonvi(obj, idsel) {
    var iddv = obj.value;
    $.ajax({
      url: "<?= donvi_url('phong_khocontroller/laydulieu') ?>",
      method:"POST",
      data:{
        madonvi: iddv,
      },
      success:function(data){
        var arrTinh = JSON.parse(data);

        var sel = document.getElementById(idsel);
        // clear select box
        $('#'+idsel)
            .find('option')
            .remove()
            .end()
        ;

        // add option for select
        arrTinh.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode( element['maphong'] ));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

  function chonphong(obj, idsel) {
    var maphong = obj.value;
    $.ajax({
      url: "<?= nguoidung_url('vattuhoctapcontroller/laythietbi') ?>",
      method:"POST",
      data:{
        maphong: maphong,
      },
      success:function(data){
        var arrTinh = JSON.parse(data);
        var sel = document.getElementById(idsel);
        // clear select box
        $('#'+idsel)
            .find('option')
            .remove()
            .end()
        ;

        // add option for select
        arrTinh.forEach(function(element) {
          var opt = document.createElement('option');
          ghichu = (element['ghichu'] == "") ? "" : " - Ghi chú: "+ element['ghichu'];

          opt.appendChild( document.createTextNode( element['tentb'] +" (Số lượng: "+element['sl']+")" + ghichu ));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

    
    $( document ).ready(function() {
        laydulieu();
        $("#datatable-buttons").css("width", "100%");
    });
    function laydulieu()
    {
      // $("#loadbar").modal('show');
      idhocky = $( "#hockysearch" ).val();
      madonvi = $( "#donvisearch" ).val();
      sessionStorage.setItem("idhocky", idhocky);
      sessionStorage.setItem("madonvi", madonvi);
      $( "#idhocky_add" ).val(idhocky);
      setTimeout(function(){ 
        $.ajax({
          url: "<?= nguoidung_url('vattuhoctapcontroller/laydulieu') ?>",
          method: "POST",
          async: false,
          data: {
            idhocky: idhocky,
            madonvi: madonvi
          },
          type: "application/json",
          success: function (data) {
              var data = JSON.parse(data);
              var mangketqua = data.mangketqua;
              var baseurl = "<?= nguoidung_url('vattuhoctapcontroller/') ?>";
              
              const bangKetQua = $('#datatable-buttons').DataTable();

              if (mangketqua.length != 0) {
                  bangKetQua.clear();
                  for (let x of mangketqua) {

                    // xác định đường dẫn xóa
                    var urlXoa = baseurl + "xoa/"+ x.id;

                    thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.id+'_update" danhmuc="'+x.danhmuc+'" tieuhao="'+x.tieuhao+'" dvt="'+x.dvt+'" ngaynhan="'+x.ngaynhan+'" ten_gv1="'+x.ten_gv1+'" sl_gv1="'+x.sl_gv1+'" ngaynhan_gv1="'+x.ngaynhan_gv1+'" ngaytra_gv1="'+x.ngaytra_gv1+'" ten_gv2="'+x.ten_gv2+'" sl_gv2="'+x.sl_gv2+'" ngaynhan_gv2="'+x.ngaynhan_gv2+'" ngaytra_gv2="'+x.ngaytra_gv2+'" ghichu="'+x.ghichu+'" onclick="hienthicapnhat(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                      +
                      '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';


                    thongtin = '<a style="padding: 6px" id="'+x.id+'_tt" ten_gv1="'+x.ten_gv1+'" sl_gv1="'+x.sl_gv1+'" ngaynhan_gv1="'+x.ngaynhan_gv1+'" ngaytra_gv1="'+x.ngaytra_gv1+'" ten_gv2="'+x.ten_gv2+'" sl_gv2="'+x.sl_gv2+'" ngaynhan_gv2="'+x.ngaynhan_gv2+'" ngaytra_gv2="'+x.ngaytra_gv2+'" onclick="hienthithongtin(this)">Nhấn để xem</a>'

                      var rowNode = bangKetQua.row.add([
                          x.danhmuc,
                          x.tieuhao,
                          x.dvt,
                          eval(x.sl_gv1)+ eval(x.sl_gv2),
                          x.ngaynhan,
                          x.ghichu,
                          thongtin,
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

    function hienthithongtin(obj)
    {
      var id=obj.id;

      var ten_gv1=($("#"+id).attr("ten_gv1"));
      var ten_gv2=($("#"+id).attr("ten_gv2"));
      var sl_gv1=($("#"+id).attr("sl_gv1"));
      var sl_gv2=($("#"+id).attr("sl_gv2"));
      var ngaynhan_gv1=($("#"+id).attr("ngaynhan_gv1"));
      var ngaynhan_gv2=($("#"+id).attr("ngaynhan_gv2"));
      var ngaytra_gv1=($("#"+id).attr("ngaytra_gv1"));
      var ngaytra_gv2=($("#"+id).attr("ngaytra_gv2")); 

      document.getElementById("show_ten_gv1").value = ten_gv1;
      document.getElementById("show_ten_gv2").value = ten_gv2;
      document.getElementById("show_sl_gv1").value = sl_gv1;
      document.getElementById("show_sl_gv2").value = sl_gv2;
      document.getElementById("show_ngaynhan_gv1").value = ngaynhan_gv1;
      document.getElementById("show_ngaynhan_gv2").value = ngaynhan_gv2;
      document.getElementById("show_ngaytra_gv1").value = ngaytra_gv1;
      document.getElementById("show_ngaytra_gv2").value = ngaytra_gv2;
      $("#modalthongtin").modal();
    }

    function hienthicapnhat(obj)
    {
      var id=obj.id;

      var tentb=($("#"+id).attr("danhmuc"));
      var tieuhao=($("#"+id).attr("tieuhao")); 
      var dvt=($("#"+id).attr("dvt"));
      var ngaynhan=($("#"+id).attr("ngaynhan"));

      var ten_gv1=($("#"+id).attr("ten_gv1"));
      var ten_gv2=($("#"+id).attr("ten_gv2"));
      var sl_gv1=($("#"+id).attr("sl_gv1"));
      var sl_gv2=($("#"+id).attr("sl_gv2"));
      var ngaynhan_gv1=($("#"+id).attr("ngaynhan_gv1"));
      var ngaynhan_gv2=($("#"+id).attr("ngaynhan_gv2"));
      var ngaytra_gv1=($("#"+id).attr("ngaytra_gv1"));
      var ngaytra_gv2=($("#"+id).attr("ngaytra_gv2")); 
      var ghichu=($("#"+id).attr("ghichu")); 


      document.getElementById("update_tentb").value = tentb;
      document.getElementById("update_tieuhao").value = eval(tieuhao);
      document.getElementById("update_donvitinh").value = dvt;
      document.getElementById("update_ngaynhan").value = ngaynhan;

      document.getElementById("update_gv1").value = ten_gv1;
      document.getElementById("update_gv2").value = ten_gv2;
      document.getElementById("update_soluong_gv1").value = sl_gv1;
      document.getElementById("update_soluong_gv2").value = sl_gv2;
      document.getElementById("update_ngaynhan_gv1").value = ngaynhan_gv1;
      document.getElementById("update_ngaynhan_gv2").value = ngaynhan_gv2;
      document.getElementById("update_ngaytra_gv1").value = ngaytra_gv1;
      document.getElementById("update_ngaytra_gv2").value = ngaytra_gv2;
      document.getElementById("update_ghichu").value = (ghichu == "null") ? "" : ghichu;

      document.getElementById("idUpdate").value = id;
      $("#modalsua").modal();
    }

    function hienthicapnhat_dvt(obj)
    {
      var id=obj.id;
      var tendonvi=($("#"+id).attr("tendonvi"));
      document.getElementById("update_tendonvi").value = tendonvi;
      document.getElementById("idUpdate_dvt").value = obj.id;
      $("#modalsua_donvitinh").modal();
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