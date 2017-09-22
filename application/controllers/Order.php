<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/29/2017
 * Time: 3:01 PM
 */

class Order extends MY_controller{

    public function __construct(){
        parent::__construct();

        $this->load->model(["product_model","transaction_model",'order_model', 'Product_size_color_model']);
    }

    public function checkOut(){

        $this->load->library("form_validation");
        $this->load->helper(["security","form"]);

        $carts = [];

        // neu bam nut mua ngay lay ra san pham mua ngay.
        if($productId = (int)$this->input->post('productId')){
            // load color_model and size_model.
            $this->load->model("color_model");
            $this->load->model("size_model");


            $colorId = (int)$this->input->post('colorId');
            $sizeId = (int)$this->input->post('sizeId');
            $qty = (int)$this->input->post('qty');

            /** @var  $product  ProductBean*/
            $product = $this->product_model->getProductById($productId);
            $color = $this->color_model->getColorById($colorId);
            $size = $this->size_model->getSizeById($sizeId);


            if(!$product || !$color || !$size || !$qty){
                redirect(base_url());
            }

            $this->cart->destroy();
            $carts = [
                'id' => $product->getId(),
                'price' => $product->getSpecialPrice() ? $product->getSpecialPrice() : $product->getPrice(),
                'name' => url_title($product->getName()),
                'qty' =>$qty,
                'options' => [
                    'color' => $color,
                    'size' => $size,
                    'imageUri' => getProductUri($product->getImage())
                ]

            ];

            $this->cart->insert($carts);
            $carts = $this->cart->contents();
        }else{
            // neu khong lay cac san pham tu gio hang.
            $carts = $this->cart->contents();
        }


        if($this->input->post("pay")){

            $this->form_validation->set_rules("full_name","Họ Tên","xss_clean|required|callback_valid_str");
            $this->form_validation->set_rules("phone","Số Điện Thoại","xss_clean|required|numeric");
            $this->form_validation->set_rules("email","Email","required|valid_email");


            if($receive = $this->input->post("radio-giao-hang")){
                if(!in_array($receive,["giao-hang","nhan-hang"])){
                    redirect(base_url());
                }
                if($receive === "giao-hang"){
                    $this->form_validation->set_rules("deliver-address","Địa Chỉ Giao Hàng","required|callback_valid_str|xss_clean");
                    $this->form_validation->set_rules("location","Tỉnh/Thành Phố","required|callback_valid_str");
                }
            }

            $this->form_validation->set_rules("payment","Thanh Toán","required");

            if($payment = $this->input->post("payment")){
                if(!in_array($payment,['direct','bao-kim'])){
                    redirect(base_url());
                }
            }

            $this->form_validation->set_rules("message","Ghi chú","xss_clean");

            // thuc hien valid data.
            if($this->form_validation->run()){


                $receive_info = ($receive === "giao-hang") ? $this->input->post("deliver-address")."\r\n".$this->input->post("location") : NULL;

                $transaction = [
                    "name" => $this->input->post("full_name"), // name
                    "email" => $this->input->post("email"), // email
                    "phone" => $this->input->post("phone"), // phone
                    "message" => escape_string($this->input->post("message")), // message
                    "payment" => $payment, // payment
                    "payment_info" => "", // payment-info
                    "receive" => $receive, // receive
                    "receive_info" => $receive_info,
                    "amount" => $this->cart->total(), // amount
                    "status" => 1, // status
                    "user_id" => NULL, // user_id
                    "created" => date("Y-m-d",time())
                ]; // created

                // Thuc hien them 1 don hang
                if($this->transaction_model->add($transaction)){
                   // neu them thanh cong.

                    $transaction_id = $this->db->insert_id();
                    // thuc hien them cac san pham trong don hang vao bang order.
                    foreach($carts as $cart){

                        $productId = $cart['id'];
                        $colorId =  $cart['options']['color']->id;
                        $sizeId =   $cart['options']['size']->id;
                        $qty = $cart['qty'];

                        $order = [
                            "transaction_id" => $transaction_id, // transaction_id
                            "color_id" => $colorId, //color_id
                            "product_id" => $productId, // product_id
                            "size_id" => $sizeId, // size_id
                            "status" => 1, // status
                            "amount" => $cart['subtotal'], // amount
                            "qty" => $qty,
                            "created" => date("Y-m-d",time()) // created
                        ];

                        $this->order_model->add($order);
                        $this->product_size_color_model->updateQty($productId,$colorId,$sizeId,$qty);
                    }

                    $this->cart->destroy();

                    if($receive == "giao-hang"){
                        $message = "Chúng Tôi Sẽ Giao Hàng Cho Bạn Trong Thời Gian Sớm Nhất";
                    }else{
                        $message = "Bạn Vui Lòng Đến Cửa Hàng Để Nhận Hàng Trong Thời Gian 1 Tuần";
                    }
                    $this->data['message'] = $message;
                    redirect(base_url("order/success"));
                }
            }
        }

        $this->data['carts'] = $carts;
        $this->data['totalPrice'] = $this->cart->total();
        $this->data['productId'] = $productId;
        $this->data['temp'] = 'site/cart/checkOut';
        $this->data["title"] = "Check Out";
        $this->load->view('site/layout/null',$this->data);
    }


    public function success(){
        $this->data['temp'] = 'site/cart/success';
        $this->load->view('site/layout/null',$this->data);
    }
} 
