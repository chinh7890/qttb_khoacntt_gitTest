<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecontroller extends My_controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$hoten = $this->session->userdata('hoten');
		if($hoten == NULL)
		{
			// $this->load->view('login/login');
		}
		else
		{
			$this->load->model('maymocthietbi/danhsachmaymocthietbimodel');
			$this->load->model('thietbidogo/danhsachthietbidogomodel');
			$maymoc = $this->danhsachmaymocthietbimodel->soluongthietbi_donvi();
			$dogo = $this->danhsachthietbidogomodel->soluongthietbi_donvi();

			$data = array();
			$data['maymoc'] = $maymoc;
			$data['dogo'] = $dogo;

			$this->load->view('home', $data);
		}
	}
}
