<div class="box-product">
	<div class="img-product">
		<?php if($v['moi']==1){?><span>New</span><?php }?>
		<?php if($v['giakm']>0){?><span class="sale-span">-<?=$v['giakm']?>%</span><?php }?>
		<a href="<?=$v[$sluglang]?>">
			<img src="<?=THUMBS?>/500x500x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
			<img src="<?=THUMBS?>/500x500x2/<?=UPLOAD_PRODUCT_L.$v['photo2']?>" alt="<?=$v['ten'.$lang]?>">
		</a>
		<div class="colors-product">
			<ul>
				<?php foreach ($row_color as $v_mau) {?>
				<li style="--color:#<?=$v_mau['mau']?>"></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<div class="info-products">
		<h3>
			<a href="<?=$v[$sluglang]?>"><?=$v['ten'.$lang]?></a>
		</h3>
		<div class="price-product">
            <?php if($v['giakm']) { ?>
                <span class="price-new">$ <?=number_format($v['giamoi'], 2, '.', '')?></span>
                <span class="price-old">$ <?=number_format($v['gia'], 2, '.', '')?></span>
            <?php } else { ?>
                <span class="price-new price-new-one"><?=($v['gia'])?('$ '.number_format($v['gia'], 2, '.', '')):lienhe?></span>
            <?php } ?>
        </div>
	</div>
</div>