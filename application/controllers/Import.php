<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->helper(array('url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->library('csvimport');
    }

    public function index() {
        $data['content'] = 'view_import';
        $this->load->view('tampilan_home', $data);
    }

    function importcsv() {
        $data['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();

            $this->load->view('view_import', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                $data = array();
                foreach ($csv_array as $rows) {
                    $row = array();
                    $row['firstname'] = $rows['firstname'];
                    
                    //$this->csv_model->insert_csv($insert_data);
                   // $data['result'] = $insert_data;
                    $data = $row;
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url() . 'csv');
                //echo "<pre>"; print_r($insert_data);
            } else
                $data['error'] = "Error occured";
            // $this->load->view('view_import', $data);
            echo json_encode($data);
            unlink($file_path);
        }
    }

}
