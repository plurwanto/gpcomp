<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pembelian_model extends CI_Model {

    var $table = 'pembelian_header';
    var $column_order = array('pembelian_header.Tanggal','pembelian_header.IDTransaksi','pembelian_header.Penjual','pembelian_detail.NamaProduk');
    var $column_search = array('ROUND(pembelian_header.IDTransaksi)', 'pembelian_header.Penjual','pembelian_detail.NamaProduk');
    var $order = array('pembelian_header.Tanggal' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query() {
        //$this->db->from($this->table);
        $this->db->select('DATE_FORMAT(pembelian_header.Tanggal,"%d %M %Y") AS Tanggal,ROUND(pembelian_header.IDTransaksi) AS KdTransaksi,pembelian_header.Penjual,pembelian_header.TotalTerbayar,
                        pembelian_detail.NamaProduk,pembelian_detail.HargaProduk,pembelian_detail.JumlahProduk');
        $this->db->from('pembelian_header');
        $this->db->join('pembelian_detail','pembelian_detail.IDTransaksi=pembelian_header.IDTransaksi','left');
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
    
    public function get_detail_by_id($id) {
        $this->db->from('pembelian_detail');
        $this->db->where('IDTransaksi', $id);
        $query = $this->db->get();

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
    
    function getKategory(){
        $this->db->select('CategoryId,CategoryName')
                ->from('category')
                ->where('Status','Y');
        $query = $this->db->get();
        return $query->result_array();
    }

}
