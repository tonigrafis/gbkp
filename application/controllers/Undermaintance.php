<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Undermaintance extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){ 
		redirect('undermaintance/wearesorryforthis');
	}
	
	function wearesorryforthis(){
		$this->load->view('underconstruction');
	}
}
