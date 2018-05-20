<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile_model extends CI_Model {

    var $table = 'bank';
    var $column_order = array('bank.BankName', '', '', '');
    var $column_search = array('bank.BankName', 'users_bank.RekNumber');
    var $order = array('users_bank.AddDate' => 'desc');

    private function _get_datatables_query() {
        //$this->db->from($this->table);
        $this->db->select('users_profile.UserId,users_bank.BankId,bank.BankName, users_profile.FullName, users_bank.RekNumber, users_bank.Status');
        $this->db->from('users_bank');
        $this->db->join('bank', 'bank.BankId = users_bank.BankId', 'left');
        $this->db->join('users_profile', 'users_profile.UserId = users_bank.UserId', 'left');
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function getProfileById($userId) {
        $sql = "SELECT a.*,b.*,c.name AS prov, d.name AS kabupaten FROM users a INNER JOIN users_profile b ON a.id=b.UserId LEFT JOIN provinces c ON b.Province=c.id LEFT JOIN regencies d ON b.City=d.id WHERE b.UserId = '" . $userId . "'";
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getBankById($userId, $bankId, $rekNumb) {
        $this->db->where('UserId', $userId);
        $this->db->where('BankId', $bankId);
        $this->db->where('RekNumber', $rekNumb);
        $query = $this->db->get('users_bank');
        //echo $this->db->last_query();
        return $query->row();
    }

    function provinsi() {
        $this->db->order_by('name', 'ASC');
        $provinces = $this->db->get('provinces');
        return $provinces->result_array();
    }

    function kabupaten($provId) {
        $kabupaten = "<option value='0'>Please Select</pilih>";
        $this->db->order_by('name', 'ASC');
        $kab = $this->db->get_where('regencies', array('province_id' => $provId));

        foreach ($kab->result_array() as $data) {
            $kabupaten .= "<option value='$data[id]'>$data[name]</option>";
        }
        return $kabupaten;
    }

    function get_kabupatenById($provId) {
        $this->db->where('province_id', $provId);
        $query = $this->db->get('regencies');
        return $query->result_array();
    }

    function getListBank() {
        $this->db->where('Status', 'Y');
        $query = $this->db->get('bank');
        return $query->result_array();
    }

    function updatePassword($userid, $password) {
        $datetime = date("Y-m-d H:i:s");
        $this->db->where('Id', $userid);
        $this->db->update('users', array('Password' => $password, "Active" => "Y", "EditDate" => $datetime));
    }
    
    function get_userid($userid) {
        return $this->db->query("SELECT Password FROM users WHERE Id ='$userid'");
    }
    
    function getImageBy($id) {
        $this->db->where('UserId', $id);
        $query = $this->db->get('users_profile');
        return $query->row();
    }

}
