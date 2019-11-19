<main>
		<div id="position">
			<div class="container">
				<ul>
					<li><a href="<?php echo base_url(); ?>">Home</a>
					</li>
					<li><a href="<?php echo base_url(); ?>tour">Tour</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- End Position -->

		<div class="collapse" id="collapseMap">
			<div id="map" class="map"></div>
		</div>
		<!-- End Map -->

		<div class="container margin_60">
			<div class="row">
				<div class="col-lg-8" id="single_tour_desc">
					<div id="single_tour_feat">
						<ul>
							<?php if($info_tour->tour_duration!=NULL){ ?>
							<li><i class="icon_set_1_icon-83"></i>
								<?php echo $info_tour->tour_duration;?>
							</li><?php } ?>
							<?php if($info_tour->tour_hits!=NULL){ ?>
							<li><i class="icon_set_1_icon-82"></i><?php echo $info_tour->tour_hits;?> lượt xem</li><?php } ?>
							<?php if($info_tour->tour_availability!=NULL){ ?>
							<li><i class="icon_set_1_icon-29"></i><?php echo $info_tour->tour_availability;?> người</li><?php } ?>
						</ul>
					</div>
					<!-- Map button for tablets/mobiles -->
					<?php 
					if($info_tour->album_tour!=NULL){ ?>
					<div id="Img_carousel" class="slider-pro">
						<div class="sp-slides-container">
							<?php
							
							$album_tour=explode("|",$info_tour->album_tour);
							foreach($album_tour as $item){
							?>
								<div class="sp-slide">
									<img alt="<?php echo $info_tour->tour_name; ?>" class="sp-image" src="<?php base_url(); ?>assets/default/css/images/blank.gif" 
									data-src="<?php echo $item; ?>" 
									data-small="<?php echo $item; ?>" 
									data-medium="<?php echo $item; ?>" 
									data-large="<?php echo $item; ?>" 
									data-retina="<?php echo $item; ?>">
								</div>
							<?php } ?>
							
						</div>
						<div class="sp-thumbnails">
							<?php
							foreach($album_tour as $item){  ?>
								<img alt="<?php echo $info_tour->tour_name; ?>" class="sp-thumbnail" src="<?php echo $item; ?>">
							<?php } ?>
						</div>
					</div>	
					<?php }
					?>
					

					<hr>

					<div class="row">
						<div class="col-lg-3">
							<h3>Chi tiết tour</h3>
						</div>
						<div class="col-lg-9">
						<?php echo $info_tour->tour_description;?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-3">
							<h3>Lịch trình</h3>
						</div>
						<div class="col-lg-9">
						<?php 
						if($info_tour->start_date!=NULL){
							$start_date = new DateTime($info_tour->start_date);
							echo '<h4>Xuất phát: '.$start_date->format('d/m/Y').'</h4>';
						}  ?>
						<?php echo $info_tour->tour_schedule;?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-3">
							<h3>Dịch vụ đi kèm</h3>
						</div>
						<div class="col-lg-9">
							<ul style="padding: 0;margin: 0;list-style: none;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-flex-flow: row wrap;justify-content: space-around;
