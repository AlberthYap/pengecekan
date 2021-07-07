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
    }

    // Registrasi Admin
    public function cekUsername()
    {
        $unit = $this->Developer_model->getUnitById($this->input->post('id_unit'));

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

        $data['user'] = $this->User_model->sessionUser()->row_array();
        $data['unit'] = $this->Developer_model->getUnit();

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi Admin';
            $data['lokasi'] = 'Registrasi Admin';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('developer/registrasi', $data);
            $this->load->view('template/footer', $data);
        } else {
            $unit = $this->Developer_model->getUnitById($this->input->post('id_unit'));

            $username = strtolower($unit['kode_unit'] . str_replace(' ', '', htmlspecialchars($this->input->post('username', true))));

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
					Berhasil Membuat User Baru! Username : <b>' . $username . ' </b>
				</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Membuat User baru
				</div>');
            }
            redirect('developer');
        }
    }

    // Menu Management
    public function menu()
    {

        $data['user'] = $this->User_model->sessionUser()->row_array();

        $data['menu'] = $this->Developer_model->getMenu()->result_array();

        $this->form_validation->set_rules('menu', 'menu', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Menu Management';
            $data['lokasi'] = 'Menu';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'menu' => $this->input->post('menu'),
            ];

            $insert = $this->Developer_model->insertMenu($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Berhasil Membuat Menu Baru!
					</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Gagal Membuat Menu baru!
					</div>');
            }
            redirect('developer/menu');
        }
    }

    public function subMenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['lokasi'] = 'Menu';
        $data['user'] = $this->User_model->sessionUser()->row_array();

        $data['subMenu'] = $this->Developer_model->getSubMenu();
        $data['menu'] = $this->Developer_model->getMenu()->result_array();

        $this->form_validation->set_rules('sub', 'sub', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');
        $this->form_validation->set_rules('menu_id', 'menu_id', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('menu/sub_menu', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'sub' => $this->input->post('sub'),
                'icon' => $this->input->post('icon'),
                'menu_id' => $this->input->post('menu_id'),
                'tipe' => $this->input->post('tipe'),
            ];


            $insert = $this->Developer_model->insertsub($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Berhasil Membuat Sub Menu Baru!
					</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Gagal Membuat Sub Menu Baru!
					</div>');
            }
            redirect('developer/subMenu');
        }
    }

    public function isiMenu()
    {
        $data['title'] = 'Isi Sub Menu Management';
        $data['lokasi'] = 'Menu';
        $data['user'] = $this->User_model->sessionUser()->row_array();

        $data['isiMenu'] = $this->Developer_model->getIsiMenu();
        $data['submenu'] = $this->Developer_model->getSub()->result_array();

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('sub_id', 'sub_id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('menu/isi_sub_menu', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'sub_id' => $this->input->post('sub_id'),
            ];

            $insert = $this->Developer_model->insertIsi($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Berhasil Membuat Isi Sub Menu Baru!
					</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Gagal Membuat Isi Sub Menu Baru!
					</div>');
            }
            redirect('developer/isiMenu');
        }
    }

    public function hapusMenu($id)
    {
        $insert = $this->Developer_model->hapusMenu($id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Berhasil Menghapus Menu!
	</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		Gagal Menghapus Menu!
	</div>');
        }

        redirect('developer/menu');
    }

    public function hapusSub($id)
    {
        $insert = $this->Developer_model->hapusSub($id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Berhasil Menghapus Sub Menu!
	</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		Gagal Menghapus Sub Menu!
	</div>');
        }
        redirect('developer/submenu');
    }

    public function hapusIsi($id)
    {
        $insert = $this->Developer_model->hapusIsi($id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Berhasil Menghapus Isi Sub Menu!
	</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		Gagal Menghapus Isi Sub Menu!
	</div>');
        }
        redirect('developer/isiMenu');
    }


    public function editMenu()
    {
        $id = $this->input->post('id');
        $data = [
            'menu' => $this->input->post('menu'),


        ];
        $insert = $this->Developer_model->editMenu($data, $id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Mengubah Menu!
				</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Mengubah Menu!
				</div>');
        }

        redirect('developer/menu');
    }

    public function editsub()
    {
        $id = $this->input->post('id');
        $data = [
            'sub' => $this->input->post('sub'),
            'icon' => $this->input->post('icon'),
            'menu_id' => $this->input->post('menu_id'),
            'tipe' => $this->input->post('tipe')
        ];
        $insert = $this->Developer_model->editSub($data, $id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Mengubah Sub Menu!
				</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Mengubah Sub Menu!
				</div>');
        }
        redirect('developer/submenu');
    }

    public function editisi()
    {
        $id = $this->input->post('id');
        $data = [
            'title' => $this->input->post('isi'),
            'url' => $this->input->post('url'),
            'sub_id' => $this->input->post('sub_id')

        ];
        $insert = $this->Developer_model->editIsi($data, $id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Mengubah Isi Sub Menu!
				</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Mengubah Isi Sub Menu!
				</div>');
        }
        redirect('developer/isimenu');
    }

    // role

    public function role()
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();
        $data['role'] = $this->Developer_model->getRole();

        $this->form_validation->set_rules('role', 'role', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Role';
            $data['lokasi'] = 'Role (Developer)';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('role/role', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = ['nama_role' => $this->input->post('role')];

            $insert = $this->Developer_model->insertRole($data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Membuat Role Baru!
				</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Membuat Role baru!
				</div>');
            }
            redirect('developer/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();

        $dataa = ['id_role' => $role_id];
        $data['role'] = $this->Developer_model->getRoleById($dataa);


        $data['menu'] = $this->Developer_model->getMenuE()->result_array();

        $data['title'] = 'Role';
        $data['lokasi'] = 'Role (Developer)';
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('role/role-access', $data);
        $this->load->view('template/footer', $data);
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->Developer_model->getAccess($data);

        if ($result->num_rows() < 1) {
            $insert = $this->Developer_model->insertAccess($data);
        } else {
            $insert = $this->Developer_model->deleteAccess($data);
        }

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Berhasil Mengubah User Access!
			</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Gagal Mengubah User Access!
			</div>');
        }
    }

    public function editrole()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_role' => $this->input->post('role')
        ];
        $insert = $this->Developer_model->editRole($data, $id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Mengubah Role!
				</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Mengubah Role!
				</div>');
        }
        redirect('developer/role');
    }

    public function hapusrole($id)
    {
        $delete = $this->Developer_model->hapusRole($id);

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Menghapus Role!
				</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Menghapus Role!
				</div>');
        }
        redirect('developer/role');
    }

    // Unit

    public function unit()
    {
        $data['user'] = $this->User_model->sessionUser()->row_array();
        $data['unit'] = $this->Developer_model->getUnit();

        $this->form_validation->set_rules('unit', 'Nama Unit', 'required');
        $this->form_validation->set_rules(
            'kode_unit',
            'Kode Unit',
            'required|trim|is_unique[unit.kode_unit]',
            ['is_unique' => 'Kode Unit Telah Terdaftar!']
        );


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Unit';
            $data['lokasi'] = 'Unit';
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('developer/unit', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('unit')),
                'kode_unit' => strtoupper(htmlspecialchars($this->input->post('kode_unit'))),
            ];

            $insert = $this->Developer_model->insertUnit($data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Membuat Unit Baru!
				</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Membuat Unit baru!
				</div>');
            }
            redirect('developer/unit');
        }
    }

    public function editunit()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_unit' => $this->input->post('unit'),
            'kode_unit' => strtoupper(htmlspecialchars($this->input->post('kode_unit'))),
        ];
        $insert = $this->Developer_model->editUnit($data, $id);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Mengubah Unit!
				</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Mengubah Unit!
				</div>');
        }
        redirect('developer/Unit');
    }

    public function hapusUnit($id)
    {
        $delete = $this->Developer_model->hapusUnit($id);

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Berhasil Menghapus Unit!
				</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gagal Menghapus Unit!
				</div>');
        }
        redirect('developer/unit');
    }
}
