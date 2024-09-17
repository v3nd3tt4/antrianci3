<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {

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
		$this->db->from('tb_operator');
		$this->db->join('tb_meja', 'tb_meja.id_meja = tb_operator.id_meja');
		$operator= $this->db->get();
		
		$data = array(
			'page'=>'admin/operator/index',
            'script' => 'admin/operator/script',
            'link' => 'operator',
			'meja' => $meja,
			'operator' => $operator
		);
		$this->load->view('template/wrapper', $data);
	}

    public function store(){
		$nama_operator = $this->input->post('nama_operator', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
		$level = $this->input->post('level', true);
		$id_meja = $this->input->post('id_meja', true);
		
		$uuid_operator = get_kode(50);

        $cek = $this->db->get_where('tb_operator', array('username' => $username));
        if($cek->num_rows() != 0){
            $return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger" role="alert"><strong> Gagal</strong> Username sudah ada!</div>'
			);
            echo json_encode($return);
            exit();
        }
		$data = array(
			'nama_operator' => $nama_operator,
			'uuid_operator' => $uuid_operator,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
			'id_meja' => $id_meja,
			'level' => $level,
		);

		$simpan = $this->db->insert('tb_operator', $data);
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
		$cek = $this->db->get_where('tb_operator', array('uuid_operator'=>$uuid));
		if($cek->num_rows() == 0){
			echo json_encode(array('status' => false));
		}else{
			echo json_encode($cek->row());
		}
	}

	public function update(){
		$nama_operator = $this->input->post('nama_operator', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
		$level = $this->input->post('level', true);
		$id_meja = $this->input->post('id_meja', true);
		$uuid_operator = $this->input->post('uuid_operator', true);

		if($password!=''){
			$data = array(			
				'nama_operator' => $nama_operator,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'id_meja' => $id_meja,
				'level' => $level,
			);
		}else{
			$data = array(			
				'nama_operator' => $nama_operator,
				'id_meja' => $id_meja,
				'level' => $level,
			);
		}
		

		$simpan = $this->db->update('tb_operator', $data, array('uuid_operator'=> $uuid_operator));
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
		$cek = $this->db->get_where('tb_operator', array('uuid_operator'=>$uuid));
		if($cek->num_rows() == 0){
			$return = array(
				'status' => 'failed',
				'text' => '<div class="alert alert-danger" role="alert"><strong> Gagal</strong> Id tidak ditemukan!</div>'
			);
			echo json_encode($return);
			exit();	
		}else{
			$hapus = $this->db->delete('tb_operator', array('uuid_operator' => $uuid));
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
