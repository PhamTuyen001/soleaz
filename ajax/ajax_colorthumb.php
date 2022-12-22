<?php
	include "ajax_config.php";
	
	$id_mau = htmlspecialchars($_POST['id']);
	$idpro = htmlspecialchars($_POST['pid']);
	$hinhanhsp = $d->rawQuery("SELECT photo, id_photo, id FROM #_gallery WHERE id_mau = ? AND id_photo = ? AND com = ? AND type = ? AND kind = ? AND val = ?",array($id_mau,$idpro,'product','san-pham','man','san-pham'));

    $row_detail = $d->rawQueryOne("select type, id, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, noidung$lang, masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia,photo2 from #_product where hienthi=1 and id = ? and type = ? and id_product=0 limit 0,1",array($idpro,'san-pham'));

    $colors=$d->rawQuery("select A.ten$lang,A.id,A.photo,A.id_mau,A.id_product,A.hienthi,B.ten$lang as mau from #_product as A,#_product_mau as B where A.id_product=? and A.id_mau = B.id and A.hienthi=1 order by A.stt asc",array($row_detail['id']));
    if($id_mau){
        $mau_select=$d->rawQueryOne("select * from #_product where id_mau=? and id_product=?",array($id_mau,$idpro));
        $sizes=$d->rawQuery("select A.id,B.ten$lang as ten,A.soluong,A.id_size from #_product_optionsize as A,#_product_size as B where A.id_product=? and A.id_mau=? and A.id_size = B.id order by A.stt asc",array($mau_select['id'],$id_mau));
        $hinhanhsp = $d->rawQuery("select photo from #_gallery where hienthi=1 and id_photo = ? and com='product' and type = ? and kind='man' and val = ? order by stt,id desc",array($mau_select['id'],'san-pham','san-pham'));
    }

?>

