<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();


        $data['title'] = 'Profile View';
        $data['lokasi'] = 'Profile';
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function edit()
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();


        $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|trim');
        $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required|trim');
        $this->form_validation->set_rules('nohp', 'NO HP', 'required|trim');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profile';
            $data['lokasi'] = 'Profile';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/footer', $data);
        } else {
            $namaDepan = $this->input->post('nama_depan');
            $namaBelakang = $this->input->post('nama_belakang');
            $username = $this->input->post('username');
            $nohp = $this->input->post('nohp');
            $email = $this->input->post('email');

            // mengecek gambar yang diakan diupload
            $upload_image = $_FILES['foto']['name'];
            $old_image = $data['user']['foto_user'];

            if ($upload_image == true) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/avatar/';

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto')) {
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/avatar/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->image_autorotate->resizeFoto($new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user/edit');
                }
            } else {
                $new_image = $old_image;
            }

            $data = [
                'nama_depan' => $namaDepan,
                'nama_belakang' => $namaBelakang,
                'foto_user' => $new_image,
                'nohp' => $nohp,
                'email' => $email
            ];

            $insert = $this->User_model->editProfile($data, $username);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Mengubah Profile!
				</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal mengubah Profile!
				</div>');
            }

            redirect('user/edit');
        }
    }

    public function password()
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();


        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim|min_length[3]');
        $this->form_validation->set_rules(
            'password_baru1',
            'Password Baru',
            'required|trim|min_length[3]|matches[password_baru2]',
            [
                'matches' => 'Password Baru Tidak Sama',
                'min_length' => 'Password Terlalu Pendek'
            ]
        );
        $this->form_validation->set_rules('password_baru2', 'Password Baru Ulang', 'required|trim|min_length[3]|matches[password_baru1]');



        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ubah Password';
            $data['lokasi'] = 'Profile';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/password', $data);
            $this->load->view('template/footer', $data);
        } else {
            $current_password = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Password Sekarang Salah
		  </div>');
                redirect('user/password');
            } else {
                if ($current_password == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Password Baru Tidak Bisa Sama Dengan Password Sekarang
		  </div>');
                    redirect('user/password');
                } else {
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $ses = $this->session->userdata('username');

                    $insert = $this->User_model->ubahPassword($password_hash, $ses);

                    if ($insert) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
							Berhasil Mengubah Password!
						</div>');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
							Gagal Mengubah Password!
						</div>');
                    }
                    redirect('user/password');
                }
            }
        }
    }
}
