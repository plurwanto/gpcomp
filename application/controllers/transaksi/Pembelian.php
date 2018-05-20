<?php
class Pembelian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('transaksi/pembelian_model', 'pembelian');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $data['list_kategory'] = $this->pembelian->getKategory();
        $data['content'] = 'transaksi/pembelian/view_pembelian';
        $this->load->view('tampilan_home', $data);
    }

    public function ajax_list() {
        $myLib = new Globallib();
        $list = $this->pembelian->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pembelian) {
            $no++;
            // $status = ($pembelian->Status == 'Y' ? '<span class="label label-sm label-success">Active</span>' : '<span class="label label-sm label-danger">Not Active</span>');
            $row = array();
            $row[] = $pembelian->Tanggal;
            $row[] = $pembelian->KdTransaksi;
            $row[] = $pembelian->Penjual;
            $row[] = $pembelian->NamaProduk;
            $row[] = number_format($pembelian->HargaProduk,0,',','.'); // / $pembelian->JumlahProduk;
            $row[] = $pembelian->JumlahProduk;
            $row[] = number_format($pembelian->HargaProduk * $pembelian->JumlahProduk,0,',','.');

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pembelian->count_all(),
            "recordsFiltered" => $this->pembelian->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function upload_file() {

        $file = $_SERVER['DOCUMENT_ROOT'] . "/gpcomp/uploads/";
        $config['upload_path'] = $file;
        $config['overwrite'] = true;
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '2000';
        $config['charset'] = 'utf-8';

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) {
                    echo $this->upload->display_errors();
                } else {
                    $upload_data = $this->upload->data();
                    $situs = $this->input->post('sltsitus');
                    $file = $file . $upload_data['file_name'];
                    $this->load->library('csvimport');
                    if ($this->csvimport->get_array($file)) {
                        $csv_array = $this->csvimport->get_array($file);
                        $data = array();
                        foreach ($csv_array as $key => $rows) {
                            $data[] = array(
                                '1' => $rows['Tanggal'],
                                '2' => $rows['ID Transaksi'],
                                '3' => $rows['Penjual'],
                                '4' => $rows['Pembeli'],
                                '5' => $rows['HP Pembeli'],
                                '6' => $rows['Alamat Pembeli'],
                                '7' => $rows['Kecamatan Pembeli'],
                                '8' => $rows['Kota Pembeli'],
                                '9' => $rows['Propinsi Pembeli'],
                                '10' => $rows['Kode Pos Pembeli'],
                                '11' => $rows['Nama Produk'],
                                '12' => ($rows['Harga Produk'] / $rows['Jumlah Produk']),
                                '13' => $rows['Biaya Pengiriman'],
                                '14' => $rows['Biaya Asuransi'],
                                '15' => $rows['Biaya Pelayanan'],
                                '16' => $rows['Voucher'],
                                '17' => $rows['Kode Pembayaran'],
                                '18' => ($rows['Harga Produk'] / $rows['Jumlah Produk']) * $rows['Jumlah Produk'] + $rows['Biaya Pengiriman'] + $rows['Biaya Asuransi'] + $rows['Biaya Pelayanan'] + $rows['Kode Pembayaran'] - abs($rows['Voucher']), //$rows['Total Terbayar'],
                                '19' => $rows['Jumlah Produk'],
                                '20' => $rows['Kurir'],
                                '21' => $rows['Kode Tracking'],
                                '22' => $rows['Status'],
                                '23' => $rows['Metode Pembayaran'],
                                '24' => "",
                            );
                        }
                        $output = array(
                            "situs" => $situs,
                            "data" => $data,
                        );
                        echo json_encode($output); ///tinggal save aja ke database
                    }
                }
            }
        } else {
            echo 'Masukan File Excel';
        }
    }

    function save_pembelian() {
        // error_reporting(0);
        $situs_1 = $this->input->post('sltsitus');
        $field_1 = $this->input->post('field1');
        $field_2 = $this->input->post('field2');
        $field_3 = $this->input->post('field3');
        $field_4 = $this->input->post('field4');
        $field_5 = $this->input->post('field5');
        $field_6 = $this->input->post('field6');
        $field_7 = $this->input->post('field7');
        $field_8 = $this->input->post('field8');
        $field_9 = $this->input->post('field9');
        $field_10 = $this->input->post('field10');
        $field_11 = $this->input->post('field11');
        $field_12 = $this->input->post('field12');
        $field_13 = $this->input->post('field13');
        $field_14 = $this->input->post('field14');
        $field_15 = $this->input->post('field15');
        $field_16 = $this->input->post('field16');
        $field_17 = $this->input->post('field17');
        $field_18 = $this->input->post('field18');
        $field_19 = $this->input->post('field19');
        $field_20 = $this->input->post('field20');
        $field_21 = $this->input->post('field21');
        $field_22 = $this->input->post('field22');
        $field_23 = $this->input->post('field23');
        $field_24 = $this->input->post('field24');

        for ($i = 0; $i < count(array_unique($field_2)); $i++) {
            $data = array('CategoryId' => $situs_1,
                'Tanggal' => $field_1[$i],
                'IDTransaksi' => $field_2[$i],
                'Penjual' => $field_3[$i],
                'Pembeli' => $field_4[$i],
                'HPPembeli' => $field_5[$i],
                'AlamatPembeli' => $field_6[$i],
                'KecamatanPembeli' => $field_7[$i],
                'KotaPembeli' => $field_8[$i],
                'PropinsiPembeli' => $field_9[$i],
                'KodePosPembeli' => $field_10[$i],
                'BiayaPengiriman' => $field_13[$i],
                'BiayaAsuransi' => $field_14[$i],
                'BiayaPelayanan' => $field_15[$i],
                'Voucher' => $field_16[$i],
                'KodePembayaran' => $field_17[$i],
                'TotalTerbayar' => $field_18[$i],
                'Kurir' => $field_20[$i],
                'KodeTracking' => $field_21[$i],
                'Status' => $field_22[$i],
                'MetodePembayaran' => $field_23[$i],
                'UpdateDate' => date('Y-m-d H:i:s'),
                'UpdateUser' => $this->session->userdata("username_gpcomp"),
                'Keterangan' => $field_24[$i],
            );

            $this->db->replace('pembelian_header', $data);
        }
        //echo $field_2;
        for ($i = 0; $i < count($field_2); $i++) {
            $data_detail = array('IDTransaksi' => $field_2[$i],
                'NamaProduk' => $field_11[$i],
                'HargaProduk' => $field_12[$i],
                'JumlahProduk' => $field_19[$i],
                'UpdateDate' => date('Y-m-d H:i:s'),
                'UpdateUser' => $this->session->userdata("username_gpcomp")
            );
            $this->db->replace('pembelian_detail', $data_detail);
        }

        redirect('transaksi/pembelian');
    }

    public function ajax_edit($id) {
        $data = $this->pembelian->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'CategoryName' => strtoupper($this->input->post('pembelianName')),
            'Status' => $this->input->post('status'),
            'AddDate' => date('Y-m-d'),
            'AddUser' => $UserId,
        );
        $insert = $this->pembelian->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'CategoryName' => strtoupper($this->input->post('pembelianName')),
            'Status' => $this->input->post('status'),
            'EditDate' => date('Y-m-d'),
            'EditUser' => $UserId,
        );
        $this->pembelian->update(array('CategoryId' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->pembelian->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('pembelianName') == '') {
            $data['inputerror'][] = 'pembelianName';
            $data['error_string'][] = 'Pairs Name is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
