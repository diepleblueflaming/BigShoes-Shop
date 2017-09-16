<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/26/2017
 * Time: 3:34 PM
 */

require_once "Bean/ColorBean.php";

class Color_model extends  MY_Model{
    var $table = "colors";
    var $key = "id";


    public function getColorsByProductId($id){

        $input = array(
            "where" => array("pcs.product_id" => $id),
            "select" => "colors.*"
        );

        $this->db->distinct();

        $input['join'] = array("product_color_size pcs","colors","pcs.color_id = colors.id");

        $re = $this->get_list($input);
        return convertStdClassToObj($re,"ColorBean");
    }

    public  function  getListColorByProductId($id){


        $input = array(
            "where" => array("pcs.product_id" => $id),
            "select" => "colors.*"
        );

        $this->db->distinct();

        $input['join'] = array("product_color_size pcs","colors","pcs.color_id = colors.id");

        return $this->get_list($input);
    }


    public function getColorById($id){

        return $this->get_info($id);
    }
} 