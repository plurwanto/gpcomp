<?php
class Produk extends CI_Controller {

    var $table = 'produk';
    
    public function __construct() {
        parent::__construct();
        $this->load->model('master/global_master_model', 'globalmastermodel');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $data['content'] = 'master/produk/view_produk';
        $this->load->view('tampilan_home', $data);
    }

    public function ajax_list() {
        $list = $this->globalmastermodel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $status = ($produk->Status == 'Y' ? '<span class="label label-sm label-success">Active</span>' : '<span class="label label-sm label-danger">Not Active</span>');
            $row = array();
            $row[] = $produk->NamaProduk;
            $row[] = number_format($produk->HargaBeliProduk, 0, ',', '.');
            $row[] = number_format($produk->HargaJualProduk, 0, ',', '.');
            $row[] = date("d-m-Y",strtotime($produk->MulaiJual));
            $row[] = date("d-m-Y H:i:s",strtotime($produk->LastUpdate));
            $row[] = $status;

            $row[] = '<div class="action-buttons"><a class="green" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $produk->id . "'" . ')"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                  <a class="red" href="javascript:void(0)" title="Delete" onclick="delete_data(' . "'" . $produk->id . "'" . ')"><i class="ace-icon fa fa-trash bigger-130"></i></a></div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->globalmastermodel->count_all(),
            "recordsFiltered" => $this->globalmastermodel->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->globalmastermodel->get_produk_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $mylib = new Globallib();
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'NamaProduk' => $this->input->post('produkName'),
            'HargaBeliProduk' => $this->input->post('hargaBeli'),
            'HargaJualProduk' => $this->input->post('hargaJual'),
            'MulaiJual' => $mylib->ubah_tanggal($this->input->post('mulaijual')),
            'Status' => $this->input->post('status'),
            'LastUpdate' => date('Y-m-d H:i:s'),
            'UpdateBy' => $UserId,
        );
        $insert = $this->globalmastermodel->save($this->table, $data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $mylib = new Globallib();
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'NamaProduk' => $this->input->post('produkName'),
            'HargaBeliProduk' => $this->input->post('hargaBeli'),
            'HargaJualProduk' => $this->input->post('hargaJual'),
            'MulaiJual' => $mylib->ubah_tanggal($this->input->post('mulaijual')),
            'Status' => $this->input->post('status'),
            'LastUpdate' => date('Y-m-d H:i:s'),
            'UpdateBy' => $UserId,
        );
        $this->globalmastermodel->update($this->table, array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->globalmastermodel->delete_by_id($this->table, $id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('produkName') == '') {
            $data['inputerror'][] = 'produkName';
            $data['error_string'][] = 'Nama Produk is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('hargaBeli') == '') {
            $data['inputerror'][] = 'hargaBeli';
            $data['error_string'][] = 'Harga Beli is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('hargaJual') == '') {
            $data['inputerror'][] = 'hargaJual';
            $data['error_string'][] = 'Harga Jual is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
