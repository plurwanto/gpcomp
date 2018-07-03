<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penjualan_model extends CI_Model {

    var $table = 'penjualan_header';
    var $column_order = array('penjualan_header.Tanggal', 'penjualan_header.IDTransaksi', 'penjualan_header.Pembeli', 'penjualan_detail.NamaProduk');
    var $column_search = array('ROUND(penjualan_header.IDTransaksi)', 'penjualan_header.Penjual', 'penjualan_detail.NamaProduk');
    var $order = array('penjualan_header.Tanggal' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query() {
        //$this->db->from($this->table);
        $this->db->select('DATE_FORMAT(penjualan_header.Tanggal,"%d %M %Y") AS Tanggal,penjualan_header.IDTransaksi AS KdTransaksi,penjualan_header.Pembeli,penjualan_header.TotalTerbayar,
                        penjualan_detail.NamaProduk,penjualan_detail.HargaProduk,penjualan_detail.JumlahProduk');
        $this->db->from('penjualan_header');
        $this->db->join('penjualan_detail', 'penjualan_detail.IDTransaksi=penjualan_header.IDTransaksi', 'left');
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_header_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('IDTransaksi', $id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_detail_by_id($id, $produk) {
        $this->db->from('penjualan_detail');
        $this->db->where('IDTransaksi', $id);
        $this->db->where('NamaProduk', $produk);
        $query = $this->db->get();
//echo $this->db->last_query();
        return $query->num_rows();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('IDTransaksi', $id);
        $this->db->delete($this->table);
    }

    function get_hargaBeliByName($name) {
        $this->db->select('HargaBeliProduk')
                ->from('produk')
                ->where('NamaProduk', $name);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getKategory() {
        $this->db->select('CategoryId,CategoryName')
                ->from('category')
                ->where('Status', 'Y');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_districts() {
        $this->db->select('name')
                ->from('districts');
        $query = $this->db->get();
        return $query->result_array();
    }

}
