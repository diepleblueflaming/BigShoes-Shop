<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/11/2017
 * Time: 6:05 PM
 */

class ProductBean {

    // id of product
    private  $id;

    // category id of product
    private $catalog_id;

    // Product Name
    private $name;

    // Product Price
    private $price;

    // Product Discount
    private $discount;

    // Product Description.
    private $description;

    // Product Main Image
    private $image;

    // Product image
    private $image_list;

    // So luong san pham da mua
    private $bought;

    // Tieu de seo tren wbsite
    private $site_title;

    // Date_Of_Create
    private $created;

    // Total Rate
    private $rate_total;

    // Quantity Rate
    private $rate_count;

    // status
    private $status;

    // warranty
    private $warranty;


    public function __construct($obj){

        foreach($obj as $val=>$key){
           $this->{$val} = $key;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getBought()
    {
        return $this->bought;
    }

    /**
     * @param int $bought
     */
    public function setBought($bought)
    {
        $this->bought = $bought;
    }

    /**
     * @return int
     */
    public function getCatalogId()
    {
        return $this->catalog_id;
    }

    /**
     * @param int $catalog_id
     */
    public function setCatalogId($catalog_id)
    {
        $this->catalog_id = $catalog_id;
    }

    /**
     * @return date
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param date $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param int $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param double $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getRateCount()
    {
        return $this->rate_count;
    }

    /**
     * @param int $rate_count
     */
    public function setRateCount($rate_count)
    {
        $this->rate_count = $rate_count;
    }

    /**
     * @return int
     */
    public function getRateTotal()
    {
        return $this->rate_total;
    }

    /**
     * @param int $rate_total
     */
    public function setRateTotal($rate_total)
    {
        $this->rate_total = $rate_total;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return String
     */
    public function getImageList()
    {
        return $this->image_list;
    }

    /**
     * @param String $image_list
     */
    public function setImageList($image_list)
    {
        $this->image_list = $image_list;
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
     * @return String
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * @param String $warranty
     */
    public function setWarranty($warranty)
    {
        $this->warranty = $warranty;
    }


    function getSpecialPrice(){

        if(!$this->discount){
            return 0;
        }else{
            $specialPrice = $this->price * (1- ( 0.01 *($this->discount) ) );
            return $specialPrice;
        }
    }


    function getProductUri(){
        return base_url("product/.".convert_vi_to_en($this->getName())."-p".$this->getId()).".html";
    }

} 