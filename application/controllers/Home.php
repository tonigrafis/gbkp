<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function bidang_and_pelayanan(){
		$uri=$this->uri->segment(3);
		if($uri=='persekutuan'){
			$data['xid'] = encrypt_url(22);
			$data['base']= base_url('home/bidang_and_pelayanan/persekutuan');
			$this->load->view('bidang_and_pelayanan/page',$data);
		}else if($uri=='kesaksian'){
			$data['xid'] = encrypt_url(23);
			$data['base']= base_url('home/bidang_and_pelayanan/kesaksian');
			$this->load->view('bidang_and_pelayanan/page',$data);
		}else if($uri=='pelayanan'){
			$data['xid'] = encrypt_url(24);
			$data['base']= base_url('home/bidang_and_pelayanan/pelayanan');
			$this->load->view('bidang_and_pelayanan/page',$data);
		}else if($uri=='dana_and_usaha'){
			$data['xid'] = encrypt_url(25);
			$data['base']= base_url('home/bidang_and_pelayanan/dana_and_usaha');
			$this->load->view('bidang_and_pelayanan/page',$data);
		}else if($uri=='litbang_and_parpem'){
			$data['xid'] = encrypt_url(26);
			$data['base']= base_url('home/bidang_and_pelayanan/litbang_and_parpem');
			$this->load->view('bidang_and_pelayanan/page',$data);
		}else{
			custom_alert('home/beranda');
		}
	}

	function tentang_gpkp(){
		$uri=$this->uri->segment(3);
		if($uri=='sejarah'){
			$data['xid'] = encrypt_url(4);
			$data['base']= base_url('home/tentang_gpkp/sejarah');
			$this->load->view('tentang-gbkp/page',$data);
		}else if($uri=='visi_misi_and_program'){
			$data['xid'] = encrypt_url(5);
			$data['base']= base_url('home/tentang_gpkp/visi_misi_and_program');
			$this->load->view('tentang-gbkp/page',$data);
		}else if($uri=='pengurus_moderamen'){
			$data['xid'] = encrypt_url(6);
			$data['base']= base_url('home/tentang_gpkp/pengurus_moderamen');
			$this->load->view('tentang-gbkp/page',$data);
		}else{
			custom_alert('home/beranda');
		}
	}

	function uraian_tugas(){
		$uri=$this->uri->segment(3);
		if($uri=='bpp_mamre'){
			$data['xid'] = encrypt_url(18);
			$data['base']= base_url('home/uraian_tugas/bpp_mamre');
			$this->load->view('uraian_tugas/page',$data);
		}else if($uri=='bp_mamre_klasis'){
			$data['xid'] = encrypt_url(19);
			$data['base']= base_url('home/uraian_tugas/bp_mamre_klasis');
			$this->load->view('uraian_tugas/page',$data);
		}else if($uri=='bp_mamre_runggun'){
			$data['xid'] = encrypt_url(20);
			$data['base']= base_url('home/uraian_tugas/bp_mamre_runggun');
			$this->load->view('uraian_tugas/page',$data);
		}else if($uri=='bp_mamre_sektor'){
			$data['xid'] = encrypt_url(21);
			$data['base']= base_url('home/uraian_tugas/bp_mamre_sektor');
			$this->load->view('uraian_tugas/page',$data);
		}else{
			custom_alert('home/beranda');
		}
	}

	function mamre(){
		$uri=$this->uri->segment(3);
		if($uri=='sejarah_mamre'){
			$data['xid'] = encrypt_url(7);
			$data['base']= base_url('home/mamre/sejarah_mamre');
			$this->load->view('mamre/page',$data);
		}else if($uri=='adrt_mamre'){
			$data['xid'] = encrypt_url(8);
			$data['base']= base_url('home/mamre/adrt_mamre');
			$this->load->view('mamre/page',$data);
		}else if($uri=='bahan_pa'){
			$data['xid'] = encrypt_url(9);
			$data['base']= base_url('home/mamre/bahan_pa');
			$this->load->view('mamre/page',$data);
		}else if($uri=='mupel_and_rppl'){
			$data['xid'] = encrypt_url(10);
			$data['base']= base_url('home/mamre/mupel_and_rppl');
			$this->load->view('mamre/page',$data);
		}else if($uri=='laporan_rppl'){
			$data['xid'] = encrypt_url(11);
			$data['base']= base_url('home/mamre/laporan_rppl');
			$this->load->view('mamre/page',$data);
		}else if($uri=='program_kerja'){
			$data['xid'] = encrypt_url(12);
			$data['base']= base_url('home/mamre/program_kerja');
			$this->load->view('mamre/page',$data);
		}else if($uri=='lagu_mars_mamre'){
			$data['xid'] = encrypt_url(13);
			$data['base']= base_url('home/mamre/lagu_mars_mamre');
			$this->load->view('mamre/page',$data);
		}else if($uri=='lagu_kemitraan'){
			$data['xid'] = encrypt_url(14);
			$data['base']= base_url('home/mamre/lagu_kemitraan');
			$this->load->view('mamre/page',$data);
		}else if($uri=='lagu_suka'){
			$data['xid'] = encrypt_url(15);
			$data['base']= base_url('home/mamre/lagu_suka');
			$this->load->view('mamre/page',$data);
		}else if($uri=='lagu_duka'){
			$data['xid'] = encrypt_url(16);
			$data['base']= base_url('home/mamre/lagu_duka');
			$this->load->view('mamre/page',$data);
		}else if($uri=='beasiswa'){
			$data['xid'] = encrypt_url(17);
			$data['base']= base_url('home/mamre/beasiswa');
			$this->load->view('mamre/page',$data);
		}else{
			custom_alert('home/beranda');
		}
	}

	function klasis(){
		$url=$this->uri->segment(3);
		$data['xid'] = $url; 
		$data['base']= base_url('home/klasis/'.$url);
		$this->load->view('klasis/page',$data);
	}

	function runggun(){
		$url=$this->uri->segment(3);
		$data['xid'] = $url;
		$data['base']= base_url('home/runggun/'.$url);
		$this->load->view('runggun/page',$data);
	}

	function sektor(){
		$url=$this->uri->segment(3);
		$data['xid'] = $url;
		$data['base']= base_url('home/sektor/'.$url);
		$this->load->view('sektor/page',$data);
	}

	function index(){
		custom_alert('home/beranda');
	}

	function beranda(){ 
        $this->load->view('home/index');
	}
	
	function download_brosur(){
		$this->load->view('home/permohonan_download_brosur');
	}
	
	function brosur_pelanggan(){
		$str=$this->input->get('uniq');
		$str=preg_replace("/</i", "&lt;",$str);
		$id=$this->db->escape_str($str);

		$this->db->where("uniq",$id);
		$this->db->limit(1);
		$cek=$this->db->get("tbl_email")->num_rows();
		if($cek==1){
			$this->load->view('home/validasi_download_brosur');
		}else{
			custom_alert('home/download_brosur','danger',"Oopss, anda harus mengisi data dari form yang sudah disediakan untuk mengunduh data File Berita terbaru. [error code : U12L5H00T312]");
		}
	}
	
	/* Menu lainnya */
	function post_download_brosur(){
		$redirect=null;
		$first_name= $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$xtelp = $this->input->post('telp');

		if(!check_string($first_name)||!check_string($last_name)||!is_numeric($xtelp)||!check_email($email)){
			if(!check_string($first_name)){
			 	custom_alert($redirect,'danger',"Oopss, anda harus mengisi data First Name dengan huruf / abjad, silahkan ulangi kembali.");
			}else if(!check_string($last_name)){ 
				custom_alert($redirect,'danger',"Oopss, anda harus mengisi data Last Name dengan huruf / abjad, silahkan ulangi kembali.");
			}else if(!check_email($email)){ 
				custom_alert($redirect,'danger',"Oopss, anda harus mengisi data Email dengan format yang benar, silahkan ulangi kembali.");
			}else if(!is_numeric($xtelp)){ 
				custom_alert($redirect,'danger',"Oopss, anda harus mengisi data No. Telp. dengan angka, silahkan ulangi kembali");
			}else{ 
				custom_alert($redirect,'danger',"Oopss, anda harus mengisi data dari form yang sudah disediakan. [error code : V4L1D451]");
			}
		}else{
			$this->load->model('email_model');
			$telp = (strlen($xtelp)>0?"08".$xtelp:$xtelp);
			$md5 = md5($email);
			@$res_id = $this->db->query("SELECT id from tbl_email where email ='$email'")->row()->id;
			if($res_id!=null){
				$this->db->where('id',$res_id);
				$this->db->update("tbl_email",array("no_telp"=>$telp,"first_name"=>$first_name,"last_name"=>$last_name,"email"=>$email,"tanggal"=>date('Y-m-d'),"uniq"=>$md5,"status"=>0));
				$this->email_model->email_brosur_cust($email,$md5,$res_id,$first_name,$redirect);
			}else{
				$this->db->insert("tbl_email",array("no_telp"=>$telp,"first_name"=>$first_name,"last_name"=>$last_name,"email"=>$email,"tanggal"=>date('Y-m-d'),"uniq"=>$md5,));
				$last_id = $this->db->insert_id();
				$this->email_model->email_brosur_cust($email,$md5,$last_id,$first_name,$redirect);
			}
		}
	}
	
	function validasi_email(){
		$str=$this->input->get('uniq');
		$str=preg_replace("/</i", "&lt;",$str);
		$id=$this->db->escape_str($str);

		$this->db->where("uniq",$id);
		$this->db->update("tbl_email",array("status"=>1));
		if($this->db->affected_rows()==1){
			custom_alert('home/brosur_pelanggan?uniq='.$id,'success',"Silahkan pilih file E-BROSUR yang ingin anda unduh.");
		}else{
			$this->db->where("uniq",$id);
			$this->db->limit(1);
			$cek=$this->db->get("tbl_email")->num_rows();
			if($cek==1){
				custom_alert('home/brosur_pelanggan?uniq='.$id,'success',"Silahkan pilih file E-BROSUR yang ingin anda unduh. [success code : DUPLICATE]");
			}else{
				custom_alert('home/download_brosur','danger',"Oopss, anda harus mengisi data dari form yang sudah disediakan untuk mendownload data E-BROSUR. [error code : U12L5H00T312]");
			}
		}
	}

	/*cronjob*/
	public function del_enquiry_form(){
		$date_lalu = date('Y-m-d H:i:s',strtotime("-90 days"));
        $this->db->where("tgl_insert < '$date_lalu'");
        $this->db->delete("enquiry_form");
        $this->db->query("alter table enquiry_form auto_increment=1");
	}
    
    public function del_pemohon_brosur(){
		$date_lalu = date('Y-m-d',strtotime("-90 days"));
        $this->db->where("tanggal < '$date_lalu'");
        $this->db->delete("tbl_email");
		$this->db->query("alter table tbl_email auto_increment=1");
	}
	
	public function delete_session_data(){
		$date = date('Y-m-d',strtotime("-30 days"));
		$this->db->query("delete FROM ci_sessions WHERE date(ci_sessions.timestamp)<= '$date'");
	}
	/*cronjob*/
}
