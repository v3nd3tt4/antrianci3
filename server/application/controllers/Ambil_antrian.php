<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ambil_antrian extends CI_Controller {

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

	public function cetak($uuid_meja){
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
            echo '<script>alert("Gagal, terjadi kesalahan");window.location.href = "' . base_url() .'ambil_antrian";</script>';
            exit();
        }else{
            $data['nomor_antrian']=$meja->row()->kode_meja.$nomor_data_antrian;
            $data['tanggal_data_antrian']=date('Y-m-d');
            $data['id_meja'] = $meja->row()->id_meja;
            $data['nama_meja'] = $meja->row()->keterangan_meja;
        }
		$this->load->view('cetak', $data);
	}

    public function monitoring_daemon_result(){
        $uuid_data_antrian = $this->input->post('id', true);
        $update = $this->db->update('tb_data_antrian', array('status_data_antrian'=>'selesai dipanggil'), array('uuuuid_data_antrianid'=>$uuid_data_antrian));
        if(!$update){
            echo json_encode(array('status'=>0));
        }else{
            echo json_encode(array('status'=>1));
        }
    }
}
