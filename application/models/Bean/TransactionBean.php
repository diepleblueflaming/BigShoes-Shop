<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/1/2017
 * Time: 10:47 AM
 */

class TransactionBean {

    private $id;
    private $user_id;
    private $name;
    private $email;
    private $phone;
    private $payment;
    private $payment_info;
    private $receive;
    private $message;
    private $amount;
    private $status;
    private $type;
    private $created;

    function __construct($id, $name, $email, $phone, $message, $payment, $payment_info, $receive, $amount, $status, $type, $user_id, $created){
        $this->amount = $amount;
        $this->email = $email;
        $this->id = $id;
        $this->message = $message;
        $this->name = $name;
        $this->payment = $payment;
        $this->payment_info = $payment_info;
        $this->phone = $phone;
        $this->receive = $receive;
        $this->status = $status;
        $this->type = $type;
        $this->user_id = $user_id;
        $this->created = $created;
    }


    /**
     * @return double
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param double $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param String $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
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

    /**
     * @return String
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param String $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return String
     */
    public function getPaymentInfo()
    {
        return $this->payment_info;
    }

    /**
     * @param String $payment_info
     */
    public function setPaymentInfo($payment_info)
    {
        $this->payment_info = $payment_info;
    }

    /**
     * @return Int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed Int
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return String
     */
    public function getReceive()
    {
        return $this->receive;
    }

    /**
     * @param String $receive
     */
    public function setReceive($receive)
    {
        $this->receive = $receive;
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
     * @return Int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param Int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return String
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param String $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @param Int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }




} 