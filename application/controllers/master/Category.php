<?php
class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/category_model', 'category');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $data['content'] = 'master/category/view_category';
        $this->load->view('tampilan_home', $data);
    }

    public function ajax_list() {
        $list = $this->category->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category) {
            $no++;
            $status = ($category->Status == 'Y' ? '<span class="label label-sm label-success">Active</span>' : '<span class="label label-sm label-danger">Not Active</span>');
            $row = array();
            $row[] = $category->CategoryName;
            $row[] = $status;

            $row[] = '<div class="action-buttons"><a class="green" href="javascript:void(0)" title="Edit" onclick="edit_category(' . "'" . $category->CategoryId . "'" . ')"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                  <a class="red" href="javascript:void(0)" title="Delete" onclick="delete_category(' . "'" . $category->CategoryId . "'" . ')"><i class="ace-icon fa fa-trash bigger-130"></i></a></div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->category->count_all(),
            "recordsFiltered" => $this->category->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->category->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'CategoryName' => strtoupper($this->input->post('categoryName')),
            'Status' => $this->input->post('status'),
            'AddDate' => date('Y-m-d'),
            'AddUser' => $UserId,
        );
        $insert = $this->category->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'CategoryName' => strtoupper($this->input->post('categoryName')),
            'Status' => $this->input->post('status'),
            'EditDate' => date('Y-m-d'),
            'EditUser' => $UserId,
        );
        $this->category->update(array('CategoryId' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->category->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('categoryName') == '') {
            $data['inputerror'][] = 'categoryName';
            $data['error_string'][] = 'Pairs Name is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
