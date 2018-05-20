<?php
class globallib {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
       // $this->CI->load->model('globalmodel');
    }

    function getAllowList($sign) {
        $segs = $this->CI->uri->segment_array();
        $session_level = $this->CI->session->userdata('userlevel');
        $arr = "index.php/" . $segs[1] . "/" . $segs[2] . "/";
        $allowed = $this->CI->globalmodel->getPermission($arr, $session_level);
        //print_r($allowed);
        if ($session_level == "") {
            $reaction = "T";
        } else {
            if ($sign == "all") {
                if ($allowed->view == "Y" || $allowed->add == "Y" || $allowed->edit == "Y" || $allowed->delete == "Y") {
                    $reaction = "Y";
                } else {
                    $reaction = "T";
                }
            }
            if ($sign == "view") {
                $reaction = $allowed->view;
            }
            if ($sign == "add") {
                $reaction = $allowed->add;
            }
            if ($sign == "del") {
                $reaction = $allowed->delete;
            }
            if ($sign == "edit") {
                $reaction = $allowed->edit;
            }
        }

        return $reaction;
    }

    function getUser() {
        $u = $this->CI->session->userdata('username');
        return $u;
    }
    
    function getUserById() {
        $u = $this->CI->session->userdata('userId');
        return $u;
    }

    function restrictLink($str) {
        $session_level = $this->CI->session->userdata('userlevel');
        $allowed = $this->CI->globalmodel->getPermission($str, $session_level);
        return $allowed;
    }

    function write_header($str) {
        for ($a = 0; $a < count($str); $a++) {
            echo "<th nowrap>$str[$a]</th>";
        }
    }

    function ubah_format($harga) {
        $s = number_format($harga, 2, ',', '.');
        return $s;
    }

    function ubah_format_awal($harga) {
        $s = explode(".", $harga);
        $k = implode($s, "");
        $k = explode(",", $k);
        $s = implode($k, ".");
        return $s;
    }

    function ubah_tanggal($tanggalan) {
        list ($tanggal, $bulan, $tahun) = explode("-", $tanggalan);
        $tgl = $tahun . "-" . $bulan . "-" . $tanggal;
        return $tgl;
    }

    function ubah_format_tanggal($tanggalan) {
        list ($tahun, $bulan, $tanggal) = explode("-", $tanggalan);
        $tgl = $tanggal . "-" . $bulan . "-" . $tahun;
        return $tgl;
    }

    function print_track() {
        $segs = $this->CI->uri->segment_array();
        if (count($segs) >= 2) {
            $arr = "index.php/" . $segs[1] . "/" . $segs[2] . "/";
            return $this->findRoot($arr);
        }
    }

    function findRoot($url) {
        $first = $this->CI->globalmodel->getName($url);
        if (substr($first->root, 0, 9) != "ddsubmenu") {
            $string = $first->root . " > " . $first->nama;
            $second = $this->CI->globalmodel->getName2($first->root);
            if (substr($second->root, 0, 9) == "ddsubmenu") {
                $fourth = $this->CI->globalmodel->getRoot($second->root);
                $string = $fourth->nama . " > " . $string;
            }
        } else {
            $string = $first->nama;
            $fourth = $this->CI->globalmodel->getRoot($first->root);
            $string = $fourth->nama . " > " . $string;
        }
        return $string;
    }

    function standard_date($tgl, $jam) {
        $tgl = 'DATE_RFC822';
        $jam = time();
    }

    function bulan($bln) {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

}
?>