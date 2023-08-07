<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ketsodogocontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('thietbidogo/thongkedogomodel');
		$this->load->model('maymocthietbi/nhommaymocthietbimodel');
		$this->load->model('donvi/donvimodel');
		$this->load->model('thietbidogo/loaithietbidogomodel');
		$this->load->model('tinhtrang/tinhtrangmodel');
		$this->load->library('excel');
	}

	public function index()
	{
		$dv=$this->donvimodel->getAlldata();
		$dv=array("mangdv"=> $dv);

		$loaimay=$this->loaithietbidogomodel->getAlldata();
		$loaimay=array("mangloaimay"=> $loaimay);

		$tinhtrang=$this->tinhtrangmodel->getAlldata();
		$tinhtrang=array("mangtinhtrang"=> $tinhtrang);

		$namthongke=$this->thongkedogomodel->laynamthongke();
		$namthongke=array("mangnamthongke"=> $namthongke);

		$data = array();
		$data['dv'] = $dv;
		$data['loaimay'] = $loaimay;
		$data['tinhtrang'] = $tinhtrang;
		$data['namthongke'] = $namthongke;

		$this->load->view('thietbidogo/ketsodogo', $data);
	}
	
	function fetch_user(){  
		$fetch_data = $this->thongkedogomodel->make_datatables(
       							$_POST['donvi'],
       							$_POST['tenloai'],
       							$_POST['nguongoc'],
       							$_POST['gia'],
       							$_POST['tinhtrang'],
       							$_POST['maphong'],
       							$_POST['nam'],
   								$_POST['namsd'],
   								$_POST['chatluong']);  
       $data = array(); 
       $index = 1; 
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
            $sub_array[] = $index;  
            $index++;

            $sub_array[] = '<a
            onclick="setvalue(this)" 
            id="'.$row->id.'" 
            tentb="'.$row->tentb.'" 
            mota="'.$row->mota.'"
            tendonvi="'.$row->tendonvi.'"
            maphong="'.$row->maphong.'"
            chatluong="'.$row->chatluong.'"
            tenloai="'.$row->tenloai.'"
            >'.$row->tentb.'</a>';  

            $sub_array[] = $row->mota;  
            $sub_array[] = $row->maso; 

            $sub_array[] = $row->namsd; 
            $sub_array[] = $row->nguongoc;
            $sub_array[] = $row->donvitinh;
            $sub_array[] = $row->gia;
            $sub_array[] = $row->maphong;
            $sub_array[] = $row->chatluong;
            // $sub_array[] = $row->tendonvi;
            // $sub_array[] = ($row->tontai == 0) ? "Vẫn còn" : "Không còn";

            $sub_array[] = $row->ghichu; 
            $sub_array[] = $row->tenloai;
            $sub_array[] = $row->tinhtrang;
           
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>   intval($_POST["draw"]),  
            "recordsTotal"        =>   $this->thongkedogomodel->get_all_data(
            																$_POST['donvi'],
											       							$_POST['tenloai'],
											       							$_POST['nguongoc'],
											       							$_POST['gia'],
											       							$_POST['tinhtrang'],
											       							$_POST['maphong'],
											       							$_POST['nam'],
											   								$_POST['namsd'],
											   								$_POST['chatluong']),  
            "recordsFiltered"     =>   $this->thongkedogomodel->get_filtered_data($_POST['donvi'],
											       							$_POST['tenloai'],
											       							$_POST['nguongoc'],
											       							$_POST['gia'],
											       							$_POST['tinhtrang'],
											       							$_POST['maphong'],
											       							$_POST['nam'],
											   								$_POST['namsd'],
											   								$_POST['chatluong']),  
            "data"                =>   $data  
       );  
       echo json_encode($output);
    }  

    public function xuatfile()
	{
		$madonvi = $this->input->post('donviExcel');
		$hinhthuc = $this->input->post('hinhthuc');
		$namthongke = $this->input->post('namxuatExcel');

		// lấy danh sách thiết bị
		if($hinhthuc == 'tungtb'){
			$arrThietBi = $this->thongkedogomodel->layDSTheoDonVi($madonvi, $namthongke);
		}else{
			$arrThietBi = $this->thongkedogomodel->laydulieuTongHop($madonvi, $namthongke);
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

			$excel2->getActiveSheet()->setCellValueByColumnAndRow(0,5,"BIÊN BẢN  KIỂM KÊ TÀI SẢN NĂM - ".$namthongke);

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
					$excel2->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $dulieu['soluong']);
				}
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
			// $objWriter->save(FCPATH."public/kiemkedogo".$arrThietBi[0]['tenviettat']."_export.xlsx");
  	// 		echo "public/kiemkedogo".$arrThietBi[0]['tenviettat']."_export.xlsx";

  			header('Content-Disposition: attachment;filename="kiemkedogo'.$arrThietBi[0]['tenviettat'].'.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');
        } 
        catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
	}

	public function ketso(){
		$nam = $this->input->post('nam');
		$this->thongkedogomodel->ketso($nam);
		echo thietbidogo_url('ketsodogocontroller/index');
	}

	public function layNamSD() {
    	$iddonvi = $this->input->post('tendonvi');
        $arrNam = $this->thongkedogomodel->layNamSD($iddonvi);
        echo json_encode($arrNam);
    }

    public function layphongkhobangten(){
		$tendonvi = $this->input->post('tendonvi');
        $arrPhongKho = $this->thongkedogomodel->layphongkhobangten($tendonvi);
        echo json_encode($arrPhongKho);
	}

}

/* End of file donvicontroller.php */
/* Location: ./application/controllers/donvicontroller.php */