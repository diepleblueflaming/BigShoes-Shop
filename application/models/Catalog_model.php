<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/10/2017
 * Time: 10:11 AM
 */

require_once 'Bean/CatalogBean.php';

class Catalog_model extends MY_Model{
    var $table = 'catalog';
    var $key = 'id';


    /**
     * @return array|bool
     */
    public function getCategories(){

        // mang cac chuyen muc cha.
        $input = array(
            "where" => array("parent_id" => 0)
        );

        $parentCat = $this->get_list($input);
        $parentCat = convertStdClassToObj($parentCat,"CatalogBean");
        foreach($parentCat as &$it){
            $param = array(
                "where" => array("parent_id" => $it->getId())
            );

            $subCat = $this->get_list($param);
            $subCat = convertStdClassToObj($subCat,"CatalogBean");
            $it->sub = $subCat;
        }
        uasort($parentCat,"sort_arr");
        return $parentCat;
    }



    /**
     * @param $id
     * @return CatalogBean
     */
    public function getCatalogById($id){

        $input = array(
            "where" => array("id" => $id)
        );

        $re = $this->get_row($input);

        $cat  = new CatalogBean($re);
        return $cat;
    }
} 