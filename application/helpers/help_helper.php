<?php
function is_logged_in()
{

    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role_id  = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $querymenu = $ci->db->get_where('user_menu', ['nama_menu' => $menu])->row_array();
        $menu_id = $querymenu['id_menu'];

        $userAccess = $ci->db->get_where('user_access', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/block');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access');

    if ($result->num_rows() > 0) {
        return "checked = 'checked'";
    }
}
