<?php
class My404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->output->set_status_header('404');
        $data['content'] = 'errors/html/my404';
        $this->load->view('tampilan_full_page', $data); //loading in custom error view
    }

}
