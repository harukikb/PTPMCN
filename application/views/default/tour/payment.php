<main>
		<div id="position">
			<div class="container">
				<ul>
					<li><a href="<?php echo base_url(); ?>">Trang chủ</a>
					</li>
					<li><a href="<?php echo base_url(); ?>tour/">Danh sách tour</a>
					</li>
					<li>Xác nhận thông tin</li>
				</ul>
			</div>
		</div>
		<!-- End position -->


		<div class="container margin_60">
			<div class="row">
				<div class="col-lg-8 add_bottom_15">
					<div class="form_title">
						<h3><strong>1</strong>Nhập thông tin</h3>
						<hr>
						<p>
							Vui lòng nhập thông của bạn
						</p>
					</div>
					<div class="step">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Họ tên</label>
									<input type="text" class="form-control" id="name" name="name">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" id="email_cus" name="email">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Điện thoại</label>
									<input type="text" size="10" id="phone" name="phone" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Địa chỉ</label>
									<input type="text" id="address" name="address" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<!--End step -->
					<div id="policy">
						<h4>Chính sách</h4>
						<div class="form-group">
							<label>
								<input type="checkbox" name="policy_terms" id="policy_terms">Tôi chấp nhận các điều khoản, điều kiện và chính sách chung</label>
						</div>
						<div id="error-message">
						</div>
						<div style="display: inline-block;">
							<span><a href="<?php echo base_url(); ?>tour/confirmation" class="btn_checkout btn_1 green medium" >Đặt tour</a></span>
							<span id="loading"><img src="<?php echo base_url(); ?>assets/default/img/iconloading.gif" style=" height: 20px; width: 20px;" placeholder="Loading..."></span>
						</div>
					</div>
				</div>

				<aside class="col-lg-4" id="sidebar">
					<div class="theiaStickySidebar">
						<div class="box_style_1" id="booking_box">
							<h3 class="inner">- Summary -</h3>
							<input type="hidden" id="tour_id" value="<?php echo $tour_id; ?>">
							<input type="hidden" value="<?php echo $date_start; ?>" id="date_start">
							<table class="table table_summary">
								<tbody>
									<tr>
										<td>
											Người lớn
										</td>
										<td class="text-right" id="num_adult" data-value="<?php echo $num_adults;?>">
											<?php echo $num_adults;?>
										</td>
									</tr>
									<tr>
										<td>
											Trẻ em
										</td>
										<td class="text-right" id="num_children" data-value="<?php echo $num_childrens;?>">
											<?php echo $num_childrens;?>
										</td>
									</tr>
									<tr>
										<td>
											Trẻ con
										</td>
										<td class="text-right" id="num_child" data-value="<?php echo $num_childs;?>">
											<?php echo $num_childs;?>
										</td>
									</tr>
									
									<tr class="total">
										<td>
											Tổng giá
										</td>
										<td class="text-right" id="total_cost">
											<?php echo number_format($total_price);?>
										</td>
									</tr>
								</tbody>
							</table>
							<a  class="btn_checkout btn_full" href="<?php echo base_url(); ?>tour/confirmation">Đặt tour</a>
							<a class="btn_full_outline" href="<?php echo base_url(); ?>tour"><i class="icon-right"></i> Tiếp tục đặt tour</a>
						</div>
					</div>
					<!--End sticky -->
				</aside>

			</div>
			<!--End row -->
		</div>
		<!--End container -->
	</main>
	<!-- End main -->
	<script type="text/javascript">
		var x = document.getElementById("loading");
		window.onload = function() {
   			x.style.display = 'none';
		}
	</script>