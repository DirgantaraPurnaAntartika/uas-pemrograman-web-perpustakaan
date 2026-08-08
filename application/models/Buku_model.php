<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model
{
    protected $table = 'buku';

    /**
     * Hitung total data buku, mendukung pencarian (untuk pagination)
     */
    public function count_all($keyword = '')
    {
        if (!empty($keyword)) {
            $this->apply_search($keyword);
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Ambil data buku dengan limit/offset (untuk pagination) + search
     */
    public function get_paginated($limit, $offset, $keyword = '')
    {
        if (!empty($keyword)) {
            $this->apply_search($keyword);
        }

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table, $limit, $offset);
        return $query->result_array();
    }

    /**
     * Terapkan filter pencarian ke query builder (judul, penulis, penerbit, kategori)
     */
    private function apply_search($keyword)
    {
        $this->db->group_start();
        $this->db->like('judul', $keyword);
        $this->db->or_like('penulis', $keyword);
        $this->db->or_like('penerbit', $keyword);
        $this->db->or_like('kategori', $keyword);
        $this->db->group_end();
    }

    /**
     * Ambil satu buku berdasarkan ID
     */
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    /**
     * Tambah buku baru (Create)
     */
    public function insert($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update buku (Update)
     */
    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Hapus buku (Delete)
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
