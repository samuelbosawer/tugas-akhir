<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_admin();
    }
    public function index()
    {
        redirect('admin/dashboard');
    }
    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['tempat'] = count($this->db->query("SELECT * FROM tempat_sewa")->result());
        $data['pelanggan'] = count($this->db->query("SELECT * FROM pelanggan")->result());
        $data['tempat_login'] = $this->db->query("SELECT * FROM login WHERE hak_akses = '2' AND status_validasi = '0' ORDER BY id DESC")->result();
        $data['pelanggan_login'] = $this->db->query("SELECT * FROM login WHERE hak_akses = '3' AND status_validasi = '0'  ORDER BY id DESC")->result();

        $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan WHERE pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function data_ts()
    {
        $data['title'] = 'Data Tempat Penyewaan';
        $data['login'] = $this->db->query("SELECT * FROM login WHERE hak_akses = '2' ORDER BY id DESC")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/data-ts', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function validasi_ts($id)
    {
        $data['title'] = 'validasi';
        $data['detail'] = $this->db->query("SELECT * FROM login, tempat_sewa WHERE id = '$id' AND login.email = tempat_sewa.email")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/validasi-ts', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function aksivalidasi_ts()
    {
        $id = $this->input->post('id');
        $validasi = $this->input->post('validasi');
        if ($validasi == 1) {
            $query = "UPDATE login SET status_validasi = '$validasi' WHERE id = '$id' ";
            $hasil = $this->db->query($query);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Akun sudah divalidasi !</div>');
            redirect('admin/data_ts');
        } else {
            $query = "UPDATE login SET status_validasi = '$validasi' WHERE id = '$id' ";
            $hasil = $this->db->query($query);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">validasi telah dimatikan !</div>');
            redirect('admin/data_ts');
        }
    }

    public function data_pelanggan()
    {
        $data['title'] = 'Data Pelanggan';
        $data['login'] = $this->db->query("SELECT * FROM login WHERE hak_akses = '3' ORDER BY id DESC")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/data-pelanggan', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function validasi_pelanggan($id)
    {
        $data['title'] = 'validasi';
        $data['detail'] = $this->db->query("SELECT * FROM login, pelanggan WHERE id = '$id' AND login.email = pelanggan.email")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/validasi-pelanggan', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function aksivalidasi_pelanggan()
    {
        $id = $this->input->post('id');
        $validasi = $this->input->post('validasi');
        if ($validasi == 1) {
            $query = "UPDATE login SET status_validasi = '$validasi' WHERE id = '$id' ";
            $hasil = $this->db->query($query);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Akun sudah divalidasi !</div>');
            redirect('admin/data_pelanggan');
        } else {
            $query = "UPDATE login SET status_validasi = '$validasi' WHERE id = '$id' ";
            $hasil = $this->db->query($query);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">validasi telah dimatikan !</div>');
            redirect('admin/data_pelanggan');
        }
    }
    public function data()
    {
        $data['title'] = 'Data Admin';
        $email = $this->session->userdata('email');
        $data['detail'] = $this->db->query("SELECT * FROM login WHERE email = '$email' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/data-admin', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function ubahdata()
    {
        $data['title'] = 'Ubah Data Admin';
        $email = $this->session->userdata('email');
        $data['detail'] = $this->db->query("SELECT * FROM login WHERE email = '$email' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/ubah-data-admin', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function aksi_ubah_admin()
    {
        $this->form_validation->set_rules('nama_akun', 'Nama akun', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi !');
        $this->form_validation->set_message('valid_email', '%s salah, silahkan diisi dengan benar!');
        if ($this->form_validation->run() == FALSE) {
            $this->ubahdata();
        } else {
            $id         = $this->input->post('id');
            $nama_akun  = $this->input->post('nama_akun');
            $email  = $this->input->post('email');

            $data = [
                'nama_akun'     => $nama_akun,
                'email'         => $email
            ];
            $id = array('id'              => $id);
            $this->sewa_model->update_data($data, 'login', $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data admin berhasil diubah !
        </div>
');
            redirect('admin/data');
        }
    }
    public function password()
    {
        $data['title'] = 'Ubah Password';
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/ubah-password');
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
                redirect('admin/data');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password lama salah !</div>');
            redirect("admin/password");
        }
    }

    public function delete_ts($id)
    {
        $data = $this->db->query("SELECT * FROM login WHERE id = '$id' ")->row_array();
        $email = $data['email'];
        $where = array('email' => $email);
        $this->sewa_model->delete_data($where, 'tempat_sewa');
        $this->sewa_model->delete_data($where, 'login');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Data berhasil dihapus !
        </div>');
        redirect('admin/data_ts');
    }

    public function delete_pel($id)
    {
        $data = $this->db->query("SELECT * FROM login WHERE id = '$id' ")->row_array();
        $email = $data['email'];
        $where = array('email' => $email);
        $this->sewa_model->delete_data($where, 'pelanggan');
        $this->sewa_model->delete_data($where, 'login');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Data berhasil dihapus !
        </div>');
        redirect('admin/data_pelanggan');
    }
    // Laporan

    public function laporan_ts()
    {
        $data['title'] = 'Laporan Data Tempat Penyewaan';
        $data['login'] = $this->db->query("SELECT * FROM login WHERE hak_akses = '2'")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/laporan-data-ts', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function laporan_pelanggan()
    {
        $data['title'] = 'Laporan Data Pelanggan';
        $data['login'] = $this->db->query("SELECT * FROM login WHERE hak_akses = '3'")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/laporan-pelanggan', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function laporan_pendapatan()
    {
        $data['title'] = 'Laporan Pendapatan';
        $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan WHERE pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/laporan-pendapatan', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function cetak_pemasukan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        // var_dump($bulan);
        // var_dump($tahun);
        // die;


        if ($bulan != '') {
            $b = date('m', strtotime($bulan));
            $y = date('Y', strtotime($bulan));
            $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan WHERE MONTH(pendapatan.tanggal) = '$b' AND YEAR(tanggal) = '$y' AND pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' ")->result();
        } elseif ($tahun != '') {
            $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan WHERE YEAR(pendapatan.tanggal) = '$tahun' AND pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' ")->result();
        } else {
            $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan WHERE pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' ")->result();
            die;
        }
        $mpdf = new \Mpdf\Mpdf();
        $cetak =   $this->load->view('admin/cetak_pendapatan', $data, true);
        $mpdf->WriteHTML($cetak);
        $mpdf->Output();
    }
    public function penyewaan()
    {
        update_laporan();
        $data['title'] = 'Laporan Penyewaan';
        $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat ORDER BY penyewaan.id_sewa DESC  ")->result();

        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/laporan-penyewaan', $data);
        $this->load->view('tamplates_admin/footer');
    }

    public function cetak_penyewaan_banyak()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if ($bulan != '') {
            $b = date('m', strtotime($bulan));
            $y = date('Y', strtotime($bulan));
            $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND MONTH(penyewaan.mulai_sewa) = '$bulan' ORDER BY penyewaan.id_sewa DESC  ")->result();
        } elseif ($tahun != '') {
            $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND YEAR(penyewaan.mulai_sewa) = '$tahun' ORDER BY penyewaan.id_sewa DESC  ")->result();
        } else {
            $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' ORDER BY penyewaan.id_sewa DESC  ")->result();
        };

        $mpdf = new \Mpdf\Mpdf();
        $cetak =   $this->load->view('admin/cetak_penyewaan_banyak', $data, true);
        $mpdf->WriteHTML($cetak);
        $mpdf->Output();
    }
    public function rating()
    {
        $data['title'] = 'Laporan Ranting';
        $data['rating'] = $this->db->query("SELECT * FROM rating, pelanggan, penyewaan, tempat_sewa WHERE penyewaan.id_sewa = rating.id_sewa AND rating.id_pelanggan = pelanggan.id_pelanggan AND rating.id_tempat = tempat_sewa.id_tempat ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_admin/sidebar');
        $this->load->view('admin/laporan-rating', $data);
        $this->load->view('tamplates_admin/footer');
    }
}
