<?php 
    $banner = $d->rawQueryOne("SELECT id, photo FROM #_photo WHERE type = ? AND act = ? limit 0,1",array('bn-'.$com,'photo_static'));
    $product_noibat = $d->rawQuery("SELECT id,tenkhongdauvi,tenkhongdauen,tenkhongdautl,tenvi,tenen,tentl,photo,photo2,gia,giakm,giamoi,moi FROM #_product WHERE hienthi=1 AND type = ? AND noibat>0 ORDER BY stt,id DESC",array('san-pham'));
?>
<section class="warp-banner-inpage">
    <p class="text-center">
        <img class="w-100" src="<?=UPLOAD_PHOTO_L.$banner['photo']?>" alt="<?=$setting['ten'.$lang]?>">
    </p>
</section>
<div class="show_list_prodduct py-5">
    <div class="container">
        <div class="title-product text-center mb-5">
            <h2 class="font-weight-normal"><?=fashionnole?></h2>
        </div>
        <div class="row-product-list">
            <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='1' data-slidesDefault="6:1" data-lg-items='6:1' data-md-items='6:1' data-sm-items='6:1' data-xs-items="6:1" data-vertical="0">
                <?php foreach ($splistmenu as $k => $v) {?>
                <div class="col-product-list">
                    <div class="box-product-list">
                        <a href="<?=$v[$sluglang]?>">
                            <span>
                                <img src="<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten']?>">
                            </span>
                            <p><?=$v['ten']?></p>
                        </a>
                    </div>
                </div> 
                <?php }?>
            </div>
        </div>
    </div>
</div>

<section class="product-noibat py-5">
    <div class="container">
        <div class="title-product mb-5">
            <h6 class="font-weight-normal"><?=sanphamnoibat?></h6>
        </div>
        <div class="row-products row-arrows">
            <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="1" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
                <?php foreach ($product_noibat as $v) {
                    $row_color=$d->rawQuery("select mau,id from #_product_mau where id in (select id_mau from #_product where id_product = ? and hienthi=1)",array($v['id']));
                ?>
                <div class="col-product">
                    <?php include TEMPLATE.LAYOUT."sanpham.php"; ?>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>
