<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';

    /**
     * Cari user berdasarkan username
     */
    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row_array();
    }

    /**
     * Verifikasi login (password di-hash dengan password_hash/PHP)
     */
    public function verify_login($username, $password)
    {
        $user = $this->get_by_username($username);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
