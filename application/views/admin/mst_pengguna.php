<div id="main-content">
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>MASTER PENGGUNA</h4>
					</div>
					<div class="px-4">
						<div class="row">
		                	<div class="col">
		                		<b>Nama Klasis</b>
		                		<select class="form-control" name="id_klasis" data-width="100%"></select>
		                	</div>
		                	<div class="col">
		                		<b>Nama Runggun</b>
		                		<select class="form-control" name="id_runggun" data-width="100%" disabled></select>
		                	</div>
		                	<div class="col">
		                		<b>Nama Sektor</b>
		                		<select class="form-control" name="id_sektor" data-width="100%" disabled></select>
		                	</div>
		                	<div class="col align-self-end">
		                		<button class="btn btn-dark btn_reset">Lihat Semua Data</button>
		                	</div>
		                </div>
		            </div>
	                <div class="clearfix"></div><br>
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th>No.</th>
								<th>Klasis</th>
								<th>Runggun</th>
								<th>Sektor</th>
								<th>Hak Akses</th>
								<th>Username</th>
								<th>Password</th>
								<th>Photo</th>
								<th>Nama Lengkap</th>
								<th>Istri</th>
								<th>Anak</th>
								<th>Penggelaran</th>
								<th>Tempat Lahir</th>
								<th>Tgl. Lahir</th>
								<th>Alamat</th>
								<th>No. Hp</th>
								<th>Email</th>
								<th>Marga</th>
								<th>Bere</th>
								<th>Pekerjaan</th>
								<th>Gol. Darah</th>
							</tr>
						</thead>
					</table>
				</div>
            </div>
        </div>
    </div> 
