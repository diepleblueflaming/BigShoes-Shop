<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/17/2017
 * Time: 5:27 PM
 */

class ColorBean {

    private $id;
    private $name;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
} 