<div class="grid-pro-detail">
    <div class="info-top-pro-detail d-flex flex-wrap justify-content-between">
        <div class="left-pro-detail">
            <a id="Zoom-1" class="MagicZoom" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
            <?php if(count($hinhanhsp)>0) { ?>
            <div class="gallery-thumb-pro">
                <div class="owl-carousel owl-theme owl-carousel-loop in-page in-arrow-detail" data-dot="0" data-nav='1' data-loop='0' data-play='0' data-lg-items='5' data-md-items='4' data-sm-items='3' data-xs-items="2" data-margin='5'>
                    <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img class="img-block" onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
                    <?php for($i=0;$i<count($hinhanhsp);$i++) { ?>
                        <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img class="img-block" onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="right-pro-detail">
            <p class="title-pro-detail"><?=$row_detail['ten'.$lang]?></p>
            <div class="social-plugin social-plugin-pro-detail">
                <div class="addthis_inline_share_toolbox_qj48"></div>
                <div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
            </div>
            
            <ul class="attr-pro-detail">
                <li> 
                    <label class="attr-label-pro-detail"><?=masp?>:</label>
                    <div class="attr-content-pro-detail"><?=$row_detail['masp']?></div>
                </li>
                <?php if($pro_brand['id']) { ?>
                    <li>
                        <label class="attr-label-pro-detail"><?=thuonghieu?>:</label>
                        <div class="attr-content-pro-detail"><a class="text-decoration-none" href="<?=$pro_brand[$sluglang]?>" title="<?=$pro_brand['ten'.$lang]?>"><?=$pro_brand['ten'.$lang]?></a></div>
                    </li>
                <?php } ?>
                <li>
                    <label class="attr-label-pro-detail"><?=gia?>:</label>
                    <div class="attr-content-pro-detail">
                        <?php if($row_detail['giamoi']) { ?>
                            <span class="price-new-pro-detail"><?=number_format($row_detail['giamoi'],0, ',', '.')."đ"?></span>
                            <span class="price-old-pro-detail"><?=number_format($row_detail['gia'],0, ',', '.')."đ"?></span>
                        <?php } else { ?>
                            <span class="price-new-pro-detail"><?=($row_detail['gia'])?number_format($row_detail['gia'],0, ',', '.')."đ":lienhe?></span>
                        <?php } ?>
                    </div>
                </li>
                <?php if($config['order']['check']==true){ ?>
                <li class="d-flex flex-wrap justify-content-start align-items-center">
                    <label class="attr-label-pro-detail mr-xl-2 d-block w-attr"><?=mausac?>:</label>
                    <div class="attr-content-pro-detail d-block">
                        <?php for($i=0;$i<count($mau);$i++) { ?>
                            <?php if($mau[$i]['loaihienthi']==1) { ?>
                                <a class="color-pro-detail text-decoration-none" data-idpro="<?=$row_detail['id']?>">
                                    <input style="background-image: url(<?=UPLOAD_COLOR_L.$mau[$i]['photo']?>)" type="radio" value="<?=$mau[$i]['id']?>" name="color-pro-detail">
                                </a>
                            <?php } else { ?>
                                <a class="color-pro-detail text-decoration-none" data-idpro="<?=$row_detail['id']?>">
                                    <input style="background-color: #<?=$mau[$i]['mau']?>" type="radio" value="<?=$mau[$i]['id']?>" name="color-pro-detail">
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </li>
                <li class="d-flex flex-wrap justify-content-start align-items-center">
                    <label class="attr-label-pro-detail mr-xl-2 d-block w-attr"><?=kichthuoc?>:</label>
                    <div class="attr-content-pro-detail d-block">
                        <?php for($i=0;$i<count($size);$i++) { ?>
                            <a class="size-pro-detail text-decoration-none">
                                <input type="radio" value="<?=$size[$i]['id']?>" name="size-pro-detail">
                                <?=$size[$i]['ten'.$lang]?>
                            </a>
                        <?php } ?>
                    </div> 
                </li>
                <li class="d-flex flex-wrap justify-content-start align-items-center"> 
                    <label class="attr-label-pro-detail mr-xl-2 d-block w-attr"><?=soluong?>:</label>
                    <div class="attr-content-pro-detail d-block">
                        <div class="quantity-pro-detail">
                            <span class="quantity-minus-pro-detail">-</span>
                            <input type="text" class="qty-pro" min="1" value="1" readonly />
                            <span class="quantity-plus-pro-detail">+</span>
                        </div>
                    </div>
                </li>
                <?php } ?>
                <li> 
                    <label class="attr-label-pro-detail"><?=luotxem?>:</label>
                    <div class="attr-content-pro-detail"><?=$row_detail['luotxem']?></div>
                </li>
            </ul>
            <div class="desc-pro-detail"><?=str_replace("\n","<p></p>",$row_detail['mota'.$lang])?></div>
            <?php if($config['order']['check']==true){ ?>
            <div class="cart-pro-detail">
                <a class="transition addnow addcart text-decoration-none" data-id="<?=$row_detail['id']?>" data-action="addnow"><i class="fas fa-shopping-bag"></i><span>Thêm vào giỏ hàng</span></a>
                <a class="transition buynow addcart text-decoration-none" data-id="<?=$row_detail['id']?>" data-action="buynow"><i class="fas fa-shopping-bag"></i><span>Đặt hàng</span></a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php /*<div class="tags-pro-detail">
        <?php foreach($pro_tags as $v) { ?>
            <a class="transition text-decoration-none" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><i class="fas fa-tags"></i><?=$v['ten'.$lang]?></a>
        <?php } ?>
    </div>*/ ?>
    <div class="tabs-pro-detail mt-4">
        <?php /*<div class="tabs-left-detail">*/ ?>
            <ul class="ul-tabs-pro-detail">
                <li class="active transition" data-tabs="info-pro-detail"><?=thongtinsanpham?></li>
                <li class="transition" data-tabs="commentfb-pro-detail"><?=binhluan?></li>
            </ul>
            <div class="content-tabs-pro-detail info-pro-detail active"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
            <div class="content-tabs-pro-detail commentfb-pro-detail"><div class="fb-comments" data-href="<?=$func->getCurrentPageURL()?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div></div>
        <?php /*</div>*/ ?>
        <?php /*<div class="tabs-right-detail">
            <h5>Sản phẩm mới nhất</h5>
            <?php if(count($product_new)>0) { foreach($product_new as $k => $v) { ?>
            <div class="product-detail">
                <div class="product-detail-img">
                    <a href="<?=$v[$sluglang]?>">
                        <img class="img-block" onerror="this.src='<?=THUMBS?>/340x270x1/assets/images/noimage.png';" src="<?=THUMBS?>/340x270x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>"/>
                    </a>
                </div>
                <div class="product-detail-info">
                    <h3 class="name-product text-split">
                        <a href="<?=$v[$sluglang]?>"><?=$v['ten'.$lang]?></a>
                    </h3>
                    <div class="price-product">
                        <?php if($v['giakm']) { ?>
                            <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                            <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                        <?php } else { ?>
                            <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>*/ ?>
    </div>
</div>
<div class="title-main mb-xl-3"><h3><?=sanphamcungloai?></h3></div>
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
<div class="pagination-home mb-xl-3"><?=$paging?></div>
