<?php
class M_datatable extends CI_Model {
    private $cell;
    public function __construct() {
        parent::__construct();
        $this->join=[];
        $this->where=[];
        $this->order_by=[];
        $this->group_by=[];
        $this->query=[];
        $this->cari = [];
        $this->select = [];
        $this->error="";
    }
    public function select($s) {
        if(is_array($s)){
            $this->select = $s;
            foreach ($s as $cell) {
                $cell=explode(",",$cell);
                foreach($cell as $dt){
                    $fn=trim(preg_replace("/(^.*?\(|\).*?$|[^a-z_.]|separator)/im","",$dt));
                    if($fn!="")$this->cari[] = $fn;
                }
            }
        }
        return $this;
    }
    public function from($s){
        if(is_array($s))$s=implode(",",$s);
        $this->table=$s;
        return $this;
    }
    public function join($t,$j,$c="inner"){
        $this->join[]=[$t,$j,$c];
        return $this;
    }
    public function order_by($s){
        $this->order_by[]=$s;
        return $this;
    }
    public function group_by($s){
        $this->group_by[]=$s;
        return $this;
    }
    public function where($s,$v){
        $this->where[]=[$s,$v];
        return $this;
    }
    public function result($echo=true) {
        if(count($this->select)==0)$this->error.="\nSelect harus array cell, misal : \$this->db->select(['id','nama'])";
        else if(!isset($this->table))$this->error.="\Tabel belum diatur, misal : \$this->db->from('mst_user')";
        $data=[
            "draw"           => (int)$this->input->post('draw'),
            "recordsFiltered"=> $this->error!=""?0:$this->_query(true),
            "data"           => $this->error!=""?[]:$this->_query(),
        ];
        if(!app()->release)$data['query']=$this->query;
        if(!app()->release)$data['error']=$this->error;
        if($echo)echo json_encode($data);
        else return $data;
    }
    function _query($is_count=false){
        $this->db->select($is_count?$this->select[0]:$this->select)
                ->from($this->table);
        foreach ($this->join as $dt) {
            $this->db->join($dt[0],$dt[1],$dt[2]);
        }
        if(count($this->where)>0){
            foreach ($this->where as $dt){
                $this->db->where($dt[0],$dt[1]);
            }
        }
        $cari=$this->input->post("search")['value'];
        if($cari!=""){
            $cari=array_unique(explode(" ",$cari));
            foreach ($cari as $cr){
                $cr=trim($cr);
                if($cr!=""){
                    $first=false;
                    $this->db->group_start();
                    foreach ($this->cari as $cl){
                        if(!$first){
                            $first=true;
                            $this->db->like($cl,$cr);
                        }else{
                            $this->db->or_like($cl,$cr);
                        }
                    }
                    $this->db->group_end();
                }
            }
        }
        if(count($this->order_by)>0)$this->db->order_by(implode(",",$this->order_by));
        if(count($this->group_by)>0)$this->db->group_by(implode(",",$this->group_by));
        if($is_count){
            $data=$this->db->get();
            if(!app()->release)$this->query[$is_count?'count':'data']=clean_query($this->db->last_query());
            if($data){
                $data=$data->num_rows();
            }else{
                $data=0;
                $this->error.="\n Query count error gan.";
            }
        }
        else{
            $data=[];
            $start=$this->input->post("start");
            $length=$this->input->post("length");
            if($length>=0)$data=$this->db->limit($length,$start);

            $data=$this->db->get();
            if(!app()->release)$this->query[$is_count?'count':'data']=clean_query($this->db->last_query());
            if($data){
                $data=$data->result();
                for($x=0;$x<count($data);$x++){
                    $data[$x]->dt_nomor=$start+=1;
                }
            }else{
                $data=0;
                $this->error.="\n Query data error gan";
            }
        }
        return $data;
    }
}