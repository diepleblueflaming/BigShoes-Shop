<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/8/2017
 * Time: 5:20 PM
 */

class Home extends MY_Controller{

    public function index(){

        $this->load->model("order_model");

        // lay ra so giao dich
        $this->data["num_of_order"] = $this->get_total_of("order");
        // lay ra so don hang
        $this->data["num_of_transaction"] = $this->get_total_of("transaction");
        // lay ra so lien he
        $this->data["num_of_feedback"] = $this->get_total_of("feedback");
        // lay so admin
        $this->data["num_of_admin"] = $this->admin_model->get_total();

        $this->data["temp"] = "admin/home/dashboard";
        $this->load->view("admin/layout",$this->data);
    }

    public function register(){

        $this->load->model("admin_model");
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
            $this->form_validation->set_rules("re_password","Mật Khẩu Nhập Lại","required|matches[password]");
            $this->form_validation->set_rules("phone","Số Điện Thoại","required|numeric|min_length[10]");

            // chay kiem tra
            if($this->form_validation->run()){

                // lay ra du lieu.
                $data =array();
                $data['username'] = escape_string($this->input->post("username"));
                $data['email'] = escape_string($this->input->post("email"));
                $data['password'] = md5($this->input->post("password"));
                $data['phone'] = $this->input->post("phone");
                $data['created']  = date("Y-m-d H:i:s",time());


                // kiem tra ton tai.
                if(!$this->check_admin($data["username"],$data["email"],$data["phone"])){
                    // neu admin nay da ton tai bao loi ra.
                    goto next;
                }

                // thuc hien them du lieu vao CSDL
                if($this->admin_model->create($data)){
                    $this->data["success"] = true;
                }else {
                    $this->data["success"] = false;
                }
            }
        }

        next :
        $this->data["title"] = "Đăng Kí Thành Viên";
        $this->load->view("admin/home/register",$this->data);
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
                $this->data['errors']['username'] = "Tên Đăng Nhập Đã Tồn Tại";
            }

            if($it->email == $email){
                $this->data['errors']['email'] = "Địa Chỉ Email Đã Tồn Tại";
            }

            if($it->phone == $phone){
                $this->data['errors']['phone'] = "Số Điện Thoại Đã Tồn Tại";
            }
        }

        // neu co loi return false.
        if(isset($this->data['errors'])){
            return false;
        }
        return true;
    }

    /**
     * @param string $table
     * @return stdClass[
     *          'processed' :
     *          'total'  :
     *      ]
     */
    public function get_total_of($table = ""){

        $query = "SELECT count(id) as processed,(SELECT count(id) as total FROM   `{$table}`) as total
                  FROM `{$table}` where status = 1";
        $model = $table."_model";
        $re = $this->{$model}->query($query);
        return $re[0];
    }


    /**
     *  Ham login
     */
    public function login(){

        $this->load->model("admin_model");
        $this->load->library("form_validation");
        $this->load->helper(array("form","security"));
        $errors = [];

        if($this->input->post()) {

            $this->form_validation->set_rules("email", "Email", "required|valid_email");
            $this->form_validation->set_rules("password",  "Mật Khẩu" ,"required");

            if ($this->form_validation->run()) {

                $errors = [
                    "email" => "Email không tồn tại",
                    "password" => "Mật khẩu không hợp lệ"
                ];

                $email = escape_string($this->input->post("email"));
                $password = md5(escape_string($this->input->post("password")));

                $query = "SELECT email,password,id,username,avatar FROM admin WHERE email = '{$email}' OR password = '{$password}'";
                $r = $this->admin_model->query($query);
                if ($r) {
                    foreach ($r as $it) {
                        //trigger($r);
                        if ($it->email == $email) {
                            foreach ($r as $i) {
                                if (($i->email == $email) && ($i->password == $password)) {
                                    $this->session->set_userdata("admin", [
                                        "id" => $i->id,
                                        "username" => $i->username,
                                        "avatar" => $i->avatar
                                    ]);
                                    redirect(base_url("admin/"));
                                }
                            }
                            unset($errors["email"]);
                            goto next;
                        }
                    }
                    unset($errors["password"]);
                }
                unset($errors["password"]);
            }
        }

        next:
        $this->data["errors"] = $errors;
        $this->data["title"] = "Đăng Nhập";
        // neu co thong bao lay ra thong bao.;
        $this->load->view("admin/home/login",$this->data);
    }


    /**
     * Ham dang xuat
     */
    public function logout(){

        if($this->session->userdata("admin")){
            $this->session->unset_userdata("admin");
        }
        redirect(base_url("admin/"));
    }
} 