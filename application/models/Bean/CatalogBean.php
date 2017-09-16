<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/14/2017
 * Time: 9:41 AM
 */

class CatalogBean {

    private $id;
    private $title;
    private $parent_id;
    private $position;
    private $status;
    private $site_title;
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
     * @return Int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param Int $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return Int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param Int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return String
     */
    public function getSiteTitle()
    {
        return $this->site_title;
    }

    /**
     * @param String $site_title
     */
    public function setSiteTitle($site_title)
    {
        $this->site_title = $site_title;
    }

    /**
     * @return Int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getCatalogUri(){
        return base_url("product/".convert_vi_to_en($this->getTitle())."-".$this->getId());
    }
}