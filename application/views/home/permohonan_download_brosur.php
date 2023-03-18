<?php $this->load->view('header.php');?>
<section id="banner-contact">
	<img class="img_banner" alt="">
</section>
<section id="data-mobil" oncontextmenu="return false;" ondragstart="return false;" ondrop="return false;">
<div class="box-form find_lokasi">
	<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div id="page-notif" class="alert" style="display:none;"></div>
	<span style="font-style: bold; color:#fff">Unduh Berita</span>
	<div class="clearfix"></div>
	<p style="color:#fff">Dapatkan file berita terbaru dari Mamre GBKP, silahkan isi data diri anda dibawah ini :</p>
	<div class="col-md-12">
		<div class="col-md-4 pull-left">
			<?php echo form_open('home/post_download_brosur','autocomplete="off" id="form_download" oninput="return cek_hp_kosong();"'); ?>
				<div class="form-group">
					<div class="row">
						<label class="lbl">First Name</label>
						<input placeholder="Your Answer" maxlength="225" class="form-control" name="first_name" type="text" pattern="[a-zA-Z]+|\s+" title="Format input huruf abjad (tanpa spasi)" required />
					</div>
					<div class="row">
						<label class="lbl">Last Name</label>
						<input placeholder="Your Answer" maxlength="225" class="form-control" name="last_name" type="text" pattern="[a-zA-Z ]+|\s+" title="Format input huruf abjad" required />
					</div>
					<div class="row">
						<label class="lbl">E-mail</label>
						<input placeholder="Your Answer" maxlength="225" class="form-control" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Format input email" required />
					</div>
					<div class="row">
						<label class="lbl">No. Telp.</label>
					</div>
					<div class="row">
						<div class="notif_error error_no_hp col-md-12"></div>
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-fw" style="width: 40px;text-align:center;font-size:16px;">08
								</i>
							</span>
							<input inputmode="numeric" placeholder="Your Answer" maxlength="16" class="no_hp form-control format_angka" pattern="\d+" title="Format input angka : 0-9" name="telp" type="tel" required />
							<?=form_submit('ubah','Unduh','id="btnf" disabled class="ml-2 btn btn-primary pull-right"'); ?>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-6 pull-right define_image" style="background-image: url(<?=base_url('assets/img/honda/bg.png');?>);background-repeat: no-repeat;background-position: center;"></div>
	</div>
</div>
<div class="clearfix"></div>
</section>
<?php $this->load->view('footer.php');?>
<script src="<?php echo base_url(); ?>assets/js/cleave.min.js"></script>
<script>
$('.format_angka').toArray().forEach(function(Field){ new Cleave(Field, { numeral: true,delimiter: '', numeralDecimalScale: 0, numeralPositiveOnly: true}); });	
let activeRequest = false;
function cek_hp_kosong(){
	var no_hp = $(".no_hp").val();
	var nohp = parseInt($(".no_hp").val())||0;
	if(no_hp == "" || nohp <= 0 || no_hp == null) {
		$("#btnf").attr("disabled", true);
		$(".error_no_hp").hide();
	}else{
		if((no_hp.length>=9)&&(no_hp.length<=14)){
			$("#btnf").attr("disabled", false);
			$(".error_no_hp").hide();
		}else{
			$("#btnf").attr("disabled", true);
			$(".error_no_hp").html("Maaf, anda belum memasukkan data No. Hp dengan benar.</br>");
			$(".error_no_hp").show();
		}
	}
}
$('#form_download').on('submit', function(e){
    e.preventDefault();
    $("#page-notif").hide();
    $('#popup_loading').show();
    let request_header = $.ajax({
		type: 'POST',
		url: $(this).attr('action'),
		data : $(this).serializeObject(),
		dataType: 'json'
	});
	request_header.done(function(xres){
		$('#popup_loading').hide();
		$("#page-notif").html('<div class="alert alert-'+xres.class+'" role="alert">'+xres.text+'</div>').show();
		window.setTimeout(function(){ $("#page-notif").hide();},30000);
		if(xres.class=='success'){
			$('#form_download').trigger('reset');
		}
	});
});
</script>
