<?php $this->load->view('header.php');?>
<section id="intro">
    <div class="intro-container">
		<div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel" data-interval="2500" data-pause="false">
			<ol class="carousel-indicators"></ol>
			<div class="carousel-inner" role="listbox">

				<div class="carousel-item active">
					<div class="carousel-background"><img src="<?php echo base_url(); ?>assets/underconstruction.jpg" alt=""></div>
				</div>
			</div>
		</div>
    </div> 
</section>
<?php $this->load->view('footer.php');?>
