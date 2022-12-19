<div class="title-main mb-xl-3"><h1><span><?=($title_cat!='')?$title_cat:$title_crumb?></span></h1></div>
<div class="row">
    <?php if(count($product)>0) { foreach($product as $k => $v) { ?>
       <div class="col-6 col-sm-6 col-md-6 col-lg-3">
            <div class="product mb-xl-3">
                <div class="product-img">
                    <a href="<?=$v[$sluglang]?>">
                        <img class="img-block" onerror="this.src='<?=THUMBS?>/340x270x1/assets/images/noimage.png';" src="<?=THUMBS?>/340x270x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>"/>
                    </a>
                    <?php if($v['giakm']) { ?>
                    <span class="price-per"><?='-'.$v['giakm'].'%'?></span>
                    <?php } ?>
                </div>
                <div class="product-info">
                    <h3 class="name-product text-split">
                        <a href="<?=$v[$sluglang]?>"><?=$v['ten'.$lang]?></a>
                    </h3>
                    <p class="code-product">
                        Mã: <?=$v['masp']?>
                    </p>
                    <div class="price-product">
                        <?php if($v['giakm']) { ?>
                            <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                            <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                        <?php } else { ?>
                            <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                        <?php } ?>
                    </div>
                </div>
                <?php if($config['order']['check']==true){ ?>
                <div class="product-action d-flex flex-wrap justify-content-center align-items-center">
                    <button class="cart-add addcart transition" type="button" data-id="<?=$v['id']?>" data-action="addnow">Thêm vào giỏ</button>
                    <button class="cart-buy addcart transition" type="button" data-id="<?=$v['id']?>" data-action="buynow">Mua ngay</button>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php } } else { ?>
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    </div>
    <?php } ?>
</div>
<div class="pagination-home"><?=$paging?></div>