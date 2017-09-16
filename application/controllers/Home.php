<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/10/2017
 * Time: 9:55 PM
 */

class Home extends MY_controller{


    public function __construct(){
        parent::__construct();
    }


    public function index(){

        // khoi dao toi tuong product model
        $this->load->model("product_model");
        $this->load->model("catalog_model");
        $this->load->model("news_model");


        // lay ra 5 san pham ban chay nhat.
        $popularProducts = $this->product_model->getPopularProducts();

        // lay ra 5 san pham moi nhat.
        $newProducts = $this->product_model->getNewProducts();


        // lat ra danh sach cac chuyen muc cha.
        $parentCatalog = $this->catalog_model->get_list(array("where" => array("parent_id" => 0)));

        $products = array();

        foreach($parentCatalog as $i){
            $p = $this->product_model->getProductsByCategoryId($i->id);
            $products[$i->title] = $p;
        }


        // ham lay ra cac danh sach cac tin tuc.
        $news = $this->news_model->getHotNews();

        $this->data["temp"] = "site/home/index";
        $this->data ["popularProducts"] =  $popularProducts;
        $this->data ["newProducts"] =  $newProducts;
        $this->data ["products"] =  $products;
        $this->data ["news"] =  $news;

        $this->load->view("site/layout/layout",$this->data);
    }


    /**
     * Ham xu ly phan hoi
     */
    public function contact(){

        $this->load->model("feedback_model");
        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // neu co submit form
        if($this->input->post()){
            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("name","Họ Tên","required|callback_valid_str");
            $this->form_validation->set_rules("email","Email","required|valid_email");
            $this->form_validation->set_rules("address","Địa Chỉ","required|callback_valid_str");
            $this->form_validation->set_rules("title","Tiêu Đề","required|callback_valid_str");
            $this->form_validation->set_rules("message","Tin Nhắn","required");

            // chay kiem tra
            if($this->form_validation->run()){

                $data["name"]  = $this->input->post("name");
                $data["email"]  = escape_string($this->input->post("email"));
                $data["address"]  = $this->input->post("address");
                $data["title"]  = $this->input->post("title");
                $data["content"]  = escape_string($this->input->post("message"));
                $data["created"] = date("Y-m-d H:i:s",time());
                $data["status"] = 0;

                // thuc hien them du lieu vao CSDL
                if($this->feedback_model->create($data)){
                    $this->data["success"] = true;
                }else{
                    $this->data["success"] = false;
                }
            }
        }
        // load view.
        $this->data["title"] = "Liên Hệ";
        $this->data["temp"] = "site/home/contact";
        $this->load->view("site/layout/layout",$this->data);
    }
} 
