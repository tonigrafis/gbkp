<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Program_kerja extends CI_Controller{ 
	function get_bidang(){
		$res=android_start();
		$data=$this->input->post();
		$tahun=$data['tahun'];
		$jenis=$data['jenis'];
		$pemilik="";
		if($jenis!='pusat'){
		    $pemilik="and id_pemilik='".$data['id_'.$jenis]."'";
		}
		$res->data->bidang=$this->db->select("mst_bidang.id_bidang,nama_bidang,count(id_kegiatan) as total_kegiatan")
								->from("mst_bidang")
								->join("program_kegiatan","(
															program_kegiatan.id_bidang=mst_bidang.id_bidang
															and jenis='$jenis'
						                                    and tahun='$tahun'
						                                    $pemilik
															)","left")
								->group_by("mst_bidang.id_bidang")
								->get()
								->result();
		$res->success=true;
		android_finish($res);
	}
	function get_kegiatan(){ 
		$res=android_start();
		$data=$this->input->post();
		$tahun=$data['tahun'];
		$jenis=$data['jenis'];
		$id_kegiatan=$data['id_kegiatan'];
		if($jenis!='pusat'){
		    $this->db->where("id_pemilik",$data['id_'.$jenis]);
		}
		if($id_kegiatan>0){
		    $this->db->where("program_kegiatan.id_kegiatan",$id_kegiatan);
		}
		$kegiatan=$this->db->select("program_kegiatan.id_kegiatan,nama_kegiatan,tempat,tujuan,target_fisik,anggaran_lokal,anggaran_subsidi,total_anggaran,pelaksana,keterangan,group_concat(jadwal order by jadwal asc separator ',') as jadwal")
										->from("program_kegiatan")
										->join("jadwal_kegiatan","jadwal_kegiatan.id_kegiatan=program_kegiatan.id_kegiatan")
										->where("jenis",$jenis)
										->where("tahun",$tahun)
										->group_by("program_kegiatan.id_kegiatan")
										->limit(1)
										->get()
										->row();
		$jwl=explode(",",$kegiatan->jadwal);
		foreach ($jwl as $x =>$val) {
			$jwl[$x]=date("d M Y",strtotime($val));
		}
		$kegiatan->jadwal=implode("<br/>",$jwl);
		$kegiatan->anggaran_lokal="Rp ".number_format($kegiatan->anggaran_lokal,0,0,".");
		$kegiatan->anggaran_subsidi="Rp ".number_format($kegiatan->anggaran_subsidi,0,0,".");
		$kegiatan->total_anggaran="Rp ".number_format($kegiatan->total_anggaran,0,0,".");

		$res->data->kegiatan=$kegiatan;
		$res->success=true;
		android_finish($res);
	}
	function select_kegiatan(){
		$res=android_start();
		$res->success=true;
		$res->data->select=[];
		$cari=explode(" ",$this->input->post("cari")??"");
		$data=(array)json_decode($this->input->post("parent_id"));
		$id_bidang=$data['id_bidang'];
		$tahun=$data['tahun'];
		$jenis=$data['jenis'];
		if($jenis!='pusat'){
		    $this->db->where("id_pemilik",$data['id_'.$jenis]);
		}
        $this->db->select("id_kegiatan as id,nama_kegiatan as name")->from("program_kegiatan")
										->where("id_bidang",$id_bidang)
										->where("jenis",$jenis)
										->where("tahun",$tahun);
        $first=false;
        foreach ($cari as $dt) {
            $dt=trim($dt);
            if($dt!=""){
                $this->db->group_start();
                if(!$first){
                    $this->db->like("nama_kegiatan",$dt);
                }else{
                    $this->db->or_like("nama_kegiatan",$dt);
                }
                $this->db->group_end();
            }
        }
        $res->data->select=$this->db->get()->result();
        $res->qqq=$this->db->last_query();
		android_finish($res);
	}
}