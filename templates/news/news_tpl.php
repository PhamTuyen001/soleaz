<?php 
    $instagram = $d->rawQueryOne("SELECT ten$lang, noidung$lang,link,id,type FROM #_static WHERE type = ?",array('shop-on-instagram'));
    $hinhanhsp = $d->rawQuery("select photo from #_gallery where hienthi=1 and id_photo = ? and com='static' and type = ? and kind='static' and val = ? order by stt,id desc",array($instagram['id'],$instagram['type'],$instagram['type']));
    $banner = $d->rawQueryOne("SELECT id, photo FROM #_photo WHERE type = ? AND act = ? limit 0,1",array('bn-'.$com,'photo_static'));
?>
<section class="warp-banner-inpage">
    <p class="text-center">
        <img class="w-100" src="<?=UPLOAD_PHOTO_L.$banner['photo']?>" alt="<?=$setting['ten'.$lang]?>">
    </p>
</section>
<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="show_instagram mb-4">
    <div class="container">
        <div class="one-content-page text-center">
            <div class="title-product text-center mb-3">
                <h2 class="text-capitalize">shop on instagram</h2>
            </div>
            <div class="info-one-content-page">
                <?=htmlspecialchars_decode($instagram['noidung'.$lang])?>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="show_albums">
                    <div class="row">
                        <?php foreach ($hinhanhsp as $k => $v) {?>
                        <div class="col-6 col-sm-4 col-md-4 p-3">
                            <p>
                                <a href="<?=UPLOAD_NEWS_L.$v['photo']?>" data-fancybox>
                                    <img class="w-100" src="<?=THUMBS?>/350x350x1/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="shop on instagram">
                                </a>
                            </p>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="readmore mt-4 d-flex align-items-center justify-content-center">
            <a href="<?=$instagram['link']?>"><?=gotoourinstagram?></a>
        </div>
    </div>
</section>
<section class="load_blog py-5">
    <div class="container">
        <div class="title-product text-center mb-5">
            <p class="text-capitalize"><?=(isset($title_cat) && $title_cat!='')?$title_cat:$title_crumb?></p>
        </div>
        <div id="load-more-blog">
            <div class="row">
                <?php foreach ($news as $k => $v) {?>
                <div class="col-12 col-news col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="block-news d-flex align-items-center">
                        <a href="<?=$v[$sluglang]?>">
                            <img src="<?=THUMBS?>/302x211x1/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                        </a>
                        <div class="info-block-news">
                            <h3><a class="text-split-2" href="<?=$v[$sluglang]?>"><?=$v['ten'.$lang]?></a></h3>
                            <p class="text-split-3"><?=$v['mota'.$lang]?></p>
                            <a href="<?=$v[$sluglang]?>"><?=viewdetails?></a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="readmore <?=($total<=4)?'d-none':'d-flex'?> mt-4 align-items-center justify-content-center">
            <a href="javascript:void(0)" class="click-bloc" data-url="<?=$func->getCurrentPageURL()?>" data-page="1" data-total="<?=$total?>"><span><?=loadmore?></span><i class="fal fa-spinner fa-spin"></i></a>
        </div>
    </div>
</section>
