<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/26/2017
 * Time: 4:37 PM
 */

class News extends MY_controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("news_model");
    }


    public function index(){

        // lay ra danh sach tin tuc
        $listNews = $this->news_model->getNews();
        // lay ra 5 tin tuc moi nhat.
        $hotNews = $this->news_model->getHotNews();

        $this->data['temp'] = 'site/news/category';
        $this->data['listNews']  = $listNews;
        $this->data['hotNews'] = $hotNews;
        $this->data["title"] = "Blog";
        $this->load->view($this->view,$this->data);
    }


    public function viewNews(){

        $newsId =  (int)$this->uri->rsegment(3);

        // lay ra tin tuc hien tai.
        $news = $this->news_model->getNewsById($newsId);

        // lay ra 5 tin tuc moi nhat.
        $hotNews = $this->news_model->getHotNews();

        $this->data['temp'] = 'site/news/view';
        $this->data['news'] = $news;
        $this->data["title"] = $news->getTitle();
        $this->data['hotNews'] = $hotNews;
        $this->load->view($this->view,$this->data);
    }
} 
