<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
			'page'=>'ambil_antrian',
			'link' => 'ambil_antrian',
			'meja' => $meja
		);
		$this->load->view('template/wrapper', $data);
	}

    public function getMeja(){
        $meja= $this->db->get('tb_meja');
        if($meja->num_rows() > 0){
            $result = array(
                'response' => 200,
                'message' => 'data meja ditemukan',
                'data' => $meja->result()
            );
        }else{
            $result = array(
                'response' => 404,
                'message' => 'data meja tidak ditemukan',
                'data' => ''
            );
        }
        echo json_encode($result);
    }
	
	private function sendWebSocketData($nomor_antrian, $id_meja)
    {
        $socketData = [
            'name' => $nomor_antrian,
            'message' => 'belum dipanggil',
            'id_meja' => $id_meja
        ];

        // Kirim data ke WebSocket server
        // Anda perlu mengimplementasikan logika pengiriman data ke server WebSocket di sini
        // Contoh menggunakan library cURL:
        $ch = curl_init('http://192.168.56.130:3000/emit');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($socketData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);
    }

    public function cetakAntrian($uuid_meja){
        $meja = $this->db->get_where('tb_meja', array('uuid_meja'=>$uuid_meja));

        $today = date('Y-m-d');
        $data_antrian = $this->db->get_where('tb_data_antrian', array('id_meja'=>$meja->row()->id_meja, 'tanggal_data_antrian'=>$today));

        if($data_antrian->num_rows() == 0){
            $nomor_antrian = 1;
        }else{
        // else if($data_antrian->num_rows() <=9){
            $this->db->select_max('nomor_data_antrian');
            $this->db->from('tb_data_antrian');
            $this->db->where(array('id_meja'=>$meja->row()->id_meja, 'tanggal_data_antrian'=>$today));
            $max = $this->db->get();
            // var_dump($this->db->last_query());exit();
            $nomor_antrian = $max->row()->nomor_data_antrian + 1;
        }
        
        // $nomor_data_antrian = str_pad($nomor_antrian, 3, "0", STR_PAD_LEFT);
        $nomor_data_antrian = $nomor_antrian;
        $data_to_save['nomor_data_antrian'] = $nomor_data_antrian;
        $data_to_save['id_meja'] = $meja->row()->id_meja;
        $data_to_save['uuid_data_antrian'] = get_kode(50);
        $data_to_save['tanggal_data_antrian'] = date('Y-m-d');
        $data_to_save['status_data_antrian'] = 'dicetak';

        $simpan = $this->db->insert('tb_data_antrian', $data_to_save);
        if(!$simpan){
			$result = array(
				'response' => 404,
				'message' => 'data antrian tidak ditemukan',
				'data' => ''
			);
		} else {
			$nomor_antrian = $meja->row()->kode_meja.$nomor_data_antrian;
			$data['nomor_antrian'] = $nomor_antrian;
			$data['tanggal_data_antrian'] = date('Y-m-d');
			$data['id_meja'] = $meja->row()->id_meja;
			$data['nama_meja'] = $meja->row()->keterangan_meja;
			
			// Kirim data ke WebSocket
			$this->sendWebSocketData($nomor_antrian, $meja->row()->id_meja);

			$result = array(
				'response' => 200,
				'message' => 'data antrian ditemukan',
				'data' => $data
			);
		}

		echo json_encode($result);

    }
}