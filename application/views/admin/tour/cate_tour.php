<div class="box" style="margin-bottom:0">
    <div class="box-header">
        <h3 class="box-title">Danh mục tour</h3>
    </div>
    <div id="noti_respon"></div>
    <style>
    .btn_del{
        position:relative;
        bottom:21px;
        left:30px;
    }
    </style>
    <!-- /.box-header -->
    <div class="box-body">
        <div id="cate_tour_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-6 col-sm-6 col-xs-12">
                    <table id="cate_tour_table" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="cate_tour_table_info">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Slug</th>
                                <th>Công cụ</th>
                            </tr>
                        </thead>
                        <tbody id="list_categorys">
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6 col-sm-6 col-xs-12">
                    <form role="form" id="form_add_cate">
                        <div class="form-group" style="width:100%">
                            <label>Tên Category</label>
                            <input type="text" style="width: 100%;" class="form-control" id="cate_name" name="cate_name">
                        </div>
                        <div class="form-group" style="width:100%">
                            <label>Category Slug</label>
                            <input type="text" style="width: 100%;" class="form-control" id="cate_slug" name="cate_slug">
                        </div>
                        <button type="submit" style="max-width: max-content;margin:20px;" class="custom-btn btn btn-block btn-success" id="submit_add_cate_tour" name="submit_add_cate_tour">Thêm</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <!-- /.box-body -->
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/cate_tour.js"></script>