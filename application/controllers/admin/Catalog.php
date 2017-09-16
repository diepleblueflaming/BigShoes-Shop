<?php
/**
 * Created by PhpStorm.
 * User: catalogistrator
 * Date: 1/9/2017
 * Time: 8:22 AM
 */

class Catalog extends MY_Controller{

    public function __construct(){
        parent::__construct();
        // load ra model catalog.
        $this->load->model("catalog_model");

        // gan tieu de.
        $this->data['title'] = "Quản Lý Danh Mục";
    }


    // ham lay ra thong tin cua cac chuyên mục.
    public function index(){

        // lay du lieu tu database.
        // lay tong so chuyen muc.
        $total = $this->catalog_model->get_total();

        // mang chua cac dieu kien dau vao.
        $input = array();

        // neu co tim kiem.
        if($this->input->post("search")){
            // mac dinh tim kiem theo tieu de
            $type = $this->input->post("type") ? escape_string($this->input->post("type")) : "title";
            $title = escape_string($this->input->post("search"));
            $input['like'] = array($type,$title);
        }

        $list = $this->catalog_model->get_list($input);

        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['list'] = $list;
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/catalog/index";
        $this->load->view("admin/layout",$this->data);
    }


    /*
     * ham them catalog moi.
     */

    public function add(){

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // mag chua loi.
        $error = array();
        $alert = array();

        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("title","Tiêu Đề",
                "required|xss_clean|callback_valid_str|min_length[5]");
            $this->form_validation->set_rules("position","Vị Trí","required|numeric");

            $site_title = $this->input->post("site_title");

            if($site_title){
                $this->form_validation->set_rules("site_title","Vị Trí","callback_valid_str");
            }

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['title'] = escape_string($this->input->post("title"));
                $data['position'] = intval($this->input->post("position"));
                $data['parent_id'] = intval($this->input->post("parent_id"));
                $data['created']  = date("Y-m-d H:i:s",time());

                // neu co nhap site title
                if($site_title){
                    $data['site_title'] = $site_title;
                }

                // kiem tra ton tai.
                if(!$this->check_title($data["title"])){
                    // neu catalog nay da ton tai bao loi ra.
                    $error['title'] = $this->data['error']['title'];
                    goto next;
                }

                // thuc hien them du lieu vao CSDL
                if($this->catalog_model->create($data)){

                    $alert['success'] = "Thêm mới Chuyên Mục Thành Công";
                }else{
                    $alert['failed'] = "Thêm Mới Chuyên Mục Thất Bại";
                }

                // tra ve thong bao.
                exit(json_encode($alert));
            }


        }

        // gan loi vao mang loi.
        $error['title'] = form_error("title");
        $error['position'] = form_error("position");
        $error['site_title'] = form_error("site_title");
        next :
        exit(json_encode($error));
    }

    /*
     *  Ham Sua catalog.
     */

    public function edit(){
        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // lay ra id cua chyen muc can sua.
        $id = intval($this->input->post("id"));

        $cat = $this->catalog_model->get_info($id);

        // neu chuyen muc khong ton tai. bao loi. ngung chuong trinh
        if(!$cat){
            exit(json_encode(array('alert'=>"Chuyên mục Không tồn tại")));
        }

        // mag chua loi.
        $error = array();
        $alert = array();

        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("title","Tiêu Đề",
                "required|xss_clean|callback_valid_str|min_length[5]");
            $this->form_validation->set_rules("position","Vị Trí","required|numeric");

            $site_title = $this->input->post("site_title");
            if($site_title){
                $this->form_validation->set_rules("site_title","Vị Trí","callback_valid_str");
            }

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['title'] = escape_string($this->input->post("title"));
                $data['position'] = intval($this->input->post("position"));

                // neu co nhap site title
                if($site_title){
                    $data['site_title'] = $site_title;
                }

                // kiem tra ton tai.
                if(!$this->check_title($data["title"],$id)){
                    // neu catalog nay da ton tai bao loi ra.
                    $error['title'] = $this->data['error']['title'];
                    goto next;
                }

                // thuc hien them du lieu vao CSDL
                if($this->catalog_model->update($id,$data)){

                    $alert['success'] = "Chỉnh Sửa Chuyên Mục Thành Công";
                }else{
                    $alert['failed'] = "Chỉnh Sửa Chuyên Mục Thất Bại";
                }

                // tra ve thong bao.
                exit(json_encode($alert));
            }

        }

        // gan loi vao mang loi.
        $error['title'] = form_error("title");
        $error['site_title'] = form_error("site_title");
        $error['position'] = form_error("position");
        next :
        exit(json_encode($error));
    }

    // ham kiem tra su ton tai catalog
    public function check_title($title,$id=0){

        // neu truyen vao id
        $id = $id ? " AND id != ".$id : "";

        $input = array(
            "where" => " ( title = '{$title}' ) {$id}"
        );

        // truy van lay du lieu.
        $r = $this->catalog_model->get_list($input);

        // lap danh sach tra ve.
        foreach($r as $it){

            if($it->title == $title){
                $this->data['error']['title'] = "Tiêu Đề Đã Tồn Tại";
                return false;
            }
        }

        return true;
    }


    /*
     *  Ham xoa 1 ban ghi.
     */

    public  function delete(){

        // lay ra id cua catalog can xoa.
        $id = intval($this->input->post("id"));

        // thuc hien xoa.
        if($this->del($id)){
            $this->data['alerts'] = "Xoá Chuyên Mục Thành Công";
        }else{
            $this->data['alerts'] = "Xóa Chuyên Mục Thất Bại";
        }

        exit(json_encode($this->data));
    }


    /*
     *  ham xoa chung.
     */

    private  function del($id){

        // kiem tra xem catalog co ton tai hay khong.
        $catalog = $this->catalog_model->get_info($id);

        if(!$catalog){
            $this->data['alerts'] = "catalog không Tồn Tại Không Thể Xóa";
            exit(json_encode($this->data));
        }

        // neu khong thuc hien xoa.
        if($this->catalog_model->delete($id)){
            return true;
        }
        return false;
    }

    public function check(){

        // lay ra id chuyen muc.
        $id = intval($this->input->post("id"));

        // kiem tra xem chuyen muc can xoa co chuyen muc con hay khong.
        $input = array(
            "where" => array("parent_id"=> $id),
            "select" => "id"
        );

        $list_child = $this->catalog_model->get_list($input);

        // neu co chuyen muc con  yeu cac xac nhan.
        if($list_child){
            $amount = count($list_child);
            $this->data['confirm'] = "Chuyên Mục Này có {$amount} chuyên mục con. Bạn có chắc chắn Muốn Xóa Nó";
            exit(json_encode($this->data));
        }else{
            // neu khong xoa luon.
           $this->delete();
        }
    }

    // ham thay doi trang thai chuyen muc.
    public  function changeStatus(){

        // lay ra id va trang thai chuyen muc.
        $id = intval($this->input->post("id"));
        $status = intval($this->input->post("status"));

        // lay ra chuyen muc.
        $cat = $this->catalog_model->get_info($id);

        if(!$cat){
            exit(json_encode(array("error"=>"Chuyên Mục Không Tồn Tại")));
        }

        // gan lai trang thai.
        $status_title = $status ? "Active" : "Disable";
        $status = $status ? 0 : 1;

        $data = array("status"=>$status);

        if($this->catalog_model->update($id,$data)){
            $this->data['num'] = $status;
            $this->data['status'] = $status_title;
            exit(json_encode($this->data));
        }
    }
}


