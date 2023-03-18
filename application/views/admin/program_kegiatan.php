<style type="text/css">
	.btn_pilih_tanggal{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		white-space: nowrap;
	}
	input[type="date"]{
	    position: relative;
	    opacity: 0;
	}
	input[type="date"]::-webkit-calendar-picker-indicator {
	    color: rgba(0, 0, 0, 0);
	    display: block;
	    border-width: thin;
	    opacity: 0;
	    width: 100%;
	    height: 100%;
	    position: absolute;
	    cursor: pointer;
	}
	.form_filter .select2-selection--single{
		border:1px solid #b8daff!important;
	}
</style>
<div id="main-content">
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
                    <h4>PROGRAM KERJA</h4>
					<form class="form_filter py-2 px-3 alert-primary">
						<div class="row">
		                	<div class="col-lg-4 col-md-6 mb-2">
		                		<b>Tahun</b>
		                		<select class="form-control select2" name="dt_tahun" data-width="100%">
		                			<?php for($x=2023;$x<=date("Y")+1;$x++){?>
		                				<option value="<?=$x?>" <?=$x==date("Y")?'selected':''?>><?=$x?></option>
		                			<?php }?>
		                		</select>
		                	</div>
		                	<div class="col-lg-4 col-md-6 mb-2">
		                		<b>Jenis Program</b>
		                		<select class="form-control select2" name="dt_jenis" data-width="100%">
		                			<option value="pusat">Pusat</option>
		                			<option value="klasis">Klasis</option>
		                			<option value="runggun">Runggun</option>
		                			<option value="sektor">Sektor</option>
		                		</select>
		                	</div>
		                	<div class="col-lg-4 col-md-6 mb-2 klasis">
		                		<b>Nama Klasis</b>
		                		<select class="form-control" name="dt_id_klasis" data-width="100%"></select>
		                	</div>
		                	<div class="col-lg-4 col-md-6 mb-2 runggun">
		                		<b>Nama Runggun</b>
		                		<select class="form-control" name="dt_id_runggun" data-width="100%" disabled></select>
		                	</div>
		                	<div class="col-lg-4 col-md-6 mb-2 sektor">
		                		<b>Nama Sektor</b>
		                		<select class="form-control" name="dt_id_sektor" data-width="100%" disabled></select>
		                	</div>
		            	</div>
		            </form>
	                <div class="clearfix"></div><br>
					<div class="table_area">
						<div class="text-center title h4 mb-4"></div>
						<button type="button" class="btn btn-sm btn-info pull-right bnt_new"><i class="fa fa-plus-square-o"></i> Tambah Data</button>	
						<table class="table table-bordered table-custom" id="datatable">
							<thead>
								<tr>
									<th width="1">No.</th>
									<th>Nama Bidang</th>
									<th>Aksi</th>
									<th>Nama Kegiatan</th>
									<th>Tempat</th>
									<th>Tujuan</th>
									<th>Target Fisik</th>
									<th>Anggaran Lokal (Rp.)</th>
									<th>Anggaran Subsidi (Rp.)</th>
									<th>Total Anggaran (Rp.)</th>
									<th>Pelaksana</th>
									<th>Jadwal Pelaksanaan</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th colspan="6" class="font-weigth-bold">TOTAL</th>
									<th>fisik</th>
									<th>Anggaran Lokal</th>
									<th>Anggaran Subsidi</th>
									<th>Total Anggaran</th>
									<th colspan="3"></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
            </div>
        </div>
    </div> 
</div>

