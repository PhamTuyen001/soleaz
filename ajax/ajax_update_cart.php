<?php
	include "ajax_config.php";

	$pid = htmlspecialchars($_POST['pid']);
	$q = htmlspecialchars($_POST['q']);
	$code = htmlspecialchars($_POST['code']);
	$ship = htmlspecialchars($_POST['ship']);
	//$endow = htmlspecialchars($_POST['endow']);
	$endowID = htmlspecialchars($_POST['endowID']);
	$max = count($_SESSION['cart']);
	if(!empty($endowID)) $coupon = $d->rawQueryOne("SELECT * FROM #_coupon where id = ?",array($endowID));
	$total1 = $cart->get_order_total() ;
	
		
	for($i=0;$i<$max;$i++)
	{
		if($code == $_SESSION['cart'][$i]['code'])
		{
			if($q) $_SESSION['cart'][$i]['qty'] = $q;
			break;
		}
	}

	$proinfo = $cart->get_product_info($pid);
	$price=($proinfo['giamoi']>0)?$proinfo['giamoi']:$proinfo['gia'];
	$gia = number_format($price*$q,2, '.', ',')."&nbsp; USD";
	$temp = $cart->get_order_total();
	$tempText = number_format($temp,2, '.', ',')."&nbsp; USD";
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
	$totalText = number_format($total,2, '.', ',')."&nbsp; USD";
	$data = array('gia' => $gia, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText,'endow' => $endow, 'endowID' => $endowID, 'endowType' => $endowType, 'endowText' => $endowText);
	echo json_encode($data);
?>