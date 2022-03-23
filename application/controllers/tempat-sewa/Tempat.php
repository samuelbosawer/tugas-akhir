<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tempat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_tempat_sewa();
    }
    public function index()
    {
        $data['title'] = 'Data Tempat Penyewaan';
        $id = $this->session->userdata('id_tempat');
        $data['detail'] = $this->db->query("SELECT * FROM login, tempat_sewa WHERE tempat_sewa.id_tempat = '$id' AND login.email = tempat_sewa.email")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/data-tempat', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function ubah_data()
    {
        $data['title'] = 'Ubah Data Tempat Penyewaan';
        $id = $this->session->userdata('id_tempat');
        $data['detail'] = $this->db->query("SELECT * FROM login, tempat_sewa WHERE tempat_sewa.id_tempat = '$id' AND login.email = tempat_sewa.email")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/ubah-data-tempat', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function aksi_ubah_data()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->ubah_data();
        } else {
            $id_tempat = htmlspecialchars($this->input->post('id_tempat', true));
            $id = htmlspecialchars($this->input->post('id', true));
            $nama_tempat = htmlspecialchars($this->input->post('nama_tempat', true));
            $alamat_distrik = htmlspecialchars($this->input->post('alamat_distrik', true));
            $alamat_jalan = htmlspecialchars($this->input->post('alamat_jalan', true));
            $nm_hp =  htmlspecialchars($this->input->post('nm_hp', true));
            $peta_google = htmlspecialchars($this->input->post('peta_google', true));
            //  KTP
            $ktp = $_FILES['ktp']['name'];
            if ($ktp) {
                $config['upload_path'] = './assets/upload/tempat-penyewaan';
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
            $siup = $_FILES['siup']['name'];
            if ($siup) {
                $config['upload_path'] = './assets/upload/tempat-penyewaan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('siup')) {
                    $siup = $this->upload->data('file_name');
                    $this->db->set('siup', $siup);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // Logo 
            $logo = $_FILES['logo']['name'];
            if ($logo) {
                $config['upload_path'] = './assets/upload/tempat-penyewaan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('logo')) {
                    $logo = $this->upload->data('file_name');
                    $this->db->set('logo', $logo);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data1 = array(
                'nama_tempat'       => $nama_tempat,
                'alamat_distrik'    => $alamat_distrik,
                'alamat_jalan'      => $alamat_jalan,
                'nm_hp'             => $nm_hp,
                'peta_google'       => $peta_google,
            );

            $id_tempat2 = array(
                'id_tempat' => $id_tempat
            );

            $this->sewa_model->update_data($data1, 'tempat_sewa', $id_tempat2);
            $this->db->set('nama_akun', $nama_tempat);
            $this->db->where('id', $id);
            $this->db->update('login');

            $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> Data tempat penyewaan berhasil diubah ! </div>');
            redirect('tempat-sewa/tempat');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_tempat', 'Nama Tempat', 'required');
        $this->form_validation->set_rules('alamat_distrik', 'Alamat Distrik', 'required');
        $this->form_validation->set_rules('alamat_jalan', 'Alamat Jalan', 'required');
        $this->form_validation->set_rules('nm_hp', 'Nomor Handphone', 'required|integer|callback_nm_hp_check');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi !');
        $this->form_validation->set_message('integer', '%s harus angka, silahkan diisi dengan benar!');
        $this->form_validation->set_message('valid_email', '%s salah, silahkan diisi dengan benar!');
        $this->form_validation->set_message('min_length', '%s terlalu pendek!');
    }

    public function nm_hp_check()
    {
        $post = $this->input->post(null, TRUE);
        $id = $this->session->userdata('id_tempat');
        $query = $this->db->query("SELECT * FROM tempat_sewa, pelanggan WHERE  pelanggan.nm_hp = '$post[nm_hp]' OR tempat_sewa.nm_hp = '$post[nm_hp]' AND tempat_sewa.id_tempat != '$id' ");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('nm_hp_check', '%s sudah ada, silahkan diganti!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function password()
    {
        $data['title'] = 'Ubah Password';
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/ubah-password');
        $this->load->view('tamplates_admin/footer');
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
                Password admin berhasil diubah !
            </div>');
                redirect('tempat-sewa/tempat/password');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password lama salah !</div>');
            redirect('tempat-sewa/tempat/password');
        }
    }
}