">
						<?php 
						foreach($list_convenient as $convenient){
							echo '<li>'.$convenient['conv_icon'].$convenient['conv_name'].'</li>';
						}
						?>
							</ul>
						</div>
					</div>
					<hr>
					<div class="row">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><h3>Bảng giá</h3></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><h3>Chính sách</h3></a>
							</li>
						</ul>
					
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<table class="table">
									<thead>
									<tr>
										<th>Loại giá/ Độ tuổi</th>
										<th>Người lớn(trên 11 tuổi)</th>
										<th>Trẻ em(từ 6 đến 10 tuổi)</th>
										<th>Trẻ nhỏ(dưới 5 tuổi)</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>Giá</td>
										<td><?php echo number_format($prices_tour->price_adult); ?><sup>đ</sup></td>
										<td><?php echo number_format($prices_tour->price_children); ?><sup>đ</sup></td>
										<td><?php echo number_format($prices_tour->price_child); ?><sup>đ</sup></td>
									</tr>
									</tbody>
								</table>
						
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<?php if($info_tour->tour_policy==NULL)
									echo "Tour này chưa có chính sách gì đặc biệt.";
								else
									echo $info_tour->tour_policy;?>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-3">
							<h3>Đánh giá </h3>
						</div>
						<div class="col-lg-9">
							<div id="general_rating"><?php echo $info_tour->num_rev;?> Đánh giá
								<div class="rating">
								<?php
								for($j=0;$j<5;$j++){
									if(($info_tour->avg_rev)>$j){
										echo '<i class="icon-smile voted"></i>';
									}	
									else
										echo'<i class="icon-smile"></i>';
								}
								?>
								</div>
							</div>
							<!-- End general_rating -->
							<div class="row" id="rating_summary">
								<div class="col-md-6">
									<ul>
										<li>Địa điểm
											<div class="rating">
											
											<?php
											for($j=0;$j<5;$j++){
												if(($info_tour->avg_position)>$j){
													echo '<i class="icon-smile voted"></i>';
												}	
												else
													echo'<i class="icon-smile"></i>';
											}
											?>
												
											</div>
										</li>
										<li>Hướng dẫn viên
											<div class="rating">
												<?php
												for($j=0;$j<5;$j++){
													if(($info_tour->avg_guide)>$j){
														echo '<i class="icon-smile voted"></i>';
													}	
													else
														echo'<i class="icon-smile"></i>';
												}
												?>
												
											</div>
										</li>
									</ul>
								</div>
								<div class="col-md-6">
									<ul>
										<li>Giá cả
											<div class="rating">

												<?php
												for($j=0;$j<5;$j++){
													if(($info_tour->avg_price)>$j){
														echo '<i class="icon-smile voted"></i>';
													}	
													else
														echo'<i class="icon-smile"></i>';
												}
												?>
											</div>
										</li>
										<li>Chất lượng dịch vụ
											<div class="rating">
											<?php
												for($j=0;$j<5;$j++){
													if(($info_tour->avg_quality)>$j){
														echo '<i class="icon-smile voted"></i>';
													}	
													else
														echo'<i class="icon-smile"></i>';
												}
												?>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!-- End row -->
							<hr>
							<?php

							foreach($reviews_tour as $review){ ?>

							<div class="review_strip_single">
								<img src="<?php echo base_url(); ?>assets/default/img/avatar3.jpg" alt="<?php echo $review->rev_name; ?>" class="rounded-circle">
								<small> - <?php 
								$time_rev= new DateTime($review->rev_time);
								echo $time_rev->format('d-m-Y') ?> -</small>
								<h4><?php echo $review->rev_name; ?></h4>
								<p>
									"<?php echo $review->rev_content; ?>"
								</p>
								<div class="rating">
									<?php
									for($j=0;$j<5;$j++){
										if(($review->rev_star)>$j){
											echo '<i class="icon-smile voted"></i>';
										}	
										else
											echo'<i class="icon-smile"></i>';
									} ?>
									
								</div>
							</div>
							<!-- End review strip -->

							<?php } ?>
							
							
						</div>
					</div>
				</div>
				<!--End  single_tour_desc-->

				<aside class="col-lg-4" id="sidebar">
					<div class="theiaStickySidebar">
						<div class="box_style_1 expose" id="booking_box">
							<h3 class="inner">- Đặt tour -</h3>
							<input type="hidden" id="tour_id" value="<?php echo $info_tour->tour_id; ?>">
							<input type="hidden" value="<?php echo $info_tour->tour_name; ?>" id="tour_name">
							<p id="error-message"></p>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><i class="icon-calendar-7"></i> Chọn ngày đi<img src="" alt="" sizes="" srcset=""></label>
										<input class="date-pick form-control" data-date-format="dd/mm/yyyy" type="text" id="date_start">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label><i class=" icon-clock"></i> Thời gian</label>
										<input class="time-pick form-control" value="12:00 AM" type="text" id="time_start">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Người lớn</label>
										<div class="numbers-row">
											<input type="text" value="1" id="adults" class="qty2 form-control" name="num_adults">
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Trẻ em</label>
										<div class="numbers-row">
											<input type="text" value="0" id="childrens" class="qty2 form-control" name="num_childrens">
										</div>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Trẻ nhỏ</label>
										<div class="numbers-row">
											<input type="text" value="0" id="childs" class="qty2 form-control" name="num_childs">
										</div>
									</div>
								</div>
							</div>
							<br>
							<table class="table table_summary">
								<tbody>
									<tr>
										<td>
											Người lớn
										</td>
										<td class="text-right">
											<span id="num_adults" data-price="<?php echo $prices_tour->price_adult; ?>">1</span> * <span><?php echo number_format($prices_tour->price_adult); ?><sup>đ</sup></span>
										</td>
									</tr>
									<tr>
										<td>
											Trẻ em
										</td>
										<td class="text-right">
											<span id="num_childrens" data-price="<?php echo $prices_tour->price_children; ?>">0</span> * <span><?php echo number_format($prices_tour->price_children); ?><sup>đ</sup></span>
										</td>
									</tr>
									<tr>
										<td>
											Trẻ con
										</td>
										<td class="text-right">
										<span id="num_childs" data-price="<?php echo $prices_tour->price_child; ?>">0</span> * <span><?php echo number_format($prices_tour->price_child); ?><sup>đ</sup></span>
										</td>
									</tr>
									
									<tr class="total">
										<td>
											Tổng tiền
										</td>
										<td class="text-right" id="total_cost">
											<?php echo number_format($prices_tour->price_adult); ?><sup>đ</sup>
										</td>
									</tr>
								</tbody>
							</table>
							<a class="btn_full" href="payment" id="btn_booking">Đặt tour</a>
						</div>
						<!--/box_style_1 -->
					</div>
					<!--/sticky -->

				</aside>
			</div>
			<!--End row -->
		</div>
		<!--End container -->
        
        <div id="overlay"></div>
		<!-- Mask on input focus -->
    
	</main>
	<!-- End main -->
