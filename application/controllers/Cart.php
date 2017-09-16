<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/26/2017
 * Time: 10:23 PM
 */

class Cart extends MY_controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('product_model');
    }

    /**
     *  ham them san pham vao gio hang.
     */
    public function add(){

        // load color_model and size_model.
        $this->load->model("color_model");
        $this->load->model("size_model");

        $productId = (int)$this->input->post('productId');
        $colorId = (int)$this->input->post('colorId');
        $sizeId = (int)$this->input->post('sizeId');
        $qty = (int)$this->input->post('qty');

       /** @var  $product ProductBean*/
        $product = $this->product_model->getProductById($productId);

        if(!$product){return;}
        // get list color and list size of product.
        $colors = $this->color_model->getListColorByProductId($product->getId());
        $sizes = $this->size_model->getListSizeByProductId($product->getId());

        $data = array(
            'id' => $product->getId(),
            'qty' => $qty,
            'price' => $product->getSpecialPrice() ? $product->getSpecialPrice() : $product->getPrice(),
            'name' => url_title($product->getName()),
            'options' => array(
                'imageUri' => getProductUri($product->getImage()),
                'color' => $this->getData($colorId,$colors),
                'size' => $this->getData($sizeId,$sizes),
                'colors' => $colors,
                'sizes' => $sizes
            )
        );

        $this->cart->insert($data);

        redirect(base_url('cart/'));
    }

    public function transaction(){


    }


    /**
     *
     */
    public function index(){

        $this->data['carts'] = $this->cart->contents();
        $this->data['temp'] = 'site/cart/cart';
        $this->load->view('site/layout/null',$this->data);
    }

    /**
     * ham cap nhat danh sach cua gio hang.s
     */
    public function update(){

        $value = $this->input->post("data");
        $type = $this->input->post('type');
        $productId = (int)$this->input->post('productId');

        if(!in_array($type,['color','size','qty'])){
            return;
        }

        $carts = $this->cart->contents();

        foreach($carts as $key => $val){
            if($val['id'] == $productId){
                $data['rowid'] = $key;

                if(in_array($type,['color','size'])){
                    $options = $val['options'];
                    unset($value['object']);
                    foreach($options as $k => &$v){
                        if($k == $type){
                            $v = $value;
                        }
                    }
                    $data['options'] = $options;
                }else{
                    $data[$type] = $value;
                }

                $this->cart->update($data);
                $this->getCarts();
                break;
            }
        }
    }

    /**
     *  ham tra ve danh sach gio hang.
     */
    public function getCarts(){

        $carts = $this->cart->contents();
        $total_items = $this->cart->total_items();

        $responseData  = ['carts' => $carts,'total_items' => $total_items];
        exit(json_encode($responseData));
    }


    /**
     *   ham xoa san pham trong gio hang.
     */
    public function delete(){

        $productId = (int)$this->input->post("productId");
        if($productId){
            $carts = $this->cart->contents();

            foreach($carts as $key => $val){

                if($val['id'] == $productId){

                    $data['rowid'] = $key;
                    $data['qty']  = 0;

                    $this->cart->update($data);
                    $this->getCarts();
                }
            }
        }
    }

    /**
     * @param $id
     * @param $list
     * @return array
     */
    private function getData($id,$list){

        foreach($list as $it){
            if($it->id == $id){
                return $it;
            }
        }
    }
} 