</div>
<script>
$(document).ready(function(){
	$(document).on('click','.btn_hak_akses',function(){
		el_hak_akses=$(this).parent().find('.el_hak_akses');
		var show=el_hak_akses.is(":visible");
		$(".el_hak_akses").hide('fast');
		if(show)el_hak_akses.hide('fast');
		else el_hak_akses.show('fast');
	});
	
	$('[name="id_klasis"]').select2({
		placeholder: "Semua klasis",
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

	$('[name="id_runggun"]').select2({
		placeholder: "Semua Runggun",
		allowClear: true,
	  ajax: {
	  	delay: 250,
	    url: '<?=base_url()?>admin/select_runggun',
	    type:'post',
	    dataType:'json',
	    data: function(params){
	      return {
		        search: params.term,
		        id_klasis:$('[name="id_klasis"]').val()
		      };
	    },
	    processResults:function(data){
	      return {
	        results: data
	      };
	    }
	  }
	});
	$('[name="id_sektor"]').select2({
		placeholder: "Semua Sektor",
		allowClear: true,
	  ajax: {
	  	delay: 250,
	    url: '<?=base_url()?>admin/select_sektor',
	    type:'post',
	    dataType:'json',
	    data: function(params){
	      return {
		        search: params.term,
		        id_runggun:$('[name="id_runggun"]').val()
		      };
	    },
	    processResults:function(data){
	      return {
	        results: data
	      };
	    }
	  }
	});
	var my_id_user=<?=$this->session->userdata("id_user")?>;
	var my_role=<?=$this->session->userdata("role")?>;
	var my_id_klasis=<?=$this->session->userdata("id_klasis")?>;
	var my_id_runggun=<?=$this->session->userdata("id_runggun")?>;
	var my_id_sektor=<?=$this->session->userdata("id_sektor")?>;
	if(my_role>0){
		$('[name="id_klasis"]').append(new Option('<?=$this->session->userdata("nama_klasis")?>',my_id_klasis,true,true));
		$('[name="id_runggun"]').prop("disabled",false);
	}
	if(my_role>1){
		$('[name="id_runggun"]').append(new Option('<?=$this->session->userdata("nama_runggun")?>',my_id_runggun,true,true));
		$('[name="id_sektor"]').prop("disabled",false);
	}
	if(my_role>2){
		$('[name="id_sektor"]').append(new Option('<?=$this->session->userdata("nama_sektor")?>',my_id_sektor,true,true));
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
            "url": "<?php echo base_url('admin/pengguna_datatable');?>",
            "type": "POST",
            "beforeSend": ()=>{return ldg()},
            data:{
            	id_klasis:function(){
            		if($("[name='id_klasis']").val()===null)$(".btn_reset").hide();
            		else $(".btn_reset").show();
            		return $("[name='id_klasis']").val()
            	},
            	id_runggun:()=>{
            		return $("[name='id_runggun']").val()
            	},
            	id_sektor:()=>{
            		return $("[name='id_sektor']").val()
            	}
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
            {data: 'nama_runggun'},
            {
            	data: 'nama_sektor',
                render: function(data, type, row, meta) {	
                    return data==null?'-':data;
                }
            },
            {
            	data: 'role',
            	className:"text-center",
                render: function(data, type, row, meta) {
					var posisi='';
					if(row.role==0)posisi='Admin Pusat';
					else if(row.role==1)posisi='Admin Klasis';
					else if(row.role==2)posisi='Admin Runggun';
					else if(row.role==3)posisi='Admin Sektor';
					else if(row.role==4)posisi='Anggota';

					var show_as='button';
					var set_pusat='d-none';
					var set_klasis='d-none';
					var set_runggun='d-none';
					var set_sektor='d-none';

					if(my_role==-1){//developer
						if(row.role!=0)set_pusat='d-block';
						if(row.role!=1)set_klasis='d-block';
						if(row.role!=2)set_runggun='d-block';
						if(row.role!=3&&row.id_sektor!=0)set_sektor='d-block';
					}
					else if(my_id_user!=row.id_user){
						if(my_role==0&&row.role>0){//pusat
							if(row.role!=1)set_klasis='d-block';
							if(row.role!=2)set_runggun='d-block';
							if(row.role!=3&&row.id_sektor!=0)set_sektor='d-block';
						}else if(my_role==1&&row.role>1&&row.id_klasis==my_id_klasis){//klasis
							if(row.role!=2)set_runggun='d-block';
							if(row.role!=3&&row.id_sektor!=0)set_sektor='d-block';
						}
					}

					if(set_pusat=='d-none'&&set_klasis=='d-none'&&set_runggun=='d-none'&&set_sektor=='d-none'){
						show_as='text';
					}
                    return show_as=='text'?`<span posisi='${posisi}'>${row.role<4?'<b>'+posisi+'</b>':posisi}</span>`:`<button class="btn btn-${row.role==4?'secondary':'info'} btn_hak_akses">
							    <i class="fa fa-edit"></i> <span posisi='${posisi}'>${row.role<4?'<b>'+posisi+'</b>':posisi}</span>
							</button>
							<div class="el_hak_akses" style='display:none'>
								<div class="border p-2">
									Ubah hak akses menjadi :
									<a class="btn btn-sm btn-info ${set_pusat}" href="#" onclick="set_admin(0,${row.id_user},0,'${row.nama}')">Admin Pusat</a>
									<a class="btn btn-sm btn-info ${set_klasis}" href="#" onclick="set_admin(1,${row.id_user},${row.id_klasis},'${row.nama}')">Admin Klasis</a>
									<a class="btn btn-sm btn-info ${set_runggun}" href="#" onclick="set_admin(2,${row.id_user},${row.id_runggun},'${row.nama}')">Admin Runggun</a>
									<a class="btn btn-sm btn-info ${set_sektor}" href="#" onclick="set_admin(3,${row.id_user},${row.id_sektor},'${row.nama}')">Admin Sektor</a>
								</div>
							</div>`
                }
            },
            {data: 'nama_user'},
            {
            	data: 'id_user',
            	className:"text-center",
                render: function(data, type, row, meta) {
					var reset='d-none';
					if(my_role==-1){
						reset='d-block';
					}
					else if(my_id_user!=row.id_user){
						if(my_role==0&&row.role>0){//pusat
							reset='d-block';
						}else if(my_role==1&&row.role>1&&row.id_klasis==my_id_klasis){//klasis
							reset='d-block';
						}else if(row.role>2&&row.id_runggun==my_id_runggun){//runggun
							reset='d-block';
						}
					}
                	return `<button class="btn btn-info ${reset}" onclick="reset_password(${row.id_user},'${row.nama}')"><i class="fa fa-refresh"></i> Reset</button>`;	
                }
            },
            {
            	data: 'photo',
            	className:"text-center",
                render: function(data, type, row, meta) {
                    return `<img class="img_preview" src="<?=base_url()?>assets/img/${data!=""?"user/"+data:"no_user.png"}"/>`;
                }
            },
            {data: 'nama'},
            {
            	data: 'istri',
                render: function(data, type, row, meta) {
                    return data.replaceAll(", ","<span class='d-none'>,</span> <br/>");
                }
            },
            {
            	data: 'anak',
                render: function(data, type, row, meta) {
                    return data==""?"-":data.replaceAll(", ","<span class='d-none'>,</span> <br/>");
                }
            },
            {data: 'penggelaran'},
            {data: 'tempat_lahir'},
            {
            	data: 'tgl_lahir',
                render: function(data, type, row, meta) {
                	var x=data.split('-');
                    return x[2]+'/'+x[1]+"/"+x[0];
                }
            },
            {
            	data: 'alamat',
                render: function(data, type, row, meta) {
                    return `<div style="width:300px;white-space:pre-wrap">${data}<div>`;
                }
            },
            {
            	data: 'no_hp',
                render: function(data, type, row, meta) {
                    return data.replaceAll(",","<span class='d-none'>, </span> <br/>");
                }
            },
            {
            	data: 'email',
                render: function(data, type, row, meta) {
                    return data==""?"-":data;
                }
            },
            {data: 'marga'},
            {data: 'bere'},
            {data: 'pekerjaan'},
            {
            	data: 'gol_darah',
            	className:"text-center"
            },
        ],
        rowsGroup: [1,2,3],
		buttons: [
            {
                extend: 'excelHtml5',
            	className:'btn btn-primary ml-2',
            	filename:()=>{
            		var title="Master Pengguna";
            		var ket=[];
            		var a=$('[name="id_klasis"] option:selected').text();
            		var b=$('[name="id_runggun"] option:selected').text();
            		var c=$('[name="id_sektor"] option:selected').text();
            		if(a!="")ket.push(a);
            		if(b!="")ket.push(b);
            		if(c!="")ket.push(c);
            		return title+(ket==""?"":" ("+(ket.join(" - "))+")");
            	},
                text: '<i class="fa fa-file-excel-o"></i> Export ke Excel',
                autoFilter: true,
				title:null, 
				exportOptions: {
					columns:[0,1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
					format: {
						body: function (data, row, column, node) { 
							if(column==4){
								data=$(node).find('[posisi]').attr("posisi");
							}
							else if(column==6)data=$(node).find('img').attr('src');
							else data=$(node).text();
							return data;
						}
					}
                },
				action : export_kadal
			},
		]
		,createdRow:()=>{
			$('#popup_loading').hide();
		}
	}).wrap("<div class='table-responsive col-lg-12'></div>");
	$('[name="id_klasis"]').change(function(){
		$('[name="id_runggun"],[name="id_sektor"]').val(null).change().attr("disabled",true);
		if($(this).val()!=null){
			$('[name="id_runggun"]').attr("disabled",false);
		}
		$('#datatable').DataTable().ajax.reload();
	});
	$('[name="id_runggun"]').change(function(){
		if($('[name="id_klasis"]').val()!=null){
			$('[name="id_sektor"]').val(null).change().attr("disabled",true);
			if($(this).val()!=null){
				$('[name="id_sektor"]').attr("disabled",false);
			}
			$('#datatable').DataTable().ajax.reload();
		}
	});
	$('[name="id_sektor"]').change(function(){
		if($('[name="id_sektor"]').val()!=null){
			$('#datatable').DataTable().ajax.reload();
		}
	});

	$(".btn_reset").click(function(){
		$('[name="id_klasis"]').val(null).change();
	});
});
function set_admin(set_to,id_user,id_set,nama){
	var jadi='';
	if(set_to==0)jadi='Admin Pusat';
	else if(set_to==1)jadi='Admin Klasis';
	else if(set_to==2)jadi='Admin Runggun';
	else if(set_to==3)jadi='Admin Sektor';
	else if(set_to==4)jadi='Anggota';
	alert_confirm(`Yakin ingin menjadikan <b>${nama}</b> sebagai <b>${jadi}</b>?`,()=>{
		$('#popup_loading').show();
		$.post("<?=base_url()?>admin/pengguna_set_admin",{set_to:set_to,id_user:id_user,id_set},function(res){
			$('#popup_loading').hide();
			if(res=='ok'){
				$('#datatable').DataTable().ajax.reload();
			}else{
				alert_notif("Proses Gagal",res,()=>{
				$('#datatable').DataTable().ajax.reload();
				})
			}
		}).fail(()=>alert_network());
	});
}
function reset_password(id_user,nama){
	alert_confirm(`Seluruh perangkat yang terhubung dengan akun <b>${nama}</b> akan secara otomatis keluar. Yakin ingin melanjutkan?`,()=>{
		$('#popup_loading').show();
		$.post("<?=base_url()?>admin/pengguna_reset_password",{id_user:id_user},function(res){
			$('#popup_loading').hide();
			if(res.status) alert_notif("Berhasil Me-reset Password",`Password ${nama} berhasil diubah menjadi : <b>${res.data}</b>`,null,'success');
			else alert_notif("Gagal Me-reset Password",res.error);
		},'json').fail(()=>alert_network());
	});
}
</script>