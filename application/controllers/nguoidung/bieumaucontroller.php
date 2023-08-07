<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bieumaucontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('donvi/donvimodel');
		$this->load->model('donvi/phong_khomodel');
		$this->load->model('maymocthietbi/danhsachmaymocthietbimodel');

		$this->load->model('nguoidung/bieumaumodel');
	}

	public function index()
	{
		$data = array();
		$bm = $this->bieumaumodel->get_list();
		$data['bm'] = $bm;

		$this->load->view('bieumau/bieumau',$data);
	}

	public function thembieumau()
	{
		$tendenghi=$this->input->post('tendenghi');
		//-------------upload file ---------
		$config['upload_path'] = './public/bieumaunguoidung/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload("filedenghi"))
		{
			$data = array('upload_data' => $this->upload->data());

			$upload_data = $this->upload->data(); 
			$tentaptin = $upload_data['file_name'];
		}

		$data=array(
			'tenbieumau' => $tendenghi,
			'tentaptin' => $tentaptin,
			'create_at' => time()
		);


		$this->bieumaumodel->create($data);

		redirect(nguoidung_url('bieumaucontroller/index'),'refresh');
	}

	public function capnhatbieumau()
	{
		$id=$this->input->post('idUpdate');
		$tendenghi=$this->input->post('tendenghi');
		$tentaptin = "";

		//-------------upload file ---------
		$path = './public/bieumaunguoidung/';
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'pdf|doc|docx';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload("filedenghi"))
		{
			$data = array('upload_data' => $this->upload->data());

			$upload_data = $this->upload->data(); 
			$tentaptin = $upload_data['file_name'];
		}

		if($tentaptin == ""){
			$data=array(
				'tenbieumau' => $tendenghi,
				'create_at' => time()
			);
		}else{
			$data=array(
				'tenbieumau' => $tendenghi,
				'tentaptin' => $tentaptin,
				'create_at' => time()
			);

			// xóa tập tin cũ
			$vt = $this->bieumaumodel->get_info($id, "tentaptin");
			unlink($path.$vt->tentaptin);
		}

		$check = $this->bieumaumodel->update($id,$data);
		if($check == TRUE)
		{
			redirect(nguoidung_url('bieumaucontroller/index'),'refresh');
		}
		else {
			echo "Error";
		}
	}

	public function xoabieumau()
	{
		$id = $this->uri->segment(4);
		$path = './public/bieumaunguoidung/';
		// xóa tập tin cũ
		$vt = $this->bieumaumodel->get_info($id, "tentaptin");
		$check = $this->bieumaumodel->delete($id);
		if($check == true){
			unlink($path.$vt->tentaptin);
		}
		redirect(nguoidung_url('bieumaucontroller/index'),'refresh');
	}

	public function nhatkyphongmay()
	{
		$donvi = $this->donvimodel->getAlldata();

		$data = array();
		$data['donvi'] = $donvi;

		$this->load->view('bieumau/nhatkyphongmay', $data);
	}

	public function layphong(){
		$makhoa = $this->input->post('makhoa');

		$input['where'] = array('madonvi' => $makhoa);
		$arr = $this->phong_khomodel->get_list($input);
		echo json_encode($arr);
	}
	
	public function xuatnhatky(){
		$idKhoa = $this->input->post('selKhoa');
		$idPhong = $this->input->post('selPhong');

		// get data input
		$input['where'] = array('maphongkho' => $idPhong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);

		// $path = public_url("bieumau/nhatky.docx");
		$path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\nhatky.docx";
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
		$table->addCell(7000,$styleVCell)->addText('Thông số kỹ thuật', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Năm sử dụng', $myFontStyle, $myParagraphStyle );
		$table->addCell(3000,$styleVCell)->addText('Ghi chú', $myFontStyle, $myParagraphStyle );

		// row data
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 11,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
		
		$index = 1;
		foreach ($arr as $data) {
			$table->addRow();
			$table->addCell(500,$styleVCell)->addText($index, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->maso, $dataFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText($data->tentb, $dataFontStyle, $myParagraphStyle );
			$table->addCell(7000,$styleVCell)->addText($data->mota, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->namsd, $dataFontStyle, $myParagraphStyle );
			$table->addCell(3000,$styleVCell)->addText($data->ghichu, $dataFontStyle, $myParagraphStyle );
			$index ++;
		}

		$templateProcessor->setComplexBlock('table', $table);


		header("Content-Disposition: attachment; filename=nhatky.docx");
		$templateProcessor->saveAs("php://output");
	}
	
	// QUẢN LÝ SỔ KHOA
	public function hienthisokho()
	{
		$donvi = $this->donvimodel->getAlldata();

		$data = array();
		$data['donvi'] = $donvi;
		$this->load->view('bieumau/soquanlykho', $data);
	}

	public function xuatdulieu(){
		$idKhoa = $this->input->post('selKhoa');
		$idPhong = $this->input->post('selPhong');

		// get data input
		$input['where'] = array('maphongkho' => $idPhong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);

		if ($_POST['action'] == 'SoKho') {
			// $path = public_url("bieumau/soqlkho.docx");
			$path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\soqlkho.docx";
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
				array_push($replacements, array(
					'matb' => $data->maso, 
					'tentb' => $data->tentb,
					'model' => $data->model,
					'namsd' => $data->namsd,
					'chatluong' => $data->chatluong."%",
					'ghichu' => $data->ghichu
			));
			}
			$templateProcessor->cloneBlock('block_name', $index, true, false, $replacements);


			header("Content-Disposition: attachment; filename=soquanlykho.docx");
			$templateProcessor->saveAs("php://output");
		}else if ($_POST['action'] == 'LyLich'){
			// $path = public_url("bieumau/lylich.docx");
			$path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\lylich.docx";
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);

			// đặt tên phòng
			$rsphong = $this->phong_khomodel->get_info_rule(array('id' => $idPhong)); 
			$templateProcessor->setValues(array('tenphong'=> $rsphong->maphong));


			// nhật ký sử dụng
			$replacements = array();
			foreach ($arr as $data){
				array_push($replacements, array(
					'matb' => $data->maso, 
					'tentb' => $data->tentb,
					'model' => "",
					'namsd' => $data->namsd,
					'chatluong' => $data->chatluong."%",
					'mota' => $data->mota
			));
			}
			$templateProcessor->cloneBlock('block_name', count($arr), true, false, $replacements);


			header("Content-Disposition: attachment; filename=solylich_".$rsphong->maphong.".docx");
			$templateProcessor->saveAs("php://output");

		}else if ($_POST['action'] == 'TBSanXuat'){
			// $path = public_url("bieumau/thietbisanxuat.docx");
			$path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\thietbisanxuat.docx";
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);


			$values = [];
			$index = 1;
			$arr = $this->danhsachmaymocthietbimodel->layDSTheoDonVi($idKhoa);
			foreach ($arr as $data) {
				array_push($values, [
						'stt' => $index,
						'tentb' =>$data['tentb'],
						'maso' =>$data['maso'],
						'soluong' => 1,
						'mota' =>$data['mota'],
						'tenphong' =>$data['maphong'],
				]);
				$index++;
			}
			$templateProcessor->cloneRowAndSetValues ('stt',$values);


			header("Content-Disposition: attachment; filename=thietbisanxuat.docx");
			$templateProcessor->saveAs("php://output");

		}

		
	}
}
require 'vendor/autoload.php';