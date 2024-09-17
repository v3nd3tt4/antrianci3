<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panggilan extends CI_Controller {

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
        if($this->session->userdata('level')!='operator'){
            echo '<script>alert("Maaf anda tidak diizinkan mengakses halaman ini");window.location.href = "' . base_url() . 'welcome";</script>';
            exit();
        }
    }
	public function index()
	{
        $id_meja = $this->session->userdata('id_meja')==''?'1':$this->session->userdata('id_meja');
        $meja = $this->db->get_where('tb_meja', array('id_meja'=>$id_meja));
		
		$this->db->from('tb_operator');
		$this->db->join('tb_meja', 'tb_meja.id_meja = tb_operator.id_meja');
		$operator= $this->db->get();

        $id_meja = $this->session->userdata('id_meja')==''?'1':$this->session->userdata('id_meja');
		$tanggal_data_antrian = date('Y-m-d');

		$this->db->from('tb_data_antrian');
		// $this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $tanggal_data_antrian, 'status_data_antrian'=>'dicetak'));
		$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $tanggal_data_antrian));
		$this->db->order_by('tb_data_antrian.nomor_data_antrian', 'DESC');
		//$this->db->limit(1);
		$data_antrian = $this->db->get();

		$this->db->from('tb_data_antrian');
		$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $tanggal_data_antrian, 'status_data_antrian'=>'dicetak'));
		$this->db->order_by('tb_data_antrian.nomor_data_antrian', 'ASC');
		$this->db->limit(1);
		$data_antrian2 = $this->db->get();

		$this->db->from('tb_data_antrian');
		$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $tanggal_data_antrian));
		$data_antrian_all = $this->db->get();

		$this->db->select_max('nomor_data_antrian');
		$this->db->from('tb_data_antrian');
		$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $tanggal_data_antrian));
		$data_max_antrian = $this->db->get();

		$data = array(
			'page'=>'operator/panggilan/index',
            'script' => 'operator/panggilan/script',
            'link' => 'panggilan',
			'meja' => $meja,
			'operator' => $operator,
            'data_antrian' => $data_antrian,
			'data_antrian2' => $data_antrian2,
			'data_antrian_all' => $data_antrian_all,
			'data_max_antrian' => $data_max_antrian
		);
		$this->load->view('template/wrapper', $data);
	}

	public function get_counter(){
		$id_meja = $this->session->userdata('id_meja')==''?'1':$this->session->userdata('id_meja');
		$tanggal_data_antrian = date('Y-m-d');
		$this->db->from('tb_data_antrian');
		$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $tanggal_data_antrian));
		$this->db->order_by('tb_data_antrian.nomor_data_antrian', 'ASC');
		$data_antrian = $this->db->get();
		if($data_antrian->num_rows() != 0){
			$arr = array(
				'status' => 'success',
				'text' => $data_antrian->result()
			);
		}else{
			$arr = array(
				'status' => 'failed',
				'text' => 0
			);
		}

		echo json_encode($arr);
	}

	public function antrian_hari_ini(){
		$hari_ini = date('Y-m-d');
		$id_meja = $this->session->userdata('id_meja')==''?'1':$this->session->userdata('id_meja');
		$this->db->from('tb_data_antrian');
		$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $hari_ini));
		$this->db->order_by('tb_data_antrian.nomor_data_antrian', 'ASC');
		$query = $this->db->get();

		if($query->num_rows()==0){
			$r = array(
				'status' => false,
				'data' => 0
			);
			echo json_encode($r);
			exit();
		}else{
			$r = array(
				'status' => true,
				'data' => $query->row()
			);
			echo json_encode($r);
			exit();
		}
	}

	public function nextold(){
		$hari_ini = date('Y-m-d');
		$id_meja = $this->session->userdata('id_meja')==''?'1':$this->session->userdata('id_meja');
		$meja = $this->db->get_where('tb_meja', array('id_meja'=>$this->session->userdata('id_meja')));
		
		$nomor_antrian = $this->input->post('nomor_antrian', true);
		
		$this->db->from('tb_data_antrian');
		$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $hari_ini,  'status_data_antrian'=>'dicetak'));
		$query = $this->db->get();

		if($query->num_rows() == 0){
			$return = array(
				'status' => 'failed',
				'next_antrian' => 0
			);
			echo json_encode($return);exit();
		}else{
			$update = $this->db->update('tb_data_antrian', array('status_data_antrian'=>'selesai dipanggil'), array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $hari_ini, 'nomor_data_antrian'=>$nomor_antrian));
			$this->db->update('tb_data_antrian', array('tanggal_panggil'=>date('Y-m-d H:i:s')), array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $hari_ini, 'nomor_data_antrian'=>$nomor_antrian+1));
			if($update){
				$this->db->select_min('nomor_data_antrian');
				$this->db->from('tb_data_antrian');
				$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $hari_ini, 'status_data_antrian'=>'dicetak'));
				$query_n = $this->db->get();

				if($query_n->num_rows() > 0){
					if($query_n->row()->nomor_data_antrian === NULL){
						$return = array(
							'status' => 'failed',
							'next_antrian' => 0
						);
						echo json_encode($return);exit();
					}else{
						$table = '';
						$no=1;
						$this->db->from('tb_data_antrian');
						$this->db->where(array('id_meja'=>$id_meja, 'tanggal_data_antrian' => $hari_ini,  'status_data_antrian'=>'dicetak'));
						$query2 = $this->db->get();

						foreach($query2->result() as $r_list_antrian){
							if($nomor_antrian+1 != $r_list_antrian->nomor_data_antrian){							
								$stat = $r_list_antrian->status_data_antrian=="dicetak"?"belum dipanggil": $r_list_antrian->status_data_antrian;
								$table .='<tr><td>'.$no.'</td><td>'.$meja->row()->kode_meja.$r_list_antrian->nomor_data_antrian.'</td><td>'.$stat.'</td></tr>';
								$no++;
							}
						}
						$next_antrian = $query_n->row()->nomor_data_antrian;
						$return = array(
							'status' => 'success',
							'next_antrian' => $next_antrian,
							'list_antrian' => $table
						);
						echo json_encode($return);exit();
					}
					
				}else{
					$return = array(
						'status' => 'failed',
						'next_antrian' => 0
					);
					echo json_encode($return);exit();
				}
				
			}else{
				$return = array(
					'status' => 'failed',
					'next_antrian' => 0
				);
				echo json_encode($return);exit();
			}
			
		}

	}

	public function panggil() {
		$hari_ini = date('Y-m-d');
		$id_meja = $this->input->post('id_meja', true);
		$nomor_antrian = $this->input->post('nomor_antrian', true);
	
		// Update status antrian menjadi 'dipanggil', tanpa memeriksa status sebelumnya
		$update = $this->db->update('tb_data_antrian', 
			array('status_data_antrian' => 'dipanggil'), 
			array('id_meja' => $id_meja, 'tanggal_data_antrian' => $hari_ini, 'nomor_data_antrian' => $nomor_antrian)
		);
	
		if ($update) {
			$return = array(
				'status' => 'success',
				'message' => 'Antrian berhasil dipanggil'
			);
		} else {
			$return = array(
				'status' => 'failed',
				'message' => 'Gagal memanggil antrian'
			);
		}
	
		echo json_encode($return);
	}
	
	public function next() {
		$hari_ini = date('Y-m-d');
		$id_meja = $this->input->post('id_meja', true);
		$nomor_antrian = $this->input->post('nomor_antrian', true);
	
		// Update status antrian saat ini menjadi 'selesai dipanggil'
		$this->db->update('tb_data_antrian', 
			array('status_data_antrian' => 'selesai dipanggil'), 
			array('id_meja' => $id_meja, 'tanggal_data_antrian' => $hari_ini, 'nomor_data_antrian' => $nomor_antrian)
		);
	
		// Cari nomor antrian berikutnya
		$this->db->select_min('nomor_data_antrian');
		$this->db->from('tb_data_antrian');
		$this->db->where(array(
			'id_meja' => $id_meja, 
			'tanggal_data_antrian' => $hari_ini, 
			'status_data_antrian' => 'dicetak',
			'nomor_data_antrian >' => $nomor_antrian
		));
		$query = $this->db->get();
	
		if ($query->num_rows() > 0 && $query->row()->nomor_data_antrian !== null) {
			$next_antrian = $query->row()->nomor_data_antrian;
			
			// Update status antrian berikutnya menjadi 'dipanggil'
			$this->db->update('tb_data_antrian', 
				array('status_data_antrian' => 'dipanggil'), 
				array('id_meja' => $id_meja, 'tanggal_data_antrian' => $hari_ini, 'nomor_data_antrian' => $next_antrian)
			);
	
			$return = array(
				'status' => 'success',
				'next_antrian' => $next_antrian,
				'message' => 'Antrian berikutnya berhasil dipanggil'
			);
		} else {
			$return = array(
				'status' => 'finished',
				'message' => 'Tidak ada antrian untuk dipanggil'
			);
		}
	
		echo json_encode($return);
	}

	
}