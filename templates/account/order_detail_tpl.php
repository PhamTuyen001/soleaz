<section class="warp-banner-inpage">
    <p class="text-center">
        <img class="w-100" src="<?=UPLOAD_PHOTO_L.$banner['photo']?>" alt="<?=$setting['ten'.$lang]?>">
    </p>
</section>
<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="page-account py-5">
    <div class="container">
        <div class="row row-account order__table">
            <div class="col-12 col-lg-2 col-account col-left-account">
                <?php include TEMPLATE.LAYOUT."left-account.php" ?>
            </div>
            <div class="col-12 col-lg-10 col-account col-right-account">
                <div class="ttile-account">
                    <h2><?=myorder?></h2>
                </div>
                <div class="order__table__wrap">
                    <div class="order__wrap">
                        <?php 
                            $id_tinhtrang = $myOrderCheck['tinhtrang'];
                            $tinhtrang = $d->rawQueryOne("SELECT trangthai$lang as trangthai FROM #_status WHERE id = ?",array($id_tinhtrang));
                        ?>
                        <ul>
                            <li>
                                <span><?=madon?>:</span> <b>#<?=$myOrderCheck['madonhang']?></b>
                            </li>
                            <li>
                                <span><?=orderdate?>:</span> <b><?=date('d/m/Y H:i:s',$myOrderCheck['ngaytao'])?></b>
                            </li>
                            <li>
                                <span><?=tong?>:</span> <b><?=number_format($myOrderCheck['tonggia'], 2, '.', '')?> USD</b>
                            </li>
                            <li>
                                <span><?=total?> <?=sanpham?>:</span> <b><?=count($myOrderCheck_detail)?></b>
                            </li>
                            <li>
                                <span><?=trangthai?>:</span> <b><?=$tinhtrang['trangthai']?></b>
                            </li>
                            <li>
                                <span><?=phuongthucthanhtoan?>:</span> <b><?=$func->get_payments($myOrderCheck['httt'])?></b>
                            </li>
                        </ul>
                    </div>
                    <?php if($id_tinhtrang!=5){?>
                    <div class="order__wrap_timeline">
                        <div class="row_timeline">
                            <div class="col active">
                                <div class="top-timeline">
                                    <p>Time Order</p>
                                    <span><?=date('d/m/Y H:i:s',$myOrderCheck['ngaytao'])?></span>
                                </div>
                                <div class="center-timeline"></div>
                                <div class="bottom-timeline">
                                    <p>Address</p>
                                    <span><?=$myOrderCheck['diachi']?></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="top-timeline">
                                    <p>Payment status</p>
                                    <span><?=($myOrderCheck['status_payment']==0)?'Unpaid':'Paid'?></span>
                                </div>
                                <div class="center-timeline"></div>
                                <div class="bottom-timeline">
                                    <p>Estimated delivery time</p>
                                    <span>From 3 - 5 days since ordering</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="top-timeline">
                                    <p>Total Value</p>
                                    <span><?=number_format($myOrderCheck['tonggia'], 2, '.', '')?> USD</span>
                                </div>
                                <div class="center-timeline"></div>
                                <div class="bottom-timeline">
                                    <p>Payment Infomation</p>
                                    <span><?=$myOrderCheck['diachi']?></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="top-timeline">
                                    <p>Delivery status</p>
                                    <span>Successful delivery</span>
                                </div>
                                <div class="center-timeline"></div>
                                <div class="bottom-timeline">
                                    <p>Payment method</p>
                                    <span><?=$func->get_payments($myOrderCheck['httt'])?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="order__table">
                        <div class="order__table__wrap">
                            <div class="table mt-4">
                                <div class="fl-con">
                                    <div class="col-6 title"><?=sanpham?></div>
                                    <div class="col-2 title"><?=gia?></div>
                                    <div class="col-2 title"><?=soluong?></div>
                                    <div class="col-2 title"><?=tonggiatri?></div>
                                </div>
                                <?php foreach ($myOrderCheck_detail as $v) {?>
                                <div class="fl-con">
                                        <div class="col-6 item">
                                            <?=$v['ten']?><br>
                                            <?php if($v['mau']!='' || $v['size']!='') { ?>
                                                <?php if($v['mau']!='') { ?>
                                                    <span class="pr-2"><?=color?>: <?=$v['mau']?></span>
                                                <?php } ?>
                                                <?php if($v['size']!='') { ?>
                                                    <span><?=size?>: <?=$v['size']?></span>
                                                <?php } ?>
                                            <?php } ?>    
                                        </div>
                                        <div class="col-2 item"><span class="woocommerce-Price-amount amount"><bdi><?=number_format(($v['giamoi']>0)?$v['giamoi']:$v['gia'], 2, '.', '')?>&nbsp;<span class="woocommerce-Price-currencySymbol">USD</span></bdi></span></div>
                                        <div class="col-2 item"><?=$v['soluong']?></div>
                                        <div class="col-2 item"><span class="woocommerce-Price-amount amount"><bdi><?=number_format((($v['giamoi']>0)?$v['giamoi']:$v['gia'])*$v['soluong'], 2, '.', '')?>&nbsp;<span class="woocommerce-Price-currencySymbol">USD</span></bdi></span></div>
                                </div>
                                <?php }?>
                                <div class="fl-con">
                                    <div class="col-8 item total"><?=tamtinh?></div>
                                    <div class="col-4 item"><span class="woocommerce-Price-amount amount"><bdi><?=number_format($myOrderCheck['tamtinh'], 2, '.', '')?>&nbsp;<span class="woocommerce-Price-currencySymbol">USD</span></bdi></span></div>
                                </div>
                                <div class="fl-con">
                                    <div class="col-8 item total">Coupon</div>
                                    <div class="col-4 item"><span class="woocommerce-Price-amount amount"><bdi><?=number_format($myOrderCheck['phicoupon'], 2, '.', '')?>&nbsp;<span class="woocommerce-Price-currencySymbol">USD</span></bdi></span></div>
                                </div>
                                <div class="fl-con">
                                    <div class="col-8 item total"><?=tonggiatri?></div>
                                    <div class="col-4 item"><span class="woocommerce-Price-amount amount"><bdi><?=number_format($myOrderCheck['tonggia'], 2, '.', '')?>&nbsp;<span class="woocommerce-Price-currencySymbol">USD</span></bdi></span></div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>