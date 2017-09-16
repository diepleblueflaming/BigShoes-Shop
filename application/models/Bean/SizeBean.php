<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/17/2017
 * Time: 5:29 PM
 */


class SizeBean {
    private $id;
    private $size;
    private $created;



    public function __construct($obj){

        foreach($obj as $key=>$val){
            $this->{$key} = $val;
        }
    }

    /**
     * @return Date
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param Date $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param String $Size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }       
} 