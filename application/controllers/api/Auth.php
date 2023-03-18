<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller{
	function get_klasis(){
		$res=android_start();
		$res->success=true;
		$res->data->select=[];
		$cari=explode(" ",$this->input->post("cari")??"");
        $this->db->select("id_klasis as id,nama_klasis as name")->from("mst_klasis");
        $first=false;
        foreach ($cari as $dt) {
            $dt=trim($dt);
            if($dt!=""){
                $this->db->group_start();
                if(!$first){
                    $this->db->like("nama_klasis",$dt);
                }else{
                    $this->db->or_like("nama_klasis",$dt);
                }
                $this->db->group_end();
            }
        }
        $res->data->select=$this->db->limit(10)->get()->result();
		android_finish($res);
	}
	function get_runggun(){
		$res=android_start();
		$res->success=true;
		$res->data->select=[];
		$id_klasis=$this->input->post("parent_id");
		if($id_klasis!=""){
			$cari=explode(" ",$this->input->post("cari")??"");
	        $this->db->select("id_runggun as id,nama_runggun as name")->where("id_klasis",$id_klasis)->from("mst_runggun");
	        $first=false;
	        foreach ($cari as $dt) {
	            $dt=trim($dt);
	            if($dt!=""){
	                $this->db->group_start();
	                if(!$first){
	                    $this->db->like("nama_runggun",$dt);
	                }else{
	                    $this->db->or_like("nama_runggun",$dt);
	                }
	                $this->db->group_end();
	            }
	        }
	        $res->data->select=$this->db->limit(10)->get()->result();
		}
		android_finish($res);
	}
	function get_sektor(){
		$res=android_start();
		$res->success=true;
		$res->data->select=[];
		$id_runggun=$this->input->post("parent_id");
		if($id_runggun!=""){
			$cari=explode(" ",$this->input->post("cari")??"");
	        $this->db->select("id_sektor as id,nama_sektor as name")->where("id_runggun",$id_runggun)->from("mst_sektor");
	        $first=false;
	        foreach ($cari as $dt) {
	            $dt=trim($dt);
	            if($dt!=""){
	                $this->db->group_start();
	                if(!$first){
	                    $this->db->like("nama_sektor",$dt);
	                }else{
	                    $this->db->or_like("nama_sektor",$dt);
	                }
	                $this->db->group_end();
	            }
	        }
	        $res->data->select=$this->db->limit(10)->get()->result();
		}
		android_finish($res);
	}
	function get_silima(){
		$res=android_start();
		$res->success=true;
		$res->data->select=[];
		$cari=explode(" ",$this->input->post("cari")??"");
        $this->db->select("id_silima as id,nama_silima as name")->from("mst_silima");
        $first=false;
        foreach ($cari as $dt) {
            $dt=trim($dt);
            if($dt!=""){
                $this->db->group_start();
                if(!$first){
                    $this->db->like("nama_silima",$dt);
                }else{
                    $this->db->or_like("nama_silima",$dt);
                }
                $this->db->group_end();
            }
        }
        $res->data->select=$this->db->limit(10)->get()->result();
		android_finish($res);
	}
	function get_marga(){
		$res=android_start();
		$res->success=true;
		$res->data->select=[];
		$id_silima=$this->input->post("parent_id");
		if($id_silima!=""){
			$cari=explode(" ",$this->input->post("cari")??"");
	        $this->db->select("id_marga as id,nama_marga as name")->where("id_silima",$id_silima)->from("mst_marga");
	        $first=false;
	        foreach ($cari as $dt) {
	            $dt=trim($dt);
	            if($dt!=""){
	                $this->db->group_start();
	                if(!$first){
	                    $this->db->like("nama_marga",$dt);
	                }else{
	                    $this->db->or_like("nama_marga",$dt);
	                }
	                $this->db->group_end();
	            }
	        }
	    }
        $res->data->select=$this->db->limit(10)->get()->result();
		android_finish($res);
	}
	function register(){
		$data=$this->input->post();
		$res=android_start();
		$data['nama_user']=trim(strtolower(preg_replace("/[^a-zA-Z0-9]/","",preg_replace("(@.*?$)","",$data['nama_user']))));
		$data['pass']=trim($data['pass']);
		if($data['pass']=="")$res->error="Silahkan isi kolom password";

		if($data['id_user']!=""&&trim($data['new_pass']??"")=="")$res->error="Silahkan isi kolom password";

		$data['pass']=encrypt_url($data['pass']);
		$data['nama']=trim(preg_replace("/\s+/im"," ",ucwords(strtolower(preg_replace("/[^a-zA-Z ]/im"," ",$data['nama'])))));
		$data['istri']=trim(preg_replace("/\s+,/im",",",preg_replace("/\s+/im"," ",ucwords(strtolower(preg_replace("/[^a-zA-Z_ ]/im"," ",$data['istri']))))));
		$data['anak']=trim(preg_replace("/\s+,/im",",",preg_replace("/\s+/im"," ",ucwords(strtolower(preg_replace("/[^a-zA-Z_ ]/im"," ",$data['anak']))))));
		$data['penggelaran']=trim(preg_replace("/\s+/im"," ",ucwords(strtolower(preg_replace("/[^a-zA-Z ]/im"," ",$data['penggelaran'])))));
		$data['tempat_lahir']=trim(preg_replace("/\s+/im"," ",ucwords(strtolower(preg_replace("/[^a-zA-Z ]/im"," ",$data['tempat_lahir'])))));
		$data['tgl_lahir']=$data['tgl_lahir'];
		$data['alamat']=trim(preg_replace("/\s+/im"," ",ucwords(preg_replace("/[^a-zA-Z,. ]/im"," ",$data['alamat']))));
		$data['email']=trim(strtolower($data['email']));
		$data['pekerjaan']=trim(preg_replace("/\s+/im"," ",ucwords(strtolower(preg_replace("/[^a-zA-Z ]/im"," ",$data['pekerjaan'])))));
		$data['gol_darah']=trim(strtoupper(preg_replace("/[^ABO-]/im","-",$data['gol_darah'])));
		$data['email']=$data['email']==null||$data['email']=="null"?"":$data['email'];
		if($data['email']!=''){
			if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))$res->error="Format email <b>".$data['email']."</b> belum benar.";
		}
		if($res->error==""){
			if($data['id_user']!=""){
				$data['nama_user']=trim($data['new_user']);
				$data['pass']=encrypt_url($data['new_pass']);
				unset($data['new_user']);
				unset($data['new_pass']);
			}
			$versi_server 	=implode(".",str_split((string)$data['android_version']));
			$data['app_version']=$versi_server;
			unset($data['firebase_token']);
			unset($data['login_key']);
			unset($data['android_version']);
			unset($data['baypass_login']);

			if($data['id_user']=="")$data['id_user']=null;
			else $this->db->where("id_user<>",$data['id_user']);

			$this->db->select("id_user,nama_user,email")->from("user")
						->group_start()
							->where("nama_user",$data['nama_user']);
			if($data['email']!=''){
				$this->db->or_where("email",$data['email']);
			}
			$user=$this->db->group_end()
						->get()
						->row();
			if($user!=null){
				if($user->nama_user==$data['nama_user'])$res->error="Username <b>".$data['nama_user']."</b> telah terdaftar sebelumnya";
				else $res->error="Email <b>".$data['email']."</b> telah terdaftar sebelumnya.";
			}else{
				$error=[];
				foreach ($data as $key => $value) {
					$value=trim($value??"");
					if($value==""){
						$data[$key]=null;
						if($key!='id_user'&&$key!='id_sektor'&&$key!="email"&&$key!="anak"){
							if($key=='no_hp')$error[]="No. Hp.";
							else if($key=='nama_user')$error[]="Username";
							else if($key=='pass')$error[]="Password";
							else if($key=='id_klasis')$error[]="Klasis";
							else if($key=='id_runggun')$error[]="Runggun";
							else if($key=='gol_darah')$error[]="Gol. Darah";
							else if($key=='tgl_lahir')$error[]="Tgl. Lahir";
							else if($key=='tempat_lahir')$error[]="Tempat Lahir";
							else if($key=='bere_id_silima')$error[]="Bere (Silima)";
							else if($key=='bere_id_marga')$error[]="Bere";
							else if($key=='marga_id_silima')$error[]="Marga (Silima)";
							else if($key=='marga_id_marga')$error[]="Marga";
							else if($key=='istri')$error[]="Nama Istri";
							else if($key=='nama')$error[]="Nama Lengkap";
							else $error[]=ucwords($key);
						}
					}
				}
				if(count($error)>0)$res->error="Kolom berikut wajib diisi :<br/>- ".implode("<br/>- ",$error);
				else{
					$list_hp=array_unique(explode(", ",$data['no_hp']));
					unset($data['no_hp']);
					$cek_hp=null;
					if($data['id_user']!=''){
						$cek_hp=$this->db->where("id_user!=",$res->loged->id_user)->where_in("no_hp",$list_hp)->limit(1)->get("user_hp")->row();
					}
					if($cek_hp!=null)$res->error="No. Hp <b>".$cek_hp->no_hp."</b> telah digunakan oleh pengguna lain";
					else{
						$new_base64 	=$data['photo'];
						unset($data['photo']);

						$id_user=$data['id_user'];
						if($data['id_user']==""){
							$this->db->insert("user",$data);
							if($this->db->affected_rows()>0){
								$id_user=$this->db->insert_id();
								$this->_uppload($id_user,$new_base64);
								$res->success=true;
							}else{
								$res->error="Terjadi kesalahan saat menyimpan data.";
							}
						}else{
							$cek=$this->db->select("photo")->where("id_user",$data['id_user'])->get("user")->row();
							if($cek==null){
								$res->error="Akun tidak ditemukan.";
							}else{
								$data['firebase_token']='';
								$this->db->where("id_user",$data['id_user'])->update("user",$data);
								if($this->db->affected_rows()>0){
									$this->_uppload($id_user,$new_base64,$cek->photo);
									$res->success=true;
								}else{
									$res->error="Terjadi kesalahan saat menyimpan data.";
								}
							}
						}
						if($res->success){
							$hp=[];
							foreach ($list_hp as $dt) {
								$hp[]=[
									"id_user"=>$id_user,
									"no_hp"=>$dt
								];
							}
							$this->db->where("id_user",$id_user)->delete("user_hp");
							$this->db->insert_batch("user_hp",$hp);
						}
						$baypass_login=$this->input->post("baypass_login")=="yes";
						if(!$baypass_login){
							$dt=get_session($data['nama_user']);
							$dt->pass=decrypt_url($dt->pass);
							$res->loged=$dt;
						}
					}
				}
			}
		}
		android_finish($res);
	}
	function _uppload($id_user,$base64,$old_photo=""){
		$image_name 	="u".$id_user."_".time().".png";
		$path 			='./assets/img/user';
		$new_path_photo 		=$path."/".$image_name;
		if(!is_dir($path)){
			mkdir($path);
		}
		file_put_contents($new_path_photo,base64_decode($base64));

		$old_path_photo=$path."/".$old_photo;
		if (file_exists($old_path_photo) && is_file($old_path_photo)) {
			unlink($old_path_photo);
		}
		$this->db->where("id_user",$id_user)->update("user",["photo"=>$image_name]);
	}
	function login(){
		$res=android_start(true);
		$res->success=true;
		$data['tipe_hp']=$this->input->post("str_tipe_hp");
		$data['app_version']=implode(".",str_split((string)$this->input->post('android_version')));
		$this->db->where("id_user",$res->loged->id_user)->update("user",$data);

		android_finish($res);
	}
	function get_user(){
		$res=android_start();
		$data=$this->db->select("user.id_user,nama_user,pass,login_key,role,mst_klasis.id_klasis,mst_runggun.id_runggun,if(isnull(mst_sektor.id_sektor),'',mst_sektor.id_sektor) as id_sektor,nama,nama_klasis,nama_runggun,if(isnull(mst_sektor.id_sektor),'',mst_sektor.nama_sektor) as nama_sektor,photo,marga_id_silima,marga_id_marga,bere_id_silima,bere_id_marga,penggelaran,tempat_lahir,tgl_lahir,alamat,istri,anak,email,pekerjaan,gol_darah")
					->from("user")
					->join("mst_klasis","mst_klasis.id_klasis=user.id_klasis")
					->join("mst_runggun","mst_runggun.id_runggun=user.id_runggun")
					->join("mst_sektor","mst_sektor.id_sektor=user.id_sektor","left")
					->where("id_user",$this->input->post("view_user")==""?$res->loged->id_user:$this->input->post("view_user"))
					->get()
					->row();
		if($data!=null){
			$data->pass=decrypt_url($data->pass);
			$data->marga=$this->db->select("concat(nama_silima,' (',nama_marga,')') as marga")->from('mst_silima')
							->join('mst_marga',"mst_marga.id_silima=mst_silima.id_silima")
							->where("mst_silima.id_silima",$data->marga_id_silima)
							->where("mst_marga.id_marga",$data->marga_id_marga)
							->get()->row()->marga;
			$data->bere=$this->db->select("concat(nama_silima,' (',nama_marga,')') as marga")->from('mst_silima')
							->join('mst_marga',"mst_marga.id_silima=mst_silima.id_silima")
							->where("mst_silima.id_silima",$data->bere_id_silima)
							->where("mst_marga.id_marga",$data->bere_id_marga)
							->get()->row()->marga;
			$data->no_hp=implode(", ", array_column($this->db->select("no_hp")->where("id_user",$data->id_user)->get("user_hp")->result(),"no_hp"));
			$res->success=true;
			$res->data->user=$data;
		}else{
			$res->error="Akun tidak ditemukan";
		}
		android_finish($res);
	}
}