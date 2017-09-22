<?php $this->load->view("admin/pcs/head")?>
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php if(isset($message)) : ?>
                <h4><?php echo $message; ?></h4>
            <?php endif?>
            <div id="alerts"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Bảng Thông Tin Sản Phẩm Màu Sắc Kích Thước</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="dataTables_length" id="example1_length"><label>
                                        <form action="<?php echo base_url("admin/product_color_size/")?>" method="post" id="form_search_product">Hiển Thị
                                            <select name="per_page" aria-controls="example1" class="form-control input-sm"
                                                    id="change_num_record">
                                                <?php for($i = 5; $i <= $total; $i= $i + 5) :?>
                                                    <option value="<?php echo $i?>" <?php echo $per_page == $i ? "selected" : ""?>>
                                                        <?php echo $i?>
                                                    </option>
                                                    <option value="<?php echo $total?>" <?php echo $per_page == $total ? "selected" : ""?>>
                                                        <?php echo $total?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select> Bản Ghi</label>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_filter">
                                    <label>
                                        <input class="form-control" type="text" name="search_name" id="search_name" placeholder="Nhập Tên Sản Phẩm">
                                    </label>
                                </div>
                            </div>
                            </form>
                            <div class="col-sm-3 dataTables_filter">
                                <a class="btn btn-success btn-flat" href="<?php echo base_url("admin/product_color_size/add/")?>">
                                    <i class="fa fa-plus"></i> Thêm Mới</a>
                            </div>
                        </div>
                        <!-- / phan dau bang -->

                        <!-- start phan hien thi du lieu -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th id="no_sort">
                                            <input type="checkbox" name="check_all[]" id="check_all">
                                        </th>
                                        <th>Id</th>
                                        <th>Mã Sản Phẩm</th>
                                        <th>Sản Phẩm</th>
                                        <th id="no_sort">Ảnh</th>
                                        <th>Màu Sắc</th>
                                        <th>Kích Thước</th>
                                        <th>Số Lượng</th>
                                        <th ="no_sort">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach($list as $it):?>
                                        <tr role="row" id="rows_<?php echo $it->id?>" class="tr_check">
                                            <td class="check_box"><input type="checkbox" name="ids[]" value="<?php echo $it->id?>"></td>
                                            <td><?php echo $it->id ?></td>
                                            <td><?php echo $it->p_id ?></td>
                                            <td><?php echo $it->name?></td>
                                            <td><?php echo show_img("product/".$it->image)?></td>
                                            <td><?=$it->color?></td>
                                            <td><?=$it->size?></td>
                                            <td><?=$it->qty?></td>
                                            <td>
                                                <a href="<?php echo base_url("admin/product_color_size/delete/".$it->id)?>" title="Xóa" class="req"><span class="fa fa-remove"></span></a> |
                                                <a href="<?php echo base_url("admin/product_color_size/edit/".$it->id)?>" title="Sửa"><span class="fa fa-edit"></span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2">Id</th>
                                        <th>Mã Sản Phẩm</th>
                                        <th>Sản Phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Màu Sắc</th>
                                        <th>Kích Thước</th>
                                        <th>Số Lượng</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                                <button class="btn btn-danger btn-flat" id="delete_selected">Xóa Mục Đã Chọn</button>
                            </div>
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    Hiển Thị <b><?php echo $per_page?></b> Của <b><?php echo $total ?></b> Bản Ghi
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    <ul class="pagination">
                                        <?php echo $this->pagination->create_links()?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
