<div id="main-content" >  
	<form method="post">
		<div class="card" style="margin-bottom: 0px;"> 
			<div class="body"> 
                <h5>Ubah Data Tentang GBKP</h5>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Judul Tentang GBKP</span>
                    </div>
                    <input type="text" class="form-control border_red" autocomplete="off" id="judul" name ="judul"aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $data->judul?>" style="color: black!important;">
                    <div class="input-group-append">
                        <button class="btn btn-success" id="simpan" type="button">Simpan Tentang GBKP</button>
                    </div>
                </div>
				<textarea name="ckeditor" id="ckeditor_conten" class="border_red"> <?php if($data!=null) echo $data->isi;?></textarea>
            </div>
        </div>
		<script>
			var editorElem = document.getElementById("ckeditor_conten");
			var editor = CKEDITOR.replace("ckeditor",  { 
				uiColor: '#9AB8F3' , 
				filebrowserUploadUrl: "<?php echo base_url(); ?>Admin/ajaxfile?type=file",
				filebrowserImageUploadUrl: "<?php echo base_url(); ?>Admin/ajaxfile?type=image"
			}); 
			editor.config.height = '400px';
		</script>
	</form> 
</div>
<script>
$(document).ready(function(){
    $("#simpan").click(function(){
        var isi = editor.getData();
        var judul = $("#judul").val();
        var id = "<?=$this->uri->segment(3);?>";
        if(judul=="") {
            alert('Silakan isi judul Tentang GBKP, terlebih dahulu.');
        }else if(isi==""){
            alert('Silakan isi keterangan dan gambar Tentang GBKP, terlebih dahulu.');
        }else{
			$.ajax({
                type : "POST",
                url  : "<?= base_url('admin/ubah_post_tentang_gbkp')?>",
                data : {judul:judul,isi:isi,id:id},
                beforeSend: function(){
					$('#popup_loading').show();
            	}, success: function(){
					window.location.href = "<?= base_url('admin/tentang_gbkp')?>";
                    console.log('berhasil diubah');
                }, error:function(){
					alert('Gagal mengubah data Tentang GBKP, silahkan ulangi kembali.');
					$('#popup_loading').hide();
                }
            });
		}  
	});
});
</script>