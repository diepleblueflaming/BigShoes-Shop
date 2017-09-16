

$(document).ready(function(){

    // ham check tat ca cac o checkbox khi nhan check_all.
    $('#check_all').change(function () {
        $('.check_box  input:checkbox').prop('checked', this.checked);
    });


    // ham xu ly su kien khi thay doi so ban ghi hien thi.
    $("#change_num_record").change(function(){
        $(this).parent().submit();
        return false;
    });

    // ham gan background cho cac the tr.
    $("input[type = checkbox ]").change(function(){
        // thay doi mau cho cac the tr da dc  chcn.
        var ids = $('input[type=checkbox]:checked').map(function (_, el) {
            return $(el).val();
        }).get();

        // gan lại tat cac background cho cac the tr.
        $(".tr_check").css("background","none");

        // cac the nao da duoc chon thi gan background.
        $(ids).each(function(key,val){
            if(jQuery.isNumeric(val)){
                $("#rows_"+val).css("background","#DEEEFA");
            }
        })
    })

    // Goi ham xoa cac muc da chon.
    delete_selected();

    // sort table user .
    $("#dataTable").DataTable({
        "searching" : false,
        "paging" : false,
        "info" : false
    });

    sort("myTable");

    $("#feedbackTable").DataTable({
        "paging" : false,
        "info" : false
    });


    // goi ham them chuyen muc.
    add_catalog();

    //goi ham xu ly su kien khi nhan nut huy bo
    handler_cancel();

    // goi ham xu ly su kien xoa chuyen muc.
    handler_delete();

    // goi ham xu ly su kien thay doi trang thai chuyen muc.
    change_status();

    // goi ham sua chuyen muc.
    edit_category();

    // ham xu ly tim kiem.
    handler_search_prodduct();

    remove_sort();
})


// ham xoa cac muc da chon.
function delete_selected(){

    $("#delete_selected").click(function() {
        // lay ra mang id.
        var ids = $('.check_box input[type=checkbox]:checked').map(function (_, el) {
            return $(el).val();
        }).get();

        // gui ajax request de xoa.
        var uri = window.location.href;
        uri = uri+"delete_selected/";

        $.post(uri,{ids : ids},function(res){
            for (var key in res){
                // kiem tra xem thuoc tinh nay co trong doi tuong hay khong.
                if(res.hasOwnProperty(key)) {
                    // an di cac muc da xoa.
                    if (jQuery.isNumeric(key)) {
                        $("#rows_" + res[key]).slideUp(1000);
                        var row_detail = $("#row_detail_"+res[key])
                        if(!jQuery.isEmptyObject(row_detail)){
                            row_detail.slideUp(1000);
                        }
                    } else {
                        if (key == "success") {
                            $("#alerts").addClass("alert alert-success");
                            $("#alerts").html("<h4><i class='fa fa-check'>Success!</i></h4>"+ res[key]);
                        } else {
                            $("#alerts").addClass("alert alert-danger");
                            $("#alerts").html("<h4><i class='fa fa-ban'>Failed!</i></h4>"+ res[key]);
                        }
                    }
                }
            };
            // end for in.
        },"json");
        // end post request.
    });
    // end function click.
}

function add_catalog(){

    reset();

    $(".add_catalog").click(function(){

        $(".submit_catalog").unbind("click");

        // khi nhan nut them moi
        $(".submit_catalog").click(function(){
            // lay ra id cua chuyen muc cha.
            var id = parseInt($(this).attr("id"));
            var parent_id = $("#parent_id_"+id).val();
            var title = $("#input_title_"+id).val();
            var position = $("#input_position_"+id).val();
            var site_title = $("#input_site_title_"+id).val();

            var uri = base_url()+"catalog/add/";

           // gui du lieu len server.
            $.post(uri,{parent_id : parent_id,title : title, position : position,site_title : site_title},
                function(res){

                // reset loi nhap du lieu.
                $("#err_title_"+id).html("");
                $("#err_position_"+id).html("");
                $("#err_site_title_" + id).html("");

                if(typeof(res.success) != "undefined"){
                    $("#alert_"+id).html(res.success);

                }else if(typeof(res.failed) != "undefined"){
                    $("#alert_"+id).html(res.failed);
                }

                // gan loi nhap du lieu.
                $("#err_title_"+id).html(res.title);
                $("#err_position_"+id).html(res.position);
                $("#err_site_title_" + id).html(res.site_title);

            },"json");
            // end post.
        })
    });
}

// xu ly su kien khi nhan nut huy bo.
function handler_cancel(){
    $(".cancel").click(function(){
        var id = $(this).attr("id");
        $("#add_"+id).removeAttr("aria-expanded");
       $("#add_"+id).removeClass("in");
    });
}

// ham tra ve url chung.
function base_url(){
    return "http://diepledev.tk/admin/";
}

