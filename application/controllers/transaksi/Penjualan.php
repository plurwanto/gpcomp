<?php
class Penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('transaksi/penjualan_model', 'penjualan');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $data['list_kategory'] = $this->penjualan->getKategory();
        $data['content'] = 'transaksi/penjualan/view_penjualan';
        $this->load->view('tampilan_home', $data);
    }

    public function ajax_list() {
        $myLib = new Globallib();
        $list = $this->penjualan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $penjualan) {
            $no++;
            // $status = ($penjualan->Status == 'Y' ? '<span class="label label-sm label-success">Active</span>' : '<span class="label label-sm label-danger">Not Active</span>');
            $row = array();
            $row[] = $penjualan->Tanggal;
            $row[] = $penjualan->KdTransaksi;
            $row[] = $penjualan->Pembeli;
            $row[] = $penjualan->NamaProduk;
            $row[] = number_format($penjualan->HargaProduk, 0, ',', '.');
            $row[] = $penjualan->JumlahProduk;
            $row[] = number_format($penjualan->HargaProduk * $penjualan->JumlahProduk, 0, ',', '.');

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->penjualan->count_all(),
            "recordsFiltered" => $this->penjualan->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function upload_file() {
        //error_reporting(0);
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
                        if ($situs == "BL") { // from bukalapak
                            foreach ($csv_array as $key => $rows) {
                                $data[] = array(
                                    '1' => $rows['Tanggal'],
                                    '2' => $rows['ID Transaksi'],
                                    '3' => $rows['Transaksi Dropshipper'],
                                    '4' => $rows['Nama Dropshipper'],
                                    '5' => $rows['Detail Dropshipper'],
                                    '6' => $rows['Penjual'],
                                    '7' => $rows['Pembeli'],
                                    '8' => $rows['HP Pembeli'],
                                    '9' => $rows['Alamat Pembeli'],
                                    '10' => $rows['Kecamatan Pembeli'],
                                    '11' => $rows['Kota Pembeli'],
                                    '12' => $rows['Propinsi Pembeli'],
                                    '13' => $rows['Kode Pos Pembeli'],
                                    '14' => $rows['Nama Produk'],
                                    '15' => ($rows['Harga Produk'] / $rows['Jumlah Produk']),
                                    '16' => $rows['Biaya Pengiriman'],
                                    '17' => $rows['Biaya Asuransi'],
                                    '18' => $rows['Total Terbayar'], //($rows['Harga Produk'] / $rows['Jumlah Produk']) * $rows['Jumlah Produk'] + $rows['Biaya Pengiriman'] + $rows['Biaya Asuransi'], //$rows['Total Terbayar'],
                                    '19' => $rows['Jumlah Produk'],
                                    '20' => $rows['Kurir'],
                                    '21' => $rows['Kode Tracking'],
                                    '22' => $rows['Status'],
                                );
                            }
                        } elseif ($situs == "TP" || $situs == "LZ") {
                            foreach ($csv_array as $key => $rows) {
                                $alamat = explode(",", $rows['Recipient Address']);
                                $almt = explode("\n", $alamat[0]);

                                $data[] = array(
                                    '1' => $rows['Payment Date'],
                                    '2' => trim($rows['Invoice']),
                                    '3' => trim($rows['Recipient']),
                                    '4' => trim($rows['Product Name']),
                                    '5' => preg_replace("/[^0-9]/", "", $rows['Price (Rp.)']),
                                    '6' => $rows['Quantity'],
                                    '7' => '',
                                    '8' => '',
                                    '9' => '',
                                    '10' => 'GP Comp',
                                    '11' => $rows['Recipient Number'],
                                    '12' => trim($almt[0]), //substr($alamat[0], 0, 100),
                                    '13' => trim($almt[0]), //kecamatan
                                    '14' => trim(substr($alamat[1], 0, 50)), // kota/kab
                                    '15' => trim(preg_replace("/[0-9]+/", "", $alamat[2])), //provinsi
                                    '16' => trim(preg_replace("/[^0-9]/", "", $alamat[2])), //kode pos
                                    '17' => preg_replace("/[^0-9]/", "", $rows['Shipping Price + fee (Rp.)']),
                                    '18' => preg_replace("/[^0-9]/", "", $rows['Insurance (Rp.)']),
                                    '19' => preg_replace("/[^0-9]/", "", $rows['Total Amount (Rp.)']), //($rows['Harga Produk'] / $rows['Jumlah Produk']) * $rows['Jumlah Produk'] + $rows['Biaya Pengiriman'] + $rows['Biaya Asuransi'], //$rows['Total Terbayar'],
                                    '20' => $rows['Courier'],
                                    '21' => $rows['AWB'],
                                    '22' => $rows['Order Status'],
                                    '23' => $rows['Stock Keeping Unit (SKU)'],
                                );
                            }
                        }
                        $output = array(
                            "situs" => $situs,
                            "data" => $data,
                        );
                        echo json_encode($output); ///tinggal save aja ke database
                    }
                    unlink($file);//remove file from upload directory
                }
            }
        } else {
            echo 'Masukan File Excel';
        }
    }

    function save_penjualan() {
        //error_reporting(0);
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

        for ($i = 0; $i < count($field_2); $i++) {
            $data = array('CategoryId' => $situs_1,
                'Tanggal' => date("Y-m-d H:i:s", strtotime($field_1[$i])),
                'IDTransaksi' => $field_2[$i],
                'TransaksiDropshipper' => $field_3[$i],
                'NamaDropshipper' => $field_4[$i],
                'DetailDropshipper' => $field_5[$i],
                'Penjual' => $field_6[$i],
                'Pembeli' => $field_7[$i],
                'HPPembeli' => $field_8[$i],
                'AlamatPembeli' => $field_9[$i],
                'KecamatanPembeli' => $field_10[$i],
                'KotaPembeli' => $field_11[$i],
                'PropinsiPembeli' => $field_12[$i],
                'KodePosPembeli' => $field_13[$i],
                'BiayaPengiriman' => $field_16[$i],
                'BiayaAsuransi' => $field_17[$i],
                'TotalTerbayar' => $field_18[$i],
                'Kurir' => $field_20[$i],
                'KodeTracking' => $field_21[$i],
                'Status' => $field_22[$i],
                'UpdateDate' => date('Y-m-d H:i:s'),
                'UpdateUser' => $this->session->userdata("username_gpcomp")
            );
//            echo "<pre>";
//            print_r($data);
//            echo "</pre>";
            $this->db->replace('penjualan_header', $data); //array_merge($data, $editDate));
        }

        for ($i = 0; $i < count($field_2); $i++) {
            if ($situs_1 == "BL") {
                $list_hargaBeli = $this->penjualan->get_hargaBeliByName($field_14[$i]);
                $nmProduk = $field_14[$i];
            } elseif ($situs_1 == "TP" || $situs_1 == "LZ") {
                $list_hargaBeli = $this->penjualan->get_hargaBeliByID($field_23[$i]);
                $nmProduk = $list_hargaBeli[0]['NamaProduk'];
            }
            $data_detail = array('IDTransaksi' => $field_2[$i],
                'NamaProduk' => $nmProduk,
                'HargaBeli' => $list_hargaBeli[0]['HargaBeliProduk'],
                'HargaProduk' => $field_15[$i],
                'JumlahProduk' => $field_19[$i],
                'UpdateDate' => date('Y-m-d H:i:s'),
                'UpdateUser' => $this->session->userdata("username_gpcomp"),
                    //  'No' => $i
            );

            $this->db->replace('penjualan_detail', $data_detail);
//            foreach ($field_2 as $key => $val) {
//                unset($field_2[$key]);
//                if (in_array($val, $field_2)) {
//                    if (!empty($val)) {
//                        $this->db->update('penjualan_header', array('TotalTerbayar' => ), array('IDTransaksi' => $val));
//                    }
//                }
//            }
        }
        redirect('transaksi/penjualan');
    }

    public function ajax_edit($id) {
        $data = $this->penjualan->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'CategoryName' => strtoupper($this->input->post('penjualanName')),
            'Status' => $this->input->post('status'),
            'AddDate' => date('Y-m-d'),
            'AddUser' => $UserId,
        );
        $insert = $this->penjualan->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'CategoryName' => strtoupper($this->input->post('penjualanName')),
            'Status' => $this->input->post('status'),
            'EditDate' => date('Y-m-d'),
            'EditUser' => $UserId,
        );
        $this->penjualan->update(array('CategoryId' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->penjualan->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('penjualanName') == '') {
            $data['inputerror'][] = 'penjualanName';
            $data['error_string'][] = 'Pairs Name is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
