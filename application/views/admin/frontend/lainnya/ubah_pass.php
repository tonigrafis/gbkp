<div id="main-content"> 
<?php if($this->session->flashdata('alert')){ echo $this->session->flashdata('alert'); } ?>
	<div class="col-lg-12">
		<div class="row clearfix">
			<div class="card">
				<div class="body">
					<div class="col">
                        <h4>Data User Login</h4>
						<button type="button" class="btn btn-sm btn-info pull-right bnt_new" data-toggle="modal" data-target="#postinput"><i class="fa fa-plus-square-o"></i> Tambah User Login</button>						
					</div>
					<table class="table table-bordered table-custom" id="datatable">
						<thead>
							<tr>
								<th>Aksi</th>
								<th>No.</th>  
								<th>Nama User</th>
								<th>Password</th>
							</tr>
						</thead>
						<tbody id="show_data">
						<?php $no=1; while($val=$data->unbuffered_row()){ ?>
							<tr>
								<td> 
									<a style="color:white;" class="btn btn-sm btn-info ubah_password" pass="<?= decrypt_url($val->pass);?>" nama="<?=$val->nama_user;?>" data="<?=encrypt_url($val->id_user);?>"><i class="fa fa-pencil"></i> Ubah</a>      
									<?php if($val->id_user!=1):?>
										<a class="btn btn-sm btn-danger" href="<?= base_url()?>admin/hapus_user/<?=encrypt_url($val->id_user);?>"><i class="fa fa-trash"></i> Hapus</a>
									<?php endif;?>
								</td>	
								<td><?= $no++;?></td>
								<td class="col-lg-4"><?= $val->nama_user;?></td>
								<td class="col-lg-4"><?= decrypt_url($val->pass);?></td>
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
            <form method="post" onsubmit="return ldg()" action="<?=base_url('admin/tambahubah_user/')?>">
                <div class="modal-body">
                    <h5 class="modal-title text-center" id="exampleModalLabel"></h5>
					<input type="hidden" name="id_user" readonly />
                    <input type="hidden" name="tipe" readonly />
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							   <div class="form-group">
									<label class="label">Nama User Login : </label>
									<input class="form-control border_red" autocomplete="off" rows="8" name="nama_user" style="color: black;" required></input>
								</div>
								<div class="form-group">
									<label class="label">Password Login : </label>
									<input class="form-control border_red" autocomplete="off" rows="8" name="password" style="color: black;" required></input>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
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
        console.log("run");
        $("[name='tipe']").val('add');
        $("[name='id_user']").val('');
        $("[name='nama_user']").val('');
        $("[name='password']").val('');
        $("#exampleModalLabel").html('Tambah User Login');
	});
	$('#show_data').on('click','.ubah_password',function(){
		$("[name='tipe']").val('edit');
        $("[name='id_user']").val($(this).attr('data'));
        $("[name='nama_user']").val($(this).attr('nama'));
        $("[name='password']").val($(this).attr('pass'));
        $("#exampleModalLabel").html('Ubah User Login');
        $("#postinput").modal('show'); 
	});
	$('#datatable').dataTable({dom:'<"pull-left"f><t>p',autoWidth: false, stateSave: true}).wrap("<div class='table-responsive col-lg-12 dragscroll'></div>");   
});
</script>