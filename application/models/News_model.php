<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/3/2017
 * Time: 3:18 PM
 */

require_once 'Bean/NewsBean.php';

class News_model extends MY_Model{
    var $table = "news";
    var $key = "id";



    /**
     * function get list news. order by date create
     * @return array
     */
    public function getHotNews(){

        $input = array(
            "limit" => array(5,0),
            "order" => array(NEWS_CREATED,"DESC")
        );

        $result = $this->get_list($input);
        return convertStdClassToObj($result,"NewsBean");
    }


    /**
     * @return array
     */
    public function getNews(){

        $input = array(
            'select' => 'news.id,news.title,news.content,news.summary_content,news.image_link,news.created,admin.username as author',
            'join' => array('news','admin','news.admin_post_id = admin.id')
        );

        $result = $this->get_list($input);
        return $result;
    }


    public function getNewsById($id){

        $input = array(
            "where" => array('news.id' => $id),
            'select' => 'news.id,news.title,news.content,news.summary_content,news.image_link,news.created,admin.username as author',
            'join' => array('news','admin','news.admin_post_id = admin.id')
        );
        $result = $this->get_list($input);
        return $result[0];
    }
}