<?php
/**
 * Created by PhpStorm.
 * User: sizeistrator
 * Date: 1/9/2017
 * Time: 8:22 AM
 */

class Size extends MY_Controller{

    public function __construct(){
        parent::__construct();
        // load ra model size.
        $this->load->model("size_model");

        // gan tieu de.
        $this->data['title'] = "Quản Lý Kích Thước";
    }


    // ham lay ra thong tin cua cac quan tri vien.
    public function index(){

        // lay du lieu tu database.
        $total = $this->size_model->get_total();

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
            "base_url" => base_url("admin/size/index/"),
            "total_rows" =>$total,
        );

        $this->pagination->initialize(config_paging($config));

        // lay du lieu tu database.

        $offset = intval($this->uri->rsegment(3));
        $input = array(
            "limit" => array($config['per_page'],$offset),
        );

        // neu co tim kiem.
        if($this->input->post("search")){
            $input['where'] = array("size" => intval($this->input->post("search")));
        }

        $list = $this->size_model->get_list($input);

        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['list'] = $list;
        $this->data['per_page'] = $config['per_page'];
        $this->data["action"] = "Danh Sách";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/size/index";
        $this->load->view("admin/layout",$this->data);
    }


    /*
     * ham them Kích  Thước moi.
     */

    public function add(){

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));


        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("size","Kích Thước","required|numeric");

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['size'] = intval($this->input->post("size"));
                $data['created']  = date("Y-m-d H:i:s",time());

                // kiem tra xem kich thuoc da ton tai hay chua.
                if($this->check_size($data['size'])){
                    alert_error("Kích Thước Này Đã Tồn Tại");
                    redirect(base_url("admin/size"));
                }
                // thuc hien them du lieu vao CSDL
                if($this->size_model->create($data)){

                    alert_success("Thêm mới Kích Thước Thành Công");
                }else{
                    alert_error("Thêm Mới Kích Thước Thất Bại");
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/size/"));
            }
        }

        // load view.
        $this->data['temp'] = "admin/size/add_or_update";
        $this->data["action"] = "Thêm Mới";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham Sua size.
     */


    // ham kiem tra su ton tai size
    public function check_size($size, $id=0){

        // neu truyen vao id
        $id = $id ? " AND id != ".$id : "";

        $input = array(" size = '{$size}' {$id}");

        // truy van lay du lieu.
        $r = $this->size_model->get_info_rule($input,"id");

        if($r){
            return false;
        }
        return true;
    }


    /*
     *  Ham xoa 1 ban ghi.
     */

    public  function delete(){

        // lay ra id cua size can xoa.
        $id = intval($this->uri->rsegment(3));

        // thuc hien xoa.
        if($this->del($id)){
            alert_success("Xóa size Thành Công");
        }else{
            alert_error("Xóa size Thất Bại");
        }
        redirect(base_url("admin/size/"));
    }


    /*
     *  ham xoa chung.
     */

    private  function del($id){

        // kiem tra xem size co ton tai hay khong.
        $size = $this->size_model->get_info($id);

        if(!$size){
            alert_error("size không Tồn Tại Không Thể Xóa");
            redirect(base_url("admin/size/"));
            return false;
        }

        // neu khong thuc hien xoa.
        if($this->size_model->delete($id)){
            return true;
        }

        return false;
    }
}


