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
		$url_api = $this->config->item('base_url_api');
		$param = 'api/getMeja';
		// persiapkan curl
		$ch = curl_init(); 

		// set url 
		curl_setopt($ch, CURLOPT_URL, $url_api.$param);
	
		// return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
		// $output contains the output string 
		$output = curl_exec($ch); 
	
		// tutup curl 
		curl_close($ch);     
		
		// Decode JSON ke array PHP
		$data = json_decode($output, true);
		$data = array(
			'page'=>'ambil_antrian',
			'link' => 'ambil_antrian',
			'meja' => $data
		);
		$this->load->view('template/wrapper', $data);
	}

	public function cetak($uuid_meja){
		$url_api = $this->config->item('base_url_api');
		$param = 'api/cetakAntrian/'.$uuid_meja;
		// persiapkan curl
		$ch = curl_init(); 

		// set url 
		curl_setopt($ch, CURLOPT_URL, $url_api.$param);
	
		// return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
		// $output contains the output string 
		$output = curl_exec($ch); 
	
		// tutup curl 
		curl_close($ch);     
		
		// Decode JSON ke array PHP
		$data = json_decode($output, true);

		// Ambil data antrian
		$nomor_antrian = $data['data']['nomor_antrian'];
		$tanggal_antrian = $data['data']['tanggal_data_antrian'];
		$id_meja = $data['data']['id_meja'];
		$nama_meja = $data['data']['nama_meja'];

		// Parameter untuk script Python
		$printer_name = $this->config->item('printer_name'); // Ganti dengan nama printer Anda

		// Perintah untuk menjalankan script Python
		$python_script = $this->config->item('python_script');
		$python_path = $this->config->item('python_path');
		var_dump($data);
		// $command = escapeshellcmd("$python_path \"$python_script\" \"$printer_name\" \"$nomor_antrian\" \"$nama_meja\"");


		// // Debugging: tampilkan perintah yang dijalankan
		// echo "<pre>Command to execute:\n$command\n</pre>";

		// // Menjalankan perintah
		// exec($command . ' 2>&1', $output, $return_var);

		// // Menampilkan output dan kode keluar
		// echo "<pre>Output:\n";
		// print_r($output);
		// echo "Return code: $return_var</pre>";

		// // Menampilkan pesan error jika ada
		// if ($return_var != 0) {
		// 	echo "<pre>Error occurred:\n";
		// 	echo implode("\n", $output);
		// 	echo "</pre>";
		// }
	}
}