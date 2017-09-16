<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/20/2017
 * Time: 10:28 PM
 */

class Product extends MY_controller{

    public  function __construct(){

        parent ::__construct();

        // load model
        $this->load->model(array("product_model","catalog_model"));

        // gan tieu de.
        $this->data['title'] = "Quản Lý Sản Phẩm";

    }


    // ham lay ra thong tin cua cac san pham.
    public function index(){

        // lay ra danh sach cac chuyen muc.
        $catalog  = $this->get_catalog();
        // lay du lieu tu database.
        $total = $this->product_model->get_total();

        // lay ra so ban ghi hien thi tren 1 trang.
        $per_page = $this->input->post("per_page") ? intval($this->input->post("per_page")) : 2;

        // neu so ban ghi tren 1 trang > tong so ban ghi. gan $per_page = $total
        $per_page = $per_page > $total ? $total : $per_page;

        // phan trang.
        // load tu vien phan trang.
        $this->load->library("pagination");

        $config  = array(
            "uri_segment" => 4,
            "per_page" => $per_page,
            "base_url" => base_url("admin/product/index/"),
            "total_rows" =>$total,
        );

        $this->pagination->initialize(config_paging($config));

        // lay du lieu tu database.

        $offset = intval($this->uri->rsegment(3));
        $input = array(
            "limit" => array($config['per_page'],$offset),
        );

        // lay ra muc gia thap nhat va cao nhat.
        $price_max_min = $this->product_model->query("SELECT max(price) as pmax,
                        min(price) as pmin from product");

        // neu co tim kiem theo ten.
        if($this->input->post("search_name")){
            $name = escape_string($this->input->post("search_name"));
            $input['like'] = array("name",$name);
        }else if($this->input->post("search_price_to") && $this->input->post("search_price_from")){
            $from = intval($this->input->post("search_price_from"));
            $to = intval($this->input->post("search_price_to"));
            $input['where'] = "price BETWEEN {$from} AND {$to}";
        }else if($this->input->post("search_catalog")){
            $catalog_id = intval($this->input->post("search_catalog"));
            $input['where'] = array("catalog_id"=>$catalog_id);
        }

        // join hai bang product va catalog.
        $input['select'] = "product.*,catalog.title as catalog";
        $input['join'] = array('product','catalog','product.catalog_id = catalog.id');

        $list = $this->product_model->get_list($input);
        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['price_max_min'] = $price_max_min[0];
        $this->data['catalog'] = $catalog;
        $this->data['list'] = $list;
        $this->data['per_page'] = $config['per_page'];
        $this->data["action"] = "Danh Sách";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/product/index";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham Them Moi San pham
     */
    public function add(){

        // lay ra danh sach cac chuyen muc.
        $catalog  = $this->get_catalog();

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));


        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("name","Tên Sản Phẩm",
                "required|xss_clean|min_length[5]");
            $this->form_validation->set_rules("catalog","Chuyên Mục","required|numeric");
            $this->form_validation->set_rules("price","Giá","required|numeric");
            $this->form_validation->set_rules("image","Ảnh Đại Diện","callback_choose_file[image]");


            // neu co dien cac thong tin them.
            $discount = $this->input->post("discount");
            $site_title = $this->input->post("site_title");
            $warranty = $this->input->post("warranty");
            $description = $this->input->post("description");

            if(!empty($discount)){
                $this->form_validation->set_rules("discount","Giảm Giá","numeric");
            }

            if(!empty($site_title)){
                $this->form_validation->set_rules("site_title","Hint Tiêu Đề","callback_valid_str|xss_clean");
            }

            if(!empty($warranty)){
                $this->form_validation->set_rules("warranty","Bảo Hành","xss_clean");
            }

            if(!empty($description)){
                $this->form_validation->set_rules("description","Mô Tả","xss_clean");
            }

            // chay kiem tra
            if($this->form_validation->run()){

                // kiem tra ton tai.
                if(!$this->check_name($this->input->post("name"))){
                    // neu ten san pham nay da ton tai bao loi ra.
                    goto next;
                }

                // thuc hien upload anh dai dien.
                $this->load->library("upload_library");
                $result = $this->upload_library->upload_file("./upload/product/","image");

                // neu khong upload thanh cong thuc hien bao loi ve nguoi dung
                if(!isset($result['file_name'])){
                    $this->data['error']['image'] = $result;
                    goto next;
                }else{
                    // neu khong thuc hien lay ra ten file da upload. va thuc hien ma hoa.
                    $image = $result['file_name'];
                }

                // lay ra du lieu.
                $data =array();
                $data['name'] = escape_string($this->input->post("name"));
                $data['catalog_id'] = $this->input->post("catalog");
                $data['price'] = doubleval(str_replace(".","",$this->input->post("price")));
                $data['image'] = $image;
                $data['created']  = date("Y-m-d H:i:s",time());
                $data['status'] = 1;
                $data['bought'] = 0;
                $data['rate_total'] = 0;
                $data['rate_count'] = 0;


                if(!empty($discount)){
                    $data['discount'] = intval($discount);
                }

                if(!empty($description)){
                    $data['description'] = $description;
                }

                if(!empty($site_title)){
                    $data['site_title']= escape_string($site_title);
                }

                if(!empty($warranty)){
                    $data['warranty']= escape_string($warranty);
                }

                // neu co upload anh kem theo.
                if($this->choose_file('','image_list')) {
                    //  thuc hien upload file
                    // thuc hien load ra thu vien upload.

                    $upload_result = $this->upload_library->upload_multiple_file("./upload/product/", "image_list");

                    if(is_array($upload_result)){
                        $image_list = json_encode($upload_result);
                        $data['image_list'] = $image_list;
                    }else{
                        $this->data['error']['image_list'] = $upload_result;
                        goto next;
                    }
                }


                // thuc hien them du lieu vao CSDL
                if($this->product_model->create($data)){

                    alert_success("Thêm mới Sản Phẩm Thành Công");
                }else{
                    alert_error("Thêm Mới Sản Phẩm Thất Bại");
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/product/"));
            }
        }

        next :
        // load view.
        $this->data['temp'] = "admin/product/add_or_update";
        $this->data['catalog'] = $catalog;
        $this->data["action"] = "Thêm Mới";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham Sua Moi San pham
     */
    public function edit(){

        // lay ra danh sach cac chuyen muc.
        $catalog  = $this->get_catalog();

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // lay ra id cua san pham can sua.
        $id = $this->uri->rsegment(3);

        $info  = $this->product_model->get_info($id);

        // neu khong ton tai san pham. bao loi ve trang danh sach.
        if(!$info){
            alert_error("Sản Phẩm Không Tồn Tại");
            redirect(base_url("admin/product"));
        }

        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("name","Tên Sản Phẩm",
                "required|xss_clean|min_length[5]");
            $this->form_validation->set_rules("catalog","Chuyên Mục","required|numeric");
            $this->form_validation->set_rules("price","Giá","required|numeric");

            // neu co dien cac thong tin them.
            $discount = $this->input->post("discount");
            $site_title = $this->input->post("site_title");
            $warranty = $this->input->post("warranty");
            $description = $this->input->post("description");

            if(!empty($discount)){
                $this->form_validation->set_rules("discount","Giảm Giá","numeric");
            }

            if(!empty($site_title)){
                $this->form_validation->set_rules("site_title","Hint Tiêu Đề","callback_valid_str|xss_clean");
            }

            if(!empty($warranty)){
                $this->form_validation->set_rules("warranty","Bảo Hành","xss_clean");
            }

            if(!empty($description)){
                $this->form_validation->set_rules("description","Mô Tả","xss_clean");
            }

            // chay kiem tra
            if($this->form_validation->run()){

                // kiem tra ton tai.
                if(!$this->check_name($this->input->post("name"),$id)){
                    // neu ten san pham nay da ton tai bao loi ra.
                    goto next;
                }



                // lay ra du lieu.
                $data =array();
                $data['name'] = escape_string($this->input->post("name"));
                $data['catalog_id'] = $this->input->post("catalog");
                $data['price'] = doubleval(str_replace(".","",$this->input->post("price")));

                // neu co thay doi anh dai dien
                if($this->choose_file("","image")){

                    // thuc hien xoa anh dai dien cu.
                    $this->delete_img("./upload/product/".$info->image);

                    // thuc hien upload anh dai dien.
                    $this->load->library("upload_library");
                    $result = $this->upload_library->upload_file("./upload/product/","image");

                    // neu khong upload thanh cong thuc hien bao loi ve nguoi dung
                    if(!isset($result['file_name'])){
                        $this->data['error']['image'] = $result;
                        goto next;
                    }else{
                        // neu khong thuc hien lay ra ten file da upload. va thuc hien ma hoa.
                        $image = $result['file_name'];
                        $data['image'] = $image;
                    }
                }

                if(!empty($discount)){
                    $data['discount'] = intval($discount);
                }

                if(!empty($description)){
                    $data['description'] = $description;
                }

                if(!empty($site_title)){
                    $data['site_title']= escape_string($site_title);
                }

                if(!empty($warranty)){
                    $data['warranty']= escape_string($warranty);
                }

                // neu co upload anh kem theo.
                if($this->choose_file('','image_list')) {

                    $this->load->library("upload_library");
                    // thuc hien xoa cac anh kem theo.
                    foreach(json_decode($info->image_list) as $item){
                        $this->delete_img("./upload/product/".$item);
                    }
                    //  thuc hien upload file

                    $upload_result = $this->upload_library->upload_multiple_file("./upload/product/", "image_list");

                    if(is_array($upload_result)){
                        $image_list = json_encode($upload_result);
                        $data['image_list'] = $image_list;
                    }else{
                        $this->data['error']['image_list'] = $upload_result;
                        goto next;
                    }
                }


                // thuc hien them du lieu vao CSDL
                if($this->product_model->update($id,$data)){

                    alert_success("Chỉnh Sửa Sản Phẩm Thành Công");
                }else{
                    alert_error("Chỉnh Sửa Sản Phẩm Thất Bại");
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/product/"));
            }
        }

        next :
        // load view.
        $this->data['info'] = $info;
        $this->data['temp'] = "admin/product/add_or_update";
        $this->data['catalog'] = $catalog;
        $this->data["action"] = "Chỉnh Sửa";
        $this->load->view("admin/layout",$this->data);
    }

    // ham kiem tra su ton tai admin
    public   function check_name($name, $id=0){

        // neu truyen vao id
        $id = $id ? " AND id != ".$id : "";

        $input = array(
            "where" => " (name = '{$name}') {$id}"
        );

        // truy van lay du lieu.
        $r = $this->product_model->get_list($input);

        if($r){
            $this->data['error']['name'] = "Tên Sản Phẩm Đã Tồn Tại";
            return false;
        }
        return true;
    }

    // ham kiem tra xem da chon file hay chua.
    public   function choose_file($field,$d){

        if(empty($_FILES[$d]['tmp_name']) && $d == "image"){
            $this->form_validation->set_message(__FUNCTION__,"Bạn Chưa Chon File");
            return false;
        }
        if(empty($_FILES[$d]['tmp_name'][0]) && $d == "image_list"){
            $this->form_validation->set_message(__FUNCTION__,"Bạn Chưa Chon File");
            return false;
        }
        return true;
    }

    /*
     *  Ham Xoa Anh.
     */
    public function delete_img($path){
        if(file_exists($path)){
            unlink($path);
        }
    }

    /*
     *  Ham xoa 1 ban ghi.
     */

    public  function delete(){

        // lay ra id cua admin can xoa.
        $id = intval($this->uri->rsegment(3));

        // thuc hien xoa.
        if($this->del($id)){
            alert_success("Xóa Sản Phẩm Thành Công");
        }else{
            alert_error("Xóa Sản Phẩm Thất Bại");
        }
        redirect(base_url("admin/product/"));
    }

    /*
     *  Ham Xoa nhieu admin
     */

    public function delete_selected(){

        $ids  = $this->input->post("ids");

        // neu khong phai mang id dieu huing ve trang danh sach.
        if(!is_array($ids)){
            exit(json_encode(array("error"=>"Đã Có Lỗi Thông Thể Xóa")));
        }

        // thong bao mac dinh.
        $id_deleted['success'] = "Xóa Thành Công";

        foreach($ids as $id){
            if(!$this->del($id)){
                // neu co loi gan lai thong bao.
                $id_deleted['error'] = "Đã có lỗi xảy ra không Thế Xóa Tiếp";
                unset($id_deleted['success']);
            }
            // gan cac id da xoa thanh cong.
            $id_deleted[] = $id;
        }
        exit(json_encode($id_deleted));
    }

    /*
     *  ham xoa chung.
     */

    private  function del($id){

        // kiem tra xem admin co ton tai hay khong.
        $product = $this->product_model->get_info($id);

        if(!$product){
            alert_error("Sản Phẩm không Tồn Tại Không Thể Xóa");
            return false;
        }

        // neu co anh thuc hien xoa anh.
        if($product->image){
            $this->delete_img("upload/product/".$product->image);
        }

        // neu co anh kem theo thuc hien xoa anh kem theo.
        if($product->image_list){
            foreach(json_decode($product->image_list) as $img){
                $this->delete_img("upload/product/".$img);
            }
        }

        // neu khong thuc hien xoa.
        if($this->product_model->delete($id)){
            return true;
        }

        return false;
    }

    /*
     *  Ham lay ra danh sach cac chuyen muc.
     *
     */
    private function get_catalog(){
        $catalog = $this->catalog_model->get_list(array("where"=>array("parent_id"=>0)));

        foreach($catalog as &$it){
            $sub_child = $this->catalog_model->get_list(array("where"=>array("parent_id"=>$it->id)));
            $it->sub_child = $sub_child;
        }
        return $catalog;
    }
}
