<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sokhocontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('donvi/donvimodel');
		$this->load->model('nguoidung/hockymodel');
		$this->load->model('donvi/phong_khomodel');
		$this->load->model('maymocthietbi/danhsachmaymocthietbimodel');

		$this->load->model('nguoidung/hockymodel');
		$this->load->model('nguoidung/taikhoanmodel');
		$this->load->model('nguoidung/soquanlykhomodel');
		$this->load->model('nguoidung/nhatkymodel');
	}

	// SỔ NHẬT KÝ
	public function index()
	{
		$donvi = $this->donvimodel->getAlldata();
		$data = array();
		$data['donvi'] = $donvi;
		$input['where'] = array("madonvi" => $this->session->userdata("madonvi"));
		$data['phong'] = $this->phong_khomodel->get_list($input);
		$data['giaovien'] = $this->taikhoanmodel->get_list($input);
		$data['hocky'] = $this->hockymodel->laydanhsach($this->session->userdata("madonvi"));
		$this->load->view('ghiso/sokho', $data);
	}

	public function laythietbi(){
		$maphong = $this->input->post('maphong');

		$input['where'] = array('maphongkho' => $maphong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);
		echo json_encode($arr);
	}

	public function themsokho(){
		$idphong = $this->input->post('phongmay');
		$iduser = $this->input->post('gvsd');
		$matb = $this->input->post('thietbi');
		$ngaymuon = $this->input->post('ngaymuon');
		$ngaytra = $this->input->post('ngaytra');
		$mucdich = $this->input->post('mucdich');
		$tinhtrangtruoc = $this->input->post('tinhtrangtruoc');
		$tinhtrangsau = $this->input->post('tinhtrangsau');

		$rsHocKy = $this->nhatkymodel->layhockymoinhat();

		$data = array(
			'maphong' => intval($idphong),
			'matk' => intval($iduser),
			'mahocky' => intval($rsHocKy->id),
			'matb' => intval($matb),
			'ngaymuon' => $ngaymuon,
			'ngaytra' => $ngaytra,
			'mucdichsd' => $mucdich,
			'tinhtrangtruoc' => $tinhtrangtruoc,
			'tinhtrangsau' => $tinhtrangsau,
			'ngaytao' => time()
		);

		$this->soquanlykhomodel->create($data);
		redirect(nguoidung_url('sokhocontroller/index'),'refresh');
	}

	public function capnhatnhatky(){
		$id = $this->input->post('idUpdate');
		$ngaymuon = $this->input->post('ngaymuon');
		$ngaytra = $this->input->post('ngaytra');
		$mucdich = $this->input->post('mucdich');
		$tinhtrangtruoc = $this->input->post('tinhtrangtruoc');
		$tinhtrangsau = $this->input->post('tinhtrangsau');
		$data = array(
			'ngaymuon' => $ngaymuon,
			'ngaytra' => $ngaytra,
			'mucdichsd' => $mucdich,
			'tinhtrangtruoc' => $tinhtrangtruoc,
			'tinhtrangsau' => $tinhtrangsau,
			'ngaycapnhat' => time()
		);

		$this->soquanlykhomodel->update($id, $data);
		redirect(nguoidung_url('sokhocontroller/index'),'refresh');
	}

	public function xoanhatky()
	{
		$id = $this->uri->segment(4);	
		$this->soquanlykhomodel->delete($id);
		redirect(nguoidung_url('sokhocontroller/index'),'refresh');
	}

	public function laydulieu()
	{
		$idphong = $this->input->post('idphong');
		$idhocky= $this->input->post('idhocky');

        $arrKetQua = $this->soquanlykhomodel->laydulieu($idphong, $idhocky);
        
        $data = array(
            'mangketqua' => $arrKetQua,
        );
        echo json_encode($data);
	}

	public function xuatsonhatky()
	{
		$idPhong = $this->input->post('phongmayin');
		$idHocky = $this->input->post('hockyin');

		// LẤY NHẬT KÝ SỬ DỤNG
		$arrNhatKy = $this->soquanlykhomodel->xuatsonhatky($idPhong, $idHocky);

		// LẤY DANH MỤC THIẾT BỊ PHÒNG
		$input['where'] = array('maphongkho' => $idPhong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);

		// $path = public_url("bieumau/soqlkho_in.docx");
		$path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\soqlkho_in.docx";
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);

		// đặt tên phòng
		$rsphong = $this->phong_khomodel->get_info_rule(array('id' => $idPhong)); 
		$templateProcessor->setValues(array('tenphong'=> $rsphong->maphong));

		//table
		$table = new \PhpOffice\PhpWord\Element\Table([
		    'borderSize' => 6, 
		    'borderColor' => 'black', 
		    'spaceBefore'=>0,
			'spaceAfter'=>0,
			'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
			'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER
		]);
		
		// style header
		$myFontStyle = array('name' => 'Minion Pro', 'size' => 11, 'bold' => true);
		$myParagraphStyle = array('align'=>'center', 'spaceBefore'=>50, 'spaceafter' => 50);
		$styleVCell = array('valign'=>'center'); 

		// Header
		$table->addRow();
		$table->addCell(500,$styleVCell)->addText('STT', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Mã TB', $myFontStyle, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Tên TB', $myFontStyle, $myParagraphStyle );
		$table->addCell(6000,$styleVCell)->addText('Thông số kỹ thuật', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Năm sử dụng', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Trang', $myFontStyle, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Ghi chú', $myFontStyle, $myParagraphStyle );

		// row data
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 11,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
		
		// danh mục thiết bị
		$index = 0;
		foreach ($arr as $data) {
			$table->addRow();
			$index ++;
			$table->addCell(500,$styleVCell)->addText($index, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->maso, $dataFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText($data->tentb, $dataFontStyle, $myParagraphStyle );
			$table->addCell(7000,$styleVCell)->addText($data->mota, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->namsd, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText("", $dataFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText($data->ghichu, $dataFontStyle, $myParagraphStyle );
		}
		$templateProcessor->setComplexBlock('table', $table);

		$templateProcessor->setValue('pageBreakHere', '<w:br />');

		// nhật ký sử dụng
		$replacements = array();
		foreach ($arr as $data){
			$mangdulieu = array(
				'matb' => $data->maso, 
				'tentb' => $data->tentb,
				'model' => $data->model,
				'namsd' => $data->namsd,
				'chatluong' => $data->chatluong."%",
				'ghichu' => $data->ghichu
			);

			if($this->kiemtraNhatKy($data->id, $arrNhatKy)) 
			{ 
				$i = 1;
				foreach ($arrNhatKy as $nk){
					if($nk['matb'] == $data->id){
						$mangdulieu['ngaymuon'.$i] = $nk['ngaymuon'];
						$mangdulieu['ngaytra'.$i] = $nk['ngaytra'];
						$mangdulieu['mucdich'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['mucdichsd']);
						$mangdulieu['tinhtrangtruoc'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['tinhtrangtruoc']);
						$mangdulieu['tinhtrangsau'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['tinhtrangsau']);
						$mangdulieu['hoten'.$i] = $nk['hoten'];
						$i++;
					}
				}
				if($i < 5){
					for($in = $i ; $in <=5 ; $in++){
						$mangdulieu['ngaymuon'.$in] = "";
						$mangdulieu['ngaytra'.$in] = "";
						$mangdulieu['mucdich'.$in] = "";
						$mangdulieu['tinhtrangtruoc'.$in] = "";
						$mangdulieu['tinhtrangsau'.$in] = "";
						$mangdulieu['hoten'.$in] = "";
					}
				}
			}else{
				for( $in = 1; $in<= 6 ; $in++){
					$mangdulieu['ngaymuon'.$in] = "";
					$mangdulieu['ngaytra'.$in] = "";
					$mangdulieu['mucdich'.$in] = "";
					$mangdulieu['tinhtrangtruoc'.$in] = "";
					$mangdulieu['tinhtrangsau'.$in] = "";
					$mangdulieu['hoten'.$in] = "";
				}
			}
			
			array_push($replacements, $mangdulieu);
		}
		$templateProcessor->cloneBlock('block_name', $index, true, false, $replacements);

		
		header("Content-Disposition: attachment; filename=soquanlykho.docx");
		$templateProcessor->saveAs("php://output");
	}

	function kiemtraNhatKy($idtb, $arrNhatKy){
		foreach ($arrNhatKy as $value) {
			if($value['matb'] == $idtb)
				return true;
		}
		return false;
	}

}
require 'vendor/autoload.php';