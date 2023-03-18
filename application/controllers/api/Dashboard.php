<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller{ 
	function get(){
		$res=android_start();
		$this->db->where("tgl_buat < NOW() - INTERVAL 90 DAY")->delete("berita");
		$menu=[
			["popup","popup_select_sampati","Darurat<br/>(Sampati)","ic_9.png",0]
		];
		if(in_array($res->loged->role,[-1,0,1])){
			if($res->loged->role==1){
				$this->db->where("id_klasis",$res->loged->id_klasis);
			}
			$notif_konfir=$this->db->select("id_berita")->from("berita")->where("sts_berita",0)->limit(1)->get()->num_rows();
			$menu[]=["activity","Konfirmasi_sampati","Konfirmasi<br/>Sampati","ic_10.png",$notif_konfir];
		}
		$res->data->menu=array_merge($menu,[
												["activity","Program_bidang","Program<br/>Kerja","ic_1.png",0],
												["activity","Undangan","Undangan<br/>Diterima","ic_11.png",0],
												["activity","xxxx","Materi<br/>Ibadah","ic_2.png",0],
												["activity","xxxx","Aktivitas<br/>Gereja","ic_3.png",0],
												["activity","xxxx","Input<br/>Kas Kecil","ic_4.png",0],
												["activity","xxxx","Laporan<br/>Arus Kas","ic_5.png",0],
												["activity","xxxx","Informasi<br/>Gereja","ic_6.png",0],
												["activity","xxxx","Informasi<br/>Komersial","ic_7.png",0],
												["activity","xxxx","Informasi<br/>Bidang","ic_8.png",0]
											]);
		//======================================
		$judul_merah ="Sampati Merah!";
		$judul_kuning="Sampati Hijau!";
		$judul_info  ="Informasi";
		$pesan_merah="Kondisi darurat telah terjadi! Saya membutuhkan pertolongan segera!";
		$nama_admin ="Admin";

		$res->data->berita 	=$this->db->select("berita.*,if(tipe=1,'$judul_merah',if(tipe=2,'$judul_kuning','$judul_info')) as judul,if(tipe=1,'$pesan_merah',pesan) as pesan,if(tipe not in (1,2),'$nama_admin',nama) as nama")
									->from("berita")->join("user","op_buat=id_user")
									->where("sts_berita",1)
									->order_by("(tipe=1) desc,(tipe=2) desc,id_berita desc")
									->get()
									->result();
		$res->success 			=true;
		//======================================
		android_finish($res);
	}
	function add_berita(){
		$res 	=android_start();
		$tipe 	=$this->input->post("tipe");
		$pesan 	=$this->input->post("pesan");
		$lokasi =$this->input->post("lokasi");
		$base64 =$this->input->post("gambar");
		if(in_array($res->loged->role,[-1,0,1])||($res->loged->role==2&&in_array($tipe,[1,2]))){
			$data=[
		        	"tipe" 		=>$tipe,
		        	"pesan" 	=>$tipe==1?null:ucfirst($pesan),
		        	"tgl_buat"  =>date("Y-m-d H:i:s"),
		        	"lokasi"	=>$lokasi,
		        	"op_buat"	=>$res->loged->id_user,
		        	"sts_berita"	=>0,
		        	"id_klasis"	=>$res->loged->id_klasis,
		        ];
		    
			if($res->loged->role==-1||$res->loged->role==0){//admin pusat : semua anggota dapat notif
				$data['sts_berita']=1;
			}
			else if($res->loged->role==1){//admin lokal : anggota klasisnya dan admin pusat dapat notif
				$data['sts_berita']=1;
				$this->db->group_start()
							->where("id_klasis",$res->loged->id_klasis)
							->or_where("role",0)
						->group_end();
			}else{//anggota : admin klasisnya dan admin pusat dapat notif untuk verifikasi
				$this->db
						->group_start()
							->where("role",1)
							->where("id_klasis",$res->loged->id_klasis)
						->group_end()
						->or_where("role",0);
			}
			$token=$this->db->select("firebase_token")
						->where("id_user!=",$res->loged->id_user)
						->get("user")
						->result();
			$token 		=array_column($token,"firebase_token");
			if($base64!=""){
				$image_name 	="b".rand()."_".time().".png";
				$path 			='./assets/img/berita';
				$new_path_photo 		=$path."/".$image_name;
				if(!is_dir($path)){
					mkdir($path);
				}
				file_put_contents($new_path_photo,base64_decode($base64));
				$data['gambar']="berita/".$image_name;
			}else{
				$data['gambar']="user/".$res->loged->photo;
			}
			$this->db->insert("berita",$data);
			if(count($token)>0){
				$token 		=array_values(array_unique($token)); 
				$id_berita=$this->db->insert_id();

				$judul=$tipe==1?"Sampati Merah":($tipe==2?"Sampati Hijau":"Informasi");
				$pesan=$data['pesan']=$tipe==1?"Kondisi darurat telah terjadi! Saya membutuhkan pertolongan segera!":$pesan;
 				
 				$image=base_url()."assets/img/".$data['gambar'];
				$data=array_merge($data,[
										"judul"		=>$judul,
										"id_berita"	=>$id_berita,
										"gambar" 	=>$image,
										"nama"	=>$res->loged->nama
									]);
		        FCM($token,$data);
			}
			$res->success=true;
		}else{
			$res->error="Anda tidak memiliki akses";
		}
		android_finish($res);
	}
	function konfirmasi_berita(){
		$res 	=android_start();
		$data 	=json_decode($this->input->post("data"));
		if(
			in_array($res->loged->role,[-1,0,1])//admin pusat|local
			&&in_array($data->tipe,[1,2])//sampati merah|hijau
			&&in_array($data->sts_berita,[1,2])//sts_berita terima|tolak
		){
			$notif_klasis="";
			$sent_notif=true;
			if($data->sts_berita==2){//ditolak
				$cek=$this->db->where("id_berita",$data->id_berita)->where("sts_berita",0)->get("berita")->row();
				if($cek!=null){
					if(str_contains($cek->gambar,"berita")){
						$path="./assets/img/".$cek->gambar;
						if (file_exists($path) && is_file($path)) {
							unlink($path);
						}
					}
					$this->db->where("id_berita",$data->id_berita)->delete("berita");
				}else{
					$sent_notif=false;
				}
				
			}else{//diterima
				$this->db->where("id_berita",$data->id_berita)->where("sts_berita",0)->update("berita",["sts_berita"=>$data->sts_berita]);
				if($this->db->affected_rows()<=0)$sent_notif=false;
			}
			if(!$sent_notif){}//$res->error="Data telah dikonfirmasi sebelumnya";
			else{
				if($data->tipe==1)$data->pesan="Kondisi darurat telah terjadi! Saya membutuhkan pertolongan segera!";
				$data->judul=$data->tipe==1?"Sampati Merah":($data->tipe==2?"Sampati Hijau":"Informasi");
				$this->db->select("firebase_token");
				if($data->sts_berita==2){//ditolak
					$this->db->where("id_user",$data->op_buat);
				}else{//diterima
					if($res->loged->role==1){//admin local
						$this->db->group_start()
										->where("id_klasis",$res->loged->id_klasis)
										->or_where("role",0)
									->group_end();
					}
				}
				$token=$this->db->where("id_user!=",$res->loged->id_user)
								->get("user")
								->result();
				$token=array_column($token,"firebase_token");
				FCM($token,$data);
				$res->success=true;
			}
		}else{
			$res->error="Anda tidak memiliki akses";
		}
		android_finish($res);
	}
	function delete_berita(){
		$res 	=android_start();
		$data 	=json_decode($this->input->post("data"));
		if(
			in_array($res->loged->role,[-1,0,1])//admin pusat|local
			&&in_array($data->tipe,[1,2])//sampati merah|hijau
		){
			$cek=$this->db->where("id_berita",$data->id_berita)->where("sts_berita",1)->get("berita")->row();
			if($cek!=null){
				if(str_contains($cek->gambar,"berita")){
					$path="./assets/img/".$cek->gambar;
					if (file_exists($path) && is_file($path)) {
						unlink($path);
					}
				}
				$res->success=true;
				$this->db->where("id_berita",$data->id_berita)->delete("berita");
			}else $res->error="Data telah dihapus sebelumnya";
		}else{
			$res->error="Anda tidak memiliki akses";
		}
		android_finish($res);
	}
	function get_sampati(){
		$res=android_start();
		$judul_merah ="Sampati Merah!";
		$judul_kuning="Sampati Hijau!";
		$judul_info  ="Informasi";
		$pesan_merah="Kondisi darurat telah terjadi! Saya membutuhkan pertolongan segera!";
		$nama_admin ="Admin";

		$sts_berita=$this->input->post("sts_berita");
		$res->data->sampati 	=$this->db->select("berita.*,if(tipe=1,'$judul_merah',if(tipe=2,'$judul_kuning','$judul_info')) as judul,if(tipe=1,'$pesan_merah',pesan) as pesan,if(tipe not in (1,2),'$nama_admin',nama) as nama")
									->from("berita")->join("user","op_buat=id_user")
									->where("sts_berita",$sts_berita)
									->where_in("tipe",[1,2])
									->order_by("(tipe=1) desc,(tipe=2) desc,id_berita desc")
									->get()
									->result();
		$res->success 			=true;
		//======================================
		android_finish($res);
	}
}