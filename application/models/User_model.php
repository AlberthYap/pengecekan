<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function cekLogin($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }

    public function sessionUser()
    {
        return $this->db->get_where('user', ['username' => $this->session->userdata('username')]);
    }

    public function editProfile($data, $username)
    {
        $this->db->where('username', $username);
        return $this->db->update('user', $data);
    }

    public function ubahPassword($pass, $ses)
    {
        $this->db->set('password', $pass);
        $this->db->where('username', $ses);
        return $this->db->update('user');
    }
}
