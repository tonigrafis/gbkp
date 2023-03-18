<div id="main-content">
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
						<?php 
						$my_role=$this->session->userdata("role");
						$title=$dikirim=$diterima=$penerima="";
						if($my_role<=0){
							$title.=" PUSAT";
							$dikirim="d-none";
						}else if($my_role==1){
							$title.=" KLASIS (".$this->session->userdata("nama_klasis").")"; 
							$penerima="Pusat";
						}
						else if($my_role==2){
							$title.=" RUNGGUN (".$this->session->userdata("nama_runggun").")"; 
							$penerima="Sektor ".$this->session->userdata("nama_klasis");
						}
						else{
							$title.=" SEKTOR (".$this->session->userdata("nama_sektor").")"; 
							$diterima="d-none";
							$penerima="Runggun ".$this->session->userdata("nama_runggun");
						}
						 ?>
                        <h4 class="title">UNDANGAN <?=$title?></h4>
					</div>
	                <div class="clearfix"></div>
					Tipe : <div class="rounded border d-inline-block p-2">
						<div class="custom-control <?=$diterima?> custom-radio custom-control-inline">
						  <input type="radio" id="undangan_diterima" name="tipe_undangan" class="custom-control-input" value="diterima" <?=$diterima==""?"checked":""?>>
						  <label class="custom-control-label" for="undangan_diterima">Undangan Diterima</label>
						</div>
						<div class="custom-control <?=$dikirim?> custom-radio custom-control-inline">
						  <input type="radio" id="undangan_dikirim" name="tipe_undangan" class="custom-control-input" value="dikirim" <?=$diterima==""?"":"checked"?>>
						  <label class="custom-control-label" for="undangan_dikirim">Undangan Dikirim</label>
						</div>
					</div><br><br>
                <?php if($this->session->userdata("role")>=1){?>
					<button type="button" class="btn btn-sm btn-info pull-right bnt_new"><i class="fa fa-plus-square-o"></i> Kirim Undangan</button>	
				<?php } ?>
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th width="1">No.</th>
								<th>Perihal</th>
								<th width="1">Pengirim</th>
								<th width="1">Penerima</th>
								<th width="1">Tanggal Kirim</th>
								<th width="1">File Undangan</th>
							</tr>
						</thead>
					</table>
				</div>
            </div>
        </div>
    </div> 
</div>

<form id="form_save" enctype="multipart/form-data" autocomplete="off" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
				<h5 class="modal-title text-center" id="exampleModalLabel">Tambah Data</h5>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							Perihal:
							<input class="form-control mb-2" name="perihal" oninput="prevent(this,/[^a-zA-Z 0-9@%&*()+-=:'<>,./]/,200)" required/>
							Penerima:
							<input class="form-control mb-2 text-dark" value="<?=$penerima?>" disabled/>
							File Undangan:
							<input class="form-control p-1" type="file" name="file_undangan" onchange="readAsBase64(this)" accept="application/pdf"/>
						</div>
					</div>
				</div>
				<br><div class="clearfix"></div>
					<button type="submit" class="btn btn-success btn_simpan pull-right" value="upload">Simpan</button>
					<div class="btn btn-dark pull-left" data-dismiss="modal">Kembali</div>
				<br><div class="clearfix"></div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
	var base64File;
function readAsBase64(ths){

	var files =ths.files;
	if (files.length > 0) {

	    var fileToLoad = files[0];
	    var fileReader = new FileReader();
	    // Reading file content when it's loaded
	    fileReader.onload = function(event) {
	        base64File = event.target.result.replace("data:application/pdf;base64,","");
	    };

	    // Convert data to base64
	    fileReader.readAsDataURL(fileToLoad);
	}
}
$(document).ready(function(){
	$('#datatable').dataTable({
		dom: '<"pull-left"f>Brt<"bottom"p><"clear">',
		autoWidth: false,
       	destroy: true,
       	filters: false,
       	ordering: false,
        info: false,
        lengthChange: false,
        serverSide: true,
		ajax: {
            "url": "<?php echo base_url('admin/undangan_datatable');?>",
            "type": "POST",
            "beforeSend": ()=>{return ldg()},
            data:{
            	tipe:function(){
            		return $("[name='tipe_undangan']:checked").val()
            	},
            },
            dataSrc :function(res){
            	$('#popup_loading').hide();
               	return res.data;
            }
        },
        columns: [
            {
            	data: 'dt_nomor',
            	className:'text-center',
                render: function(data, type, row, meta) {	
                    return data+'.';
                }
        	},
            {data: 'perihal'},
            {data: 'pengirim'},
            {data: 'penerima'}, 
            {data: 'tgl_kirim'},
            {
            	data: 'file_undangan',
                render: function(data, type, row, meta) {
                	return `<a target="_blank" class="btn btn-info" href="<?=base_url()?>assets/pdf/${data}">Unduh Undangan</a>`;
                }
            }
        ],
		buttons: [
            {
                extend: 'excelHtml5',
            	filename:'Data Undangan',
            	className:'btn btn-primary ml-2',
                text: '<i class="fa fa-file-excel-o"></i> Export ke Excel',
                autoFilter: true,
				title:null,
				// exportOptions: {
				// 	columns:[0,2,3],
                // },
				action : export_kadal
			},
		],
		createdRow:()=>{
			$('#popup_loading').hide();
		}
	}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");
	$('[name="tipe_undangan"]').change(function(){
		$('#datatable').DataTable().ajax.reload();
	});
	$(".bnt_new").click(function(){
		$("#form_save").trigger('reset');
		$('.xinfo').show();
		$('.modal-title').text('Tambah Data');
		$("#form_save").modal('show');
	})
	$("#form_save").submit(function(e){
		e.preventDefault();
		$('#popup_loading').show();

		var data=$("#form_save").serializeObject();
		data.file_undangan=base64File;
		$.post("<?=base_url()?>admin/undangan_save",data,function(res){
			$('#popup_loading').hide();
			if(res=='ok'){
				$("#form_save").modal('hide');
				$("#undangan_dikirim").prop("checked",true).change();
			}else{
				alert_notif("Proses Gagal",res,()=>{
					$('#datatable').DataTable().ajax.reload();
				})
			}
		}).fail(()=>alert_network());
	});
});
</script>