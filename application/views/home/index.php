<?php $this->load->view('header.php');?>

<section id="intro" style="display:none;">
	<div class="intro-container">
		<div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2500" data-pause="false">
			<ol class="carousel-indicators"></ol>
			<div class="carousel-inner" role="listbox" id="data_banner"></div>
			<a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</section>

<section id="news" style="display:none;">
	<p class="text-center artikel" style="margin:0;"> -- Artikel Terbaru-- </p>
	<div class="row col-lg-12 col-md-12 col-sm-12" id="xrow_news"></div>
</section>

<?php $this->load->view('footer.php');?>
<script>
	$(document).ready(function(){
		let request_home = $.ajax({
			type: 'POST',
			url: '<?=base_url()?>api_v2/get_all_home_page/',
			data : {tipe_ajax:btoa(0)},
			dataType: 'json',
		});
		request_home.done(function(result){
			if(result[0].length>0){
				let render_banner='';
				$('#intro').show();
				let sort_data_banner=result[0].sort(function(a,b){
					return a.id_banner-b.id_banner
				});
				for (var i=sort_data_banner.length-1;i>=0;i--){
					render_banner+='<div class="carousel-item '+(i==0?'active':'')+'"><div class="carousel-background"><img class="img-bg" src="'+sort_data_banner[i].src_img+'" alt=""></div><div class="carousel-container"><div class="carousel-content">'+(sort_data_banner[i].ket_banner?'<h2>'+sort_data_banner[i].ket_banner+'</h2>':'')+'</div></div></div>';
				}
				$('#data_banner').html(render_banner);
			}else{
				$('#intro').show().css("height","120px");
			}
			
			if(result[1].length>0){
				let render_ne='';
				let sort_data_news=result[1].sort(function(a, b){return a.sort - b.sort});
				for (var i=sort_data_news.length-1;i>=0;i--){
					render_ne+='<div class="col-lg-3 col-md-4 col-sm-6"><center><div class="card-border"><img class="card-img-xnews" src="'+sort_data_news[i].src_img+'" alt="Avatar"><div class="card-body" style="padding:0 2px;"><h4 class="resize_font" style="margin:10px 0!important;">'+sort_data_news[i].judul+'</h4><textarea readonly="readonly" class="form-control txt-news" style="white-space: normal!important;text-align:justify!important;border:none!important;height: 120px!important;resize: none;">'+sort_data_news[i].keterangan.replace(/<[^>]*>?/gm, '')+'</textarea><div class="clearfix"></div><a href="'+encodeURI(sort_data_news[i].url)+'" class="btn-border danger pull-right" style="padding:0px 5px;margin:5px 0;"><i class="fa fa-bookmark-o"></i> Baca Selengkapnya</a><br></div></div></center></div>';
				}
				render_ne+='<div class="clearfix"></div><div class="text-center news-item-botom"><a href="'+encodeURI(sort_data_news[0].xurl)+'" class="btn-border black-invert"><i class="fa fa-newspaper-o"></i> Semua Artikel</a></div>';
				$('#xrow_news').html(render_ne);
				$("#news").show();
				auto_resize_text();
			}else{
				$("#news").hide();
			}
		});

	});
</script>
