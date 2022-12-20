<?php 
	$colors=$d->rawQuery("select id,mau,ten$lang as ten from #_product_mau where hienthi=1 order by stt asc");
	$productmax=$d->rawQueryOne("select MAX(gia) as gia from #_product where hienthi=1 order by stt asc");
	$productmin=$d->rawQueryOne("select MIN(gia) as gia from #_product where hienthi=1 order by stt asc");
?>
<div class="list-search">
	<div class="title-search d-flex align-items-center">
		<img src="assets/images/fllter.svg" alt="">
		<h6>FILTER</h6>
	</div>
	<div class="wrap-block-search">
		<div class="main-blocks">
			<p><?=categories?></p>
			<ul>
				<li>
					<label for="list-0">
						<input id="list-0" type="checkbox" name="list" value="0">
						<span><?=allcategories?></span>
					</label>
				</li>	
				<?php foreach ($splistmenu as $k => $v) {?>
				<li>
					<label for="list-<?=$v['id']?>">
						<input id="list-<?=$v['id']?>" type="checkbox" name="list" value="<?=$v['id']?>">
						<span><?=$v['ten']?></span>
					</label>
				</li>	
				<?php }?>
			</ul>
		</div>
		<div class="main-blocks">
			<p><?=producttype?></p>
			<ul class="row">
				<li class="col-6 col-lg-6">
					<label for="cat-0">
						<input id="cat-0" type="checkbox" name="cat" value="0">
						<span><?=all?></span>
					</label>
				</li>	
				<?php foreach ($splistmenu as $k => $v) {?>
				<li class="col-6 col-lg-6">
					<label for="cat-<?=$v['id']?>">
						<input id="cat-<?=$v['id']?>" type="checkbox" name="cat" value="<?=$v['id']?>">
						<span><?=$v['ten']?></span>
					</label>
				</li>	
				<?php }?>
			</ul>
		</div>
		<div class="main-blocks">
			<p><?=color?></p>
			<ul class="ul-color">
				<?php foreach ($colors as $k => $v) {?>
				<li>
					<label for="color-<?=$v['id']?>">
						<input id="color-<?=$v['id']?>" type="checkbox" name="color" value="<?=$v['id']?>">
						<span style="--color:#<?=$v['mau']?>"><?=$v['ten']?></span>
					</label>
				</li>	
				<?php }?>
			</ul>
		</div>
		<div class="main-blocks">
			<p><?=price?></p>
			<div class="filter-options-content">
				<div>
					<input type="text" id="price-range-slider" min="<?=$productmin['gia']?>" max="<?=$productmax['gia']?>" data-from="<?=(empty($price_from))?$productmin['gia']:$price_from?>" data-to="<?=(empty($price_to))?$productmax['gia']:$price_to?>" name="price-range-slider" />
				</div>
			</div>
		</div>
		<button type="button" class="action-button"><?=apply?></button>
	</div>
</div>

