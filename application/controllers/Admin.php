<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function user_list()
    {
        $data['title'] = 'User List';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userListdata['user'] = $this->db->get('user')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user_list', $userListdata);
        $this->load->view('templates/footer');
    }

    public function add_user()
    {
        $data['title'] = 'Add User';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/add_user');
            $this->load->view('templates/footer');
        } else {
            $dataInsert = [
                'name' => ($this->input->post('name', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'role_id' => 2,
                'date_created' => time()
            ];

            $this->db->insert('user', $dataInsert);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Account has been created.</div>');

            redirect('admin/user_list');
        }
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Account has been deleted.</div>');
        redirect('admin/user_list');
    }

    public function edit_user($id)
    {
        $data['title'] = 'Edit User';


        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])
            ->row_array();
        $userListdata['user'] = $this->db->get_where('user', ['id' => $id])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_user', $userListdata);
        $this->load->view('templates/footer');
    }

    public function update_user()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|');
        $dataUpdate = [
            'name' => ($this->input->post('name', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'role_id' => ($this->input->post('role_id', true))
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Account has been changed.</div>');

        redirect('admin/user_list');
    }

    public function add_menu()
    {
        $data['title'] = 'Add Menu';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_menu', 'Menu', 'required|trim|is_unique[food_menu.nama_menu]', [
            'is_unique' => 'This menu has already exist!'

        ]);
        $this->form_validation->set_rules('harga_menu', 'Price', 'required|trim|min_length[3]', [
            'required' => 'Price must be filled!',
            'min_length' => 'Price can not be 0!'

        ]);

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/add_menu');
            $this->load->view('templates/footer');
        } else {
            $dataInsert = [
                'nama_menu' => htmlspecialchars($this->input->post('nama_menu', true)),
                'harga_menu' => str_replace(".", "", $this->input->post('harga_menu'))
            ];

            $this->db->insert('food_menu', $dataInsert);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! New menu has been added.</div>');

            redirect('admin/menu_list');
        }
    }

    public function menu_list()
    {
        $data['title'] = 'Menu List';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('*');
        $this->db->from('food_menu');
        $this->db->order_by('nama_menu', 'ASC');
        $menuListData['food_menu'] = $this->db->get()->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu_list', $menuListData);
        $this->load->view('templates/footer');
    }

    public function edit_menu($id)
    {
        $data['title'] = 'Edit Menu';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])
            ->row_array();
        $menuListData['food_menu'] = $this->db->get_where('food_menu', ['id' => $id])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_menu', $menuListData);
        $this->load->view('templates/footer');
    }

    public function update_menu()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_menu', 'Menu', 'required|trim');

        $dataUpdate = [
            'nama_menu' => ($this->input->post('nama_menu', true)),
            'harga_menu' => str_replace(".", "", $this->input->post('harga_menu'))
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('food_menu', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Menu has been changed.</div>');

        redirect('admin/menu_list');
    }

    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('food_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been deleted.</div>');
        redirect('admin/menu_list');
    }

    public function achievement()
    {
        $data['title'] = 'Selling Achievement';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('p.*, u.name');
        $this->db->from('penjualan p');
        $this->db->join('user u', 'u.id = p.user_id');
        $this->db->order_by('p.id', 'DESC');
        $data['penjualan'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Selling Detail';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('p.*, u.name');
        $this->db->from('penjualan p');
        $this->db->join('user u', 'u.id = p.user_id');
        $this->db->where('p.id', $id);
        $data['penjualan'] = $this->db->get()->row_array();

        $penjualan_id = $data['penjualan']['id'];
        $this->db->select('d.*, f.nama_menu');
        $this->db->from('detail_penjualan d');
        $this->db->join('food_menu f', 'f.id = d.food_menu_id');
        $this->db->where('d.penjualan_id', $penjualan_id);
        $data['detail_penjualan'] = $this->db->get()->result_array();

        // echo json_encode($data['penjualan']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/show', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Selling Edit';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('p.*, u.name');
        $this->db->from('penjualan p');
        $this->db->join('user u', 'u.id = p.user_id');
        $this->db->where('p.id', $id);
        $data['penjualan'] = $this->db->get()->row_array();

        $penjualan_id = $data['penjualan']['id'];
        $this->db->select('d.*, f.nama_menu');
        $this->db->from('detail_penjualan d');
        $this->db->join('food_menu f', 'f.id = d.food_menu_id');
        $this->db->where('d.penjualan_id', $penjualan_id);
        $data['detail_penjualan'] = $this->db->get()->result_array();

        $data['food_menu'] = $this->db->get('food_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

        $this->db->where('id', $id);
        $this->db->delete('penjualan');

        $this->db->where('penjualan_id', $id);
        $this->db->delete('detail_penjualan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selling has been deleted.</div>');
        redirect('admin/achievement');
    }
}
