<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['title'] = 'Masuk';
        if ($this->session->userdata('hak_akses') == 1) {
            redirect('admin/dashboard');
        } elseif ($this->session->userdata('hak_akses') == 2) {
            redirect('tempat-sewa/dashboard');
        } elseif ($this->session->userdata('hak_akses') == 3) {
            redirect('depan/beranda');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi !');
        $this->form_validation->set_message('valid_email', '%s silahkan diisi dengan benar!');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Masuk';
            $this->load->view('tamplates_admin/header', $data);
            $this->load->view('login');
            $this->load->view('tamplates_admin/footer');
        } else {
            $this->_masuk();
        }
    }
    public function _masuk()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $login = $this->db->get_where('login', ['email' => $email])->row_array();
        $tempat_sewa = $this->db->get_where('tempat_sewa', ['email' => $email])->row_array();
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $email])->row_array();
        if ($login) {
            if ($login['status_aktivasi'] == 1) {
                if (password_verify($password, $login['password'])) {
                    $data = [
                        'email' => $login['email'],
                        'hak_akses'  => $login['hak_akses'],
                        'nama' => $login['nama_akun'],
                        'id' => $login['id'],
                        'validasi' => $login['status_validasi'],
                    ];
                    if ($login['hak_akses'] == 1) {
                        $this->session->set_userdata($data);
                        redirect('admin/dashboard');
                    } elseif ($login['hak_akses'] == 2 and $tempat_sewa) {
                        $id_tempat = $tempat_sewa['id_tempat'];
                        $nama = $tempat_sewa['nama'];
                        $data = $data;
                        $this->session->set_userdata('id_tempat', $id_tempat);
                        $this->session->set_userdata('nama', $nama);
                        $this->session->set_userdata($data);
                        redirect('tempat-sewa/dashboard');
                    } elseif ($login['hak_akses'] == 3 and $pelanggan) {
                        $id_pelanggan = $pelanggan['id_pelanggan'];
                        $nama = $pelanggan['nama'];
                        $data = $data;
                        $this->session->set_userdata('id_pelanggan', $id_pelanggan);
                        $this->session->set_userdata('nama', $nama);
                        $this->session->set_userdata($data);
                        redirect('depan/beranda');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email ini belum diaktivasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email ini tidak terdaftar!</div>');
            redirect('auth');
        }
    }
    public function daftar()
    {
        $data['title'] = 'Daftar';
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('daftar');
        $this->load->view('tamplates_admin/footer');
    }
    public function daftar_tempat_penyewaan()
    {
        $data['title'] = 'Daftar';
        $data['kode'] = $this->kode_model->kd_tempat_terakhir()->row();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('daftar_tempat');
        $this->load->view('tamplates_admin/footer');
    }
    public function daftar_pelanggan()
    {
        $data['title'] = 'Daftar';
        $data['kode'] = $this->kode_model->kd_pelanggan_terakhir()->row();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('daftar_pelanggan');
        $this->load->view('tamplates_admin/footer');
    }
    public function aksi_daftar_tempat()
    {

        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->daftar_tempat_penyewaan();
        } else {
            $id_tempat = htmlspecialchars($this->input->post('id_tempat', true));
            $nama = htmlspecialchars($this->input->post('nama', true));
            $alamat_distrik = htmlspecialchars($this->input->post('alamat_distrik', true));
            $alamat_jalan = htmlspecialchars($this->input->post('alamat_jalan', true));
            $nm_hp =  htmlspecialchars($this->input->post('nm_hp', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $peta_google = htmlspecialchars($this->input->post('peta_google', true));
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            // Upload KTP
            $ktp = $_FILES['ktp']['name'];
            if ($ktp == '') {
            } else {
                $config['upload_path'] = './assets/upload/tempat-penyewaan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                // $config['max_size'] = '2048';
                $config['file_name'] = 'kt-' . date('ymd') . '-' . substr(md5(rand()), 0, 6);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('ktp')) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>KTP gagal diupload!</div>');
                    redirect('auth/daftar_tempat_penyewaan');
                } else {
                    $ktp = $this->upload->data('file_name');
                }
            }

            // Upload SIUP
            $siup = $_FILES['siup']['name'];
            if ($siup == '') {
            } else {
                $config['upload_path'] = './assets/upload/tempat-penyewaan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                // $config['max_size'] = '2048';
                $config['file_name'] = 'sp-' . date('ymd') . '-' . substr(md5(rand()), 0, 6);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('siup')) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>SIUP gagar diupload!</div>');
                    redirect('auth/daftar_tempat_penyewaan');
                } else {
                    $siup = $this->upload->data('file_name');
                }
            }

            // Upload Logo 
            $logo = $_FILES['logo']['name'];
            if ($logo == '') {
            } else {
                $config['upload_path'] = './assets/upload/tempat-penyewaan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $config['file_name'] = 'lg-' . date('ymd') . '-' . substr(md5(rand()), 0, 6);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>logo gagar diupload!</div>');
                    redirect('auth/daftar_tempat_penyewaan');
                } else {
                    $logo = $this->upload->data('file_name');
                }
            }

            $data1 = array(
                'id_tempat'         => $id_tempat,
                'nama_tempat'              => $nama,
                'alamat_distrik'    => $alamat_distrik,
                'alamat_jalan'      => $alamat_jalan,
                'nm_hp'             => $nm_hp,
                'email'             => $email,
                'ktp'               => $ktp,
                'siup'              => $siup,
                'peta_google'       => $peta_google,
                'logo'              => $logo,
            );
            $data2 = array(
                'email'             => $email,
                'nama_akun'         => $nama,
                'password'          => $password,
                'hak_akses'         => '2',
                'status_aktivasi'   => '0',
                'status_validasi'   => '0',

            );
            // Buat token
            $token = base64_encode(random_bytes(32));

            $user_token = [
                'email' => $this->input->post('email'),
                'token' => $token,
                'tgl_daftar' => date('Y-m-d')
            ];
            $this->sewa_model->insert_data($user_token, 'token_daftar');
            $this->_kirimEmail($token, 'verify');
            $this->sewa_model->insert_data($data2, 'login');
            $this->sewa_model->insert_data($data1, 'tempat_sewa');
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>Selamat anda berhasil daftar, silahkan cek email anda untuk melakukan aktivasi ! </div>');
            redirect('auth');
        }
    }

    public function aksi_daftar_pelanggan()
    {

        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->daftar_pelanggan();
        } else {
            $id_pelanggan = htmlspecialchars($this->input->post('id_pelanggan', true));
            $nama = htmlspecialchars($this->input->post('nama', true));
            $alamat_distrik = htmlspecialchars($this->input->post('alamat_distrik', true));
            $alamat_jalan = htmlspecialchars($this->input->post('alamat_jalan', true));
            $nm_hp =  htmlspecialchars($this->input->post('nm_hp', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            // Upload KTP
            $ktp = $_FILES['ktp']['name'];
            if ($ktp == '') {
            } else {
                $config['upload_path'] = './assets/upload/pelanggan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                // $config['max_size'] = '2048';
                $config['file_name'] = 'pl-' . date('ymd') . '-' . substr(md5(rand()), 0, 6);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('ktp')) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>KTP gagar diupload!</div>');
                    redirect('auth/daftar_pelanggan');
                } else {
                    $ktp = $this->upload->data('file_name');
                }
            }

            // Upload foto
            $foto = $_FILES['foto']['name'];
            if ($foto == '') {
            } else {
                $config['upload_path'] = './assets/upload/pelanggan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $config['file_name'] = 'pl-' . date('ymd') . '-' . substr(md5(rand()), 0, 6);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>Foto Profile gagar diupload!</div>');
                    redirect('auth/daftar_pelanggan');
                } else {
                    $foto = $this->upload->data('file_name');
                }
            }

            $data1 = array(
                'id_pelanggan'      => $id_pelanggan,
                'nama'              => $nama,
                'alamat_distrik'    => $alamat_distrik,
                'alamat_jalan'      => $alamat_jalan,
                'nm_hp'             => $nm_hp,
                'email'             => $email,
                'ktp'               => $ktp,
                'foto'              => $foto,
            );
            $data2 = array(
                'email'             => $email,
                'nama_akun'              => $nama,
                'password'          => $password,
                'hak_akses'         => '3',
                'status_aktivasi'   => '0',
                'status_validasi'   => '0',

            );
            // Buat token
            $token = base64_encode(random_bytes(32));

            $user_token = [
                'email' => $this->input->post('email'),
                'token' => $token,
                'tgl_daftar' => date('Y-m-d')
            ];
            $this->sewa_model->insert_data($user_token, 'token_daftar');
            $this->_kirimEmail($token, 'verify');
            $this->sewa_model->insert_data($data2, 'login');
            $this->sewa_model->insert_data($data1, 'pelanggan');
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>Selamat anda berhasil daftar, silahkan cek email anda untuk melakukan aktivasi ! </div>');
            redirect('auth');
        }
    }


    private function _kirimEmail($token, $type)
    {

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'penyewaanta@gmail.com',
            'smtp_pass' => '1122334455Ta',
            'smtp_port' =>  465,
            'mailtype' =>  'html',
            'charset' =>  'utf-8',
            'newline'   => "\r\n"
        ];
        $this->email->initialize($config);
        $this->email->from('penyewaanta@gmail.com', 'Sistem Informasi Penyewaan');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link ini untuk verifikasi akun anda : <a href = "' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifasi</a>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');

        $token = $this->input->get('token');

        $user = $this->db->get_where('login', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token_daftar', ['token' => $token])->row_array();

            if ($user_token) {
                if ($user_token['tgl_daftar'] == date('Y-m-d')) {
                    $this->db->set('status_aktivasi', 1);
                    $this->db->where('email', $email);
                    $this->db->update('login');
                    $where = array('email' => $email);
                    $this->sewa_model->delete_data($where, 'token_daftar');
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">' . $email . ' telah aktif ! Silahkan login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('pelanggan', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktifasi akun gagal! Token expired.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktifasi akun gagal! Token tidak valid.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktifasi akun gagal! Email salah.</div>');
            redirect('auth');
        }
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }


    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat_distrik', 'Alamat Distrik', 'required');
        $this->form_validation->set_rules('alamat_jalan', 'Alamat Jalan', 'required');
        $this->form_validation->set_rules('nm_hp', 'Nomor Handphone', 'required|integer|callback_nm_hp_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check|callback_login_check');
        $this->form_validation->set_rules('password', 'password', 'required|matches[ulangi_password]|min_length[8]');
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required');
        $this->form_validation->set_message('matches', '%s tidak sama, silahkan diisi dengan benar !');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi !');
        $this->form_validation->set_message('integer', '%s harus angka, silahkan diisi dengan benar!');
        $this->form_validation->set_message('valid_email', '%s salah, silahkan diisi dengan benar!');
        $this->form_validation->set_message('min_length', '%s terlalu pendek!');
    }
    public function nm_hp_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tempat_sewa WHERE nm_hp = '$post[nm_hp]' ");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('nm_hp_check', '%s sudah ada, silahkan diganti!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function email_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tempat_sewa WHERE email = '$post[email]' ");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_check', '%s sudah ada, silahkan diganti!');
            return FALSE;
        } else {
            return TRUE;
        }
        $query = $this->db->query("SELECT * FROM pelanggan WHERE email = '$post[email]' ");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_check', '%s sudah ada, silahkan diganti!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function login_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM login WHERE email = '$post[email]' ");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('login_check', '%s sudah ada, silahkan diganti!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function keluar()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda telah keluar!</div>');
        redirect('auth');
    }
}
