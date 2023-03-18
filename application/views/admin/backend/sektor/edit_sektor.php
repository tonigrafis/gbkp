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
                <h5>Ubah Data Sektor</h5>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nama Sektor</span>
                    </div>
                    <input type="text" class="form-control border_red" autocomplete="off" id="judul" name ="judul"aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?= $data->judul?>" style="color: black!important;">
                    
                    <div class="input-group-prepend ml-3">
                        <span class="input-group-text">Nama Runggun</span>
                    </div>
                    <input class="form-control border_red" id="runggun" readonly name ="runggun" value="<?= $data->runggun?>" style="color: black!important;">
                    <input hidden class="form-control border_red" id="runggun_hide" readonly name ="runggun_hide" value="<?= $data->id_runggun?>" style="color: black!important;">
                    
                    <div class="input-group-prepend ml-3">
                        <span class="input-group-text" >Pilih Runggun</span>
                    </div>
                    <select id="id_runggun" class="form-control" name="id_runggun"></select>

                    <div class="input-group-append ml-3">
                        <button class="btn btn-success" id="simpan" type="button">Simpan Sektor</button>
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
        var isi     = editor.getData();
        var judul   = $("#judul").val();
        var id      = "<?=$this->uri->segment(3);?>";
        var id_runggun_hide = $("#runggun_hide").val();
        var id_runggun      = $("#id_runggun").val();

        if(judul=="") {
            alert('Silakan isi nama Sektor, terlebih dahulu.');
        }else if(isi==""){
            alert('Silakan isi keterangan dan gambar Sektor, terlebih dahulu.');
        }else{
			$.ajax({
                type : "POST",
                url  : "<?= base_url('admin/ubah_post_sektor')?>",
                data : {
                    judul:judul,
                    isi:isi,
                    id:id,
                    id_runggun_hide:id_runggun_hide,
                    id_runggun:id_runggun
                },
                beforeSend: function(){
					$('#popup_loading').show();
            	}, success: function(){
					window.location.href = "<?= base_url('admin/sektor')?>";
                    console.log('berhasil diubah');
                }, error:function(){
					alert('Gagal mengubah data Sektor, silahkan ulangi kembali.');
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