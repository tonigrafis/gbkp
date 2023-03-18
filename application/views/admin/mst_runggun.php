<div id="main-content">
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>MASTER RUNGGUN</h4>
					</div>
					<div class="px-4">
						<div class="row">
		                	<div class="col">
		                		<b>Nama Klasis</b>
		                		<select class="form-control" name="dt_id_klasis" data-width="100%"></select>
		                	</div>
		                	<div class="col align-self-end">
		                		<button class="btn btn-dark btn_reset">Lihat Semua Data</button>
		                	</div>
		                	<div class="col-6">
		                	</div>
		                </div>
		            </div>
	                <div class="clearfix"></div><br>
                <?php if($this->session->userdata("role")<=1){?>
					<button type="button" class="btn btn-sm btn-info pull-right bnt_new"><i class="fa fa-plus-square-o"></i> Tambah Data</button>	
				<?php } ?>	
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th width="1">No.</th>
								<th width="1">Nama Klasis</th>
								<th width="1">Aksi</th>
								<th>Nama Runggun</th>
								<th>Admin Runggun</th>
							</tr>
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
						<input class="d-none" name="id_runggun"/>
						<div class="col-md-12">
							Nama Klasis:
							<select class="form-control" name="id_klasis" data-width="100%" required></select>
							Nama Runggun:
							<input class="form-control" name="nama_runggun" oninput="prevent(this,/[^a-zA-Z ,]/,200)" required/>
							<small class="xinfo">*) Tambahkan pemisah koma untuk membuat banyak runggun sekaligus</small>
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
	var my_role=<?=$this->session->userdata("role")?>;
	var my_id_klasis=<?=$this->session->userdata("id_klasis")?>;
	var my_nama_klasis='<?=$this->session->userdata("nama_klasis")?>';
	if(my_role>0){
		$('[name="dt_id_klasis"]').append(new Option(my_nama_klasis,my_id_klasis,true,true));
	}
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
            "url": "<?php echo base_url('admin/runggun_datatable');?>",
            "type": "POST",
            "beforeSend": ()=>{return ldg()},
            data:{
            	id_klasis:function(){
            		if($("[name='dt_id_klasis']").val()===null)$(".btn_reset").hide();
            		else $(".btn_reset").show();
            		return $("[name='dt_id_klasis']").val()
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
            {data: 'nama_klasis'},
            {
            	data: 'id_runggun',
                render: function(data, type, row, meta) {
                	return my_role<=0||my_id_klasis==row.id_klasis?`<button class="btn btn-info" data-klasis='${btoa(JSON.stringify(row))}'>Ubah</button>`:'';
                },
                <?php if($this->session->userdata("role")>=2){?>
				visible:false
				<?php } ?>	
            },
            {data: 'nama_runggun'},
            {data: 'nama'},
        ],
		buttons: [
            {
                extend: 'excelHtml5',
            	filename:'Master Runggun',
            	className:'btn btn-primary ml-2',
                text: '<i class="fa fa-file-excel-o"></i> Export ke Excel',
                autoFilter: true,
				title:null,
				exportOptions: {
					columns:[0,1,3,4],
                },
				action : export_kadal
			},
		],
		rowsGroup:[1],
		createdRow:()=>{
			$('#popup_loading').hide();
		}
	}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");
	$(".btn_reset").click(function(){
		$('[name="dt_id_klasis"]').val(null).change();
	});
	$('[name="dt_id_klasis"]').change(function(){
		$('#datatable').DataTable().ajax.reload();
	});

	$('[name="id_klasis"],[name="dt_id_klasis"]').select2({
		placeholder: "Semua Klasis",
		allowClear: true,
	  ajax: {
	  	delay: 250,
	    url: '<?=base_url()?>admin/select_klasis',
	    type:'post',
	    dataType:'json',
	    data: function(params){
	      return {
		        search: params.term
		      };
	    },
	    processResults:function(data){
	      return {
	        results: data
	      };
	    }
	  }
	});
	$(document).on('click','[data-klasis]',function(){ 
		$('.xinfo').hide();
		var data=JSON.parse(atob($(this).data('klasis')));
		$('[name="id_klasis"]').append(new Option(data.nama_klasis,data.id_klasis,true,true)).trigger('change').prop('disabled',true);
		$('[name="id_runggun"]').val(data.id_runggun);
		$('[name="nama_runggun"]').val(data.nama_runggun);
		$('.modal-title').text('Ubah Data');
		$("#form_save").modal('show');
	});
	$(".bnt_new").click(function(){
		$("#form_save").trigger('reset');
		$('.xinfo').show();
		if(my_role<=0)$('[name="id_klasis"]').val(null).change().prop('disabled',false);
		else{
			$('[name="id_klasis"]').append(new Option(my_nama_klasis,my_id_klasis,true,true)).change().prop('disabled',true);
		}
		$('.modal-title').text('Tambah Data');
		$("#form_save").modal('show');
	})
	$("#form_save").submit(function(e){
		e.preventDefault();
		var data=$(this).serializeObject();
		data.id_klasis=$('[name="id_klasis"]').val();
		if(data.id_runggun!=""&&data.nama_runggun.match(/,/))alert_notif("Proses Gagal","Pemisah koma tidak diizinkan untuk ubah data.");
		else{
            $('#popup_loading').show();
			$.post("<?=base_url()?>admin/runggun_save",data,function(res){
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