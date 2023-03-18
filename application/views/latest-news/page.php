<?php $this->load->view('header.php');?>
<link href="<?=base_url()?>assets/css/sharon.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/js/sharer.min.js"></script>
<section id="banner-contact">
	<img class="img_banner" alt="">
</section><br> 
<style>
	.table th{
		padding: 5px!important;
		margin: 0px!important;
		border: 2px solid #000;
	} 
	.table th p{
		margin: 0px!important;
	} 
	.table td{
		padding: 5px!important;
		margin: 0px!important;
		border: 2px solid #000;
	}
	.table td p{
		margin: 0px!important;
	}
	.card-list p{
		margin: 0!important;
	}
	.card-list h2{
		margin: 0!important;
	}
</style>
<?php if(strlen($xid)>0):?>
<section id="data-mobil"></section>
<?php endif;?>  
<div class="box-form" align="right" style="padding:10px 25px!important;">  
	<span style="vertical-align: middle; color:#fff">Share on : </span>
	<div class="shareon">
	  	<a class="facebook"></a>
	  	<a class="linkedin"></a>
	  	<a class="pinterest"></a>
	  	<button class="telegram"></button>
	  	<button class="twitter"></button>
	  	<button class="whatsapp"></button>
  	</div>
</div>
<script src="<?=base_url()?>assets/newjscss/jquery.doubleScroll.js"></script>
<?php $this->load->view('footer.php');?>
<script type="text/javascript">
$(document).ready(function(){
	let request_lt = $.ajax({
		type: 'POST',
		url: '<?=base_url()?>api_v2/get_lates_news/',
		data : {tipe_ajax:btoa(0),xid:"<?=$xid?>",id_page:2},
		dataType: 'json',
	});
	request_lt.done(function(result){
		let render_dlt='';
		let render_judul='';
		if(result.length>0){
			for (var i=result.length-1;i>=0;i--){
				render_judul=result[i].judul;
				render_dlt+='<div class="md-title"><span class="md-title">'+result[i].judul+'<div class="underline"></div></span></div><div class="data-mobil-container" name="data-mobil"></div><div class="data-mobil-content"><div class="card-list" style="padding:10px;font-size:18px;color: black;word-wrap: break-word;text-align: justify; background-color:white;">'+(result[i].src_img!=null?'<center><img style="width:60%;height:auto;" src="'+result[i].src_img+'"></center>':'')+'<div class="clearfix">'+result[i].keterangan+'</div></div></div>';
			}
			$('#data-mobil').html(render_dlt);
			if($('table').length>0){
				$('table').addClass("table table-hover table-bordered");
				$('table').css("margin",'0px');
				
				$('table').wrap("<div class='table-responsivex col-md-12 dragscroll'></div>");
				$('.table-responsivex').doubleScroll({resetOnWindowResize: true});
			}
		}
	});
});
</script>