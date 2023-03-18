
<div id="main-content"> 
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>Runggun</h4>
                        <a href="<?php echo base_url('admin/tambah_runggun'); ?>" class="btn btn-sm btn-primary pull-right" title=""><i class="fa fa-plus-square-o"></i> Tambah Runggun</a>
                    </div>
					<table class="table table-bordered table-custom " id="datatable">
						<thead>
							<tr>
								<th class="col-lg-1">Aksi</th> 
								<th class="col-lg-1">Status</th> 
								<th class="col-lg-1">No.</th> 
								<th class="col-lg-3">Nama Runggun</th> 
								<th class="col-lg-3">Isi Runggun</th> 
								<th class="col-lg-3">Nama Klasis</th> 
							</tr>
						</thead>
						<tbody>
							<?php $no=1;  while($val=$data->unbuffered_row()){ ?>
							<tr>
								<td class="col-lg-1">  
									<a class="btn btn-sm btn-info" href="<?= base_url()?>admin/edit_runggun/<?=encrypt_url($val->id_posting);?>"><i class="fa fa-pencil"></i> Ubah</a>  
								</td>
								<td class="col-lg-1">
									<?php if($val->status == 1){ ?>
										<a class="btn btn-sm btn-success" href="<?= base_url()?>admin/hapus_runggun/<?=encrypt_url($val->id_posting);?>"><i class="fa fa-check"></i> Aktif</a>
										<a hidden class="btn btn-sm btn-danger" href="<?= base_url()?>admin/hapus_runggun/<?=encrypt_url($val->id_posting);?>"><i class="fa fa-warning"></i> Non-aktif</a>
									<?php }else{ ?>
										<a hidden class="btn btn-sm btn-success" href="<?= base_url()?>admin/hapus_runggun/<?=encrypt_url($val->id_posting);?>"><i class="fa fa-check"></i> Aktif</a>
										<a class="btn btn-sm btn-danger" href="<?= base_url()?>admin/hapus_runggun/<?=encrypt_url($val->id_posting);?>"><i class="fa fa-warning"></i> Non-aktif</a>
									<?php } ?>
								</td>
								<td class="col-lg-1" style="text-align: center;"><?=$no++;?></td>
								<td class="col-lg-3"><?=substr($val->judul,0,23);?><?php if(strlen($val->judul)>23){echo '...';}?></td>
								<td class="col-lg-3"><?=substr(preg_replace("/\<(.*?)\>/"," ",$val->isi),0,90);?><?php if(strlen(preg_replace("/\<(.*?)\>/"," ",$val->isi))>90){echo '...';}?></td>
								<td class="col-lg-3"><?=substr($val->klasis,0,23);?><?php if(strlen($val->klasis)>23){echo '...';}?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function(){
	$('#datatable').dataTable({
		dom:'<"pull-left"f><t>p',autoWidth: false, stateSave: true
	}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");   
}); 
</script>