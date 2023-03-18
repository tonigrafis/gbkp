<div id="left-sidebar" class="sidebar">
  <div class="navbar-brand">
      <a href="<?php echo base_url(); ?>admin"><img src="<?php echo base_url(); ?>assets/img/honda/logo.png" alt="<?= $this->session->userdata('nama_user');?>" class="img-fluid logo"><span><?= $this->session->userdata('nama_user');?></span></a>
  </div>
    <nav class="sidebar-nav">
      <ul id="main-menu" class="metismenu">
        <?php if($this->session->userdata("role")<=0){?>
        <li>
          <a class="has-arrow">
            <i class="fa fa-list"></i>
            <span>Home Page</span>
          </a>
          <ul class="collapse">
            <li><a href="<?=base_url()?>admin/banner">Banner Beranda</a></li>
            <li><a href="<?=base_url()?>admin/kontak_us">Hubungi Kami</a></li>
            <li><a href="<?=base_url()?>admin/latest_news">Artikel</a></li>
            <li><a href="<?=base_url()?>admin/bidang_and_pelayanan">Bidang & Departemen</a></li>
            <li><a href="<?=base_url()?>admin/uraian_tugas">Uraian Tugas</a></li>
            <li><a href="<?=base_url()?>admin/tentang_gbkp">Tentang GBKP</a></li>
            <li><a href="<?=base_url()?>admin/mamre">Mamre</a></li>
            <li><a href="<?=base_url()?>admin/klasis">Klasis</a></li>
            <li><a href="<?=base_url()?>admin/runggun">Runggun</a></li>
            <li><a href="<?=base_url()?>admin/sektor">Sektor</a></li>
            <li><a href="<?=base_url()?>admin/data_brosur">Data File Mamre</a></li>
            <li><a href="<?=base_url()?>admin/pemohon_brosur">Pemohon Data File Mamre</a></li>
          </ul>
        </li>
      <?php }?>
        <li>
          <a href="<?=base_url()?>admin/undangan">
            <i class="fa fa-list"></i>
            <span>Undangan</span>
          </a>
        </li>
        <li>
          <a href="<?=base_url()?>admin/program_kegiatan">
            <i class="fa fa-list"></i>
            <span>Program Kerja</span>
          </a>
        </li>
        <li>
          <a class="has-arrow">
            <i class="fa fa-list"></i>
            <span>Data Master</span>
          </a>
          <ul class="collapse">
            <li><a href="<?=base_url()?>admin/mst_pengguna">Master Pengguna</a></li>
            <li><a href="<?=base_url()?>admin/mst_klasis">Master Klasis</a></li>
            <li><a href="<?=base_url()?>admin/mst_runggun">Master Runggun</a></li>
            <li><a href="<?=base_url()?>admin/mst_sektor">Master Sektor</a></li>
            <li><a href="<?=base_url()?>admin/mst_bidang">Master Bidang</a></li>
          </ul>
        </li>
        <li><a href="<?=base_url()?>login/logout"><i class="icon-logout"></i><span>Keluar</span></a></li>
      </ul>
    </nav>     
  <div class="left_block"></div>
</div>