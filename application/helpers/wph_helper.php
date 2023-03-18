<?php  if(! defined('BASEPATH')) exit('No direct script access allowed');
if(! function_exists('wph')){
	function app(){
		return (object)[
			"release"=>false,
			"title_website"=>"BPP MAMRE",
			"android_version"=>10,//BuildConfig.VERSION_CODE
			"logo"=>"https://bpp-mamre.hebatconsulting.com/assets/img/honda/logo.png",
			"firebase_key"=>"AAAAsizTBRM:APA91bE72g0uQhd6T9E7Eh_KYUF15fv3fZRUM02PA8K8kk23UboBalH2UQs-NoQFqO7RbKuR5_Xdgd1_fqDJLpdOsPJLEeoell1dTeg0QgqR-mfxFrAKjBzGf8PfqgPCyq5rQHzWvtir"
		];
	}
	
	function app_release(){
		return true; // kalo release true ()=>{ utk service email }
	}

	function email_sender(){
		return (string) 'deki55.tekno@gmail.com'; // default email pengirim kalo blm release;
	}

	function cc_email_sm(){
		return (string) 'radexsh@gmail.com'; // default email pengirim kalo blm release;
	}

	/*setting ssl gmail https://myaccount.google.com/lesssecureapps*/
    /*https://accounts.google.com/b/0/DisplayUnlockCaptcha*/
	function host_set(){
		return (string) 'karin-sa.my.id';
	}

	function email_set(){
		return (string) 'verify@karin-sa.my.id';
	}

	function pass_set(){
		return (string) 'hebathebat1';
	}

	function title_set(){
		return 'Gereja Batak Karo Protestan';
	}

	function XnoImage(){
		return base_url('assets/folderreza/no-image.jpg');
	}

	function XDSnoImage(){
		return base_url('assets/img/team-2.jpg');
	}

	function res_api($res,$state){ //$state=1 :> JSON_PRETTY_PRINT
		if($state===1)return json_encode($res);
		else return '<pre>'.json_encode($res,JSON_PRETTY_PRINT).'</pre>';
	}

	function custom_alert($url=null,$class='danger',$text=null){
		if($url!=null){
			$ci =& get_instance();
			if($text!=null){
			$ci->session->set_flashdata('alert','<div class="alert alert-'.$class.'" role="alert">'.$text.'</div>');
			} 
			redirect($url,'auto');
		}else{
			echo res_api(array("text"=>$text,"class"=>$class),1);
		}
	}

	function check_string($str){
		return (bool) preg_match('/^[A-Za-z ]+$/i', $str);
	}

	function check_textarea($str){
		return (bool) preg_match('/\A[\w .,\s]+\z/', $str);
	}

	function check_email($email){
		if(function_exists('idn_to_ascii') && $atpos= strpos($email, '@')){
			$ci =& get_instance();
			$email= substr($email, 0, ++$atpos).idn_to_ascii(substr($email, $atpos));
		}
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	function strtoangkathenrp($value){
		$numb=(int) str_replace(",","",$value);
		if($numb>0){
			$res=number_format($numb,0);
		}else{
			$res='-';
		}
		return $res;
	}

	function is_logged_in(){
		$ci = get_instance();
		if (!$ci->session->userdata('nama_user')){
			redirect('Login');
		}
	}

	function base64urlencode($s) {
		return str_replace(array('+','/'),array('-','_'),base64_encode($s));
	}

	function base64urldecode($s) {
		return base64_decode(str_replace(array('-','_'),array('+', '/'), $s));
	}

	function encrypt_url($string) {
		$result = '';
		$key = 'gereja';
		$iv = substr(hash('sha256', $key), 0, 32);
		for($i=0; $i<strlen($iv); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($iv, ($i % strlen($iv))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return str_replace("=",":",base64urlencode($result));
	}

	function decrypt_url($string) {
		$result = '';
		$key = 'gereja';
		$x = str_replace(":","=",base64urldecode($string));
		$iv = substr(hash('sha256', $key), 0, 32);

		for($i=0; $i<strlen($iv); $i++) {
			$char = substr($x, $i, 1);
			$keychar = substr($iv, ($i % strlen($iv))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return trim($result);
	}

	function base64url_encode($string) {
		$result = '';
		$key = 'gereja';
		$iv = substr(hash('sha256', $key), 0, 32);
		for($i=0; $i<strlen($iv); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($iv, ($i % strlen($iv))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64urlencode($result);
	}

	function base64url_decode($string) {
		$result = '';
		$key = 'gereja';
		$x = base64urldecode($string);
		$iv = substr(hash('sha256', $key), 0, 32);

		for($i=0; $i<strlen($iv); $i++) {
			$char = substr($x, $i, 1);
			$keychar = substr($iv, ($i % strlen($iv))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return trim($result);
	}

	function fix_tanggal($tanggal){
		if(($tanggal==null)||($tanggal=='0000-00-00')||($tanggal=='')){
			$tgl="-";
		}else{
			$tgl=date('d/m/Y',strtotime($tanggal));
		}
		return $tgl;
	}
	
	function bulan($bln){
		switch ($bln){
			case 1: return "Januari"; break;
			case 2: return "Februari"; break;
			case 3: return "Maret"; break;
			case 4: return "April"; break;
			case 5: return "Mei"; break;
			case 6: return "Juni"; break;
			case 7: return "Juli"; break;
			case 8: return "Agustus"; break;
			case 9: return "September"; break;
			case 10: return "Oktober"; break;
			case 11: return "November"; break;
			case 12: return "Desember"; break;
		}
	}
	
	function tahun_bulan($tgl){
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $bulan.' '.$tahun;
	}

	function FCM($token,$data){
		$data=(array)$data;
		$res=false;
	    if(count($token)>0){
	        $ch = curl_init();
	        curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
	        curl_setopt($ch,CURLOPT_POST, true );
	        curl_setopt($ch,CURLOPT_HTTPHEADER, [
	                                                'Authorization: key='.app()->firebase_key,
	                                                'Content-Type: application/json'
	                                            ]);
	        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true );
	        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false );
	        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode([
	                                            'registration_ids'  =>$token,
	                                            'priority'          =>10,
	                                            'notification'      =>[
														        		"title"=>$data['judul']??"",
														        		"body"=>$data['pesan']??"",
														        		"image"=>$data['image']??null
														        	],
	                                            "data"				=>$data
	                                            ]));
	        $res=curl_exec($ch);
	    }
	    return $res;
	}
	function android_start($renew_key=false){
		$ci =& get_instance();
		$baypass_login=$ci->input->post("baypass_login")=="yes";
		$versi_server 	=implode(".",str_split((string)app()->android_version));
		$versi_sent 	=implode(".",str_split((string)$ci->input->post("android_version")));
		$res=(object)[
				"need_update"=>$versi_server!=$versi_sent,
				"loged"=>null,
				"success"=>false,
				"error"=>"",
				"data"=>(object)[]
			];
		if($res->need_update){
			$res->error="Pembaruan versi ".$versi_server." telah tersedia. Silahkan perbarui aplikasi anda.";
			android_finish($res);
		}else if($baypass_login){
			$res->loged=true;//hanya baypass
			return $res;
		}else{
			$nama_user 	=trim($ci->input->post("nama_user")??"");
			$pass 		=trim($ci->input->post("pass")??"");
			$login_key  =$ci->input->post("login_key");
			if($nama_user==""){
				$res->error="Kolom username/email/no. hp belum diisi.";
				android_finish($res);
			}else if($pass==""){
				$res->error="Kolom password belum diisi.";
				android_finish($res);
			}else{
				$cek=get_session($nama_user);
				if($cek==null){
					$res->error="Username tidak ditemukan";
					android_finish($res);
				}else if($cek->pass!=encrypt_url($pass)){
					$res->error="Password belum benar";
					android_finish($res);
				}else if($login_key!=""&&$cek->login_key!=$login_key){
					$res->error="Sesi login telah habis, Silahkan login ulang.";
					android_finish($res);
				}else{
					$generate_key=md5("_".time()."_".rand());
					$cek->pass=decrypt_url($cek->pass);
					$res->loged=$cek;
					if($renew_key){
						$res->loged->login_key=$generate_key;
						$ci->db->set("login_key",$generate_key);
					}
					$ci->db->set("firebase_token",$ci->input->post("firebase_token"));
					$ci->db->set("last_app_login",date("Y-m-d H:i:s"));
					$ci->db->where("id_user",$cek->id_user)->update("user");
					return $res;
				} 
			}
		}
	}
	function get_session($nama_user){
		$ci =& get_instance();
		return $ci->db->select("user.id_user,nama_user,pass,login_key,role,mst_klasis.id_klasis,mst_runggun.id_runggun,mst_sektor.id_sektor,nama,nama_klasis,nama_runggun,nama_sektor,photo")
			->from("user")
			->join("user_hp","user_hp.id_user=user.id_user")
			->join("mst_klasis","mst_klasis.id_klasis=user.id_klasis")
			->join("mst_runggun","mst_runggun.id_runggun=user.id_runggun")
			->join("mst_sektor","mst_sektor.id_sektor=user.id_sektor","left")
			->group_start()
				->where("nama_user",$nama_user)
				->or_where("email",$nama_user)
				->or_where("no_hp",$nama_user)
			->group_end()
			->group_by("user.id_user")
			->get()
			->row();
	}
	function android_finish($res){
		if($res->data!=null)$res->data=json_encode($res->data);
		if($res->loged)$res->loged=json_encode($res->loged);
		echo json_encode($res);
		die();
	}
	function load_view($view,$data=[]){
		$ci =& get_instance();
        $ci->load->view('templates/header');
        $ci->load->view('templates/topbar');
        $ci->load->view('templates/sidebar');
        $ci->load->view($view,$data);
        $ci->load->view('templates/footer');
	}
	function clean_query($query){
		return preg_replace("/(\t+|\n+|\r+|\s+)/im"," ",preg_replace("/`/im","",$query));
	}
	function clear_search($txt){
		return preg_replace("/[^0-9a-zA-Z ]/im","",$txt);
	}
}