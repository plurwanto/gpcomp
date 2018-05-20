<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('Home_model');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    public function index() {
        $data['total_pembelian_qty_harga'] = $this->Home_model->get_total_pembelian_by_qty_harga();
        $data['total_penjualan_qty_harga'] = $this->Home_model->get_total_penjualan_by_qty_harga();
        $data['total_margin_penjualan'] = $this->Home_model->get_total_margin_penjualan();
        $data['total_produk'] = $this->Home_model->get_total_produk();
        $data['tahun'] = $this->Home_model->get_count_penjualan_by_tahun();
        $data['content'] = 'home';
        $this->load->view('tampilan_home', $data);
    }

    function getTotalPenjualanByYear($thn) {
        $mylib = new Globallib();
        $result = $this->Home_model->getTotalPenjualanByYear($thn);
        $data = array();
        foreach ($result as $row) {
            $tahun = $row['Tahun'];
            $data[] = array(
                'Bulan' => $mylib->bulan($row['Bulan']),
                'TotJual' => $row['TotJual'],
                'TotQty' => $row['TotQty'], 
            );
        }
        $output = array(
            "thn" => $tahun,
            "data" => $data
        );
        echo json_encode($output);
    }

    function getProdukTerlaris() {
        $result = $this->Home_model->get_count_penjualan_by_produk();
        $data = array();
        foreach ($result as $row) {
            $data[] = array(
                'NamaProduk' => $row['NamaProduk'],
                'Jumlah' => $row['Jumlah']
            );
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

}
