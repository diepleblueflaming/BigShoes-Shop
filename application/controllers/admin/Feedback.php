<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/30/2017
 * Time: 4:07 PM
 */

class Feedback extends MY_controller{
    public function __construct(){
        parent::__construct();
        // load ra model feedback.
        $this->load->model("feedback_model");

        // gan tieu de.
        $this->data['title'] = "Quản Lý Phản Hồi";
    }


    // ham lay ra thong tin cua cac quan tri vien.
    public function index(){

        // lay du lieu tu database.
        $total = $this->feedback_model->get_total();

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
            "base_url" => base_url("admin/feedback/index/"),
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
            $input['like'] = array("name",escape_string($this->input->post("search")));
        }

        $list = $this->feedback_model->get_list($input);

        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['list'] = $list;
        $this->data['per_page'] = $config['per_page'];
        $this->data["action"] = "Danh Sách";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/feedback/index";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham xoa 1 ban ghi.
     */

    public  function delete(){

        // lay ra id cua feedback can xoa.
        $id = intval($this->uri->rsegment(3));

        // thuc hien xoa.
        if($this->del($id)){
            alert_success("Xóa Thành Công");
        }else{
            alert_error("Xóa Thất Bại");
        }
        redirect(base_url("admin/feedback/"));
    }

    /*
     *  Ham Xoa Nhieu Ban Ghi
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

        // kiem tra xem feedback co ton tai hay khong.
        $feedback = $this->feedback_model->get_info($id);

        if(!$feedback){
            alert_error("Không Tồn Tại Không Thể Xóa");
            redirect(base_url("admin/feedback/"));
            return false;
        }

        // neu khong thuc hien xoa.
        if($this->feedback_model->delete($id)){
            return true;
        }
        return false;
    }

    // ham thay doi trang thai phan hoi.
    public  function changeStatus(){

        // lay ra id va trang thai chuyen muc.
        $id = intval($this->input->post("id"));
        $status = intval($this->input->post("status"));

        // lay ra chuyen muc.
        $cat = $this->feedback_model->get_info($id);

        if(!$cat){
            exit(json_encode(array("error"=>"Chuyên Mục Không Tồn Tại")));
        }

        // gan lai trang thai.
        $status_title = $status ? "Chưa xử lý" : "Đã xử lý";
        $status = $status ? 0 : 1;

        if($this->feedback_model->update($id,["status"=>$status])){
            $this->data['num'] = $status;
            $this->data['status'] = $status_title;
            exit(json_encode($this->data));
        }
    }
} 