$('input.date-pick').datepicker('setDate', 'today');
		$('input.time-pick').timepicker({
			minuteStep: 15,
			showInpunts: false
		})

jQuery('#sidebar').theiaStickySidebar({
			additionalMarginTop: 80
		});
$(function(){
$('input').iCheck({
		   checkboxClass: 'icheckbox_square-grey',
		   radioClass: 'iradio_square-grey'
		 });
		});
$(document).ready(function ($) {
			$('#Img_carousel').sliderPro({
				width: 960,
				height: 500,
				fade: true,
				arrows: true,
				buttons: false,
				fullScreen: false,
				smallSize: 500,
				startSlide: 0,
				mediumSize: 1000,
				largeSize: 3000,
				thumbnailArrows: true,
				autoplay: false
			});
		});		

	// 	async function get_list_tours(data) {
	// 		let result;
			
	// 		let url = base_url+"/restaurant/get_list_tour";
	// 		let success = function(responce) {
	// 			let json_data = $.parseJSON(responce);
				
	// 				list_tours(json_data);

	// 		};
	// 		try {
	// 			result = await $.get(url, data, success);
	// 		}
	// 		catch (error) {
	// 			console.error(error);
	// 		}
	// 	}
	// function list_tours(data){
	// 	let list = $('#list_tour');
	// 	list.empty();
	// 	if(data['total_record']==0){
	// 		list.append("<p class='noti-filter__result'><strong>Không có kết quả nào cho tìm kiếm của bạn</strong></p>");
	// 	}
	// 	else{
	// 		for(let i = 0; i < data['total_record']; i++){
	// 			let r=$('<div class="row" style="height: 100px;"></div>');
	// 			let col4=$('<div class="col-lg-4 col-md-4" style="padding-left: 5px;"iv>');
	// 			let col6=$('<div class="col-lg-6 col-md-6" style="padding-left: 5px;"></div>');
	// 			let col2=$('<div class="col-lg-2 col-md-2" style="padding-left: 5px;"></div>');
	// 			let image=data[i].tour_thumnail;
	// 			if(image==null){
	// 				image=base_url+'/assets/default/img/hotel_1.jpg';
	// 			}
	// 			col4.append('<div>'+
	// 			'<a href="'+base_url+'/tour/detail/'+data[i].tour_slug+'"><img style="height:80px; width:85px;"data-src="'+image+'" alt="'+data[i].tour_name+'" class="lazyload">'+
	// 			'</a>'+
	// 			'</div>');
	// 			col6.append('<p style="font-size:15px;">'+data[i].tour_name+'</p>');
	// 			col2.append('<div class="price_list">'+
	// 							'<p style="margin-top:15px;"><a href="'+base_url+'/tour/detail/'+data[i].tour_slug+'" class="btn_1" style="font-size:10px; ">Chọn</a>'+
	// 							'</p>'+
	// 					'</div>');
	// 			r.append(col4);
	// 			r.append(col6);
	// 			r.append(col2);
	// 			list.append(r);
	// 			list.append('<hr>');
	// 		}
	// 	}
	// }	

{/* <div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label><i class="icon-calendar-7"></i> Select a date</label>
									<input class="date-pick form-control" data-date-format="M d, D" type="text">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label><i class=" icon-clock"></i> Time</label>
									<input class="time-pick form-control" value="12:00 AM" type="text">
								</div>
							</div>
						</div> */}