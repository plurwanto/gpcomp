<?php
class Userslevels extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/userslevels_model', 'userslevels');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $data['content'] = 'master/userslevels/view_userslevels';
        $this->load->view('tampilan_home', $data);
    }

    public function ajax_list() {
        $list = $this->userslevels->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $userslevels) {
            $no++;
            $status = ($userslevels->Status == 'Y' ? '<span class="label label-sm label-success">Active</span>' : '<span class="label label-sm label-danger">Not Active</span>');
            $row = array();
            $row[] = $userslevels->UserLevelName;
            $row[] = $status;

            $row[] = '<a class="btn btn-transparent btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_userslevels(' . "'" . $userslevels->UserLevelID . "'" . ')"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-transparent btn-xs" href="javascript:void(0)" title="Delete" onclick="delete_userslevels(' . "'" . $userslevels->UserLevelID . "'" . ')"><i class="fa fa-times fa fa-white"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->userslevels->count_all(),
            "recordsFiltered" => $this->userslevels->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->userslevels->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'UserLevelName' => strtoupper($this->input->post('userslevelsName')),
            'Status' => $this->input->post('status'),
            'AddDate' => date('Y-m-d'),
            'AddUser' => $UserId,
        );
        $insert = $this->userslevels->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'UserLevelName' => strtoupper($this->input->post('userslevelsName')),
            'Status' => $this->input->post('status'),
            'EditDate' => date('Y-m-d'),
            'EditUser' => $UserId,
        );
        $this->userslevels->update(array('UserLevelID' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->userslevels->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('userslevelsName') == '') {
            $data['inputerror'][] = 'userslevelsName';
            $data['error_string'][] = 'UserLevel Name is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
