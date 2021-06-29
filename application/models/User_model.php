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
}
