<?php 
	if(!defined('SOURCES')) die("Error");
	
	if(isset($_POST['submit-contact']))
	{
        $responseCaptcha = $_POST['recaptcha_response_contact'];
        $resultCaptcha = $func->checkRecaptcha($responseCaptcha);

        if(($resultCaptcha['score'] >= 0.5 && $resultCaptcha['action'] == 'contact') || $resultCaptcha['test'])
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($file = $func->uploadImage("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|xlsx|jpg|png|gif|JPG|PNG|GIF', UPLOAD_FILE_L,$file_name))
			{
				$data['taptin'] = $file;
			}

		    $data['ten'] = htmlspecialchars($_POST['ten']);
		    $data['dienthoai'] = htmlspecialchars($_POST['dienthoai']);
			$data['email'] = htmlspecialchars($_POST['email']);
		    $data['noidung'] = htmlspecialchars($_POST['noidung']);
		    $data['ngaytao'] = time(); 
		    $data['stt'] = 1;
		    $d->insert('contact',$data);
			
		    /* Gán giá trị gửi email */
		    $emailer->setEmail('tennguoigui',$data['ten']);
		    $emailer->setEmail('emailnguoigui',$data['email']);
		    $emailer->setEmail('dienthoainguoigui',$data['dienthoai']);
		    $emailer->setEmail('tieudelienhe','Contact information from '.$setting['ten'.$lang]);
		    $emailer->setEmail('noidunglienhe',$data['noidung']);
		    if($emailer->getEmail('tennguoigui'))
		    {
		    	$strThongtin .= '<span style="text-transform:capitalize">'.$emailer->getEmail('tennguoigui').'</span><br>';
		    }
		    if($emailer->getEmail('emailnguoigui'))
		    {
		    	$strThongtin .= '<a href="mailto:'.$emailer->getEmail('emailnguoigui').'" target="_blank">'.$emailer->getEmail('emailnguoigui').'</a><br>';
		    }
		    if($emailer->getEmail('diachinguoigui'))
		    {
		    	$strThongtin .= ''.$emailer->getEmail('diachinguoigui').'<br>';
		    }
		    if($emailer->getEmail('dienthoainguoigui'))
		    {
		    	$strThongtin .= 'Tel: '.$emailer->getEmail('dienthoainguoigui').'';
		    }
		    $emailer->setEmail('thongtin',$strThongtin);

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
											<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
												<tbody>
													<tr>
														<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
															<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
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
									<tr style="background:#fff">
										<td align="left" height="auto" style="padding:15px" width="600">
											<table>
												<tbody>
													<tr>
														<td>
															<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào</h1>
															<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">You received a contact letter from the customer <span style="text-transform:capitalize">'.$emailer->getEmail('tennguoigui').'</span> at the website '.$emailer->getEmail('company:website').'.</p>
															<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Contact information </h3>
														</td>
													</tr>
												<tr>
												<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding:3px 0px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">'.$emailer->getEmail('thongtin').'</td>
														</tr>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td>
												<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'.$emailer->getEmail('noidunglienhe').'</i></p>
												</td>
											</tr>
											<tr>
												<td>&nbsp;
													<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Do you need support now? Just send mail back <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, or call the hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> . '.$emailer->getEmail('company:website').' always ready to help you at any time.</p>
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
									<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">You received this email because you contacted us at '.$emailer->getEmail('company:website').'.<br>
									To be sure to always receive email notifications, feedback from '.$emailer->getEmail('company:website').', Please add your address <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> Enter the address number (Address Book, Contacts) of the email box.<br>
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
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr style="background:#fff">
										<td align="left" height="auto" style="padding:15px" width="600">
											<table>
												<tbody>
													<tr>
														<td>
															<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào Quý khách</h1>
															<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Your contact information has been received. '.$emailer->getEmail('company:website').' will respond as soon as possible.</p>
															<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Contact information </h3>
														</td>
													</tr>
												<tr>
												<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding:3px 0px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">'.$emailer->getEmail('thongtin').'</td>
														</tr>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td>
												<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'.$emailer->getEmail('noidunglienhe').'</i></p>
												</td>
											</tr>
											<tr>
												<td>&nbsp;
													<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Do you need support now? Just send mail back <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, or call the hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> . '.$emailer->getEmail('company:website').' always ready to help you at any time.</p>
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
									<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">You received this email because you contacted us at '.$emailer->getEmail('company:website').'.<br>
									To be sure to always receive email notifications, feedback from '.$emailer->getEmail('company:website').', Please add your address <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> Enter the address number (Address Book, Contacts) of the email box.<br>
									<b>Address:</b> '.$emailer->getEmail('company:address').'</p>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>';

			/* Send email admin */
			$arrayEmail = null;
			$subject = "Thư liên hệ từ ".$setting['ten'.$lang];
			$message = $contentAdmin;
			$file = 'file';

			if($emailer->sendEmail("admin", $arrayEmail, $subject, $message, $file))
			{
				/* Send email customer */
				$arrayEmail = array(
					"dataEmail" => array(
						"name" => $emailer->getEmail('tennguoigui'),
						"email" => $emailer->getEmail('emailnguoigui')
					)
				);
				$subject = "Contact letter from ".$setting['ten'.$lang];
				$message = $contentCustomer;
				$file = 'file';

				if($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transfer(guilienhethanhcong,$config_base);
			}
			else $func->transfer(guilienhethatbai,$config_base, false);
		}
		else
		{
			$func->transfer(guilienhethatbai,$config_base, false);
		}
	}

	/* SEO */
	$seopage = $d->rawQueryOne("SELECT * FROM #_seopage WHERE type = ? LIMIT 0,1",array('lien-he'));
	$seo->setSeo('h1',$title_crumb);
	if($seopage['title'.$seolang]!='') $seo->setSeo('title',$seopage['title'.$seolang]);
	else $seo->setSeo('title',$title_crumb);
	$seo->setSeo('keywords',$seopage['keywords'.$seolang]);
	$seo->setSeo('description',$seopage['description'.$seolang]);
	$seo->setSeo('url',$func->getPageURL());
	$img_json_bar = json_decode($seopage['options'],true);
	if($img_json_bar['p'] != $seopage['photo'])
	{
		$img_json_bar = $func->getImgSize($seopage['photo'],UPLOAD_SEOPAGE_L.$seopage['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar),'seopage',$seopage['id']);
	}
	$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_SEOPAGE_L.$seopage['photo']);
	$seo->setSeo('photo:width',$img_json_bar['w']);
	$seo->setSeo('photo:height',$img_json_bar['h']);
	$seo->setSeo('photo:type',$img_json_bar['m']);
	
    $lienhe = $d->rawQueryOne("select noidung$lang from #_static where type = ?",array('lienhe'));
    $icon = $d->rawQuery("SELECT ten$lang, photo, link FROM #_photo WHERE type = ? AND hienthi=1 ORDER BY stt asc,id DESC",array('icon-lienhe'));
	/* breadCrumbs */
	if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
?>