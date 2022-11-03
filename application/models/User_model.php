<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function getUserById($id)
    {
        $this->db->get_where('user', ['id' => $id])->row_array();
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function cariReport($data)
    {
        //$this->db->from('purchasing');
        //$this->db->where('tgl_pembelian >=', $this->input->post('tgl_awal'));
        //$this->db->where('tgl_pembelian <=', $this->input->post('tgl_akhir'));
        //$queryPurchasing = $this->db->get();
        //return $queryPurchasing->result();

        $this->db->from('penjualan');
        $this->db->where('tgl_penjualan >=', $this->input->post('tgl_awal'));
        $this->db->where('tgl_penjualan <=', $this->input->post('tgl_akhir'));
        $queryPenjualan = $this->db->get();
        return $queryPenjualan->result();
    }
}
