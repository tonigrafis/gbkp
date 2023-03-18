<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_v2 extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->helper('url','form');
    }

    function fixed_hp_qontak($nohp){
	    $nohp = str_replace(" ","",$nohp);
	    $nohp = str_replace("(","",$nohp);
	    $nohp = str_replace(")","",$nohp);
	    $nohp = str_replace(".","",$nohp);

	    if(!preg_match('/[^+0-9]/',trim($nohp))){
	        if(substr(trim($nohp), 0, 3)=='62'){
	            $hp = trim($nohp);
	        }elseif(substr(trim($nohp), 0, 1)=='0'){
	            $hp = '62'.substr(trim($nohp), 1);
	        }
	    }
	    return $hp;
	}

    function get_sales_online($fn=null){
		$res=[];
		$query = $this->db->get_where("chat_us",array("sts_chat"=>1));
		if($query->num_rows()>0){
			$no=0;
			while($k=$query->unbuffered_row()){
				if(is_file(FCPATH.'./assets/img/'.$k->foto_pp)){
					$img=base_url('assets/img/'.$k->foto_pp);
				}else{
					$img=XDSnoImage();
				}
				if(strlen($k->nama_pengguna)>15) {
					$nama_sales=ucwords(strtolower(substr($k->nama_pengguna, 0,15)))."...";
				}else{
					$nama_sales=ucwords(strtolower($k->nama_pengguna));
				}
				$res[]=[
					"id_sales"	=>$k->id_chat,
					"nama_sales"=>$nama_sales,
					"online"	=>"https://wa.me/".$this->fixed_hp_qontak($k->no_wa),
					"foto"		=>$img,
					"text_on"	=>"online",
					"css_on"	=>"#2ecc71;",
					"sort"		=>$no++
				];
			}
		}
		if($fn==null)echo res_api($res,1);
		else return $res;
	}

    function get_sub_header($fn=null){
    	$res	= [];
    	$zzz 	= array(8,9,10); //klasis,runggun,sektor
    	if(in_array($fn, $zzz)){
			// var_dump($fn);die();
    		$query = $this->db->get_where("posting",array("id_page" => $fn, "status" => 1));
			if($query->num_rows()>0){
				while($k=$query->unbuffered_row()){
					$url=($fn==8?"home/klasis/".encrypt_url($k->id_posting):($fn==9?"home/runggun/".encrypt_url($k->id_posting):($fn==10?"home/sektor/".encrypt_url($k->id_posting):null)));
					if($url!=null){
						$res[]=[
							"id_sub_page"=> $k->id_posting,
							"name_sub"	 => $k->judul,
							"url_sub"	 => base_url($url),
						];
					}
				}
			}
    	}else{
    		$query = $this->db->get_where("sub_header_temp",array("sts_sub"=>1,"id_page"=>$fn));
			if($query->num_rows()>0){
				while($k=$query->unbuffered_row()){
					$res[]=[
						"id_sub_page"=> $k->id_sub_page,
						"name_sub"	 => $k->name_sub,
						"url_sub"	 => base_url($k->url_sub),
					];
				}
			}
    	}
		if($fn==null)echo res_api($res,1);
		else return $res;
	}

	function get_all_header_template(){
		$res 	= [];
		$query 	= $this->db->get_where("header_temp",array("static_header<>"=>2));
		if($query->num_rows()>0){
			while($row=$query->unbuffered_row()){
				$res[]=[
					"id_page"	 => $row->id_page,
					"nama_header"=> $row->nama_header,
					"url_page"	 => ($row->static_header==0?base_url($row->url_page):""),
					"sts_page"	 => $row->static_header,
					"desc_order" => $row->desc_order,
					"sub_page"	 => $this->get_sub_header($row->id_page),
				];
			}
		}
		echo res_api($res,1);
	}

	function get_banner($fn=null){
		$res=[];
		$query = $this->db->get_where("banner_page",array("sts_page"=>1,"id_page"=>$fn));
		if($query->num_rows()>0){
			while($k=$query->unbuffered_row()){
				if(is_file(FCPATH.'./assets/img/honda/slide_home/'.$k->url_banner)){
					$img=base_url('assets/img/honda/slide_home/'.$k->url_banner);
					$res[]=[
						"id_banner"	 => $k->id_banner,
						"ket_banner" => $k->ket_banner,
						"src_img"	 => $img,
					];
				}
			}
		}
		if($fn==null)echo res_api($res,1);
		else return $res;
	}

	function get_footer(){
		$res=[];
		$query = $this->db->get_where("footer_sns",array("status_sns<>"=>0));
		if($query->num_rows()>0){
			while($k=$query->unbuffered_row()){
				$res[]=[
					"id_sns"	=> $k->id_sns,
					"name_sns" 	=> $k->name_sns,
					"url_sns" 	=> base_url($k->url_sns),
					"class_sns"	=> $k->class_sns,
					"status_sns"=> $k->status_sns,
					"keterangan"=> $k->keterangan,
				];
			}
		}
		echo res_api($res,1);
	}

	function get_all_sub_page(){
		$res=[];
		$id=decrypt_url($this->input->post('xid'));
		$id_page=$this->input->post('id_page');
		$xxx=$this->db->select("isi,judul,id_posting")->from("posting")->where("id_master",$id)->where("id_page",$id_page);
		$query = $xxx->get();
		if($query->num_rows()>0){
			$no=0;
			while($k=$query->unbuffered_row()){
				$img=XnoImage();
				$re='/src="([^"]*)"/i';
				$parse=array();
				preg_match($re,$k->isi,$parse);
				if(count($parse)>1){
					$url_img=$parse[1];
					$last_url=basename($url_img);
					if(is_file(FCPATH."./assets/img_ckeditor/".$last_url)){
						$img=$url_img;
					}
				}
				$xisi=substr(preg_replace('#<[^>]+>#',' ',$k->isi),0,100);
				$xxpage=($id_page==9?"home/runggun/":"home/sektor/");
				$res[]=[
					"sort"		=>$no++,
					"url"		=>base_url($xxpage.encrypt_url($k->id_posting)),
					"judul"		=>$k->judul,
					"keterangan"=>substr($xisi,0,100)."...",
					"src_img"	=>$img
				];
			}
		}
		echo res_api($res,1);
	}

	function get_all_home_page(){
		$res[0]=$this->get_banner(1);
		$res[1]=$this->get_lates_news(1);
		echo res_api($res,1);
	}

	function get_lates_news($fn=null,$id_page=2){
		$res=[];
		if($fn==null){
			$id=decrypt_url($this->input->post('xid'));
			$id_page=$this->input->post('id_page');
			$xxx=$this->db->select("isi,judul,id_posting")->from("posting")->where("id_posting",$id)->where("id_page",$id_page)->limit(1);
			$sts_dashboard=0;
		}else{
			$xxx=$this->db->select("isi,judul,id_posting")->from("posting")->where("id_page",$id_page)->limit(4);
			$sts_dashboard=1;
		}
		$query = $xxx->get();
		if($query->num_rows()>0){
			$no=0;
			while($k=$query->unbuffered_row()){
				$img=($fn==null?null:XnoImage());
				$re='/src="([^"]*)"/i';
				$parse=array();
				preg_match($re,$k->isi,$parse);
				if(count($parse)>1){
					$url_img=$parse[1];
					$last_url=basename($url_img);
					if(is_file(FCPATH."./assets/img_ckeditor/".$last_url)){
						$img=$url_img;
					}
				}
				if($sts_dashboard==1){
					$xisi=substr(preg_replace('#<[^>]+>#',' ',$k->isi),0,100);
				}else{
					if($id_page==2){ //artikel
						$xisi=strip_tags($k->isi,"<b><i><u><br><p><strong><span><table><thead><tr><th><tbody><td>");
					}else{
						$xisi=$k->isi;
					}
				}
				$res[]=[
					"sort"		=>$no++,
					"xurl"		=>base_url('Latest_news'),
					"url"		=>base_url('Latest_news/pages/'.encrypt_url($k->id_posting)),
					"judul"		=>$k->judul,
					"keterangan"=>($fn==null?$xisi:substr($xisi,0,100)."..."),
					"src_img"	=>$img
				];
			}
		}
		if($fn==null)echo res_api($res,1);
		else return $res;
	}

	function get_brosur($fn=null){
		$res=[];
		$query = $this->db->query("SELECT nama_file,keterangan FROM tbl_brosur order by nama_file asc");
		if($query->num_rows()>0){
			$no=1;
			while($k=$query->unbuffered_row()){
				if(is_file(FCPATH."./assets/fileku/".$k->nama_file)){
					$res[]=[
						"url"		=>base_url('/assets/fileku/'.$k->nama_file),
						"nama_file"	=>$k->nama_file,
						"keterangan"=>$k->keterangan,
						"nomor"		=>$no++
					];
				}
				
			}
		}
		if($fn==null)echo res_api($res,1);
		else return $res;
	}
}
