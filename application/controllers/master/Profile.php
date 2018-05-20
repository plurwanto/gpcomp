<?php
class Profile extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('master/profile_model');
        if (empty($this->session->userdata("username_gpcomp"))) {
            redirect('login');
        }
    }

    function index() {
        $id = $this->session->userdata("id_gpcomp");
        $data['user_profile'] = $this->profile_model->getProfileById($id);
        $data['content'] = 'master/profile/view_profile';
        $this->load->view('tampilan_home', $data);
    }

    public function ajax_list() {
        $list = $this->profile_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users_bank) {
            $no++;
            $status = ($users_bank->Status == 'Y' ? '<span class="label label-sm label-success">Active</span>' : '<span class="label label-sm label-danger">Not Active</span>');
            $row = array();
            $row[] = $users_bank->BankName;
            $row[] = $users_bank->FullName;
            $row[] = $users_bank->RekNumber;
            $row[] = $status;

            $row[] = '<a class="btn btn-transparent btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_bank(' . "'" . $users_bank->UserId . "/" . $users_bank->BankId . "/" . $users_bank->RekNumber . "'" . ')"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-transparent btn-xs" href="javascript:void(0)" title="Delete" onclick="delete_bank(' . "'" . $users_bank->UserId . "/" . $users_bank->BankId . "/" . $users_bank->RekNumber . "'" . ')"><i class="fa fa-times fa fa-white"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->profile_model->count_all(),
            "recordsFiltered" => $this->profile_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id, $bankId, $rekNumb) {
        $data = $this->profile_model->getBankById($id, $bankId, $rekNumb);
        echo json_encode($data);
    }

    public function ajax_add() {
        $UserId = $this->session->userdata("id_gpcomp");
        $bankId = $this->input->post('bankName');
        $rekNumb = $this->input->post('rekNumber');
        $rekName = $this->input->post('rekName');
        $status = $this->input->post('status');
        $this->_validate();
        $get_users_bank = $this->profile_model->getBankById($UserId, $bankId, $rekNumb);
        if (empty($get_users_bank)) {
            $data = array(
                'UserId' => $UserId,
                'BankId' => $bankId,
                'RekNumber' => $rekNumb,
                'RekName' => $rekName,
                'Status' => $status,
                'AddDate' => date('Y-m-d'),
            );
            $this->db->insert('users_bank', $data);
        } else {
            $data['inputerror'][] = 'rekNumber';
            $data['error_string'][] = 'Account Number Already Exist..!';
            $data['status'] = FALSE;

            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $UserId = $this->session->userdata("id_gpcomp");
        $bankIdxx = $this->input->post('bankName');
        $rekNumbxx = $this->input->post('rekNumber');
        $id = $this->input->post('id');
        $bankId = $this->input->post('temp_bankName');
        $rekNumb = $this->input->post('temp_rekNumber');
        $status = $this->input->post('status');
        $this->_validate();
        $get_users_bank = $this->profile_model->getBankById($UserId, $bankIdxx, $rekNumbxx);
        if (empty($get_users_bank)) {
            $data = array(
                'BankId' => $this->input->post('bankName'),
                'RekNumber' => $this->input->post('rekNumber'),
                'Status' => $status,
                'EditDate' => date('Y-m-d'),
            );
            $this->db->update('users_bank', $data, array('UserId' => $id, 'BankId' => $bankId, 'RekNumber' => $rekNumb));
        } else {
            $data['inputerror'][] = 'rekNumber';
            $data['error_string'][] = 'Account Number Already Exist..!';
            $data['status'] = FALSE;

            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id, $bankId, $rekNumb) {
        $this->db->delete('users_bank', array('UserId' => $id, 'BankId' => $bankId, 'RekNumber' => $rekNumb));
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('bankName') == '') {
            $data['inputerror'][] = 'bankName';
            $data['error_string'][] = 'Bank Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('rekNumber') == '') {
            $data['inputerror'][] = 'rekNumber';
            $data['error_string'][] = 'Account Number is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    function edit_profile() {
        $id = $this->session->userdata("id_gpcomp");
        $data['user_profile'] = $this->profile_model->getProfileById($id);
        $data['provinsi'] = $this->profile_model->provinsi();
        $data['list_bank'] = $this->profile_model->getListBank();
        $data['content'] = 'master/profile/edit_profile';
        $this->load->view('tampilan_home', $data);
    }

    function get_data_city() {
        $modul = $this->input->post('modul');
        $id = $this->input->post('id');
        if ($modul == "kabupaten") {
            echo $this->profile_model->kabupaten($id);
        }
    }

    function update_personal() {
        $id = $this->session->userdata("id_gpcomp");
        $fname = $this->input->post('fullname');
        $address = strtoupper($this->input->post('address'));
        $provinsi = $this->input->post('provinsi');
        $city = $this->input->post('kabupaten-kota');
        $zipcode = $this->input->post('zipcode');
        $hphone = $this->input->post('home_number');
        $mphone = $this->input->post('mobile_number');
        $wphone = $this->input->post('work_number');
        $fax = $this->input->post('fax');
        $gender = $this->input->post('gender');
        $dd_birth = $this->input->post('dd');
        $mm_birth = $this->input->post('mm');
        $yy_birth = $this->input->post('yyyy');
        $religi = $this->input->post('religion');
        $birth = $yy_birth . "-" . $mm_birth . "-" . $dd_birth;
        $filelama = $this->input->post('img_exist');

        $this->_set_rules_personal();
        $arr_val = array('success' => false, 'messages' => array());
        if ($this->form_validation->run()) {
            if (!empty($_FILES['photo']['name'])) {
                $photo = $_FILES['photo']['name'];
                $nmfile = $id . "_" . $photo;
                $path = './uploads/profile/';
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                //$config['max_width'] = '1024';
                //$config['max_height'] = '768';
                $config['file_name'] = $nmfile;

                $this->load->library('upload', $config);

                $this->upload->do_upload('photo');
                $img = $this->upload->data();
                @unlink($path . $filelama);
                $img_upload = $img['file_name'];

                $data = array(
                    'FullName' => $fname,
                    'HomePhoneNumber' => $hphone,
                    'MobilePhoneNumber' => $mphone,
                    'WorkPhoneNumber' => $wphone,
                    'FaxNumber' => $fax,
                    'Address' => $address,
                    'Province' => $provinsi,
                    'City' => $city,
                    'ZipCode' => $zipcode,
                    'Gender' => $gender,
                    'BirthDay' => $birth,
                    'Religion' => $religi,
                    'Photo' => $img_upload,
                    'EditDate' => date('Y-m-d')
                );
            } else {
                $data = array(
                    'FullName' => $fname,
                    'HomePhoneNumber' => $hphone,
                    'MobilePhoneNumber' => $mphone,
                    'WorkPhoneNumber' => $wphone,
                    'FaxNumber' => $fax,
                    'Address' => $address,
                    'Province' => $provinsi,
                    'City' => $city,
                    'ZipCode' => $zipcode,
                    'Gender' => $gender,
                    'BirthDay' => $birth,
                    'Religion' => $religi,
                    'EditDate' => date('Y-m-d')
                );
            }

            $this->db->update('users_profile', $data, array('UserId' => $id));

            $arr_val = array('success' => true);
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button"><i class="ace-icon fa fa-times"></i></button>'
                    . '<i class="glyphicon glyphicon-ok"></i> Update Succesfully </div>');
            // redirect('master/profile');
        } else {
            foreach ($_POST as $key => $value) {
                $arr_val['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($arr_val);
    }
    
    public function remove_photo($id){
       $id = $this->session->userdata("id_gpcomp");
       $path= './uploads/profile/';
       $rowdel = $this->profile_model->getImageBy($id);
       @unlink($path.$rowdel->Photo);
       
       $data = array('Photo' => '');
 
       $this->db->update('users_profile', $data, array('UserId' => $id));
       
       echo json_encode(array("status" => TRUE));
   }

    function _set_rules_personal() {
        $this->form_validation->set_rules('fullname', 'fullname', 'trim|required');

        $this->form_validation->set_message('required', '* Harus Isi');
        $this->form_validation->set_error_delimiters('<div class="text-danger" rode="alert">', '</div>');
    }

    function change_password() {
        $id = $this->session->userdata("id_gpcomp");
        $newpassword = md5($this->input->post('newpwd'));

        $this->_set_rules_pwd();
        $arr_val = array('success' => false, 'messages' => array());
        if ($this->form_validation->run()) {
            $this->profile_model->updatePassword($id, $newpassword);

            $this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button"><i class="ace-icon fa fa-times"></i></button>'
                    . '<i class="glyphicon glyphicon-ok"></i> Update Password Successfull </div>');
            $arr_val['success'] = true;
        } else {
            foreach ($_POST as $key => $value) {
                $arr_val['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($arr_val);
    }

    function _set_rules_pwd() {
        $this->form_validation->set_rules('oldpwd', 'oldpwd', 'trim|required|callback_pwdlama_check');
        $this->form_validation->set_rules('newpwd', 'newpwd', 'trim|required|min_length[6]');
        // $this->form_validation->set_rules('confpwd', 'confpwd', 'trim|required|min_length[6]|matches[newpwd]|md5');
        $this->form_validation->set_rules('confpwd', 'Password Confirmation', 'trim|required|matches[newpwd]');

        $this->form_validation->set_message('min_length', '* Minimal 6 karakter');
        $this->form_validation->set_message('matches', '* Konfirmasi Password tidak sama');
        $this->form_validation->set_message('required', '* Harus Isi');
        $this->form_validation->set_error_delimiters('<div class="text-danger" rode="alert">', '</div>');
    }

    function pwdlama_check($passwordlama) {
        $userid = $this->session->userdata("id_gpcomp");
        $passwordlama = md5($this->input->post('oldpwd'));
        $dtpwdlama = $this->profile_model->get_userid($userid);
        foreach ($dtpwdlama->result() as $value) {

            $pwd = $value->Password;
            if ($pwd != $passwordlama) {
                $this->form_validation->set_message('pwdlama_check', '* Password Lama Anda Salah');
                return FALSE;
            } else {
                return TRUE;
                $passwordlama = "";
            }
        }
    }

}
