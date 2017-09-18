<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/3/2017
 * Time: 9:29 AM
 */

class User extends MY_controller{

    public function __construct(){
        parent::__construct();
        $this->load->model(['user_model','admin_model']);
    }

    /**
     *  Hàm xử lý đăng nhập
     */
    public function login(){

        $is_manager = false;
        $this->load->library("form_validation");
        $error = [
            "username" => "Tên Đăng Nhập Không Tồn Tại",
            "password" => "Mật Khẩu Không Phù Hợp"
        ];

        $name = $this->input->post("lg_name");
        $pass = $this->input->post("lg_pass");


        $this->form_validation->set_rules("lg_name","Tên đăng nhập","required|callback_valid_str");
        $this->form_validation->set_rules("lg_pass","Mật khẩu","required|callback_valid_str");


        if(!$this->form_validation->run()){
            $error["username"] = validation_errors()["lg_name"];
            $error["password"] = validation_errors()["lg_pass"];
            goto next;
        }

        $pass = md5($pass);

        // kiem tra co la thanh vien ?
        $result = $this->user_model->get_info_rule(["username" => $name, "active" => '']," id");
        // neu ten dang nhap ton tai
        if($result){
            unset($error["username"]);
            // kiem tra mat khau co phu hop ?
            $result = $this->user_model->get_info_rule(["username" => $name,"password" => $pass],"id,username");
            if($result){
                goto set_login;
            }
        }


        // kiem tra xem co la admin ?
        $result = $this->admin_model->get_info_rule(["username" => $name, "active" => NULL]," id");

        if($result){
            if(isset($error["username"])){
                unset($error["username"]);
            }
            $result = $this->admin_model->get_info_rule(["username" => $name,"password" => $pass],"id,username");
            if($result){
                $is_manager = true;
                goto set_login;
            }else{
                goto next;
            }
        }else{
            goto next;
        }


        set_login :
        $error = [];
        $this->session->set_userdata("user",[
            "id" => $result->id,
            "name" => $result->username,
            "role" => $is_manager
        ]);
        $error['name'] = $name;

        next :
        exit(json_encode($error));
    }

    /*
     * ham Dang ki Thanh Vien.
     */

    public function add(){

        $alert = [];

        // neu co submit form
        if($this->input->post()){

            $name = $this->input->post("name",true);
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $phone  = $this->input->post("phone");

            $isValidName = validate_string($name);
            $isValidEmail = preg_match("/^\w+([\.-]?\w+)*@([\.-]?\w+)*(\.\w{2,3})+$/",$email);
            $isValidPassword  = validate_string($password);
            $isValidPhone = preg_match("/^[0-9]{9,12}$/",$phone);

            if(!$isValidName || !$isValidEmail || !$isValidPassword || !$isValidPhone){
                return;
            }

            $data= [
                "username" => $name,
                "email" => $email,
                "password" => md5($password),
                "created" => date("Y-m-d H:i:s",time()),
                "phone" => $phone,
                "address" => NULL,
                "active" => NULL
            ];

            if($error = $this->check_user($name,$email,$phone)){

                exit(json_encode($error));
            }

            if($this->user_model->create($data)){
                $alert['success'] = "Đăng Kí Thành Công";
            }else{
                $alert['failed'] = "Đăng Kí Thất Bại";
            }
        }

        exit(json_encode($alert));
    }

    /*
     *  Ham Chinh Sua thông tin ca nhan
     */

