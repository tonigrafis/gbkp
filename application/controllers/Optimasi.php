<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Optimasi extends CI_Controller{
	function index(){
		$users=$this->db->select("id_user,nama_user,nama,istri,anak")->from("user")->get()->result();
		$total=0;
		foreach ($users as $user) {
			$nama=ucwords(preg_replace("/([^a-zA-Z ]+)/", "",$user->nama));
			$istri=ucwords(preg_replace("/([^a-zA-Z ~]+)/", "",$user->istri));
			$anak=ucwords(preg_replace("/([^a-zA-Z ~]+)/", "",$user->anak));
			$this->db->where("id_user",$user->id_user)->update("user",["nama"=>$nama,"istri"=>$istri,"anak"=>$anak]);
			$total+=$this->db->affected_rows();
		}
		echo $total;
	}
}