// ham xu ly su kien xoa.
function handler_delete(){

    // xu li khi nhan nut xoa.
    $(".cat_delete").click(function() {
        // xac nhan truoc khi xoa.
        if(confirm("Bạn Có Muốn Xóa Chuyên Mục Này")) {
            // lay ra id cua chuyen muc can xoa.
            var id = $(this).attr("id");

            // url xoa.
            var url = base_url() + "catalog/check/";

            // gui request len server.
            $.post(url, {id: id}, function (res) {

                //  neu chuyen muc can xoa co chuyen muc con xac nhan lai.
                if (typeof(res.confirm) != "undefined") {

                    // neu user van muon xoa.
                    if (confirm(res.confirm)) {
                        var uri = base_url() + "catalog/delete/";
                        // gui request lenn server.
                        $.post(uri, {id: id}, function (res) {
                            alert(res.alerts);
                        }, "json"); // / $.post
                    }// / if confirm
                }// / if xac nhan loi.
                else{
                    // neu khong co chuyen muc con .xoa luon.
                    if(typeof(res.alerts) != "undefined"){
                        alert(res.alerts);
                    }
                }
            }, "json");
        }
    });
}

// ham xu ly su kien thay doi trang thai chuyen muc.

function change_status(){

    // lay ra trang thai hien tai.
    $(".change_status").click(function(){
        var info  = $(this).attr("id");
        var arr = info.split("_");
        var ele = $(this);
        var url = window.location.href + "changeStatus/";
        // gui request len server.
        $.post(url,{id : arr[1], status : arr[0]},function(res){

            if(typeof(res.error) != "undefined"){

            }else{
                $("#"+arr[0]+"_"+arr[1]).html(res.status);
                $("#"+arr[0]+"_"+arr[1]).attr("id",res.num+"_"+arr[1]);
            }
        },"json");
    });
}



// ham sua chuyen muc.
function edit_category(){

    change_content_submit_button("Chỉnh Sửa");

    // xu ly su kien khi nhan nut xoa.
    $(".edit_catalog").click(function(){

        // lay ra id cua chuyen muc can sua.
        var id = $(this).attr("id");

        // lay ra thong tin chuyen muc can sua.
        var title = $("td#title_"+id).html();
        var position = $("td#position_"+id).html();
        var site_title = $("td#site_title_"+id).html();

        reset_input();

        // gan du lieu vao cac truong input.
        $("input#input_title_"+id).val(title);
        $("input#input_position_"+id).val(position);
        $("input#input_site_title_"+id).val(site_title);


        // xoa bo sua kien click ban dau.
        $(".submit_catalog").unbind("click");

        // xu ly su kien khi nhan nut chinh sua.
        $(".submit_catalog").click(function() {

            // lay lai noi dung tieu de va vi tri nguoi dung chinh sua.
            title = $("#input_title_"+id).val();
            position  = $("#input_position_"+id).val();
            site_title  = $("#input_site_title_"+id).val();

            var uri = base_url() + "catalog/edit/";

            $.post(uri,{id: id, title: title, position: position,site_title : site_title},
                function(res){

                // reset loi nhap du lieu.
                $("#err_title_" + id).html("");
                $("#err_position_" + id).html("");
                $("#err_site_title_" + id).html("");

                if (typeof(res.success) != "undefined") {
                    $("#alert_" + id).html(res.success);

                } else if (typeof(res.failed) != "undefined") {
                    $("#alert_" + id).html(res.failed);
                } else if (typeof(res.alert) != "undefined") {
                    $("#alert_" + id).html(res.alert);
                }

                // gan loi nhap du lieu.
                $("#err_title_" + id).html(res.title);
                $("#err_position_" + id).html(res.position);
                $("#err_site_title_" + id).html(res.site_title);

            }, "json");
        }); // ket thuc ham xu ly click.
    });
}

// ham reset lai tat cac ca truong input.
function reset_input(){
    $("input:not(.btn,[type=hidden])").val("");
}

// reset cac truong input khi nhan nut them moi
function reset(){
    $(".add_catalog").click(function(){
       reset_input();
        // thay doi noi dung nut submit
        change_content_submit_button("Thêm Mới");
    });
}

// ham thay doi noi dung nut submit.
function change_content_submit_button(content){
    $(".submit_catalog").val(content);
}

// ham su ly tim kiem.
function handler_search_prodduct() {

    // kiem tra cookie de hien thi form da loc theo.
    var type = document.cookie;
    var arr = type.split(";");
    type = arr[0].substr(type.indexOf("=")+1);
    $("#search_product").css("visibility", "visible");
    $(".search_input").hide();

    type == "price" ? $(".search_"+type).show() : $("#search_"+type).show();
    if(type !== "no"){
        $("#search_tool").val(type);
    }

    $("#search_tool").change(function () {

        // gan cookie de kiem tra xem loc theo phuong thuc nao.
        $(".search_input").hide();
        var val = $(this).val();
        val == "price" ? $(".search_"+val).show() : $("#search_"+val).show();
        document.cookie = "filter="+val;
    });

    $(".search_price").change(function(){
        if($("#search_price_to").val() && $("#search_price_from").val()){
            $("#form_search_product").submit();
            return false;
        }
    });

    // tu dong submit form khi yim kiem.
    $("#search_catalog").change(function () {
        $("#form_search_product").submit();
        return false;
    });

}

function remove_sort(){
    $("th[id^='no_sort']").removeClass("sorting").unbind("click");
    $("th[id^='no_sort']").removeClass("sorting_asc").unbind("click");
}
