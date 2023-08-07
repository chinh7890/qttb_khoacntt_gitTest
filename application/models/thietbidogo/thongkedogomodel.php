<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class thongkedogomodel extends My_model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->table='thongkedogo';
	}
	public function getAlldata(){
		$this->db->select('*');
		$data= $this->db->get('thongkedogo');
		$data=$data->result_array();
		return $data;
	}

    public function laynamthongke(){
        $query = 'SELECT namthongke FROM `thongkedogo` GROUP BY namthongke';
        return $this->db->query($query)->result_array();
    }

    public function laydonvicu($idphongkho){
        $query = 'SELECT DISTINCT tendonvi, maphong FROM phong_kho pk, donvi dv, thongkedogo tb WHERE pk.madonvi = dv.id AND tb.maphongkho = pk.id AND tb.id='. $idphongkho;
        return $this->db->query($query)->row();
    }

    public function layphongkho($iddonvi){
        $query = 'SELECT DISTINCT pk.id,pk.maphong FROM phong_kho pk, thietbidogo dg WHERE madonvi='. $iddonvi;
        return $this->db->query($query)->result_array();
    }

	public function checkMaSo($model)
	{
		$query = 'SELECT maso FROM thongkedogo WHERE model="'.$model.'" ORDER BY id DESC LIMIT 1';
		return $this->db->query($query)->result_array();
	}

	public function themdanhsachthongkedogo($data){
        $this->db->db_debug = false;

        if(!@$this->db->insert('thongkedogo',$data))
        {
            $error = $this->db->error();
            return false;
        }else{
            return $this->db->insert_id();
        }
	}

    public function layphongkhobangten($tendonvi){
        $query = 'SELECT pk.id,pk.maphong FROM donvi dv, phong_kho pk WHERE dv.id = pk.madonvi AND dv.tendonvi = "'. $tendonvi.'"';
        return $this->db->query($query)->result_array();
    }

    public function layNamSD($tendonvi){
        $query = 'SELECT DISTINCT namsd 
            FROM thongkemaymoc tb, phong_kho pk, donvi dv
            WHERE tb.maphongkho = pk.id AND pk.madonvi = dv.id AND dv.tendonvi = "'.$tendonvi.'" ORDER BY namsd ASC';
        return $this->db->query($query)->result_array();
    }


	public function layDSTheoDonVi($madonvi, $namthongke){
		$this->db->select('tb.id,
        					tb.tentb,
							tb.mota,
							tb.maso,
							tb.namsd,
							tb.nguongoc,
							tb.donvitinh,
							tb.gia,
							tb.chatluong,
							tb.maphongkho,
							tb.ghichu,
							tb.soluong,
							tb.maloai,
                            tb.tinhtrang,
							tb.matinhtrang,
                            tb.model,
							dv.tendonvi,
							dv.tenviettat,
							loaitb.tenloai,
							pk.maphong,
							pk.tenphong
							');
        $this->db->from('thongkedogo tb, 
        	phong_kho pk, 
        	donvi dv,
        	loaithietbidogo loaitb
        	');
        $this->db->where('pk.id = tb.maphongkho');
        $this->db->where('pk.madonvi = dv.id');
        $this->db->where('loaitb.id = tb.maloai');
        $this->db->where('dv.id = '.$madonvi);
        $this->db->where('tb.namthongke = '.$namthongke);
        
        $arrThietBi = $this->db->get()->result_array();

        return $arrThietBi;
	}

	public function laydulieuTongHop($madonvi, $namthongke)
	{
		$query = "SELECT DISTINCT *,COUNT(tentb) as soluong FROM thongkedogo tb,phong_kho pk, donvi dv WHERE pk.madonvi = dv.id AND tb.maphongkho = pk.id AND dv.id = ".$madonvi." AND tb.namthongke = '".$namthongke."' group by tentb, maphongkho,tinhtrang,chatluong";
		return $this->db->query($query)->result_array();
	}

    public function ketso($nam)
    {
        $query = "INSERT INTO thongkedogo(tentb, maso, mota, namsd, nguongoc, donvitinh, soluong, tontai, gia, chatluong, ghichu, model, tinhtrang, matinhtrang, maphongkho, maloai, idthietbi, namthongke) 
            SELECT tentb, maso, mota, namsd, nguongoc, donvitinh, soluong, tontai, gia, chatluong, ghichu, model, tinhtrang, matinhtrang, maphongkho, maloai, id as idthietbi, '".$nam."' as namthongke FROM thietbidogo
            ";
        $this->db->query($query);
    }


	// pagination
    var $table = "thongkedogo";  
    var $order_column = array("id", "tentb", "mota", "maso","namsd","nguongoc","donvitinh","gia","maphongkho","chatluong","ghichu","model","tinhtrang");

    function make_condition($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong){
        if($donvi != NULL)
        {
            $this->db->where('dv.id = '.$donvi);
        }

        if($tenloai != NULL)
        {
            $this->db->where('loaitb.tenloai = "'.$tenloai.'"');
        }

        if($nguongoc != NULL)
        {
            $this->db->where('tb.nguongoc = "'.$nguongoc.'"');
        }

        if($tinhtrang != NULL)
        {
            $this->db->where('tinhtrang LIKE "%'.$tinhtrang.'%"');
        }

        if($maphong != NULL)
        {
            $this->db->where('tb.maphongkho = "'.$maphong.'"');
        }

        if($nam != NULL)
        {
            $this->db->where('tb.namthongke = "'.$nam.'"');
        }

        if($namsd != NULL){
            $this->db->where('tb.namsd = '.$namsd);
        }

        // lọc giá
        if($gia != NULL)
        {
            if($gia == 1999999){
                $this->db->where('tb.gia < 1999999');
            }else if($gia == 15000000){
                $this->db->where('tb.gia >= 15000000');
            }else{
                list($min, $max) = explode('-', $gia);
                $this->db->where('tb.gia BETWEEN '.$min.' AND '.$max);
            }
        }

        // lọc chất lượng
        if($chatluong != NULL)
        {
            if($chatluong == "0"){
                $this->db->where('tb.chatluong = 0');
            }
            else{
                list($minCL, $maxCL) = explode('-', $chatluong);
                $this->db->where('tb.chatluong BETWEEN '.$minCL.' AND '.$maxCL);
            }
        }
    }

    function make_query($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong)  
     {  
        $this->db->select('tb.id,
                    tb.tentb,
                    tb.mota,
                    tb.maso,
                    tb.namsd,
                    tb.nguongoc,
                    tb.donvitinh,
                    tb.gia,
                    tb.chatluong,
                    tb.tontai,
                    tb.maphongkho,
                    tb.ghichu,
                    tb.maloai,
                    tb.matinhtrang,
                    tb.model,
                    dv.tendonvi,
                    loaitb.tenloai,
                    tinhtrang,
                    pk.tenphong,
                    pk.maphong
                    ');
        $this->db->from('thongkedogo tb, 
            phong_kho pk, 
            donvi dv,
            loaithietbidogo loaitb
            ');
        $this->db->where('pk.id = tb.maphongkho');
        $this->db->where('pk.madonvi = dv.id');
        $this->db->where('loaitb.id = tb.maloai');
        // $this->db->where('tt.id = tb.matinhtrang');

        $this->make_condition($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong);

        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != null)  
        {  
            $this->db->group_start();
            $this->db->like("tb.tentb", $_POST["search"]["value"]);  
            $this->db->or_like("tb.maso", $_POST["search"]["value"]);  
            $this->db->or_like("tb.namsd", $_POST["search"]["value"]);  
            $this->db->or_like("dv.tendonvi", $_POST["search"]["value"]);  
            $this->db->or_like("tb.chatluong", $_POST["search"]["value"]);
            $this->db->group_end();
        }  
        if(isset($_POST["order"]))  
        {  
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }  
        else  
        {  
            $this->db->order_by('tb.id', 'DESC');  
        }  
      }  
      function make_datatables($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong){  
           $this->make_query($donvi, $tenloai,$nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong);  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong){  
           $this->make_query($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong);  

           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong)  
      {  
        $this->db->select('tb.id,
            tb.tentb,
            tb.mota,
            tb.maso,
            tb.namsd,
            tb.nguongoc,
            tb.donvitinh,
            tb.gia,
            tb.chatluong,
            tb.maphongkho,
            tb.ghichu,
            tb.tontai,
            tb.maloai,
            tb.matinhtrang,
            dv.tendonvi,
            loaitb.tenloai,
            tinhtrang,
            pk.tenphong,
            pk.maphong
            ');
        $this->db->from('thongkedogo tb, 
            phong_kho pk, 
            donvi dv,
            loaithietbidogo loaitb
            ');

        $this->make_condition($donvi, $tenloai, $nguongoc, $gia, $tinhtrang,$maphong, $nam, $namsd, $chatluong);

        $this->db->where('pk.id = tb.maphongkho');
        $this->db->where('pk.madonvi = dv.id');
        $this->db->where('loaitb.id = tb.maloai');
        // $this->db->where('tt.id = tb.matinhtrang'); 
           return $this->db->count_all_results();  
      }  
}

/* End of file donvimodel.php */
/* Location: ./application/models/donvimodel.php */