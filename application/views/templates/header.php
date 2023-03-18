<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<title><?=title_set()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="description" content="Situs Resmi Gereja Batak Karo Protestan">
	<meta name="keywords" content="Gereja Batak Karo Protestan">
	<meta name="author" content="Support by: hebatconsulting.com">
	<link href="<?=base_url();?>assets/img/favicon.ico" rel="icon">
	<link rel="stylesheet" href="<?=base_url();?>assets/admin_assets/bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="<?=base_url();?>assets/admin_assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/admin_assets/css/site.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/admin_assets/animate-css/vivify.min.css">
	<link href="<?=base_url();?>assets/newjscss/daterangepicker.css" rel="stylesheet">   
	
	<script src="<?=base_url();?>assets/newjscss/jquery.min.js"></script>
	<script src="<?=base_url();?>assets/js/ckeditor/ckeditor.js"></script>

	<link rel="stylesheet" href="<?=base_url();?>assets/admin_assets/jquery-datatable/dataTables.bootstrap4.min.css">
	
  <link href="<?=base_url()?>assets/admin_assets/select2/select2.min.css" rel="stylesheet" />
  <script src="<?=base_url()?>assets/admin_assets/select2/select2.min.js"></script>
	<link href="<?=base_url();?>/assets/select/style.css" rel="stylesheet">
