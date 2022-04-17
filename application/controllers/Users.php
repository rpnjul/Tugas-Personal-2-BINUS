<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			return $this->load->view('login_form');
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if($this->auth_model->login($email, $password)){
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan email dan password benar!');
		}

		$this->load->view('login');
	}

	public function register()
	{

	}

	public function logout()
	{
		$this->auth_model->logout();
		redirect('/');
	}
}
