<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/25/2017
 * Time: 9:38 PM
 */

class CommentBean {

    private $id;
    private $question_id;
    private $product_id;
    private $content;
    private $created;
    private $member_comment_id;
    private $user_comment;
    private $admin_comment_id;

    /**
     * @return Int
     */
    public function getAdminCommentId()
    {
        return $this->admin_comment_id;
    }

    /**
     * @param Int $admin_comment_id
     */
    public function setAdminCommentId($admin_comment_id)
    {
        $this->admin_comment_id = $admin_comment_id;
    }


    public function __construct($obj){

        foreach($obj as $key=>$val){
            $this->{$key} = $val;
        }
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
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param datetime $created
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
    public function getMemberCommentId()
    {
        return $this->member_comment_id;
    }

    /**
     * @param Int $member_comment_id
     */
    public function setMemberCommentId($member_comment_id)
    {
        $this->member_comment_id = $member_comment_id;
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
    public function getQuestionId()
    {
        return $this->question_id;
    }

    /**
     * @param Int $question_id
     */
    public function setQuestionId($question_id)
    {
        $this->question_id = $question_id;
    }

    /**
     * @return String
     */
    public function getUserComment()
    {
        return $this->user_comment;
    }

    /**
     * @param String $user_comment
     */
    public function setUserComment($user_comment)
    {
        $this->user_comment = $user_comment;
    }

} 