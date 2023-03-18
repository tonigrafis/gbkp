<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller{  
    function __construct(){
        parent::__construct();
        is_logged_in();
        $this->load->helper('url','form');
        $this->load->model('m_datatable','tbl');
    }
//-----------------front end--------------------//
    function index(){ 
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view("admin/home");
        $this->load->view('templates/footer');
    }
    
    /*admin view Banner Beranda*/
    function banner(){
        $data['data'] = $this->db->select('*')->from("banner_page")->where("id_page",1)->order_by('id_banner', 'desc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/banner/banner",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    /*admin view Artikel*/
    function latest_news(){
        $data['data'] = $this->db->select('*')->from("posting")->where("id_page",2)->order_by('id_posting', 'desc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/latesnews/latest_news",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    /*admin view Tentang GBKP*/
    function tentang_gbkp(){
        $data['data'] = $this->db->select('*')->from("posting")->where("id_page",5)->order_by('id_posting', 'asc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/tentanggbkp/tentang_gbkp",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    /*admin view Mamre*/
    function mamre(){
        $data['data'] = $this->db->select('*')->from("posting")->where("id_page",6)->order_by('id_posting', 'asc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/mamre/mamre",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    /*admin view Uraian Tugas*/
    function uraian_tugas(){
        $data['data'] = $this->db->select('*')->from("posting")->where("id_page",4)->order_by('id_posting', 'asc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/uraiantugas/uraian_tugas",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    /*admin view Klasis*/
    function klasis(){
        $data['data'] = $this->db->select('*')->from("posting")->where("id_page",8)->order_by('id_posting', 'asc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/klasis/klasis",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    /*admin view Runggun*/
    function runggun(){
        $data['data'] = $this->db->select('p.id_posting, p.judul, p.status, p.isi, p.id_page, pos.judul as klasis')
        ->from('posting AS p')
        ->where('p.id_page',9)
        ->join('posting AS pos', 'pos.id_posting = p.id_master', 'left')
        ->order_by('p.id_posting', 'asc')->get();
        
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/runggun/runggun",$data);
        // $this->load->view("admin/frontend/runggun/runggun");
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');

        // $this->load->model('m_runggun');
        // if($_POST)	$this->output->set_status_header(200)
        // ->set_content_type('application/json')
        // ->set_output(json_encode($this->m_runggun->initRunggun($_POST)));
    
    }

    /*admin view Sektor*/
    function sektor(){
        $data['data'] = $this->db->select('p.id_posting, p.judul, p.status, p.isi, p.id_page, pos.judul as runggun')
        ->from('posting AS p')
        ->where('p.id_page',10)
        ->join('posting AS pos', 'pos.id_posting = p.id_master', 'left')
        ->order_by('p.id_posting', 'asc')->get();
        
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/sektor/sektor",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    /*admin view Bidang & Departemen*/
    function bidang_and_pelayanan(){
        $data['data'] = $this->db->select('*')->from("posting")->where("id_page",3)->order_by('id_posting', 'asc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/bidangandpelayanan/bidang_and_pelayanan",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    /*admin view Menu Lainnya */
    function data_brosur(){
        $data['data'] = $this->db->get_where('tbl_brosur');
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/lainnya/data_brosur",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    
    function pemohon_brosur(){
        $data['data'] = $this->db->select('*')->from('tbl_email')->order_by('tanggal', 'desc')->get();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/lainnya/pemohon_brosur",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    /*admin view Ubah Password */
    // function ubah_password(){
    //     $id_user = $this->session->userdata('id_user');
    //     if($id_user==1){
    //         $query = $this->db->select("*")->from("user");
    //     }else{
    //         $query = $this->db->select("*")->from("user")->where("id_user",$id_user);
    //     }
    //     $data['data'] = $query->get();
    //     $this->load->view('templates/header');
    //     $this->load->view('templates/topbar');
    //     $this->load->view("admin/frontend/lainnya/ubah_pass",$data);
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('templates/footer');
    // }

    /*admin view Kontak Kami */
    function kontak_us(){
        $data['data'] = $this->db->get_where("chat_us");
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view("admin/frontend/lainnya/kontak_kami",$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    /*admin view */

//-----------------back end (view)--------------//
    
    /*admin view aksi Artikel */
    function tambah_latest_news(){
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/latesnews/tambah_latest');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_latest_news(){
        $id = decrypt_url($this->uri->segment(3));
        $data['data'] = $this->db->select('*')->from("posting")->where('id_posting',$id)->where("id_page",2)->order_by('id_posting', 'desc')->get()->row();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/latesnews/edit_latest', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_tentang_gbkp(){
        $id = decrypt_url($this->uri->segment(3));
        $data['data'] = $this->db->select('*')->from("posting")->where('id_posting',$id)->where("id_page",5)->order_by('id_posting', 'desc')->get()->row();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/tentanggbkp/edit_tentang', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_mamre(){
        $id = decrypt_url($this->uri->segment(3));
        $data['data'] = $this->db->select('*')->from("posting")->where('id_posting',$id)->where("id_page",6)->order_by('id_posting', 'desc')->get()->row();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/mamre/edit_mamre', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }


    function tambah_klasis(){
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/klasis/tambah_klasis');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function tambah_runggun(){
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/runggun/tambah_runggun');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function tambah_sektor(){
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/sektor/tambah_sektor');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_klasis(){
        $id = decrypt_url($this->uri->segment(3));
        $data['data'] = $this->db->select('*')->from("posting")->where('id_posting',$id)->where("id_page",8)->order_by('id_posting', 'desc')->get()->row();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/klasis/edit_klasis', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_runggun(){
        $id = decrypt_url($this->uri->segment(3));
        
        $data['data'] = $this->db->select('p.id_posting, p.judul, p.isi, p.id_page, pos.judul as klasis, pos.id_posting as id_klasis')
        ->from('posting AS p')
        ->where('p.id_posting',$id)
        ->where('p.id_page',9)
        ->join('posting AS pos', 'pos.id_posting = p.id_master', 'left')
        ->order_by('p.id_posting', 'asc')->get()->row();
        
        // var_dump($data);die();

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/runggun/edit_runggun', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_sektor(){
        $id = decrypt_url($this->uri->segment(3));
        
        $data['data'] = $this->db->select('p.id_posting, p.judul, p.isi, p.id_page, pos.judul as runggun, pos.id_posting as id_runggun')
        ->from('posting AS p')
        ->where('p.id_posting',$id)
        ->where('p.id_page',10)
        ->join('posting AS pos', 'pos.id_posting = p.id_master', 'left')
        ->order_by('p.id_posting', 'asc')->get()->row();
        
        // var_dump($data);die();

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/sektor/edit_sektor', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_uraian_tugas(){
        $id = decrypt_url($this->uri->segment(3));
        $data['data'] = $this->db->select('*')->from("posting")->where('id_posting',$id)->where("id_page",4)->order_by('id_posting', 'desc')->get()->row();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/uraiantugas/edit_uraian', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }

    function edit_bidang_and_pelayanan(){
        $id = decrypt_url($this->uri->segment(3));
        $data['data'] = $this->db->select('*')->from("posting")->where('id_posting',$id)->where("id_page",3)->order_by('id_posting', 'desc')->get()->row();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('admin/backend/bidangandpelayanan/edit_bidang', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/footer');
    }
    /*admin view aksi */

//-----------------back end--------------------//

    /*admin backend Artikel*/
    function hapus_latest_news(){
        $id = decrypt_url($this->uri->segment(3));
        if(($id==null)||($id=='')){
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Maaf, tidak dapat menghapus karena tidak ada data Artikel, silahkan ulangi kembali.</div>');
            redirect('admin/latest_news');
        }else{
            $this->db->delete("posting",array("id_posting"=>$id));
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Artikel berhasil dihapus.</div>');
            redirect('admin/latest_news');
        }
    }
    
    function hapus_klasis(){
        $id = decrypt_url($this->uri->segment(3));
        if(($id==null)||($id=='')){
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Maaf, tidak dapat menghapus karena tidak ada data Klasis, silahkan ulangi kembali.</div>');
            redirect('admin/klasis');
        }else{
            // $cek=$this->db->get_where("posting",array("id_master"=>$id))->num_rows();
                // if($cek>0){
                //     $this->db->delete("posting",array("id_master"=>$id));
                // }
                //     $this->db->delete("posting",array("id_posting"=>$id));
                //     $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Artikel berhasil dihapus.</div>');
            //     redirect('admin/klasis');
            $cek = $this->db->get_where("posting",array("id_posting"=>$id))->row();
            if($cek->status == 0){
                $this->db->update("posting", array(
                    "status" => 1,
                ), array(
                    "id_posting" => $id,
                ));
            }else{
                $this->db->update("posting", array(
                    "status" => 0,
                ), array(
                    "id_posting" => $id,
                ));
            }
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Status Klasis berhasil diubah.</div>');
            redirect('admin/klasis');
            
        }
    }
    
    function hapus_runggun(){
        $id = decrypt_url($this->uri->segment(3));
        if(($id==null)||($id=='')){
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Maaf, tidak dapat menghapus karena tidak ada data Runggun, silahkan ulangi kembali.</div>');
            redirect('admin/runggun');
        }else{
            //cek ada sektor apa enggak
                // $cek = $this->db->get_where("posting",array("id_master"=>$id))->num_rows();
                // if($cek > 0){ //jika sektor ada, hapus semua sektor berdasarkan id runggun 
                //     $this->db->delete("posting",array("id_master"=>$id));
                // }
                //     // var_dump($cek);die();
                //     $this->db->delete("posting",array("id_posting"=>$id));
                //     $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Runggun berhasil dihapus.</div>');
            //     redirect('admin/runggun');

            $cek = $this->db->get_where("posting",array("id_posting"=>$id))->row();
            if($cek->status == 0){
                $this->db->update("posting", array(
                    "status" => 1,
                ), array(
                    "id_posting" => $id,
                ));
            }else{
                $this->db->update("posting", array(
                    "status" => 0,
                ), array(
                    "id_posting" => $id,
                ));
            }

            
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Status Runggun berhasil diubah.</div>');
            redirect('admin/runggun');
        }
    }

    function hapus_sektor(){
        $id = decrypt_url($this->uri->segment(3));
        if(($id==null)||($id=='')){
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Maaf, tidak dapat merubah status karena tidak ada data Sektor, silahkan ulangi kembali.</div>');
            redirect('admin/sektor');
        }else{
            $cek = $this->db->get_where("posting",array("id_posting"=>$id))->row();
            if($cek->status == 0){
                $this->db->update("posting", array(
                    "status" => 1,
                ), array(
                    "id_posting" => $id,
                ));
            }else{
                $this->db->update("posting", array(
                    "status" => 0,
                ), array(
                    "id_posting" => $id,
                ));
            }

            
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Status Sektor berhasil diubah.</div>');
            redirect('admin/sektor');
        }
    }
    
    function tambah_post_latest_news(){
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $id_user = $this->session->userdata('id_user');
        $id_page = 2;
        $this->db->insert("posting",
            array(
                "tanggal"=>date('Y-m-d H:i:s'),
                "judul"  =>$judul,
                "isi"    =>$isi,
                "id_user"=>$id_user,
                "id_page"=>$id_page,
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Artikel berhasil ditambahkan.</div>');
    }
    
    function tambah_post_klasis(){
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $id_user = $this->session->userdata('id_user');
        $id_page = 8;
        $this->db->insert("posting",
            array(
                "tanggal"=>date('Y-m-d H:i:s'),
                "judul"  =>$judul,
                "isi"    =>$isi,
                "id_user"=>$id_user,
                "id_page"=>$id_page,
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Klasis berhasil ditambahkan.</div>');
    }

    function tambah_post_runggun(){
        $judul   = $this->input->post('judul');
        $isi     = $this->input->post('isi');
        $id_klasis = $this->input->post('klasis');
        // var_dump($id_klasis);die();
        $id_user = $this->session->userdata('id_user');
        $id_page = 9;
        $this->db->insert("posting",
            array(
                "tanggal"=>date('Y-m-d H:i:s'),
                "judul"  =>$judul,
                "isi"    =>$isi,
                "id_user"=>$id_user,
                "id_page"=>$id_page,
                'id_master'=> $id_klasis
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Runggun berhasil ditambahkan.</div>');
    }

    function tambah_post_sektor(){
        $judul   = $this->input->post('judul');
        $isi     = $this->input->post('isi');
        $id_runggun = $this->input->post('runggun');
        // var_dump($id_klasis);die();
        $id_user = $this->session->userdata('id_user');
        $id_page = 10;
        $this->db->insert("posting",
            array(
                "tanggal"=>date('Y-m-d H:i:s'),
                "judul"  =>$judul,
                "isi"    =>$isi,
                "id_user"=>$id_user,
                "id_page"=>$id_page,
                'id_master'=> $id_runggun
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Sektor berhasil ditambahkan.</div>');
    }
    
    function ubah_post_tentang_gbkp(){
        $id = decrypt_url($this->input->post('id'));
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $this->db->update("posting",
            array(
                "judul" =>$judul,
                "isi"   =>$isi
            ),array(
                "id_posting"=>$id,
                "id_page"   =>5
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Tentang GBKP berhasil diubah.</div>');
    }
    
    function ubah_post_mamre(){
        $id = decrypt_url($this->input->post('id'));
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $this->db->update("posting",
            array(
                "judul" =>$judul,
                "isi"   =>$isi
            ),array(
                "id_posting"=>$id,
                "id_page"   =>6
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Mamre berhasil diubah.</div>');
    }
    
    function ubah_post_klasis(){
        $id = decrypt_url($this->input->post('id'));
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $this->db->update("posting",
            array(
                "judul" =>$judul,
                "isi"   =>$isi
            ),array(
                "id_posting"=>$id,
                "id_page"   =>8
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Klasis berhasil diubah.</div>');
    }

    function ubah_post_runggun(){
        $id     = decrypt_url($this->input->post('id'));
        $judul  = $this->input->post('judul');
        $isi    = $this->input->post('isi');
        $id_klasis_hide = $this->input->post('id_klasis_hide');
        $id_klasis = $this->input->post('id_klasis');

        if($id_klasis == null){
            $this->db->update("posting",array( "judul" =>$judul, "isi"   =>$isi, "id_master" => $id_klasis_hide),
            array( "id_posting"=>$id, "id_page"   =>9 ));
        }else{
            $this->db->update("posting", array( "judul" =>$judul, "isi"   =>$isi, "id_master" => $id_klasis,),
            array("id_posting"=>$id, "id_page"   =>9 ));
        }

        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Runggun berhasil diubah.</div>');
    }
    function ubah_post_sektor(){
        $id     = decrypt_url($this->input->post('id'));
        $judul  = $this->input->post('judul');
        $isi    = $this->input->post('isi');
        $id_runggun_hide = $this->input->post('id_runggun_hide');
        $id_runggun = $this->input->post('id_runggun');

        if($id_runggun == null){
            $this->db->update("posting",array( "judul" =>$judul, "isi"   =>$isi, "id_master" => $id_runggun_hide),
            array( "id_posting"=>$id, "id_page"   =>10 ));
        }else{
            $this->db->update("posting", array( "judul" =>$judul, "isi"   =>$isi, "id_master" => $id_runggun,),
            array("id_posting"=>$id, "id_page"   =>10 ));
        }

        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Sektor berhasil diubah.</div>');
    }
    
    function ubah_post_uraian_tugas(){
        $id = decrypt_url($this->input->post('id'));
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $this->db->update("posting",
            array(
                "judul" =>$judul,
                "isi"   =>$isi
            ),array(
                "id_posting"=>$id,
                "id_page"   =>4
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Uraian Tugas berhasil diubah.</div>');
    }
    
    function ubah_post_bidang_and_pelayanan(){
        $id = decrypt_url($this->input->post('id'));
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        $this->db->update("posting",
            array(
                "judul" =>$judul,
                "isi"   =>$isi
            ),array(
                "id_posting"=>$id,
                "id_page"   =>3
            )
        );
        $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Bidang & Departemen berhasil diubah.</div>');
    }
    
    /*admin backend Banner Beranda*/
    function delete_banner(){
        $id = decrypt_url($this->uri->segment(3));
        @$file_name= $this->db->select("url_banner")->from("banner_page")->where("id_banner",$id)->where("id_page",1)->get()->row()->url_banner;
        $this->db->delete("banner_page",
            array(
                'id_banner'=>$id,
                'id_page'=>1
            )
        );
        if($this->db->affected_rows()==1){
            @unlink(FCPATH."./assets/img/honda/slide_home/".$file_name);
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Banner berhasil dihapus.</div>');
            redirect("admin/banner");
        }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data Banner sudah dihapus.</div>');
            redirect("admin/banner");
        }   
    }
    
    function status_banner(){
        $id = decrypt_url($this->uri->segment(3));
        $sts = $this->uri->segment(4);
        $status = ($sts==0?1:0);
        $this->db->update("banner_page",
            array(
                'sts_page'=>$status
            ),array(
                'id_banner'=>$id,
                'id_page'=>1,
                'sts_page'=>$sts,
            )
        );
        if($this->db->affected_rows()==1){
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Banner berhasil diubah.</div>');
            redirect("admin/banner");
        }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data Banner tidak dapat diubah karena terjadi perubahan data, silahkan ulangi kembali.</div>');
            redirect("admin/banner");
        }   
    }
    
    function upload_banner(){
        $config = array(
            'upload_path'   => './assets/img/honda/slide_home/',
            'allowed_types' => 'jpeg||jpg||png',
            'encrypt_name'  => TRUE,
            'remove_spaces' => TRUE,
            'max_size'      => 2048,
        );
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('nama_file')){
            $id=(int) $this->input->post('id');
            $keterangan= $this->input->post('keterangan');
            if($id==0){
                $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Hanya File dengan format : *.jpg,*.jpeg,*.png atau maks. size : 2MB yang diperbolehkan untuk disimpan.</div>');
                redirect("admin/banner");
            }else{
                $this->db->update("banner_page",
                    array(
                        "ket_banner"=>$keterangan,
                    ),array(
                        "id_banner"=>$id,
                        "id_page"=>1
                    )
                );
                if($this->db->affected_rows()==1){
                    $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Banner berhasil di ubah.</div>');
                    redirect("admin/banner");
                }else{
                    $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Hanya File dengan format : *.jpg,*.jpeg,*.png atau maks. size : 2MB yang diperbolehkan untuk disimpan.</div>');
                    redirect("admin/banner");
                }
            }
        }else{
            $id=(int) $this->input->post('id');
            $fi = $this->upload->data();
            $keterangan= $this->input->post('keterangan');
            if($id==0){
                $this->db->insert("banner_page",
                    array(
                        "url_banner"=>$fi['file_name'],
                        "ket_banner"=>$keterangan,
                        "id_page"=>1,
                        "sts_page"=>1,
                    )
                );
                $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Banner berhasil di upload.</div>');
                redirect("admin/banner");
            }else{
                $get_image_old=$this->db->select("url_banner")->from("banner_page")->where("id_banner",$id)->where("id_page",1)->get()->row()->url_banner;
                $this->db->update("banner_page",
                    array(
                        "url_banner"=>$fi['file_name'],
                        "ket_banner"=>$keterangan,
                    ),array(
                        "id_banner"=>$id,
                        "id_page"=>1
                    )
                );
                if($this->db->affected_rows()==1){
                    @unlink(FCPATH."./assets/img/honda/slide_home/".$get_image_old);
                }
                $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Banner berhasil di upload.</div>');
                redirect("admin/banner");
            }
        }
    }

    /*admin backend Menu Lainnya*/
    function delete_brosur(){
        $id  = decrypt_url($this->uri->segment(3));
        $data= $this->db->select("*")->from("tbl_brosur")->where("id",$id)->get()->row_array();
        $file_name = $data['nama_file'];
      
        if(is_file("./assets/fileku/".$file_name)) {
            unlink(FCPATH."./assets/fileku/".$file_name);
        }   
        $sql = $this->db->get_where("tbl_brosur",array("id"=>$id))->num_rows();
        if($sql==1){
            $this->db->delete("tbl_brosur",array('id'=>$id));
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Brosur berhasil dihapus.</div>');
            redirect("admin/data_brosur");
        }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data Brosur sudah dihapus.</div>');
            redirect("admin/data_brosur");
        }   
    }
    
    function upload_brosur(){
        $config = array(
            'upload_path'   => './assets/fileku/',
            'allowed_types' => 'pdf',
            'remove_spaces' => TRUE,
            'max_size'      => 38000,
        );
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('nama_file')){
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Hanya File dengan format : *.pdf atau maks. size : 38MB yang diperbolehkan untuk disimpan.</div>');
            redirect("admin/data_brosur");
        }else{
            $fi = $this->upload->data();
            $keterangan= $this->input->post('keterangan');
            $this->db->insert("tbl_brosur",array("nama_file"=>$fi['file_name'],"keterangan"=>$keterangan,"date_insert"=>date('Y-m-d H:i:s')));
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Brosur berhasil di upload.</div>');
            redirect("admin/data_brosur");
        }
    }
    
    function delete_pemohon_brosur(){
        $id = decrypt_url($this->uri->segment(3));
        $sql = $this->db->query("select id FROM tbl_email where id='$id'")->num_rows();
        if($sql==1){
            $this->db->where("id",$id);
            $this->db->delete("tbl_email");
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Pemohon Brosur berhasil dihapus.</div>');
            redirect('admin/pemohon_brosur');
         }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data Pemohon Brosur sudah dihapus.</div>');
            redirect('admin/pemohon_brosur');
         } 
    }
    
    /*admin backend Ubah Password*/
    function hapus_user(){
        $id = decrypt_url($this->uri->segment(3));
        $sql = $this->db->query("SELECT * FROM user where id_user ='$id'")->num_rows();
        if($sql==1){
            $this->db->where('id_user',$id);
            $this->db->delete("user");
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data User Login telah berhasil dihapus.</div>');
            redirect("admin/ubah_password");
        }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data User Login sudah dihapus.</div>');
            redirect("admin/ubah_password");
        }   
    }
    
    function tambahubah_user(){
        $tipe = $this->input->post('tipe');
        $nm = strtolower($this->input->post('nama_user'));
        $pw = encrypt_url($this->input->post('password'));
        if($tipe=='add'){
            $sql = $this->db->get_where("user",array("nama_user"=>$nm))->num_rows();
            if($sql==0){
                $this->db->insert("user",
                    array(
                        "nama_user"=>$nm,
                        "pass"=>$pw
                    )
                );
                $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data User Login telah berhasil ditambahkan.</div>');
                redirect("admin/ubah_password");
            }else{
                $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data User Login sudah ada, tidak dapat menambahkan data, silahkan ulangi kembali.</div>');
                redirect("admin/ubah_password");
            }
        }else if($tipe=='edit'){
            $id_user= decrypt_url($this->input->post('id_user'));
            $val = $this->db->get_where("user",array("nama_user"=>$nm))->num_rows();

            @$username = $this->db->select("nama_user")->from("user")->where("nama_user",$nm)->where("pass",$pw)->get()->row()->nama_user;                              
            @$id_user2 = $this->db->select("id_user")->from("user")->where("nama_user",$nm)->get()->row()->id_user;                                
            @$xid_user = $this->db->select("id_user")->from("user")->where("nama_user",$nm)->where("pass",$pw)->get()->row()->id_user;
            if($val==0){
                $this->db->update('user',
                    array(
                        "nama_user"=>$nm,
                        "pass"=>$pw
                    ),array(
                        "id_user"=>$id_user
                    )
                );
                $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data User Login berhasil diubah.</div>');
                redirect("admin/ubah_password");
            }else if(($val==1)&&($username==$nm)&&($id_user==$xid_user)){ 
                $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Duplikasi data pada Nama User Login, data tidak disimpan.</div>');
                redirect("admin/ubah_password");
            }else if(($val==1)&&(!$id_user==$xid_user)){
                if(($id_user2!=$id_user)){ 
                    $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Duplikasi data pada Nama User Login, data tidak disimpan.</div>');
                    redirect("admin/ubah_password");
                }else{ 
                    $this->db->update('user',
                        array(
                            "nama_user"=>$nm,
                            "pass"=>$pw
                        ),array(
                            "id_user"=>$id_user
                        )
                    );
                    $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data User Login berhasil diubah.</div>');
                    redirect("admin/ubah_password");
                }
            }else{ 
                $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Proses pengubahan data User tidak berhasil, data tidak disimpan.</div>');
                redirect("admin/ubah_password");
            }
        }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Maaf terjadi galat data, silahkan ulangi kembali inputan anda.</div>');
            redirect("admin/ubah_password");
        }
    }

    /*admin backend Kontak Kami*/
    function hapus_chat(){
        $id = decrypt_url($this->uri->segment(3));
        @$file_name= $this->db->select("foto_pp")->from("chat_us")->where("id_chat",$id)->get()->row()->foto_pp;
        $this->db->delete("chat_us",array('id_chat'=>$id));
        if($this->db->affected_rows()==1){
            @unlink(FCPATH."./assets/img/".$file_name);
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Kontak berhasil dihapus.</div>');
            redirect("admin/kontak_us");
        }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data Kontak sudah dihapus.</div>');
            redirect("admin/kontak_us");
        }
    }
    
    function status_chat(){
        $id = decrypt_url($this->uri->segment(3));
        $sts = $this->uri->segment(4);
        $status = ($sts==0?1:0);
        $this->db->update("chat_us",
            array(
                'sts_chat'=>$status
            ),array(
                'id_chat'=>$id,
                'sts_chat'=>$sts,
            )
        );
        if($this->db->affected_rows()==1){
            $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Kontak berhasil diubah.</div>');
            redirect("admin/kontak_us");
        }else{
            $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Data Kontak tidak dapat diubah karena terjadi perubahan data, silahkan ulangi kembali.</div>');
            redirect("admin/kontak_us");
        }   
    }
    
    function upload_kontak(){
        $config = array(
            'upload_path'   => './assets/img/',
            'allowed_types' => 'jpeg||jpg||png',
            'encrypt_name'  => TRUE,
            'remove_spaces' => TRUE,
            'max_size'      => 2048,
        );
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('nama_file')){
            $id=(int) $this->input->post('id');
            $keterangan= $this->input->post('keterangan');
            $no_wa= $this->input->post('no_wa');
            if($id==0){
                $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Hanya File dengan format : *.jpg,*.jpeg,*.png atau maks. size : 2MB yang diperbolehkan untuk disimpan.</div>');
                redirect("admin/kontak_us");
            }else{
                $this->db->update("chat_us",
                    array(
                        "nama_pengguna"=>$keterangan,
                        "no_wa"=>$no_wa,
                    ),array(
                        "id_chat"=>$id
                    )
                );
                if($this->db->affected_rows()==1){
                    $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Kontak berhasil di ubah.</div>');
                    redirect("admin/kontak_us");
                }else{
                    $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Hanya File dengan format : *.jpg,*.jpeg,*.png atau maks. size : 2MB yang diperbolehkan untuk disimpan.</div>');
                    redirect("admin/kontak_us");
                }
            }
        }else{
            $id=(int) $this->input->post('id');
            $fi = $this->upload->data();
            $keterangan= $this->input->post('keterangan');
            $no_wa= $this->input->post('no_wa');
            if($id==0){
                $this->db->insert("chat_us",
                    array(
                        "foto_pp"=>$fi['file_name'],
                        "nama_pengguna"=>$keterangan,
                        "no_wa"=>$no_wa,
                        "sts_chat"=>1,
                    )
                );
                $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Kontak berhasil di upload.</div>');
                redirect("admin/kontak_us");
            }else{
                $get_image_old=$this->db->select("foto_pp")->from("chat_us")->where("id_chat",$id)->get()->row()->foto_pp;
                $this->db->update("chat_us",
                    array(
                        "foto_pp"=>$fi['file_name'],
                        "nama_pengguna"=>$keterangan,
                        "no_wa"=>$no_wa,
                    ),array(
                        "id_chat"=>$id
                    )
                );
                if($this->db->affected_rows()==1){
                    @unlink(FCPATH."./assets/img/".$get_image_old);
                }
                $this->session->set_flashdata('alert','<div class="alert alert-success" role="alert">Data Kontak berhasil di upload.</div>');
                redirect("admin/kontak_us");
            }
        }
    }
    function ajaxfile(){
        $type = $_GET['type'];
        $CKEditor = $_GET['CKEditor'];
        $funcNum  = $_GET['CKEditorFuncNum']; 
        if ($type == 'image') { 
            $allowed_extension = array(
                "png",
                "jpg",
                "jpeg",
            ); 
            $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
            if(in_array(strtolower($file_extension), $allowed_extension)){
                $namaFile      = $_FILES['upload']['name'];
                $namaSementara = $_FILES['upload']['tmp_name'];
                $dirUpload     = FCPATH."./assets/img_ckeditor/";
                $terupload     = move_uploaded_file($namaSementara, $dirUpload . $namaFile); 
                $url = base_url()."assets/img_ckeditor/".$_FILES['upload']['name'];
                    echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.',"'.$url.'","'.$message.'")</script>';
                } 
            exit;
        }
        if($type == 'file'){
            $allowed_extension = array(
                "doc",
                "pdf",
                "docx",
            ); 
            $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
            if (in_array(strtolower($file_extension), $allowed_extension)) {
                if (move_uploaded_file($_FILES['upload']['tmp_name'], base_url('assets/').$_FILES['upload']['name'])){ 
                    if (isset($_SERVER['HTTPS'])) {
                        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
                    } else {
                        $protocol = 'http';
                    } 
                    $url = base_url()."assets/".$_FILES['upload']['name']; 
                    echo '<script>window.parent.CKEDITOR.tools.callFunction(' . $funcNum . ', "' . $url . '", "' . $message . '")</script>';
                }
            }
            exit;
        }
    }
    //========================================================================================
    function mst_klasis(){
        load_view("admin/mst_klasis");
    }
    function klasis_datatable(){
        $this->tbl->select(["mst_klasis.id_klasis","nama_klasis","nama"])
                    ->from("mst_klasis")
                    ->join("user","(user.id_klasis=mst_klasis.id_klasis and user.role=1)","left")
                    ->order_by("nama_klasis asc")
                    ->result();
    }
    function klasis_save(){
        $id_klasis=$this->input->post("id_klasis");
        $nama_klasis=$this->input->post("nama_klasis");
        $nama_klasis=explode(",",$nama_klasis);
        $data=[];
        $nama=[];
        for($x=0;$x<count($nama_klasis);$x++){
            $dt=trim(ucwords(strtolower(preg_replace("/(\s+|[^a-zA-Z ])/im"," ",$nama_klasis[$x]))));
            if($dt!=""&&!in_array($dt,$nama)){
                $nama[]=$dt;
                $data[]=[
                            "nama_klasis"=>$dt
                        ];
            }
        }
        if(count($data)==0)echo "Klasis belum ditambahkan";
        else{
            $cek=$this->db->select("nama_klasis")->where_in("nama_klasis",$nama)->get("mst_klasis")->result();
            if(count($cek)>0){
                echo "Data klasis berikut ini telah ditambahkan sebelumnya : <br/>- ".implode(",<br/>- ",array_column($cek,"nama_klasis"));
            }else{
                if($id_klasis=="")$this->db->insert_batch("mst_klasis",$data);
                else $this->db->where("id_klasis",$id_klasis)->update("mst_klasis",$data[0]);
                echo "ok";
            }
        }
    }
    //========================================================================================
     function mst_runggun(){
        load_view("admin/mst_runggun");
    }
    function runggun_datatable(){
        $this->tbl->select(["mst_runggun.id_runggun","nama_klasis","nama_runggun","nama","mst_klasis.id_klasis"])
                    ->from("mst_klasis")
                    ->join("mst_runggun","mst_runggun.id_klasis=mst_klasis.id_klasis")
                    ->join("user","(user.id_runggun=mst_runggun.id_runggun and user.role=2)","left");
        $id_klasis=$this->input->post("id_klasis");
        if($id_klasis)  $this->tbl->where("mst_runggun.id_klasis",$id_klasis);
        $this->tbl->order_by("nama_klasis asc,nama_runggun asc")
                    ->result();
    }
    function select_klasis(){
        $cari=explode(" ",$this->input->post("search")??"");
        $this->db->select("id_klasis as id,nama_klasis as text")->from("mst_klasis");
        $first=false;
        foreach ($cari as $dt) {
            $dt=trim($dt);
            if($dt!=""){
                $this->db->group_start();
                if(!$first){
                    $this->db->like("nama_klasis",$dt);
                }else{
                    $this->db->or_like("nama_klasis",$dt);
                }
                $this->db->group_end();
            }
        }
        $data=$this->db->limit(10)->get()->result();
        echo json_encode($data);
    }
    function runggun_save(){
        $id_klasis=$this->input->post("id_klasis");
        if($id_klasis=="")echo "Nama klasis belum dipilih";
        else{
            $id_runggun=$this->input->post("id_runggun");
            $nama_runggun=$this->input->post("nama_runggun");
            $nama_runggun=explode(",",$nama_runggun);
            $data=[];
            $nama=[];
            for($x=0;$x<count($nama_runggun);$x++){
                $dt=trim(ucwords(strtolower(preg_replace("/(\s+|[^a-zA-Z ])/im"," ",$nama_runggun[$x]))));
                if($dt!=""&&!in_array($dt,$nama)){
                    $nama[]=$dt;
                    $data[]=[
                            "id_klasis"=>$id_klasis,
                            "nama_runggun"=>$dt
                        ];
                }
            }
            if(count($data)==0)echo "Runggun belum ditambahkan";
            else{
                $cek=$this->db->select("nama_runggun")->where("id_klasis",$id_klasis)->where_in("nama_runggun",$nama)->get("mst_runggun")->result();
                if(count($cek)>0){
                    echo "Data runggun berikut ini telah ditambahkan sebelumnya : <br/>- ".implode(",<br/>- ",array_column($cek,"nama_runggun"));
                }else{
                    if($id_runggun=="")$this->db->insert_batch("mst_runggun",$data);
                    else $this->db->where("id_runggun",$id_runggun)->update("mst_runggun",$data[0]);
                    echo "ok";
                }
            }
        }
    }
    //========================================================================================
     function mst_sektor(){
        load_view("admin/mst_sektor");
    }
    function sektor_datatable(){
        $this->tbl->select(["mst_sektor.id_sektor","nama_klasis","nama_runggun","nama_sektor","nama","mst_klasis.id_klasis","mst_runggun.id_runggun"])
                    ->from("mst_klasis")
                    ->join("mst_runggun","mst_runggun.id_klasis=mst_klasis.id_klasis")
                    ->join("mst_sektor","mst_sektor.id_runggun=mst_runggun.id_runggun")
                    ->join("user","(user.id_sektor=mst_sektor.id_sektor and user.role=3)","left");
        $id_klasis=$this->input->post("id_klasis");
        $id_runggun=$this->input->post("id_runggun");
        if($id_klasis)  $this->tbl->where("mst_sektor.id_klasis",$id_klasis);
        if($id_runggun) $this->tbl->where("mst_sektor.id_runggun",$id_runggun);
        $this->tbl->order_by("nama_klasis asc,nama_runggun asc,nama_sektor asc")
                    ->result();
    }
    function select_runggun(){
        $id_klasis=$this->input->post("id_klasis");
        $data=[];
        if($id_klasis!=""){
            $cari=explode(" ",$this->input->post("search")??"");
            $this->db->select("id_runggun as id,nama_runggun as text")->from("mst_runggun")->where("id_klasis",$id_klasis);
            $first=false;
            foreach ($cari as $dt) {
                $dt=trim($dt);
                if($dt!=""){
                    $this->db->group_start();
                    if(!$first){
                        $this->db->like("nama_runggun",$dt);
                    }else{
                        $this->db->or_like("nama_runggun",$dt);
                    }
                    $this->db->group_end();
                }
            }
            $data=$this->db->limit(10)->get()->result();
        }
        echo json_encode($data);
    }
    function sektor_save(){
        $id_klasis=$this->input->post("id_klasis");
        $id_runggun=$this->input->post("id_runggun");
        if($id_klasis=="")echo "Nama klasis belum dipilih";
        else if($id_runggun=="")echo "Nama runggun belum dipilih";
        else{
            $id_sektor=$this->input->post("id_sektor");
            $nama_sektor=$this->input->post("nama_sektor");
            $nama_sektor=explode(",",$nama_sektor);
            $data=[];
            $nama=[];
            for($x=0;$x<count($nama_sektor);$x++){
                $dt=trim(ucwords(strtolower(preg_replace("/(\s+|[^a-zA-Z ])/im"," ",$nama_sektor[$x]))));
                if($dt!=""&&!in_array($dt,$nama)){
                    $nama[]=$dt;
                    $data[]=[
                            "id_klasis"=>$id_klasis,
                            "id_runggun"=>$id_runggun,
                            "nama_sektor"=>$dt
                        ];
                }
            }
            if(count($data)==0)echo "Sektor belum ditambahkan";
            else{
                $cek=$this->db->select("nama_sektor")->where("id_klasis",$id_klasis)->where("id_runggun",$id_runggun)->where_in("nama_sektor",$nama)->get("mst_sektor")->result();
                if(count($cek)>0){
                    echo "Data sektor berikut ini telah ditambahkan sebelumnya : <br/>- ".implode(",<br/>- ",array_column($cek,"nama_sektor"));
                }else{
                    if($id_sektor=="")$this->db->insert_batch("mst_sektor",$data);
                    else $this->db->where("id_sektor",$id_sektor)->update("mst_sektor",$data[0]);
                    echo "ok";
                }
            }
        }
    }
    function select_sektor(){
        $id_runggun=$this->input->post("id_runggun");
        $data=[];
        if($id_runggun!=""){
            $cari=explode(" ",$this->input->post("search")??"");
            $this->db->select("id_sektor as id,nama_sektor as text")->from("mst_sektor")->where("id_runggun",$id_runggun);
            $first=false;
            foreach ($cari as $dt) {
                $dt=trim($dt);
                if($dt!=""){
                    $this->db->group_start();
                    if(!$first){
                        $this->db->like("nama_sektor",$dt);
                    }else{
                        $this->db->or_like("nama_sektor",$dt);
                    }
                    $this->db->group_end();
                }
            }
            $data=$this->db->limit(10)->get()->result();
        }
        echo json_encode($data);
    }
    //========================================================================================
    function mst_pengguna(){
        load_view("admin/mst_pengguna");
    }
    function pengguna_datatable(){
        $this->tbl->select(["user.id_user","user.pass","user.photo","user.nama","user.nama_user","user.istri","user.anak","user.penggelaran","user.tempat_lahir","user.tgl_lahir","user.alamat","nama_klasis","nama_sektor","nama_runggun","email","pekerjaan","concat(marga.nama_silima,' (',sub_marga.nama_marga,')') as marga","concat(bere.nama_silima,' (',sub_bere.nama_marga,')') as bere","gol_darah","GROUP_CONCAT(user_hp.no_hp SEPARATOR ',') as no_hp","nama_klasis","nama_runggun","nama_sektor","role","user.id_klasis","user.id_runggun","user.id_sektor"])
                    ->from("user")
                    ->join("user_hp","user_hp.id_user=user.id_user")
                    ->join("mst_silima as marga","marga.id_silima=user.marga_id_silima")
                    ->join("mst_marga as sub_marga","sub_marga.id_marga=user.marga_id_marga")
                    ->join("mst_silima as bere","bere.id_silima=user.bere_id_silima")
                    ->join("mst_marga as sub_bere","sub_bere.id_marga=user.bere_id_marga")
                    ->join("mst_klasis","mst_klasis.id_klasis=user.id_klasis")
                    ->join("mst_runggun","mst_runggun.id_runggun=user.id_runggun")
                    ->join("mst_sektor","mst_sektor.id_sektor=user.id_sektor","left")
                    ->where("role>=",0);
        $id_klasis  =$this->input->post("id_klasis");
        $id_runggun =$this->input->post("id_runggun");
        $id_sektor  =$this->input->post("id_sektor");
        if($id_klasis)  $this->tbl->where("user.id_klasis",$id_klasis);
        if($id_runggun) $this->tbl->where("user.id_runggun",$id_runggun);
        if($id_sektor)  $this->tbl->where("user.id_sektor",$id_sektor);
        $data=$this->tbl->order_by("nama_klasis asc,nama_runggun asc,nama_sektor asc,nama asc")
                    ->group_by("user.id_user")
                    ->result(false);

        for($x=0;$x<count($data['data']);$x++) {
            $data['data'][$x]->nama_user.=" <i style='color:red'>`".decrypt_url($data['data'][$x]->pass).'`</i>';
            unset($data['data'][$x]->pass);
        }
        echo json_encode($data);
    }
    function pengguna_set_admin(){
        $id_user    =$this->input->post("id_user");
        $id_set     =$this->input->post("id_set");
        $set_to     =$this->input->post("set_to");
        $role       =$this->session->userdata("role");

        $this->db->where("id_user",$id_user)->update("user",["role"=>$set_to]);
        if($set_to!=4){
            $user=$this->db->select("id_klasis,id_runggun,id_sektor")->where("id_user",$id_user)->get("user")->row();
            if($set_to==1){//klasis
                $this->db->where("id_klasis",$user->id_klasis);
            }else if($set_to==2){//runggun
                $this->db->where("id_runggun",$user->id_runggun);
            }else if($set_to==3){//sektor
                $this->db->where("id_sektor",$user->id_sektor);
            }
            $this->db->where("role",$set_to)->where("id_user!=",$id_user)->update("user",["role"=>4]);
        }
        echo "ok";
    }
    function pengguna_reset_password(){
        $res=(object)[
            "status"=>false,
            "data"=>null,
            "error"=>""
        ];
        $new_pass=[];
        $on=true;
        for($x=0;$x<6;$x++){
            $new_pass[]=$on?rand(0,9):chr(rand(65,90));
            $on=!$on;
        }
        shuffle($new_pass);
        $new_pass=implode("",$new_pass);
        $id_user =$this->input->post("id_user");
        $this->db->where("id_user",$id_user)->update("user",["pass"=>encrypt_url($new_pass)]);
        if($this->db->affected_rows()==1){
            $res->data=$new_pass;
            $res->status=true;
        }else $res->error="Pengguna tidak ditemukan";
        echo json_encode($res);
    }
    //========================================================================================
    function mst_bidang(){
        load_view("admin/mst_bidang");
    }
    function bidang_datatable(){
        $this->tbl->select(["mst_bidang.id_bidang","nama_bidang"])
                    ->from("mst_bidang")
                    ->result();
    }
    function bidang_save(){
        $id_bidang=$this->input->post("id_bidang");
        $nama_bidang=$this->input->post("nama_bidang");
        preg_match_all("/\((.*?\))/i",$nama_bidang,$res);
        $list_place=[];
        if(count($res[0])>0){
            for($x=0;$x<count($res[0]);$x++) {
                $dt=$res[0][$x];
                $list_place[]=$dt;
                $nama_bidang=str_replace($dt,"_".$x."_",$nama_bidang);
            }
        }
        $nama_bidang=explode(",",$nama_bidang);
        for($x=0;$x<count($list_place);$x++){
            for($y=0;$y<count($nama_bidang);$y++){
                $nama_bidang[$y]=str_replace("_".$x."_",$list_place[$x],$nama_bidang[$y]);
            }
        }
        $data=[];
        $nama=[];
        for($x=0;$x<count($nama_bidang);$x++){
            $dt=trim(ucwords(strtolower(preg_replace("/(\s+|[^a-zA-Z ,()])/im"," ",$nama_bidang[$x]))));
            if($dt!=""&&!in_array($dt,$nama)){
                $nama[]=$dt;
                $data[]=[
                            "nama_bidang"=>$dt
                        ];
            }
        }
        if(count($data)==0)echo "Bidang belum ditambahkan";
        else{
            $cek=$this->db->select("nama_bidang")->where_in("nama_bidang",$nama)->get("mst_bidang")->result();
            if(count($cek)>0){
                echo "Data bidang berikut ini telah ditambahkan sebelumnya : <br/>- ".implode(",<br/>- ",array_column($cek,"nama_bidang"));
            }else{
                if($id_bidang=="")$this->db->insert_batch("mst_bidang",$data);
                else $this->db->where("id_bidang",$id_bidang)->update("mst_bidang",$data[0]);
                echo "ok";
            }
        }
    }
    function select_bidang(){
        $cari=explode(" ",$this->input->post("search")??"");
        $this->db->select("id_bidang as id,nama_bidang as text")->from("mst_bidang");
        $first=false;
        foreach ($cari as $dt) {
            $dt=trim($dt);
            if($dt!=""){
                $this->db->group_start();
                if(!$first){
                    $this->db->like("nama_bidang",$dt);
                }else{
                    $this->db->or_like("nama_bidang",$dt);
                }
                $this->db->group_end();
            }
        }
        $data=$this->db->limit(10)->get()->result();
        echo json_encode($data);
    }
    //========================================================================================
    function program_kegiatan(){
        load_view("admin/program_kegiatan");
    }
    function program_kegiatan_datatable(){
        $tahun=$this->input->post("tahun");
        $jenis=$this->input->post("jenis");
        $id_pemilik=$this->input->post("id_pemilik");
        $pemilik="";
        if($this->input->post("jenis")!='pusat'){
            $pemilik="and id_pemilik='$id_pemilik'";
        }
       $this->tbl->select(["mst_bidang.id_bidang","nama_bidang","program_kegiatan.id_kegiatan","nama_kegiatan","tempat","tujuan","target_fisik","anggaran_lokal","anggaran_subsidi","total_anggaran","pelaksana","group_concat(jadwal order by jadwal asc separator ',') as jadwal","keterangan"])
                ->from("mst_bidang")
                ->join("program_kegiatan","(
                                            program_kegiatan.id_bidang=mst_bidang.id_bidang
                                            and jenis='$jenis'
                                            and tahun='$tahun'
                                            $pemilik
                                        )","left")
                ->join("jadwal_kegiatan","jadwal_kegiatan.id_kegiatan=program_kegiatan.id_kegiatan","left")
                ->group_by("mst_bidang.id_bidang,program_kegiatan.id_kegiatan")
                ->result();
    }
    function program_kegiatan_save(){
        $data=(object)$this->input->post();
        $data->nama_kegiatan=ucwords($data->nama_kegiatan);
        $data->tempat=ucwords($data->tempat);
        $data->tujuan=ucwords($data->tujuan);
        $data->pelaksana=ucwords($data->pelaksana);
        $data->keterangan=ucwords($data->keterangan==""?"-":$data->keterangan);
        $data->target_fisik=preg_replace("/\./im","","0".$data->target_fisik);
        $data->anggaran_lokal=preg_replace("/\./im","","0".$data->anggaran_lokal);
        $data->anggaran_subsidi=preg_replace("/\./im","","0".$data->anggaran_subsidi);
        $data->total_anggaran=$data->anggaran_lokal+$data->anggaran_subsidi;
        $data->date_update=date("Y-m-d h:i:s");

        $data->id_pemilik=$data->id_pemilik==''?0:$data->id_pemilik;

        $jadwal=$data->jadwal;
        unset($data->jadwal);
        $this->db->replace("program_kegiatan",$data);
        if($this->db->affected_rows()>0){
            $dt_jadwal=[];
            $id_kegiatan=$this->db->insert_id();
            $this->db->where("id_kegiatan",$id_kegiatan)->delete("jadwal_kegiatan");
            foreach ($jadwal as $dt) {
                $dt_jadwal[]=[
                    "id_kegiatan"=>$id_kegiatan,
                    "jadwal"=>$dt
                ];
            }
            $this->db->insert_batch("jadwal_kegiatan",$dt_jadwal);
            echo "ok";
        }else{
            echo "Terjadi kesalahan saat menyimpan data, periksa ulang data anda dan coba kembali. Jika kesalahan tetap terjadi coba segarkan halaman.";
        }
    }
    function pass($user){
        echo decrypt_url($this->db->select("pass")->where("nama_user",$user)->get("user")->row()->pass);
    }
    //========================================================================================
    function undangan(){
        load_view("admin/undangan");
    }
    function undangan_datatable(){
        $jenis          =$id_pengirim=$id_penerima="";
        $role           =$this->session->userdata("role");
        $id_klasis      =$this->session->userdata("id_klasis");
        $id_runggun     =$this->session->userdata("id_runggun");
        $id_sektor      =$this->session->userdata("id_sektor");
        $tipe           =$this->input->post("tipe");


        $pengirim="";
        $penerima="";
        if($tipe=="diterima"){
            if($role<=0){
                $jenis="klasis";
                $id_penerima=0;
                $pengirim="klasis";
                $penerima="pusat";
            }
            else if($role==1){
                $jenis="runggun";
                $id_penerima=$id_klasis;
                $pengirim="runggun";
                $penerima="klasis";
            }else if($role==2){
                $jenis="sektor";
                $id_penerima=$id_runggun;
                $pengirim="sektor";
                $penerima="runggun";
            }
            $this->db->where("id_penerima",$id_penerima);
        }else{//kirim
            if($role==1){
                $jenis="klasis";
                $id_pengirim=$id_klasis;
                $pengirim="klasis";
                $penerima="pusat";
            }else if($role==2){
                $jenis="runggun";
                $id_pengirim=$id_runggun;
                $pengirim="runggun";
                $penerima="klasis";
            }else if($role==3){
                $jenis="sektor";
                $id_pengirim=$id_sektor;
                $pengirim="sektor";
                $penerima="runggun";
            }
            $this->db->where("id_pengirim",$id_pengirim);
        }
        $this->tbl->select(["id_undangan","perihal","id_pengirim","id_penerima","concat('".ucwords($pengirim)." ',nama_".$pengirim.") as pengirim","concat('".ucwords($penerima)." ',".($penerima=='pusat'?"' '":"nama_".$penerima).") as penerima","date_format(tgl_kirim,'%d/%m/%Y %H:%i') as tgl_kirim","file_undangan"])
                    ->from("undangan")
                    ->join("mst_".$pengirim,"mst_".$pengirim.".id_".$pengirim."=undangan.id_pengirim");
        if($penerima!='pusat')$this->tbl->join("mst_".$penerima,"mst_".$penerima.".id_".$penerima."=undangan.id_penerima");
        $this->tbl->where("jenis",$jenis)
                    ->order_by("id_undangan desc")
                    ->result();
    }
    function undangan_save(){
        $id_user=$this->session->userdata("id_user");
        $perihal=ucwords(strtolower($this->input->post("perihal")));
        $source_pdf=base64_decode($this->input->post("file_undangan"));

        $nama_file="Undangan ".$perihal." ".$id_user."_".time().".pdf";
        file_put_contents("./assets/pdf/".$nama_file,$source_pdf);

        $jenis      =$id_pengirim=$id_penerima="";
        $role       =$this->session->userdata("role");
        $id_klasis  =$this->session->userdata("id_klasis");
        $id_runggun =$this->session->userdata("id_runggun");
        $id_sektor  =$this->session->userdata("id_sektor");

        $nama_pengirim="";
        if($role==1){
            $jenis="klasis";
            $id_pengirim=$id_klasis;
            $id_penerima=0;
            $nama_pengirim=$this->session->userdata("nama_klasis");
            $this->db->where_in("role",[-1,0]);
        }else if($role==2){
            $jenis="runggun";
            $id_pengirim=$id_runggun;
            $id_penerima=$id_klasis;
            $nama_pengirim=$this->session->userdata("nama_runggun");
            $this->db->where("id_klasis",$id_klasis)
                    ->where("role",1);
        }else if($role==3){
            $jenis="sektor";
            $id_pengirim=$id_sektor;
            $id_penerima=$id_runggun;
            $nama_pengirim=$this->session->userdata("nama_sektor");
            $this->db->where("id_runggun",$id_runggun)
                    ->where("role",2);
        }
        $token=$this->db->select("firebase_token")
                        ->where("id_user!=",$id_user)
                        ->get("user")
                        ->result();
        $token=array_values(array_unique(array_column($token,"firebase_token")));
        $tgl_kirim=date("Y-m-d H:i:s");
        $this->db->insert("undangan",[
            "perihal"=>$perihal,
            "jenis"=>$jenis,
            "id_pengirim"=>$id_pengirim,
            "id_penerima"=>$id_penerima,
            "tgl_kirim"=>$tgl_kirim,
            "file_undangan"=>$nama_file
        ]);
        $data=[
                "judul"     =>"Undangan Diterima",
                "id_berita" =>0,
                "gambar"    =>app()->logo,
                "nama"      =>ucwords($jenis." ".$nama_pengirim),
                "pesan"     =>$perihal,
                "tipe"      =>4,
                "tgl_buat"  =>$tgl_kirim,
                "sts_berita"=>0,
                "op_buat"   =>$id_user,
                "lokasi"    =>"",
                "id_klasis" =>""
            ];
        FCM($token,$data);
        echo "ok";
    }
}