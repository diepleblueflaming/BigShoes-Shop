<?php $this->load->view("admin/transaction/head")?>
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php if(isset($message)) : ?>
                <h4><?php echo $message; ?></h4>
            <?php endif?>
            <div id="alerts"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Bảng Danh Sách Giao Dịch Của Đơn Hàng <span style="color: red"><?=$tran->name." ".date("Y-m-d H:i",strtotime($tran->created))?></span></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <!-- start phan hien thi du lieu -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="myTables" class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>Id</th>
                                        <th>Product</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Date Of Creating</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?= $total = 0;?>
                                    <?php foreach($list as $it):?>
                                        <tr role="row" id="rows_<?php echo $it->id?>" class="tr_checxk">
                                            <td><?php echo $it->id ?></td>
                                            <td>
                                                <?=show_img("/product/".$it->image)?><br>
                                                <?=$it->product_name?>
                                            </td>
                                            <td><span style="width50px; height20px; display: inline-block; background-color: <?=$it->color?>"></span></td>
                                            <td><?=$it->size?></td>
                                            <td><?=$it->qty?></td>
                                            <td><?=number_format($it->amount)?></td>
                                            <td><?=date_format(date_create($it->created),"Y-m-d H:i:s")?></td>
                                            <?php $total += $it->amount?>
                                        </tr>
                                    <?php endforeach?>
                                    </tbody>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td colspan="1"><b>Thành Tiền : <?=number_format($total)?></b></td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <form action="" method="post">
                                                <button type="submit" class="btn btn-flat btn-primary" name="btn-handling"><?=!$tran->status ? "Xử Lý Đơn Hàng" : "Đã Xử Lý"?></button>
                                                <button type="button" class="btn btn-flat btn-warning" onclick="{window.location.href = base_url('')}">Hủy Bỏ</button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
