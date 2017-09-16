<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/10/2017
 * Time: 2:38 PM
 */

class Upload_library {

    var $CI = '';

    public function __construct(){
        // khoi tao cho bien sieu doi tuong.
        $this->CI =&get_instance();
    }


    /*
     * ham upload 1 file.
     * @param : duong dan upload file,ten truong file.
     */

    public function upload_file($upload_path,$file){

        // neu khong chuyen vao duong dan upload file hoac ten truong file.
        // return false.

        if(!$upload_path || !$file){
            return false;
        }


        // laod ra thu vien upload cua CI.
        $this->CI->load->library("upload",$this->config($upload_path));
        // thuc hien uplaod file.
        if($this->CI->upload->do_upload($file)){
            // neu upload thanh cong thi tra ve ten cua file upload.
            $data = $this->CI->upload->data();
        }else{
            // tra ve loi neu khong up load  thanh cong.
            $data = $this->CI->upload->display_errors();
        }

        return $data;
    }


    /*
     *  Ham upload nhieu file.
     *  @param : duong dan upload file,ten truong file.
     */

    public function upload_multiple_file($upload_path,$file){

        // neu khong chuyen vao duong dan upload file hoac ten truong file.
        // return false.

        if(!$upload_path || !$file){
            return false;
        }
        // laod ra thu vien upload cua CI.
        $this->CI->load->library("upload",$this->config($upload_path));

        // lay ra  mag chua cac file can upload.
        $list = $_FILES[$file];

        // lay ra kich thuoc mang file.
        $size = count($list['tmp_name']);

        $result_name = array();

        // lap mang file va upload.

        for($i = 0; $i < $size; $i++){

            $_FILES['userfile']['name']    = $list['name'][$i]; // ten file thu i
            $_FILES['userfile']['type']    = $list['type'][$i]; // kieu cua file thu i
            $_FILES['userfile']['tmp_name']    = $list['tmp_name'][$i]; // duong dan tam cua file thu i.
            $_FILES['userfile']['size']    = $list['size'][$i]; // kich thuoc cua file thu i.
            $_FILES['userfile']['error']    = $list['error'][$i];   //khai bao loi cua file thu i


            // thuc hien upload ttung file.
            if($this->CI->upload->do_upload()){
                $data = $this->CI->upload->data();
                $result_name[] = $data['file_name'];
            }else{
                return $this->CI->upload->display_errors();
            }
        }

        return $result_name;
    }


    /*
     *  ham cau hinh cac thong so chung.
     */
    public function config($upload_path){

        $config = array(
            'upload_path' => $upload_path,
            'max-size' => 1024,
            'max_height' => 1024,
            'max_length' => 1024,
            'allowed_types' => "jpg|jpeg|png|gif"
        );
        return $config;
    }
} 