</head>
<style>
._backdrop{display:none;position: fixed;top: 0;left: 0;height: 100%;width: 100%;background: rgba(0,0,0,0.7);z-index: 99999}._table{display: table;vertical-align: middle;text-align: center;color: #fff;width: 100%;height: 100%}._table_cell{display: table-cell;vertical-align: middle;text-align: center;color: #fff}
.border_red{border-top: 2px solid #df1432!important;border-left: 2px solid #df1432!important;border-right: 2px solid #df1432!important;border-bottom: 2px solid #df1432!important;border-radius: 4px!important}
.doubleScroll-scroll-wrapper {height: 12px!important;margin-bottom: 0px!important;}
	.custom-radio label{
		cursor: pointer;
	}
	#x_alert{position: fixed;top:0;left: 0;width: 100%;height: 100%;z-index: 9999999;background: rgba(0,0,0,.5);padding: 24px;} .x_alert_box{max-width:600px;margin: auto;box-shadow: 0 1px 6px 0 rgba(0, 0, 0, .8);border-radius: 5px;overflow: auto;max-height: 100%;} .x_alert_header{padding: 8px;color: #fff;font-size: 1.5em;text-align: center;border-top-left-radius: 5px;border-top-right-radius: 5px;background: #546E7A;} .x_alert_body{padding: 24px;background: #fff;} .x_alert_footer{background: #CFD8DC;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;text-align: center;} .x_btn{display: inline-block;min-width: 40%;margin: 6px 12px;padding: 8px;border-radius: 5px;color: #fff;background: #000;cursor: pointer;} .x_color_success{background: #28a745;} .x_color_warning{background: #FB8C00;color:black;} .x_color_danger{background: #b71c1c;} .x_color_cancel{background: #263238;} .text-kapital{ text-transform: capitalize; }
  .xinfo{
    font-size: 0.8rem!important;
    font-weight: normal;
    display: block;
    line-height: 1;
    margin-top: 0.5rem;
  }
  .table.table-custom td:hover, .table.table-custom th:hover{
    background: none;
  }
  .dragscroll{
    cursor: grab;
  }
  .btn:hover{
    cursor: pointer;
  }
  table,.table.table-custom,tr,th,td{
    border:1px solid black!important;
    border-collapse: collapse!important;
  }
  .img_preview{
    cursor: pointer;
  }
  #img_preview img{
    max-width: 100%;
  }
  img.img_preview{
    width: 50px;
  }
  td:has(>.img_preview) {
    padding: 0!important;
  }
  .select2-selection__clear{
    font-size: 1.2rem!important;
  }
  .modal-title{
    font-size: 1.1rem;
    font-weight: bold!important;
  }
</style>
<script type="text/javascript">
  var xmonth=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
  function sql_to_view(str_date){
    var view='';
    if(str_date!=null&&str_date!=''){
      var dt=str_date.split('-');
      view=dt[2]+' '+xmonth[parseInt(dt[1])-1]+' '+dt[0]
    }
    return view;
  }
  function view_to_sql(str_date){
    var view='';
    if(str_date!=null&&str_date!=''){
      var dt=str_date.split(' ');
      var m=xmonth.indexOf(dt[1]);
      view=dt[2]+'-'+(m<=9?'0'+m:m)+'-'+dt[0];
    }
    return view;
  }
  function alert_network(){
    $('#popup_loading').hide();
    alert_notif("Jaringan Gagal","Silahkan periksa jaringan internet anda.");
  }
	function alert_notif(title=null,pesan=null,fn=null,xclass="danger"){
    title=title==null?'Sukses':title;
    pesan=pesan==null?'Proses selesai!':pesan;
    $('#popup_loading').hide();
    $('#x_alert').remove();
    $("body").append(
            '<div id="x_alert">'
              +'<div class="x_alert_box">'
                +'<div class="x_alert_header x_color_'+xclass+'">'+title+'</div>'
                +'<div class="x_alert_body">'+pesan+'</div>'
                +'<div class="x_alert_footer">'
                  +'<div class="x_alert_btn_ok x_color_success x_btn">OK</div>'
                +'</div>'
              +'</div>'
            +'</div>');
    $(".x_alert_btn_ok").click(function(){
      if(fn!=null)fn();
      $("#x_alert").remove();
    });
}

function alert_confirm(pesan=null,ok=null,batal=null,xclass="warning"){
    pesan=pesan==null?'Proses selesai!':pesan;
    $('#popup_loading').hide();
    $("body").append(
            '<div id="x_alert">'
              +'<div class="x_alert_box">'
                +'<div class="x_alert_header x_color_'+xclass+'">Peringatan</div>'
                +'<div class="x_alert_body">'+pesan+'</div>'
                +'<div class="x_alert_footer">'
                  +'<div class="x_color_batal x_btn">Tidak</div>'
                  +'<div class="x_alert_btn_ok x_btn x_color_success">Ya</div>'
                +'</div>'
              +'</div>'
            +'</div>');
    $(".x_alert_btn_ok").click(function(){
      if(ok!=null)ok();
      $("#x_alert").remove();
    });
    $(".x_color_batal").click(function(){
      if(batal!=null)batal();
      $("#x_alert").remove();
    });
}

  function separator(txt){
    if(txt!=null&&txt!='')return Number(txt.toString().replace(/[^0-9]/g,'')).toLocaleString('id');
    else return '';
  }
function prevent(e,reg,max){
  e.value=e.value.replace(reg, '').slice(0,max);
}
$(document).ready(function(){
  $(".separator").on("input change",function(){
    var txt=$(this).val();
    var sep=separator(txt);
    $(this).val(sep);
  });
  $(document).on("click",".img_preview",function(){
    $("#img_preview img").attr('src',$(this).attr('src'));
    $("#img_preview").modal("show");
  });
  setTimeout(()=>{
    $(window).resize();
  },1000);
})
</script>
<body class="theme-red font-montserrat light_version showhidesidebar">
<div class="page-loader-wrapper" id="loading_data">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>
<div id="popup_loading" class="_backdrop">
	<div class="_table">
		<div class="_table_cell">
			<span class="_loader"></span>
			<div>Mohon Tunggu...</div>
		</div>
	</div>
</div>
<div id="img_preview" autocomplete="off" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="<?=base_url()?>assets/img/honda/logo.png"/>
                <div class="clearfix"></div>
                <div class="btn btn-dark mt-2" data-dismiss="modal">Tutup</div>
            </div>
        </div>
    </div>
</div>