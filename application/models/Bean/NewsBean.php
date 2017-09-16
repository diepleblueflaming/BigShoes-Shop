<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/14/2017
 * Time: 6:23 PM
 */

class NewsBean {

    private $id;
    private $title;
    private $summary_content;
    private $content;
    private $created;
    private $image_link;
    private $admin_post_id;

    /**
     * @return Int
     */
    public function getAdminPostId()
    {
        return $this->admin_post_id;
    }

    /**
     * @param Int $admin_post_id
     */
    public function setAdminPostId($admin_post_id)
    {
        $this->admin_post_id = $admin_post_id;
    }

    /**
     * @return String
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
    public function getImageLink()
    {
        return $this->image_link;
    }

    /**
     * @param String $image_link
     */
    public function setImageLink($image_link)
    {
        $this->image_link = $image_link;
    }

    /**
     * @return String
     */
    public function getSummaryContent()
    {
        return $this->summary_content;
    }

    /**
     * @param String $summary_content
     */
    public function setSummaryContent($summary_content)
    {
        $this->summary_content = $summary_content;
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


    public function __construct($obj){

        foreach($obj as $val=>$key){
            $this->{$val} = $key;
        }
    }

    public function getImageUri(){
        return base_url("upload/news/images/".$this->getImageLink());
    }

    public function getNewsUri(){
        return base_url(convert_vi_to_en("news/".$this->getTitle())."-n".$this->id.".html");
    }
} 