<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserAdmin_model');
	}

	public function index()
	{
		redirect('auth/login');
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Auth');
		} else {
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$auth = $this->UserAdmin_model->login($username, $password);
			if ($auth) {

				$array = array(
					'id' => $auth->id_user,
					'level' => $auth->level_user,
					'nama_admin' => $auth->nama_user
				);

				$this->session->set_userdata($array);

				if ($auth->level_user == '1') {
					redirect('admin/dashboard');
				} else if ($auth->level_user == '2') {
					//
				}
			} else {
				$this->session->set_flashdata('error', 'Username dan Password Salah!!!');
				redirect('auth/login');
			}
		}
	}
	public function logout()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('nama_admin');
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Anda Berhasil Logout!');
		redirect('auth/login');
	}
}

/* End of file Auth.php */
