<?php 
	$colors=$d->rawQuery("select id,mau,ten$lang as ten from #_product_mau where hienthi=1 order by stt asc");
	$productmax=$d->rawQueryOne("select MAX(gia) as gia from #_product where hienthi=1 order by stt asc");
	$productmin=$d->rawQueryOne("select MIN(gia) as gia from #_product where hienthi=1 order by stt asc");
	if(!empty($_GET['idl'])){
		$procat = $d->rawQuery("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where hienthi=1 and id_list in (".$_GET['idl'].") and type = ? ",array($type));
	}else{
		$procat = $d->rawQuery("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where hienthi=1 and type = ? ",array($type));
	}
	
	$array_list=(!empty($_GET['idl']))?explode(',',$_GET['idl']):( (!empty($_GET['id_list']))?explode(',',$_GET['id_list']):array());
	$array_cat=(!empty($_GET['idc']))?explode(',',$_GET['idc']):( (!empty($_GET['id_cat']))?explode(',',$_GET['id_cat']):array());
	$array_color=(!empty($_GET['color']))?explode(',',$_GET['color']):array();


?>
<div class="list-search">
	<div class="title-search d-flex align-items-center">
		<img src="assets/images/fllter.svg" alt="">
		<h6>FILTER</h6>
	</div>
	<div class="wrap-block-search">
		<div>
			<div class="main-blocks">
				<p><?=categories?></p>
				<ul>
					<?php foreach ($splistmenu as $k => $v) {?>
					<li>
						<label onclick="window.location.href = '<?=$v[$sluglang]?>'" for="list-<?=$v['id']?>">
							<input id="list-<?=$v['id']?>" <?= in_array($v['id'],$array_list)?'checked':'' ?> type="checkbox" name="list" value="<?=$v['id']?>">
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
							<input <?=(empty($array_cat))?'checked':'' ?> id="cat-0" type="checkbox" name="cat" value="0">
							<span><?=all?></span>
						</label>
					</li>	
					<?php foreach ($procat as $k => $v) {?>
					<li class="col-6 col-lg-6">
						<label for="cat-<?=$v['id']?>">
							<input id="cat-<?=$v['id']?>" <?= in_array($v['id'],$array_cat)?'checked':'' ?> type="checkbox" name="cat" value="<?=$v['id']?>">
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
							<input <?= in_array($v['id'],$array_color)?'checked':'' ?> id="color-<?=$v['id']?>" type="checkbox" name="color" value="<?=$v['id']?>">
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
						<input type="text" id="price-range-slider" min="<?=$productmin['gia']?>" max="<?=$productmax['gia']?>" data-from="<?=(empty($price))?$productmin['gia']:$price[0]?>" data-to="<?=(empty($price))?$productmax['gia']:$price[1]?>" name="price-range-slider" />
					</div>
					<input type="hidden" name="price-from" value="0">
					<input type="hidden" name="price-to" value="0">
				</div>
			</div>
		</div>
		<input type="hidden" name="url" value="<?=$func->getCurrentPageURL_CANO()?>">
		<input type="hidden" name="p" value="1">
		<button type="button" class="action-button" onclick="Searchs();"><?=apply?></button>
	</div>
</div>

