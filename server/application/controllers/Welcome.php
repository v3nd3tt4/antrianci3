<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$meja= $this->db->get('tb_meja');
		
		$data = array(
			'page'=>'welcome_message',
			'link' => '',
			'script'=> 'script',
			'meja' => $meja
		);
		$this->load->view('template/wrapper', $data);
	}

	public function cetak(){
		$this->load->view('cetak');
	}

	public function update_success1(){
		$id_meja = $this->input->post('id_meja', true);
		$nomor_antrian_aktif = $this->input->post('nomor_antrian_aktif', true);
		$hari_ini = date('Y-m-d');
		$update_selesai_dipanggil = $this->db->update('tb_data_antrian', array('status_data_antrian'=>'selesai dipanggil'), array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $hari_ini, 'nomor_data_antrian'=>$nomor_antrian_aktif));
	}
}
