<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/10/2017
 * Time: 9:33 AM
 */
class MY_Controller extends CI_Controller{

    var $view = "site/layout/layout";

    // ham khoi tao
    public function __construct(){

        parent::__construct();

        // load ra cac thu vien dung chung can thiet cho phan qan tri.
        $this->load->library("session");

        // lay ra controller la admin hay phan site.
        $controller = $this->uri->segment(1);
        $action = $this->uri->segment(3);
        // xu ly cac truong hop cua controller.
        switch($controller){
            // xu ly neu request den phan admin.
            case "admin" : {
                $this->load->model(["admin_model","feedback_model","transaction_model"]);
                $user_info = $this->session->userdata("admin");
                if((!in_array($action,["login","register"]))) {
                    if ($user_info) {
                        // kiem tra lai lan nua
                        $info_login = $this->admin_model->get_info_rule(
                            ["id" => $user_info["id"], "username" => $user_info["username"]]);
                        if (!$info_login) {
                            redirect(base_url("admin/home/login/"));
                        }
                        $this->data["info_login"] = $info_login;
                        // lay ra so lien he chua xu ly
                        $this->data["number_of_feedback"] = $this->feedback_model->get_total(["where" => ["status" => 0]]);
                        // lay ra so don hang chua xu ly
                        $this->data["number_of_transaction"] = $this->transaction_model->get_total(["where" => ["status" => 0]]);
                    }else{
                        redirect(base_url("admin/home/login/"));
                    }
                }
                break;
            }
            default : {
                // load category model.
                $this->load->model("catalog_model");
                $this->data["categories"] = $this->catalog_model->getCategories();

                // lay ra tong so san pham.
                // load library cart
                $this->load->library("cart");
                $this->data['carts'] = $this->cart->contents();
                $this->data['totalPrice'] = (double)$this->cart->total();
                $this->data['login_info'] = $this->session->userdata("user");
                $this->data['total_product'] = $this->cart->total_items();

            }
        }
    }

    public function valid_str($str){
        return validate_string($str);
    }

    public function isLogin(){
        return $this->session->userdata("user");
    }
} 