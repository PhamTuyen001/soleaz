<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>

<section class="detail_outfit pt-2 pb-4">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="col-12 col-sm-12 col-md-7">
				<div class="row d-flex align-items-center justify-content-center">
					<div class="col-6 col-lg-6"><img src="<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></div>
					<div class="col-6 col-lg-6"><img src="<?=UPLOAD_PRODUCT_L.$row_detail['photo2']?>" alt="<?=$row_detail['ten'.$lang]?>"></div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-5">
				<div class="info-outfit">
					<p><?=$row_detail['ten'.$lang]?></p>
					<div class="content-outfit"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if(!empty($jsonProduct)){?>
<section class="product-noibat py-5">
    <div class="container">
        <div class="title-product mb-5">
            <h6 class="font-weight-normal"><?=productsinoutfit?></h6>
        </div>
        <div class="row-products row-arrows">
            <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="1" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
                <?php foreach ($jsonProduct as $v_json) {
                	$ipd=json_decode($v_json['json_product'],true);
                	$v=$cart->get_product_info($ipd['id_product']);
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
<?php }?>