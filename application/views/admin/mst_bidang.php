<div id="main-content">
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>MASTER BIDANG</h4>
					</div>
	                <div class="clearfix"></div><br>
	                <?php if($this->session->userdata("role")<=0){?>
					<button type="button" class="btn btn-sm btn-info pull-right bnt_new"><i class="fa fa-plus-square-o"></i> Tambah Data</button>
					<?php } ?>	
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th width="1">No.</th>
								<th width="1">Aksi</th>
								<th>Nama Bidang</th>
						</thead>
					</table>
				</div>
            </div>
        </div>
    </div> 
</div>

<form id="form_save" autocomplete="off" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-sm modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
				<h5 class="modal-title text-center" id="exampleModalLabel">Tambah Data</h5>
				<div class="container">
					<div class="row">
						<input class="d-none" name="id_bidang"/>
						<div class="col-md-12">
							Nama Bidang:
							<input class="form-control" name="nama_bidang" oninput="prevent(this,/[^a-zA-Z ,()]/,200)" required/>
							<small class="xinfo">*) Tambahkan pemisah koma untuk membuat banyak bidang sekaligus</small>
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
            "url": "<?php echo base_url('admin/bidang_datatable');?>",
            "type": "POST",
            "beforeSend": ()=>{return ldg()},
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
            {
            	data: 'id_bidang',
                render: function(data, type, row, meta) {
                	return `<button class="btn btn-info" data-bidang='${btoa(JSON.stringify(row))}'>Ubah</button>`;
                },
                <?php if($this->session->userdata("role")>0){?>
				visible:false
				<?php } ?>	
            },
            {data: 'nama_bidang'},
        ],
		buttons: [
            {
                extend: 'excelHtml5',
            	filename:'Master Bidang',
            	className:'btn btn-primary ml-2',
                text: '<i class="fa fa-file-excel-o"></i> Export ke Excel',
                autoFilter: true,
				title:null,
				exportOptions: {
					columns:[0,2],
                },
				action : export_kadal
			},
		],
		createdRow:()=>{
			$('#popup_loading').hide();
		}
	}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");
	$(".bnt_new").click(function(){
		$("#form_save").trigger('reset');
		$('.xinfo').show();
		$('.modal-title').text('Tambah Data');
		$("#form_save").modal('show');
	});
	$(document).on('click','[data-bidang]',function(){ 
		$('.xinfo').hide();
		var data=JSON.parse(atob($(this).data('bidang')));
		$('[name="id_bidang"]').val(data.id_bidang);
		$('[name="nama_bidang"]').val(data.nama_bidang);
		$('.modal-title').text('Ubah Data');
		$("#form_save").modal('show');
	});
	$("#form_save").submit(function(e){
		e.preventDefault();
		var data=$(this).serializeObject();
		if(data.id_bidang!=""&&data.nama_bidang.match(/,/)&&!data.nama_bidang.match(/(\(|\))/))alert_notif("Proses Gagal","Pemisah koma tidak diizinkan untuk ubah data.");
		else{
			$('#popup_loading').show();
			$.post("<?=base_url()?>admin/bidang_save",data,function(res){
				$('#popup_loading').hide();
				if(res=='ok'){
					$("#form_save").modal('hide');
					$('#datatable').DataTable().ajax.reload();
				}else{
					alert_notif("Proses Gagal",res,()=>{
						$('#datatable').DataTable().ajax.reload();
					})
				}
			}).fail(()=>alert_network());
		}
	})
});
</script>