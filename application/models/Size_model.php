<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/26/2017
 * Time: 3:35 PM
 */

require_once "Bean/SizeBean.php";

class Size_model extends MY_Model{
    var $table = "sizes";
    var $key = "id";



    public function getSizesByProductId($id){

        $input = array(
            "where" => array("pcs.product_id" => $id),
            "select" => "sizes.*"
        );

        $this->db->distinct();
        $input['join'] = array("product_color_size pcs","sizes","pcs.size_id = sizes.id");

        $re = $this->get_list($input);
        return convertStdClassToObj($re,"SizeBean");
    }


    public function getListSizeByProductId($id){

        $input = array(
            "where" => array("pcs.product_id" => $id),
            "select" => "sizes.*"
        );

        $this->db->distinct();
        $input['join'] = array("product_color_size pcs","sizes","pcs.size_id = sizes.id");

        return $this->get_list($input);
    }

    public function getSizeById($id){

        return $this->get_info($id);
    }

}