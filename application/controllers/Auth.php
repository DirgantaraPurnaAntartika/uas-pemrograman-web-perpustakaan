<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
    }

    /**
     * Halaman login + proses login
     */
    public function login()
    {
        // Jika sudah login, langsung ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('buku');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Login - Perpustakaan Buku Digital';
            $this->load->view('auth/login', $data);
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->User_model->verify_login($username, $password);

            if ($user) {
                // Set data session
                $session_data = [
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'name'       => $user['name'],
                    'logged_in'  => TRUE,
                ];
                $this->session->set_userdata($session_data);

                $this->session->set_flashdata('success', 'Login berhasil. Selamat datang, ' . $user['name'] . '!');
                redirect('buku');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('auth/login');
            }
        }
    }

    /**
     * Logout dan hancurkan session
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
