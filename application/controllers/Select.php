<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Select extends CI_Controller{ 

    public function select_klasis(){
        $search = $this->input->post('search');
        $data   = $this->db->select('id_posting, judul')->from('posting')->where('id_page',8)->where('status',1)
        ->like('judul', $search)->get()->result_array();
        echo json_encode($data);
    }

    public function select_runggun(){
        $search = $this->input->post('search');
        $data   = $this->db->select('id_posting, judul')->from('posting')->where('id_page',9)->where('status',1)
        ->like('judul', $search)->get()->result_array();
        echo json_encode($data);
    }

}