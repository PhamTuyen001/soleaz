<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="news-detail">
    <div class="container">
        <div class="title-main-news"><h1><span><?=$row_detail['ten'.$lang]?></span></h1></div>
        <?php if($row_detail['noidung'.$lang]) { ?>
        <div class="meta-toc">
            <div class="box-readmore">
                <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
            </div>
        </div>
        <div class="content-main info-news-detail" id="toc-content"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
        <div class="share mt-3">
            <b><?=chiase?>:</b>
            <div class="social-plugin">
                <div class="addthis_inline_share_toolbox_qj48"></div>
                <div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
            </div>
        </div>
        <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            <strong><?=noidungdangcapnhat?></strong>
        </div>
        <?php } ?>
    </div>
</section>
<?php if(!empty($news)){?>
<section class="load_blog py-5">
    <div class="container">
        <div class="title-product text-center mb-5">
            <p class="text-capitalize"><?=baivietkhac?></p>
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
    </div>
</section>
<?php }?>
