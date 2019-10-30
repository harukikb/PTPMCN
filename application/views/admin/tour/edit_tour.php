<style>
.form-group {
    width: 100%;
}

.custom-btn {
    margin: 20px;
    width: 20%;
    display: inline-block;
}
</style>
<div class="box" style="margin-bottom:0">
    <div class="box-header">
        <h3 class="box-title">Chỉnh sửa thông tin tour</h3>
    </div>
    <div id="noti_respon"></div>
    <!-- /.box-header -->
    <div class="box-body">
        <div id="tour_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <form role="form" enctype="multipart/form-data" id="form_edit_tour" method ="post" action="<?php echo base_url(); ?>admin/tour/submit_edit_tour">
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <input type="hidden" name="tour_id" value="<?php echo $tour_info->tour_id; ?>">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" style="width: 100%;" class="form-control" id="tour_title"
                                name="tour_title" value="<?php echo $tour_info->tour_name; ?>">
                        </div>
                        <div class="form-group">
                            <label>Danh mục tour</label>
                            <select class="form-control select2" name="category_tour_id[]" id="category_tour_id"
                                multiple="multiple" data-placeholder="Chọn danh mục" style="width: 100%;">
                                <?php
                                $cate_id=explode(",",$tour_info->category_tour_id);
                                foreach($list_cate as $cate){ ?>
                                <option value="<?php echo $cate['cate_id'] ?>" <?php if(in_array($cate['cate_id'],$cate_id)) echo "selected";  ?> ><?php echo $cate['cate_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Xuất phát từ</label>
                            <input type="text" style="width: 100%;" class="form-control" id="tour_from"
                                name="tour_from" value="<?php echo $tour_info->tour_from; ?>">
                        </div>
                        <div class="form-group">
                            <label>Điểm đến</label>
                            <input type="text" style="width: 100%;" class="form-control" id="tour_destination"
                                name="tour_destination" value="<?php echo $tour_info->tour_destination; ?>">
                        </div>
                        <div class="form-group">
                            <label>Thời gian</label>
                            <input type="text" style="width: 100%;" class="form-control" id="tour_duration"
                                name="tour_duration"  value="<?php echo $tour_info->tour_duration ?>">
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input type="text" style="width: 100%;" class="form-control" id="tour_price"
                                name="tour_price" value="<?php echo $tour_info->tour_price ?>">
                        </div>
                        <div class="form-group">
                            <label>Giá khuyến mãi</label>
                            <input type="text" style="width: 100%;" class="form-control" id="tour_saving_price"
                                name="tour_saving_price" value="<?php echo $tour_info->tour_saving_price ?>">
                        </div>
                        <div class="form-group">
                            <label for="tour_thumnail">Thumnail</label><br/>
                            <img src="<?php echo base_url().'uploads/images/thumb_'.$tour_info->tour_thumnail ?>" width="200" height="160" alt="<?php echo $tour_info->tour_name ?>">
                            <input type="file" id="tour_thumnail" name="tour_thumnail">

                            <p class="help-block">Nhập tên file không dấu và không khoảng trắng.</p>
                        </div>
                        <div class="form-group">
                            <label for="album_tour">Album tour</label><br/>
                            <?php
                                $images=explode(",",$tour_info->album_tour);
                                foreach($images as $image){ ?>
                                <img src="<?php echo base_url().'uploads/images/'.$image ?>" width="200" height="160" alt="<?php echo $tour_info->tour_name ?>">
                                <?php }
                            ?>
                            <input type="file" id="album_tour" name="album_tour[]" multiple="multiple">
                            <p class="help-block"></p>Nhấn CTR để chọn nhiều hình.</p>
                            <p class="help-block">Nhập tên file không dấu và không khoảng trắng.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label>Tour Except</label>
                            <textarea style="width: 100%;" class="form-control" name="tour_except"
                                id="tour_except"><?php echo $tour_info->tour_except ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Thông tin liên hệ đặt tour</label>
                            <textarea style="width: 100%;" class="form-control" name="tour_info_contact"
                                id="tour_info_contact"><?php echo $tour_info->tour_info_contact ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Keywords</label>
                            <textarea style="width: 100%;" class="form-control" name="tour_keywords"
                                id="tour_keywords"><?php echo $tour_info->tour_keywords ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label><br/>
                            <label class="radio-inline"><input type="radio" name="tour_status" value="1" <?php if($tour_info->tour_status) echo "checked"; ?>>Hiển thị</label>
                            <label class="radio-inline"><input type="radio" name="tour_status" value="0" <?php if(!$tour_info->tour_status) echo "checked"; ?>>Tạm ẩn</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea style="width: 100%;" class="form-control" name="tour_description"
                                id="tour_description"><?php echo $tour_info->tour_description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Lịch trình</label>
                            <textarea style="width: 100%;" class="form-control" name="tour_schedule"
                                id="tour_schedule"><?php echo $tour_info->tour_schedule ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" id="submitupdate" class="custom-btn btn btn-block btn-success">Cập nhật</button>
                    <a href="<?php echo base_url(); ?>admin/tour"><button type="button"
                            class="custom-btn btn btn-block btn-danger" id="submithuy">Hủy</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript"
    src="<?php echo base_url(); ?>assets/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript" src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/ckfinder/ckfinder.js"></script>
<script>
var editor1 = CKEDITOR.replace('tour_description', {
    filebrowserBrowseUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/ckfinder.html"; ?>',
    filebrowserImageBrowseUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/ckfinder.html?Type=Images";?>',
    filebrowserFlashBrowseUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/ckfinder.html?Type=Flash" ?>',
    filebrowserUploadUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files"?>',
    filebrowserImageUploadUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";?>',
    filebrowserFlashUploadUrl: '<?php echo base_url()."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash";?>',
    filebrowserWindowWidth: '800',
    filebrowserWindowHeight: '480'
});
var editor2 = CKEDITOR.replace('tour_schedule', {
    filebrowserBrowseUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/ckfinder.html"; ?>',
    filebrowserImageBrowseUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/ckfinder.html?Type=Images";?>',
    filebrowserFlashBrowseUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/ckfinder.html?Type=Flash" ?>',
    filebrowserUploadUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files"?>',
    filebrowserImageUploadUrl: '<?php echo base_url()."assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";?>',
    filebrowserFlashUploadUrl: '<?php echo base_url()."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash";?>',
    filebrowserWindowWidth: '800',
    filebrowserWindowHeight: '480'
});
CKFinder.setupCKEditor(editor1, "<?php echo base_url().'assets/admin/plugins/ckfinder/'?>");
CKFinder.setupCKEditor(editor2, "<?php echo base_url().'assets/admin/plugins/ckfinder/'?>");
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/edit_tour.js"></script>