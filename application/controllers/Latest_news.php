<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Latest_news extends CI_Controller {
	
	function index(){
		redirect('latest_news/list_news');
	}
	
    function list_news(){
        $result['data'] = array();
        $jml_baris = $this->db->get_where("posting",array("id_page"=>2))->num_rows();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'Latest_news/list_news/'; 
        $config['total_rows'] = $jml_baris; 
        $config['per_page'] = 3;
        $from = $this->uri->segment(3);

        $this->pagination->initialize($config);
        $this->db->where('id_page',2);
        $this->db->order_by('id_posting','desc');
		$query = $this->db->get('posting',$config['per_page'],$from);
		if($query->num_rows()>0){
			$hsl=$query->result();
			for($i = 0; $i < count($hsl); $i++){
				$baris = $hsl[$i];
				$re='/src="([^"]*)"/i';
				$parse=array();
				preg_match($re,$baris->isi,$parse);
				if(count($parse)>1){
					$url_img=$parse[1];
					$last_url=basename($url_img);
					if(is_file(FCPATH."./assets/img_ckeditor/".$last_url)){
						$img=$url_img;
					}else{
						$img=XnoImage();
					}
				}else{
					$img=XnoImage();
				}
				$log = [
					'id_posting' => $baris->id_posting,
					'tanggal'    => $baris->tanggal,
					'judul'      => $baris->judul,
					'isi'        => substr(preg_replace('#<[^>]+>#',' ',$baris->isi),0,150),
					'id_user'    => $baris->id_user,
					'thumbnail'  => $img,
				];
				array_push($result['data'],$log);
			} 
		}
        $this->load->view('latest-news/index',$result);
    }
	
	
    function pages(){
    	$short_url=decrypt_url($this->uri->segment(3));
		$cek_karir = $this->db->select("id_posting")->from("posting")->where("id_posting",$short_url)->where("id_page",2)->limit(1)->get();
		if($cek_karir->num_rows()==1){
			$data['xid'] = encrypt_url($short_url);
			$data['base'] = base_url('home/xshare?page_news='.$short_url);
			$this->load->view('latest-news/page',$data);
		}else{
			custom_alert('latest_news/list_news','danger',"Maaf, data artikel yang anda tuju sudah tidak ada.");
		}
    }
}
