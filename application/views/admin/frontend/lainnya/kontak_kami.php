<div id="main-content"> 
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>Data Kontak Kami</h4>
						<button type="button" class="btn btn-sm btn-info pull-right bnt_new" data-toggle="modal" data-target="#postinput"><i class="fa fa-plus-square-o"></i> Tambah Kontak Kami</button>						
					</div>
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th>Aksi</th>
								<th>No.</th>  
								<th>Nama Kontak</th>
								<th>Nomor WA (WhatsApp)</th>
								<th>Gambar Kontak</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody id="show_data">
						<?php $no=1; while($val=$data->unbuffered_row()){ ?>
							<tr>
								<td> 
									<a style="color:white;" url="<?=base_url('assets/img/'.$val->foto_pp);?>" class="btn btn-sm btn-info edit_banner" pass="<?=$val->no_wa;?>" nama="<?=$val->nama_pengguna;?>" id="<?=$val->id_chat;?>"><i class="fa fa-pencil"></i> Ubah</a>      
									<a class="btn btn-sm btn-danger" href="<?= base_url()?>admin/hapus_chat/<?=encrypt_url($val->id_chat);?>"><i class="fa fa-trash"></i> Hapus</a>
								</td>	
								<td><?= $no++;?></td>
								<td class="col-lg-2"><?= $val->nama_pengguna;?></td>
								<td class="col-lg-3"><?=$val->no_wa;?></td>
								<td><img style="height:32px;" class="w-100" src="<?=base_url('assets/img/'.$val->foto_pp);?>"/></div></td>
								<td><a href="<?=base_url('admin/status_chat/'.encrypt_url($val->id_chat).'/'.$val->sts_chat);?>" class="w-100 btn btn-sm btn-<?=($val->sts_chat==0?'default':'success text-white')?>"><?=($val->sts_chat==0?'Tidak Tampil':'Tampil')?></a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
                </div>
			</div> 
        </div>
     </div>
</div>
<div class="modal fade" id="postinput" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" onsubmit="return ldg()" action="<?=base_url('admin/upload_kontak/')?>" enctype="multipart/form-data" >
                <div class="modal-body">
					<h5 class="modal-title text-center" id="exampleModalLabel">Tambah Kontak Kami</h5>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							   <div class="form-group">
									<input type="hidden" name="id" readonly />
									<label class="label">Nama Kontak : </label>
									<input class="form-control border_red" autocomplete="off" id="ket" name="keterangan" required></input>
								</div>
							   <div class="form-group">
									<label class="label">Nomor WA (WhatsApp) : </label>
									&nbsp;<input class="form-control border_red" autocomplete="off" id="no_wa" name="no_wa" inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" maxlength="17" required></input>
								</div>
								<div class="form-group">
									<label class="label"><small style="color:red;"> ** size maks. 2MB</small></label>
									<div class="imgWrap" id="gambar_mx" onclick="document.getElementById('img').click()"></div>
									<div class="custom-file border_red">
										<input type="file" id="img" class="custom-file-input" name="nama_file">
										<label class="custom-file-label" id="text_ugh">Unggah file [format : *.jpg,*.jpeg,*.png]</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br><div class="clearfix"></div>
						<button type="submit" class="btn btn-success simpan pull-right" value="upload">Simpan</button>
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
					<br><div class="clearfix"></div>
                </div>
			</form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
	$('.bnt_new').click(function(){
		let default_image='<img style="height:160px;width:180px;" src="<?=XnoImage();?>" id="imgView" class="card-img-top img-fluid">';
		$("#gambar_mx").html(default_image);
		$('#popup_loading').show();
        $("[name='id']").val(0);
        $("[name='keterangan']").val('');
        $("[name='no_wa']").val('');
		$('#text_ugh').text('Unggah file [format : *.jpg,*.jpeg,*.png]');
		$('#popup_loading').hide();
	});
	$('#show_data').on('click','.edit_banner',function(){
		let x_image='<img style="height:160px;width:180px;" src="'+encodeURI($(this).attr('url'))+'" id="imgView" class="card-img-top img-fluid">';
		$("#gambar_mx").html(x_image);
		$('#popup_loading').show();
        $("[name='id']").val($(this).attr('id'));
        $("[name='keterangan']").val($(this).attr('nama'));
        $("[name='no_wa']").val($(this).attr('pass'));
		$('#text_ugh').text('Unggah file [format : *.jpg,*.jpeg,*.png]');
		$('#popup_loading').hide();
		$("#postinput").modal('show'); 
	});

	$('#datatable').dataTable({dom:'<"pull-left"f><t>p',autoWidth: false, stateSave: true}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");   

	$("#img").change(function(event){  
		fadeInAdd();
		getURL(this);    
    });

    $("#img").on('click',function(event){
		fadeInAdd();
    });

    function getURL(input){    
		if(input.files && input.files[0]) {   
			$('#popup_loading').show();
			var reader = new FileReader();
			filename = $("#img").val();
			filename = filename.substring(filename.lastIndexOf('\\')+1);
			reader.onload = function(e) {
				debugger;      
				$('#imgView').attr('src', e.target.result);
				$('#imgView').hide();
				$('#imgView').fadeIn(500);  
				$("#img_text").html(filename);	
			}
			reader.readAsDataURL(input.files[0]);
			$('#popup_loading').hide();
		}
		$(".alert").removeClass("loadAnimate").hide();
    }

    function fadeInAdd(){
		fadeInAlert();  
    }

    function fadeInAlert(text){
		$(".alert").text(text).addClass("loadAnimate");  
    }

	function getFileName(path){
		return path.match(/[-_\w]+[.][\w]+$/i)[0];
	}
});
</script>