<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/25/2017
 * Time: 9:36 PM
 */

class Comment extends MY_controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('comment_model');
    }

    /**
     * Ham lay danh sach cac binh luan
     * @return json
     */
    public function getComments(){

        $productId = (int)$this->input->post('productId');

        if(!$productId){return;};
        $this->getCommentById($productId);
    }

    /*
     * Ham them moi binh luan
     */
    public function addComment(){

        $user_comment = $this->session->userdata("user");
        $member_comment =  !$user_comment  ? NULL : ($user_comment["role"] ? NULL : (int)$user_comment["id"]);
        $admin_comment = !$user_comment   ? NULL : (!$user_comment["role"] ? NULL : (int)$user_comment["id"]);

        $product_id = (int)$this->input->post("product_id");
         $comment = [
            "question_id" =>  (int)$this->input->post("question_id"),
            "product_id" => $product_id,
            "content" => escape_string($this->input->post("content")),
            "member_comment_id" => $member_comment,
            "admin_comment_id" => $admin_comment,
            "user_comment" => !$admin_comment && !$member_comment ? $this->input->post("user_comment") : NULL,
            "created" => date("Y-m-d H:i:s",time())
        ];

        if($this->comment_model->create($comment)){
            $this->getCommentById($product_id);
        }else{
            exit(json_encode(["error" => "Đã có Lỗi Xảy Ra"]));
        }
    }

     private function getCommentById($productId){
         $comments = $this->comment_model->getComments($productId,0);
         exit(json_encode($comments,JSON_UNESCAPED_UNICODE));
     }
} 