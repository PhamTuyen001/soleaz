var $window = $(window),
    $document = $(document);

$.fn.exists = function() {
    return this.length > 0;
};
NN_FRAMEWORK.tocDetail = function(){
	if ($('.toc-list').exists) {
		$(".toc-list").toc({
            content: "div#toc-content",
            headings: "h2,h3,h4"
        });
        if(!$(".toc-list li").length) $(".meta-toc").hide();
        $('.toc-list').find('a').click(function(){
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
	}
};
NN_FRAMEWORK.tabDetail = function(){
	if($('.ul-tabs-pro-detail').exists){
		$('body').on('click', '.ul-tabs-pro-detail li', function(event) {
			 var tabs = $(this).data("tabs");
	        $(".content-tabs-pro-detail, .ul-tabs-pro-detail li").removeClass("active");
	        $(this).addClass("active");
	        $("."+tabs).addClass("active");
		});
	}
};
NN_FRAMEWORK.iconSearch = function(){
	if($('.icon-search').exists){
		$('body').on('click', '.icon-search', function(event) {
			var obj = $(this);
			if(obj.hasClass('active')){
	            obj.removeClass('active');
	            $(".search-grid").stop(true,true).animate({opacity: "0",width: "0px"}, 200);   
	        } else {
	            obj.addClass('active');                            
	            $(".search-grid").stop(true,true).animate({opacity: "1",width: "230px"}, 200);
	        }
	        var el = obj.next().find("input").attr('id');
	        $('#'+el).focus();
	        $('.icon-search i').toggleClass('fa fa-search fa fa-times');
	    });
	}
};
NN_FRAMEWORK.backToTop = function(){
	$('body').on("click",".scrollToTop",function() {
        $('html, body').animate({scrollTop : 0},800);
        return false; 
    });
};
NN_FRAMEWORK.setAlt = function(){
	$('img').each(function(index, element) {
		var obj = $(this);
        if(!obj.attr('alt') || obj.attr('alt')==''){
            obj.attr('alt',WEBSITE_NAME);
        }
    });
};
NN_FRAMEWORK.pageCart = function(){
	if($('.addcart').exists){
		$("body").on("click", ".addcart",function(){
			var obj = $(this);
			var el_input = $(".qty-pro");
	        var mau = ($(".color-pro-detail input:checked").val()) ? $(".color-pro-detail input:checked").val() : 0;
	        var size = ($(".size-pro-detail input:checked").val()) ? $(".size-pro-detail input:checked").val() : 0;
	        var id = obj.data("id");
	        var action = obj.data("action");
	        var qty = (el_input.val()) ? el_input.val() : 1;
	        if(id){
	            $.ajax({
	                url: CONFIG_BASE + 'ajax/ajax_add_cart.php',
	                type: "POST",
	                dataType: 'json',
	                async: false,
	                data: {cmd:'addcart',id:id,mau:mau,size:size,qty:qty},
	                success: function(result){
	                    if(action=='addnow'){
	                        $('.count-cart').html(result.max);
	                        $.ajax({
	                            url: CONFIG_BASE + 'ajax/ajax_popup_cart.php',
	                            type: "POST",
	                            dataType: 'html',
	                            async: false,
	                            success: function(result){
	                                $("#popup-cart .modal-body").html(result);
	                                $('#popup-cart').modal('show');
	                            }
	                        });
	                    }else if(action=='buynow'){
	                        window.location = CONFIG_BASE + "gio-hang";
	                    }
	                }
	            });
	        }
	    });
    }
    if($('.del-procart').exists){
	    $("body").on("click", ".del-procart",function(){
	        if(confirm(LANG['delete_product_from_cart'])){
	            var code = $(this).data("code");
	            var ship = $(".price-ship").val();
	            var endow = $(".price-endow").val();
	            $.ajax({
	                type: "POST",
	                url: CONFIG_BASE + 'ajax/ajax_delete_cart.php',
	                dataType: 'json',
	                data: {code:code,ship:ship,endow:endow},
	                success: function(result){
	                    $('.count-cart').html(result.max);
	                    if(result.max){
	                        $('.price-temp').val(result.temp);
	                        $('.load-price-temp').html(result.tempText);
	                        $('.price-total').val(result.total);
	                        $('.load-price-total').html(result.totalText);
	                        $(".procart-"+code).remove();
	                    }else{
	                        $(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>'+LANG['no_products_in_cart']+'</p><span>'+LANG['back_to_home']+'</span></a>');
	                    }
	                }
	            });
	        }
	    });
    }
    if($('.counter-procart').exists){
	    $("body").on("click", ".counter-procart",function(){
	        var btn = $(this);
	        var input = btn.parent().find("input");
	        var pid = input.data('pid');
	        var code = input.data('code');
	        var old_val = btn.parent().find("input").val();
	        if(btn.text() == "+") quantity = parseFloat(old_val) + 1;
	        else if(old_val > 1) quantity = parseFloat(old_val) - 1;
	        btn.parent().find("input").val(quantity);
	        update_cart(pid,code,quantity);
	    });
	}
	if($('.quantity-procat').exists){
		$("body").on("change", ".quantity-procat",function(){
			var obj = $(this);
        	var quantity = obj.val();
	        var pid = obj.data("pid");
	        var code = obj.data("code");
	        update_cart(pid,code,quantity);
	    });
	}
    if($('.apply-coupon').exists){
	    $("body").on("click", ".apply-coupon", function(){
	        var coupon = $(".code-coupon").val();
	        var ship = $(".price-ship").val();
	        if(coupon=='') {
	            modalNotify(LANG['no_coupon']);
	            return false;
	        }
	        $.ajax({
	            type: "POST",
	            url: CONFIG_BASE + 'ajax/ajax_coupon_cart.php',
	            dataType: 'json',
	            data: {coupon:coupon,ship:ship},
	            success: function(result){
	                $('.price-total').val(result.total);
	                $('.load-price-total').html(result.totalText);
	                $('.price-endowType').val(result.endowType);
	                $('.price-endowID').val(result.endowID);
	                $('.price-endow').val(result.endow);
	                $('.load-price-endow').html(result.endowText);
	                if(result.error!=''){
	                    $(".code-coupon").val("");
	                    modalNotify(result.error);
	                }
	            }
	        });
	    });
    }
    if($('.payments-label').exists){
	    $("body").on("click", ".payments-label", function(){
	    	var obj = $(this);
	        var payments = obj.data("payments");
	        $(".payments-cart .payments-label, .payments-info").removeClass("active");
	        obj.addClass("active");
	        $(".payments-info-"+payments).addClass("active");
	    });
	}
	if($('.color-pro-detail').exists){
		$('body').on('click', '.color-pro-detail', function(event) {
			var obj = $(this);
	        $("a.color-pro-detail").removeClass("active");
	        obj.addClass("active");
	        var id_mau = $("input[name=color-pro-detail]:checked").val();
	        var idpro = obj.data('idpro');
	        $.ajax({
	            url: CONFIG_BASE + 'ajax/ajax_colorthumb.php',
	            type: "POST",
	            dataType: 'html',
	            data: {id_mau:id_mau,idpro:idpro},
	            success: function(result){
	                if(result!=''){
	                    $('.left-pro-detail').html(result);
	                    MagicZoom.start('Zoom-1');
	                    $('.in-arrow-detail').owlCarousel({
							loop: false,
							margin: 5,
							responsiveClass:true,
							dots: false,
							nav: true,
							navText: ['<div class="owlleft"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline></svg></div>','<div class="owlright"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline></svg></div>'],
							autoplay: true,
							autoplayTimeout: 4000,
							smartSpeed: 3000,
							autoplayHoverPause:true,
							autoHeight:false,
							responsive:{
								0:{
									items: 2
								},
								600:{
									items: 3
								},
								1000:{
									items: 4			
								},
								1200:{
									items: 5
								}
							}
						})
	                }
	            }
	        });
	    });
    }
    if($('.color-pro-detail').exists){
		$('body').on('click', '.size-pro-detail', function(event) {
	        $("a.size-pro-detail").removeClass("active");
	        $(this).addClass("active");
	    });
	}
	if($('.quantity-pro-detail').exists){
		$(".quantity-pro-detail span").click(function(){
	        var btn = $(this);
	        var old_val = btn.parent().find("input").val();
	        if(btn.text() == "+"){
	            var newVal = parseFloat(old_val) + 1;
	        }else{
	            if(old_val > 1) var newVal = parseFloat(old_val) - 1;
	            else var newVal = 1;
	        }
	        btn.parent().find("input").val(newVal);
	    });
	}
};

NN_FRAMEWORK.aweOwlPage = function() {
	var owl = $('.owl-carousel.in-page');
  	owl.each( function(){
		var xs_item = $(this).attr('data-xs-items');
		var md_item = $(this).attr('data-md-items');
		var lg_item = $(this).attr('data-lg-items');
		var sm_item = $(this).attr('data-sm-items');	
		var margin=$(this).attr('data-margin');
		var dot=$(this).attr('data-dot');
		var nav=$(this).attr('data-nav');
		var height=$(this).attr('data-height');
		var play=$(this).attr('data-play');
		var loop=$(this).attr('data-loop');
		
		if (typeof margin !== typeof undefined && margin !== false) {    
		} else{
			margin = 30;
		}
		if (typeof xs_item !== typeof undefined && xs_item !== false) {    
		} else{
			xs_item = 1;
		}
		if (typeof sm_item !== typeof undefined && sm_item !== false) {    

		} else{
			sm_item = 3;
		}	
		if (typeof md_item !== typeof undefined && md_item !== false) {    
		} else{
			md_item = 3;
		}
		if (typeof lg_item !== typeof undefined && lg_item !== false) {    
		} else{
			lg_item = 3;
		}

		if (loop == 1) { loop = true; } else{ loop = false; }
		if (dot == 1) { dot = true; } else{ dot = false; }
		if (nav == 1) { nav = true; } else{ nav = false; }
		if (play == 1) { play = true; } else{ play = false; }
		
		$(this).owlCarousel({
			loop: loop,
			margin:Number(margin),
			responsiveClass:true,
			dots:dot,
			nav:nav,
			navText: ['<div class="owlleft"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline></svg></div>','<div class="owlright"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline></svg></div>'],
			autoplay:play,
			autoplayTimeout: 4000,
			smartSpeed: 3000,
			autoplayHoverPause:true,
			autoHeight:false,
			responsive:{
				0:{
					items:Number(xs_item)				
				},
				600:{
					items:Number(sm_item)				
				},
				1000:{
					items:Number(md_item)				
				},
				1200:{
					items:Number(lg_item)				
				}
			}
		})
	});
};

NN_FRAMEWORK.slickPage = function(){
	if($('.slick.in-page').length > 0){
		$('.slick.in-page').each(function() {
			var dots = $(this).attr('data-dots');
			var infinite = $(this).attr('data-infinite');
			var speed = $(this).attr('data-speed');
			var vertical = $(this).attr('data-vertical');
			var arrows = $(this).attr('data-arrows');
			var autoplay = $(this).attr('data-autoplay');
			var autoplaySpeed = $(this).attr('data-autoplaySpeed');
			var centerMode =  $(this).attr('data-centerMode');
			var centerPadding =  $(this).attr('data-centerPadding');
			var slidesDefault =  $(this).attr('data-slidesDefault');
			var responsive =  $(this).attr('data-responsive');
			var xs_item = $(this).attr('data-xs-items');
			var md_item = $(this).attr('data-md-items');
			var lg_item = $(this).attr('data-lg-items');
			var sm_item = $(this).attr('data-sm-items');
			var slidesDefault_ar = slidesDefault.split(":");
			var xs_item_ar = xs_item.split(":");
			var sm_item_ar = sm_item.split(":");
			var md_item_ar = md_item.split(":");
			var lg_item_ar = lg_item.split(":");
			var to_show = slidesDefault_ar[0];
			var to_scroll = slidesDefault_ar[1];
			if (responsive == 1) { responsive = true; } else{ responsive = false; }
			if (dots == 1) { dots = true; } else{ dots = false; }
			if (arrows == 1) { arrows = true; } else{ arrows = false; }
			if (infinite == 1) { infinite = true; } else{ infinite = false; }
			if (autoplay == 1) { autoplay = true; } else{ autoplay = false; }
			if (centerMode == 1) { centerMode = true; } else{ centerMode = false; }
			if (vertical == 1) { vertical = true; } else{ vertical = false; }
			if (typeof speed !== typeof undefined && speed !== false) {    
			} else{ speed = 300; }
			if (typeof autoplaySpeed !== typeof undefined && autoplaySpeed !== false) {    
			} else{ autoplaySpeed = 2000; }
			if (typeof centerPadding !== typeof undefined && centerPadding !== false) {    
			} else{ centerPadding = "0px"; }
			var reponsive_json = [{
			      	breakpoint: 1024,
			      	settings: {
			        	slidesToShow: Number(lg_item_ar[0]),
			        	slidesToScroll: Number(lg_item_ar[1])
			      	}
			    },{
			      	breakpoint: 992,
			      	settings: {
			        	slidesToShow: Number(md_item_ar[0]),
			        	slidesToScroll: Number(md_item_ar[1])
			      	}
			    },{
			      	breakpoint: 768,
			      	settings: {
				        slidesToShow: Number(sm_item_ar[0]),
				        slidesToScroll: Number(sm_item_ar[1]),
				        vertical: false
			      	}
			    },{
			      	breakpoint: 480,
			      	settings: {
			        	slidesToShow: Number(xs_item_ar[0]),
			        	slidesToScroll: Number(xs_item_ar[1]),
			        	vertical: false
			      	}
				}];
			if(responsive==1){
				$(this).slick({
					dots: dots,
					infinite: infinite,
					arrows: arrows,
					speed: Number(speed),
					vertical: vertical,
					slidesToShow: Number(to_show),
					slidesToScroll: Number(to_scroll),
					autoplay: autoplay,
					autoplaySpeed: Number(autoplaySpeed),
					responsive: reponsive_json
				});
			}else{
				$(this).slick({
					dots: dots,
					infinite: infinite,
					arrows: arrows,
					speed: Number(speed),
					vertical: vertical,
					slidesToShow: Number(to_show),
					slidesToScroll: Number(to_scroll),
					autoplay: autoplay,
					autoplaySpeed: Number(autoplaySpeed)
				});
			}
		});
	}
};
NN_FRAMEWORK.loadPage = function(){
	ValidationFormSelf("validation-newsletter");
	ValidationFormSelf("validation-cart");
	ValidationFormSelf("validation-user");
	ValidationFormSelf("validation-contact");
	loadPagingAjax("ajax/ajax_product.php",'.paging-product',0,12);
	ResizeWebsite();
};

NN_FRAMEWORK.galleryPage = function(){
	$('.pic-album [data-fancybox]').fancybox({
		thumbs : {
			autoStart : true
		},
		transitionEffect: "circular",
		slideShow: {
		    autoStart: true,
		    speed: 3000
		}
	});
};

$window.resize(function(){
    ResizeWebsite();
});
$window.scroll(function() {
    if($window.scrollTop() >= $(".header").height()){
        $(".wrap-header").css({position:"fixed",left:'0px',right:'0px',top:'0px',zIndex:'999'});
    }else{
        $(".wrap-header").css({position:"relative"});
    }
    if(!$('.scrollToTop').length){
        $("body").append('<div class="scrollToTop"><img src="'+GOTOP+'" alt="Go Top"/></div>');
    }
    if($(this).scrollTop() > 100){
        $('.scrollToTop').fadeIn();
    }else{
        $('.scrollToTop').fadeOut();
    }
});
NN_FRAMEWORK.menuMobile = function(){
	$('body').on('click', 'span.btn-dropdown-menu', function() {
		var o = $(this);
		if(!o.hasClass('active')){
			o.addClass('active');
			o.next('.sub-menu').stop().slideDown(300);
		}else{
			o.removeClass('active');
			o.next('.sub-menu').stop().slideUp(300);
		}
	});	
	$('.menu-mobile-btn').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$('.header-left-fixwidth').toggleClass('open-sidebar-menu');
		$('.opacity-menu').toggleClass('open-opacity');
	});
	$('.opacity-menu').click(function(e){
		$('.open-menu-header').removeClass('open-button');
		$('.header-left-fixwidth').removeClass('open-sidebar-menu');
		$('.opacity-menu').removeClass('open-opacity');
	});
};
function Searchs($p=0){
	let list=[];
	let cat=[];
	let color=[];
	let total=parseInt($('a.click-product').data('total'));
	let url=$('input[name="url"]').val();
	let active=false;
	let price_from=parseInt($('input[name="price-from"]').attr('value'));
	let price_to=parseInt($('input[name="price-to"]').attr('value'));
	$('input[name="list"]').each(function(index, el) {
		if($(this).is(':checked') && $(this).val()>0) list.push($(this).val());	
	});
	$('input[name="cat"]').each(function(index, el) {
		if($(this).is(':checked') && $(this).val()>0) cat.push($(this).val());	
	});
	$('input[name="color"]').each(function(index, el) {
		if($(this).is(':checked') && $(this).val()>0) color.push($(this).val());	
	});
	let url_search=url;
	if(list.length>0){
		if(active){
			url_search +="&id_list="+list.toString();
		}else{
			url_search +="?id_list="+list.toString();active=true;
		}
	}
	if(cat.length>0){
		if(active){
			url_search +="&id_cat="+cat.toString();
		}else{
			url_search +="?id_cat="+cat.toString();active=true;
		}
	}
	if(color.length>0){
		if(active){
			url_search +="&color="+color.toString();
		}else{
			url_search +="?color="+color.toString();active=true;
		}
	}
	if(price_from==0 && price_to >0){
		if(active){
			url_search +="&price=0,"+price_to;
		}else{
			url_search +="?price=0,"+price_to;active=true;
		}
	}else if(price_from>0 && price_to >0){
		if(active){
			url_search +="&price="+price_from+","+price_to;
		}else{
			url_search +="?price="+price_from+","+price_to;active=true;
		}
	}else{}
	$.ajax({
		url: url_search,
		type: 'GET',
		beforeSend:function(){
			$('.loading-mask').show();
		},
		success:function(data){
			let $html=$('<div>'+data+'</div>');
			setTimeout(function(){
				$('#load-product .row').html($($html).find('.col-product-search'));
				$('.loading-mask').hide();
				window.history.pushState('page2', 'Title', url_search);
				Price();
			},2000)
		}
	})
}
function LoadMoreProduct(){
	let list=[];
	let cat=[];
	let color=[];
	let total=$('a.click-product').data('total');
	let p=parseInt($('input[name="p"]').attr('value'))+1;
	let url=$('input[name="url"]').val()+'?p='+p;
	let price_from=$('input[name="price-from"]').attr('value');
	let price_to=$('input[name="price-to"]').attr('value');

	$('input[name="list"]').each(function(index, el) {
		if($(this).is(':checked') && $(this).val()>0) list.push($(this).val());	
	});
	$('input[name="cat"]').each(function(index, el) {
		if($(this).is(':checked') && $(this).val()>0) cat.push($(this).val());	
	});
	$('input[name="color"]').each(function(index, el) {
		if($(this).is(':checked') && $(this).val()>0) color.push($(this).val());	
	});
	let url_search=url;
	if(list.length>0){
		url_search +="&id_list="+list.toString();
	}
	if(cat.length>0){
		url_search +="&id_cat="+cat.toString();
	}
	if(color.length>0){
		url_search +="&color="+color.toString();
	}
	if(price_from==0 && price_to >0){
		url_search +="&price=0,"+price_to;
	}else if(price_from>0 && price_to >0){
		url_search +="&price=0,"+price_to;
	}else{}
	$.ajax({
		url: url_search,
		type: 'GET',
		beforeSend:function(){
			$('.loading-mask').show();
		},
		success:function(data){
			setTimeout(function(){
				let $html=$('<div>'+data+'</div>');
				$('#load-product .row').append($($html).find('.col-product-search'));
				$('input[name="p"]').attr('value',p);
				let tt=$('#load-product .row .col-product-search').length;
				if(tt==total) $('a.click-bloc').hide();
				$('.loading-mask').hide();
			},2000)
		}
	})
}
function Price(){
	$("#price-range-slider").ionRangeSlider({
        skin: "sharp",
        min: $("#price-range-slider").attr('min'),
        max: $("#price-range-slider").attr('max'),
        from: $("#price-range-slider").attr('data-from'),
        to:$("#price-range-slider").attr('data-to'),
        type: "double",
        grid: true,
        postfix: " USD",
        onFinish: function (data) {
        	$('input[name="price-from"]').attr('value',data.from);
        	$('input[name="price-to"]').attr('value',data.to);
        }
    });
}
NN_FRAMEWORK.ProductDeatail = function(){
	var $slider = $('.slick-main:not(.slick-initialized)');
	var $progressBar = $('.progress');
	$slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
		let count=nextSlide+1;
		let counts=slick.slideCount;
		var calc = ( count / counts ) * 100;
		$progressBar.css('background-size', '100% ' + calc +'%').attr('aria-valuenow', calc );
	});
	$slider.on('init', function(event, slick) {
		let counts=slick.slideCount;
		var calc = ( 1 / counts ) * 100;
		$progressBar.css('background-size', '100% ' + calc +'%').attr('aria-valuenow', calc );
	});
	$slider.slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		vertical: true,
		speed: 400,
		asNavFor: '.slick-thumbs'
	});  
	$('.slick-thumbs:not(.slick-initialized)').slick({
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  asNavFor: '.slick-main',
	  vertical: true,
	  dots: false,
	  centerMode: false,
	  focusOnSelect: true
	});
	$('.noidung_sanpham p').click(function(event) {
		if($(this).hasClass('active')){
			$('.noidung_sanpham p').removeClass('active');
			$('.noidung_sanpham .content-noidung').animate({height:0}, 0);
			return false;
		}
		$('.noidung_sanpham p').removeClass('active');
		$(this).addClass('active');
		$('.noidung_sanpham .content-noidung').animate({height:0}, 0);
		let height=$(this).next('.content-noidung').find('.show-content-noidung').outerHeight();
		$(this).next('.content-noidung').animate({height:height}, 0);
	});
}
$document.ready(function() {
	setTimeout(function(){$("#pre-loader").fadeOut(1e3)},400);Price();

	$('body').on('change', 'input[name="colors"]', function(event) {
		let id=$(this).val();
		let pid=$(this).data('pid');
		$.ajax({
			url: 'ajax/ajax_colorthumb.php',
			async:true,
			dataType: 'html',
			type:'POST',
			data: {id:id,pid:pid},
			beforeSend:function(){
				$('.loading-mask').show();
			},
			success:function(data){
				$('#load_detail_product').html(data);
				
				setTimeout(function(){
					NN_FRAMEWORK.ProductDeatail();
					$('.loading-mask').hide();
				},500);
				$(window).resize();
			}
		})
		
	});

	$('body').on('click', '.click-product', function(event) {
		event.preventDefault();
		LoadMoreProduct();
	});
	$('input[name="list"]').change(function(event) {
		if($(this).val()==0){
			$('input[name="list"]').not($(this)).prop('checked', false);
		}else{
			$('input#list-0').prop('checked', false);
		}
	});
	$('input[name="cat"]').change(function(event) {
		if($(this).val()==0){
			$('input[name="cat"]').not($(this)).prop('checked', false);
		}else{
			$('input#cat-0').prop('checked', false);
		}
	});
	$('input[name="color"]').change(function(event) {
		if($(this).val()==0){
			$('input[name="color"]').not($(this)).prop('checked', false);
		}
	});
	$('a.click-bloc').click(function(event) {
		let total=$(this).data('total');
		let page=$(this).data('page')+1;
		let url=$(this).data('url');
		$.ajax({
			url: url+'?p='+page,
			type: 'GET',
			beforeSend:function(){
				$('a.click-bloc').addClass('active');
			},
			success:function(data){
				let $html=$('<div>'+data+'</div>');
				$('#load-more-blog .row').append($($html).find('.col-news'));
				$('a.click-bloc').attr('data-page',page);
				let tt=$('#load-more-blog .row .col-news').length;
				if(tt==total) $('a.click-bloc').hide();
			}
		})
		
	});
	
	NN_FRAMEWORK.menuMobile(),
	NN_FRAMEWORK.galleryPage(),
	NN_FRAMEWORK.aweOwlPage(),
	NN_FRAMEWORK.ProductDeatail(),
	NN_FRAMEWORK.slickPage(),
	NN_FRAMEWORK.loadPage(),
	NN_FRAMEWORK.tocDetail(),
	NN_FRAMEWORK.tabDetail(),
	NN_FRAMEWORK.iconSearch(),
	NN_FRAMEWORK.backToTop(),
	NN_FRAMEWORK.setAlt(),
	NN_FRAMEWORK.pageCart();
})