<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{

    public $table = 'mahasiswa';
    public $id = 'mahasiswa_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_query() {

        $sql = "SELECT * FROM mahasiswa INNER JOIN kelas ON kelas.kelas_id = mahasiswa.kelas_id ORDER BY mahasiswa_id";
        return $this->db->query($sql)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('mahasiswa_id', $q);
	$this->db->or_like('mahasiswa_npm', $q);
	$this->db->or_like('mahasiswa_nama', $q);
	$this->db->or_like('mahasiswa_alamat', $q);
	$this->db->or_like('mahasiswa_email', $q);
	$this->db->or_like('mahasiswa_tlp', $q);
	$this->db->or_like('mahasiswa_agama', $q);
	$this->db->or_like('kelas_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('mahasiswa_id', $q);
	$this->db->or_like('mahasiswa_npm', $q);
	$this->db->or_like('mahasiswa_nama', $q);
	$this->db->or_like('mahasiswa_alamat', $q);
	$this->db->or_like('mahasiswa_email', $q);
	$this->db->or_like('mahasiswa_tlp', $q);
	$this->db->or_like('mahasiswa_agama', $q);
	$this->db->or_like('kelas_id', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
 // CONFIGURATION COMBO BOX WITH DATABASE WITH VALIDASI
    public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
        echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
        echo "<option value=''>".$label."</option>";
        $query = $this->db->query($table);
        foreach ($query->result() as $row){
            if ($pilihan == $row->$value){
                echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
            } else {
                echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
            }
        }
        echo "</select>";
    }
    
}

/* End of file Mahasiswa_model.php */
/* Location: ./application/models/Mahasiswa_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-12 04:38:14 */
/* http://harviacode.com */