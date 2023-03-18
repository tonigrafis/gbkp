<link href="<?=base_url('assets/select/select2.min.css');?>" rel="stylesheet">
    <script src="<?=base_url('assets/select/select2.min.js')?>"></script>
    <link href="<?=base_url('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/datatable-btn-export-excel.css');?>" rel="stylesheet">
    <script src="<?=base_url('assets/vendors/datatables.net/js/jquery.dataTables.min.js');?>"></script> 
    <script src="<?=base_url('assets/dtatable-btn.js');?>"></script> 
    <script src="<?=base_url('assets/pdfmake.js');?>"></script> 
    <script src="<?=base_url('assets/html-exprtdtatable.js');?>"></script> 
    <script src="<?=base_url('assets/js/jquery.doubleScroll.js');?>"></script> 
<script src="<?=base_url('assets/js/dragscroll.js');?>"></script>

<style>
    .select2-selection__rendered{line-height: 40px !important;}
    .select2-container .select2-selection--single {height: 40px !important}
</style>

<div id="main-content" >  
	<form method="post">
		<div class="card" style="margin-bottom: 0px;"> 
            <div class="body"> 
                <h5>Tambah Sektor</h5>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Nama Sektor</span>
                    </div>
                    <input type="text" class="form-control border_red" autocomplete="off" id="judul" name ="judul"aria-label="Default" aria-describedby="inputGroup-sizing-default" style="color: black!important;">
                    
                    <div class="input-group-prepend ml-3">
                        <span class="input-group-text" >Pilih Runggun</span>
                    </div>
                    <select id="id_runggun" class="form-control" name="id_runggun"></select>

                    <div class="input-group-append ml-3">
                        <button class="btn btn-success" id="simpan" type="button">Simpan Sektor</button>
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
            var isi     = editor.getData();
            var judul   = $("#judul").val();
            var runggun = $("#id_runggun").val();
            if(judul=="") {
                alert('Silakan isi judul Sektor, terlebih dahulu.');
            }else if(isi==""){
                alert('Silakan isi keterangan dan gambar Sektor, terlebih dahulu.');
            }else{
                $.ajax({
                    type : "POST",
                    url  : "<?=base_url('admin/tambah_post_sektor')?>",
                    data : {
                        judul:judul,
                        isi:isi,
                        runggun: runggun
                    },
                    beforeSend: function(){
                        $('#popup_loading').show();
                    }, success: function(){
                        window.location.href = "<?= base_url('admin/sektor')?>";
                    }, error:function(){
                        alert('Gagal menambahkan data Sektor, silahkan ulangi kembali.');
                        $('#popup_loading').hide();
                    }
                });
            }      
        });
    });
</script>
<script>
    $("#id_runggun").select2({
            placeholder: 'Pilih Runggun',
            maximumInputLength: 30,
            allowClear: true,
            ajax: { 
                url:"<?php echo base_url('Select/select_runggun')?>",
                type: "post",
                dataType: 'json',
                data: function (params){
                    return {
                        search: params.term
                    };
                },
                processResults: function(data){
                    var results = [];

                    $.each(data, function(index, item){
                        results.push({
                            id: item.id_posting,
                            text: item.judul
                        });
                    });
                    return{
                        results: results
                    };
                },
                cache: false
            }
    });
</script>