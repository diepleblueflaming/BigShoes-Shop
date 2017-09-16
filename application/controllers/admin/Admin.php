<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/9/2017
 * Time: 8:22 AM
 */

class Admin extends MY_Controller{

    public function __construct(){
        parent::__construct();
        // load ra model admin.
        $this->load->model("admin_model");

        // gan tieu de.
        $this->data['title'] = "Quản Lý Admin";
    }


    // ham lay ra thong tin cua cac quan tri vien.
    public function index(){

        // lay du lieu tu database.
        $total = $this->admin_model->get_total();

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
            "base_url" => base_url("admin/admin/index/"),
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
            $type = $this->input->post("type") ? escape_string($this->input->post("type")) : "username";
            $name = escape_string($this->input->post("search"));
            $input['like'] = array($type,$name);
        }

        $list = $this->admin_model->get_list($input);

        // day du lieu qua view.
        $this->data['total'] = $total;
        $this->data['list'] = $list;
        $this->data['per_page'] = $config['per_page'];
        $this->data["action"] = "Danh Sách";
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        // load view.
        $this->data['temp'] = "admin/admin/index";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham hien thi profile cua admin
     */

    public  function profile(){

        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // lay ra id cua admin.
        $id = intval($this->uri->rsegment(3));

        $info = $this->admin_model->get_info($id);

        if(!$info){
            alert_error("Admin Không Tồn Tại");
            redirect(base_url("admin/admin/"));
        }

        // load view.
        // neu co thong bao lay ra thong bao.
        $this->data['message'] = $this->session->flashdata("message");
        $this->data['info'] = $info;
        $this->data['action'] = "Tiểu Sử";
        $this->data['temp'] = "admin/admin/profile";
        $this->load->view("admin/layout",$this->data);
    }
    /*
     * ham them admin moi.
     */

