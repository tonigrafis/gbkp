<div id="main-content"> 
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>Data Brosur</h4>
						<button type="button" class="btn btn-sm btn-info pull-right bnt_new" data-toggle="modal" data-target="#postinput"><i class="fa fa-plus-square-o"></i> Tambah Data Brosur</button>						
					</div>
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th>Aksi</th>
								<th>No.</th>  
								<th>Nama Brosur</th>
								<th>Brosur</th>
								<th>Nama File</th> 
							</tr>
						</thead>
						<tbody>
						<?php $no=1; while($val=$data->unbuffered_row()){ ?>
							<tr>
								<td><a id="id" href="<?= base_url('admin/delete_brosur/'.encrypt_url($val->id));?>" class="btn btn-danger hapusw"><i class="fa fa-trash"></i> Hapus</a></td>
								<td><?= $no++;?></td>
								<td><?= $val->keterangan;?></td>
								<td><a href="<?=base_url('/assets/fileku/').$val->nama_file?>" target="_blank">Lihat Brosur</a></td>
								<td class="col-lg-8"><?= $val->nama_file?></td>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" onsubmit="return ldg()" action="<?=base_url('admin/upload_brosur/')?>" enctype="multipart/form-data" >
                <div class="modal-body">
					<h5 class="modal-title text-center" id="exampleModalLabel">Tambah Brosur Baru</h5>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							   <div class="form-group">
									<input type="hidden" name="id" readonly />
									<label class="label">Nama Brosur : </label>
									<textarea class="form-control border_red" autocomplete="off" id="ket" name="keterangan" style="color: black;resize:none;" required></textarea>
								</div>
								<div class="form-group">
									<label class="label"><small style="color:red;"> ** size maks. 38MB</small></label>
									<div class="custom-file border_red">
										<input type="file" class="custom-file-input" name="nama_file">
										<label class="custom-file-label" id="text_ugh">Unggah file [format : *.pdf]</label>
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
		$('#popup_loading').show();
        $("[name='id']").val('');
        $("[name='keterangan']").val('');
		$('#text_ugh').text('Unggah file [format : *.pdf]');
		$('#popup_loading').hide();
	});
	$('#datatable').dataTable({dom:'<"pull-left"f><t>p',autoWidth: false, stateSave: true}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");   
});
</script>