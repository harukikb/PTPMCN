$(document).ready(function ($) {

    //submit form check
    $('#btn-search').on('click',function(e){
        e.preventDefault();
        $('#error-message').empty();
        let keyword=$('#keyword').val();
        if(keyword==''){
            $('#error-message').html('<div class=" col-lg-12 alert alert-danger fix-danger">'+
                                        '<strong>Lỗi !</strong> Vui lòng nhập mã đơn hàng.'+
                                    '</div>');
        }else submit_check_form(keyword);
    });
});

async function submit_check_form(keyword){
    let result;
    let url = base_url+"/check/check_booking";
    let success = function(responce) {
		let json_data = $.parseJSON(responce);
		if(json_data['status']){
            
			window.location.href = base_url+"/tour/payment";
		}	
		else
        $('#error-message').html('<div class=" col-lg-12 alert alert-danger fix-danger">'+
                                    '<strong>Lỗi !</strong> Vui lòng nhập mã đơn hàng.'+
                                '</div>');
    };
    try {
		result = await $.post(url, keyword, success);
	}
	catch (error) {
        console.error(error);
    }
}