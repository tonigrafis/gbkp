<?php $this->load->view('header.php');?>
<section id="banner-contact">
	<img class="img_banner define_image" src="<?=base_url('assets/img/honda/bg.png');?>">
</section>
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
<?php if(count($data)>0):?>
<style type="text/css">
	.page-item,.page-link{
		padding: 0!important;
		text-align: center!important;
		display: table!important;
	}
	.pagination .page-item a {
		vertical-align: middle!important;
		padding: 0.5rem 1.5rem!important;
		display: block;
	}
</style>
<section id="data-mobil">
	<div class="md-title">
		<span class="md-title" style="margin: 0px;">Semua Artikel<div class="underline"></div></span>
    </div>
	<div class="data-mobil-container" name="data-mobil"> 
		<div class="data-mobil-content">
		<?php for($i = 0; $i <count($data); $i++){ $baris = $data[$i];?>
			<div class="card-list">
				<div class="card-list-title"> 
					<img src="<?=$data[$i]['thumbnail'];?>">
				</div>
				<div class="card-list-container">
					<h2><?php echo $data[$i]['judul']?><div class="underline" ></div></h2>  
					<p class="p-arikel"><?php echo $data[$i]['isi']?>...</p> 
					<a href="<?php echo base_url(); ?>Latest_news/pages/<?php echo encrypt_url($data[$i]['id_posting']);?>" class="btn-border danger pull-right"> <i class="fa fa-bookmark-o"></i> Baca Selengkapnya</a> 
				</div>     
			</div> 
		<?php } echo $this->pagination->create_links();?>
		</div>		
	</div>
	<br><br>
</section>
<?php endif;?> 
<?php $this->load->view('footer.php');?>