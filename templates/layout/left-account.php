<div class="wrap-left-acount">
	<div class="box-avatar">
		<div class="img-avatar">
			<form id="chage-avatar">
			<p>
				<img id="img-output" src="<?=THUMBS?>/109x109x1/<?=UPLOAD_USER_L.$rowUser['avatar']?>" alt="<?=$rowUser['ten']?>">
				<i><img src="assets/images/change_avata.svg" alt="<?=$rowUser['ten']?>"></i>
			</p>
			<input type="file" accept="image/*" onchange="loadFile(event)" id="files" name="files">
			</form>
		</div>
		<ul>
			<li><strong><?=$rowUser['ten']?></strong></li>
			<li><?=$rowUser['email']?></li>
			<li><?=$rowUser['dienthoai']?></li>
		</ul>
	</div>
	<div class="menu-account">
		<ul>
			<li><a href="account/my-info" class="<?=($action=='my-info')?'active':''?>"><?=thongtincanhan?></a></li>
			<li><a href="account/my-address" class="<?=($action=='my-address')?'active':''?>"><?=myaddress?></a></li>
			<li><a href="account/my-order" class="<?=($action=='my-order')?'active':''?>"><?=myorder?></a></li>
			<li><a href="account/my-wishlist" class="<?=($action=='my-wishlist')?'active':''?>"><?=wishlist?></a></li>
			<li><a href="account/my-voucher" class="<?=($action=='my-voucher')?'active':''?>"><?=myvoucher?></a></li>
			<li><a href="account/logout"><?=dangxuat?></a></li>
			
		</ul>
	</div>
</div>