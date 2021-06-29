<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Developer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Developer_model');
        $this->load->model('User_model');
        // $this->load->model('Admin_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('nDepan', 'Nama Depan', 'required|trim');
        $this->form_validation->set_rules('nBelakang', 'Nama Belakang', 'required|trim');
        $this->form_validation->set_rules('nohp', 'NO HP', 'required|trim');
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches' => 'Password Tidak Sama',
                'min_length' => 'Password Terlalu Pendek'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

        $data['user'] = $this->User_model->sessionUser()->row_array();
        $data['unit'] = $this->Developer_model->getUnit();



        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi User';
            $data['lokasi'] = 'Registrasi';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('developer/registrasi', $data);
            $this->load->view('template/footer', $data);
        } else {
            $unit = $this->Developer_model->getUnitById($this->input->post('id_unit'));

            $username = $unit['kode_unit'] . substr(htmlspecialchars($this->input->post('nDepan', true)), 0, 1) . substr(htmlspecialchars($this->input->post('nBelakang', true)), 0, 3);

            $data = [
                'username' => $username,
                'nama_depan' => htmlspecialchars($this->input->post('nDepan', true)),
                'nama_belakang' => htmlspecialchars($this->input->post('nBelakang', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nohp' => htmlspecialchars($this->input->post('nohp', true)),
                'foto_user' => 'default.png',
                'unit_id' => htmlspecialchars($this->input->post('id_unit', true)),
                'role_id' => 2,
                'active' => 1,
            ];

            $insert = $this->Developer_model->insertAdmin($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Membuat User Baru!
				</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Membuat User baru
				</div>');
            }
            redirect('developer');
        }
    }
}
