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
<section id="news" style="display:none;">
	<div class="col-lg-9 col-md-8 col-sm-12 pull-left">
		<p class="p-arikel">Berikut adalah daftar sektor, silahkan <i>klik</i> ditombol Baca Selengkapnya untuk melihat daftar sektor.</p>
	</div><div class="col-lg-3 col-md-4 col-sm-6 pull-right">
		<input type="text" id="cari" style="float: right;display: none;" class="form-control" placeholder="Cari / Ketik Sektor ...." autocomplete="off" onpaste="false"></input>
	</div>
	<div class="clearfix"></div>
	<div class="row col-lg-12 col-md-12 col-sm-12" id="xrow_news"></div>
</section>
<script src="<?=base_url()?>assets/newjscss/jquery.doubleScroll.js"></script>
<?php $this->load->view('footer.php');?>
<script type="text/javascript">
$(document).ready(function(){
	let request_lt = $.ajax({
		type: 'POST',
		url: '<?=base_url()?>api_v2/get_lates_news/',
		data : {tipe_ajax:btoa(0),xid:"<?=$xid?>",id_page:9},
		dataType: 'json',
	});
	request_lt.done(function(result){
		let render_dlt='';
		let render_judul='';
		if(result.length>0){
			for (var i=result.length-1;i>=0;i--){
				render_judul=result[i].judul;
				render_dlt+='<div class="md-title"><span class="md-title">'+result[i].judul+'<div class="underline"></div></span></div><div class="data-mobil-container" name="data-mobil"></div><div class="data-mobil-content"><div class="card-list" style="padding:10px;font-size:18px;color: black;word-wrap: break-word;text-align: justify; background-color:white;"><div class="clearfix">'+result[i].keterangan+'</div></div></div>';
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

	let request_sub_page = $.ajax({
		type: 'POST',
		url: '<?=base_url()?>api_v2/get_all_sub_page/',
		data : {tipe_ajax:btoa(0),xid:"<?=$xid?>",id_page:10},
		dataType: 'json',
	});
	request_sub_page.done(function(result){
		if(result.length>0){
			let render_ne='';
			let sort_data_news=result.sort(function(a, b){return a.sort - b.sort});
			for (var i=sort_data_news.length-1;i>=0;i--){
				render_ne+='<div class="col-lg-3 col-md-4 col-sm-6"><center><div class="card-border"><img class="card-img-xnews" src="'+sort_data_news[i].src_img+'" alt="Avatar"><div class="card-body" style="padding:0 2px;"><h4 class="resize_font" style="margin:10px 0!important;">'+sort_data_news[i].judul+'</h4><textarea readonly="readonly" class="form-control" style="white-space: normal!important;text-align:justify!important;border:none!important;height: 120px!important;resize: none;">'+sort_data_news[i].keterangan.replace(/<[^>]*>?/gm, '')+'</textarea><div class="clearfix"></div><a href="'+encodeURI(sort_data_news[i].url)+'" class="btn-border danger pull-right" style="padding:0px 5px;margin:5px 0;"><i class="fa fa-bookmark-o"></i> Baca Selengkapnya</a><br></div></div></center></div>';
			}
			$('#xrow_news').html(render_ne);
			$("#news").show();
			$('#cari').show();
			auto_resize_text();
		}else{
			$("#news").hide();
			$('#cari').hide();
		}
	});
});
$("#cari").keyup(function() {
	var xfilter=$(this).val();
	you_can_do_this(xfilter,'news');
});
</script>