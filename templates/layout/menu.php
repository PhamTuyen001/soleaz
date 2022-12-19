<section class="menu" id="menu">
    <div class="desc-menu d-flex flex-wrap justify-content-between">
        <ul class="menu-i d-flex align-items-center justify-content-center">
            <li>
                <div class="menu-mobile-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </li>
            <li>
                <a class="transition <?php if($com=='' || $com=='index') echo 'active'; ?>" href="" title="<?=trangchu?>"><?=trangchu?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='intro') echo 'active'; ?>" href="intro" title="<?=gioithieu?>"><?=gioithieu?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='san-pham') echo 'active'; ?>" href="san-pham" title="<?=sanpham?>"><?=sanpham?> <i class="fal fa-angle-down"></i></a>
                <?php if(count($splistmenu)) { ?>
                    <ul>
                        <?php foreach ($splistmenu as $k => $v) {
                            $spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id'])); ?>
                            <li>
                                <h2><a class="transition" title="<?=$v['ten']?>" href="<?=$v[$sluglang]?>"><?=$v['ten']?></a></h2>
                                <?php if(count($spcatmenu)>0) { ?>
                                    <ul>
                                        <?php foreach ($spcatmenu as $k1 => $v1) {
                                            $spitemmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_item WHERE hienthi=1 AND id_cat = ? ORDER BY stt,id DESC",array($v1['id'])); ?>
                                            <li>
                                                <h2><a class="transition" title="<?=$v1['ten']?>" href="<?=$v1[$sluglang]?>"><?=$v1['ten']?></a></h2>
                                                <?php if(count($spitemmenu)) { ?>
                                                    <ul>
                                                        <?php foreach ($spitemmenu as $k2 => $v2) {
                                                            $spsubmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_sub WHERE hienthi=1 AND id_item = ? ORDER BY stt,id DESC",array($v2['id'])); ?>
                                                            <li>
                                                                <h2><a class="transition" title="<?=$v2['ten']?>" href="<?=$v2[$sluglang]?>"><?=$v2['ten']?></a></h2>
                                                                <?php if(count($spsubmenu)) { ?>
                                                                    <ul>
                                                                        <?php foreach ($spsubmenu as $k3 => $v3) {?>
                                                                            <li>
                                                                                <h2><a class="transition" title="<?=$v3['ten']?>" href="<?=$v3[$sluglang]?>"><?=$v3['ten']?></a></h2>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                <?php } ?>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
            <li>
                <a class="transition <?php if($com=='outfit') echo 'active'; ?>" href="outfit" title="<?=outfit?>"><?=outfit?></a>
            </li>
            
            <li>
                <a class="transition <?php if($com=='blog') echo 'active'; ?>" href="blog" title="<?=blog?>"><?=blog?></a>
            </li>
            
            
            <li>
                <a class="transition <?php if($com=='lien-he') echo 'active'; ?>" href="lien-he" title="<?=lienhe?>"><?=lienhe?></a>
            </li>
            <li>
                <div class="search">
                    <input type="text" id="keyword" placeholder="<?=nhaptukhoatimkiem?>" onkeypress="doEnter(event,'keyword');"/>
                    <p onclick="onSearch('keyword');"><i class="fas fa-search"></i></p>
                </div>
            </li>
        </ul>
    </div>
</section>