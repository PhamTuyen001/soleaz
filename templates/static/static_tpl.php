<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="news-detail">
    <div class="container">
        <div class="title-main-news mb-3"><h1><span><?=$row_detail['ten'.$lang]?></span></h1></div>
        <?php if($row_detail['noidung'.$lang]) { ?>
        <div class="meta-toc">
            <div class="box-readmore">
                <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
            </div>
        </div>
        <div class="content-main info-news-detail" id="toc-content"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
        <div class="share mt-3 d-none">
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