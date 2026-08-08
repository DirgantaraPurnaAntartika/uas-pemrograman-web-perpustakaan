<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller
 * Controller dasar yang menangani pengecekan session login.
 * Semua controller yang membutuhkan autentikasi harus extend class ini.
 */
class MY_Controller extends CI_Controller
{
    protected $logged_in_user = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        // Jika belum login, redirect ke halaman login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->logged_in_user = [
            'id'       => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'name'     => $this->session->userdata('name'),
        ];

        // Data yang selalu tersedia di semua view yang extend controller ini
        $this->data['logged_in_user'] = $this->logged_in_user;
    }
}
