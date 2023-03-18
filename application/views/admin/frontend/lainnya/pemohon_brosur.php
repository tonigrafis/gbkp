<div id="main-content"> 
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>Data Pemohon Brosur</h4>
					</div>
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
	                            <th>Aksi</th>
                                <th>No.</th>  
                                <th>Nama Pemohon</th>
                                <th>Email Pemohon</th>
                                <th>Telp. Pemohon</th>
                                <th>Tanggal Kirim Email</th>
                                <th>Status Email</th>
                                <th>Status SEO</th>
                            </tr>
                            <tbody>
                            <?php $no=1; while($val = $data->unbuffered_row()){?>
								<tr>
								    <td><a class="btn btn-danger" href="<?= base_url('admin/delete_pemohon_brosur/'.encrypt_url($val->id));?>">Hapus</a></td>
                                	<td><?= $no++;?></td>
									<td class="col-lg-5"><?= $val->first_name.' '.$val->last_name?></td>
									<td class="col-lg-5"><?= $val->email;?></td>
									<td class="col-lg-5"><?= $val->no_telp;?></td>
									<td class="col-lg-1" data-sort="<?=date('Ymd',strtotime($val->tanggal));?>"><?= fix_tanggal($val->tanggal)?></td>
									<td class="col-lg-1"><?php if($val->sts_terkirim==0){ echo "Tidak Terkirim"; }else{ echo "Terkirim";}?></td>
									<td class="col-lg-1"><?php if($val->status==0){ echo "Tidak Dibuka Pelanggan"; }else{ echo "Dibuka Pelanggan";}?></td>
                                </tr>
							<?php } ?>
							</tbody>
						</table>
						<span><b>Penting : </b> Data akan dihapus jika usia data melebihi 6 (enam) bulan.</span>
					</div>
				</div>
			</div>
		</div> 
	</div>
</div>
<script>
$(document).ready(function(){
$('#datatable').dataTable({dom:'<"pull-left"f>B<t>p',
		autoWidth: false,
		buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Export ke Excel',
            	className:'btn btn-primary ml-2',
                messageTop:'Data Pemohon Brosur',
				autoFilter: true,
				sheetName: 'Pemohon Brosur',
			},
        ], stateSave: true}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");
});
</script>