<form id="form_save" autocomplete="off" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
				<h5 class="modal-title text-center" id="exampleModalLabel">Tambah Data</h5>
				<div class="container">
					<b class="text-center popup_title"></b>
					<div class="row mt-2">
						<div class="col-lg-4">
						<input class="d-none" name="id_kegiatan"/>
	                		Nama Bidang :
	                		<select class="form-control" name="id_bidang" data-width="100%" required></select>
							<div class="mt-2">Nama Kegiatan :</div>
							<input class="form-control mb-2" name="nama_kegiatan" oninput="prevent(this,/[^a-zA-Z 0-9@%&*()+-=:'<>,./]/,200)" required>
							Tempat :
							<input class="form-control mb-2" name="tempat" oninput="prevent(this,/[^a-zA-Z 0-9@%&*()+-=:'<>,./]/,200)" required>
							Tujuan :
							<input class="form-control mb-2" name="tujuan" oninput="prevent(this,/[^a-zA-Z 0-9@%&*()+-=:'<>,./]/,200)" required>
						</div>
						<div class="col-lg-4">
							Target Fisik :
							<div class="input-group mb-2">
								<input class="form-control separator" name="target_fisik" oninput="prevent(this,/[^0-9]/,200)" required>
						        <div class="input-group-append">
						          <div class="input-group-text">Kali</div>
						        </div>
						    </div>
							Anggaran Lokal :
							<div class="input-group mb-2">
						        <div class="input-group-prepend">
						          <div class="input-group-text">Rp</div>
						        </div>
								<input class="form-control separator" name="anggaran_lokal" oninput="prevent(this,/[^0-9]/,16)" required>
						    </div>
							Anggaran Subsidi : <i>(Opsional)</i>
							<div class="input-group mb-2">
						        <div class="input-group-prepend">
						          <div class="input-group-text">Rp</div>
						        </div>
								<input class="form-control separator" name="anggaran_subsidi" oninput="prevent(this,/[^0-9]/,16)">
							</div>
							Total Anggaran :
							<div class="input-group mb-2">
						        <div class="input-group-prepend">
						          <div class="input-group-text">Rp</div>
						        </div>
								<input class="form-control separator" name="total_anggaran" disabled/>
						     </div>
						</div>
						<div class="col-lg-4">
							Pelaksana :
							<input class="form-control mb-2" name="pelaksana" oninput="prevent(this,/[^a-zA-Z 0-9@%&*()+-=:'<>,./]/,200)" required>
							Jadwal Pelaksanaan :
							<div class="list_jadwal"></div>
							<div class="position-relative mb-2">
								<div class="btn_pilih_tanggal btn btn-primary"><i class="fa fa-plus"></i> Tambah Jadwal</div>
								<input class="form-control date_peek" type="date">
							</div>
							Keterangan : <i>(Opsional)</i>
							<textarea style="min-height: 100px;" class="form-control mb-2" name="keterangan" oninput="prevent(this,/[^a-zA-Z 0-9@%&*()+-=:'<>,./\n]/,500)"></textarea>
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
	var form_filter={};
	$("[name='dt_jenis']").change(function(){
		var jenis=$(this).val();
		$(".klasis,.runggun,.sektor,.table_area").hide();
		if(jenis=='pusat'){
			$(".klasis,.runggun,.sektor").hide();
			$(".table_area").show();
			$('[name="dt_id_klasis"],[name="dt_id_runggun"],[name="dt_id_sektor"]').val(null).change();
		}
		else if(jenis=='klasis'){
			$(".klasis").show();
			$('[name="dt_id_klasis"],[name="dt_id_runggun"],[name="dt_id_sektor"]').val(null).change();
		}
		else if(jenis=='runggun'){
			$(".klasis,.runggun").show();
			$('[name="dt_id_runggun"],[name="dt_id_sektor"]').val(null).change();
		}
		else if(jenis=='sektor'){
			$(".klasis,.runggun,.sektor").show();
			$('[name="dt_id_sektor"]').val(null).change();
		}
		reload_table();
	});
	$('[name="dt_id_klasis"]').change(function(){
		$('[name="dt_id_runggun"]').val(null).change().attr("disabled",true);
		if($(this).val()!=null){
			$('[name="dt_id_runggun"]').attr("disabled",false);
			reload_table();
		}
	}); 
	$('[name="dt_id_runggun"]').change(function(){
		$('[name="dt_id_sektor"]').val(null).change().attr("disabled",true);
		if($(this).val()!=null){
			$('[name="dt_id_sektor"]').attr("disabled",false);
			reload_table();
		}
	});
	$('[name="dt_id_sektor"]').change(function(){
		if($(this).val()!=null){
			reload_table();
		}
	});
	$(".klasis,.runggun,.sektor").hide();
	var my_role=<?=$this->session->userdata("role")?>;
	var my_id_klasis=<?=$this->session->userdata("id_klasis")?>;
	var my_nama_klasis='<?=$this->session->userdata("nama_klasis")?>';
	var my_id_runggun=<?=$this->session->userdata("id_runggun")?>;
	var my_nama_runggun='<?=$this->session->userdata("nama_runggun")?>';
	var my_id_sektor=<?=$this->session->userdata("id_sektor")?>;
	var my_nama_sektor='<?=$this->session->userdata("nama_sektor")?>';
	if(my_role>0){
		var jenis='';
		if(my_role<=0)jenis="Pusat";
		else if(my_role==1)jenis="Klasis";
		else if(my_role==2)jenis="Runggun";
		else if(my_role==3)jenis="Sektor";
		$('[name="dt_jenis"]').append(new Option(jenis,jenis.toLowerCase(),true,true)).change();
		$('[name="dt_id_klasis"]').append(new Option(my_nama_klasis,my_id_klasis,true,true)).change();
		if(my_role>1){
			$('[name="dt_id_runggun"]').append(new Option(my_nama_runggun,my_id_runggun,true,true)).change();
			if(my_role>2){
				$('[name="dt_id_sektor"]').append(new Option(my_nama_sektor,my_id_sektor,true,true)).change();
			}
		}
	}
	var table=$('#datatable').dataTable({
		dom: '<"pull-left"f>Brt<"bottom"p><"clear">',
		autoWidth: false,
       	destroy: true,
       	form_filters: false,
       	ordering: false,
        info: false,
        lengthChange: false,
        serverSide: true,
        paging:false,
		ajax: {
            "url": "<?php echo base_url('admin/program_kegiatan_datatable');?>",
            "type": "POST",
            "beforeSend": ()=>{return ldg()},
            data:{
            	jenis:()=>{return $("[name='dt_jenis']").val()},
            	tahun:()=>{return $("[name='dt_tahun']").val()},
            	id_pemilik:()=>{return $("[name='dt_id_"+($("[name='dt_jenis']").val())+"']").val()??null}
            },
            dataSrc :function(res){
            	$('#popup_loading').hide();
            	set_editable();
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
            	data: 'nama_bidang',
                render: function(data, type, row, meta) {	
                    return data==null?'':`<div style="width:200px;white-space:pre-wrap">${data}</div>`;
                }
        	},
            {
            	data: 'id_kegiatan',
                render: function(data, type, row, meta) {
                	return data==null?'':`<button class="btn btn-info" data-kegiatan='${btoa(JSON.stringify(row))}'>Ubah</button>`;
                }
            },
            {
            	data: 'nama_kegiatan',
                render: function(data, type, row, meta) {	
                    return data==null?'':`<div style="width:250px;white-space:pre-wrap">${data}</div>`;
                }
        	},
            {data: 'tempat'},
            {data: 'tujuan'},
            {
            	data: 'target_fisik',
            	className:'text-right',
                render: function(data, type, row, meta) {	
                    return data==null?'':separator(data);
                }
        	},
            {
            	data: 'anggaran_lokal',
            	className:'text-right',
                render: function(data, type, row, meta) {	
                    return data==null?'':separator(data);
                }
        	},
            {
            	data: 'anggaran_subsidi',
            	className:'text-right',
                render: function(data, type, row, meta) {	
                    return data==null?'':separator(data);
                }
        	},
            {
            	data: 'total_anggaran',
            	className:'text-right',
                render: function(data, type, row, meta) {	
                    return data==null?'':separator(data);
                }
        	},
            {data: 'pelaksana'},
            {
            	data: 'jadwal',
                render: function(data, type, row, meta) {	
                	if(data==null)return '';
                	else{
                		var tgl=data.split(',');
                		$(tgl).each(function(a,b){
                			tgl[a]=sql_to_view(b);
                		});
                    	return '<div style="width:260px;white-space:pre-wrap"><b class="badge bg-secondary text-white mx-0">'+tgl.join('</b><i class="d-none">, </i> <b class="badge badge-secondary mx-0">')+'</b></div>';
                	}
                }
        	},
            {data: 'keterangan'},
        ],
		buttons: [
            {
                extend: 'excelHtml5',
            	filename:'Program Kerja',
            	className:'btn btn-primary ml-2',
                text: '<i class="fa fa-file-excel-o"></i> Export ke Excel',
                autoform_filter: true,
				title:null,
				footer:true,
				rowsGroup:true,
				exportOptions: {
					columns:[0,1,3,4,5,6,7,8,9,10,11,12]
                },
				action : export_kadal
			},
		],
        rowsGroup: [1],
		createdRow:()=>{
			$('#popup_loading').hide();
		},
		"footerCallback": function ( row, data, start, end, display ) {
            var api  = this.api(), data;
            var list = [6,7,8,9];
            for(x in list){
	            $(api.column(list[x]).footer()).html(()=>{
	                return api.column(list[x],{page:'current'}).data().reduce( function (a, b) {
				                    return separator(Number(a.toString().replace(/\./g,''))+Number(b==null?0:b.replace(/\./g,'')));
				                },0);
	            });
            }
        }
	}).wrap("<div class='table-responsive col-lg-12'></div>");
	function set_editable(){
    	form_filter=$(".form_filter").serializeObject();
    	var title='<div>Program Kerja BP Mamre '+(form_filter.dt_jenis==`pusat`?'Pusat ':'')+'GBKP</div><div>';
    	if(form_filter.dt_jenis==`klasis`)title+=' Klasis '+$("[name='dt_id_klasis']").select2('data')[0].text;
    	if(form_filter.dt_jenis==`runggun`)title+=' Runggun '+$("[name='dt_id_runggun']").select2('data')[0].text;
    	if(form_filter.dt_jenis==`sektor`)title+=' Sektor '+$("[name='dt_id_sektor']").select2('data')[0].text+' Runggun '+$("[name='dt_id_runggun']").select2('data')[0].text;
    	title+='</div><div>Tahun '+form_filter.dt_tahun+'</div>';
    	$(".title").html(title);
    	var editable=(my_role<=0&&form_filter.dt_jenis=='pusat')||
    				(my_role==1&&form_filter.dt_jenis=='klasis'&&my_id_klasis==form_filter.dt_id_klasis)||
    				(my_role==2&&form_filter.dt_jenis=='runggun'&&my_id_runggun==form_filter.dt_id_runggun)||
    				(my_role==3&&form_filter.dt_jenis=='sektor'&&my_id_sektor==form_filter.dt_id_sektor)
    	if(editable)$('.bnt_new').show();
    	else $('.bnt_new').hide();
    	table.DataTable().column(2).visible(editable);
	}
	$(".bnt_new").click(function(){
		$("#form_save").trigger('reset');
		$(".list_jadwal").html('');
		$('.popup_title').html($('.title').html());
		$(".date_peek").attr('required',true);
		$('[name="id_bidang"]').val(null).change().prop("disabled",false);
		$('.modal-title').text('Tambah Data');
		$("#form_save").modal('show');
	});
	$(document).on('click','[data-kegiatan]',function(){
		var data=JSON.parse(atob($(this).data('kegiatan')));
		$('[name="id_kegiatan"]').val(data.id_kegiatan);
		$('[name="id_bidang"]').append(new Option(data.nama_bidang,data.id_bidang,true,true)).trigger('change').prop('disabled',true);
		$('[name="nama_kegiatan"]').val(data.nama_kegiatan);
		$('[name="tempat"]').val(data.tempat);
		$('[name="tujuan"]').val(data.tujuan);
		$('[name="target_fisik"]').val(data.target_fisik).change();
		$('[name="anggaran_lokal"]').val(data.anggaran_lokal).change();
		$('[name="anggaran_subsidi"]').val(data.anggaran_subsidi).change();
		$('[name="pelaksana"]').val(data.pelaksana);
		$('[name="keterangan"]').val(data.keterangan);
		$(".date_peek").removeAttr('required');
		$(".list_jadwal").html('');
		var tgl=data.jadwal.split(',');
		$(tgl).each(function(a,b){
			$(".list_jadwal").append(`<div class="d-inline-block rounded border mb-1 mr-1"><span class="px-2" jadwal="${b}">${sql_to_view(b)}</span><span class="btn btn-danger btn-sm btn_hapus">X</span></div>`);
		});
		$('.popup_title').html($('.title').html());
		$('.modal-title').text('Ubah Data');
		$("#form_save").modal('show');
	});
	$(".select2").select2();
	$(".date_peek").change(function(){
		var val=$(this).val();
		if(val!=""){
			$(".date_peek").removeAttr('required');
			if($(`[jadwal="${val}"]`).length==0){
				$(".list_jadwal").append(`<div class="d-inline-block rounded border mb-1 mr-1"><span class="px-2" jadwal="${val}">${sql_to_view(val)}</span><span class="btn btn-danger btn-sm btn_hapus">X</span></div>`);
				$(this).val(null);
			}
		}
	});
	$(document).on('click','.btn_hapus',function(){
		$(this).parent().remove();
		if($('[jadwal]').length==0)$(".date_peek").attr('required',true);
		else $(".date_peek").removeAttr('required')
	});
	$("[name='anggaran_lokal'],[name='anggaran_subsidi']").on('input change',function(){
		var lokal=Number($("[name='anggaran_lokal']").val().toString().replaceAll(".",''));
		var subsidi=Number($("[name='anggaran_subsidi']").val().toString().replaceAll(".",''));
		$("[name='total_anggaran']").val(separator(lokal+subsidi));
	});

	//=========================================
	$("[name='dt_tahun']").change(function(){
		reload_table();
	});
	$('[name="dt_id_klasis"]').select2({
		placeholder: "Pilih Klasis",
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
	$('[name="dt_id_runggun"]').select2({
		placeholder: "Pilih Runggun",
	  ajax: {
	  	delay: 250,
	    url: '<?=base_url()?>admin/select_runggun',
	    type:'post',
	    dataType:'json',
	    data: function(params){
	      return {
		        search: params.term,
		        id_klasis:$('[name="dt_id_klasis"]').val()
		      };
	    },
	    processResults:function(data){
	      return {
	        results: data
	      };
	    }
	  }
	});
	$('[name="dt_id_sektor"]').select2({
		placeholder: "Pilih Sektor",
	  ajax: {
	  	delay: 250,
	    url: '<?=base_url()?>admin/select_sektor',
	    type:'post',
	    dataType:'json',
	    data: function(params){
	      return {
		        search: params.term,
		        id_runggun:$('[name="dt_id_runggun"]').val()
		      };
	    },
	    processResults:function(data){
	      return {
	        results: data
	      };
	    }
	  }
	});
	$('[name="id_bidang"]').select2({
		placeholder: "Pilih Bidang",
		ajax: {
			delay: 250,
		url: '<?=base_url()?>admin/select_bidang',
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
	function reload_table(){
		$('.table_area,.bnt_new').hide();
		var dt_jenis 		=$("[name='dt_jenis']").val();
		var dt_id_klasis 	=$("[name='dt_id_klasis']").val();
		var dt_id_runggun 	=$("[name='dt_id_runggun']").val();
		var dt_id_sektor 	=$("[name='dt_id_sektor']").val();
		if(dt_jenis=='pusat'||(dt_jenis=='klasis'&&dt_id_klasis!=null)||(dt_jenis=='runggun'&&dt_id_runggun!=null)||(dt_jenis=='sektor'&&dt_id_sektor!=null)){
			$('.table_area').show();
			if(table!=null)$('#datatable').DataTable().ajax.reload();
		}
	}
	$("#form_save").submit(function(e){
		e.preventDefault();
		var data=$(this).serializeObject();
		data.id_bidang=$('[name="id_bidang"]').val();
		data.jenis=form_filter.dt_jenis;
		data.tahun=form_filter.dt_tahun;
		data.id_pemilik=form_filter['dt_id_'+form_filter.dt_jenis]??null;
		data.jadwal=[];
		$("[jadwal]").each(function(a,b){
			data.jadwal.push($(b).attr('jadwal'));
		});
        $('#popup_loading').show();
		$.post("<?=base_url()?>admin/program_kegiatan_save",data,function(res){
            $('#popup_loading').hide();
			if(res=='ok'){
				$("#form_save").modal('hide');
				reload_table();
			}else{
				alert_notif("Proses Gagal",res,()=>{
					reload_table();
				})
			}
		}).fail(()=>alert_network());
	})
});
</script>