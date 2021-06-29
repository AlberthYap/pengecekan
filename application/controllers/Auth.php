<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('developer');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $data['lokasi'] = 'Login';
            $this->load->view('template/header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->cekLogin($username);


        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($user['active'] == 1) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                        'unit_id' => $user['unit_id'],
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('Developer');
                    } else {
                        redirect('Developer');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username dan Password Salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username dan Password Salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username dan Password Salah</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('unit_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kamu Baru Saja Keluar!
          </div>');
        redirect('auth');
    }

    public function block()
    {
        $data['title'] = 'Block';
        $data['lokasi'] = 'Tamu';
        $this->load->view('template/header', $data);
        $this->load->view('auth/block', $data);
        $this->load->view('template/footer', $data);
    }
}
