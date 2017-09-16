<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/27/2017
 * Time: 9:16 AM
 */

class Product_Size_Color_model extends MY_Model{
    var $table = "product_color_size";
    var $key = "id";


    public function updateQty($productId, $colorId, $sizeId, $qty){

        $sql = "UPDATE `product_color_size` SET `qty` = `qty` - {$qty}
                WHERE `product_id` = {$productId} AND `color_id` = {$colorId} AND `size_id` = {$sizeId}";

        $this->db->query($sql);
        return ($this->db->affected_rows() > 0);
    }
} 