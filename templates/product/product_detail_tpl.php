<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="wrap-detail_product py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="row-album-photo">
                            <div class="thumbs-photo-slick">
                                <div class="slick-thumbs">
                                    <div>
                                        <p>
                                            <a href="javascript:void(0);">
                                                <img src="<?=THUMBS?>/100x100x2/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                            </a>
                                        </p>
                                    </div>
                                    <?php foreach ($hinhanhsp as $v) {?>
                                    <div>
                                        <p>
                                            <a href="javascript:void(0);">
                                                <img src="<?=THUMBS?>/100x100x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                            </a>
                                        </p>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="main-photo-slick">
                                <div class="slick-main">
                                    <div>
                                        <p>
                                            <a href="javascript:void(0);">
                                                <img src="<?=THUMBS?>/600x600x2/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                            </a>
                                        </p>
                                    </div>
                                    <?php foreach ($hinhanhsp as $v) {?>
                                    <div>
                                        <p>
                                            <a href="javascript:void(0);">
                                                <img src="<?=THUMBS?>/600x600x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                            </a>
                                        </p>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"><span class="slider__label sr-only"></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-5"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php if(count($product)>0) { ?>
<section class="wrap-lienquan py-5">
    <div class="container">
        <div class="title-product mb-5">
            <h6 class="font-weight-bold"><?=sanphamcungloai?></h6>
        </div>
        <div class="row-products row-arrows">
            <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="1" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
                <?php foreach ($product as $v) {
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
<?php } ?>