<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan();
    }
    public function index()
    {
        $data['title'] = 'About';
        $id = $this->session->userdata('id');
        $data['detail'] = $this->db->query("SELECT * FROM login, pelanggan WHERE id = '$id' AND login.email = pelanggan.email")->result();
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/tentang', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function ubah()
    {
        $data['title'] = 'Ubah data';
        $id = $this->session->userdata('id');
        $data['detail'] = $this->db->query("SELECT * FROM login, pelanggan WHERE id = '$id' AND login.email = pelanggan.email")->result();
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/ubah', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function aksi_ubah()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->ubah();
        } else {
            $id_pelanggan = $this->session->userdata('id_pelanggan');
            $id = $this->session->userdata('id');
            $nama_akun = htmlspecialchars($this->input->post('nama_akun', true));
            $alamat_distrik = htmlspecialchars($this->input->post('alamat_distrik', true));
            $alamat_jalan = htmlspecialchars($this->input->post('alamat_jalan', true));
            $nm_hp =  htmlspecialchars($this->input->post('nm_hp', true));
            //  KTP
            $ktp = $_FILES['ktp']['name'];
            if ($ktp) {
                $config['upload_path'] = './assets/upload/pelanggan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('ktp')) {
                    $ktp = $this->upload->data('file_name');
                    $this->db->set('ktp', $ktp);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            //SIUP
            $foto = $_FILES['foto']['name'];
            if ($foto) {
                $config['upload_path'] = './assets/upload/pelanggan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                    $this->db->set('foto', $foto);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data1 = array(
                'nama'              => $nama_akun,
                'alamat_distrik'    => $alamat_distrik,
                'alamat_jalan'      => $alamat_jalan,
                'nm_hp'             => $nm_hp,
            );

            $id_pelanggan2 = array(
                'id_pelanggan' => $id_pelanggan
            );

            $this->sewa_model->update_data($data1, 'pelanggan', $id_pelanggan2);
            $this->db->set('nama_akun', $nama_akun);
            $this->db->where('id', $id);
            $this->db->update('login');

            $this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> Data tempat penyewaan berhasil diubah ! </div>');
            redirect('depan/beranda');
        }
    }
    public function _rules()
    {
        $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required');
        $this->form_validation->set_rules('alamat_distrik', 'Alamat Distrik', 'required');
        $this->form_validation->set_rules('alamat_jalan', 'Alamat Jalan', 'required');
        $this->form_validation->set_rules('nm_hp', 'Nomor Handphone', 'required|integer|callback_nm_hp_check');
        $this->form_validation->set_message('matches', '%s tidak sama, silahkan diisi dengan benar !');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi !');
        $this->form_validation->set_message('integer', '%s harus angka, silahkan diisi dengan benar!');
        $this->form_validation->set_message('min_length', '%s terlalu pendek!');
    }
    public function nm_hp_check()
    {
        $post = $this->input->post(null, TRUE);
        $id = $this->session->userdata('id_pelanggan');

        $query = $this->db->query("SELECT * FROM tempat_sewa, pelanggan WHERE tempat_sewa.nm_hp = '$post[nm_hp]' OR pelanggan.nm_hp = '$post[nm_hp]' AND pelanggan.id_pelanggan != '$id' ");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('nm_hp_check', '%s sudah ada, silahkan diganti!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function password()
    {
        $data['title'] = 'Ubah data';
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/password');
        $this->load->view('tamplates_depan/footer');
    }
    public function aksi_ubah_password()
    {
        $email = $this->session->userdata('email');
        $data = $this->db->query("SELECT * FROM login WHERE email = '$email' ")->row_array();
        $password = $this->input->post('password_lama');
        if (password_verify($password, $data['password'])) {
            $this->form_validation->set_rules('passwordbaru1', 'Password', 'required|min_length[8]|matches[passwordbaru2]');
            $this->form_validation->set_rules('passwordbaru2', 'Password', 'required|min_length[8]');
            $this->form_validation->set_message('matches', '%s tidak sama, silahkan diisi dengan benar !');
            $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi !');
            $this->form_validation->set_message('min_length', '%s terlalu pendek!');
            if ($this->form_validation->run() == FALSE) {
                $this->password();
            } else {
                $passwordbaru = password_hash($this->input->post('passwordbaru1'), PASSWORD_DEFAULT);
                $data = [
                    'password' => $passwordbaru
                ];
                $id = [
                    'email' => $email
                ];
                $this->sewa_model->update_data($data, 'login', $id);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Password berhasil diubah !
            </div>');
                redirect('depan/beranda');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password lama salah !</div>');
            redirect('depan/about/password');
        }
    }
    public function tentang_tempat($id)
    {
        $data['title'] = 'Detail Tempat Penyewaan';
        $data['detail'] = $this->db->query("SELECT * FROM tempat_sewa WHERE id_tempat = '$id'")->result();
        // $data['paket'] = $this->db->query("SELECT * FROM paket WHERE ")
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/tempat', $data);
        $this->load->view('tamplates_depan/footer');
    }
}
