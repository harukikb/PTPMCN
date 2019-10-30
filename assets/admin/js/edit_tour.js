$(function() {
    $('.select2').select2();
    $("form").on('submit', function(event) {
        event.preventDefault();
		for(var instanceName in CKEDITOR.instances)
            CKEDITOR.instances[instanceName].updateElement();
        var formData = new FormData(this);
        $("#submitupdate").attr("disabled","disabled");
        
        $("#submithuy").attr("disabled","disabled");
        submit_edit_tour(formData);
        $('#form_edit_tour')[0].reset();
    });
});

function submit_edit_tour(data) {
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
        url: '../submit_edit_tour',
        type: 'POST',
        data: data,
        success: function (result) {
            var json_data = $.parseJSON(result);
            if (json_data.status) {
                window.location.replace("../");
            }else{
                respon.html('<div class="callout callout-info" style="background-color: #ef0000 !important;"><h4>Failed!</h4>'+json_data.status_value+'</div>');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

}

