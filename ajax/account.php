<?php 
	include "ajax_config.php";
	$action=$_POST['action'];
	switch ($action) {
		case 'login':
			accountLoggin();
			break;
		
		default:
			break;
	}
	function accountLoggin(){
		global $d,$lang,$config,$func,$emailer,$optsetting,$setting;
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		$pass=$func->encrypt_password($config['website']['secret'], $data['password'],$config['website']['salt']);
		$pass_ree=$func->encrypt_password($config['website']['secret'], $_POST['register_repass'],$config['website']['salt']);
		$error=array();
		$data_res=array();
		if($pass!=$pass_ree){
			$data_res['mess']=nhaplaimatkhaukhongchinhxac;
			$data_res['error']=1;
			echo json_encode($data_res);die;
		}
		$checkMember=$d->rawQuery("select * from #_member where email = ? or dienthoai=?",array($data['email'],$data['dienthoai']));
		if(!empty($checkMember)){
			$data_res['mess']=emailorsodienthoaidatontai;
			$data_res['error']=1;
			echo json_encode($data_res);die;
		}
		$data['password']=$pass;
		$data['hienthi']=1;
		$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
		if($d->insert('member',$data))
		{
			$data_res['error']=0;
			echo json_encode($data_res);
			$id_insert = $d->getLastInsertId();
			send_active_user($id_insert);
			die;
		}
		else
		{
			$data_res['mess']=coloixayravuilongthulaisau;
			$data_res['error']=1;
			echo json_encode($data_res);die;
		}

	}

	function send_active_user($id){
		global $d, $setting, $emailer, $func, $config_base, $lang;
		$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where id = ? limit 0,1",array($id));
		$htmlEmail='<table style="border-spacing:0;border-collapse:collapse;height:100%!important;width:100%!important">
      		<tbody>
      			<tr>
        		<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">';
					$htmlEmail .='<table style="border-spacing:0;border-collapse:collapse;width:100%;margin:40px 0 20px">
  						<tbody>
  							<tr>
    							<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
      								<center>
        								<table style="border-spacing:0;border-collapse:collapse;width:560px;text-align:left;margin:0 auto">
          									<tbody>
          										<tr>
            										<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
              											<table style="border-spacing:0;border-collapse:collapse;width:100%">
                											<tbody>
                												<tr>
                  													<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                  														<h1 style="font-weight:normal;margin:0;font-size:30px;color:#333">
                        													<a href="'.$config_base.'" style="font-size:30px;text-decoration:none;color:#333" target="_blank" h><span class="il">'.$setting['ten'.$lang].'</span>
                        													</a>
                      													</h1>
                  													</td>
                												</tr>
              												</tbody>
              											</table>
            										</td>
      											</tr>
        									</tbody>
        								</table>
      								</center>
    							</td>
  							</tr>
						</tbody>
					</table>';
          			$htmlEmail .='<table style="border-spacing:0;border-collapse:collapse;width:100%">
  						<tbody>
  							<tr>
    							<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px">
     								 <center>
        								<table style="border-spacing:0;border-collapse:collapse;width:560px;text-align:left;margin:0 auto">
          									<tbody>
          										<tr>
            										<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
            											<h2 style="font-weight:normal;margin:0;font-size:24px;margin-bottom:10px">Welcome to <span class="il">'.$setting['ten'.$lang].'</span>! </h2>
        												<p style="margin:0;color:#777;line-height:150%;font-size:16px">Congratulations, you have successfully activated your customer account. Next time you make a purchase, log in to make payment more convenient.
        												</p>
      													<table style="border-spacing:0;border-collapse:collapse;width:100%;margin-top:20px">
        													<tbody>
        														<tr>
          															<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
            															<table style="border-spacing:0;border-collapse:collapse;float:left;margin-right:15px">
                  															<tbody>
                  																<tr>
                    																<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;text-align:center;padding:20px 25px;border-radius:4px;background:#1666a2">
                    																	<a href="'.$config_base.'" style="font-size:16px;text-decoration:none;color:#fff" target="_blank">Visit our store
                    																	</a>
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
											</tbody>
										</table>
									</center>
								</td>
							</tr>
						</tbody>
					</table>';

          			$htmlEmail .="<table style='border-spacing:0;border-collapse:collapse;width:100%;border-top:1px solid #e5e5e5'>
  						<tbody>
  							<tr>
    							<td style='font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:35px 0'>
      								<center>
        								<table style='border-spacing:0;border-collapse:collapse;width:560px;text-align:left;margin:0 auto'>
          									<tbody>
          										<tr>
            										<td style='font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif'>
              											<p style='margin:0;color:#999;line-height:150%;font-size:14px'>If you have any questions, don't hesitate to contact us at 
              												<a href='mailto:".$optsetting['email']."' style='font-size:14px;text-decoration:none;color:#1666a2' target='_blank'>".$optsetting['email']."</a>
              											</p>
            										</td>
          										</tr>
        									</tbody>
        								</table>
      								</center>
    							</td>
  							</tr>
						</tbody>
					</table>";
        		$htmlEmail .="</td>
      		</tr>
    	</tbody></table>";

    	$arrayEmail = array(
			"dataEmail" => array(
				"name" => $row['ten'],
				"email" => $row['email']
			)
		);
		$subject = $setting['ten'.$lang]." - Customer account confirmation";
		$emailer->sendEmail("customer", $arrayEmail, $subject, $htmlEmail, $file);

	}
?>