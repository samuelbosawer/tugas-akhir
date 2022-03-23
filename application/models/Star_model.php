<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Star_model extends CI_Model
{
    public function get_business_data()
    {
        $this->db->order_by('id_tempat', 'DESC');
        return $this->db->get('tempat_sewa');
    }
    public function get_business_ranting($business_id)
    {
        $this->db->select('jumlah_ranting as ranting');
        $this->db->from('ranting');
        $this->db->where('id_tempat', $business_id);
        $data = $this->db->get();

        foreach ($data->result_array() as $row) {
            return $row['ranting'];
        }
    }

    public function html_output()
    {
        $data = $this->get_business_data();
        $output = '';
        foreach ($data->result_array() as $row) {
            $color = "";
            $ranting = $this->get_business_ranting($row['id_tempat']);
            $output .= '
            <h3 class= "text->primary">' . $row["nama_tempat"] . '</h3>
            <ul class= "list-inline" data-ranting="' . $ranting . '"title="Avarage Ranting-' . $ranting . '">
            ';
            for ($count = 1; $count <= 5; $count++) {
                if ($count <= $ranting) {
                    $color = 'color:#ffcc00;';
                } else {
                    $color = 'color:#ccc;';
                }
                $output .= '<li title="' . $count . '"id="' . $row['id_tempat'] . '-' . $count . '"data-index' . $count . ' data-business_id="' . $row["id_tempat"] . '" data-ranting"' . $ranting . '" class ="rating" style="cursor:pointer;' . $color . ' font-size:24px;">&#9733;</id>';
            }
            $output .= '</ul>
            <p>' . $row["alamat_distrik"] . '</p>
            <label style="text-danger">' . $row["nama_tempat"] . '</label> </hr>';
        }
        echo $output;
    }
}
