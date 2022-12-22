<div class="banner">
	<div class="wrap">
		<a href="" class="logo">
			<h1 class="logo-text"><?=$setting['ten'.$lang]?></h1>
		</a>
	</div>
</div>

<button class="order-summary-toggle order-summary-toggle-hide">
	<div class="wrap">
		<div class="order-summary-toggle-inner">
			<div class="order-summary-toggle-icon-wrapper">
				<svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-icon"><path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z"></path></svg>
			</div>
			<div class="order-summary-toggle-text order-summary-toggle-text-show">
				<span><?=hienthithongtindonhang?></span>
				<svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-dropdown" fill="#000"><path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path></svg>
			</div>
			<div class="order-summary-toggle-text order-summary-toggle-text-hide">
				<span><?=anthongtindonhang?></span>
				<svg width="11" height="7" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-dropdown" fill="#000"><path d="M6.138.876L5.642.438l-.496.438L.504 4.972l.992 1.124L6.138 2l-.496.436 3.862 3.408.992-1.122L6.138.876z"></path></svg>
			</div>
			<div class="order-summary-toggle-total-recap">
				<span class="total-recap-final-price load-price-total"><?=number_format($cart->get_order_total(),2, '.', ',')?>USD</span>
			</div>
		</div>
	</div>
