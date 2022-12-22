<div class="product-page">
<div class="container">
	<form class="form-cart validation-cart" novalidate method="post" action="" enctype="multipart/form-data">
		<div class="wrap-cart d-flex align-items-stretch justify-content-between mb-xl-3">
			<?php if(count($_SESSION['cart'])) { ?>
				<div class="top-cart">
					<div class="title-pages"><h1><?=giohangcuaban?></h1></div>
					<div class="list-procart">
						<div class="procart procart-label d-flex align-items-start justify-content-between">
							<div class="pic-procart"><?=hinhanh?></div>
							<div class="info-procart"><?=tensanpham?></div>
							<div class="quantity-procart">
								<p><?=soluong?></p>
								<p><?=thanhtien?></p>
							</div>
							<div class="price-procart"><?=thanhtien?></div>
						</div>
						<?php $max = count($_SESSION['cart']); for($i=0;$i<$max;$i++) {
							$pid = $_SESSION['cart'][$i]['productid'];
							$q = $_SESSION['cart'][$i]['qty'];
							$mau = ($_SESSION['cart'][$i]['mau'])?$_SESSION['cart'][$i]['mau']:0;
							$size = ($_SESSION['cart'][$i]['size'])?$_SESSION['cart'][$i]['size']:0;
							$code = ($_SESSION['cart'][$i]['code'])?$_SESSION['cart'][$i]['code']:'';
							$proinfo = $cart->getPriceProduct($pid,$size);
							$pro_price = $proinfo['gia'];
							$pro_price_new = $proinfo['giamoi'];
							$pro_price_qty = $pro_price*$q;
							$pro_price_new_qty = $pro_price_new*$q; ?>
							<div class="procart procart-white procart-<?=$code?> d-flex align-items-start justify-content-between">
								<div class="pic-procart">
									<a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
									<a class="del-procart text-decoration-none" data-code="<?=$code?>">
										<i class="fa fa-times-circle"></i>
										<span><?=xoa?></span>
									</a>
								</div>
								<div class="info-procart">
									<h3 class="name-procart"><a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><?=$proinfo['ten'.$lang]?></a></h3>
									<div class="properties-procart">
                                    <?php if($mau) { $maudetail = $d->rawQueryOne("SELECT ten$lang FROM #_product_mau WHERE type = ? AND id = ?",array($proinfo['type'],$mau)); ?>
                                        <p>Màu sắc: <strong><?=$maudetail['ten'.$lang]?></strong></p>
                                    <?php } ?>
                                    <?php if($size) { $sizedetail = $d->rawQueryOne("SELECT dungluong FROM #_thuoctinh WHERE id = ?",array($size)); ?>
                                        <p>Dung lượng: <strong><?=$sizedetail['dungluong']?></strong></p>
                                    <?php } ?>
                                </div>
								</div>
								<div class="quantity-procart">
									<div class="price-procart price-procart-rp">
										<?php if($proinfo['giamoi']) { ?>
											<p class="price-new-cart load-price-new-<?=$code?>">
												<?=number_format($pro_price_new_qty,0, ',', '.')."đ"?><?=(!empty($proinfo['donvitinh']))?(' /'.$proinfo['donvitinh']):''?>
											</p>
											<p class="price-old-cart load-price-<?=$code?>">
												<?=number_format($pro_price_qty,0, ',', '.')."đ"?><?=(!empty($proinfo['donvitinh']))?(' /'.$proinfo['donvitinh']):''?>
											</p>
										<?php } else { ?>
											<p class="price-new-cart load-price-<?=$code?>">
												<?=number_format($pro_price_qty,0, ',', '.')."đ"?><?=(!empty($proinfo['donvitinh']))?(' /'.$proinfo['donvitinh']):''?>
											</p>
										<?php } ?>
									</div>
					                <div class="quantity-counter-procart quantity-counter-procart-<?=$code?> d-flex align-items-stretch justify-content-between">
				                        <span class="counter-procart-minus counter-procart">-</span>
				                        <input type="text" class="quantity-procat" min="1" value="<?=$q?>" data-pid="<?=$pid?>" data-size="<?=$size?>" data-code="<?=$code?>"/>
				                        <span class="counter-procart-plus counter-procart">+</span>
				                    </div>
					                <div class="pic-procart pic-procart-rp">
										<a class="text-decoration-none" href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
										<a class="del-procart text-decoration-none" data-code="<?=$code?>">
											<i class="fa fa-times-circle"></i>
											<span><?=xoa?></span>
										</a>
									</div>
								</div>
								<div class="price-procart">
									<?php if($proinfo['giamoi']) { ?>
										<p class="price-new-cart load-price-new-<?=$code?>">
											<?=number_format($pro_price_new_qty,0, ',', '.')."đ"?>
										</p>
										<p class="price-old-cart load-price-<?=$code?>">
											<?=number_format($pro_price_qty,0, ',', '.')."đ"?>
										</p>
									<?php } else { ?>
										<p class="price-new-cart load-price-<?=$code?>">
											<?=number_format($pro_price_qty,0, ',', '.')."đ"?>
										</p>
									<?php } ?>
								</div>
							</div>
				        <?php } ?>
					</div>
			    </div>
			    <div class="bottom-cart">
				    <div class="money-procart">
			        	<?php if($config['order']['coupon']) { ?>
				        	<div class="total-procart coupon-procart d-flex align-items-center justify-content-between">
				        		<input type="text" class="form-control code-coupon" placeholder="<?=nhapmauudai?>" />
								<input type="button" class="btn-cart btn btn-primary apply-coupon" value="<?=apdung?>">
					        </div>
					    <?php } ?>
					    <?php if($config['order']['ship'] || $config['order']['coupon']) { ?>
					        <div class="total-procart d-flex align-items-center justify-content-between">
					        	<p>Giá sản phẩm:</p>
					        	<p class="total-price load-price-temp"><?=number_format($cart->get_order_total(),0, ',', '.')?>đ</p>
					        </div>
					    <?php } ?>
				        <?php if($config['order']['ship']) { ?>
				        	<div class="total-procart d-flex align-items-center justify-content-between">
					        	<p><?=phivanchuyen?>:</p>
					        	<p class="total-price load-price-ship">Tính khi thanh toán</p>
					        </div>
					    <?php } ?>
					    <?php if($config['order']['coupon']) { ?>
					        <div class="total-procart d-flex align-items-center justify-content-between">
					        	<p><?=uudai?>:</p>
					        	<p class="total-price load-price-endow"><?=chuacouudai?></p>
					        </div>
					    <?php } ?>
				        <div class="total-procart d-flex align-items-center justify-content-between">
				        	<p><?=tongtien?>:</p>
				        	<p class="total-price load-price-total"><?=number_format($cart->get_order_total(),0, ',', '.')?>đ</p>
				        </div>
				        <input type="hidden" class="price-temp" name="price-temp" value="<?=$cart->get_order_total()?>">
				        <input type="hidden" class="price-ship" name="price-ship">
				        <input type="hidden" class="price-endow" name="price-endow">
				        <input type="hidden" class="price-endowID" name="price-endowID">
				        <input type="hidden" class="price-endowType" name="price-endowType">
		                <input type="hidden" class="price-total" name="price-total" value="<?=$cart->get_order_total()?>">

		                <a class="check-thanhtoan" href="thanh-toan">Tiến hành thanh toán</a>
		                <div class="phone-hotro">
		                	<p>
		                		Hotline hỗ trợ <span><?=$optsetting['hotline']?></span>
		                	</p>
		                </div>
			        </div>
			    </div>
			<?php } else { ?>
				<a href="" class="empty-cart text-decoration-none">
					<i class="fa fa-cart-arrow-down"></i>
					<p><?=khongtontaisanphamtronggiohang?></p>
					<span><?=vetrangchu?></span>
				</a>
			<?php } ?>
		</div>
	</form>
</div>
</div>