<?php 
	$about = $d->rawQuery("SELECT ten$lang, tenkhongdauvi, tenkhongdauen, noidung$lang, ngaytao, id, photo FROM #_news WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('gioi-thieu'));
	$quytrinh = $d->rawQuery("SELECT ten$lang, tenkhongdauvi, tenkhongdauen, noidung$lang,mota$lang, ngaytao, id, photo FROM #_news WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('quy-trinh-thanh-lap'));
?>
<section class="intro-page-one py-5">
	<div class="container">
		<div class="one-content-page text-center">
			<div class="title-product text-center mb-3">
				<h2><?=$about[0]['ten'.$lang]?></h2>
			</div>
			<div class="info-one-content-page">
				<?=htmlspecialchars_decode($about[0]['noidung'.$lang])?>
			</div>
		</div>
		<div class="one-content-page">
			<img src="<?=UPLOAD_NEWS_L.$about[0]['photo']?>" alt="<?=$about[0]['ten'.$lang]?>">
		</div>
	</div>
</section>