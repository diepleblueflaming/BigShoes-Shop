<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/31/2017
 * Time: 10:16 PM
 */

class Order_model extends MY_Model{

    var $table = "order";
    var $key = "id";

    public function add($order){
        return $this->create($order);
    }


    /**
     *
     * @return array|bool|void
     */
    public function get_list($input = []){

        $this->db->select("sizes.size, colors.name as color, order.qty, DATE_FORMAT(order.created,'%d-%m-%d') as created,
                                order.amount, order.status,order.id, product.name as product_name,product.image, transaction.name as transaction" );
        $this->db->from("order");
        $this->db->join("transaction","transaction.id = order.transaction_id");
        $this->db->join("product","product.id = order.product_id");
        $this->db->join("colors","colors.id = order.color_id");
        $this->db->join("sizes","sizes.id = order.size_id");
        if(isset($input["like"])){
            $this->db->like($input["like"][0],$input["like"][1],"both");
        }
        return $result = $this->db->get()->result();
    }


    /**
     *  method lay danh sach cac giao dich theo id cua don hang
     */
    public function getOrdersById($id){
        $this->db->select("sizes.size, colors.name as color, order.qty, DATE_FORMAT(order.created,'%d-%m-%d') as created,
                                order.amount, order.status,order.id, product.name as product_name,product.image");
        $this->db->from("order");
        $this->db->join("product","product.id = order.product_id");
        $this->db->join("colors","colors.id = order.color_id");
        $this->db->join("sizes","sizes.id = order.size_id");
        $this->db->where("order.transaction_id = {$id}");
        return $result = $this->db->get()->result();
    }
}