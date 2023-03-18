<div id="main-content"> 
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>Artikel</h4>
                        <a href="<?php echo base_url('admin/tambah_latest_news'); ?>" class="btn btn-sm btn-primary pull-right" title=""><i class="fa fa-plus-square-o"></i> Tambah Artikel</a> 
                    </div>
					<table class="table table-bordered table-custom " id="datatable">
						<thead>
							<tr>
								<th>Aksi</th> 
								<th>No.</th> 
								<th>Judul Artikel</th> 
								<th>Isi Artikel</th> 
							</tr>
						</thead>
						<tbody>
							<?php $no=1;  while($val=$data->unbuffered_row()){ ?>
							<tr>
								<td>  
									<a class="btn btn-sm btn-info" href="<?= base_url()?>admin/edit_latest_news/<?=encrypt_url($val->id_posting);?>"><i class="fa fa-pencil"></i> Ubah</a>      
									<a class="btn btn-sm btn-danger" href="<?= base_url()?>admin/hapus_latest_news/<?=encrypt_url($val->id_posting);?>"><i class="fa fa-trash"></i> Hapus</a>
								</td>
								<td><?=$no++;?></td>
								<td class="col-lg-4"><?=substr($val->judul,0,23);?><?php if(strlen($val->judul)>23){echo '...';}?></td>
								<td class="col-lg-7"><?=substr(preg_replace("/\<(.*?)\>/"," ",$val->isi),0,90);?><?php if(strlen(preg_replace("/\<(.*?)\>/"," ",$val->isi))>90){echo '...';}?></td>
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
	$('#datatable').dataTable({dom:'<"pull-left"f><t>p',autoWidth: false, stateSave: true}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");   
}); 
</script>