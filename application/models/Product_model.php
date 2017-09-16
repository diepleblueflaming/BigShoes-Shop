<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/20/2017
 * Time: 10:30 PM
 */
require_once 'Bean/ProductBean.php';

class Product_model extends MY_Model{

    var $table = "product";
    var $key = "id";

    /**
     *  ham lay ra danh sach cac san pham mua nhieu nhat
     * @return array
     */

    public  function getPopularProducts(){

        $input = array(
            "order" => array(PRODUCT_BOUGHT,"DESC"),
            "limit" => array(4,0)
        );

        $result = $this->get_list($input);

        return convertStdClassToObj($result,"ProductBean");
    }


    /**
     *  lay ra 5 san pham moi nhat
     *  @return array
     */

    public  function getNewProducts(){

        $input = array(
            "order" => array(PRODUCT_DATE_CREATE,"DESC"),
            "limit" => array(4,0)
        );

        $result = $this->get_list($input);

        return convertStdClassToObj($result,"ProductBean");
    }


    /**
     * @param $name
     * @param int $limit
     * @return array
     */
    public function getProductsByCategoryName($name,$limit = 0){

        $input = array(
            "where" => array("catalog.title",$name)
        );

        $input['join'] = array('product','catalog','product.catalog_id = catalog.id');

        if($limit){
            $input['limit'] = array($limit,0);
        }

        $result = $this->get_list($input);
        return convertStdClassToObj($result,"ProductBean");
    }


    /**
     * @param $id
     * @param array $input
     * @return array
     */
    public function getProductsByCategoryId($id,$input = array()){

        $order_by ="product.created";

        if($input){

            $order_by = isset($input['order']) && $input['order'] ? "product.".$input["order"] : $order_by;
        }

        // neu co truyen vao where.
        $where = isset($input['where']) && $input['where'] ? "AND ".$input['where'] : "";

        $query = "SELECT product.* FROM product WHERE (catalog_id IN
                  (SELECT c.id FROM catalog c JOIN catalog cat
                      ON cat.id = c.parent_id AND cat.id = {$id})
                  OR catalog_id = {$id}) {$where} ORDER BY {$order_by} DESC LIMIT 0,5";

        //echo ($query);

        $result = $this->query($query);
        return convertStdClassToObj($result,"ProductBean");
    }

    /**
     * @param $id
     * @return ProductBean
     */
    public function getProductById($id){
        $p = $this->product_model->get_info($id);

        if(!$p){return false;}
        return new ProductBean($p);
    }

    /**
     * Ham tim kiem san pham
     * @param $p_name
     * @return array
     */
    public function searchProduct($input){
        return convertStdClassToObj($this->get_list($input),"ProductBean");
    }
} 