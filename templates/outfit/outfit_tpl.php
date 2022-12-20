<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<?php
	$sql="SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id,photo FROM #_product_list WHERE hienthi=1 AND type = '".$type."' ORDER BY stt,id DESC";
    $splistoutfit=$d->rawQuery($sql);
?>
<section class="wrap-outfit pb-5">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-2">
				<?php foreach ($splistoutfit as $v) {
					$spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id'])); 
				?>
				<div class="sc__list__wrap">
    				<div class="sc__list__title"><?=$v['ten']?></div>
                    <ul class="sc__list">
                    	<?php foreach ($spcatmenu as $k) {?>
            			<li><a href="<?=$k[$sluglang]?>" class="hov-df sc__link "><?=$k['ten']?></a></li>
            			<?php }?>
            		</ul>
                </div>
				<?php }?>
			</div>
			<div class="col-12 col-lg-10">
				<div class="title-product text-center mb-5">
            		<p class="text-capitalize"><?=(isset($title_cat) && $title_cat!='')?$title_cat:$title_crumb?></p>
        		</div>
        		<div id="load-more-blog">
	        		<div class="row">
	        			<?php foreach ($product as $v) {?>
	        			<div class="col-12 col-news col-sm-6 col-md-4 col-lg-4 d-flex mb-4 justify-content-center">
							<div class="box-soleoutfit box-soleoutfit-page text-center">
								<div class="img-soleoutfit mb-0">
									<a href="<?=$v[$sluglang]?>">
										<img src="<?=THUMBS?>/450x660x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
										<img src="<?=THUMBS?>/450x660x2/<?=UPLOAD_PRODUCT_L.$v['photo2']?>" alt="<?=$v['ten'.$lang]?>">
									</a>
								</div>
								<div class="sc__content d-flex flex-wrap txt-ct fl-col">
						            <div class="sc__title"><?=$v['ten'.$lang]?></div>
						            <a href="<?=$v[$sluglang]?>" class="sc__btn btn-pri-whi mg-ct"><?=xemchitiet?></a>
						        </div>
							</div>
						</div>	
	        			<?php }?>
	        		</div>
        		</div>
        		<div class="readmore <?=($total<=6)?'d-none':'d-flex'?> mt-4 align-items-center justify-content-center">
		            <a href="javascript:void(0)" class="click-bloc" data-url="<?=$func->getCurrentPageURL()?>" data-page="1" data-total="<?=$total?>"><span><?=loadmore?></span><i class="fal fa-spinner fa-spin"></i></a>
		        </div>
			</div>
		</div>
	</div>
</section>