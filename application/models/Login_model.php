<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {

    function get_user($usr, $pwd) {
        $sql = "SELECT * FROM users WHERE UserName = '" . $usr . "' AND Password = '" . md5($pwd) . "' AND Active = 'Y'";
        $query = $this->db->query($sql);
        return $query->row();
    }

}
