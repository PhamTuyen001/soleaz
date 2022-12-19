<section class="warp-banner-inpage">
    <p class="text-center">
        <img src="assets/images/bg-sanpham.png" alt="">
    </p>
</section>
<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="wrap-contacts">
    <div class="container">
        
    </div>
</section>
<div class="title-main"><h1><span><?=$title_crumb?></span></h1></div>
<div class="content-main">
    <div class="top-contact mt-xl-3">
        <div class="maps-contact">
            <div>
                <?=htmlspecialchars_decode($lienhe['noidung'.$lang])?>
            </div>
            <div>
                <?=htmlspecialchars_decode($optsetting['toado_iframe'])?>
            </div>
        </div>
        <div class="form-contact mb-xl-3">
            <form class="validation-contact" novalidate method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-contact mb-xl-3 col-sm-6">
                        <input type="text" class="form-control" id="ten" name="ten" placeholder="<?=hoten?>" required />
                        <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
                    </div>
                    <div class="input-contact mb-xl-3 col-sm-6">
                        <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?=sodienthoai?>" required />
                        <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
                    </div>         
                </div>
                <div class="row">
                    <div class="input-contact mb-xl-3 col-sm-6">
                        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?=diachi?>" required />
                        <div class="invalid-feedback"><?=vuilongnhapdiachi?></div>
                    </div>
                    <div class="input-contact mb-xl-3 col-sm-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                        <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
                    </div>
                </div>
                <div class="input-contact mb-xl-3">
                    <input type="text" class="form-control" id="tieude" name="tieude" placeholder="<?=chude?>" required />
                    <div class="invalid-feedback"><?=vuilongnhapchude?></div>
                </div>
                <div class="input-contact mb-xl-3">
                    <textarea class="form-control" id="noidung" name="noidung" placeholder="<?=noidung?>" required /></textarea>
                    <div class="invalid-feedback"><?=vuilongnhapnoidung?></div>
                </div>
                <?php /*<div class="input-contact">
                    <input type="file" class="custom-file-input" name="file">
                    <label class="custom-file-label" for="file" title="<?=chon?>"><?=dinhkemtaptin?></label>
                </div>*/ ?>
                <input type="submit" class="btn btn-primary" name="submit-contact" value="<?=gui?>" disabled />
                <input type="reset" class="btn btn-secondary" value="<?=nhaplai?>" />
                <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
            </form>
        </div>
    </div>
</div>