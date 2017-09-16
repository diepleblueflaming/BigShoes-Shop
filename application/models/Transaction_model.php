<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/1/2017
 * Time: 10:57 AM
 */

require_once "Bean/TransactionBean.php";

class Transaction_model extends MY_model{

    var $table = "transaction";
    var $key = "id";


    public function add($transaction){
        return $this->create($transaction);
    }
} 