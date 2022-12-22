<?php
	include "ajax_config.php";
?>
<div class="cart__list count-cart">
<?php if(!empty($_SESSION['cart'])){?>
<?php for($i=0;$i<count($_SESSION['cart']);$i++) {
$pid = $_SESSION['cart'][$i]['productid'];
$q = $_SESSION['cart'][$i]['qty'];
$mau = ($_SESSION['cart'][$i]['mau'])?$_SESSION['cart'][$i]['mau']:0;
$size = ($_SESSION['cart'][$i]['size'])?$_SESSION['cart'][$i]['size']:0;
$code = ($_SESSION['cart'][$i]['code'])?$_SESSION['cart'][$i]['code']:"";
$proinfo = $cart->get_product_info($pid);
$pro_price = $proinfo['gia'];
$pro_price_new = $proinfo['giamoi'];
$pro_price_qty = $pro_price*$q;
$pro_price_new_qty = $pro_price_new*$q; ?>
    <div class="cart__item fl-ct procart-<?=$code?> c-cus-<?=$code?>" data-key="<?=$code?>">
        <div class="cart__img">
            <a class="rto-box" href="<?=$proinfo[$sluglang]?>">
                <img width="300" height="300" src="<?=THUMBS?>/300x300x2/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>">
            </a>
        </div>
        <div class="cart__info">
            <div class="wrap-title">
                <a class="title" href="<?=$proinfo[$sluglang]?>"><?=$proinfo['ten'.$lang]?></a>                            
                <div class="m-remove remove-item-cart tooltip-confirm-remove-now">
                    <span class="m-btn-loading sp-cf-remove">
                        x
                    </span>
                    <div class="confirm-remove-item-cart">
                        <?=bancochackhong?>
                        <a href="javascript:void(0)" data-code="<?=$code?>" data-event="confirm"><?=xoa?></a>
                        <a href="javascript:void(0)" data-event="cancel"><?=cancel?></a>
                    </div>
                </div>
            </div>
            <?php if($mau) { $maudetail = $d->rawQueryOne("SELECT ten$lang FROM #_product_mau WHERE type = ? AND id = ?",array($proinfo['type'],$mau)); ?>
                <div class="txt">
                    <?=color?>:<span class="color text-uppercase"> <?=$maudetail['ten'.$lang]?> </span>
                </div>
            <?php } ?>
            <?php if($size) { $sizedetail = $d->rawQueryOne("SELECT ten$lang FROM #_product_size WHERE type = ? AND id = ?",array($proinfo['type'],$size)); ?>
                <div class="txt">
                    <?=size?>:<span class="size text-uppercase"> <?=$sizedetail['ten'.$lang]?> </span>
                </div>
            <?php } ?>
            <div class="fl-ct">
                <div class="amount fl-ct amoJS">
                    <div class="minus hov-df amoM"></div>
                    <input type="number" class="number rs-form amoVal m-change-quantity" data-pid="<?=$pid?>" data-code="<?=$code?>" value="<?=$q?>" min="0" max="999">
                    <div class="plus hov-df amoP"></div>
                </div>
                <div class="price mg-l mona-custom-price-item-cart">
                    <span class="woocommerce-Price-amount amount"><bdi class="load-price-<?=$code?> price-new-cart"><?=($pro_price_new_qty>0)?number_format($pro_price_new_qty, 2, '.', ','):number_format($pro_price_qty, 2, '.', ',')?>&nbsp; USD</bdi></span>            
                </div>
            </div>
            <small class="cart__notify"></small>
        </div>
    </div>
<?php } ?>
<?php }else{?>
<?=khongtontaisanphamtronggiohang?>
<?php }?>
</div>
<hr>
<div class="cart__sub">
    <div class="fl-ct cart__sub__wrap">
        <div class="title"><?=tamtinh?></div>
        <div class="price mg-l"><span class="woocommerce-Price-amount amount"><bdi class="total-price load-price-temp"><?=number_format($cart->get_order_total(),2, '.', '.')?>&nbsp; USD</bdi></span></div>
    </div>
    <a href="checkout" class="dp-block cart__sub__btn btn-pri c-whi hov-df  "><?=thanhtoan?></a>
</div>