<div class="row ">
    <div class="col-12 col-md-7">
        <div class="row-album-photo">
            <div class="thumbs-photo-slick">
                <div class="slick-thumbs">
                    <div>
                        <p class="mb-1 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?=THUMBS?>/87x87x2/<?=UPLOAD_PRODUCT_L.$mau_select['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                            </a>
                        </p>
                    </div>
                    <?php foreach ($hinhanhsp as $v) {?>
                    <div>
                        <p class="mb-1 text-center">
                            <a href="javascript:void(0);">
                                <img src="<?=THUMBS?>/87x87x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                            </a>
                        </p>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="main-photo-slick">
                <div class="slick-main">
                    <div>
                        <p class="">
                            <a href="javascript:void(0);">
                                <img src="<?=THUMBS?>/600x600x2/<?=UPLOAD_PRODUCT_L.$mau_select['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                            </a>
                        </p>
                    </div>
                    <?php foreach ($hinhanhsp as $v) {?>
                    <div>
                        <p class="">
                            <a href="javascript:void(0);">
                                <img src="<?=THUMBS?>/600x600x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                            </a>
                        </p>
                    </div>
                    <?php }?>
                </div>
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"><span class="slider__label sr-only"></div>
            </div>
            
        </div>
    </div>
    <div class="col-12 col-md-5">
        <div class="info-product-detail">
            <div class="title-name-product">
                <h2><?=$row_detail['ten'.$lang]?></h2>
            </div>
            <div class="price-product-detail">
                <div class="price-product d-flex align-items-center justify-content-start">
                    <?php if($row_detail['giakm']) { ?>
                        <span class="price-new">$ <?=number_format($row_detail['giamoi'], 2, '.', '')?></span>
                        <span class="price-old">$ <?=number_format($row_detail['gia'], 2, '.', '')?></span>
                    <?php } else { ?>
                        <span class="price-new price-new-one"><?=($row_detail['gia'])?('$ '.number_format($row_detail['gia'], 2, '.', '')):lienhe?></span>
                    <?php } ?>
                </div>
            </div>
            <?php if(!empty($colors)){?>
            <div class="option-colors">
                <p><?=color?></p>
                <ul>
                    <?php foreach ($colors as $v) {?>
                    <li>
                        <label id="color-<?=$v['id']?>">
                            <input type="radio" name="colors" <?=($v['id_mau']==$id_mau)?'checked':''?> data-pid="<?=$row_detail['id']?>" id="color-<?=$v['id']?>" value="<?=$v['id_mau']?>">
                            <span class="d-flex justify-content-center align-items-center">
                                <img src="<?=THUMBS?>/30x30x2/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                                <i><?=$v['mau']?></i>
                            </span>
                        </label>   
                    </li> 
                    <?php }?>
                </ul>
            </div>
            <?php }?>
            <?php if(!empty($sizes)){?>
             <div class="option-colors">
                <p><?=size?></p>
                <ul>
                    <?php foreach ($sizes as $v) {?>
                    <li class="<?=($v['soluong']==0)?'no-click':''?>">
                        <label id="size-<?=$v['id']?>">
                            <input <?=($v['soluong']==0)?'disabled':''?> type="radio" name="size" value="<?=$v['id_size']?>" id="size-<?=$v['id']?>">
                            <span class="d-flex justify-content-center align-items-center">
                                <i><?=$v['ten']?></i>
                            </span>
                        </label>
                    </li>    
                    <?php }?>
                </ul>
            </div>   
            <?php }?>
            <div class="qtys d-flex align-items-center">
                <p><?=soluong?>:</p>
                <div class="quantity-pro-detail">
                    <span class="quantity-minus-pro-detail">-</span>
                    <input type="text" class="qty-pro" min="1" value="1" readonly />
                    <span class="quantity-plus-pro-detail">+</span>
                </div>
            </div>

            <div class="button-cart d-flex align-items-center">
                <a class="transition addnow addcart text-decoration-none" data-id="<?=$row_detail['id']?>" data-action="addnow"><span><?=addtocart?></span></a>
                <a class="transition buynow addcart text-decoration-none" data-id="<?=$row_detail['id']?>" data-action="buynow"><span><?=buynow?></span></a>
                <a href="javascript:void(0)" data-id="<?=$row_detail['id']?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.7975 2.34392C11.8499 1.28406 13.2078 0.906569 14.5101 0.925412C17.6402 0.970702 20.7994 3.52504 20.7994 7.22531C20.7994 10.7846 18.5229 13.7478 16.2712 15.7624C15.132 16.7817 13.9635 17.5909 13.0145 18.1482C12.5404 18.4266 12.113 18.6469 11.7642 18.8004C11.5905 18.8768 11.4274 18.9406 11.2822 18.9866C11.1558 19.0267 10.9777 19.0753 10.7991 19.0753C10.6205 19.0753 10.4424 19.0267 10.3161 18.9866C10.1708 18.9406 10.0078 18.8768 9.83402 18.8004C9.48529 18.6469 9.05789 18.4266 8.58372 18.1482C7.63477 17.5909 6.46629 16.7817 5.32701 15.7624C3.07537 13.7478 0.798828 10.7846 0.798828 7.22531C0.798828 3.53378 3.95069 0.925334 7.099 0.925334C8.36601 0.925334 9.73694 1.28612 10.7975 2.34392ZM14.4884 2.42525C13.2906 2.40792 12.1744 2.81456 11.4232 3.94138C11.2841 4.15002 11.0499 4.27534 10.7991 4.27534C10.5484 4.27534 10.3142 4.15002 10.1751 3.94138C9.42839 2.82138 8.29189 2.42533 7.099 2.42533C4.69714 2.42533 2.29883 4.44188 2.29883 7.22531C2.29883 10.141 4.18492 12.7278 6.32718 14.6445C7.38484 15.5908 8.47112 16.3425 9.34332 16.8547C9.77972 17.111 10.1545 17.3026 10.4381 17.4274C10.5805 17.4901 10.6912 17.532 10.7695 17.5568C10.7807 17.5604 10.7906 17.5634 10.7991 17.5658C10.8077 17.5634 10.8175 17.5604 10.8287 17.5568C10.9071 17.532 11.0177 17.4901 11.1601 17.4274C11.4437 17.3026 11.8185 17.111 12.2549 16.8547C13.1271 16.3425 14.2134 15.5908 15.2711 14.6445C17.4133 12.7278 19.2994 10.141 19.2994 7.22531C19.2994 4.45063 16.9084 2.46027 14.4884 2.42525Z" />
                    </svg>
                </a>
            </div>
            <div class="noidung_sanpham">
                <p><?=information?></p>
                <div class="content-noidung">
                    <div class="show-content-noidung"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
                </div>
            </div>
            <div class="noidung_sanpham">
                <p><?=information?></p>
                <div class="content-noidung">
                    <div class="show-content-noidung"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
                </div>
            </div>
        </div>
    </div>
</div>
