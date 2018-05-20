<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_model extends CI_Model {

    var $table = 'pembelian_header';
    var $column_order = array('pembelian_header.Tanggal', 'pembelian_header.IDTransaksi', 'pembelian_header.Penjual', 'pembelian_detail.NamaProduk');
    var $column_search = array('ROUND(pembelian_header.IDTransaksi)', 'pembelian_header.Penjual', 'pembelian_detail.NamaProduk');
    var $order = array('pembelian_header.Tanggal' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_pembelian_header_by_id($param, $first_date, $second_date) {
        if (!empty($param)) {
            $this->db->select('pembelian_header.*,pembelian_detail.*')
                    ->from('pembelian_header')
                    ->join('pembelian_detail', 'pembelian_detail.IDTransaksi = pembelian_header.IDTransaksi', 'left')
                    ->where('DATE_FORMAT(Tanggal,"%Y-%m-%d") >=', $first_date)
                    ->where('DATE_FORMAT(Tanggal,"%Y-%m-%d") <=', $second_date)
                    ->or_where('DATE_FORMAT(Tanggal,"%Y-%m-%d")', $param)
                    ->or_where('DATE_FORMAT(Tanggal,"%m")', $param)
                    ->or_where('DATE_FORMAT(Tanggal,"%Y")', $param)
                    ->order_by('Tanggal', 'DESC');
        } else {
            $this->db->select('pembelian_header.*,pembelian_detail.*')
                    ->from('pembelian_header')
                    ->join('pembelian_detail', 'pembelian_detail.IDTransaksi = pembelian_header.IDTransaksi', 'left')
                    ->order_by('Tanggal', 'DESC');
        }
        $query = $this->db->get();

        $retun_array = array();
        $retun_array['rows'] = $query->num_rows();
        if ($retun_array['rows'] > 0) {
            $retun_array['data'] = $query->result_array();
        }

        return $retun_array;

        // return $query->result_array();
    }

    public function get_detail_by_id($id) {
        $this->db->from('pembelian_detail');
        $this->db->where('IDTransaksi', $id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function getTotalPembelianByMonth($bln, $thn) {
        $this->db->select('SUM(JumlahProduk) AS TotQty, SUM(HargaProduk) AS TotHrg, SUM(BiayaPengiriman) AS TotKirim, SUM(BiayaPelayanan) AS TotPelayanan, SUM(KodePembayaran) AS TotKdBayar,'
                        . 'SUM(Voucher) AS TotVoucher, SUM(TotalTerbayar) AS TotTerbayar')  //JumlahProduk*HargaProduk+BiayaPengiriman+KodePembayaran-abs(Voucher)
                ->from('pembelian_detail')
                ->join('pembelian_header', 'pembelian_header.IDTransaksi=pembelian_detail.IDTransaksi', 'inner')
                ->where('MONTH(pembelian_header.Tanggal)', $bln)
                ->where('YEAR(pembelian_header.Tanggal)', $thn)
                ->order_by('Tanggal', 'DESC');
        $query = $this->db->get();
        //  echo $this->db->last_query();
        return $query->row();
    }

    public function get_penjualan_header_by_id($param, $first_date, $second_date) {
        if (!empty($param)) {
            $this->db->select('penjualan_header.*,penjualan_detail.*')
                    ->from('penjualan_header')
                    ->join('penjualan_detail', 'penjualan_detail.IDTransaksi = penjualan_header.IDTransaksi', 'left')
                    ->where('DATE_FORMAT(Tanggal,"%Y-%m-%d") >=', $first_date)
                    ->where('DATE_FORMAT(Tanggal,"%Y-%m-%d") <=', $second_date)
                    ->or_where('DATE_FORMAT(Tanggal,"%Y-%m-%d")', $param)
                    ->or_where('DATE_FORMAT(Tanggal,"%m")', $param)
                    ->or_where('DATE_FORMAT(Tanggal,"%Y")', $param)
                    ->order_by('Tanggal', 'DESC');
        } else {
            $this->db->select('penjualan_header.*,penjualan_detail.*')
                    ->from('penjualan_header')
                    ->join('penjualan_detail', 'penjualan_detail.IDTransaksi = penjualan_header.IDTransaksi', 'left')
                    ->order_by('Tanggal', 'DESC');
        }
        $query = $this->db->get();

        $retun_array = array();
        $retun_array['rows'] = $query->num_rows();
        if ($retun_array['rows'] > 0) {
            $retun_array['data'] = $query->result_array();
        }

        return $retun_array;

        // return $query->result_array();
    }

    function getTotalPenjualanByMonth($bln, $thn) {
        $this->db->select('SUM(JumlahProduk) AS TotQty, SUM(HargaBeli) AS TotHrgBeli, SUM(HargaProduk) AS TotHrg, SUM(BiayaPengiriman) AS TotKirim,'
                        . 'SUM(BiayaAsuransi) AS TotAsuransi, SUM(TotalTerbayar) AS TotTerbayar, SUM(JumlahProduk*HargaBeli) AS SubTotalHrgBeli, SUM(JumlahProduk*HargaProduk) AS SubTotalHrg')  //JumlahProduk*HargaProduk+BiayaPengiriman+KodePembayaran-abs(Voucher)
                ->from('penjualan_detail')
                ->join('penjualan_header', 'penjualan_header.IDTransaksi=penjualan_detail.IDTransaksi', 'inner')
                ->where('MONTH(penjualan_header.Tanggal)', $bln)
                ->where('YEAR(penjualan_header.Tanggal)', $thn)
                ->order_by('Tanggal', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }

    function getHargaBeliById($bln,$thn) {
        $this->db->select('HargaProduk')
                ->from('pembelian_detail')
                ->join('penjualan_detail', 'penjualan_detail.NamaProduk=pembelian_detail.NamaProduk', 'inner')
                ->where('MONTH(pembelian_detail.UpdateDate)', $bln)
                ->where('YEAR(pembelian_detail.UpdateDate)', $thn);
                //->order_by('Tanggal', 'DESC');
        $query = $this->db->get();
        //  echo $this->db->last_query();
        return $query->row();
    }

}
