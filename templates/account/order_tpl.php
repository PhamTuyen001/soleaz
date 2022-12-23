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
                    <?php foreach ($row_order as $v) {
                        $detail = $d->rawQueryOne("select count(id) as dem from #_order_detail where id_order=?",array($v['id']));
                        $id_tinhtrang = $v['tinhtrang'];
                        $tinhtrang = $d->rawQueryOne("SELECT trangthai$lang as trangthai FROM #_status WHERE id = ?",array($id_tinhtrang));
                    ?>
                    <div class="table">
                        <div class="fl-con d-flex p-0">
                            <div class="col-2 title"><?=madon?></div>
                            <div class="col-2 title"><?=orderdate?></div>
                            <div class="col-2 title"><?=sanpham?></div>
                            <div class="col-2 title"><?=tonggiatri?></div>
                            <div class="col-2 title"><?=trangthai?></div>
                            <div class="col-2 title"><?=chitiet?></div>
                        </div>
                        <div class="fl-con d-flex p-0">
                            <div class="col-2 item">#<?=$v['madonhang']?></div>
                            <div class="col-2 item"><?=date('d/m/Y H:i',$v['ngaytao'])?></div>
                            <div class="col-2 item"><?=$detail['dem']?></div>
                            <div class="col-2 item"><span class="woocommerce-Price-amount amount"><bdi><?=number_format($v['tonggia'], 2, '.', '')?>&nbsp;<span class="woocommerce-Price-currencySymbol">USD</span></bdi></span></div>
                            <div class="col-2 item"><?=$tinhtrang['trangthai']?></div>
                            <div class="col-2 item"><a href="account/my-order?order=<?=$v['madonhang']?>" class="c-blue"><?=chitiet?></a></div>
                        </div>
                        <div class="fl-con d-flex p-0">
                            <div class="col-8 item total"><?=tong?></div>
                            <div class="col-4 item">1 <?=donhang?></div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>