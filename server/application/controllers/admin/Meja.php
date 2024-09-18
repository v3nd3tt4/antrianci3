<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller {

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
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')!='admin'){
            echo '<script>alert("Maaf anda tidak diizinkan mengakses halaman ini");window.location.href = "' . base_url() . 'welcome";</script>';
            exit();
        }
    }
	public function index()
	{
		$meja= $this->db->get('tb_meja');
		
		$data = array(
			'page'=>'admin/meja/index',
            'script' => 'admin/meja/script',
            'link' => 'meja',
			'meja' => $meja
		);
		$this->load->view('template/wrapper', $data);
	}

    public function store(){
		$nomor_meja = $this->input->post('nomor_meja', true);
        $kode_meja = $this->input->post('kode_meja', true);
        $keterangan_meja = $this->input->post('keterangan_meja', true);
		
		$uuid_meja = get_kode(50);

        $cek = $this->db->get_where('tb_meja', array('nomor_meja' => $nomor_meja));
        if($cek->num_rows() != 0){
            $return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger" role="alert"><strong> Gagal</strong> Nomor meja sudah ada!</div>'
			);
            echo json_encode($return);
            exit();
        }
		$data = array(
			'nomor_meja' => $nomor_meja,
			'uuid_meja' => $uuid_meja,
            'kode_meja' => $kode_meja,
            'keterangan_meja' => $keterangan_meja,
		);

		$simpan = $this->db->insert('tb_meja', $data);
		if($simpan){
			$return = array(
				'status' => 'success',
				'text' => '<div class="alert alert-success" role="alert"><strong> Berhasil!</strong>  Data berhasl disimpan!</div>'
			);	
		}else{
			$return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger" role="alert"><strong> Gagal</strong> Data gagal disimpan!</div>'
			);	
		}		
		echo json_encode($return);
	}

	public function get_data(){
		$uuid = $this->input->post('uuid', true);
		$cek = $this->db->get_where('tb_meja', array('uuid_meja'=>$uuid));
		if($cek->num_rows() == 0){
			echo json_encode(array('status' => false));
		}else{
			echo json_encode($cek->row());
		}
	}

	public function update(){
		$nomor_meja = $this->input->post('nomor_meja', true);
        $kode_meja = $this->input->post('kode_meja', true);
        $keterangan_meja = $this->input->post('keterangan_meja', true);
		$uuid_meja = $this->input->post('uuid_meja', true);

		$data = array(			
            'kode_meja' => $kode_meja,
            'keterangan_meja' => $keterangan_meja,
		);

		$simpan = $this->db->update('tb_meja', $data, array('uuid_meja'=> $uuid_meja));
		if($simpan){
			$return = array(
				'status' => 'success',
				'text' => '<div class="alert alert-success" role="alert"><strong> Berhasil!</strong>  Data berhasl diupdate!</div>'
			);	
		}else{
			$return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger" role="alert"><strong> Gagal</strong> Data gagal diupdate!</div>'
			);	
		}		
		echo json_encode($return);
	}

	public function delete(){
		$uuid = $this->input->post('uuid', true);
		$cek = $this->db->get_where('tb_meja', array('uuid_meja'=>$uuid));
		if($cek->num_rows() == 0){
			$return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger" role="alert"><strong> Gagal</strong> Id tidak ditemukan!</div>'
			);
			echo json_encode($return);
			exit();	
		}else{
			$hapus = $this->db->delete('tb_meja', array('uuid_meja' => $uuid));
			if($hapus){
				$return = array(
					'status' => 'success',
					'text' => '<div class="alert alert-success" role="alert"><strong> Berhasil!</strong>  Data berhasl dihapus!</div>'
				);	
				echo json_encode($return);
				exit();	
			}else{
				$return = array(
					'status' => 'failed',
					'text' => '<div class="alert alert-danger" role="alert"><strong> Gagal</strong> Data gagal dihapus!</div>'
				);	
				echo json_encode($return);
				exit();	
			}		
		}
	}
}
