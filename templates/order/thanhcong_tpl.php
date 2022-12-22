<div class="wrap-order-success">
	<div class="main-page-success">
		<div class="boxx-img-success">
			<img src="assets/images/imgthanhcong.png" alt="">
		</div>
		<div class="info-order-success">
			<div class="head-orrde">
				<h3>Đặt hàng thành công</h3>
			</div>
			<div class="body-order">
				<p>Cảm ơn quý khách <span><?=$_SESSION['orrder-success']['ten']?></span> đã cho Di Động Sài Gòn được phục vụ.</p>
				<div class="box-success-order-detail">
					<h4>Thông tin đơn hàng</h4>
					<ul>
						<li>Người nhận hàng: <span> <?=$_SESSION['orrder-success']['ten']?></span></li>
						<li>Địa chỉ nhận hàng:  <span> <?=$_SESSION['orrder-success']['diachi']?></span></li>
						<li>
							Sản phẩm: 
							<p>
							<?php foreach ($_SESSION['orrder-success']['tensp'] as $k => $v) {?>
							<span><?=$k+1?>. <?=$v?></span>
							<?php }?>
							</p>
						</li>
						<li>Tổng tiền: <span> <?=$_SESSION['orrder-success']['gia']?></span></li>
					</ul>
				</div>
				<p>Cần hỗ trợ vui lòng gọi: <span><?=$optsetting['dienthoai']?></span></p>
			</div>
			<div class="footer-order">
				<a href="">Mua thêm sản phẩm</a>
			</div>
		</div>
	</div>
</div>
