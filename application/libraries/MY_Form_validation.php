<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/4/2017
 * Time: 8:11 AM
 */

class MY_Form_validation extends CI_Form_validation{

    public function error_array(){
        return $this->_error_array;
    }
} 