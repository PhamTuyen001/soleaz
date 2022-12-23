<?php 
	if(!defined('SOURCES')) die("Error");	
	if(empty($_SESSION['cart'])) $func->transfer(bankhongcogitronggiohang, $config_base);	
	/* SEO */
	$seo->setSeo('title',$title_crumb);
	/* breadCrumbs */
	if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
	/* Tỉnh thành */
	$city = $d->rawQuery("select ten, id from #_city where hienthi=1 order by stt asc");
	/* Hình thức thanh toán */
	$httt = $d->rawQuery("select ten$lang, mota$lang, id from #_news where type = ? order by stt,id desc",array('hinh-thuc-thanh-toan'));

	if(!empty($rowUser)){
		$rowAddress=$d->rawQuery("select * from #_member_address where id_user=? order by macdinh desc",array($rowUser['id']));
	}

	if(!empty($_POST['thanhtoan']))
	{
		$madonhang = strtoupper($func->stringRandom(6));
	    $hoten = htmlspecialchars($_POST['data']['hoten']);
	    $email = htmlspecialchars($_POST['data']['email']);
	    $dienthoai = htmlspecialchars($_POST['data']['dienthoai']);
	    $city = htmlspecialchars($_POST['data']['city']);
	    $district = htmlspecialchars($_POST['data']['district']);
	    $wards = htmlspecialchars($_POST['data']['wards']);
	    $diachi = htmlspecialchars($_POST['data']['diachi']).', '.$func->get_places("wards",$wards).', '.$func->get_places("district",$district).', '.$func->get_places("city",$city);
	    $httt = htmlspecialchars($_POST['data']['httt']);
	    
	    

	    $data_donhang = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data_donhang)) { foreach($data_donhang as $column => $value) $data_donhang[$column] = htmlspecialchars($value); }
	    $htttText = $func->get_payments($data_donhang['httt']);
	    $yeucaukhac = htmlspecialchars($data_donhang['yeucaukhac']);
		$tamtinh = htmlspecialchars($_POST['price-temp']);
		$ship = htmlspecialchars($_POST['price-ship']);
		$endow = htmlspecialchars($_POST['price-endow']);
		$endowID = htmlspecialchars($_POST['price-endowID']);
		$endowType = htmlspecialchars($_POST['price-endowType']);
		$total = htmlspecialchars($_POST['price-total']);
	    $ngaydangky = time();
	    $chitietdonhang = '';
	    $max = count($_SESSION['cart']);

	    for($i=0;$i<$max;$i++)
	    {
	    	$pid = $_SESSION['cart'][$i]['productid'];
			$q = $_SESSION['cart'][$i]['qty'];
			$color = $_SESSION['cart'][$i]['mau'];					
			$size = $_SESSION['cart'][$i]['size'];
			$code = $_SESSION['cart'][$i]['code'];
			$proinfo = $cart->get_product_info($pid);
			$pmau = $cart->get_product_mau($color);
			$psize = $cart->get_product_size($size);
			$textsm='';
			if($pmau!='' && $psize!='') $textsm = $pmau." - ".$psize;
			else if($pmau!='') $textsm = $pmau;
			else if($psize!='') $textsm = $psize;

			if($q==0) continue;
	    	$chitietdonhang.='<tbody bgcolor="';
	    	if($i%2==0) $chitietdonhang.='#eee';
	    	else $chitietdonhang.='#e6e6e6';

	    	$chitietdonhang.='" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"><tr>';
	    	$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top">';
	    	$chitietdonhang.='<span style="display:block;font-weight:bold">'.$proinfo['ten'.$lang].'</span>';
	    	if($textsm!='') $chitietdonhang.='<span style="display:block;font-size:12px">'.$textsm.'</span>';
	    	$chitietdonhang.='</td>';
	    	if($proinfo['giamoi'])
	    	{
	    		$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top">';
	    		$chitietdonhang.='<span style="display:block;color:#ff0000;">'.number_format($proinfo['giamoi'],2,'.',',').' USD'.'</span>';
	    		$chitietdonhang.='<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.number_format($proinfo['gia'],2,'.',',').' USD'.'</span>';
	    		$chitietdonhang.='</td>';
	    	}
	    	else
	    	{
	    		$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.number_format($proinfo['gia'],2,'.',',').' USD'.'</span></td>';
	    	}
	    	$chitietdonhang.='<td align="center" style="padding:3px 9px" valign="top">'.$q.'</td>';
	    	if($proinfo['giamoi'])
	    	{
	    		$chitietdonhang.='<td align="right" style="padding:3px 9px" valign="top">';
	    		$chitietdonhang.='<span style="display:block;color:#ff0000;">'.number_format($proinfo['giamoi']*$q,2,'.',',').' USD'.'</span>';
	    		$chitietdonhang.='<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.number_format($proinfo['gia']*$q,2,'.',',').' USD'.'</span>';
	    		$chitietdonhang.='</td>';
	    	}
	    	else
	    	{
	    		$chitietdonhang.='<td align="right" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.number_format($proinfo['gia']*$q,2,'.',',').' USD'.'</span></td>';
	    	}
	    	$chitietdonhang.='</tr></tbody>';
	    }

	    $chitietdonhang.='
		<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
			<tr>
				<td align="right" colspan="3" style="padding:5px 9px">Provisional</td>
				<td align="right" style="padding:5px 9px"><span>'.number_format($tamtinh,0, '', '.').'đ</span></td>
			</tr>';
			if($ship)
			{
				$chitietdonhang.=
				'<tr>
					<td align="right" colspan="3" style="padding:5px 9px">Transport fee</td>
					<td align="right" style="padding:5px 9px"><span>'.number_format($ship,0, '', '.').'đ</span></td>
				</tr>';
			}
			if($endowID)
			{
				if($endowType==1)
				{
					$chitietdonhang.=
					'<tr>
						<td align="right" colspan="3" style="padding:5px 9px">Endow</td>
						<td align="right" style="padding:5px 9px"><span>-'.$endow.'%</span></td>
					</tr>';
				}
				else if($endowType==2)
				{
					$chitietdonhang.=
					'<tr>
						<td align="right" colspan="3" style="padding:5px 9px">Endow</td>
						<td align="right" style="padding:5px 9px"><span>-'.number_format($endow,0, '', '.').'đ</span></td>
					</tr>';
				}
			}
			$chitietdonhang.='
			<tr bgcolor="#eee">
				<td align="right" colspan="3" style="padding:7px 9px"><strong><big>Total order value</big> </strong></td>
				<td align="right" style="padding:7px 9px"><strong><big><span>'.number_format($total,0, '', '.').'đ</span> </big> </strong></td>
			</tr>
		</tfoot>';

		/* Nội dung gửi email cho admin */
		$contentAdmin = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#000" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#000" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Welcome</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">You receive order information at the website '.$emailer->getEmail('company:website').'</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Information line #'.$madonhang.' </h3>
													</td>
												</tr>
												<tr>
													<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<thead>
															<tr>
																<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Billing Information</th>
																<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Delivery address</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
																<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
																'.$dienthoai.'</td>
																<td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
																 <a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
																'.$diachi.'<br>
																 Tel: '.$dienthoai.'</td>
															</tr>
															<tr>
																<td colspan="2" style="padding:7px 0px 0px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
																<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> '.$htttText.'';
																if($ship)
																{
																	$contentAdmin.='<br><strong>Transport fee: </strong> '.number_format($ship,2,'.',',').' USD';
																}
																if($endowID)
																{
																	if($endowType==1)
																	{
																		$contentAdmin.='<br><strong>Endow: </strong> -'.$endow.'%';
																	}
																	else if($endowType==2)
																	{
																		$contentAdmin.='<br><strong>Endow: </strong> -'.$endow.' USD';
																	}
																}
																$contentAdmin.='</td>
															</tr>
														</tbody>
													</table>
													</td>
												</tr>
												<tr>
													<td>
													<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Other requirements:</strong> <i>'.$yeucaukhac.'</i></p>
													</td>
												</tr>
												<tr>
													<td>
													<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:'.$emailer->getEmail('color').'">ORDER DETAILS</h2>
													<table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
														<thead>
															<tr>
																<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Product</th>
																<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Unit price</th>
																<th align="center" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;min-width:55px;">Quantity</th>
																<th align="right" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Temporary total</th>
															</tr>
														</thead>
														'.$chitietdonhang.'
													</table>
													</td>
												</tr>
												<tr>
													<td>
													<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;margin-top:10px;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">You received this email because you made a purchase at '.$emailer->getEmail('company:website').'.<br>
								To be sure to always receive email notifications, purchase confirmation from '.$emailer->getEmail('company:website').', Please add your address <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Address:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Nội dung gửi email cho khách hàng */
		$contentCustomer = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đặt hàng tại '.$emailer->getEmail('company:website').'</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Chúng tôi rất vui thông báo đơn hàng #'.$madonhang.' của quý khách đã được tiếp nhận và đang trong quá trình xử lý. '.$emailer->getEmail('company:website').' sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Information line #'.$madonhang.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày '.date('d',$emailer->getEmail('datesend')).' tháng '.date('m',$emailer->getEmail('datesend')).' năm '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Billing Information</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Delivery address</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
														<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
														'.$dienthoai.'</td>
														<td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
														 <a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
														'.$diachi.'<br>
														 Tel: '.$dienthoai.'</td>
													</tr>
													<tr>
														<td colspan="2" style="padding:7px 0px 0px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
														<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> '.$htttText.'';
														if($ship)
														{
															$contentCustomer.='<br><strong>Transport fee: </strong> '.number_format($ship,2,'.',',').' USD';
														}
														if($endowID)
														{
															if($endowType==1)
															{
																$contentCustomer.='<br><strong>Endow: </strong> -'.$endow.'%';
															}
															else if($endowType==2)
															{
																$contentCustomer.='<br><strong>Endow: </strong> -'.$endow.' USD';
															}
														}
														$contentCustomer.='</td>
													</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Other requirements:</strong> <i>'.$yeucaukhac.'</i></p>
											</td>
										</tr>
										<tr>
											<td>
											<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:'.$emailer->getEmail('color').'">ORDER DETAILS</h2>

											<table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
												<thead>
													<tr>
														<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Product</th>
														<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Unit price</th>
														<th align="center" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;min-width:55px;">Quantity</th>
														<th align="right" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Temporary total</th>
													</tr>
												</thead>
												'.$chitietdonhang.'
											</table>
											<div style="margin:auto;text-align:center"><a href="'.$emailer->getEmail('home').'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-top:5px" target="_blank">Order details at '.$emailer->getEmail('company:website').'</a></div>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Need help right away? Just send an email to <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, or call the hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' always ready to help you at any time.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Once again '.$emailer->getEmail('company:website').' thank you.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">You received this email because you made a purchase at '.$emailer->getEmail('company:website').'.<br>
								To be sure to always receive email notifications, purchase confirmation from '.$emailer->getEmail('company:website').', Please add your address <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> Enter the address number (Address Book, Contacts) of the email box.<br>
								<b>Address:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* lưu đơn hàng */
		$data_donhang['id_user'] = ($_SESSION[$login_member]['id']) ? $_SESSION[$login_member]['id'] : 0;
		$data_donhang['madonhang'] = $madonhang;
		$data_donhang['phiship'] = $ship;
		$data_donhang['phicoupon'] = $endow;
		$data_donhang['loaicoupon'] = $endowType;
		$data_donhang['idcoupon'] = $endowID;
		$data_donhang['tamtinh'] = $tamtinh;
		$data_donhang['tonggia'] = $total;
		$data_donhang['ngaytao'] = $ngaydangky;
		$data_donhang['tinhtrang'] = 1;
		$data_donhang['stt'] = 1;
		$id_insert = $d->insert('order',$data_donhang);

		if($id_insert)
		{
			for($i=0;$i<$max;$i++)
			{
				$pid = $_SESSION['cart'][$i]['productid'];
				$q = $_SESSION['cart'][$i]['qty'];
				$proinfo = $cart->get_product_info($pid);
				$gia = $proinfo['gia'];
				$giamoi = $proinfo['giamoi'];
				$code = $_SESSION['cart'][$i]['code'];
				$size = $_SESSION['cart'][$i]['size'];
				$code = $_SESSION['cart'][$i]['code'];
				$proinfo = $cart->get_product_info($pid);
				$pmau = $cart->get_product_mau($color);
				$psize = $cart->get_product_size($size);
				if($q==0) continue;

				$data_donhangchitiet['id_product'] = $pid;
				$data_donhangchitiet['id_order'] = $id_insert;
				$data_donhangchitiet['photo'] = $proinfo['photo'];
				$data_donhangchitiet['ten'] = $proinfo['ten'.$lang];
				$data_donhangchitiet['mau'] = $pmau;
				$data_donhangchitiet['size'] = $psize;
				$data_donhangchitiet['gia'] = $gia;
				$data_donhangchitiet['giamoi'] = $giamoi;
				$data_donhangchitiet['soluong'] = $q;
				$_SESSION['orrder-success']['tensp'][]=$data_donhangchitiet['ten'];
				$d->insert('order_detail',$data_donhangchitiet);
			}
		}

		if(!empty($optsetting['email'])){
			$arrayEmail = null;
			$subject = "Order Confirmation Notice #".$madonhang;
			$message = $contentAdmin;
			//$emailer->sendEmail("admin", $arrayEmail, $subject, $message, $file);
		}
		/* Send email customer */
		if(!empty($email)){
			$arrayEmail = array(
				"dataEmail" => array(
					"name" => $hoten,
					"email" => $email
				)
			);
			$subject = "Thông báo xác nhận đơn hàng #".$madonhang;
			$message = $contentCustomer;
			//$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file);
		}
		$_SESSION['orrder-success']['ten']=$data_donhang['hoten'];
		$_SESSION['orrder-success']['diachi']=$data_donhang['diachi'];
		$_SESSION['orrder-success']['gia']=number_format($data_donhang['tonggia'],0, ',', '.')."đ";
		unset($_SESSION['coupon']);
	  	unset($_SESSION['cart']);
		$func->transfer('Order successfully <br/>Your order number is: '.$madonhang, $config_base);
	}
?>