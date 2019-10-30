$(function() {
    select_cate_tour();
    $('.select2').select2();
    $("form").on('submit', function(event) {
        event.preventDefault();
		for(var instanceName in CKEDITOR.instances)
            CKEDITOR.instances[instanceName].updateElement();
        var formData = new FormData(this);
        $("#submitadd").attr("disabled","disabled");
        $("#submitadd").val($("#submitadd").val()+"...");
        submit_add_tour(formData);
        $("#submitadd").val("Thêm");
        $('#form_add_tour')[0].reset();
    });
});
function select_cate_tour(){
    var url = "../tour/get_list_cate_tour";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[id=category_tour_id]');
        sl.empty();
        $.each(json_data, function(key, value) {
            sl.append('<option value="' + value.cate_id + '">' + value.cate_name + '</option>');
        });
    };
    $.get(url, success);

}
function submit_add_tour(data) {
    var respon=$("#noti_respon");
    respon.html("");

    // var url = "../tour/submit_add_tour";
    // var success = function(result) {
    //     var json_data = $.parseJSON(result);
    //     if (json_data.status) {
    //         window.location.replace("/admin/tour/");
    //     }else{
    //         respon.html('<div class="callout callout-info" style="background-color: #ef0000 !important;"><h4>Failed!</h4>'+json_data.status_value+'</div>');
    //     }
    // };
    // $.post(url, data, success);
    $.ajax({
        url: '../tour/submit_add_tour',
        type: 'POST',
        data: data,
        success: function (result) {
            var json_data = $.parseJSON(result);
            if (json_data.status) {
                window.location.replace("../tour/");
            }else{
                respon.html('<div class="callout callout-info" style="background-color: #ef0000 !important;"><h4>Failed!</h4>'+json_data.status_value+'</div>');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

}

