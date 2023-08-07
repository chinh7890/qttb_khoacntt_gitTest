<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vattuhoctapcontroller extends My_controller {

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
		$this->load->model('nguoidung/donvitinhmodel');

		$this->load->model('nguoidung/nhatkymodel');

		$this->load->model('nguoidung/sovattugiangdaymodel');
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
		$data['donvitinh'] = $this->donvitinhmodel->getAlldata();
		$this->load->view('ghiso/sovattu', $data);
	}

	public function laythietbi(){
		$maphong = $this->input->post('maphong');
		$input['where'] = array('maphongkho' => $maphong);
		$arr = $this->sovattugiangdaymodel->laythietbi($maphong);
		echo json_encode($arr);
	}

	public function themmoi(){
		$madonvi = $this->input->post('donvithem');
		$arr_tentb = $this->input->post('thietbi');
		$add_tieuhao = $this->input->post('add_tieuhao');
		$add_donvitinh = $this->input->post('add_donvitinh');
		$add_ghichu = $this->input->post('add_ghichu');
		$add_ngaynhan = $this->input->post('add_ngaynhan');


		$add_gv1 = $this->input->post('add_gv1');
		$add_gv2 = $this->input->post('add_gv2');
		$add_soluong_gv1 = $this->input->post('add_soluong_gv1');
		$add_soluong_gv2 = $this->input->post('add_soluong_gv2');

		if($add_gv2 == "") $add_soluong_gv2 = "";
		
		$add_ngaynhan_gv1 = $this->input->post('add_ngaynhan_gv1');
		$add_ngaynhan_gv2 = $this->input->post('add_ngaynhan_gv2');
		$add_ngaytra_gv1 = $this->input->post('add_ngaytra_gv1');
		$add_ngaytra_gv2 = $this->input->post('add_ngaytra_gv2');

		// kiểm tra nếu admin thì thêm được học kỳ khác
		if($this->session->userdata("quyenhan") == 1){
			$idhocky = $this->input->post('idhocky');
		}else{
			$rsHocKy = $this->nhatkymodel->layhockymoinhat();
			$idhocky = intval($rsHocKy->id);
		}

		$create_at = time();
		foreach ($arr_tentb as $id) {
			$rs_tb = $this->danhsachmaymocthietbimodel->get_info($id);
			$ghichu = ($add_ghichu == "") ? $rs_tb->ghichu : $add_ghichu;
			$data = array(
				'danhmuc' => $rs_tb->tentb,
				'id_tb'=>$id,
				'tieuhao' => $add_tieuhao,
				'dvt' => $add_donvitinh,
				'ngaynhan' => $add_ngaynhan,
				'ghichu' => $ghichu,

				'ten_gv1' => $add_gv1,
				'sl_gv1' => $add_soluong_gv1,
				'ngaynhan_gv1' => $add_ngaynhan_gv1,
				'ngaytra_gv1' => $add_ngaytra_gv1,

				'ten_gv2' => $add_gv2,
				'sl_gv2' => $add_soluong_gv2,
				'ngaynhan_gv2' => $add_ngaynhan_gv2,
				'ngaytra_gv2' => $add_ngaytra_gv2,
				'mahocky' => $idhocky,
				'create_at' => $create_at,
				'people_create'=> $this->session->userdata('id'),
				'madonvi' => $madonvi
			);

			$this->sovattugiangdaymodel->create($data);
		}
		
		redirect(nguoidung_url('vattuhoctapcontroller/index'),'refresh');
	}

	public function capnhat(){
		$id = $this->input->post('idUpdate');
		$tentb = $this->input->post('update_tentb');
		$add_tieuhao = $this->input->post('update_tieuhao');
		$add_donvitinh = $this->input->post('update_donvitinh');
		$add_ngaynhan = $this->input->post('update_ngaynhan');
		$ghichu = $this->input->post('update_ghichu');

		$add_gv1 = $this->input->post('update_gv1');
		$add_gv2 = $this->input->post('update_gv2');
		$add_soluong_gv1 = $this->input->post('update_soluong_gv1');
		$add_soluong_gv2 = $this->input->post('update_soluong_gv2');
		
		$add_ngaynhan_gv1 = $this->input->post('update_ngaynhan_gv1');
		$add_ngaynhan_gv2 = $this->input->post('update_ngaynhan_gv2');
		$add_ngaytra_gv1 = $this->input->post('update_ngaytra_gv1');
		$add_ngaytra_gv2 = $this->input->post('update_ngaytra_gv2');

		$rs_tb = $this->sovattugiangdaymodel->get_info($id);

		$data = array(
			'tieuhao' => $add_tieuhao,
			'dvt' => $add_donvitinh,
			'ngaynhan' => $add_ngaynhan,
			'ghichu' => $ghichu,

			'ten_gv1' => $add_gv1,
			'sl_gv1' => $add_soluong_gv1,
			'ngaynhan_gv1' => $add_ngaynhan_gv1,
			'ngaytra_gv1' => $add_ngaytra_gv1,

			'ten_gv2' => $add_gv2,
			'sl_gv2' => $add_soluong_gv2,
			'ngaynhan_gv2' => $add_ngaynhan_gv2,
			'ngaytra_gv2' => $add_ngaytra_gv2,
			'people_update'=> $this->session->userdata('id')
		);

		$this->sovattugiangdaymodel->capnhatthongtin($rs_tb->create_at, $tentb, $data);
		redirect(nguoidung_url('vattuhoctapcontroller/index'),'refresh');
	}

	public function xoa()
	{
		$id = $this->uri->segment(4);	
		$this->sovattugiangdaymodel->delete($id);
		redirect(nguoidung_url('vattuhoctapcontroller/index'),'refresh');
	}

	public function laydulieu()
	{
		$idhocky= $this->input->post('idhocky');
		$madonvi= $this->input->post('madonvi');

        $arrKetQua = $this->sovattugiangdaymodel->laydulieu($idhocky, $madonvi);
        
        $data = array(
            'mangketqua' => $arrKetQua,
        );
        echo json_encode($data);
	}

	public function xuatsovattu()
	{
		$idhocky= $this->input->post('hockyin');
		$madonvi= $this->input->post('donviin');

		// LẤY THÔNG TIN ĐƠN VỊ
		$tt_donvi = $this->donvimodel->get_info($madonvi);

		// LẤY THÔNG TIN HỌC KỲ
		$tt_hocky = $this->hockymodel->get_info($idhocky);

		// LẤY DANH SÁCH VẬT TƯ
		$arr_tong = $this->sovattugiangdaymodel->xuatsovattu($idhocky);

		$path = public_url("bieumau/sovattu_in.docx");
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);

		
		
		// style header
		$myFontStyle = array('name' => 'Minion Pro', 'size' => 11);
		$myParagraphStyle = array('align'=>'center', 'spaceBefore'=>50, 'spaceafter' => 50);
		$styleVCell = array('valign'=>'center'); 

		// row data DANH MỤC
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 11,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);

		$cellRowSpan = array('vMerge' => 'restart','valign'=>'center');
		$cellRowContinue = array('vMerge' => 'continue');
		$cellColSpan8 = array('gridSpan' => 8);
		$cellColSpan4 = array('gridSpan' => 4);

		// tạo ra các bảng của từng giáo viên với các INDEX
		$replacements = array();
		for ($i=1; $i <= count($arr_tong); $i++) { 
			$mangdulieu['table'] = '${table'.$i.'}';
			$mangdulieu['footer'] = '${footer'.$i.'}';
			$mangdulieu['pageBreakHere'] = '${pageBreakHere'.$i.'}';
			array_push($replacements, $mangdulieu);
		}
		$templateProcessor->cloneBlock('block_name', count($arr_tong), true, false, $replacements);

		$index = 1; // index bảng thứ mấy
		foreach ($arr_tong as $item_tong) {
			$input['where'] = array(
				'ten_gv1' => $item_tong['ten_gv1'],
				'ten_gv2' => $item_tong['ten_gv2'],
				'mahocky' => $idhocky
			);
			$arr = $this->sovattugiangdaymodel->get_list($input);

			//table
			$table = new \PhpOffice\PhpWord\Element\Table([
			    'borderSize' => 6, 
			    'borderColor' => 'black', 
			    'spaceBefore'=>0,
				'spaceAfter'=>0,
				'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
				'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER
			]);

			$table->addRow();
			$table->addCell(500, $cellRowSpan)->addText("TT",$myFontStyle, $myParagraphStyle );
			$table->addCell(2800, $cellRowSpan)->addText("Danh mục vật tư",$myFontStyle, $myParagraphStyle);
			$table->addCell(700, $cellRowSpan)->addText("Tiêu hao",$myFontStyle, $myParagraphStyle);
			$table->addCell(1000, $cellRowSpan)->addText("ĐVT",$myFontStyle, $myParagraphStyle);
			$table->addCell(500, $cellRowSpan)->addText("SL",$myFontStyle, $myParagraphStyle);
			$table->addCell(2000, $cellRowSpan)->addText("Ngày nhận",$myFontStyle, $myParagraphStyle);
			$table->addCell(9000, $cellColSpan8)->addText("Giáo viên nhận vật tư giảng dạy",$myFontStyle, $myParagraphStyle);

			// add dữ liệu
			$stt = 1;
			foreach ($arr as $item) {

				if($stt == 1){
					$table->addRow();
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(4500, $cellColSpan4)->addText("GV1: ".$item->ten_gv1,$myFontStyle, $myParagraphStyle);
					$table->addCell(4500, $cellColSpan4)->addText("GV2: ".$item->ten_gv2,$myFontStyle, $myParagraphStyle);

					$table->addRow();
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(700, $cellRowSpan)->addText("SL",$myFontStyle, $myParagraphStyle);
					$table->addCell(2000, $cellRowSpan)->addText("Ký nhận",$myFontStyle, $myParagraphStyle);
					$table->addCell(2000, $cellRowSpan)->addText("Ngày nhận",$myFontStyle, $myParagraphStyle);
					$table->addCell(2000, $cellRowSpan)->addText("Ngày nhận",$myFontStyle, $myParagraphStyle);
					$table->addCell(700, $cellRowSpan)->addText("SL",$myFontStyle, $myParagraphStyle);
					$table->addCell(2000, $cellRowSpan)->addText("Ký nhận",$myFontStyle, $myParagraphStyle);
					$table->addCell(2000, $cellRowSpan)->addText("Ngày nhận",$myFontStyle, $myParagraphStyle);
					$table->addCell(2000, $cellRowSpan)->addText("Ngày nhận",$myFontStyle, $myParagraphStyle);
				}
				$table->addRow();
				$table->addCell(500)->addText($stt, $myFontStyle, $myParagraphStyle);
				$table->addCell(2800)->addText($item->danhmuc,$myFontStyle, $myParagraphStyle);
				$table->addCell(700)->addText($item->tieuhao, $myFontStyle, $myParagraphStyle);
				$table->addCell(1000)->addText($item->dvt, $myFontStyle, $myParagraphStyle);
				$table->addCell(500)->addText($item->sl_gv1+$item->sl_gv2, 
					$myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText($item->ngaynhan, $myFontStyle, $myParagraphStyle);
				$table->addCell(700)->addText($item->sl_gv1, $myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText("", $myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText($item->ngaynhan_gv1, $myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText($item->ngaytra_gv1, $myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText($item->sl_gv2, $myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText("", $myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText($item->ngaynhan_gv2, $myFontStyle, $myParagraphStyle);
				$table->addCell(2000)->addText($item->ngaytra_gv2, $myFontStyle, $myParagraphStyle);
				$stt++;
			}

			$noidung_footer = "Khoa: $tt_donvi->tendonvi                                          Ngành:...................................................................................................................................... <w:br/>". "Vật tư học kỳ: $tt_hocky->hocky                 Năm học: $tt_hocky->tunam - $tt_hocky->dennam                      Mục đích sử dụng:................................................................................................................";
			
			// thêm vào đúng index bảng
			$templateProcessor->setComplexBlock('table'.$index, $table);
			$templateProcessor->setValue('footer'.$index, $noidung_footer);
			$templateProcessor->setValue('pageBreakHere'.$index, '<w:p><w:r><w:br w:type="page"/></w:r></w:p>');
			$index++;
		}
		

		header("Content-Disposition: attachment; filename=VatTuHocTap.docx");
		$templateProcessor->saveAs("php://output");
	}

	function kiemtraNhatKy($idtb, $arrNhatKy){
		foreach ($arrNhatKy as $value) {
			if($value['matb'] == $idtb)
				return true;
		}
		return false;
	}


	// ===========================ĐƠN VỊ TÍNH===============================
	public function themmoi_donvitinh(){
		$add_donvitinh = $this->input->post('add_donvitinh');
		
		$data = array(
			'tendonvi' => $add_donvitinh,
		);

		$this->donvitinhmodel->create($data);
		
		redirect(nguoidung_url('vattuhoctapcontroller/index'),'refresh');
	}

	public function xoa_donvitinh()
	{
		$id = $this->uri->segment(4);	
		$this->donvitinhmodel->delete($id);
		redirect(nguoidung_url('vattuhoctapcontroller/index'),'refresh');
	}

	public function capnhat_donvitinh(){
		$id = $this->input->post('idUpdate_dvt');
		$tendv = $this->input->post('update_tendonvi');

		$data = array(
			'tendonvi' => $tendv
		);

		$this->donvitinhmodel->update($id, $data);
		redirect(nguoidung_url('vattuhoctapcontroller/index'),'refresh');
	}


}
require 'vendor/autoload.php';