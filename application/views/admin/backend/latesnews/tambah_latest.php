<div id="main-content" >  
	<form method="post">
		<div class="card" style="margin-bottom: 0px;"> 
            <div class="body"> 
                <h5>Tambah Artikel</h5>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Judul Artikel</span>
                    </div>
                    <input type="text" class="form-control border_red" autocomplete="off" id="judul" name ="judul"aria-label="Default" aria-describedby="inputGroup-sizing-default" style="color: black!important;">
                    <div class="input-group-append">
                        <button class="btn btn-success" id="simpan" type="button">Simpan Artikel</button>
                    </div>
				</div>
				<textarea name="ckeditor" id="ckeditor_conten" class="border_red"> </textarea>
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
        if(judul=="") {
            alert('Silakan isi judul Artikel, terlebih dahulu.');
        }else if(isi==""){
            alert('Silakan isi keterangan dan gambar Artikel, terlebih dahulu.');
        }else{
            $.ajax({
                type : "POST",
                url  : "<?=base_url('admin/tambah_post_latest_news')?>",
                data : {judul:judul,isi:isi},
                beforeSend: function(){
					$('#popup_loading').show();
            	}, success: function(){
					window.location.href = "<?= base_url('admin/latest_news')?>";
                }, error:function(){
					alert('Gagal menambahkan data Artikel, silahkan ulangi kembali.');
					$('#popup_loading').hide();
				}
            });
		}      
	});
});
</script>