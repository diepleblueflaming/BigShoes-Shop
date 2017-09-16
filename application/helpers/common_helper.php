<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/8/2017
 * Time: 5:09 PM
 */

$CI = &get_instance();

// ham tr ve url den thu muc public.
/**
 * @param string $url
 * @return string
 */
function public_url($url = ""){
    return base_url("public/".$url);
}


// ham validate chuoi string.
/**
 * @param $string
 * @return bool
 */
function validate_string($string){
  global $CI;
    $str = "~!@#$%^&*()-+={}[]|\\/:;'.,/?`";
    for($i =0; $i < strlen($string); $i++){
        if(strpos($str,$string[$i]) > 0){
            $CI->form_validation->set_message("valid_str","Chuỗi bạn nhập có kí tự đặc biệt");
            return false;
        }
    }
    return true;
}

// ham in du lieu.
/**
 * @param $data
 */
function trigger($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;
}

// ham escape chuoi cho truoc
/**
 * @param $str
 * @return string
 */
function escape_string($str){
    global $CI;
    return $CI->db->escape_str($str);
}

/**
 * @param $message
 */
function alert_error($message){
    global $CI;
   $alert = "<div class='alert alert-danger'><h4><i class='icon fa fa-ban'></i>Failed!</h4>"
    .$message."</div>";

    $CI->session->set_flashdata("message",$alert);
}

/**
 * @param $message
 */
function alert_success($message){
    global $CI;
       $alert = "<div class='alert alert-success'><h4><i class='icon fa fa-check'></i> Success!</h4>"
        .$message."</div>";
    $CI->session->set_flashdata("message",$alert);
}

/**
 * @param $conf
 * @return array
 */
function config_paging($conf){
    $config = array(
        "num_tag_open" => "<li class='pagination_button'>",
        "num_tag_close" => "</li>",
        "cur_tag_open" => "<li class='pagination_button active'><a href=''>",
        "cur_tag_close" => "</a></li>",
        "next_tag_open" => "<li class='pagination_button'>",
        "next_tag_close" => "</li>",
        "prev_tag_open" => "<li class='pagination_button'>",
        "prev_tag_close" => "</li>",
        "last_tag_open" => "<li class='pagination_button previous'>",
        "last_tag_close" => "</li>",
        "first_tag_open" => "<li class='pagination_button previous'>",
        "first_tag_close" => "</li>",
        "first_link" => "Trang Đầu",
        "last_link" => "Trang Cuối",
        "next_link" => "Next",
        "prev_link" => "Previous"
    );
    return array_merge($conf,$config);
}

/*
 *  ham hien thi anh.
 */

/**
 * @param $url
 * @return string
 */
function show_img($url){
    return "<img width='100px' height='100px' src='".base_url("upload/").$url."'>";
}


/**
 * @param $str
 * @return mixed
 */
function convert_vi_to_en($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/[^A-Za-z0-9 \/\.]/", '', $str);
    $str = preg_replace("/\s+/", '-', $str);
    $str = trim($str);
    return $str;
}

/**
 * @param $stdClass
 * @return array
 */
function convertStdClassToObj($list,$obj){
    $arr = array();

    foreach($list as $i){

        $p = new $obj($i);
        $arr[] = $p;
    }
    return $arr;
}


/**
 * @param $a
 * @param $b
 * @return int
 */
function sort_arr($a,$b){
    return count($a->sub) > count($b->sub) ? -1 : 1;
}

/**
 * @param $paragraph
 * @param int $num_of_word
 * @return string
 */
function getCertainWord($paragraph, $num_of_word = 35)
{
    $paragraph = explode(' ', $paragraph);
    if(count($paragraph) > $num_of_word) {
        $paragraph = array_slice($paragraph, 0, $num_of_word);
        return implode(' ', $paragraph)."....";
    }
    return implode(' ', $paragraph);
}

function getProductUri($uri){
    return base_url("upload/product/".$uri);
}

function getNewsUri($uri){
    return base_url("upload/news/images/".$uri);
}

?>
