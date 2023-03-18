<?php $this->load->view('header.php');?>
<section id="banner-contact">
	<img class="img_banner" alt="">
</section>
<section id="data-mobil">
<div class="md-title">
	<span class="md-title">Unduh E-BROSUR<div class="underline"></div></span>
</div>
<div class="data-mobil-content">
	<div class="card-list">
		<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
		<div class="col-md-12" id="data_brosur"></div>
	</div>
</div>
</section>
<?php $this->load->view('footer.php');?>
<script type="text/javascript">
$(document).ready(function(){
	let request_cs = $.ajax({
		type: 'POST',
		url: '<?=base_url()?>api_v2/get_brosur/',
		data : {tipe_ajax:btoa(0)},
		dataType: 'json',
	});
	request_cs.done(function(result){
		let render_kr='';
		if(result.length>0){
			render_kr+='Silakan unduh E-Brosur di bawah ini...<div class="clearfix"></div>';
			let sort_data_brosur=result.sort(function(b, a){return a.nomor - b.nomor});
			for (var i=sort_data_brosur.length-1;i>=0;i--){
				render_kr+='<ul class="list-group"><li class="list-group-item"><a href="'+encodeURI(sort_data_brosur[i].url)+'" download>'+sort_data_brosur[i].nomor+'. '+sort_data_brosur[i].keterangan+'</a></li></ul>';
			}
			render_kr+='<div class="clearfix"></div><br>';
		}else{
			render_kr+='Oopss, maaf kami belum memiliki E-Brosur yang tersedia saat ini.';
		}
		$('#data_brosur').html(render_kr);
	});
});
</script>
