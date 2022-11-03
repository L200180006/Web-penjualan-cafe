<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function selling()
    {
        $data['title'] = 'Selling';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $dataList['food_menu'] = $this->db->get('food_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/selling', $dataList);
        $this->load->view('templates/footer');
    }

    public function get_menu_harga()
    {
        $id = $this->input->post('id');
        $this->db->select('id, harga_menu');
        $this->db->from('food_menu');
        $this->db->where('id', $id);
        $query = $this->db->get();

        echo json_encode($query->row_array());
    }

    public function purchasing()
    {
        $data['title'] = 'Purchasing';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $ListData['purchasing'] = $this->db->get('purchasing')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/purchasing', $ListData);
        $this->load->view('templates/footer');
    }

    public function add_purchasing()
    {
        $data['title'] = 'Add Purchasing';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_item', 'Item', 'required|trim');
        $this->form_validation->set_rules('harga_item', 'Price', 'required|trim');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/add_purchasing');
            $this->load->view('templates/footer');
        } else {
            $dataInsert = [
                'nama_item' => $this->input->post('nama_item', true),
                'harga_item' => str_replace(".", "", $this->input->post('harga_item')),
                'tgl_pembelian' => date('Y-m-d'),
            ];

            $this->db->insert('purchasing', $dataInsert);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! New purchasing has been added.</div>');

            redirect('user/purchasing');
        }
    }

    public function edit_purchasing($id)
    {
        $data['title'] = 'Edit Purchasing';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])
            ->row_array();
        $ListData['purchasing'] = $this->db->get_where('purchasing', ['id' => $id])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/edit_purchasing', $ListData);
        $this->load->view('templates/footer');
    }

    public function update_purchasing()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_item', 'Item', 'required|trim');
        $this->form_validation->set_rules('harga_item', 'Price', 'required|trim');
        $dataUpdate = [
            'nama_item' => ($this->input->post('nama_item', true)),
            'harga_item' => str_replace(".", "", $this->input->post('harga_item')),
            'tgl_pembelian' => $this->input->post('tgl_pembelian')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('purchasing', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Purchasing has been changed.</div>');

        redirect('user/purchasing');
    }

    public function delete_purchasing($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('purchasing');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Purchasing has been deleted.</div>');
        redirect('user/purchasing');
    }

    public function laporan()
    {
        $data['title'] = 'Report';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->db->select('p.no_penjualan, f.nama_menu, p.tgl_penjualan');
        $this->db->from('penjualan p');
        $this->db->join('detail_penjualan', 'p.id = detail_penjualan.penjualan_id');
        $this->db->join('food_menu f', 'f.id = detail_penjualan.food_menu_id');
        $this->db->order_by('p.tgl_penjualan', 'ASC');
        $this->db->limit(10);
        $data['penjualan'] = $this->db->get()->result_array();

        $this->db->select('p.*');
        $this->db->from('purchasing p');
        $this->db->order_by('p.tgl_pembelian', 'ASC');
        $this->db->limit(10);
        $data['purchasing'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/report', $data);
        $this->load->view('templates/footer');
    }

    public function report_byDate()
    {
        $data['title'] = 'Report';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->db->select_sum('harga_item');
        $this->db->from('purchasing');
        $this->db->where('tgl_pembelian BETWEEN "' . date('Y-m-d', strtotime($this->input->post('tgl_awal')))
            . '" and "' . date('Y-m-d', strtotime($this->input->post('tgl_akhir'))) . '"');
        $data['total_purchasing'] = $this->db->get()->row_array();

        $this->db->select_sum('total');
        $this->db->from('penjualan');
        $this->db->where('tgl_penjualan BETWEEN "' . date('Y-m-d', strtotime($this->input->post('tgl_awal')))
            . '" and "' . date('Y-m-d', strtotime($this->input->post('tgl_akhir'))) . '"');
        $data['total_penjualan'] = $this->db->get()->row_array();

        $this->db->select('p.no_penjualan, f.nama_menu, p.tgl_penjualan');
        $this->db->from('penjualan p');
        $this->db->join('detail_penjualan', 'p.id = detail_penjualan.penjualan_id');
        $this->db->join('food_menu f', 'f.id = detail_penjualan.food_menu_id');
        $this->db->where('tgl_penjualan BETWEEN "' . date('Y-m-d', strtotime($this->input->post('tgl_awal')))
            . '" and "' . date('Y-m-d', strtotime($this->input->post('tgl_akhir'))) . '"');
        $this->db->order_by('p.tgl_penjualan', 'ASC');
        $data['penjualan'] = $this->db->get()->result_array();

        $this->db->select('p.*');
        $this->db->from('purchasing p');
        $this->db->where('tgl_pembelian BETWEEN "' . date('Y-m-d', strtotime($this->input->post('tgl_awal')))
            . '" and "' . date('Y-m-d', strtotime($this->input->post('tgl_akhir'))) . '"');
        $this->db->order_by('p.tgl_pembelian', 'ASC');
        $data['purchasing'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/report_byDate', $data);
        $this->load->view('templates/footer');
    }
}
