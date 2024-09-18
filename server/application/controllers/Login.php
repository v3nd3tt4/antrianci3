<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		
		$this->load->view('login');
	}

    public function proses_login(){
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $cek = $this->db->get_where('tb_operator', array('username'=>$username));
        if($cek->num_rows() == 0){
            echo '<script>alert("Username tidak ditemukan");window.location.href = "' . base_url() .'login";</script>';
            exit();
        }else{
            $cek_pwd = password_verify($password,$cek->row()->password);
            if(!$cek_pwd){
                echo '<script>alert("Password salah");window.location.href = "' . base_url() .'login";</script>';
                exit();
            }else{
                if($cek->row()->level == 'admin'){
                    $sess = array(
                        'login' => true,
                        'id_meja' => $cek->row()->id_meja,
                        'nama_operator' => $cek->row()->nama_operator,
                        'username' => $cek->row()->username,
                        'level' => $cek->row()->level
                    );
                    $this->session->set_userdata($sess);
                    echo '<script>alert("Login berhasil, sedang dialihkan");window.location.href = "' . base_url() .'admin/operator";</script>';
                    exit();
                }else{
                    $sess = array(
                        'login' => true,
                        'id_meja' => $cek->row()->id_meja,
                        'nama_operator' => $cek->row()->nama_operator,
                        'username' => $cek->row()->username,
                        'level' => $cek->row()->level
                    );
                    $this->session->set_userdata($sess);
                    echo '<script>alert("Login berhasil, sedang dialihkan");window.location.href = "' . base_url() .'operator/panggilan";</script>';
                    exit();
                }
            }
        }
    }

    public function proses_logout(){
		session_destroy();
		// $this->session->sess_destroy();
		echo '<script>alert("Logout berhasil, sedang dialhkan....");window.location.href = "' . base_url() . 'login";</script>';
	}

	
}
