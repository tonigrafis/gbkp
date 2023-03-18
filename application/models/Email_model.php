<?php
class Email_model extends CI_Model {
	public function __construct(){
        parent::__construct();
        
        $this->load->library('email');
	    
	    $config['protocol']   	='smtp';
	    $config['smtp_host']  	= host_set();
	    $config['smtp_port']  	= 465;
	    $config['smtp_crypto']	= 'ssl';
	    $config['smtp_user']  	= email_set(); 
	    $config['smtp_pass']  	= pass_set();
	    $config['smtp_timeout'] = 30;
	    $config['mailtype']   	= 'html';
	    $config['charset'] 	  	= 'iso-8859-1';
	    $config['wordwrap']   	= TRUE;
	    $config['priority']   	= 1;
	    
	    $this->xemail = $config;
    }

	public function email_brosur_cust($email_target,$saltid,$last_id,$first_name,$redirect){
		$url = base_url()."home/validasi_email?uniq=".$saltid;
		$logo = base_url()."assets/img/honda/logo.png";
		$message = "<html>
						<body>
							<p style='margin:0;'>Kepada Yth.</p>
							<p style='margin:0;font-weight:bold;'>Bapak/Ibu ".ucfirst($first_name)."</p>
							<br/>
							<p style='margin:0;'>Terima kasih kami sampaikan atas kepercayaan Bapak/Ibu untuk terus memperbarui layanan Unduh File Berita terbaru kami.</p>
							<p style='margin:0;'>Bersama ini kami sampaikan informasi File Berita terbaru pada bulan ".tahun_bulan(date('Y-m-d')).", dengan cara meng-<i>klik</i> tautan berikut: </p>
							<a href='".$url."' style='background:green;color:#fff;font-weight:bold;font-size:15px;border-radius:100px;padding:10px 25px;display:inline-block;text-decoration:none' target='_blank'>Unduh File</a>
							<p style='margin:0;'>Atas perhatian yang diberikan kami ucapkan terima kasih.</p>
							<br>
							<p style='margin:0;'>Hormat kami,</p>
							<br>
							<p style='margin:0;'>".title_set()."</p>
							<div style='background-repeat: no-repeat;background-size: 100% 100%;background-color: #ffffff; background-image:url(".$logo.");height:250px;width:250px;'></div>
							<br>
							<p style='margin:0;'><b>Penting : </b></p>
							<p style='margin:0;'>* Email ini bersifat informasi dan tidak dapat di reply.
								Apabila Bapak/Ibu membutuhkan informasi lebih lanjut, silahkan klik tautan dibawah ini : </p>
							</br>
							<div style='text-align:center;font-size:11px;padding:14px'> © ".date('Y')." ".title_set()."</div> 
						</body>
					</html>";	      

        $this->email->initialize($this->xemail); //ini new settingan
        $this->email->from(email_set(), title_set());
        if(app_release()){
        	$this->email->to($email_target); 
        }else{
        	$this->email->to(email_sender()); 
        }
		$this->email->subject('Permintaan Unduh File Berita terbaru '.title_set());
        $this->email->message($message);
       
        if(! $this->email->send()){
        	$this->db->where('id',$last_id);
			$this->db->update('tbl_email',array("sts_terkirim"=>0));
			if($this->db->affected_rows()==1){
				custom_alert($redirect,'danger',"Oopss, permintaan Unduh File Berita terbaru tidak dapat kami kirimkan ke-email anda, apakah email sudah benar ? [error code : 3M41L&D13]");
			}else{
				custom_alert($redirect,'danger',"Oopss, permintaan Unduh File Berita terbaru tidak dapat kami kirimkan ke-email anda, apakah email sudah benar ? [error code : 3M41L]");
			}
        }else{
        	$this->db->where('id',$last_id);
			$this->db->update('tbl_email',array("sts_terkirim"=>1));
			if($this->db->affected_rows()==1){
				custom_alert($redirect,'success',"Permintaan Unduh File Berita terbaru telah dikirimkan ke email anda, silakan periksa email anda.");
			}else{
				custom_alert($redirect,'success',"Permintaan Unduh File Berita terbaru telah dikirimkan ke email anda, silakan periksa email anda. [success code : DUPLICATE]");
			}
        }
    }
}
