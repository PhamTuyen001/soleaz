<?php $banner = $d->rawQueryOne("SELECT id, photo FROM #_photo WHERE type = ? AND act = ? limit 0,1",array('bn-'.$com,'photo_static')); ?>
<section class="warp-banner-inpage">
    <p class="text-center">
        <img class="w-100" src="<?=UPLOAD_PHOTO_L.$banner['photo']?>" alt="<?=$setting['ten'.$lang]?>">
    </p>
</section>
<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="wrap-contacts mt-3 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-md-2">
                <div class="form-contact mb-xl-3 pl-md-4">
                    <p class="title-contact"><?=leavemessage?></p>
                    <form class="validation-contact" novalidate method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-contact mb-xl-3 col-sm-12">
                                <input type="text" class="form-control" id="ten" name="ten" placeholder="<?=hoten?>" required />
                                <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
                            </div>
                                  
                        </div>
                        <div class="row">
                            <div class="input-contact mb-xl-3 col-sm-6">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                                <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
                            </div>
                            <div class="input-contact mb-xl-3 col-sm-6">
                                <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?=sodienthoai?>" required />
                                <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
                            </div>   
                        </div>
                        
                        <div class="input-contact mb-xl-3">
                            <textarea class="form-control" id="noidung" name="noidung" placeholder="<?=noidung?>" required /></textarea>
                            <div class="invalid-feedback"><?=vuilongnhapnoidung?></div>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" name="submit-contact" value="<?=gui?>" disabled />
                        <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                    </form>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="map-contact">
                    <?=htmlspecialchars_decode($optsetting['toado_iframe'])?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="icon-contact pb-5 pt-3">
    <div class="container">
        <div class="row-icon-contact">
            <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
                <?php foreach ($icon as $v) {?>
                <div class="col-icon-contact">
                    <div class="box-icon-contact">
                        <span>
                            <img src="<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                        </span>
                        <p><?=$v['ten'.$lang]?></p>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>