<?php  
	if(!defined('SOURCES')) die("Error");
    $slider = $d->rawQuery("SELECT ten$lang, photo, link FROM #_photo WHERE type = ? AND hienthi=1 ORDER BY stt asc,id DESC",array('slide'));
    
    $product_noibat = $d->rawQuery("SELECT id,tenkhongdauvi,tenkhongdauen,tenkhongdautl,tenvi,tenen,tentl,photo,photo2,gia,giakm,giamoi,moi FROM #_product WHERE hienthi=1 AND type = ? AND noibat>0 ORDER BY stt,id DESC",array('san-pham'));
    $product_moi = $d->rawQuery("SELECT id,tenkhongdauvi,tenkhongdauen,tenkhongdautl,tenvi,tenen,tentl,photo,photo2,gia,giakm,giamoi,moi FROM #_product WHERE hienthi=1 AND type = ? AND moi>0 ORDER BY stt,id DESC",array('san-pham'));
    $product_sale = $d->rawQuery("SELECT id,tenkhongdauvi,tenkhongdauen,tenkhongdautl,tenvi,tenen,tentl,photo,photo2,gia,giakm,giamoi,moi FROM #_product WHERE hienthi=1 AND type = ? AND khuyenmai>0 ORDER BY stt,id DESC",array('san-pham'));
    $newsnb = $d->rawQuery("SELECT ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao, id, photo FROM #_news WHERE hienthi=1 AND type = ? AND noibat>0 ORDER BY stt,id DESC",array('tin-tuc'));
    $outfit = $d->rawQuery("SELECT ten$lang, tenkhongdauvi, tenkhongdauen, id, photo,photo2 FROM #_product WHERE hienthi=1 AND type = ? AND noibat>0 ORDER BY stt,id DESC",array('outfit'));
    $static_gioithieu = $d->rawQueryOne("select id, type, ten$lang as ten, mota$lang as mota, photo FROM #_static WHERE type = ? LIMIT 0,1",array('gioi-thieu'));

    $videonb = $d->rawQuery("SELECT link_video, id, ten$lang,photo FROM #_photo WHERE hienthi=1 AND noibat>0 AND type = ?",array('video'));
    
    /* SEO */
    $seopage = $d->rawQueryOne("SELECT * FROM #_seopage WHERE type = ? limit 0,1",array('trang-chu'));
    $seo->setSeo('h1',$title_crumb);
    if($seopage['title'.$seolang]!='') $seo->setSeo('title',$seopage['title'.$seolang]);
    else $seo->setSeo('title',$title_crumb);
    $seo->setSeo('keywords',$seopage['keywords'.$seolang]);
    $seo->setSeo('description',$seopage['description'.$seolang]);
    $seo->setSeo('url',$func->getPageURL());

    $img_json_bar = json_decode($seopage['options'],true);
    if($img_json_bar['p'] != $seopage['photo'])
    {
        $img_json_bar = $func->getImgSize($seopage['photo'],UPLOAD_SEOPAGE_L.$seopage['photo']);
        $seo->updateSeoDB(json_encode($img_json_bar),'seopage',$seopage['id']);
    }
    $seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_SEOPAGE_L.$seopage['photo']);
    $seo->setSeo('photo:width',$img_json_bar['w']);
    $seo->setSeo('photo:height',$img_json_bar['h']);
    $seo->setSeo('photo:type',$img_json_bar['m']);
?>