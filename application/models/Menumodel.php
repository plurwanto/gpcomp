<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menumodel extends CI_Model {

//    function __construct(){
//        parent::Model();
//    }
    private $category = 'menu';

    function get_root($level) {
        //$sql = "select * from menu where root='1' and UserLevelId='$level' order by urutan";
        $sql = "select * from menu where UserLevelId='$level' order by urutan";
        $qry = $this->db->query($sql);
        $row = $qry->result_array();
        $qry->free_result();
        return $row;
    }

    function get_drop_down($level) {
        $sql = "select distinct ulid from menu where ulid!='' and UserLevelId='$level' order by ulid";
        $qry = $this->db->query($sql);
        $row = $qry->result_array();
        $qry->free_result();
        return $row;
    }

    function get_sub_menu($root, $level) {
        $sql = "select * from menu where root='$root' and UserLevelId='$level' order by urutan;";
        $qry = $this->db->query($sql);
        $row = $qry->result_array();
        $qry->free_result();
        return $row;
    }

    public function category_menu() {
        // Select all entries from the menu table
        $query = $this->db->query("select category_id, category_name, category_link,
            parent_id from " . $this->category . " order by parent_id, category_link");

        // Create a multidimensional array to contain a list of items and parents
        $cat = array(
            'items' => array(),
            'parents' => array()
        );
        // Builds the array lists with data from the menu table
        foreach ($query->result() as $cats) {
            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $cat['items'][$cats->category_id] = $cats;
            // Creates entry into parents array. Parents array contains a list of all items with children
            $cat['parents'][$cats->parent_id][] = $cats->category_id;
        }

        if ($cat) {
            $result = $this->build_category_menu(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }

    function build_category_menu($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ul class='main-navigation-menu'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $html .= "<li><a href='" . base_url() . $menu['items'][$itemId]->category_link . "'><i class='clip-home-3'></i><span class='title'>" . $menu['items'][$itemId]->category_name . " </span><span class='selected'></span></a></li>";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<li><a href='javascript:void(0)'><i class='clip-cog-2'></i><span class='title'>" . $menu['items'][$itemId]->category_name . " </span><i class='icon-arrow'></i><span class='selected'></span></a>";
                    $html .= "<ul class='sub-menu'>";
                    $html .= "<li><a href='" . base_url() . $menu['items'][$itemId]->category_link . "'><span class='title'>";
                    //$html .= $menu['items'][$itemId]->category_link;
                    $html .= $this->build_category_menu2($itemId, $menu);
                    $html .= "</span></a>";
                    $html .= "</li>";
                    $html .= "</ul>";
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }

    function build_category_menu2($child, $menu) {
        $html = "";
        if (isset($menu['parents'][$child])) {
            foreach ($menu['parents'][$child] as $itemId) {
                if (isset($menu['parents'][$itemId])) {
            
                    $html .= $this->build_category_menu($itemId, $menu);
            
                }
            }
            
        }
        return $html;
    }

}

?>