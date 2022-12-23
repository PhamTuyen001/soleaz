<?php
	include "ajax_config.php";

	$code = htmlspecialchars($_POST['code']);
	$ship = htmlspecialchars($_POST['ship']);
	$endow = htmlspecialchars($_POST['endow']);
	$endowID = htmlspecialchars($_POST['endowID']);
	if(!empty($endowID)) $coupon = $d->rawQueryOne("SELECT * FROM #_coupon where id = ?",array($endowID));
	$cart->remove_product($code);
	
	$max = count($_SESSION['cart']);
	$temp = $cart->get_order_total();
	$tempText = number_format($temp,2, '.', ',')." USD";
	$total = $cart->get_order_total() + $ship;
	if(!empty($coupon['id']) && $coupon['gia']<$total)
	{
		$endowID = $coupon['id'];
		$endowType = $coupon['loai'];
		if($endowType==1)
		{
			$endow =$total*($coupon['chietkhau']/100);
			$total = $total - $endow;
			$endowText = "-".number_format($endow,2,'.',',')." USD";
			
		}
		if($endowType==2)
		{
			$total = $total - $coupon['chietkhau'];
			$endowText = "-".number_format($coupon['chietkhau'],2, '.', ',')." USD";
			$endow =$coupon['chietkhau'];
		}
	}else{
		$endow = 0;
		$endowType = 0;
		$endowText = '—';
		$endowID='';
	}

	$totalText = number_format($total,2, '.', ',')." USD";

	$data = array('max' => $max, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText,'endow' => $endow, 'endowID' => $endowID, 'endowType' => $endowType, 'endowText' => $endowText);
	echo json_encode($data);
?>