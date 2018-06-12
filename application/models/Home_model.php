<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model {

    var $table = 'pembelian_header';
    var $column_order = array('pembelian_header.Tanggal', 'pembelian_header.IDTransaksi', 'pembelian_header.Penjual', 'pembelian_detail.NamaProduk');
    var $column_search = array('ROUND(pembelian_header.IDTransaksi)', 'pembelian_header.Penjual', 'pembelian_detail.NamaProduk');
    var $order = array('pembelian_header.Tanggal' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_total_pembelian_by_qty_harga() {
        $this->db->select_sum('JumlahProduk')
                ->select('SUM(JumlahProduk*HargaProduk) AS HargaProduk');
        $query = $this->db->get('pembelian_detail');
        return $query->result_array();
    }

    function get_total_penjualan_by_qty_harga() {
        $this->db->select_sum('JumlahProduk')
                ->select_sum('HargaProduk');
        $query = $this->db->get('penjualan_detail');
        return $query->result_array();
    }

    function get_total_margin_penjualan() {
        $this->db->select('SUM(HargaProduk) - SUM(HargaBeli) AS margin_penjualan');
        $query = $this->db->get('penjualan_detail');
        return $query->result_array();
    }

    function get_total_produk() {
        $query = $this->db->get('produk');
        return $query->num_rows();
    }

    function get_count_penjualan_by_tahun() {
        $this->db->select('YEAR(Tanggal) AS Thn')
                ->from('penjualan_header')
                ->group_by('YEAR(Tanggal)');
        $query = $this->db->get();
        return $query->result_array();
    }

    //produk terlaris
    function get_count_penjualan_by_produk() {
        $this->db->select('NamaProduk, COUNT(*) AS Jumlah')
                ->from('penjualan_detail')
                ->group_by('NamaProduk');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getTotalPenjualanByYear($thn) {
        $this->db->select('YEAR(Tanggal) AS Tahun, MONTH(Tanggal) AS Bulan, SUM(HargaProduk-HargaBeli) AS TotJual, SUM(JumlahProduk) AS TotQty')
                ->from('penjualan_detail')
                ->join('penjualan_header', 'penjualan_header.IDTransaksi=penjualan_detail.IDTransaksi', 'inner')
                ->where('YEAR(penjualan_header.Tanggal)', $thn)
                ->group_by('MONTH(Tanggal)')
                ->order_by('Tanggal', 'ASC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    function getTotalPenjualanDetailByYear($thn) {
        $this->db->select('YEAR(Tanggal) AS Tahun, NamaProduk,
                        SUM(IF(MONTH(Tanggal) = 1, JumlahProduk, 0)) AS "1",
                        SUM(IF(MONTH(Tanggal) = 2, JumlahProduk, 0)) AS "2",
                        SUM(IF(MONTH(Tanggal) = 3, JumlahProduk, 0)) AS "3",
                        SUM(IF(MONTH(Tanggal) = 4, JumlahProduk, 0)) AS "4",
                        SUM(IF(MONTH(Tanggal) = 5, JumlahProduk, 0)) AS "5",
                        SUM(IF(MONTH(Tanggal) = 6, JumlahProduk, 0)) AS "6",
                        SUM(IF(MONTH(Tanggal) = 7, JumlahProduk, 0)) AS "7",
                        SUM(IF(MONTH(Tanggal) = 8, JumlahProduk, 0)) AS "8",
                        SUM(IF(MONTH(Tanggal) = 9, JumlahProduk, 0)) AS "9",
                        SUM(IF(MONTH(Tanggal) = 10, JumlahProduk, 0)) AS "10",
                        SUM(IF(MONTH(Tanggal) = 11, JumlahProduk, 0)) AS "11",
                        SUM(IF(MONTH(Tanggal) = 12, JumlahProduk, 0)) AS "12"')
                ->from('penjualan_detail')
                ->join('penjualan_header', 'penjualan_header.IDTransaksi=penjualan_detail.IDTransaksi', 'inner')
                ->where('YEAR(penjualan_header.Tanggal)', $thn)
                // ->group_by('MONTH(Tanggal)')
                ->group_by('NamaProduk')
                ->order_by('Tanggal', 'ASC')
                ->order_by('NamaProduk', 'ASC');
        $query = $this->db->get();
    //      echo $this->db->last_query();
        return $query->result_array();
    }

}
