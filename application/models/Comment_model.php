<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/25/2017
 * Time: 10:15 PM
 */

require_once 'Bean/CommentBean.php';

class Comment_model extends MY_Model{

    var $table = 'comment';
    var $key = 'id';


    public function getComments($id,$question_id){

        $this->db->select("comment.id,comment.content,DATE_FORMAT(comment.created,'%d-%m-%Y %H:%i') as created
            ,comment.user_comment,user.username as member,admin.username as admin");
        $this->db->where(array('product_id' => $id,"question_id" => $question_id));
        $this->db->from('comment');
        $this->db->join('user','comment.member_comment_id = user.id','left');
        $this->db->join('admin','comment.admin_comment_id = admin.id','left');

        $result = $this->db->get()->result();
        //echo $this->db->last_query();
        if($result){
            foreach($result as $it){
                foreach(["user_comment", "member", "admin"] as $i){
                    if($it->{$i}){
                        if($i == "admin"){
                            $it->is_manager = true;
                        }
                        $it->name = $it->{$i};
                    }
                    unset($it->{$i});
                }
                $answers = $this->getComments($id,$it->id);
                if($answers){
                    $it->answers = $answers;
                }
            }
        }
        return $result;
    }
}