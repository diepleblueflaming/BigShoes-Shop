<?php $this->load->view("admin/product/head")?>
<div class="content">
<div class="row">
    <div class="col-xs-12">
        <?php if(isset($message)) : ?>
            <h4><?php echo $message; ?></h4>
        <?php endif?>
        <div id="alerts"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Bảng Thông Tin Sản Phẩm</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="dataTables_length" id="example1_length"><label>
                            <form action="<?php echo base_url("admin/product/")?>" method="post" id="form_search_product">Hiển Thị
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
                                </select> Bản Ghi</label></div>

                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_filter">
                            <label>
                                <select name="type" class="form-control" id="search_tool">
                                    <option value="">Tìm kiếm theo</option>
                                    <option value="name">Tên</option>
                                    <option value="price">Giá</option>
                                    <option value="catalog">chuyên mục</option>
                                </select>
                                <label id="search_product">
                                    <input class="form-control search_input" placeholder="Nhập Tên Sản Phẩm"  type="search" name="search_name" id="search_name">
                                    <select class="form-control search_input search_price" name="search_price_from" id="search_price_from">
                                        <option value="">From</option>
                                        <?php for($i = $price_max_min->pmin ; $i < $price_max_min->pmax ; $i=$i+200000):?>
                                            <option value="<?=$i?>"><?=number_format($i)?></option>
                                        <?php endfor?>
                                            <option value="<?=$price_max_min->pmax?>"><?=number_format($price_max_min->pmax)?></option>
                                    </select>

                                    <select class="form-control search_input search_price" name="search_price_to" id="search_price_to">
                                        <option value="">To</option>
                                        <?php for($i = $price_max_min->pmin ; $i < $price_max_min->pmax;  $i=$i+200000):?>
                                            <option value="<?=$i?>"><?=number_format($i)?></option>
                                        <?php endfor?>
                                        <option value="<?=$price_max_min->pmax?>"><?=number_format($price_max_min->pmax)?></option>
                                    </select>

                                    <select class="form-control search_input" id="search_catalog" name="search_catalog">
                                        <option value="">Chọn Chuyên Mục</option>
                                        <?php foreach($catalog as $it) : ?>
                                            <?php   if($it->sub_child): ?>
                                                <optgroup label="<?=$it->title?>">
                                                    <?php foreach($it->sub_child as $item) : ?>
                                                        <option value="<?=$item->id?>">
                                                            <?=$item->title?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </optgroup>
                                                <?php else :?>
                                                    <option value="<?=$it->id?>"><?=$it->title?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </label>
                            </label>
                        </div>
                    </div>
                    </form>
                    <div class="col-sm-3 dataTables_filter">
                        <a class="btn btn-success btn-flat" href="<?php echo base_url("admin/product/add/")?>">
                            <i class="fa fa-plus"></i> Thêm Mới</a>
                    </div>
                </div>
                <!-- / phan dau bang -->

                <!-- start phan hien thi du lieu -->
                <div class="row">
                    <div class="col-sm-12">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                            <tr role="row">
                                <th id="no_sort">
                                    <input type="checkbox" name="check_all[]" id="check_all">
                                </th>
                                <th>Id</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Chuyên Mục</th>
                                <th id="no_sort">Ảnh Đại Diện</th>
                                <th>Trạng Thái</th>
                                <th id="no_sort">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($list as $it) : ?>
                                <tr role="row" id="rows_<?php echo $it->id?>" class="tr_check">
                                    <td class="check_box"><input type="checkbox" name="ids[]" value="<?php echo $it->id?>"></td>
                                    <td><?php echo $it->id ?></td>
                                    <td><?php echo $it->name ?></td>
                                    <td><?php echo number_format($it->price)?></td>
                                    <td><?php echo $it->catalog?></td>
                                    <td><?php echo show_img("product/".$it->image)?></td>
                                    <?php $a = $it->status ? "Đang Kinh Doanh" : "Ngừng Kinh Doanh"?>
                                    <td><?=$a?></td>
                                    <td>
                                        <a href="<?php echo base_url("admin/product/delete/".$it->id)?>" title="Xóa" class="req"><span class="fa fa-remove"></span></a><span class="separate">|</span>
                                        <a href="<?php echo base_url("admin/product/edit/".$it->id)?>" title="Sửa"><span class="fa fa-edit"></span></a><span class="separate">|</span>
                                        <a href="#row_detail_<?=$it->id?>" title="Chi Tiết" data-toggle='collapse'><span class="fa fa-info"></span></a>
                                    </td>
                                </tr>
                                <!-- phan chi tiet san pham -->
                                <tr class="collapse" id="row_detail_<?=$it->id?>">
                                    <td colspan="8">
                                        <h5><label class="p_label">Bảo Hành : </label> <b><?=$it->warranty?></b><h5>
                                        <h5><label class="p_label">Giảm Giá : </label> <b><?=$it->discount?> %</b><h5>
                                        <h5><label class="p_label">Đã Mua : </label> <b><?=$it->bought?></b><h5>
                                        <h5><label class="p_label">Ngày Tạo : </label> <b><?=$it->created?></b><h5>
                                        <h5><label class="p_label">Site Title : </label> <b><?=$it->site_title?></b><h5>
                                        <h5><label class="p_label">Ảnh Kém Theo : </label>
                                            <?php
                                                if($it->image_list) {
                                                    foreach (json_decode($it->image_list) as $item) {
                                                        echo show_img("product/" . $item);
                                                    }
                                                }
                                            ?>
                                        </h5>
                                        <h5><label class="p_label">Mô Tả : </label>
                                            <textarea  cols="80" rows="5" class="form-control"><?=$it->description?></textarea>
                                        </h5>
                                    </td>
                                </tr>
                                <!-- / phan chi tiet san pham -->
                            <?php endforeach?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2">Id</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Chuyên Mục</th>
                                <th>Ảnh Đại Diện</th>
                                <th>Trạng Thái</th>
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