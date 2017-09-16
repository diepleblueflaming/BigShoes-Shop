<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/27/2017
 * Time: 6:41 PM
 */

class Transaction extends  MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model(["transaction_model","order_model"]);
    }


    /**
     * Ham lay ra danh sach cac don hang
     */
    public function index(){
        // lay ra tong so ban ghi.
        $total = $this->transaction_model->get_total();

        // lay ra so ban ghi hien thi tren 1 trang.
        $per_page = $this->input->post("per_page") ? intval($this->input->post("per_page")) : 10;

        // neu so ban ghi tren 1 trang > tong so ban ghi. gan $per_page = $total
        $per_page = $per_page > $total ? $total : $per_page;

        // phan trang.
        // load tu vien phan trang.
        $this->load->library("pagination");

        $config  = array(
            "uri_segment" => 4,
            "per_page" => $per_page,
            "base_url" => base_url("admin/transaction/index/"),
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
            $type = $this->input->post("type") ? escape_string($this->input->post("type")) : "name";
            $name = escape_string($this->input->post("search"));
            $input['like'] = array($type,$name);
        }

        $list = $this->transaction_model->get_list($input);

        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['list'] = $list;
        $this->data['per_page'] = $config['per_page'];
        $this->data["action"] = "Danh Sách";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/transaction/index";
        $this->load->view("admin/layout",$this->data);   
    }


    /**
     * Ham xu ly don hang
     */
    public function handlingTransaction(){

        $tran_id = (int)$this->uri->rsegment(3);
        if(!($tran = $this->transaction_model->get_info($tran_id))){
            alert_error("Đơn Hàng không Tồn Tại Không Thể Sử Lý");
            return false;
        }
        $results = $this->order_model->getOrdersById($tran_id);


        if($this->input->post()){
            $this->order_model->update_rule("transaction_id = {$tran_id}",["status" => 1]);
            $this->transaction_model->update($tran_id,["status" => 1]);
        }

        $this->data["tran"] = $tran;
        $this->data["list"] = $results;
        $this->data["action"] = "Xử Lý";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/transaction/handling";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham xoa 1 ban ghi.
     */
    public  function delete(){
        // lay ra id cua admin can xoa.
        $id = intval($this->uri->rsegment(3));
        // thuc hien xoa.
        if($this->del($id)){
            alert_success("Xóa Đơn Hàng Thành Công");
        }else{
            alert_error("Xóa Đơn Hàng Thất Bại");
        }
        redirect(base_url("admin/transaction/"));
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
        $admin = $this->transaction_model->get_info($id);
        if(!$admin){
            alert_error("Đơn Hàng không Tồn Tại Không Thể Xóa");
            return false;
        }
        // neu khong thuc hien xoa.
        if($this->transaction_model->delete($id)){
            return true;
        }
        return false;
    }
} 