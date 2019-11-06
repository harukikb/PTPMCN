<main style="margin-bottom: 355px;">
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li><a href="#">Tra đơn đặt tour</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <!-- <div class="row">
			<form class="form-inline">
				<div class="form-group mx-sm-12 mb-9">
					<input type="password" class="form-control" id="inputPassword2" placeholder="Mã đơn hàng" style=""/>
					<button type="submit" class="btn btn-primary  mb-3 form-control">Tra đơn</button>
				</div>
				<div class="form-group mx-sm-12 mb-9">
					
					<button type="submit" class="btn btn-primary  mb-3 form-control">Tra đơn</button>
				</div>
				
			</form>
		<div> -->
        <aside class="col-lg-12">
            <div class="theiaStickySidebar check">
                <div class="box_style_1 expose" id="booking_box">
                    
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input class="form-control" type="text" id="keyword" placeholder="Mã đơn đặt">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <a class="btn_full_outline" id="btn-search"></i> Tra đơn đặt </a>
                        </div>
                        <br>

                    </div>
                    <!--/box_style_1 -->
                </div>
                <!--/sticky -->

        </aside>
        <p id="error-message"></p>

        <aside class="col-lg-12" id="sidebar">
					<div class="theiaStickySidebar">
						<div class="box_style_1 expose" id="booking_box">
							<h3 class="inner">- Booking -</h3>
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
										
									</tr>
									<tr>
										<td>
											Trẻ em
										</td>
										
									</tr>
									<tr>
										<td>
											Trẻ con
										</td>
										
									</tr>
									
									<tr class="total">
										<td>
											Tổng tiền
										</td>
										
									</tr>
								</tbody>
							</table>
							<a class="btn_full" href="cart" id="btn_booking">Book now</a>
							<a class="btn_full_outline" href="#"><i class=" icon-heart"></i> Add to whislist</a>
						</div>
						<!--/box_style_1 -->
					</div>
					<!--/sticky -->

				</aside>

    </div>

</main>