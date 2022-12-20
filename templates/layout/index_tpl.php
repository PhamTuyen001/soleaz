<?php if(!empty($product_noibat)){?>
<section class="product-noibat py-5">
	<div class="container">
		<div class="title-product mb-5">
			<h6><?=sanphamnoibat?></h6>
		</div>
		<div class="row-products">
			<div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
				<?php foreach ($product_noibat as $v) {
					$row_color=$d->rawQuery("select mau,id from #_product_mau where id in (select id_mau from #_product where id_product = ? and hienthi=1)",array($v['id']));
				?>
				<div class="col-product">
					<?php include TEMPLATE.LAYOUT."sanpham.php"; ?>
				</div>
				<?php }?>
			</div>
		</div>

		<div class="readmore mt-5 d-flex align-items-center justify-content-center">
			<a href="featured-products"><?=xemthem?></a>
		</div>
	</div>
</section>
<?php }?>
<?php if(!empty($product_moi)){?>
<section class="product-noibat py-5">
	<div class="container">
		<div class="title-product mb-5">
			<h6><?=newcollection?></h6>
		</div>
		<div class="row-products">
			<div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
				<?php foreach ($product_moi as $v) {
					$row_color=$d->rawQuery("select mau,id from #_product_mau where id in (select id_mau from #_product where id_product = ? and hienthi=1)",array($v['id']));
				?>
				<div class="col-product">
					<?php include TEMPLATE.LAYOUT."sanpham.php"; ?>
				</div>
				<?php }?>
			</div>
		</div>

		<div class="readmore mt-5 d-flex align-items-center justify-content-center">
			<a href="new-collection"><?=xemthem?></a>
		</div>
	</div>
</section>
<?php }?>
<?php if(!empty($product_sale)){?>
<section class="product-noibat py-5">
	<div class="container">
		<div class="title-product mb-5">
			<h6><?=sale?></h6>
		</div>
		<div class="row-products">
			<div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
				<?php foreach ($product_sale as $v) {
					$row_color=$d->rawQuery("select mau,id from #_product_mau where id in (select id_mau from #_product where id_product = ? and hienthi=1)",array($v['id']));
				?>
				<div class="col-product">
					<?php include TEMPLATE.LAYOUT."sanpham.php"; ?>
				</div>
				<?php }?>
			</div>
		</div>

		<div class="readmore mt-5 d-flex align-items-center justify-content-center">
			<a href="sale"><?=xemthem?></a>
		</div>
	</div>
</section>
<?php }?>
<?php if(!empty($outfit)){?>
<section class="product-noibat py-5">
	<div class="container">
		<div class="title-product mb-5">
			<h6><?=soleoutfit?></h6>
		</div>
		<div class="row">
			<?php foreach ($outfit as $v) {?>
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-center">
				<div class="box-soleoutfit text-center">
					<div class="img-soleoutfit">
						<a href="<?=$v[$sluglang]?>">
							<img src="<?=THUMBS?>/450x660x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
							<img src="<?=THUMBS?>/450x660x2/<?=UPLOAD_PRODUCT_L.$v['photo2']?>" alt="<?=$v['ten'.$lang]?>">
						</a>
					</div>
					<div class="info-soleoutfit">
						<h3>
							<a href="<?=$v[$sluglang]?>"><?=$v['ten'.$lang]?></a>
						</h3>
						<p>
							<a href="<?=$v[$sluglang]?>"><?=viewcollection?></a>
						</p>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</section>
<?php }?>