    public function add(){

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));


        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("username","Tên Đăng Nhập",
                "required|xss_clean|callback_valid_str|min_length[6]");
            $this->form_validation->set_rules("email","Địa chỉ email","required|valid_email");
            $this->form_validation->set_rules("password","Mật Khẩu","required");
            $this->form_validation->set_rules("re-password","Mật Khẩu Nhập Lại","required|matches[password]");
            $this->form_validation->set_rules("phone","Số Điện Thoại","required|numeric|min_length[10]");

            // neu co dien cac thong tin them.
            $address = $this->input->post("address");
            $introduction = $this->input->post("introduction");
            $full_name = $this->input->post("full_name");

            if(!empty($address)){
                $this->form_validation->set_rules("address","Địa Chỉ","callback_valid_str|xss_clean");
            }

            if(!empty($introduction)){
                $this->form_validation->set_rules("introduction","Lời Giới Thiêu","xss_clean");
            }

            if(!empty($full_name)){
                $this->form_validation->set_rules("full_name","Họ Tên","xss_clean|callback_valid_str|min_length[10]");
            }

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['username'] = escape_string($this->input->post("username"));
                $data['email'] = escape_string($this->input->post("email"));
                $data['password'] = md5($this->input->post("password"));
                $data['phone'] = $this->input->post("phone");
                $data['created']  = date("Y-m-d H:i:s",time());
                $data['active'] = substr(md5(uniqid(rand(),true)),0,30);


                if(!empty($address)){
                    $data['address'] = escape_string($address);
                }

                if(!empty($introduction)){
                    $data['introduction'] = escape_string($introduction);
                }

                if(!empty($full_name)){
                    $data['full_name']= escape_string($full_name);
                }

                // neu co upload anh dai dien.
                if(!empty($_FILES['avatar']['name'])) {
                    //  thuc hien upload file
                    // thuc hien load ra thu vien upload.
                    $this->load->library("upload_library");
                    $upload_result = $this->upload_library->upload_file("./upload/admin/avatar/", "avatar");

                    // neu upload that bai thuc hien bao loi.
                    if (!isset($upload_result['file_name'])) {
                        $this->data["error"]["avatar"] = $upload_result;
                        goto next;
                    }

                    // lay ra ten anh da upload.
                    $image_link = $upload_result['file_name'];
                    $data['avatar'] = $image_link;
                }

                // kiem tra ton tai.
                if(!$this->check_admin($data["username"],$data["email"],$data["phone"])){
                    // neu admin nay da ton tai bao loi ra.
                    goto next;
                }

                // thuc hien them du lieu vao CSDL
                if($this->admin_model->create($data)){

                    alert_success("Thêm mới admin Thành Công");
                }else{
                    alert_error("Thêm Mới admin Thất Bại");
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/admin/"));
            }
        }

         next :
        // load view.
        $this->data['temp'] = "admin/admin/add_or_update";
        $this->data["action"] = "Thêm Mới";
        $this->load->view("admin/layout",$this->data);
    }

    /*
     *  Ham Sua admin.
     */

    public function edit(){

        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // lay ra hanh dong.
        $ac = escape_string($this->uri->rsegment(4));

        // lay ra id cua admin can sua.
        $id = intval($this->uri->rsegment(3));
        $admin = $this->admin_model->get_info($id);
        // neu admin kkhong ton tai chuyen huong ve trang danh sach.
        if(!$admin){
            redirect(base_url("admin/admin/"));
        }

        // neu co submit form
        if($this->input->post()){

            // gan validate cho cac truong du lieu.
            $this->form_validation->set_rules("username","Tên Đăng Nhập",
                "required|xss_clean|callback_valid_str|min_length[3]");
            $this->form_validation->set_rules("email","Địa chỉ email","required|valid_email");
            $this->form_validation->set_rules("phone","Số Điện Thoại","required|numeric|min_length[10]");

            // neu co dien cac thong tin them.
            $address = $this->input->post("address");
            $introduction = $this->input->post("introduction");
            $full_name = $this->input->post("full_name");
            $password = $this->input->post("password");

            if(!empty($address)){
                $this->form_validation->set_rules("address","Địa Chỉ","callback_valid_str|xss_clean");
            }

            if(!empty($introduction)){
                $this->form_validation->set_rules("introduction","Lời Giới Thiêu","xss_clean");
            }

            if(!empty($full_name)){
                $this->form_validation->set_rules("full_name","Họ Tên","xss_clean|callback_valid_str|min_length[10]");
            }

            // neu thay doi mat khau.
            if($password){
                $this->form_validation->set_rules("password","Mật Khẩu","required");
                $this->form_validation->set_rules("re-password","Mật Khẩu Nhập Lại","required|matches[password]");
            }

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['username'] = escape_string($this->input->post("username"));
                $data['email'] = escape_string($this->input->post("email"));
                $data['phone'] = $this->input->post("phone");


                if(!empty($address)){
                    $data['address'] = escape_string($address);
                }

                if(!empty($introduction)){
                    $data['introduction'] = escape_string($introduction);
                }

                if(!empty($full_name)){
                    $data['full_name']= escape_string($full_name);
                }

                if($password){
                    $data['password'] = md5($this->input->post("password"));
                }

                // neu sua anh dai dien.
                if(!empty($_FILES['avatar']['name'])) {
                    //  thuc hien upload file
                    // thuc hien load ra thu vien upload.
                    $this->load->library("upload_library");
                    $upload_result = $this->upload_library->upload_file("./upload/admin/avatar/", "avatar");

                    // neu upload that bai thuc hien bao loi.
                    if (!isset($upload_result['file_name'])) {
                        $this->data["error"]["avatar"] = $upload_result;
                        goto next;
                    }

                    // lay ra ten anh da upload.
                    $image_link = $upload_result['file_name'];
                    $data['avatar'] = $image_link;

                    // xoa anh cu neu co.
                    if($admin->avatar){
                        if(file_exists("./upload/admin/avatar/".$admin->avatar)){
                            unlink("./upload/admin/avatar/".$admin->avatar);
                        }
                    }
                }

                // kiem tra ton tai.
                if(!$this->check_admin($data["username"],$data["email"],$data["phone"],$id)){
                    // neu admin nay da ton tai bao loi ra.
                    goto next;
                }

                // thuc hien them du lieu vao CSDL
                if($this->admin_model->update($id,$data)){

                    alert_success("Chỉnh Sửa Thành Công");
                }else{
                    alert_error("Chỉnh Sửa Thất Bại");
                }

                if($ac === "profile"){
                    redirect(base_url("admin/admin/profile/".$id));
                }

                // dieu huong ve trang danh sach.
                redirect(base_url("admin/admin/"));
            }
        }

        next :
        // load view.
        if($ac === "profile"){
            $this->data['temp'] = "admin/admin/profile";
        }else{
            $this->data['temp'] = "admin/admin/add_or_update";
        }

        $this->data['info'] = $admin;
        $this->data["action"] = "Chỉnh Sửa";
        $this->load->view("admin/layout",$this->data);
    }

    // ham kiem tra su ton tai admin
    public function check_admin($username,$email,$phone,$id=0){

        // neu truyen vao id
        $id = $id ? " AND id != ".$id : "";

        $input = array(
            "where" => " (username = '{$username}' OR email = '{$email}' OR phone = '{$phone}') {$id}"
        );

        // truy van lay du lieu.
        $r = $this->admin_model->get_list($input);
        // lap danh sach tra ve.
        foreach($r as $it){

            if($it->username == $username){
                $this->data['error']['username'] = "Tên Đăng Nhập Đã Tồn Tại";
            }

            if($it->email == $email){
                $this->data['error']['email'] = "Địa Chỉ Email Đã Tồn Tại";
            }

            if($it->phone == $phone){
                $this->data['error']['phone'] = "Số Điện Thoại Đã Tồn Tại";
            }
        }

        // neu co loi return false.
        if(isset($this->data['error'])){
            return false;
        }

        return true;
    }


    /*
     *  Ham xoa 1 ban ghi.
     */

    public  function delete(){

        // lay ra id cua admin can xoa.
        $id = intval($this->uri->rsegment(3));

        // thuc hien xoa.
        if($this->del($id)){
            alert_success("Xóa Admin Thành Công");
        }else{
            alert_error("Xóa admin Thất Bại");
        }
        redirect(base_url("admin/admin/"));
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
        $admin = $this->admin_model->get_info($id);

        if(!$admin){
            alert_error("Admin không Tồn Tại Không Thể Xóa");
            return false;
        }

        // neu co anh dai dien thi xoa anh.
        if($admin->avatar){
            if(file_exists("./upload/admin/avatar/".$admin->avatar)){
                unlink("./upload/admin/avatar/".$admin->avatar);
            }
        }

        // neu khong thuc hien xoa.
        if($this->admin_model->delete($id)){
            return true;
        }

        return false;
    }
}


