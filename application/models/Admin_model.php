<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getUserUnit($unit)
    {
        $query = "SELECT * FROM `user` 
        INNER JOIN `unit` ON `user`.`unit_id` = `unit`.`id_unit` 
        INNER JOIN `user_role` ON `user_role`.`id_role` = `user`.`role_id`
        WHERE `user`.`unit_id` = $unit
        ";

        return $this->db->query($query)->result_array();
    }

    public function getuser()
    {
        return $this->db->get('user');
    }

    public function getUserJoin()
    {
        $query = "SELECT * FROM `user` 
        INNER JOIN `unit` ON `user`.`unit_id` = `unit`.`id_unit` 
        INNER JOIN `user_role` ON `user_role`.`id_role` = `user`.`role_id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function getPass($id)
    {
        $query = "SELECT `password` FROM `user` WHERE `id_user` = $id";
        return $this->db->query($query)->row_array();
    }

    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id_user' => $id]);
    }

    public function ubahPassword($pass, $id)
    {
        $this->db->set('password', $pass);
        $this->db->where('id_user', $id);
        return $this->db->update('user');
    }

    public function editdatauser($data, $id)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('user', $data);
    }

    public function hapusUser($id)
    {
        $this->db->set('active', 0);
        $this->db->where('id_user', $id);
        return $this->db->update('user');
    }

    public function activeUser($id)
    {
        $this->db->set('active', 1);
        $this->db->where('id_user', $id);
        return $this->db->update('user');
    }

    public function getFoto($id)
    {
        $query = "SELECT `foto_user` from user where `id_user` = $id";
        return $this->db->query($query)->row_array();
    }
}
