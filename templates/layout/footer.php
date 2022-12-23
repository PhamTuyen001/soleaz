<footer id="footer" class="<?=($source!='index') ? 'mt-3':''?>">
   <div class="container">
        <div class="footer-article">
            <div class="row d-flex align-items-start justify-content-between">

                <div class="footer-news col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="info-footer"><?=htmlspecialchars_decode($footer1['noidung'.$lang])?></div>
                    <ul class="social social-footer d-flex align-items-start">
                        <?php for($i=0;$i<count($social1);$i++) { ?>
                            <li><a href="<?=$social1[$i]['link']?>" target="_blank"><img src="<?=UPLOAD_PHOTO_L.$social1[$i]['photo']?>" alt="<?=$social1[$i]['ten'.$lang]?>"></a></li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="footer-news col-12 col-sm-6 col-md-6 col-lg-3">
                    <p class="title-footer"><?=gioithieu?></p>
                    <div class="info-footer"><?=htmlspecialchars_decode($footer2['noidung'.$lang])?></div>
                </div>

                <div class="footer-news col-12 col-sm-6 col-md-6 col-lg-2">
                    <p class="title-footer"><?=support?></p>
                    <ul class="footer-ul">
                        <?php foreach($cs as $v) { ?>
                            <li><a class="text-decoration-none" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="footer-news col-12 col-sm-6 col-md-6 col-lg-3">
                    <p class="title-footer"><?=contact?></p>
                    <div class="info-footer"><?=htmlspecialchars_decode($footer3['noidung'.$lang])?></div>
                </div>
            </div>
        </div>
   </div>
</footer>
<section id="footer-powered">
    <div class="container">
        <div class="wrap-content d-flex align-items-center justify-content-center">
            <p class="copyright">Sole Co., LTD. © 2022 All rights reserved. Website Developed By A Wesbite</p>
        </div>
    </div>
</section>

