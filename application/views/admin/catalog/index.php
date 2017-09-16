<?php
/*
*  ham chuyen doi danh sach chuyen muc ve dang html
*/
    function show_catalog($list,$parent_id){

    // lay ra tat ca cac chuyen muc co parent_id da cho.
    // mag chua cac chuyen muc co parent_id = $parent_id.
    $result= array();

    // lay ra danh sach cac chuyen muc co parent_id = $parent_id
    foreach($list as $cat){

        if($cat->parent_id == $parent_id){
            $result[] = $cat;
        }
    }

    if($parent_id == 0) {
        echo "<ul class='panel-group tree_view' id='ul_".$parent_id."'>";
    }else{
        echo "<ul class='panel panel-body panel-collapse collapse' id='ul_".$parent_id."'>";
    }
    // lap danh sach cac chuyen muc nay.lay ra cac chuyen muc con cua no.
    if($result){
        foreach($result as $it){
            $parent = "Không Có";
            $has_child = null;

            foreach($list as $item) {
                // kiem tra neu co chuyen muc con
                if ($item->parent_id == $it->id) {
                    $has_child = true;
                }

                // lay ra ten chuyen muc cha.
                if ($it->parent_id == $item->id) {
                    $parent = $item->title;
                }
            }
            ?>
            <li class='panel panel-primary'>
                <div class='panel panel-heading'><?php echo $it->title ?>
                    <!-- danh sach cac hanh dong -->
                    <span class="list_action">
                        <!-- hien thi chuyen muc con -->
                        <a class='btn btn-default'
                             data-toggle='collapse' title="Hiển Thị Chuyên Mục Con"
                             data-target='#ul_<?php echo $it->id?>'
                             data-parent='#ul_<?php echo $it->parent_id?>'>
                            <span class="fa fa-list"></span>
                        </a>
                        <!-- / hien thi chuyen muc con -->

                        <!-- Nut hien thi chi tiet chuyen muc -->
                        <a class="btn btn-warning" title="Chi Tiết"
                            data-target="#info_<?php echo $it->id?>"
                            data-toggle="collapse"
                            data-parent="#ul_<?php echo $parent_id?>">
                            <span class="fa fa-info"></span>
                        </a>
                        <!-- / Nut hien thi chi tiet chuyen muc -->

                        <!-- Xoa chuyen muc -->
                        <a class="btn btn-danger cat_delete" id="<?php echo $it->id?>" >
                            <span class="fa fa-remove"></span>
                        </a>
                        <!-- / Xoa chuyen muc -->
                    </span>
                    <!-- / danh sach cac hanh dong -->
                </div>
                <!-- Hien thi Chi Tiet -->
                <div class="panel panel-body panel-collapse collapse" id="info_<?php echo $it->id?>">
                <table class="table table-bordered">
                    <thead>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Chuyên Mục Cha</th>
                        <th>Vị Trí</th>
                        <th>Site Title</th>
                        <th>Trạng Thái</th>
                    </thead>
                    <tbody>
                        <td><?php echo $it->id?></td>
                        <td id="title_<?php echo $it->id?>"><?php echo $it->title?></td>
                        <td><?php echo $parent?></td>
                        <td id="position_<?php echo $it->id?>"><?php echo $it->position?></td>
                        <td id="site_title_<?php echo $it->id?>"><?php echo $it->site_title?></td>
                        <?php $status = ($it->status == 1) ? "Disable" : "Active"?>
                        <td>
                            <a class="btn btn-default btn-flat change_status"
                                   id="<?php echo $it->status."_".$it->id?>">
                                   <?php echo $status?>
                            </a>
                        </td>
                    </tbody>
                </table>
                </div>
                <!-- / chi tiet -->

                <?php show_catalog($list,$it->id);?>
            </li>
        <?php
        }
    } // end if(result);
?>
        <li class='panel panel-default panel-heading' >
            <!-- nut them moi chuyen muc -->
            <a class="btn btn-default add_catalog " data-target="#add_<?php echo $parent_id?>"
                data-toggle="collapse"
                data-parent="#ul_<?php echo $parent_id?>">
                <span class='fa fa-plus'></span> Thêm Mới Chuyên Mục
            </a>

            <!-- nut them moi chuyen muc -->

            <!-- Nut sua chuyen muc -->
            <?php if($parent_id != 0): ?>
            <a class="btn btn-default edit_catalog" data-target="#add_<?php echo $parent_id?>"
               data-toggle="collapse"
               data-parent="#ul_<?php echo $parent_id?>" id="<?php echo $parent_id?>">
                <span class='fa fa-edit'></span> Sửa Chuyên Mục
            </a>
            <?php endif?>
            <!-- / Nut Sua chuyen muc -->
        </li>

        <!-- Phan Them Mơi chuyen muc con -->
        <div class="panel panel-body panel-collapse collapse" id="add_<?php echo $parent_id?>">
            <form class="form-horizontal">
                <div class="col-sm-10 col-sm-offset-2" id="alert_<?php echo $parent_id?>"></div>
                <input type="hidden" name="parent_id" value="<?php echo $parent_id?>"
                       id="parent_id_<?php echo $parent_id?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input_title">Tiêu Đề</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="input_title_<?php echo $parent_id?>"
                               class="form-control">
                        <div class="error" id="err_title_<?php echo $parent_id?>"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input_position">Vị Trí</label>
                    <div class="col-sm-10">
                        <input type="text" name="position" id="input_position_<?php echo $parent_id?>"
                               class="form-control">
                        <div class="error" id="err_position_<?php echo $parent_id?>"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input_site_title">Site Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="site_title" id="input_site_title_<?php echo $parent_id?>"
                               class="form-control">
                        <div class="error" id="err_site_title_<?php echo $parent_id?>"></div>
                    </div>
                </div>

                <div class="col-sm-10 col-sm-offset-2">
                    <input type="button" class="submit_catalog btn btn-success"
                           value="Thêm Mới" id="<?php echo $parent_id?>">
                    <input type="reset" class="cancel btn btn-danger" value="Hủy Bỏ" id="<?php echo $parent_id?>">
                </div>
            </form>
        </div>
        <!-- / ket thuc phan them moi -->
   </ul>
    <?php
    } // end ham show_catalog();
?>

<!-- load ra phan head -->
<?php $this->load->view("admin/catalog/head")?>

<div class="col-sm-12">
    <?php show_catalog($list,0) ?>
</div>
