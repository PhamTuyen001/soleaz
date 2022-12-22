<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>

<section class="wrap-sanphams pb-5" id="load_add">
	<div class="container" id="ajaxs">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-left-search pt-5">
				<?php include TEMPLATE.LAYOUT."search.php" ?>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-9 col-right-product">
				<div class="title-product text-center mb-5">
            		<p class="text-capitalize"><?=(isset($title_cat) && $title_cat!='')?$title_cat:$title_crumb?></p>
        		</div>
        		<div id="load-product">
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
        		<div class="readmore <?=($total<=6)?'d-none':'d-flex'?> mt-4 align-items-center justify-content-center">
		            <a href="javascript:void(0)" class="click-product"  data-url="<?=$func->getCurrentPageURL()?>" data-page="1" data-total="<?=$total?>"><span><?=loadmore?></span><i class="fal fa-spinner fa-spin"></i></a>
		        </div>
			</div>
		</div>
	</div>
</section>