</button>
<div class="content">
	<div class="wrap">
		<div class="sidebar">
			<div class="sidebar__header">
				<h2 class="sidebar__title"><?=donhang?> (<?=count($_SESSION['cart'])?>) <?=sanpham?></h2>
			</div>
			<div class="sidebar-content">
				<div class="order-summary order-summary-is-collapsed">
					<div class="order-summary-sections">
						<div class="order-summary-section order-summary-section-product-list order-summary__section--is-scrollable" data-order-summary-section="line-items">
							<table class="product-table">
								<thead>
									<tr>
										<th scope="col"><span class="visually-hidden">Hình ảnh</span></th>
										<th scope="col"><span class="visually-hidden">Mô tả</span></th>
										<th scope="col"><span class="visually-hidden">Số lượng</span></th>
										<th scope="col"><span class="visually-hidden">Giá</span></th>
									</tr>
								</thead>
								<tbody>
									<?php $max = count($_SESSION['cart']); for($i=0;$i<$max;$i++) {
										$pid = $_SESSION['cart'][$i]['productid'];
										$q = $_SESSION['cart'][$i]['qty'];
										$mau = ($_SESSION['cart'][$i]['mau'])?$_SESSION['cart'][$i]['mau']:0;
										$size = ($_SESSION['cart'][$i]['size'])?$_SESSION['cart'][$i]['size']:0;
										$code = ($_SESSION['cart'][$i]['code'])?$_SESSION['cart'][$i]['code']:"";
										$proinfo = $cart->get_product_info($pid);
										$pro_price = $proinfo['gia'];
										$pro_price_new = $proinfo['giamoi'];
										$pro_price_qty = $pro_price*$q;
										$pro_price_new_qty = $pro_price_new*$q;
										$pmau = $cart->get_product_mau($mau);
										$psize = $cart->get_product_size($size);
										$textsm='';
										if($pmau!='' && $psize!='') $textsm = $pmau." - ".$psize;
										else if($pmau!='') $textsm = $pmau;
										else if($psize!='') $textsm = $psize;

								?>
									<tr class="product procart-<?=$code?> ">
										<td class="product-image">
											<div class="product-thumbnail">
												<div class="product-thumbnail-wrapper">
													<img class="product-thumbnail-image" alt="<?=$proinfo['ten'.$lang]?>" src="<?=THUMBS?>/100x100x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>">
													
												</div>
												<span class="product-thumbnail-quantity" aria-hidden="true"><?=$q?></span>
												<a class="del-procart text-decoration-none" data-code="<?=$code?>"><i class="fa fa-times-circle"></i><span><?=xoa?></span></a>
											</div>
										</td>
										<td class="product-description">
											<span class="product-description-name order-summary-emphasis"><?=$proinfo['ten'.$lang]?> </span>
											<span><?=$textsm?></span>
										</td>
										<td class="product-quantity visually-hidden"><?=$q?></td>
										<td class="product-price">
											<span class="order-summary-emphasis order-summary-emphasis-price font-weight-bold load-price-<?=$code?>"><?=((!empty($proinfo['giamoi']))?number_format($pro_price_new_qty,2, '.', ','):number_format($pro_price_qty,2, '.', ','))?>USD</span>
											<div class="quantity-counter-procart quantity-counter-procart-<?=$code?> d-flex align-items-stretch justify-content-between">
						                        <span class="counter-procart-minus counter-procart">-</span>
						                        <input type="text" class="quantity-procat" min="1" value="<?=$q?>" data-pid="<?=$pid?>" data-size="<?=$size?>" data-code="<?=$code?>"/>
						                        <span class="counter-procart-plus counter-procart">+</span>
						                    </div>
										</td>
									</tr>
									
									<?php }?>
								</tbody>
							</table>
						</div>
						<div class="order-summary-section order-summary-section-discount" data-order-summary-section="discount">
							<div class="fieldset">
								<div class="field">
									<div class="field-input-btn-wrapper">
										<div class="field-input-wrapper">
											<label class="field-label" for="discount"><?=magiamgia?></label>
											<input placeholder="<?=magiamgia?>" class="field-input code-coupon" autocomplete="false" size="30" type="text" id="discount" name="discount" value="">
										</div>
										<button type="button" class="field-input-btn btn btn-default apply-coupon">
											<span class="btn-content"><?=apdung?></span>
											<i class="btn-spinner icon icon-button-spinner"></i>
										</button>
									</div>
									
								</div>
							</div>
						</div>
						<div class="order-summary-section order-summary-section-total-lines payment-lines" data-order-summary-section="payment-lines">
							<table class="total-line-table">
								<thead>
									<tr>
										<th scope="col"><span class="visually-hidden"><?=mota?></span></th>
										<th scope="col"><span class="visually-hidden"><?=gia?></span></th>
									</tr>
								</thead>
								<tbody>
									<tr class="total-line total-line-subtotal">
										<td class="total-line-name"><?=tamtinh?></td>
										<td class="total-line-price "><span class="order-summary-emphasis load-price-temp"><?=number_format($cart->get_order_total(),2, '.', ',')?> USD</span></td>
									</tr>
									<tr class="total-line total-line-subtotal">
										<td class="total-line-name"><?=khuyenmai?></td>
										<td class="total-line-price "><span class="order-summary-emphasis load-price-endow">—</span></td>
									</tr>
								</tbody>
								<tfoot class="total-line-table-footer">
									<tr class="total-line">
										<td class="total-line-name payment-due-label"><span class="payment-due-label-total"><?=tongcong?></span></td>
										<td class="total-line-name payment-due">
											<span class="payment-due-price load-price-total"><?=number_format($cart->get_order_total(),2, '.', ',')?> USD</span>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="main">
			<div class="main-header">
				<a href="/" class="logo"><h1 class="logo-text"><?=$setting['ten'.$lang]?></h1></a>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href=""><?=trangchu?></a></li>
					<li class="breadcrumb-item breadcrumb-item-current">Checkout</li>
				</ul>
			</div>
			<div class="main-content">
				<form class="form-cart validation-cart" novalidate method="post" action="" enctype="multipart/form-data">
					<div class="step row">
						<div class="col col--two">
							<div class="step-sections steps-onepage">
								<div class="section">
									<div class="section-header"><h2 class="section-title"><?=thongtingiaohang?></h2></div>
									<div class="section-content section-customer-information no-mb">
										<p class="section-content-text"><?=bandacotaikhoan?>
											<a href="account/login"><?=dangnhap?></a>
										</p>
										<div class="fieldset">
											<div class="field field-required  ">
												<div class="field-input-wrapper">
													<label class="field-label" for="billing_address_full_name"><?=hovaten?></label>
													<input placeholder="<?=hovaten?>" autocapitalize="off" required spellcheck="false" class="field-input form-control" size="30" type="text" id="billing_address_full_name" name="data[hoten]" value="">
												</div>
											</div>
											<div class="field  field-two-thirds  ">
												<div class="field-input-wrapper">
													<label class="field-label" for="checkout_user_email"><?=email?></label>
													<input placeholder="<?=email?>" autocapitalize="off" spellcheck="false" class="field-input form-control" size="30" type="email" id="checkout_user_email" name="data[email]" value="">
												</div>
											</div>
											<div class="field field-required field-third  ">
												<div class="field-input-wrapper">
													<label class="field-label" for="billing_address_phone"><?=sodienthoai?></label>
													<input placeholder="<?=sodienthoai?>" autocapitalize="off" required spellcheck="false" class="field-input form-control" size="30" maxlength="15" type="number" id="billing_address_phone" name="data[dienthoai]" value="">
												</div>
											</div>
											<div class="field field-required  ">
												<div class="field-input-wrapper">
													<label class="field-label" for="billing_ghichu"><?=ghichudonhang?></label>
													<input placeholder="<?=ghichudonhang?>" autocapitalize="off" spellcheck="false" class="field-input form-control" size="30" type="text" id="billing_ghichu" name="data[yeucaukhac]" value="">
												</div>
											</div>
											<div class="field field-required  ">
												<div class="field-input-wrapper">
													<label class="field-label" for="billing_address_address1"><?=diachi?></label>
													<input placeholder="<?=diachi?>" autocapitalize="off" required spellcheck="false" class="field-input form-control" size="30" type="text" id="billing_address_address1" name="data[diachi]" value="">
												</div>
											</div>
										</div>
									</div>
									<div class="section-content">
										<div class="fieldset">
											<div class="field field-show-floating-label field-required ">
												<div class="field-input-wrapper field-input-wrapper-select">
													<label class="field-label" for="customer_shipping_province"> <?=tinhthanh?>  </label>
													<select class="field-input form-control" id="city" required name="data[city]" onchange="load_district(this.value);">
														<option value="">  <?=chontinhthanh?> </option>
														<?php foreach ($city as $key => $v) {?>
														<option value="<?=$v['id']?>"><?=$v['ten']?></option>	
														<?php }?>
													</select>
												</div>
											</div>
											<div class="field field-show-floating-label field-required ">
												<div class="field-input-wrapper field-input-wrapper-select">
													<label class="field-label" for="district"> <?=quanhuyen?>  </label>
													<select class="field-input form-control select-district" required id="district" name="data[district]" onchange="load_wards(this.value);">
														<option value=""><?=chonquanhuyen?> </option>
													</select>
												</div>
											</div>
											<div class="field field-show-floating-label field-required ">
												<div class="field-input-wrapper field-input-wrapper-select">
													<label class="field-label" for="wards"> <?=phuongxa?> </label>
													<select class="field-input form-control select-wards" required id="wards" name="data[wards]">
														<option value=""><?=chonphuongxa?> </option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col--two ">
							<div class="step-sections steps-onepage">
								<div class="section">
									<div id="change_pick_location_or_shipping">
										
										<div id="section-payment-method" class="section">
											<div class="section-header">
												<h2 class="section-title"><?=phuongthucthanhtoan?></h2>
											</div>
											<div class="section-content">
												<div class="content-box">
													<div class="radio-wrapper content-box-row">
														<label class="radio-label" for="payment_method_id_0">
															<div class="radio-input">
																<input id="payment_method_id_0" required checked class="input-radio form-control" name="data[httt]" type="radio" value="0">
															</div>
															<span class="radio-label-primary"><?=thanhtoanpaypal?></span>
														</label>
													</div>
													<?php  foreach ($httt as $k => $v) {?>
													<div class="radio-wrapper content-box-row">
														<label class="radio-label" for="payment_method_id_<?=$v['id']?>">
															<div class="radio-input">
																<input id="payment_method_id_<?=$v['id']?>" required class="input-radio form-control" name="data[httt]" type="radio" value="<?=$v['id']?>">
															</div>
															<span class="radio-label-primary"><?=$v['ten'.$lang]?></span>
														</label>
													</div>
													<div class="radio-wrapper content-box-row content-box-row-secondary hidden" for="payment_method_id_<?=$v['id']?>">
														<div class="blank-slate text-left pt-1">
															<?=nl2br($v['mota'.$lang])?>
														</div>
													</div>
													<?php }?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col--two">
							<div class="step-footer">
								<button type="submit" name="thanhtoan" disabled value="✓"  class="step-footer-continue-btn btn">
									<span class="btn-content"><?=thanhtoan?></span>
									<i class="btn-spinner icon icon-button-spinner"></i>
								</button>
							</div>
						</div>
					</div>
					<input type="hidden" class="price-temp" name="price-temp" value="<?=$cart->get_order_total()?>">
			        <input type="hidden" class="price-ship" name="price-ship">
			        <input type="hidden" class="price-endow" name="price-endow">
			        <input type="hidden" class="price-endowID" name="price-endowID">
			        <input type="hidden" class="price-endowType" name="price-endowType">
	                <input type="hidden" class="price-total" name="price-total" value="<?=$cart->get_order_total()?>">
				</form>
			</div>
			<div class="main-footer footer-powered-by text-center text-md-left">Sole Co., LTD. © 2022 All rights reserved. Website Developed By A Wesbite</div>
		</div>
	</div>
</div>