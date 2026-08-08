<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends MY_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct(); // cek session login di MY_Controller
        $this->load->model('Buku_model');
        $this->load->library(['form_validation', 'pagination']);
        $this->load->helper(['url', 'form']);
    }

    /**
     * READ - List data buku dengan Search & Pagination
     */
    public function index()
    {
        $keyword = $this->input->get('keyword', TRUE);
        $keyword = $keyword ? trim($keyword) : '';

        $per_page    = 5; // jumlah data per halaman
        $page_number = (int) $this->input->get('per_page');
        $offset      = $page_number ? $page_number : 0;

        $total_rows = $this->Buku_model->count_all($keyword);

        // Konfigurasi pagination CodeIgniter
        $config['base_url']   = base_url('buku/index');
        $config['total_rows'] = $total_rows;
        $config['per_page']   = $per_page;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'per_page';

        // Styling pagination (bootstrap-like)
        $config['full_tag_open']  = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link']     = 'Awal';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close']= '</li>';
        $config['last_link']      = 'Akhir';
        $config['last_tag_open']  = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link']      = 'Berikutnya';
        $config['next_tag_open']  = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link']      = 'Sebelumnya';
        $config['prev_tag_open']  = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open']   = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']  = '</span></li>';
        $config['num_tag_open']   = '<li class="page-item">';
        $config['num_tag_close']  = '</li>';
        $config['attributes']     = ['class' => 'page-link'];

        // Jika ada keyword, tambahkan sebagai query string tambahan di URL pagination
        if (!empty($keyword)) {
            $config['suffix'] = '&keyword=' . urlencode($keyword);
        }

        $this->pagination->initialize($config);

        $this->data['buku_list']  = $this->Buku_model->get_paginated($per_page, $offset, $keyword);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['keyword']    = $keyword;
        $this->data['total_rows'] = $total_rows;
        $this->data['title']      = 'Daftar Buku - Perpustakaan Digital';

        $this->load->view('templates/header', $this->data);
        $this->load->view('buku/index', $this->data);
        $this->load->view('templates/footer');
    }

    /**
     * CREATE - Form tambah buku
     */
    public function create()
    {
        $this->form_validation->set_rules('judul', 'Judul Buku', 'required|trim|min_length[2]');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required|trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim');
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|greater_than_equal_to[0]');

        if ($this->form_validation->run() === FALSE) {
            $this->data['title'] = 'Tambah Buku - Perpustakaan Digital';
            $this->load->view('templates/header', $this->data);
            $this->load->view('buku/create', $this->data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'judul'        => $this->input->post('judul', TRUE),
                'penulis'      => $this->input->post('penulis', TRUE),
                'penerbit'     => $this->input->post('penerbit', TRUE),
                'tahun_terbit' => $this->input->post('tahun_terbit', TRUE),
                'kategori'     => $this->input->post('kategori', TRUE),
                'stok'         => $this->input->post('stok', TRUE),
                'sinopsis'     => $this->input->post('sinopsis', TRUE),
            ];

            $this->Buku_model->insert($data);
            $this->session->set_flashdata('success', 'Buku berhasil ditambahkan.');
            redirect('buku');
        }
    }

    /**
     * UPDATE - Form edit buku
     */
    public function edit($id)
    {
        $buku = $this->Buku_model->get_by_id($id);

        if (!$buku) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan.');
            redirect('buku');
        }

        $this->form_validation->set_rules('judul', 'Judul Buku', 'required|trim|min_length[2]');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required|trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim');
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|greater_than_equal_to[0]');

        if ($this->form_validation->run() === FALSE) {
            $this->data['title'] = 'Edit Buku - Perpustakaan Digital';
            $this->data['buku']  = $buku;
            $this->load->view('templates/header', $this->data);
            $this->load->view('buku/edit', $this->data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'judul'        => $this->input->post('judul', TRUE),
                'penulis'      => $this->input->post('penulis', TRUE),
                'penerbit'     => $this->input->post('penerbit', TRUE),
                'tahun_terbit' => $this->input->post('tahun_terbit', TRUE),
                'kategori'     => $this->input->post('kategori', TRUE),
                'stok'         => $this->input->post('stok', TRUE),
                'sinopsis'     => $this->input->post('sinopsis', TRUE),
            ];

            $this->Buku_model->update($id, $data);
            $this->session->set_flashdata('success', 'Buku berhasil diperbarui.');
            redirect('buku');
        }
    }

    /**
     * DELETE - Hapus buku
     */
    public function delete($id)
    {
        $buku = $this->Buku_model->get_by_id($id);

        if (!$buku) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan.');
        } else {
            $this->Buku_model->delete($id);
            $this->session->set_flashdata('success', 'Buku berhasil dihapus.');
        }

        redirect('buku');
    }

    /**
     * DETAIL - Lihat detail buku
     */
    public function detail($id)
    {
        $buku = $this->Buku_model->get_by_id($id);

        if (!$buku) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan.');
            redirect('buku');
        }

        $this->data['title'] = 'Detail Buku - Perpustakaan Digital';
        $this->data['buku']  = $buku;
        $this->load->view('templates/header', $this->data);
        $this->load->view('buku/detail', $this->data);
        $this->load->view('templates/footer');
    }
}
