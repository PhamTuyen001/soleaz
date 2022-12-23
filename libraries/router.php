<?php
	/* Validate URL */
	$func->checkUrl($config['website']['index']);

	/* Check login */
    $func->checkLogin();

	/* Mobile detect */
    $deviceType = ($detect->isMobile() || $detect->isTablet()) ? 'mobile' : 'computer';
    @define('TEMPLATE','./templates/');
    /*if($deviceType == 'computer') @define('TEMPLATE','./templates/');
    else @define('TEMPLATE','./templates-mobile/');*/

    /* Watermark */
    $wtmPro = $d->rawQueryOne("SELECT hienthi, photo, options FROM #_photo WHERE type = ? AND act = ? LIMIT 0,1",array('watermark','photo_static'));
	$wtmNews = $d->rawQueryOne("SELECT hienthi, photo, options FROM #_photo WHERE type = ? AND act = ? LIMIT 0,1",array('watermark-news','photo_static'));

    /* Router */
    $router->setBasePath($config['database']['url']);
    $router->map('GET',array('admin/','admin'), function(){
		global $func, $config;
		$func->redirect($config['database']['url']."admin/index.php");
		exit;
	});
	$router->map('GET',array('admin','admin'), function(){
		global $func, $config;
		$func->redirect($config['database']['url']."admin/index.php");
		exit;
	});
	
    $router->map('GET|POST', '', 'index', 'home');
    $router->map('GET|POST', 'index.php', 'index', 'index');
    $router->map('GET|POST', 'sitemap.xml', 'sitemap', 'sitemap');
    $router->map('GET|POST', '[a:com]', 'allpage', 'show');
    $router->map('GET|POST', '[a:com]/[a:lang]/', 'allpagelang', 'lang');
    $router->map('GET|POST', '[a:com]/[a:action]', 'account', 'account');
    $router->map('GET', THUMBS.'/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func;
        $func->createThumb($w,$h,$z,$src,null,THUMBS);
    },'thumb');
    $router->map('GET', WATERMARK.'/product/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func, $wtmPro;
        $func->createThumb($w,$h,$z,$src,$wtmPro,"product");
    },'watermark');
    $router->map('GET', WATERMARK.'/news/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func, $wtmNews;
        $func->createThumb($w,$h,$z,$src,$wtmNews,"news");
    },'watermarkNews');
    $match = $router->match();
	if(is_array($match)){
		if(is_callable($match['target'])){
			call_user_func_array($match['target'], $match['params']); 
		}else{
			$com = (isset($match['params']['com'])) ? htmlspecialchars($match['params']['com']) : htmlspecialchars($match['target']);
			$get_page = isset($_GET['p']) ? htmlspecialchars($_GET['p']) : 1;
		}
	}else{
		header($_SERVER["SERVER_PROTOCOL"].'404 Not Found');
		include("404.php");
		exit;
	}

    /* Setting */
    $sqlCache = "select * from #_setting";
    $setting = $cache->getCache($sqlCache,'fetch',600);
    $optsetting = json_decode($setting['options'],true);

    /* Lang */
    $_SESSION['lang'] = (isset($_SESSION['lang'])) ? $_SESSION['lang']:'en';
    if(isset($match['params']['lang'])) $_SESSION['lang'] = $match['params']['lang'];
    else if(!isset($_SESSION['lang']) && !isset($match['params']['lang'])) $_SESSION['lang'] = $optsetting['lang_default'];
    $lang = $_SESSION['lang'];

    /* Slug lang */
    $sluglang = 'tenkhongdauen';

    /* SEO Lang */
    $seolang = "en";

    /* Require datas */
    require_once LIBRARIES."lang/lang$lang.php";
    require_once SOURCES."allpage.php";

	/* Tối ưu link */
	$requick = array(
		/* Sản phẩm */
		array("tbl"=>"product_list","field"=>"idl","source"=>"product","com"=>"products","type"=>"san-pham"),
		array("tbl"=>"product_cat","field"=>"idc","source"=>"product","com"=>"products","type"=>"san-pham"),
		array("tbl"=>"product_item","field"=>"idi","source"=>"product","com"=>"products","type"=>"san-pham"),
		array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"products","type"=>"san-pham",'menu'=>true),


		array("tbl"=>"product_list","field"=>"idl","source"=>"product","com"=>"outfit","type"=>"outfit"),
		array("tbl"=>"product_cat","field"=>"idc","source"=>"product","com"=>"outfit","type"=>"outfit"),
		array("tbl"=>"product_item","field"=>"idi","source"=>"product","com"=>"outfit","type"=>"outfit"),
		array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"outfit","type"=>"outfit",'menu'=>true),
		
		
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"tin-tuc","type"=>"tin-tuc",'menu'=>true),
		array("tbl"=>"news_list","field"=>"idl","source"=>"news","com"=>"thiet-bi-su-kien","type"=>"thiet-bi-su-kien"),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"thiet-bi-su-kien","type"=>"thiet-bi-su-kien",'menu'=>true),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"blog","type"=>"blog",'menu'=>false),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"chinh-sach","type"=>"chinh-sach",'menu'=>false),

		/* Trang tĩnh */
		array("tbl"=>"static","field"=>"id","source"=>"static","com"=>"intro","type"=>"gioi-thieu",'menu'=>true),
		/* Liên hệ */
		array("tbl"=>"","field"=>"id","source"=>"","com"=>"lien-he","type"=>"",'menu'=>true),
	);

	/* Find data */
	if($com != 'search' && $com != 'account' && $com != 'sitemap')
	{
		foreach($requick as $k => $v)
		{
			$url_tbl = $v['tbl'];
			$url_tbltag = (isset($v['tbltag'])) ? $v['tbltag']:'';
			$url_type = $v['type'];
			$url_field = $v['field'];
			$url_com = $v['com'];
			
			if($url_tbl!='' && $url_tbl!='static' && $url_tbl!='photo')
			{
				$row = $d->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi=1",array($com,$url_type));
				
				if($row['id'])
				{
					$_GET[$url_field] = $row['id'];
					$com = $url_com;
					break;
				}
			}
		}
	}
	if(!empty($_SESSION[$login_member])){
		$rowUser = $d->rawQueryOne("select * from #_member where id=? and hienthi=1",array($_SESSION[$login_member]['id']));
	}
	/* Switch coms */
	switch($com)
	{
		case 'contact-us':
			$source = "contact";
			$template = "contact/contact";
			$seo->setSeo('type','object');
			$title_crumb = lienhe;
			break;

		case 'intro':
			$source = "news";
			$template = "static/intro";
			$type = $com;
			$seo->setSeo('type','article');
			$title_crumb = gioithieu;
			break;


		case 'blog':
			$source = "news";
			$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = $com;
			$title_crumb = blog;
			break;


		case 'chinh-sach':
			$source = "news";
			$template = isset($_GET['id']) ? "static/static":"";
			$seo->setSeo('type','article');
			$type = $com;
			break;

		case 'thuong-hieu':
			$source = "product";
			$template = "product/product";
			$seo->setSeo('type','object');
			$type = 'san-pham';
			break;

		case 'products':
			$source = "product";
			$template = (!empty($_GET['id'])) ? "product/product_detail": ((empty($_GET['idl']) && empty($_GET['idc']) && empty($_GET['idi'])) ? "product/product":"product/product_all" );
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'san-pham';
			$title_crumb = sanpham;
			break;

		case 'sale':
			$source = "product";
			$template = "product/product_search";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'san-pham';
			$title_crumb = sale;
			break;

		case 'featured-products':
			$source = "product";
			$template = "product/product_search";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'san-pham';
			$title_crumb = sanphamnoibat;
			break;

		case 'new-collection':
			$source = "product";
			$template = "product/product_search";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'san-pham';
			$title_crumb = newcollection;
			break;

		case 'outfit':
			$source = "product";
			$template = isset($_GET['id']) ? "outfit/outfit_detail" : "outfit/outfit";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = $com;
			$title_crumb = outfit;
			break;

		case 'search':
			$source = "search";
			$template = "product/product_search";
			$seo->setSeo('type','object');
			$title_crumb = timkiem;
			break;

		case 'gio-hang':
			$source = "giohang";
			$template = 'order/giohang';
			$title_crumb = giohang;
			$seo->setSeo('type','object');
			break;

		case 'checkout':
			$source = (!empty($step))?'success':'checkouts';
			$template = (!empty($step))?'order/success':'order/checkouts';
			$title_crumb = thanhtoan;
			$seo->setSeo('type','object');
			break;


		case 'account':
			$source = "user";
			break;

		case 'ngon-ngu':
			if(isset($lang))
			{
				switch($lang)
				{
					case 'tl':
						$_SESSION['lang'] = 'tl';
						break;
					case 'en':
						$_SESSION['lang'] = 'en';
						break;
					default:
						$_SESSION['lang'] = 'en';
						break;
				}
			}
			$func->redirect($_SERVER['HTTP_REFERER']);
			break;

		case 'sitemap':
			include_once LIBRARIES."sitemap.php";
			exit();
			
		case '':
		case 'index':
			$source = "index";
			$template ="layout/index";
			$seo->setSeo('type','website');
			break;

		default: 
			header('HTTP/1.0 404 Not Found', true, 404);
			include("404.php");
			exit();
	}

	/* Include sources */
	if($source!='') include SOURCES.$source.".php";
	if($template=='')
	{
		header('HTTP/1.0 404 Not Found', true, 404);
		include("404.php");
		exit();
	}
?>