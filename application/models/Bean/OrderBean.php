<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/1/2017
 * Time: 4:18 PM
 */

class OrderBean{

    private $id;
    private $transaction_id;
    private $product_id;
    private $color_id;
    private $size_id;
    private $amount;
    private $status;
    private $created;

    function __construct($id, $transaction_id, $color_id, $product_id, $size_id, $status, $amount, $created){
        $this->amount = $amount;
        $this->color_id = $color_id;
        $this->created = $created;
        $this->id = $id;
        $this->product_id = $product_id;
        $this->size_id = $size_id;
        $this->status = $status;
        $this->transaction_id = $transaction_id;
    }


    /**
     * @return Double
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param Double $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return Int
     */
    public function getColorId()
    {
        return $this->color_id;
    }

    /**
     * @param Int $color_id
     */
    public function setColorId($color_id)
    {
        $this->color_id = $color_id;
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
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param Int $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return Int
     */
    public function getSizeId()
    {
        return $this->size_id;
    }

    /**
     * @param Int $size_id
     */
    public function setSizeId($size_id){
        $this->size_id = $size_id;
    }

    /**
     * @return Int
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @param Int $status
     */
    public function setStatus($status){
        $this->status = $status;
    }

    /**
     * @return Int
     */
    public function getTransactionId(){
        return $this->transaction_id;
    }

    /**
     * @param Int $transaction_id
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }
} 