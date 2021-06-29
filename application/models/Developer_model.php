<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Developer_model extends CI_Model
{
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

    public function insertAdmin($data)
    {
        return $this->db->insert('user', $data);
    }
}
