<section class="header">
	<div class="nav_top">
		<div class="container">
			<div class="slogan-top">
				<p class="text-center"><?=$slogan['ten'.$lang]?></p>
			</div>
		</div>
	</div>
	<div class="wrap-header">
		<div class="container d-flex align-items-center justify-content-between">
			<div class="logo">
				<a href="">
					<img src="<?=UPLOAD_PHOTO_L.$logo['photo']?>" alt="<?=$setting['ten'.$lang]?>">
				</a>
			</div>
			<div class="wrap-menu"><?php include TEMPLATE.LAYOUT."menu.php";?></div>
			<div class="wrap-tool-header d-flex align-items-end justify-content-end">
				<div class="hd__icon_tool ml-0">
					<div class="icon_tool__btn">
						<div class="icon_tool__btn__child" data-action="search">
							<img src="assets/images/search.svg" alt="">
						</div>
						<div class="v_Search">
				        	<div class="w_timk">
				                <input type="text" id="keyword" placeholder="<?=nhaptukhoatimkiem?>" onkeypress="doEnter(event,'keyword');">
				                <i class="fas fa-search" onclick="onSearch('keyword');"></i>
				            </div>
		        		</div>
					</div>
				</div>
				<!-- <div class="hd__icon_tool">
					<div class="icon_tool__btn">
						<div class="icon_tool__btn__child" data-action="notification">
							<img src="assets/images/notification.svg" alt="">
							<div class="cart__num">2</div>
						</div>
					</div>
				</div> -->
				<div class="hd__icon_tool">
					<div class="icon_tool__btn">
						<div class="icon_tool__btn__child" data-action="wishlist">
							<img src="assets/images/heart.svg" alt="">
							<div class="cart__num ">0</div>
						</div>
					</div>
				</div>
				<div class="hd__icon_tool">
					<div class="icon_tool__btn">
						<div class="icon_tool__btn__child icon_tool__btn__child_cart" data-action="cart">
							<a href="javascript:void(0)">
								<img src="assets/images/cart.svg" alt="">
								<div class="cart__num count-cart"><?=count($_SESSION['cart']);?></div>
							</a>
						</div>
					</div>
				</div>
				<div class="hd__icon_tool">
					<div class="icon_tool__btn">
						<div class="icon_tool__btn__child">
							<a href="account/login"><img src="assets/images/account.svg" alt=""></a>
						</div>
					</div>
				</div>
				<div class="hd__icon_tool">
					<div class="icon_tool__btn">
						<div class="icon_tool__btn__child">
							<a href=""><img src="assets/images/english.svg" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="cart cartJS">
	<div class="cart__wrap hov-df mg-l pd-30">
		<div class="cart__head fl fl-ct">
            <div class="cart__title f-thin"><?=giohang?></div>
            <div class="cart__close f-thin mg-l hov-df cartClose"><?=close?></div>
        </div>
        <hr>
        <div class="cart__con">
        	<div class="wrap-mini-cart box-loading m-btn-loading" id="cart__list__modal">
        		
        	</div>
        </div>
    </div>
	<div class="cart__bg hov-df cartBg"></div>
</div>