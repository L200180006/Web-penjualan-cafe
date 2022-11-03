<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
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
		$data['title'] = 'Selling History';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$this->db->select('p.*, u.name');
		$this->db->from('penjualan p');
		$this->db->join('user u', 'u.id = p.user_id');
		$this->db->order_by('p.id', 'DESC');
		$data['penjualan'] = $this->db->get()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('penjualan_user/index', $data);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bayar', 'Cash', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cash field must be filled.</div>');
			redirect('user/selling');
		} else {
			$data = [
				'no_penjualan' => $this->input->post('no_penjualan'),
				'user_id' => $this->input->post('user_id'),
				'tgl_penjualan' => $this->input->post('tgl_penjualan'),
				'jam_penjualan' => $this->input->post('jam_penjualan'),
				'id_menu' => $this->input->post('id_menu'),
				'jumlah' => $this->input->post('jumlah'),
				'harga_menu' => $this->input->post('harga_menu'),
				'bayar' => str_replace(".", "", $this->input->post('bayar'))

			];


			$total = 0;
			foreach ($data['id_menu'] as $key => $value) {
				$total += $data['harga_menu'][$key] * $data['jumlah'][$key];
			}

			$kembalian = ($data['bayar'] >= $total) ? ($data['bayar'] - $total) : 0;

			$this->db->insert('penjualan', [
				'no_penjualan' => $data['no_penjualan'],
				'user_id' => $data['user_id'],
				'tgl_penjualan' => $data['tgl_penjualan'],
				'jam_penjualan' => $data['jam_penjualan'],
				'total' => $total,
				'bayar' => $data['bayar'],
				'kembalian' => $kembalian,
			]);

			$penjualan_id = $this->db->insert_id();

			foreach ($data['id_menu'] as $key => $value) {
				$this->db->insert('detail_penjualan', [
					'penjualan_id' => $penjualan_id,
					'food_menu_id' => $data['id_menu'][$key],
					'jumlah' => $data['jumlah'][$key],
					'harga_menu' => $data['harga_menu'][$key],
					'sub_total' => $data['harga_menu'][$key] * $data['jumlah'][$key],
				]);
			}

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selling has been created.</div>');
			redirect('penjualan');
		}
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
		$this->load->view('penjualan_user/show', $data);
		$this->load->view('templates/footer');
	}

	public function mpdf()
	{
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [80, 236]]);

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

		$data = $this->load->view('pdf/struk', $data, TRUE);;
		$mpdf->WriteHTML($data);
		$mpdf->Output();
	}
}

