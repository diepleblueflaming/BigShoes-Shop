<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/3/2017
 * Time: 3:20 PM
 */

class News extends MY_controller{

    public  function __construct(){

        parent ::__construct();

        // load model
        $this->load->model(array("news_model","admin_model"));

        // gan tieu de.
        $this->data['title'] = "Quản Lý Bài Viết";

    }


    // ham lay ra thong tin cua cac san pham.
    public function index(){

        // lay du lieu tu database.
        $total = $this->news_model->get_total();

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
            "base_url" => base_url("admin/news/index/"),
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
            $type = $this->input->post("type") ? escape_string($this->input->post("type")) : "title";
            $name = escape_string($this->input->post("search"));
            $input['like'] = array($type,$name);
        }

        // join hai bang news va catalog.
        $input['select'] = "news.*,admin.username as sender";
        $input['join'] = array('news','admin','news.admin_post_id = admin.id');

        $list = $this->news_model->get_list($input);
        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['list'] = $list;
        $this->data['per_page'] = $config['per_page'];
        $this->data["action"] = "Danh Sách";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/news/index";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham Them Moi San pham
     */
    public function add(){
        $this->session->set_userdata("uploadDir","news");
        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));


        // neu co submit form
        if($this->input->post()){
            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("title","Tên Bài Viết",
                "required|xss_clean|min_length[10]");
            $this->form_validation->set_rules("summary_content","Nội Dung Tóm Tắt","required|xss_clean");
            $this->form_validation->set_rules("content","Nội Dung Chi Tiết","required|xss_clean");
            $this->form_validation->set_rules("image_link","Ảnh Đại Diện","callback_choose_file");

            // chay kiem tra
            if($this->form_validation->run()){

                // kiem tra ton tai.
                if(!$this->check_title($this->input->post("title"))){
                    // neu ten bai viet nay da ton tai bao loi ra.
                    goto next;
                }

                // thuc hien upload anh dai dien.
                $this->load->library("upload_library");
                $result = $this->upload_library->upload_file("./upload/news/images/","image_link");

                // neu khong upload thanh cong thuc hien bao loi ve nguoi dung
                if(!isset($result['file_name'])){
                    $this->data['error']['image_link'] = $result;
                    goto next;
                }else{
                    // neu khong thuc hien lay ra ten file da upload.
                    $image = $result['file_name'];
                }

                // lay ra du lieu.
                $data =[];
                $data['title'] = escape_string($this->input->post("title"));
                $data['content'] = $this->input->post("content");
                $data['summary_content'] = htmlspecialchars($this->input->post("summary_content"));
                $data['image_link'] = $image;
                $data['admin_post_id'] = 15;
                $data['created'] = date("Y-m-d H:i:s",time());

                // thuc hien them du lieu vao CSDL
                if($this->news_model->create($data)){

                    alert_success("Thêm mới Bài Viết Thành Công");
                }else{
                    alert_error("Thêm Mới Bài Viết Thất Bại");
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/news/"));
            }
        }

        next :
        // load view.
        $this->data['temp'] = "admin/news/add_or_update";
        $this->data["action"] = "Thêm Mới";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham Them Moi San pham
     */
    public function edit(){


        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // lay ra id cua san pham can sua.
        $id = $this->uri->rsegment(3);

        $info  = $this->news_model->get_info($id);

        // neu khong ton tai san pham. bao loi ve trang danh sach.
        if(!$info){
            alert_error("Bài Viết Không Tồn Tại");
            redirect(base_url("admin/news"));
        }

        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("title","Tên Bài Viết",
                "required|xss_clean|min_length[10]");
            $this->form_validation->set_rules("summary_content","Nội Dung Tóm Tắt","required|xss_clean");
            $this->form_validation->set_rules("content","Nội Dung Chi Tiết","required|xss_clean");

            // chay kiem tra
            if($this->form_validation->run()){

                // kiem tra ton tai.
                if(!$this->check_title($this->input->post("title"), $id)){
                    // neu ten san pham nay da ton tai bao loi ra.
                    goto next;
                }

                // lay ra du lieu.
                $data =array();
                $data['title'] = escape_string($this->input->post("title"));
                $data['content'] = $this->input->post("content");
                $data['summary_content'] = htmlspecialchars($this->input->post("summary_content"));

                // neu co thay doi anh dai dien
                if($this->choose_file()){

                    // thuc hien xoa anh dai dien cu.
                    $this->delete_img("./upload/news/".$info->image_link);

                    // thuc hien upload anh dai dien.
                    $this->load->library("upload_library");
                    $result = $this->upload_library->upload_file("./upload/news/images/","image_link");

                    // neu khong upload thanh cong thuc hien bao loi ve nguoi dung
                    if(!isset($result['file_name'])){
                        $this->data['error']['image_link'] = $result;
                        goto next;
                    }else{
                        // neu khong thuc hien lay ra ten file da upload. va thuc hien ma hoa.
                        $image = $result['file_name'];
                        $data['image_link'] = $image;
                    }
                }

                // thuc hien them du lieu vao CSDL
                if($this->news_model->update($id,$data)){

                    alert_success("Chỉnh Sửa Bài Viết Thành Công");
                }else{
                    alert_error("Chỉnh Sửa Bài Viết Thất Bại");
                }
                // dieu huong ve trang danh sach.
                redirect(base_url("admin/news/"));
            }
        }

        next :
        // load view.
        $this->data['info'] = $info;
        $this->data['temp'] = "admin/news/add_or_update";
        $this->data["action"] = "Chỉnh Sửa";
        $this->load->view("admin/layout",$this->data);
    }

    // ham kiem tra su ton tai cua bai viet
    public   function check_title($name, $id = 0){

        // neu truyen vao id
        $id = $id ? " AND id != ".$id : "";
        $input = array(
            "where" => " (title = '{$name}') {$id}"
        );

        // truy van lay du lieu.
        $r = $this->news_model->get_list($input);

        if($r){
            $this->data['error']['title'] = "Tiêu Đề Bài Viết Đã Tồn Tại";
            return false;
        }
        return true;
    }

    // ham kiem tra xem da chon file hay chua.
    public   function choose_file(){
        if(empty($_FILES['image_link']['tmp_name'])){
            $this->form_validation->set_message("choose_file","Bạn Chưa Chon File");
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
            alert_success("Xóa Bài Viết Thành Công");
        }else{
            alert_error("Xóa Bài Viết Thất Bại");
        }
        redirect(base_url("admin/news/"));
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
        $news = $this->news_model->get_info($id);
        if(!$news){
            alert_error("Bài Viết không Tồn Tại Không Thể Xóa");
            return false;
        }
        // neu co anh thuc hien xoa anh.
        if($news->image_link){
            $this->delete_img("upload/news/images/".$news->image_link);
        }
        // neu khong thuc hien xoa.
        if($this->news_model->delete($id)){
            return true;
        }

        return false;
    }

} 
