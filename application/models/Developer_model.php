<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Developer_model extends CI_Model
{
    // unit
    public function getUnit()
    {
        $query = "SELECT * FROM `unit`";

        return $this->db->query($query)->result_array();
    }

    public function getUnitById($id)
    {
        $query = "SELECT * FROM `unit` WHERE `id_unit` = $id ";

        return $this->db->query($query)->row_array();
    }

    public function insertUnit($data)
    {
        return $this->db->insert('unit', $data);
    }

    public function editUnit($data, $id)
    {
        $this->db->where('id_unit', $id);
        return $this->db->update('unit', $data);
    }

    public function hapusUnit($id)
    {
        $this->db->where('id_unit', $id);
        return $this->db->delete('unit');
    }

    public function cekUsername($data)
    {
        $query = "SELECT * FROM `user` where `username` = '" . $data . "'";
        return $this->db->query($query)->num_rows();
    }

    // Registrasi
    public function insertAdmin($data)
    {
        return $this->db->insert('user', $data);
    }

    // Menu Management
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.* , `user_menu`.`menu`
		FROM `user_sub_menu` JOIN `user_menu`
		ON `user_sub_menu`.`menu_id` = `user_menu`.`id_menu`
		 ";

        return $this->db->query($query)->result_array();
    }

    public function getIsiMenu()
    {
        $query = "SELECT `user_isi`.*, `user_sub_menu`.`sub`
		FROM `user_isi` JOIN `user_sub_menu`
		ON `user_isi`.`sub_id` = `user_sub_menu`.`id_sub`
		";

        return $this->db->query($query)->result_array();
    }

    public function getMenu()
    {
        return $this->db->get('user_menu');
    }

    public function getSub()
    {
        return $this->db->get('user_sub_menu');
    }

    public function insertMenu($data)
    {
        return $this->db->insert('user_menu', $data);
    }
    public function insertsub($data)
    {
        return $this->db->insert('user_sub_menu', $data);
    }

    public function insertIsi($data)
    {
        return $this->db->insert('user_isi', $data);
    }

    public function hapusMenu($id)
    {
        $this->db->where('id_menu', $id);
        return $this->db->delete('user_menu');
    }

    public function hapusSub($id)
    {
        $this->db->where('id_sub', $id);
        return $this->db->delete('user_sub_menu');
    }

    public function hapusIsi($id)
    {
        $this->db->where('id_isi', $id);
        return $this->db->delete('user_isi');
    }

    public function editMenu($data, $id)
    {
        $this->db->where('id_menu', $id);
        return $this->db->update('user_menu', $data);
    }

    public function editSub($data, $id)
    {
        $this->db->where('id_sub', $id);
        return $this->db->update('user_sub_menu', $data);
    }

    public function editIsi($data, $id)
    {
        $this->db->where('id_isi', $id);
        return $this->db->update('user_isi', $data);
    }

    // Role

    public function hapusRole($id)
    {
        $this->db->where('id_role', $id);
        return $this->db->delete('user_role');
    }

    public function getRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function editRole($data, $id)
    {
        $this->db->where('id_role', $id);
        return $this->db->update('user_role', $data);
    }

    public function insertRole($data)
    {
        return $this->db->insert('user_role', $data);
    }

    public function getRoleById($data)
    {

        return $this->db->get_where('user_role', $data)->row_array();
    }


    // Access
    public function getMenuE()
    {
        $query = "
		SELECT * FROM `user_menu` where `id_menu` != 1 and `id_menu` != 2
		";
        return $this->db->query($query);
    }

    public function getAccess($data)
    {
        return $this->db->get_where('user_access', $data);
    }

    public function insertAccess($data)
    {
        return $this->db->insert('user_access', $data);
    }

    public function deleteAccess($data)
    {
        return $this->db->delete('user_access', $data);
    }
}
