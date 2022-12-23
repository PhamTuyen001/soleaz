<section class="warp-banner-inpage">
    <p class="text-center">
        <img class="w-100" src="<?=UPLOAD_PHOTO_L.$banner['photo']?>" alt="<?=$setting['ten'.$lang]?>">
    </p>
</section>
<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="page-account py-5">
    <div class="container">
        <div class="row row-account">
            <div class="col-12 col-lg-2 col-account col-left-account">
                <?php include TEMPLATE.LAYOUT."left-account.php" ?>
            </div>
            <div class="col-12 col-lg-10 col-account col-right-account">
                <div class="ttile-account">
                    <h2><?=myvoucher?></h2>
                </div>
                <div class="vou__wrap row fl-wrap d-flex flex-wrap">
                    <?php foreach ($coupon as $k => $v) {?>
                    <div class="col-12 col-md-6">
                        <div class="vou__item">
                            <div class="vou__txt f-bold">
                                <p class="text-uppercase font-weight-bold"><?=$v['ten'.$lang]?></p>
                            </div>
                            <div class="vou__txt"><?=ngaybatdau?>: <?=date('d/m/Y',$v['ngaybatdau'])?></div>
                            <div class="vou__txt"><?=hansudung?> <?=date('d/m/Y',$v['ngayketthuc'])?></div>
                            <div class="vou__code vouCP copy-coupon" data-voucher="<?=$v['ma']?>">
                                <?=$v['ma']?> <img src="assets/images/copy.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>