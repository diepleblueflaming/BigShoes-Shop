<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/12/2017
 * Time: 3:02 PM
 */

class User_model extends  MY_Model{
    var $table  = "user";
    var $key = "id";

    public function getUserBy($where, $fields = ''){
        if($fields)
        {
            $this->db->select($fields);
        }
        $this->db->or_where($where);
        $query = $this->db->get("user");
        if ($query->num_rows())
        {
            return $query->row();
        }

        return FALSE;
    }
} 
