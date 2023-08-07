<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\Response\QrCodeResponse;

use Endroid\QrCode\Response\WriterRegistry;
use Endroid\QrCode\Factory\QrCodeFactory;
use Endroid\QrCode\Exception\GenerateImageException;


class danhsachmaymocthietbicontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('maymocthietbi/danhsachmaymocthietbimodel');
		$this->load->model('maymocthietbi/loaimaymocthietbimodel');
		$this->load->model('maymocthietbi/nhommaymocthietbimodel');
		$this->load->model('maymocthietbi/lichsumaymocthietbimodel');
		$this->load->model('tinhtrang/tinhtrangmodel');
		$this->load->model('donvi/donvimodel');
		$this->load->model('donvi/phong_khomodel');
		$this->load->library('excel');
	}

	public function index()
	{
		$dv=$this->donvimodel->getAlldata();
		$dv=array("mangdv"=> $dv);

		$loaimay=$this->loaimaymocthietbimodel->getAlldata();
		$loaimay=array("mangloaimay"=> $loaimay);

		$nhommay=$this->nhommaymocthietbimodel->getAlldata();
		$nhommay=array("mangnhommay"=> $nhommay);

		$tinhtrang=$this->tinhtrangmodel->getAlldata();
		$tinhtrang=array("mangtinhtrang"=> $tinhtrang);

		$phongkho=$this->phong_khomodel->layphongkho($this->session->userdata("madonvi"));

		$data = array();
		$data['dv'] = $dv;
		$data['loaimay'] = $loaimay;
		$data['nhommay'] = $nhommay;
		$data['tinhtrang'] = $tinhtrang;
		$data['phongkho'] = $phongkho;

		$this->load->view('maymocthietbi/danhsach',$data);
	}

	public function hienthitrangthem()
	{
		$dv=$this->donvimodel->getAlldata();

		$data = array();
		$data['dv'] = $dv;
		if($this->session->userdata('quyenhan') == "1")
			$data['dv'] = $dv;
		else{
			$madonvi = $this->session->userdata('madonvi');
			foreach ($dv as $value) {
			    if($value['id'] == $madonvi){
			    	$data['dv'] = $value;
			    	break;
			    }
			}
		}

		$this->load->view('maymocthietbi/themdanhsach',$data);
	}

	public function luuthietbi(){
		$mangthietbi = $this->input->post('mangthietbi');
		// print_r($mangthietbi);
		$arrError = array();
		if(count($mangthietbi) > 0){
			foreach ($mangthietbi as $it){
				$tb = json_decode($it, true);
				// kiem tra ma so
				$sl = $this->danhsachmaymocthietbimodel->get_total();
				if($sl < 9) $sl = "0".$sl;
				$maso = "TB".$sl;

				while ($this->danhsachmaymocthietbimodel->check_exists(array('maso'=> $maso))) {
				    $sl = $sl + 1;
				    if($sl < 9) $sl = "0".$sl;
					$maso = "TB".$sl;
				}

				$data = array(
					'tentb'  => $tb['tentb'],
					'mota'   => $tb['mota'],
					'maso' => $maso,
					'namsd'  => $tb['namsd'],
					'nguongoc'   => ($tb['nguongoc'] == "undefined") ? "" : $tb['nguongoc'],
					'donvitinh'  => ($tb['donvitinh'] == "undefined") ? "" : $tb['donvitinh'],
					'soluong'  => 1,
					'gia'  => $tb['gia'],
					'ghichu' => ($tb['ghichu'] != "null") ? $tb['ghichu'] : "",
					'model' => $tb['model'],
					'maphongkho' => $tb['maphongkho'],
					'maloai' => $tb['maloai'],
					'tinhtrang' => $tb['tinhtrang'],
					'chatluong' => $tb['chatluong'],
					'tontai' => 1,
				);
				$check = $this->danhsachmaymocthietbimodel->create($data);
				if(!$check) array_push($arrError, $data);
			}
		}

		$this->index();
	}

	public function xuatexceldaloc(){
		$arrThietBi = $this->session->userdata('dulieuxuat');

		// // tên file
		$inputFileName = FCPATH."public/kiemke.xlsx";
        try {
	        $excel2 = PHPExcel_IOFactory::createReader('Excel2007');
			$excel2 = $excel2->load($inputFileName); // Empty Sheet
			$excel2->setActiveSheetIndex(0);
			$excel2->getDefaultStyle()->getFont()->setName('Times New Roman');

			//set tên đơn vi
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(0,3,"ĐƠN VỊ QLSD: Khoa ".mb_strtoupper($arrThietBi[0]->tendonvi));

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(0,5,"BIÊN BẢN  KIỂM KÊ TÀI SẢN NĂM - ".date("Y"));

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(0,14,"Đã kiểm kê các tài sản thiết bị - dụng cụ trang bị tại Khoa ".$arrThietBi[0]->tenviettat. ' như sau:');

			// them du liệu
			$row = 18;
			$column = 1;
			$index = 1;
			foreach ($arrThietBi as $dulieu) {
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $index);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $dulieu->tentb);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $dulieu->mota);

				if(!isset($dulieu->soluongtt)){
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $dulieu->maso);
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(9, $row, 1);
				}else{
					$arrMaso = explode("*", $dulieu['maso']);
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $arrMaso[0]);
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $dulieu->soluongtt);
				}

				$excel2->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $dulieu->namsd);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $dulieu->nguongoc);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $dulieu->donvitinh);
				// $excel2->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $dulieu['soluong']);
				
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $dulieu->gia);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $dulieu->chatluong);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $dulieu->ghichu);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $dulieu->model);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $dulieu->maphong);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $dulieu->tinhtrang);
				$excel2->getDefaultStyle()->getFont()->setSize(13);
				
				$row++;
				$index++;
			}

			// wrap text
			$excel2->getActiveSheet()->getStyle('A18:Q'.$row)->getAlignment()->setWrapText(true); 

			// Thêm border vào excel
			$BStyle = array(
			  'borders' => array(
			    'allborders' => array(
			      'style' => PHPExcel_Style_Border::BORDER_THIN
			    )
			  )
			);
			$lastRow= $row-1;
			$excel2->getActiveSheet()->getStyle('A18:Q'.$lastRow)->applyFromArray($BStyle);
			//end thêm border

			// footer text
			$t=date('d-m-Y');
			$day = date("d",strtotime($t));
			$excel2->getActiveSheet()->mergeCells('I'.$row.':N'.$row);
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(8,$row,"Vĩnh Long, ngày ".$day." tháng ".date('m')." năm ".date("Y"));
			$row1 = $row+1;
			$row2 = $row+2;
			$excel2->getActiveSheet()->mergeCells('D'.$row1.':G'.$row1);
			$excel2->getActiveSheet()->mergeCells('I'.$row1.':K'.$row1);
			$excel2->getActiveSheet()->mergeCells('L'.$row1.':N'.$row1);
			$excel2->getActiveSheet()->mergeCells('D'.$row2.':G'.$row2);
			$excel2->getActiveSheet()->mergeCells('I'.$row2.':K'.$row2);
			$excel2->getActiveSheet()->mergeCells('L'.$row2.':N'.$row2);
			$excel2->getActiveSheet()->getStyle('B'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('C'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('D'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('I'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('L'.$row1)->getFont()->setBold(true);

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(1,$row1,"Hiệu trưởng");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(2,$row1,"TP. Kế hoạch - Tài chính");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(3,$row1,"TP. Quản trị - Thiết bị");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(8,$row1,"Trưởng đơn vị");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(11,$row1,"Các chuyên viên kiểm kê");

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(1,$row2,"(Ký, Đóng dấu)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(2,$row2,"(Ký, Họ và tên)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(3,$row2,"(Ký, Họ và tên)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(8,$row2,"(Ký, Họ và tên)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(11,$row2,"(Ký, Họ và tên)");

			//end footer

			// center text
			$lastRow = $lastRow + 3;
			$excel2->getActiveSheet()->getStyle('A18:Q'.$lastRow)->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$excel2->getActiveSheet()->getStyle('A18:Q'.$lastRow)->getAlignment()
    		->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		//end center text

			header('Content-Disposition: attachment;filename="thietbidaloc_'.$this->session->userdata("tendonvi").'.xlsx"');
			header('Cache-Control: max-age=0');
  			$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
  			$objWriter->save('php://output');

        } 
        catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
	}

	function fetch_user(){  
		$fetch_data = $this->danhsachmaymocthietbimodel->make_datatables(
       							$_POST['donvi'],
       							$_POST['tenloai'],
       							$_POST['tennhom'],
       							$_POST['nguongoc'],
       							$_POST['gia'],
       							$_POST['tinhtrang'],
       							$_POST['maphong'],
   								$_POST['namsd'],
   								$_POST['chatluong'],
   								$_POST['mode_show']
   							);  
		$this->session->set_userdata('dulieuxuat',$fetch_data);



       $data = array(); 
       $index = 1; 
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
            $sub_array[] = $index;  
            $index++;

            if(($this->session->userdata("tendonvi") == $_POST['donvi'] && $this->session->userdata("quyenhan") == "2") || $this->session->userdata("quyenhan") == "1"){
            	$sub_array[] = '<input style="visibility: visible" type="checkbox" name="idThietbi" value="'.$row->id.'">'; 
            }
            else{
            	// $sub_array[] = '<input type="checkbox" hidden disabled name="idThietbi" value="'.$row->id.'">'; 
            }


            $sub_array[] = $row->maso; 

            $sub_array[] = '<a 
            onclick="setvalue(this)" 
            id="'.$row->id.'" 
            tentb="'.$row->tentb.'" 
            somay="'.$row->somay.'"
            mota="'.$row->mota.'"
            tendonvi="'.$row->tendonvi.'"
            maphong="'.$row->maphong.'"
            chatluong="'.$row->chatluong.'"
            tenloai="'.$row->tenloai.'"
            tennhom=""
            >'.$row->tentb.'</a>';  

            $strSoMay = ($row->somay == "") ? "Chưa có" : $row->somay;
            $sub_array[] = '<a 
            onclick="setSoMay(this)" 
            id="'.$row->id.'somay" 
            tentb="'.$row->tentb.'" 
            somay="'.$row->somay.'"
            >'."Thiết bị ".$strSoMay.'</a>';   


            $sub_array[] = $row->mota;  
            $sub_array[] = (isset($row->tongSL)) ? $row->tongSL : 1;  
            $sub_array[] = $row->namsd; 
            $sub_array[] = ($row->nguongoc == "null") ? "" : $row->nguongoc;
            $sub_array[] = $row->donvitinh;
            $sub_array[] = $row->gia;

            $sub_array[] = $row->maphong;
            
            
            
            
            
            $sub_array[] = $row->chatluong;
            // $sub_array[] = $row->tendonvi;
            // $sub_array[] = ($row->tontai == 0) ? "Vẫn còn" : "Không còn";

            $sub_array[] = $row->ghichu; 
            $sub_array[] = $row->tenloai;
            // $sub_array[] = "";
            $sub_array[] = $row->tinhtrang;
            $sub_array[] = '<a href="'.maymocthietbi_url('danhsachmaymocthietbicontroller/loadmaymocthietbi/').$row->id.'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
            // $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>   intval($_POST["draw"]),  
            "recordsTotal"        =>   $this->danhsachmaymocthietbimodel->get_all_data(
            																$_POST['donvi'],
											       							$_POST['tenloai'],
											       							$_POST['tennhom'],
											       							$_POST['nguongoc'],
											       							$_POST['gia'],
											       							$_POST['tinhtrang'],
											       							$_POST['maphong'],
										       								$_POST['namsd'],
										       								$_POST['chatluong'],
										       								$_POST['mode_show']
										       						),  
            "recordsFiltered"     =>   $this->danhsachmaymocthietbimodel->get_filtered_data($_POST['donvi'],
											       							$_POST['tenloai'],
											       							$_POST['tennhom'],
											       							$_POST['nguongoc'],
											       							$_POST['gia'],
											       							$_POST['tinhtrang'],
											       							$_POST['maphong'],
											       							$_POST['namsd'],
											       							$_POST['chatluong'],
											       							$_POST['mode_show']
											       						),  
            "data"                =>   $data  
       );  
       echo json_encode($output);
    } 

    public function layNamSD() {
    	$iddonvi = $this->input->post('tendonvi');
        $arrNam = $this->danhsachmaymocthietbimodel->layNamSD($iddonvi);
        echo json_encode($arrNam);
    }

    public function laythongke1phong()
	{
		$maphongkho = $this->input->post('maphongkho');

        // lấy du lieu theo đơn vị
        $arrThietBi = $this->danhsachmaymocthietbimodel->laythongke1phong($maphongkho);

        $data = array(
            'mangthietbi' => $arrThietBi,
        );
        echo json_encode($data);
	}

	public function layDanhSachDiChuyen()
	{
		$madonvi = $this->input->post('donvicu');
		$maphongkho = $this->input->post('phongkhocu');

        // lấy du lieu theo đơn vị
        $arrThietBi = $this->danhsachmaymocthietbimodel->layDanhSachDiChuyen($maphongkho,$madonvi);

        
        $data = array(
            'mangthietbi' => $arrThietBi,
        );
        echo json_encode($data);
	}

	public function themthietbi(){
		$tentb=$this->input->post('tentb');
		$mota=$this->input->post('mota');
		$namsd=$this->input->post('namsd');
		$nguongoc=$this->input->post('nguongoc');
		$donvitinh=$this->input->post('donvitinh');
		$soluong=$this->input->post('soluong');
		$nguyengia=$this->input->post('nguyengia');
		$chatluong=$this->input->post('chatluong');
		$ghichu=$this->input->post('ghichu');
		$model=$this->input->post('model');
		$tinhtrang=$this->input->post('tinhtrang');
		$maphongkho=$this->input->post('phongkho');
		$maloai=$this->input->post('maloai');

		if(empty($tentb) || empty($model) || empty($chatluong) || empty($maphongkho))
    	{
    		echo "Không thể thêm dữ liệu này";
    	}else{
			// thêm thiết bị với số lượng
			for($i = 0 ; $i < $soluong ; $i++)
			{
				// kiem tra ma so
				$sl = $this->danhsachmaymocthietbimodel->get_total();
				$sl = $sl + 1;
				if($sl < 9) $sl = "0".$sl;
				
				$maso = "TB".$sl;

				if($tinhtrang == ""){$tinhtrang="Đang sử dụng";}
				$data = array(
					'tentb'  => $tentb,
					'mota'   => $mota,
					'maso' => $maso,
					'namsd'  => $namsd,
					'nguongoc'   => $nguongoc,
					'donvitinh'  => $donvitinh,
					'soluong'  => $soluong,
					'gia'  => $nguyengia,
					'ghichu' => $ghichu,
					'model' => $model,
					'maphongkho' => $maphongkho,
					'maloai' => $maloai,
					'tinhtrang' => $tinhtrang,
					'chatluong' => $chatluong
				);
				
				$last_id = $this->danhsachmaymocthietbimodel->themdanhsachmaymocthietbi($data);

				// tạo một lịch sử thêm thiết bị
				if($last_id > 0){
					$noidung = "Thêm mới ".$tentb;
					$lichsu = array(
						'noidung' => $noidung,
						'ngay' => date("Y/m/d"),
						'mammtb' => $last_id
					);
					$last_id_lichsu = $this->lichsumaymocthietbimodel->themlichsu($lichsu);
				}
			}
    	}
		$this->index();
	}

	public function loadDataExcel_cu()
	{
		$madonvi=$this->input->post('madonvi');
		$where = array('id'=>$madonvi);
		$rsdonvi = $this->donvimodel->get_info_rule($where,'*');

		$arr = array();
		$arrError = array();

		if(isset($_FILES["file"]["name"]))
	  	{
		   $path = $_FILES["file"]["tmp_name"];

		   $object = PHPExcel_IOFactory::load($path);
		   
		   		$worksheet = $object->getSheet(0);
			    $highestRow = $worksheet->getHighestRow();
			    $highestColumn = $worksheet->getHighestColumn();

			    for($row=18; $row<=$highestRow; $row++)
			    {
			    	// kiểm tra dữ liệu có rỗng trước khi thêm
			    	$tents = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
			    	$model = $worksheet->getCellByColumnAndRow(14, $row)->getFormattedValue();
			    	$vitri =  $worksheet->getCellByColumnAndRow(15, $row)->getValue();

			    	$namsd = $worksheet->getCellByColumnAndRow(4, $row)->getFormattedValue();
					$nguongoc = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$dvtinh = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

					// chon ma phong kho
					if(!empty($vitri)){
						$maphongkho = null;
						$tenphongkho = null;

						$where = array('maphong'=>$vitri, 'tenphong' => $vitri." ".$rsdonvi->tenviettat);
	            		$rs = $this->phong_khomodel->get_info_rule($where,'id, maphong');
	            		if(!empty($rs)){
	            			$maphongkho = $rs->id;
	            			$tenphongkho = $rs->maphong;
	            		}
					}

			    	if(empty($tents) || empty($model) || empty($vitri) || empty($maphongkho))
			    	{
			    		if($maphongkho == "") $maphongkho = "Không có do VỊ TRÍ ĐẶT chưa được tạo";
			    		array_push($arrError, "Dòng $row: Tên TB: $tents, Model: $model, 
			    			Vị trí: $vitri, Mã phòng: $maphongkho");
						$arrError = array_unique($arrError);
			    	}else{
			    		$soluong = (int)$worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue();
						// thêm thiết bị với số lượng
						for($i = 0 ; $i < $soluong ; $i++)
						{
							$mota = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

							$soluongsosach = $worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue();
							$gia = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
							$tontai = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
							$chatluong = $worksheet->getCellByColumnAndRow(12, $row)->getFormattedValue();
							$ghichu = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
							$tinhtrang = $worksheet->getCellByColumnAndRow(16, $row)->getFormattedValue();

							$loaitb = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
							$rsmaloai = $this->loaimaymocthietbimodel->layloaimaymoc($loaitb);
							$maloai = $rsmaloai->id;
							$tenloai = $rsmaloai->tenloai;

							if($tinhtrang == ""){$tinhtrang="Đang sử dụng";}
							$data = array(
								'tentb'  => $this->removeBreakLine($tents),
								'mota'   => $this->removeBreakLine($mota),
								'namsd'  => $this->removeBreakLine($namsd),
								'nguongoc'   => $nguongoc,
								'donvitinh'  => $dvtinh,
								'soluong'  => $this->removeBreakLine($soluongsosach),
								'gia'  => $this->removeBreakLine($gia),
								'ghichu' => $this->removeBreakLine($ghichu),
								'model' => $this->removeBreakLine($model),
								'maphongkho' => $maphongkho,
								'tenphongkho' => $tenphongkho,
								'maloai' => $maloai,
								'tenloai' => $tenloai,
								'tinhtrang' => $this->removeBreakLine($tinhtrang),
								'chatluong' => $this->removeBreakLine($chatluong),
								'tontai' => $tontai,
							);
							array_push($arr, $data);
						}
			    	}
			    
	  			}
	  		$response = array(
	  			'madonvi' => $madonvi,
	  			'data' => $arr,
	  			'error' => $arrError
	  		);
	  		echo json_encode($response);
		}
		else
		{
			echo "Error";
		}
	}

	public function loadDataExcel_moi()
	{
		$madonvi=$this->input->post('madonvi');
		$where = array('id'=>$madonvi);
		$rsdonvi = $this->donvimodel->get_info_rule($where,'*');

		$arr = array();
		$arrError = array();

		if(isset($_FILES["file"]["name"]))
	  	{
		   $path = $_FILES["file"]["tmp_name"];

		   $object = PHPExcel_IOFactory::load($path);
		   
		   		$worksheet = $object->getSheet(0);
			    $highestRow = $worksheet->getHighestRow();
			    $highestColumn = $worksheet->getHighestColumn();

			    for($row=17; $row<=$highestRow; $row++)
			    {
			    	// kiểm tra dữ liệu có rỗng trước khi thêm
			    	$tents = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
			    	$model = $worksheet->getCellByColumnAndRow(16, $row)->getFormattedValue();
			    	$vitri =  $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			    	$namsd = $worksheet->getCellByColumnAndRow(4, $row)->getFormattedValue();
	
					// chon ma phong kho
					if(!empty($vitri)){
						$maphongkho = null;
						$tenphongkho = null;

						$where = array('maphong'=>$vitri, 'tenphong' => $vitri." ".$rsdonvi->tenviettat);
	            		$rs = $this->phong_khomodel->get_info_rule($where,'id, maphong');
	            		if(!empty($rs)){
	            			$maphongkho = $rs->id;
	            			$tenphongkho = $rs->maphong;
	            		}
					}

			    	if(empty($tents) || empty($model) || empty($vitri) || empty($maphongkho))
			    	{
			    		if($maphongkho == "") $maphongkho = "Không có do NƠI SỬ DỤNG chưa được tạo";

			    		array_push($arrError, "Dòng $row: Tên TB: $tents, Model: $model, 
			    			Vị trí: $vitri, Mã phòng: $maphongkho");
						$arrError = array_unique($arrError);
			    	}else{
			    		$soluong = (int)$worksheet->getCellByColumnAndRow(8, $row)->getFormattedValue();
						// thêm thiết bị với số lượng
						for($i = 0 ; $i < $soluong ; $i++)
						{
							$mota = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

							$soluongsosach = $worksheet->getCellByColumnAndRow(8, $row)->getFormattedValue();
							$gia = $worksheet->getCellByColumnAndRow(9, $row)->getFormattedValue();
							
							$chatluong = $worksheet->getCellByColumnAndRow(14, $row)->getFormattedValue();
							$ghichu = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
							$tinhtrang = $worksheet->getCellByColumnAndRow(17, $row)->getFormattedValue();

							$loaitb = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
							$rsmaloai = $this->loaimaymocthietbimodel->layloaimaymoc($loaitb);

							if(empty($rsmaloai)){
								$maloai = "";
								$tenloai = "";
							}else{
								$maloai = $rsmaloai->id;
								$tenloai = $rsmaloai->tenloai;
							}

							if($tinhtrang == ""){$tinhtrang="Đang sử dụng";}
							$data = array(
								'tentb'  => $this->removeBreakLine($tents),
								'mota'   => $this->removeBreakLine($mota),
								'namsd'  => $this->removeBreakLine($namsd),
								'soluong'  => $this->removeBreakLine($soluongsosach),
								'gia'  => $this->removeBreakLine($gia),
								'ghichu' => $this->removeBreakLine($ghichu),
								'model' => $this->removeBreakLine($model),
								'maphongkho' => $maphongkho,
								'tenphongkho' => $tenphongkho,
								'maloai' => $maloai,
								'tenloai' => $tenloai,
								'tinhtrang' => $this->removeBreakLine($tinhtrang),
								'chatluong' => $this->removeBreakLine($chatluong)
							);
							array_push($arr, $data);
						}
			    	}
			    
	  			}
	  		$response = array(
	  			'madonvi' => $madonvi,
	  			'data' => $arr,
	  			'error' => $arrError
	  		);
	  		echo json_encode($response);
		}
		else
		{
			echo "Error";
		}
	}

	public function importExcel()
	{
		$madonvi=$this->input->post('donvi');
		$tendonvi=$this->input->post('tendonvi');

		$soluongdathem = 0;
		$arrId = array();
		$sltt = 0;

		if(isset($_FILES["file"]["name"]))
	  	{
		   $path = $_FILES["file"]["tmp_name"];
		   $object = PHPExcel_IOFactory::load($path);
		   
		   		$worksheet = $object->getSheet(0);
			    $highestRow = $worksheet->getHighestRow();
			    $highestColumn = $worksheet->getHighestColumn();

			    for($row=16; $row<=$highestRow; $row++)
			    {
			    	// kiểm tra dữ liệu có rỗng trước khi thêm
			    	$tents = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
			    	$model = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
			    	$vitri =  $worksheet->getCellByColumnAndRow(15, $row)->getValue();

			    	$namsd = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$nguongoc = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$dvtinh = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

					// chon ma phong kho
					if(!empty($vitri)){
						$maphongkho = null;

						$where = array('id'=>$madonvi);
						$rsdonvi = $this->donvimodel->get_info_rule($where,'*');

						$where = array('maphong'=>$vitri, 'tenphong' => $vitri." ".$rsdonvi->tenviettat);
	            		$rs = $this->phong_khomodel->get_info_rule($where,'id');
	            		if(!empty($rs)){$maphongkho = $rs->id;}
					}

			    	if(empty($tents) || empty($model) || empty($vitri) || empty($maphongkho))
			    	{
			    		array_push($arrId, $row);
						$arrId = array_unique($arrId);
			    	}else{
			    		$soluong = (int)$worksheet->getCellByColumnAndRow(7, $row)->getFormattedValue();
			    		// array_push($arrId, $row ." - sl: ".$soluong);
						// thêm thiết bị với số lượng
						for($i = 0 ; $i < $soluong ; $i++)
						{
							$mota = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

							// kiem tra ma so
							$sl = $this->danhsachmaymocthietbimodel->get_total();
							$sl = $sl + 1;
							if($sl < 9) $sl = "0".$sl;
							
							$maso = "TB".$sl;

							$soluongsosach = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
							$gia = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
							$tontai = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
							$chatluong = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
							$ghichu = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
							$tinhtrang = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

							$loaitb = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
							$maloai = $this->loaimaymocthietbimodel->layloaimaymoc($loaitb);
							$maloai = $maloai->id;

							if($tinhtrang == ""){$tinhtrang="Đang sử dụng";}
							$data = array(
							'tentb'  => $tents,
							'mota'   => $mota,
							'maso' => $maso,
							'namsd'  => $namsd,
							'nguongoc'   => $nguongoc,
							'donvitinh'  => $dvtinh,
							'soluong'  => $soluongsosach,
							'gia'  => $gia,
							'ghichu' => $ghichu,
							'model' => $model,
							'maphongkho' => $maphongkho,
							'maloai' => $maloai,
							// 'manhom' => $manhom,
							'tinhtrang' => $tinhtrang,
							'chatluong' => $chatluong,
							'tontai' => $tontai,

							);
							
							//kiểm tra xem cột mã số có không - nếu có thì cập nhật
							$maso_update = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							if($maso_update != ""){
								$where = array('maso'=>$maso_update);

								$data = array(
									'tentb'  => $tents,
									'mota'   => $mota,
									'namsd'  => $namsd,
									'nguongoc'   => $nguongoc,
									'donvitinh'  => $dvtinh,
									'soluong'  => $soluongsosach,
									'gia'  => $gia,
									'ghichu' => $ghichu,
									'model' => $model,
									'maphongkho' => $maphongkho,
									'maloai' => $maloai,
									// 'manhom' => $manhom,
									'tinhtrang' => $tinhtrang,
									'chatluong' => $chatluong,
									'tontai' => $tontai
								);
	                			$this->danhsachmaymocthietbimodel->update_rule($where, $data);
							}else{
								$last_id = $this->danhsachmaymocthietbimodel->themdanhsachmaymocthietbi($data);

								// tạo một lịch sử thêm thiết bị
								if($vitri == "Kho Trường"){
									$noidung = "Từ ".$tendonvi." chuyển sang Kho Trường";
								}else{
									$noidung = "Thêm mới ".$tents;
								}
								$lichsu = array(
									'noidung' => $noidung,
									'ngay' => date("Y/m/d"),
									'mammtb' => $last_id
								);
								$last_id_lichsu = $this->lichsumaymocthietbimodel->themlichsu($lichsu);

								$soluongdathem++ ;
							}
							
						}
			    	}
			    
	  			}
	  		// echo "Thêm thành công";
	  		$response = array(
	  			'soluongthem' => $soluongdathem,
	  			'dongloi' => $arrId
	  		);
	  		echo json_encode($response);
	  		// redirect(maymocthietbi_url('danhsachmaymocthietbicontroller/index'),'refresh');
		}
		else
		{
			echo "Error";
		}
	}

	public function xoamaymocthietbi()
	{
		$mangthietbi = $this->input->post('mangthietbi');

		foreach ($mangthietbi as $idthietbi){
			//tìm ra thiết bị có cùng thông tin trong nhóm
			$tb_goc = $this->danhsachmaymocthietbimodel->get_info($idthietbi);
			$input['where'] = array(
				'tentb' => $tb_goc->tentb,
				'ghichu' => $tb_goc->ghichu,
				'tinhtrang' => $tb_goc->tinhtrang,
				'maphongkho' => $tb_goc->maphongkho,
				'maloai' => $tb_goc->maloai,
				'namsd' => $tb_goc->namsd
			);
			$mang_tb_nhom = $this->danhsachmaymocthietbimodel->get_list($input);

			// thay đổi toàn bộ tình trạng các thiết bị trong nhóm
			foreach ($mang_tb_nhom as $tb){
				$this->danhsachmaymocthietbimodel->delete($tb->id);
			}
		}

		echo maymocthietbi_url('danhsachmaymocthietbicontroller/index');
	}

	public function phannhom()
	{
		$mangthietbi = $this->input->post('mangthietbi');
		$idnhom = $this->input->post('idnhom');
		foreach ($mangthietbi as $idthietbi){
			$data = array(
				'manhom' => $idnhom,
			);
			$check = $this->danhsachmaymocthietbimodel->update($idthietbi,$data);
		}
		echo maymocthietbi_url('danhsachmaymocthietbicontroller/index');
	}

	public function phanloai()
	{
		$mangthietbi = $this->input->post('mangthietbi');
		$idloai = $this->input->post('idloai');
		$model_show = $this->input->post('mode_show');

		if($model_show == "true"){
			foreach ($mangthietbi as $idthietbi){
				//tìm ra thiết bị có cùng thông tin trong nhóm
				$tb_goc = $this->danhsachmaymocthietbimodel->get_info($idthietbi);
				$input['where'] = array(
					'tentb' => $tb_goc->tentb,
					'ghichu' => $tb_goc->ghichu,
					'tinhtrang' => $tb_goc->tinhtrang,
					'maphongkho' => $tb_goc->maphongkho,
					'maloai' => $tb_goc->maloai,
					'namsd' => $tb_goc->namsd
				);
				$mang_tb_nhom = $this->danhsachmaymocthietbimodel->get_list($input);

				// thay đổi toàn bộ tình trạng các thiết bị trong nhóm
				foreach ($mang_tb_nhom as $tb){
					$data = array(
						'maloai' => $idloai
					);
					$check = $this->danhsachmaymocthietbimodel->update($tb->id,$data);
				}
			}
		}else{
			foreach ($mangthietbi as $idthietbi){
				$data = array(
					'maloai' => $idloai
				);
				$check = $this->danhsachmaymocthietbimodel->update($idthietbi,$data);
			}
		}

		
		echo maymocthietbi_url('danhsachmaymocthietbicontroller/index');
	}

	public function thaydoitinhtrang(){
		$mangthietbi = $this->input->post('mangthietbi');
		$idTinhTrang = $this->input->post('idTinhTrang');
		$model_show = $this->input->post('mode_show');

		if($model_show == "true"){
			foreach ($mangthietbi as $idthietbi){
				//tìm ra thiết bị có cùng thông tin trong nhóm
				$tb_goc = $this->danhsachmaymocthietbimodel->get_info($idthietbi);
				$input['where'] = array(
					'tentb' => $tb_goc->tentb,
					'ghichu' => $tb_goc->ghichu,
					'tinhtrang' => $tb_goc->tinhtrang,
					'maphongkho' => $tb_goc->maphongkho,
					'maloai' => $tb_goc->maloai,
					'namsd' => $tb_goc->namsd
				);
				$mang_tb_nhom = $this->danhsachmaymocthietbimodel->get_list($input);

				// thay đổi toàn bộ tình trạng các thiết bị trong nhóm
				foreach ($mang_tb_nhom as $tb){
					$data = array(
						'tinhtrang' => $idTinhTrang,
					);
					$check = $this->danhsachmaymocthietbimodel->update($tb->id,$data);
				}
				
			}
		}else{
			foreach ($mangthietbi as $idthietbi){
				$data = array(
					'tinhtrang' => $idTinhTrang,
				);
				$check = $this->danhsachmaymocthietbimodel->update($idthietbi,$data);
			}
		}

		
		echo maymocthietbi_url('danhsachmaymocthietbicontroller/index');
	}

	public function capnhatsomay()
	{
		$idUpdate = $this->input->post('idUpdate');
		$idUpdate = str_replace("somay","",$idUpdate);
		$somayUpdate = $this->input->post('somayUpdate');
		$data = array(
			'somay' => $somayUpdate,
		);
		$check = $this->danhsachmaymocthietbimodel->update($idUpdate,$data);
		redirect(maymocthietbi_url('danhsachmaymocthietbicontroller/index'),'refresh');
	}

	public function taosodophongmay()
	{
		$idkho = $this->input->post('idkho');

		// lấy tất cả thiết bị máy tính theo kho
		$input['where'] = array(
			'maphongkho' => $idkho,
			'maloai' => 11
		);
		$mang_tb= $this->danhsachmaymocthietbimodel->get_list($input);

		// tạo số máy tự động từ 1
		$somay = 1;
		foreach ($mang_tb as $tb){
			$data = array(
				'somay' => $somay,
			);
			$check = $this->danhsachmaymocthietbimodel->update($tb->id,$data);
			$somay ++;
		}
		redirect(maymocthietbi_url('danhsachmaymocthietbicontroller/index'),'refresh');
	}
	
	public function loadmaymocthietbi()
	{
		$data = array();
		$id = $this->uri->segment(4);

		$data['maymoc'] = $this->danhsachmaymocthietbimodel->get_info($id);

		$dv=$this->donvimodel->getAlldata();
		$dv=array("mangdv"=> $dv);

		$phong=$this->phong_khomodel->getAlldata();
		$phong=array("mangphong"=> $phong);

		$loaimay=$this->loaimaymocthietbimodel->getAlldata();
		$loaimay=array("mangloaimay"=> $loaimay);

		$nhommay=$this->nhommaymocthietbimodel->getAlldata();
		$nhommay=array("mangnhommay"=> $nhommay);

		// $tinhtrang=$this->tinhtrangmodel->getAlldata();
		// $tinhtrang=array("mangtinhtrang"=> $tinhtrang);
		
		$data['dv'] = $dv;
		$data['phong'] = $phong;
		$data['loaimay'] = $loaimay;
		$data['nhommay'] = $nhommay;
		// $data['tinhtrang'] = $tinhtrang;

		$this->load->view('maymocthietbi/suamaymocthietbi',$data);
	}

	public function luucapnhatthietbi()
	{
		if($this->input->post())
		{
			$id=$this->input->post('idmaymoc');
			$maso=$this->input->post('maso');
			$tentb=$this->input->post('tentb');
			$mota=$this->input->post('mota');
			$namsd=$this->input->post('namsd');
			$nguongoc=$this->input->post('nguongoc');
			$dvtinh=$this->input->post('donvitinh');
			$soluong=$this->input->post('soluong');
			$gia=$this->input->post('gia');
			$ghichu=$this->input->post('ghichu');
			$model=$this->input->post('model');
			$donvi=$this->input->post('donvi');
			$maphongkho=$this->input->post('maphongkho');
			$maloai=$this->input->post('loaitb');
			$manhom=$this->input->post('nhomtb');
			$arrtinhtrang=$this->input->post('tinhtrang');
			$chatluong=$this->input->post('chatluong');

			// $arrMa = explode("*",$maso);
			// $maso = $model."*".$arrMa[1];

			$tinhtrang = "";
			foreach ((array) $arrtinhtrang as $item){
				$tinhtrang =$tinhtrang.", ".$item;
			}

			if($tinhtrang == ""){
				$data = array(
					'tentb'  => $tentb,
					'mota'   => $mota,
					'namsd'  => $namsd,
					'nguongoc'   => $nguongoc,
					'donvitinh'  => $dvtinh,
					'soluong'  => $soluong,
					'gia'  => $gia,
					'chatluong' => $chatluong,
					'ghichu' => $ghichu,
				);
			}else{
				$tinhtrang = substr($tinhtrang, 2);  
				$data = array(
					'tentb'  => $tentb,
					'mota'   => $mota,
					'namsd'  => $namsd,
					'nguongoc'   => $nguongoc,
					'donvitinh'  => $dvtinh,
					'soluong'  => $soluong,
					'gia'  => $gia,
					'chatluong' => $chatluong,
					'ghichu' => $ghichu,
					'tinhtrang' => $tinhtrang,
				);
			}
		
			$check = $this->danhsachmaymocthietbimodel->update($id,$data);
			if($check == TRUE)
			{
				redirect(maymocthietbi_url('danhsachmaymocthietbicontroller/index'),'refresh');
			}
		}
	}

	public function dichuyenthietbi()
	{
		if($this->input->post())
		{
			$mapkmoi = $this->input->post('mapkmoi');
			$tenpkmoi = $this->input->post('tenpkmoi');
			$donvimoi = $this->input->post('donvimoi');
			$mangIdMayMoc = $this->input->post('check_list');
			$model_show = $this->input->post('mode_show');

			if($model_show == "true"){
				foreach ($mangIdMayMoc as $idthietbi){
					//tìm ra thiết bị có cùng thông tin trong nhóm
					$tb_goc = $this->danhsachmaymocthietbimodel->get_info($idthietbi);
					$input['where'] = array(
						'tentb' => $tb_goc->tentb,
						'ghichu' => $tb_goc->ghichu,
						'tinhtrang' => $tb_goc->tinhtrang,
						'maphongkho' => $tb_goc->maphongkho,
						'maloai' => $tb_goc->maloai,
						'namsd' => $tb_goc->namsd
					);
					$mang_tb_nhom = $this->danhsachmaymocthietbimodel->get_list($input);

					// thay đổi toàn bộ các thiết bị trong nhóm
					foreach ($mang_tb_nhom as $tb){
						// tạo một lịch sử thêm thiết bị
						$donvi = $this->danhsachmaymocthietbimodel->laydonvicu($tb->id);
						$noidung = "Chuyển từ ".$donvi->maphong." của ". $donvi->tendonvi . " sang ". $tenpkmoi . " của ". $donvimoi;
						$lichsu = array(
							'noidung' => $noidung,
							'ngay' => date("Y/m/d"),
							'mammtb' => $tb->id
						);
						$last_id_lichsu = $this->lichsumaymocthietbimodel->themlichsu($lichsu);


						$data = array(
							'maphongkho' => $mapkmoi,
						);
						$check = $this->danhsachmaymocthietbimodel->update($tb->id,$data);
					}
				}
			}else{
				foreach ($mangIdMayMoc as $idthietbi){
					// tạo một lịch sử thêm thiết bị
					$donvi = $this->danhsachmaymocthietbimodel->laydonvicu($idthietbi);
					$noidung = "Chuyển từ ".$donvi->maphong." của ". $donvi->tendonvi . " sang ". $tenpkmoi . " của ". $donvimoi;
					$lichsu = array(
						'noidung' => $noidung,
						'ngay' => date("Y/m/d"),
						'mammtb' => $idthietbi
					);
					$last_id_lichsu = $this->lichsumaymocthietbimodel->themlichsu($lichsu);


					$data = array(
						'maphongkho' => $mapkmoi,
					);
					$check = $this->danhsachmaymocthietbimodel->update($idthietbi,$data);
				}
			}

			echo maymocthietbi_url('danhsachmaymocthietbicontroller/index');
		}
	}

	public function laylichsu()
	{
		if($this->input->post())
		{
			// lấy mảng lịch sử
			$mangthietbi = $this->input->post('mangthietbi');
				foreach ($mangthietbi as $idthietbi){
					$query = 'SELECT tb.tentb, tb.maso, noidung, Date(ngay) as ngaycapnhat 
					FROM lichsumaymocthietbi ls, maymocthietbi tb
					WHERE ls.mammtb = tb.id AND mammtb='.$idthietbi.
					' ORDER BY ngaycapnhat DESC';
		        $manglichsu = $this->lichsumaymocthietbimodel->setQuery($query);

				$data = array('manglichsu' => $manglichsu);
				echo json_encode($data);
			}
		}
	}

	public function layphongkho(){
		$iddonvi = $this->input->post('tendonvi');
        $arrPhongKho = $this->danhsachmaymocthietbimodel->layphongkho($iddonvi);
        echo json_encode($arrPhongKho);
	}

	public function layphongkhobangten(){
		$tendonvi = $this->input->post('tendonvi');
        $arrPhongKho = $this->danhsachmaymocthietbimodel->layphongkhobangten($tendonvi);
        echo json_encode($arrPhongKho);
	}

	public function xuatfile()
	{
		$madonvi = $this->input->post('donviExcel');
		$hinhthuc = $this->input->post('hinhthuc');

		// lấy danh sách thiết bị
		if($hinhthuc == 'tungtb'){
			$arrThietBi = $this->danhsachmaymocthietbimodel->layDSTheoDonVi($madonvi);
		}else{
			$arrThietBi = $this->danhsachmaymocthietbimodel->laydulieuTongHop($madonvi);
		}
		

		// // tên file
		$inputFileName = FCPATH."public/kiemke.xlsx";
        try {
	        $excel2 = PHPExcel_IOFactory::createReader('Excel2007');
			$excel2 = $excel2->load($inputFileName); // Empty Sheet
			$excel2->setActiveSheetIndex(0);
			$excel2->getDefaultStyle()->getFont()->setName('Times New Roman');

			//set tên đơn vi
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(0,3,"ĐƠN VỊ QLSD: Khoa ".mb_strtoupper($arrThietBi[0]['tendonvi']));

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(0,5,"BIÊN BẢN  KIỂM KÊ TÀI SẢN NĂM - ".date("Y"));

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(0,14,"Đã kiểm kê các tài sản thiết bị - dụng cụ trang bị tại Khoa ".$arrThietBi[0]['tenviettat']. ' như sau:');
			
			// them du liệu
			$row = 18;
			$column = 1;
			$index = 1;
			foreach ($arrThietBi as $dulieu) {
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $index);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $dulieu['tentb']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $dulieu['mota']);

				if($hinhthuc == 'tungtb'){
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $dulieu['maso']);
				}else{
					$arrMaso = explode("*", $dulieu['maso']);
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $arrMaso[0]);
				}

				$excel2->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $dulieu['namsd']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $dulieu['nguongoc']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $dulieu['donvitinh']);
				if($hinhthuc != 'tungtb'){
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $dulieu['soluongtt']);
				}
				
				// $excel2->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $dulieu['soluongtt']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $dulieu['gia']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $dulieu['chatluong']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $dulieu['ghichu']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $dulieu['model']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $dulieu['maphong']);
				$excel2->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $dulieu['tinhtrang']);
				$excel2->getDefaultStyle()->getFont()->setSize(13);
				
				$row++;
				$index++;
			}

			// wrap text
			$excel2->getActiveSheet()->getStyle('A18:Q'.$row)->getAlignment()->setWrapText(true); 

			// Thêm border vào excel
			$BStyle = array(
			  'borders' => array(
			    'allborders' => array(
			      'style' => PHPExcel_Style_Border::BORDER_THIN
			    )
			  )
			);
			$lastRow= $row-1;
			$excel2->getActiveSheet()->getStyle('A18:Q'.$lastRow)->applyFromArray($BStyle);
			//end thêm border

			// footer text
			$t=date('d-m-Y');
			$day = date("d",strtotime($t));
			$excel2->getActiveSheet()->mergeCells('I'.$row.':N'.$row);
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(8,$row,"Vĩnh Long, ngày ".$day." tháng ".date('m')." năm ".date("Y"));
			$row1 = $row+1;
			$row2 = $row+2;
			$excel2->getActiveSheet()->mergeCells('D'.$row1.':G'.$row1);
			$excel2->getActiveSheet()->mergeCells('I'.$row1.':K'.$row1);
			$excel2->getActiveSheet()->mergeCells('L'.$row1.':N'.$row1);
			$excel2->getActiveSheet()->mergeCells('D'.$row2.':G'.$row2);
			$excel2->getActiveSheet()->mergeCells('I'.$row2.':K'.$row2);
			$excel2->getActiveSheet()->mergeCells('L'.$row2.':N'.$row2);
			$excel2->getActiveSheet()->getStyle('B'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('C'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('D'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('I'.$row1)->getFont()->setBold(true);
			$excel2->getActiveSheet()->getStyle('L'.$row1)->getFont()->setBold(true);

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(1,$row1,"Hiệu trưởng");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(2,$row1,"TP. Kế hoạch - Tài chính");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(3,$row1,"TP. Quản trị - Thiết bị");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(8,$row1,"Trưởng đơn vị");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(11,$row1,"Các chuyên viên kiểm kê");

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(1,$row2,"(Ký, Đóng dấu)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(2,$row2,"(Ký, Họ và tên)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(3,$row2,"(Ký, Họ và tên)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(8,$row2,"(Ký, Họ và tên)");
			$excel2->getActiveSheet()->setCellValueByColumnAndRow(11,$row2,"(Ký, Họ và tên)");

			//end footer

			// center text
			$lastRow = $lastRow + 3;
			$excel2->getActiveSheet()->getStyle('A18:Q'.$lastRow)->getAlignment()
    		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$excel2->getActiveSheet()->getStyle('A18:Q'.$lastRow)->getAlignment()
    		->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		//end center text

			$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');

			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="kiemkemaymoc'.$arrThietBi[0]['tenviettat'].'.xlsx"');
			$objWriter->save('php://output');
        } 
        catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
	}

	public function inqr(){

		$madonvi = $this->input->post('donviQR');
		$arrThietBi = $this->danhsachmaymocthietbimodel->layDSTheoDonVi($madonvi);

		//tạo folder cho khoa để lưu qr code
		$where = array('id'=>$madonvi);
		$donvi = $this->donvimodel->get_info_rule($where,'*');
		$tenviettat = $donvi->tenviettat;
		$tendonvi = $donvi->tendonvi;

		$dir = FCPATH.'qrcode/'.$tenviettat;
		if( is_dir($dir) === false )
		{
		    mkdir($dir);
		}

		$dir = FCPATH.'qrcode/'.$tenviettat.'/maymoc';
		if( is_dir($dir) === false )
		{
		    mkdir($dir);
		}

		foreach ($arrThietBi as $thietbi) {
			list($maso,$index) = explode("*", $thietbi['maso']);

			$ten = $maso."_".$index;
			$this->taoqr($ten, $dir, $thietbi, $tendonvi);
		}
		
		$this->nenfolder($tenviettat,$dir);

		echo "true";
	}

	function taoqr($ten, $duongdan, $thietbi, $tendonvi){
		// Create a basic QR code
		$qrCode = new QrCode($thietbi['maso']);
		$qrCode->setSize(300);
		$qrCode->setWriterByName('png');
		$qrCode->setMargin(10);
		$qrCode->setEncoding('UTF-8');
		$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
		$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
		$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
		$qrCode->setLabel($thietbi['maso'], 16,FCPATH.'vendor/endroid/qrcode/assets/noto_sans.otf', LabelAlignment::CENTER());
		$qrCode->setLogoPath(FCPATH.'images/logo.png');
		$qrCode->setLogoWidth(150);
		$qrCode->setValidateResult(false);
		// ini_set('max_execution_time', 0); 
		// ini_set('memory_limit','2048M');
		// header('Content-Type: '.$qrCode->getContentType());
		// echo $qrCode->writeString();

		// Save it to a file
		$qrCode->writeFile($duongdan.'/'.$ten.'.png');


		// tạo thẻ
		$imgPath = $duongdan.'/'.$ten.'.png';
	    $image = imagecreatefrompng($imgPath);

			
		//tạo hình chữ nhật
		$hcn = imagecreate(750, 349);
		$background_color = imagecolorallocate($hcn, 255, 255, 255);
		
		imagecopymerge($hcn, $image, 0, 0, 0, 0, 320, 349, 100);
		
		$text_box = imagecreate(430, 349);
		$background_color = imagecolorallocate($text_box, 255, 255, 255);
	
		//border
		imagerectangle( $text_box, 1, 1, 429, 348, imagecolorallocate($text_box, 0, 0, 0) );
		
		$font_basic = FCPATH.'vendor/endroid/qrcode/assets/time_new.ttf';
		$font_italic = FCPATH.'vendor/endroid/qrcode/assets/time_new_italic.ttf';
		$font_bold = FCPATH.'vendor/endroid/qrcode/assets/time_new_bold.ttf';

		// tiêu đề
		$color_text = imagecolorallocate($text_box, 0, 0, 0);
		imagettftext($text_box, 30,0, 20,70, $color_text, $font_bold, 'VLUTE');
		$color_text = imagecolorallocate($text_box, 255, 0, 0);
		imagettftext($text_box, 18,0, 20,100, $color_text, $font_basic, 'Thiết kế bởi khoa CNTT');

		$color_text = imagecolorallocate($text_box, 0, 0, 0);
		$font_basic = FCPATH.'vendor/endroid/qrcode/assets/time_new.ttf';
		$x = 20;
		$y = 150;

		//kiểm tra độ dài tên
		$tentb = "";
		if(strlen($thietbi['tentb']) > 30){
			$tentb = substr($thietbi['tentb'], 0, 30)."...";
		}else{
			$tentb = $thietbi['tentb'];
		}

		imagettftext($text_box, 14,0, 20,$y+30, $color_text, $font_basic, 'Tên TS: '.$tentb);
		imagettftext($text_box, 14,0, 20,$y+60, $color_text, $font_basic, 'ĐVSD: '.$tendonvi);
		imagettftext($text_box, 14,0, 20,$y+90, $color_text, $font_basic, 'SD năm: '.$thietbi['namsd']);
		imagettftext($text_box, 14,0, 200,$y+90, $color_text, $font_basic, 'Chất lượng: '.$thietbi['chatluong'].'%');
		$ghichu = ($thietbi['ghichu'] == "") ? "": $thietbi['ghichu'];
		imagettftext($text_box, 14,0, 20,$y+120, $color_text, $font_basic, 'Ghi chú: '.$ghichu);
		
		imagecopymerge($hcn, $text_box, 320, 0, 0, 0, 430, 349, 100);
		
			
	    imagepng($hcn, $imgPath);
		imagedestroy($hcn);
		imagedestroy($image);
		imagedestroy($text_box);
	}

	

	function nenfolder($tendonvi,$dir){
		$this->load->library('zip');
        $this->zip->read_dir(FCPATH.'qrcode/'.$tendonvi.'/maymoc');
        $this->zip->archive(FCPATH.'qrcode/'.$tendonvi.'/maymoc.zip');
        $this->zip->download("maymoc.zip");
	}

	function removeBreakLine($text){
		return preg_replace( array('/<br>/', '/\n/', '/"/'), "" , $text ); 
	}
}

require 'vendor/autoload.php';

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */