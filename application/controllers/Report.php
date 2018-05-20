<?php
class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report_model');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $data['list_report'] = "";
        $data['content'] = 'report/view_report_pembelian';
        $this->load->view('tampilan_home', $data);
    }

    function show_report() {
        $mylib = new Globallib();
        $transaksi = $this->input->post('slttransaksi');
        $tampilan_cetak = $this->input->post('slttampilan');
        $option_tgl = $this->input->post('optdate');
        $tgl_1 = $this->input->post('tgl_1');
        $tgl_2 = $this->input->post('tgl_2');
        $param = $this->input->post('sltdate');
        // echo $option_tgl;
        if ($option_tgl == "fixedrange") {
            $param = $param;
            $tgl1 = "";
            $tgl2 = "";
        }
        if ($option_tgl == "customrange") {
            $tgl1 = $mylib->ubah_tanggal($tgl_1);
            $tgl2 = $mylib->ubah_tanggal($tgl_2);
            $param = "";
        }
        if ($transaksi == "pembelian") {
            if ($tampilan_cetak == "detail") {
                $data['list_report'] = $this->report_model->get_pembelian_header_by_id($param, $tgl1, $tgl2);
            }
            $data['content'] = 'report/view_report_pembelian';
        }

        if ($transaksi == "penjualan") {
            if ($tampilan_cetak == "detail") {
                $data['list_report'] = $this->report_model->get_penjualan_header_by_id($param, $tgl1, $tgl2);
            }
            $data['content'] = 'report/view_report_penjualan';
        }

        if (!empty($data)) {
            $this->load->view('tampilan_home', $data);
        } else {
            redirect('report');
        }
    }

}
