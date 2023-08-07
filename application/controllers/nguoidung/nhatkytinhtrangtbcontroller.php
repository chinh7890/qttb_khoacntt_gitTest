<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class nhatkytinhtrangtbcontroller extends My_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('maymocthietbi/danhsachmaymocthietbimodel');
		$this->load->model('nguoidung/nhatkybaotrimodel');
		$this->load->model('donvi/phong_khomodel');
	}

	public function index()
	{
		
	}

	public function laythietbi(){
		$maphong = $this->input->post('maphong');
		$input['where'] = array('maphongkho' => $maphong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);
		echo json_encode($arr);
	}

	public function themnhatky(){
		$idphong = $this->input->post('idphong');
		$iduser = $this->session->userdata("id");
		$mahocky = $this->input->post("hocky");
		$ngaybaotri = $this->input->post('ngaybaotri');

		$motabaotri = $this->input->post('motabaotri');
		$noidungbaotri = $this->input->post('noidungbaotri');
		$nguoibaotri = $this->input->post('nguoibaotri');
		$nguoikiemtra = $this->input->post('nguoikiemtra');
		$ghichubaotri = $this->input->post('ghichubaotri');

		$arr_tb = $this->input->post('thietbi');

		foreach ($arr_tb as $id){
			$data = array(
				'matb' => intval($id),
				'maphong' => intval($idphong),
				'mahocky' => $mahocky,
				'matk' => intval($iduser),
				'ngaybaotri' => $ngaybaotri,
				'motahuhong' => $motabaotri,
				'noidungbaotri' => $noidungbaotri,
				'nguoibaotri' => $nguoibaotri,
				'nguoikiemtra' => $nguoikiemtra,
				'ghichu' => $ghichubaotri,
				'ngaytao' => time()
			);
			$this->nhatkybaotrimodel->create($data);
		}

		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function capnhat(){
		$id = $this->input->post('idUpdate');
		$iduser = $this->session->userdata("id");
		$ngaybaotri = $this->input->post('ngaybaotri');
		$motabaotri = $this->input->post('motabaotri');
		$noidungbaotri = $this->input->post('noidungbaotri');
		$nguoibaotri = $this->input->post('nguoibaotri');
		$nguoikiemtra = $this->input->post('nguoikiemtra');
		$ghichubaotri = $this->input->post('ghichubaotri');

		$data = array(
			'user_update' => intval($iduser),
			'ngaybaotri' => $ngaybaotri,
			'motahuhong' => $motabaotri,
			'noidungbaotri' => $noidungbaotri,
			'nguoibaotri' => $nguoibaotri,
			'nguoikiemtra' => $nguoikiemtra,
			'ghichu' => $ghichubaotri
		);

		$this->nhatkybaotrimodel->update($id, $data);
		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function xoa()
	{
		$id = $this->uri->segment(4);	
		$this->nhatkybaotrimodel->delete($id);
		redirect(nguoidung_url('nhatkycontroller/hienthinhatky'),'refresh');
	}

	public function xuatsonhatky()
	{
		$idPhong = $this->input->post('phongmayin');
		$idHocky = $this->input->post('hockyin');

		// LẤY NHẬT KÝ BẢO TRÌ
		$arrNhatKy = $this->nhatkybaotrimodel->xuatsonhatky($idPhong, $idHocky);

		// LẤY DANH MỤC THIẾT BỊ PHÒNG
		$input['where'] = array('maphongkho' => $idPhong);
		$arr = $this->danhsachmaymocthietbimodel->get_list($input);

		$path = public_url("bieumau/NhatKyBaoTri.docx");
		// $path = $_SERVER['DOCUMENT_ROOT']."\public\bieumau\\NhatKyBaoTri.docx";

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

		// Header DANH MỤC
		$table->addRow();
		$table->addCell(500,$styleVCell)->addText('STT', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Mã', $myFontStyle, $myParagraphStyle );
		$table->addCell(11000,$styleVCell)->addText('Tên', $myFontStyle, $myParagraphStyle );
		$table->addCell(1000,$styleVCell)->addText('Năm sử dụng', $myFontStyle, $myParagraphStyle );
		$table->addCell(2000,$styleVCell)->addText('Trang', $myFontStyle, $myParagraphStyle );

		// row data DANH MỤC
		$dataFontStyle = array('name' => 'Minion Pro', 'size' => 13,'spaceBefore'=>0,
		'spaceAfter'=>0,
		'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 
		'align' => \PhpOffice\PhpWord\Style\Cell::VALIGN_CENTER);
		
		$index = 1;
		foreach ($arr as $data) {
			$table->addRow();
			$table->addCell(500,$styleVCell)->addText($index, $dataFontStyle, $myParagraphStyle );
			$table->addCell(1000,$styleVCell)->addText($data->maso, $dataFontStyle, $myParagraphStyle );
			$table->addCell(10000,$styleVCell)->addText($data->tentb, $dataFontStyle, $myParagraphStyle );
			$table->addCell(2000,$styleVCell)->addText($data->namsd, $dataFontStyle, $myParagraphStyle );
			$table->addCell(2000,$styleVCell)->addText($data->ghichu, $dataFontStyle, $myParagraphStyle );
			$index ++;
		}

		$templateProcessor->setComplexBlock('table', $table);

		// nhật ký bảo trì
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
						$mangdulieu['ngaybaotri'.$i] = date("d-m-Y", strtotime($nk['ngaybaotri']));
						$mangdulieu['mota'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['motahuhong']);
						$mangdulieu['noidung'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['noidungbaotri']);
						$mangdulieu['ghichu'.$i] = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $nk['ghichu']);
						$mangdulieu['nguoibaotri'.$i] = $nk['nguoibaotri'];
						$mangdulieu['nguoikiemtra'.$i] = $nk['nguoikiemtra'];
						$i++;
					}
				}
				if($i <= 5){
					for($in = $i ; $in <=5 ; $in++){
						$mangdulieu['ngaybaotri'.$in] = "";
						$mangdulieu['mota'.$in] = "";
						$mangdulieu['noidung'.$in] = "";
						$mangdulieu['nguoibaotri'.$in] = "";
						$mangdulieu['nguoikiemtra'.$in] = "";
						$mangdulieu['ghichu'.$in] = "";
					}
				}
			}else{
				for( $in = 1; $in<= 5 ; $in++){
					$mangdulieu['ngaybaotri'.$in] = "";
					$mangdulieu['mota'.$in] = "";
					$mangdulieu['noidung'.$in] = "";
					$mangdulieu['nguoibaotri'.$in] = "";
					$mangdulieu['nguoikiemtra'.$in] = "";
					$mangdulieu['ghichu'.$in] = "";
				}
			}

			$mangdulieu['pageBreakHere'] = '<w:p><w:r><w:br w:type="page"/></w:r></w:p>';
			array_push($replacements, $mangdulieu);
		}
		$templateProcessor->cloneBlock('block_name', $index, true, false, $replacements);

		header("Content-Disposition: attachment; filename=NhatKyBaoTri.docx");
		$templateProcessor->saveAs("php://output");
	}

	function kiemtraNhatKy($idtb, $arrNhatKy){
		foreach ($arrNhatKy as $value) {
			if($value['matb'] == $idtb)
				return true;
		}
		return false;
	}

	public function laydulieu()
	{
		$idhocky= $this->input->post('idhocky');
		$idphong= $this->input->post('idphong');

        $arrKetQua = $this->nhatkybaotrimodel->laydulieu($idhocky, $idphong);
        
        $data = array(
            'mangketqua' => $arrKetQua,
        );
        echo json_encode($data);
	}

   
}

require 'vendor/autoload.php';
