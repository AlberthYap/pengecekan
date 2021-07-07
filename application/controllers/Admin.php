<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Developer_model');
        $this->load->model('User_model');
    }

    // Registrasi User
    public function cekUsername()
    {

        $data['user'] = $this->User_model->sessionUser()->row_array();

        if ($data['user']['role_id'] == 1) {
            $unitnya = htmlspecialchars($this->input->post('id_unit', true));
        } else {
            $unitnya = $data['user']['unit_id'];
        }

        $unit = $this->Developer_model->getUnitById($unitnya);

        $username = strtolower($unit['kode_unit'] . str_replace(' ', '', htmlspecialchars($this->input->post('username', true))));

        $cek = $this->Developer_model->cekUsername($username);
        if ($cek > 0) {
            $this->form_validation->set_message('Username Telah Terdaftar');
            return false;
        } else {
            return TRUE;
        }
    }

    public function index()
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();
        $data['unit'] = $this->Developer_model->getUnit();
        $data['role'] = $this->Developer_model->getRole();

        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim|callback_cekUsername',
            ['cekUsername' => 'Username Telah Terdaftar']
        );
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


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi User';
            $data['lokasi'] = 'Registrasi User';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/registrasi', $data);
            $this->load->view('template/footer', $data);
        } else {
            if ($data['user']['role_id'] == 1) {
                $unitnya = htmlspecialchars($this->input->post('id_unit', true));
            } else {
                $unitnya = $data['user']['unit_id'];
            }

            $unit = $this->Developer_model->getUnitById($unitnya);

            $username = strtolower($unit['kode_unit'] . str_replace(' ', '', htmlspecialchars($this->input->post('username', true))));
            $data = [
                'username' => $username,
                'nama_depan' => htmlspecialchars($this->input->post('nDepan', true)),
                'nama_belakang' => htmlspecialchars($this->input->post('nBelakang', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nohp' => htmlspecialchars($this->input->post('nohp', true)),
                'foto_user' => 'default.png',
                'unit_id' => $unitnya,
                'role_id' => htmlspecialchars($this->input->post('id_role', true)),
                'active' => 1,
            ];

            $insert = $this->Developer_model->insertAdmin($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil Membuat User Baru! Username : <b>' . $username . ' </b>
            </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal Membuat User baru
            </div>');
            }
            redirect('admin');
        }
    }

    // Data User

    public function datauser()
    {
        $data['title'] = 'Data User';
        $data['lokasi'] = 'Data User';
        $data['user'] = $this->User_model->sessionUser()->row_array();

        $data['userJoin'] = $this->Admin_model->getUserJoin();
        $data['role'] = $this->Developer_model->getRole();
        $data['unit'] = $this->Developer_model->getUnit();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/datauser', $data);
        $this->load->view('template/footer', $data);
    }

    public function editdatauser()
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();

        $current_password = $this->input->post('password');

        if (!password_verify($current_password, $data['user']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         Password Anda Salah
       </div>');
            redirect('admin/datauser');
        } else {
            $id = $this->input->post('id');
            $old_password = $this->Admin_model->getPass($id);
            $pass1 = $this->input->post('password1');
            $pass2 = $this->input->post('password2');

            if (!empty($pass1) && !empty($pass2)) {
                $passwordBaru = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            } else {
                $passwordBaru = $old_password['password'];
            }


            $fotolama = $this->Admin_model->getFoto($id);
            $old_image = $fotolama['foto_user'];
            $upload_image = $_FILES['foto']['name'];

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
                    redirect('admin/datauser');
                }
            } else {
                $new_image = $old_image;
            }

            $data = [
                'nama_depan' => $this->input->post('nama'),
                'nama_belakang' => $this->input->post('namabel'),
                'unit_id' => $this->input->post('unit_id'),
                'role_id' => $this->input->post('role_id'),
                'nohp' => $this->input->post('nohp'),
                'foto_user' => $new_image,
                'password' => $passwordBaru,
            ];

            $insert = $this->Admin_model->editdatauser($data, $id);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                     Berhasil Mengubah Data User!
                 </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Gagal Mengubah Data User!
                 </div>');
            }
            redirect('admin/datauser');
        }
    }

    public function hapususer()
    {

        $data['user'] = $this->User_model->sessionUser()->row_array();

        $current_password = $this->input->post('password');

        if (!password_verify($current_password, $data['user']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         Password Anda Salah Tidak Dapat Menghapus User
       </div>');
            redirect('admin/datauser');
        } else {
            $id = $this->input->post('id');
            if (isset($_POST['deactive'])) {
                $delete = $this->Admin_model->hapusUser($id);
                if ($delete) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Berhasil Menghapus User!
                     </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         Gagal Menghapus User!
                     </div>');
                }
            } elseif (isset($_POST['active'])) {
                $aktif = $this->Admin_model->activeUser($id);
                if ($aktif) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Berhasil Mengaktifkan User!
                     </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         Gagal Mengaktifkan User!
                     </div>');
                }
            }

            redirect('admin/datauser');
        }
    }
}
