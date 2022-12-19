<?php 
    $instagram = $d->rawQueryOne("SELECT ten$lang, noidung$lang,link,id,type FROM #_static WHERE type = ?",array('shop-on-instagram'));
    $hinhanhsp = $d->rawQuery("select photo from #_gallery where hienthi=1 and id_photo = ? and com='static' and type = ? and kind='static' and val = ? order by stt,id desc",array($instagram['id'],$instagram['type'],$instagram['type']));
?>
<section class="warp-banner-inpage">
    <p class="text-center">
        <img src="assets/images/bg_blog.png" alt="">
    </p>
</section>
<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="show_instagram">
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
                                    <img src="<?=THUMBS?>/350x350x1/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="shop on instagram">
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
<section class="load_blog">
    <div class="container">
        
    </div>
</section>

<div class="title-main"><h1><span><?=(isset($title_cat) && $title_cat!='')?$title_cat:$title_crumb?></span></h1></div>
<div class="content-main mt-xl-3">
    <div class="row">
        <?php if(count($news)>0) { foreach($news as $k => $v) { ?>
        <div class="news col-12 col-sm-6 col-lg-6 hover-desc">
            <div class="pic-news scale-img">
                <a href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                    <img class="img-block" onerror="this.src='<?=THUMBS?>/570x350x2/assets/images/noimage.png';" src="<?=THUMBS?>/570x350x1/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                </a>
            </div>
            <div class="info-news">
                <h3 class="name-news">
                    <a href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                        <?=$v['ten'.$lang]?>
                    </a>
                </h3>
                <p class="time-news"><?=ngaydang?>: <?=date("d/m/Y h:i A",$v['ngaytao'])?></p>
                <div class="desc-news text-split-3"><?=$v['mota'.$lang]?></div>
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
</div>
<div class="pagination-home mb-xl-3"><?=$paging?></div>