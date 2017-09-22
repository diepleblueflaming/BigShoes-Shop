<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/27/2017
 * Time: 9:23 AM
 */

class Product_color_size extends MY_controller{

    public function __construct(){
        parent::__construct();
        // load ra model color.
        $this->load->model("product_size_color_model","pcs");

        // gan tieu de.
        $this->data['title'] = "Quản Lý Sản Phẩm - Màu Sắc - Kích Thước";
    }


    // ham lay ra thong tin cua cac quan tri vien.
    public function index(){

        // lay du lieu tu database.
        $total = $this->pcs->get_total();

        // lay ra so ban ghi hien thi tren 1 trang.
        $per_page = $this->input->post("per_page") ? intval($this->input->post("per_page")) : 5;

        // neu so ban ghi tren 1 trang > tong so ban ghi. gan $per_page = $total
        $per_page = $per_page > $total ? $total : $per_page;

        // phan trang.
        // load tu vien phan trang.
        $this->load->library("pagination");

        $config  = array(
            "uri_segment" => 4,
            "per_page" => $per_page,
            "base_url" => base_url("admin/Product_Color_Size/index/"),
            "total_rows" =>$total,
        );

        $this->pagination->initialize(config_paging($config));

        // lay du lieu tu database.

        $offset = intval($this->uri->rsegment(3));
        $this->db->limit($config['per_page'],$offset);

        // neu co tim kiem.

        if($this->input->post("search_name")){
            $name = escape_string($this->input->post("search_name"));
            $this->db->like(array("product.name"=>$name));
        }
        // noi cac bang du lieu.
        $this->db->from("product_color_size");
        $this->db->join("colors","product_color_size.color_id = colors.id");
        $this->db->join("sizes","product_color_size.size_id = sizes.id");
        $this->db->join("product","product_color_size.product_id = product.id");
        $this->db->select("product.id as p_id,product.name,product.image,colors.name as color,sizes.size,
                product_color_size.qty,product_color_size.id");

        $list = $this->db->get()->result();

        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['list'] = $list;
        $this->data['per_page'] = $config['per_page'];
        $this->data["action"] = "Danh Sách";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/pcs/index";
        $this->load->view("admin/layout",$this->data);
    }


    /*
     * ham them san pham - kich thuoc - mau sac moi.
     */

    public function add(){

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        $list = $this->get_product_color_size();

        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("product_id","Sản Phẩm","required");
            $this->form_validation->set_rules("color_id","Màu Sắc","required");
            $this->form_validation->set_rules("size_id","Kích Thước","required");
            $this->form_validation->set_rules("qty","Số Lượng","required");

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['product_id'] = intval($this->input->post("product_id"));
                $data['color_id'] = intval($this->input->post("color_id"));
                $data['size_id'] = intval($this->input->post("size_id"));
                $data['qty'] = intval($this->input->post("qty"));
                $data['created']  = date("Y-m-d H:i:s",time());

                // kiem tra xem kich thuoc da ton tai hay chua.
                if($this->check_exist($data)){
                    alert_error("Bản Ghi Này Đã Tồn Tại");
                    redirect(base_url("admin/product_color_size/"));
                }
                // thuc hien them du lieu vao CSDL
                if($this->pcs->create($data)){

                    alert_success("Thêm mới Thành Công");
                }else{
                    alert_error("Thêm Mới Thất Bại");
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/product_color_size/"));
            }
        }

        // load view.
        $this->data['products'] = $list[0];
        $this->data['colors'] = $list[1];
        $this->data['sizes'] = $list[2];
        $this->data['temp'] = "admin/PCS/add_or_update";
        $this->data["action"] = "Thêm Mới";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  ham them san pham - kich thuoc - mau sac moi.
     */
    public function edit(){

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        $list = $this->get_product_color_size();

        // lay ra ban ghi hien tai.
        $id = intval($this->uri->rsegment(3));
        $info = $this->pcs->get_info($id);

        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("product_id","Sản Phẩm","required");
            $this->form_validation->set_rules("color_id","Màu Sắc","required");
            $this->form_validation->set_rules("size_id","Kích Thước","required");
            $this->form_validation->set_rules("qty","Số Lượng","required");

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['product_id'] = intval($this->input->post("product_id"));
                $data['color_id'] = intval($this->input->post("color_id"));
                $data['size_id'] = intval($this->input->post("size_id"));
                $data['qty'] = intval($this->input->post("qty"));
                $data['created']  = date("Y-m-d H:i:s",time());

                // kiem tra xem kich thuoc da ton tai hay chua.
                if($this->check_exist($data,$id)){
                    alert_error("Bản Ghi Này Đã Tồn Tại");
                    redirect(base_url("admin/product_color_size/"));
                }
                // thuc hien them du lieu vao CSDL
                if($this->pcs->update($id, $data)){

                    alert_success("Chỉnh Sửa Thành Công");
                }else{
                    alert_error("Chỉnh Sửa Thất Bại");
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/product_color_size/"));
            }
        }

        // load view.
        $this->data['products'] = $list[0];
        $this->data['colors'] = $list[1];
        $this->data['sizes'] = $list[2];
        $this->data['info'] = $info;
        $this->data['temp'] = "admin/PCS/add_or_update";
        $this->data["action"] = "Chỉnh Sửa";
        $this->load->view("admin/layout",$this->data);
    }


    // ham kiem tra su ton tai color
    public function check_exist($data, $id=0){

        // neu truyen vao id
        $id = $id ? " AND id != ".$id : "";

        $query ="SELECT id FROM product_color_size WHERE ( product_id = {$data['product_id']} AND color_id = {$data['color_id']} AND size_id = {$data['size_id']} ) {$id}";

        // truy van lay du lieu.
        $r = $this->db->query($query)->result();

        if(!empty($r)){
            return true;
        }
        return false;
    }


    /*
     *  Ham xoa 1 ban ghi.
     */

    public  function delete(){

        // lay ra id cua color can xoa.
        $id = intval($this->uri->rsegment(3));

        // thuc hien xoa.
        if($this->del($id)){
            alert_success("Xóa Thành Công");
        }else{
            alert_error("Xóa Thất Bại");
        }
        redirect(base_url("admin/product_color_size/"));
    }

    /*
     *  Xoa cac muc da chon
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

        // kiem tra xem color co ton tai hay khong.
        $color = $this->pcs->get_info($id);

        if(!$color){
            alert_error("Bản Ghi không Tồn Tại Không Thể Xóa");
            redirect(base_url("admin/product_color_size/"));
            return false;
        }

        // neu khong thuc hien xoa.
        if($this->pcs->delete($id)){
            return true;
        }

        return false;
    }

    private function get_product_color_size(){

        // load model.
        $this->load->model("color_model");
        $this->load->model("product_model");
        $this->load->model("size_model");

        // lay ra danh sach mau sac, san pham, kich thuoc.
        $products = $this->product_model->get_list();
        $colors = $this->color_model->get_list();
        $sizes = $this->size_model->get_list();

        return array($products,$colors,$sizes);
    }
} 
