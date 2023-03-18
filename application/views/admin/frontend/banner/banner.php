<div id="main-content"> 
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>Data Banner Beranda</h4>
						<button type="button" class="btn btn-sm btn-info pull-right bnt_new" data-toggle="modal" data-target="#postinput"><i class="fa fa-plus-square-o"></i> Tambah Data Banner</button>						
					</div>
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th>Aksi</th>
								<th>No.</th>  
								<th>Keterangan Banner</th>
								<th>Gambar Banner</th> 
								<th>Status Banner</th> 
							</tr>
						</thead>
						<tbody id="show_data">
						<?php $no=1; while($val=$data->unbuffered_row()){ ?>
							<tr>
								<td class="col-lg-1">
									<a href="<?=base_url('admin/delete_banner/'.encrypt_url($val->id_banner));?>" class="btn btn-danger hapusw"><i class="fa fa-trash"></i> Hapus</a>
									<a class="btn btn-info edit_banner text-white" 
										id="<?=$val->id_banner?>"
										ket="<?=$val->ket_banner??'';?>"
										url="<?=base_url('assets/img/honda/slide_home/'.$val->url_banner);?>"
										><i class="fa fa-pencil"></i> Ubah
									</a>
								</td>
								<td class="text-center"><?=$no++;?>.</td>
								<td class="col-lg-8"><?=$val->ket_banner??'';?></td>
								<td><img style="height:32px;" class="w-100" src="<?=base_url('assets/img/honda/slide_home/'.$val->url_banner);?>"/></div></td>
								<td><a href="<?=base_url('admin/status_banner/'.encrypt_url($val->id_banner).'/'.$val->sts_page);?>" class="w-100 btn btn-sm btn-<?=($val->sts_page==0?'default':'success text-white')?>"><?=($val->sts_page==0?'Tidak Tampil':'Tampil')?></a></td>
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
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" onsubmit="return ldg()" action="<?=base_url('admin/upload_banner/')?>" enctype="multipart/form-data" >
                <div class="modal-body">
					<h5 class="modal-title text-center" id="exampleModalLabel">Tambah Banner</h5>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							   <div class="form-group">
									<input type="hidden" name="id" readonly />
									<label class="label">Keterangan Banner : </label>
									<textarea class="form-control border_red" autocomplete="off" id="ket" name="keterangan" style="color: black;resize:none;"></textarea>
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
		let default_image='<img style="height:320px;width:700px;" src="<?=XnoImage();?>" id="imgView" class="card-img-top img-fluid">';
		$("#gambar_mx").html(default_image);
		$('#popup_loading').show();
        $("[name='id']").val(0);
        $("[name='keterangan']").val('');
		$('#text_ugh').text('Unggah file [format : *.jpg,*.jpeg,*.png]');
		$('#popup_loading').hide();
	});
	$('#show_data').on('click','.edit_banner',function(){
		let x_image='<img style="height:320px;width:700px;" src="'+encodeURI($(this).attr('url'))+'" id="imgView" class="card-img-top img-fluid">';
		$("#gambar_mx").html(x_image);
		$('#popup_loading').show();
        $("[name='id']").val($(this).attr('id'));
        $("[name='keterangan']").val($(this).attr('ket'));
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