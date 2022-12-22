<?php
	include "ajax_config.php";

	$coupon = htmlspecialchars($_POST['coupon']);
	$ship = htmlspecialchars($_POST['ship']);
	$flag = 1;
	$error = "";
	$total = $cart->get_order_total() + $ship;
	$coupon = $d->rawQueryOne("SELECT * FROM #_coupon where ma = ?",array($coupon));

	if($coupon['ngayketthuc']<time())
	{
		$flag = 0;
		$error = mauudaidahethan;
	}

	if(!$coupon['id'] || $coupon['tinhtrang']!=0)
	{
		$flag = 0;
		$error = mauudaidaduocsudunghoackhongtontai;
	}
	if((double)$coupon['gia']>$total){
		$flag = 0;
		$error = chuadudieukienapdung;
	}
	
	if($flag)
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
		$totalText = number_format($total,2, '.', ',')." USD";
	}
	else
	{
		$totalText = number_format($total,2, '.', ',')." USD";
		$endow = 0;
		$endowType = 0;
		$endowText = '—';
	}

	$data = array('error' => $error, 'endow' => $endow, 'endowID' => $endowID, 'endowType' => $endowType, 'endowText' => $endowText, 'total' => $total, 'totalText' => $totalText);
	echo json_encode($data);
?>