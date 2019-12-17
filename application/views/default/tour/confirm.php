<main>
		<div id="position">
			<div class="container">
				<ul>
					<li><a href="<?php echo base_url(); ?>">Trang chủ</a>
					</li>
					<li><a href="<?php echo base_url(); ?>tour">Danh sách tour</a>
					</li>
					<li>Kết quả đặt tour</li>
				</ul>
			</div>
		</div>
		<!-- End position -->

		<div class="container margin_60">
			<div class="row">
				<div class="col-lg-8 add_bottom_15">
					<div class="form_title">
						<h3><strong><i class="icon-tag-1"></i></strong>Booking sumary</h3>
						<p>
							Thông tin về tour của bạn
						</p>
					</div>
					<div class="step">
						<table class="table table-striped confirm">
							<thead>
								<tr>
									<th colspan="2" style="font-size: 20px;">
										<?php echo $booking_info->tour_name;?>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<strong>Ngày khởi hành</strong>
									</td>
									<td>
										<?php echo $booking_info->booking_start_date;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Họ tên người đặt</strong>
									</td>
									<td>
										<?php echo $booking_info->cus_name;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Số điện thoại</strong>
									</td>
									<td>
										<?php echo $booking_info->cus_phone;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Địa chỉ</strong>
									</td>
									<td>
										<?php echo $booking_info->cus_address;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Email</strong>
									</td>
									<td>
										<?php echo $booking_info->cus_email;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Mã code</strong>
									</td>
									<td>
										<?php echo $booking_info->booking_code;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Số lượng người lớn</strong>
									</td>
									<td>
										<?php echo $booking_info->booking_num_adult;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Số lượng trẻ em</strong>
									</td>
									<td>
										<?php echo $booking_info->booking_num_children;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Số lượng trẻ con</strong>
									</td>
									<td>
										<?php echo $booking_info->booking_num_child;?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Tổng số tiền</strong>
									</td>
									<td>
										<?php echo number_format($booking_info->booking_price);?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!--End step -->
				</div>
				<!--End col -->

				<aside class="col-lg-4">
					<div class="box_style_1">
						<h3 class="inner">Thank you!</h3>
						<p>
							Cảm ơn bạn đã tin tưởng và lựa chọn đặt tour của chúng tôi.
							Chúc bạn thoải mái với kỳ nghỉ, hi vọng các bạn sẽ tiếp tục ủng hộ chúng tôi với rất nhiều tour hấp dẫn khác.
						</p>
						<hr>
						<p>
							Hãy để lại nhận xét và đánh giá khi trải nghiệm tour của chúng tôi để chúng tôi có thể tiếp tục hoàn thiện và phục vụ tốt hơn nữa.
						</p>
					</div>
					<div class="box_style_4">
						<i class="icon_set_1_icon-89"></i>
						<h4>Liên hệ để được hướng dẫn</h4>
						<a href="tel://00399002999" class="phone">0399002999</a>
						<small>Hoạt động từ thứ 2 đến thứ 6 (9.00am - 7.30pm)</small>
					</div>
				</aside>

			</div>
			<!--End row -->
		</div>
		<!--End container -->
	</main>
	<!-- End main -->