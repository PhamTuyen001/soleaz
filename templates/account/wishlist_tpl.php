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
                    <h2><?=mywishlist?></h2>
                </div>
                <div class="row">
                    <?php foreach ($product as $k => $v) {
                        $row_color=$d->rawQuery("select mau,id from #_product_mau where id in (select id_mau from #_product where id_product = ? and hienthi=1)",array($v['id']));
                    ?>
                    <div class="col-12 col-product-search col-sm-6 col-md-4 my-4">
                        <?php include TEMPLATE.LAYOUT."sanpham.php"; ?>
                    </div>  
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>