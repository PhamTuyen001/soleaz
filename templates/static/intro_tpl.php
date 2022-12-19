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
		<div class="one-content-page text-center">
			<img src="<?=UPLOAD_NEWS_L.$about[0]['photo']?>" alt="<?=$about[0]['ten'.$lang]?>">
		</div>
	</div>
</section>
<?php if(!empty($quytrinh)){?>
<section class="wrap-quytrinh pt-4 pb-5">
	<div class="container">
		<div class="title-quytrinh mb-4"><h2><?=processestablished?></h2></div>
		<div class="row-quytrinh">
			<div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
			<?php foreach ($quytrinh as $k => $v) {?>
				<div class="col-quytrinh">
					<div class="box-quytrinh">
						<span>
							<?=$v['ten'.$lang]?>
						</span>
						<div class="info-quytrinh">
							<h3><?=$v['mota'.$lang]?></h3>
							<p><?=$v['noidung'.$lang]?></p>
						</div>
					</div>
				</div>
			<?php }?>
			</div>
		</div>
	</div>
</section>
<?php }?>

<?php foreach ($about as $k => $v) {if($k==0) continue;?>
<section class="intro-page-one py-4">
	<div class="container">
		<div class="one-content-page text-center mb-5">
			<img src="<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
		</div>
		<div class="one-content-page text-center">
			<div class="row d-flex align-items-center justify-content-between">
				<div class="col-12 col-md-12 col-lg-5">
					<div class="title-product text-center mb-3">
						<h2><?=$v['ten'.$lang]?></h2>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-6">
					<div class="info-one-content-page text-left mb-0">
						<?=htmlspecialchars_decode($v['noidung'.$lang])?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php }?>