    public function edit(){

        $errors = [];
        // load ra helper form
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));

        // lay ra id cua user can sua.
        $id = intval($this->session->userdata("user")["id"]);
        $user = $this->user_model->get_info($id);
        // neu user kkhong ton tai chuyen huong ve trang danh sach.

        if(!$user){
            redirect(base_url());
        }

        $input = [];

        // neu thay doi ten dang nhap
        if($this->input->post("btn-submit-username")){
            $this->form_validation->set_rules("username","Tên Đăng Nhập","required|xss_clean|callback_valid_str|min_length[6]");
            $input["username"] = $this->input->post("username");
        }


        // neu co thay doi mat khau
        if($this->input->post("btn-submit-password")){
            $this->form_validation->set_rules("curr_password","Mật Khẩu Hiện Tại","required|callback_valid_str|min_length[5]|max_length[8]");
            $this->form_validation->set_rules("new_password","Mật Khẩu Mới","required|callback_valid_str|min_length[5]|max_length[8]");
            $this->form_validation->set_rules("cof_new_password","Mật Khẩu Xác Nhận","required|callback_valid_str|min_length[5]|max_length[8]");
            $input["password"] = md5($this->input->post("new_password"));
        }

        // neu co thay doi dia chi
        if($this->input->post("btn-submit-address")){
            $this->form_validation->set_rules("address","Địa Chỉ","required|xss_clean|callback_valid_str");
            $input["address"] = $this->input->post("address");
        }

         // neu co thay doi dia chi email
        if($this->input->post("btn-submit-email")){
            $this->form_validation->set_rules("email","Địa chỉ email","required|valid_email");
            $input["email"] = $this->input->post("email");
        }

         // neu co thay doi so dien thoai
        if($this->input->post("btn-submit-phone")){
            $this->form_validation->set_rules("phone","Số Điện Thoại","required|numeric|min_length[10]|max_length[12]");
            $input["phone"] = $this->input->post("phone");
        }


        // neu co submit form
        if($this->input->post()){
            // chay kiem tra
            if($this->form_validation->run()){

                /**
                 *  Neu thay doi mat khau
                 */
                if(isset($input["password"])){

                    // 1. kiem tra xem mat khau hien tai co dung ?
                    if(md5($this->input->post("curr_password")) != $user->password){
                        $errors["curr_password"] = "Mật khẩu hiện tại không đúng";
                        goto next;
                    }else{
                        if($this->input->post("new_password") != $this->input->post("cof_new_password")){
                            $errors["cof_new_password"] = "Mật khẩu nhập lại không đúng";
                            goto next;
                        }
                    }
                }

                // kiem tra ton tai.
                $u = isset($input["username"]) ? $input["username"] : "";
                $e = isset($input["email"]) ? $input["email"] : "";
                $p = isset($input["password"]) ? $input["password"] : "";
                if(($err = $this->check_user( $u,$e,$p,$id))){
                    // neu user nay da ton tai bao loi ra.
                    $errors = $err;
                    goto next;
                }
                // thuc hien them du lieu vao CSDL
                if($this->user_model->update($id,$input)){
                    if($input["username"]){
                        $temp = $this->session->userdata("user");
                        $temp["name"] = $input["username"];
                        $this->session->set_userdata("user",$temp);
                        $errors["has_error"] = false;
                    }
                }
            }else{
                $errors = $this->form_validation->error_array();
            }
        }

        if($errors) {
            next :
            exit(json_encode($errors));
        }

        // load view.
        $this->data['temp'] = "site/user/profile";
        $this->data['info'] = $user;
        $this->data["title"] = "Cập Nhật Thông Tin Cá Nhân";
        $this->load->view("site/layout/layout",$this->data);
    }


    // ham kiem tra su ton tai user
    public function check_user($username,$email,$phone,$id=0){

        $response = [];

        // neu truyen vao id
        $id = $id ? " AND id != ".$id : "";

        $input = array(
            "where" => " (username = '{$username}' OR email = '{$email}' OR phone = '{$phone}') {$id}"
        );

        // truy van lay du lieu.
        $r = $this->user_model->get_list($input);
        // lap danh sach tra ve.
        foreach($r as $it){

            if($it->username == $username){
                $response['username'] = "Tên Đăng Nhập Đã Tồn Tại";
            }

            if($it->email == $email){
                $response['email'] = "Địa Chỉ Email Đã Tồn Tại";
            }

            if($it->phone == $phone){
                $response['phone'] = "Số Điện Thoại Đã Tồn Tại";
            }
        }

        // neu co loi return mang loi.
        if($response){
            return $response;
        }
        return false;
    }

    /**
     *  Đặt lại mật khẩu
     */
    public function setPassword(){

        if(!($email = $this->checkEmail())){
            return;
        }

        $pass = substr(md5(uniqid(rand(0,9999))),0,7);

        $body="Mật Khẩu mới của bạn tại BigShoes là: {$pass} \n\n Bạn có thể sử dụng password này";
        $body.="để đăng nhập vào website của chúng tôi.Thank You";

        if(mail($email,"Retrieve new Password from BigShoes",$body,"FROM : localhost")) {
            $this->user_model->update_rule(["email" => $email],["password" => md5($pass)]);
            die(
                json_encode(["success" => true]));
        }
        else
            die(json_encode(["error" => true]));
    }

    /**
     *  Hàm đăng xuất
     */
    public function logout(){

        if($this->isLogin()){
            $this->session->unset_userdata("user");
        }
    }

    /**
     * Hàm kiểm tra hợp lệ email
     * @return bool|mixed
     */
    public function  checkEmail(){

        $email = $this->input->post("email");
        $isValidEmail = preg_match("/^\w+([\.-]?\w+)*@([\.-]?\w+)*(\.\w{2,3})+$/",$email);

        if(!$isValidEmail){
            return;
        }

        if(!$this->user_model->get_row(["where" => ["email" => $email]])){
            echo (json_encode(["email" => "Email Bạn Vùa Nhập Không Đúng"]));
            return false;
        };
        return $email;
    }

    /*
     * method handling login via facebook
     */
    function login_facebook(){
        $fb_id = $this->input->post("id");
        $name = $this->input->post("name");
        $email = $this->input->post("email");

        $data = [
            "username" => $name,
            "email" => $email,
            "password" => '',
            "created" => date("Y-m-d H:i:s",time()),
            "phone" => '',
            "fb_id" => $fb_id
        ];

        if(!($id = $this->user_model->getUserBy(["fb_id" => $fb_id, "email" => $email], "id"))){
            if(!$this->user_model->create($data)){
                return;
            }
            $id = $this->db->insert_id();
        }

        $this->session->set_userdata('user',[
            'id' => $id,
            'name' => $name,
            'role' => false
        ]);
    }

    function login_google(){

        $google_id = $this->input->post("id");
        $name = $this->input->post("name");
        $email = $this->input->post("email");

        $data = [
            "username" => $name,
            "email" => $email,
            "password" => '',
            "created" => date("Y-m-d H:i:s",time()),
            "phone" => '',
            "google_id" => $google_id
        ];

        if(!($id = $this->user_model->getUserBy(["google_id" => $google_id, "email" => $email], "id"))){
            if(!$this->user_model->create($data)){
                return;
            }
            $id = $this->db->insert_id();
        }

        $this->session->set_userdata('user',[
            'id' => $id,
            'name' => $name,
            'role' => false
        ]);
    }
} 
