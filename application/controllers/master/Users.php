<?php
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/users_model', 'users');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $data['list_users_levels'] = $this->users->get_userLevel();
        $data['content'] = 'master/users/view_users';
        $this->load->view('tampilan_home', $data);
    }

    public function ajax_list() {
        $list = $this->users->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) {
            $no++;
            $status = ($users->Active == 'Y' ? '<span class="label label-sm label-success">Active</span>' : '<span class="label label-sm label-danger">Not Active</span>');
            $row = array();
            $row[] = $no;
            $row[] = $users->id;
            $row[] = $users->FullName;
            $row[] = $users->Email;
            $row[] = $users->UserLevelName;
            $row[] = $status;

            $row[] = '<a class="btn btn-transparent btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_users(' . "'" . $users->id . "'" . ')"><i class="fa fa-pencil"></i></a>';
                  

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users->count_all(),
            "recordsFiltered" => $this->users->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->users->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $UserId = $this->session->userdata("id_gpcomp");
        $this->_validate();
        $data = array(
            'UserLevel' => $this->input->post('userslevels'),
            'Active' => $this->input->post('status'),
            'AddDate' => date('Y-m-d'),
        );
        $insert = $this->users->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        //$this->_validate();
        $data = array(
            'UserLevel' => $this->input->post('userslevels'),
            'Active' => $this->input->post('status'),
            'EditDate' => date('Y-m-d h:i:s'),
        );
        $this->users->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->users->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('usersName') == '') {
            $data['inputerror'][] = 'usersName';
            $data['error_string'][] = 'UserLevel Name is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
