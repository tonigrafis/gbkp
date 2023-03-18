<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
    }

    function index(){
        if($this->session->set_userdata("nama_user")){
             redirect('admin');
        }else{
            $this->load->view('login/login');
        }
    }

    function exists($id_user){
        $query = $this->db->get_where("users",array('id_user'=> $id_user));
        return ($query->num_rows() == 1);
    }

    function login_masuk (){ 
        $user = $this->input->post('username');
        $pass = encrypt_url($this->input->post('pass'));
        $query = $this->db->where("role<",4)->where("nama_user",$user)->get("user");
        if($query->num_rows() == 1){
            $row = $query->row(); 
            if($pass == $row->pass){
                $row->nama_klasis=$this->db->select("nama_klasis")->where("id_klasis",$row->id_klasis)->from("mst_klasis")->get()->row()->nama_klasis??null;
                $row->nama_runggun=$this->db->select("nama_runggun")->where("id_runggun",$row->id_runggun)->from("mst_runggun")->get()->row()->nama_runggun??null;
                $row->nama_sektor=$this->db->select("nama_sektor")->where("id_sektor",$row->id_sektor)->from("mst_sektor")->get()->row()->nama_sektor??null;
                $this->session->set_userdata((array)$row);
                redirect('admin'); 
            }else{ 
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
                redirect('login');
            }
        }else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username salah</div>');
            redirect('login');
        }
    }
	
	function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
