<div class="box">
    <div class="box-header">
        <h3 class="box-title">Danh sách tour</h3>
        <a href="<?php echo base_url(); ?>admin/tour/add"><button type="button"
                style="width: 10%;display:inline-block; margin-left:10px;" class="btn btn-block btn-primary">Thêm
                mới</button></a>
    </div>
    <div id="noti_respon"></div>
    <!-- /.box-header -->
    <div class="box-body">
        <div id="tour_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-12">
                    <table id="tour_table" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="tour_table_info">
                        <thead>
                            <tr role="row">
                                <th>Thứ tự</th>
                                <th>Thumnail</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th>Công cụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i=0;
                            foreach ($list_tour as $key => $value) {
                                $i++;
                                ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="<?php echo base_url()."uploads/images/thumb_".$value["tour_thumnail"]; ?>" alt="<?php echo $value["tour_name"]; ?>"></td>
                                <td><?php echo $value["tour_name"]; ?></td>
                                <td><?php if($value["tour_status"]) echo "Hiển thị"; else echo "Tạm ẩn"; ?></td>
                                <td>
                                    <a title="Sửa" href="<?php echo base_url()."admin/tour/edit/".$value["tour_id"]; ?>" alt="<?php echo $value["tour_name"]; ?>"><i class="fa fa-fw fa-edit"></i></a>
                                    <a title="Xóa" onclick="submit_del_tour(<?php echo $value['tour_id']; ?>)"><i class="fa fa-fw fa-ban"></i></a>
                                </td>
                            </tr>
                            <?php }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Thứ tự</th>
                                <th>Thumnail</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th>Công cụ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- /.box-body -->
</div>
<script>
$(document).ready(function() {
    $('#tour_table').DataTable();
});
function submit_del_tour(tourid) {
    var respon=$("#noti_respon");
    respon.html("");
    if(confirm("Bạn thực sự muốn xóa tour này?")){
        var data = {
            tour_id:tourid,
        };
        var url = "../tour/check_del_tour";
        var success = function(result) {
            var json_data = $.parseJSON(result);
            if (json_data.status) {
                window.location.replace("../tour/");
            }else
            respon.html('<div class="callout callout-info" style="background-color: #ef0000 !important;"><h4>Failed!</h4>'+json_data.status_value+'</div>');
        };
        $.post(url, data, success);
    }  
}
</script>