<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session'));
    }

    public function index() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
