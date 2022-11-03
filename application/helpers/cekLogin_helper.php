<?php

function cek_login()
{
    $cek = get_instance();
    if (!$cek->session->userdata('username')) {
        redirect('auth');
    } else {
        $role_id = $cek->session->userdata('role_id');
        $menu = $cek->uri->segment(1);

        $queryMenu = $cek->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        $userAccess = $cek->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
