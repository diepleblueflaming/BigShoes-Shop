<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/15/2017
 * Time: 8:46 PM
 */

class Product extends MY_controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("product_model");
    }


    /**
     * function show list product belong category.
     */
    public function index(){

        $this->load->library("form_validation");

        // lay ra id chuyen muc.
        $catId = $this->uri->rsegment(3);

        // lay ra chuyen muc.
        /** @var  $catalog \CatalogBean*/
        $catalog = $this->catalog_model->getCatalogById($catId);

        // neu co xap xep san pham.
        $input = null;
        if($this->input->post("filterProduct")){

            $order = $this->input->post("filterProduct");

            $arr = [
                "new" => "created",
                "popular" => "bought",
                "sale" => "discount",
                "price" => "price"
            ];

            foreach($arr as $key => $val){
                $input["order"] = ($order == $key) ? $val : "id";
                if($order == "sale"){
                    $input["where"] = "discount != 0";
                }
            }

        }


        // neu co xap xep san pham.
        if($this->input->post("filterPrice-to")) {

            $from = (int)$this->input->post("filterPrice-from");
            $to = (int)$this->input->post("filterPrice-to");

            $input['where'] = "(product.price * (1- (0.01 * product.discount))) BETWEEN {$from} AND {$to}";
        }
        // lay ra danh sach cac san pham cua chuyen muc nay.
        $products = $this->product_model->getProductsByCategoryId($catId,$input);

        $this->data['temp'] = "site/product/category";
        $this->data['products'] = $products;
        $this->data["title"] = $catalog->getTitle();
        $this->data['catalog'] = $catalog;
        $this->load->view($this->view,$this->data);
    }


    /**
     * ham xem chi tiet san pham
     */
    public function viewProduct(){

        // load catalog_model.
        $this->load->model("catalog_model");
        // load color_model and size_model.
        $this->load->model("color_model");
        $this->load->model("size_model");

        // get product
        $pId = $this->uri->rsegment(3);
        /** @var  $product \ProductBean*/
        $product = $this->product_model->getProductById($pId);
        $catalog  = $this->catalog_model->getCatalogById($product->getCatalogId());

        // get list size and color of this product.
        $colors = $this->color_model->getColorsByProductId($product->getId());
        $sizes = $this->size_model->getSizesByProductId($product->getId());

        // get 5 product newest.
        $newProducts  = $this->product_model->getNewProducts();

        $this->data['temp'] = 'site/product/view';
        $this->data['product'] = $product;
        $this->data['catalog'] = $catalog;
        $this->data['colors'] = $colors;
        $this->data['sizes'] = $sizes;
        $this->data['newProducts'] = $newProducts;
        $this->data["title"] = $product->getName();

        $this->load->view($this->view,$this->data);
    }


    /**
     * Phuong thuc lay ra so luong san pham du vao kich thuoc va mau sac
     */
    public function getQtyProduct(){

        // load model
        $this->load->model("Product_size_color_model","psc");

        // check if request is xmlrequest.
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === "xmlhttprequest"){

            $colorId = (int)$this->input->post("colorId");
            $sizeId =  (int)$this->input->post("sizeId");

            $input  = array(
                "color_id" => $colorId,
                "size_id" => $sizeId
            );

            $re = $this->psc->get_info_rule($input,"qty");

            if($re){
                die($re->qty);
            }
            exit(0);
         }
    }

    /**
     * Ham Tim Kiem San Pham Theo Ten
     */
    public function search(){

        $this->load->helper("form");
        $product_name = escape_string($this->input->post("p_name_search"));

        // neu co xap xep san pham.
        $input = null;
        if($this->input->post("filterProduct")){

            $order = $this->input->post("filterProduct");

            $arr = [
                "new" => "created",
                "popular" => "bought",
                "sale" => "discount",
                "price" => "price"
            ];

            foreach($arr as $key => $val){
                $input["order"] = [($order == $key) ? $val : "id","DESC"];
            }
        }




        // neu co xap xep san pham.
        if($this->input->post("filterPrice-to")){

            $from = (int)$this->input->post("filterPrice-from");
            $to = (int)$this->input->post("filterPrice-to");

            $input['where'] =  "(price * (1- (0.01 * discount))) BETWEEN {$from} AND {$to}";
        }

        $input["like"] = ["name",$product_name];

        // lay ra danh sach san pham tim kiem
        $result = $this->product_model->searchProduct($input);

        $this->data['temp'] = 'site/product/search';
        $this->data['products'] = $result;
        $this->data["title"] = "Tìm Kiếm";
        $this->data['p_name_search'] = $product_name;
        $this->load->view($this->view,$this->data);
    }

    /**
     * Ham danh gia san pham
     */
    public function rating(){

        $id = (int)$this->input->post("id");
        $score = (int)$this->input->post("score");

        if(!($p = $this->product_model->get_info($id))){
            return;
        }

        $data = [
            "rate_total" => $p->rate_total + $score,
            "rate_count" => $p->rate_count + 1
        ];

        if($this->product_model->update($id,$data)){
            $res["complete"] = true;
        }else{
            $res["complete"] = false;
        }

        exit(json_encode($res));
    }
} 
