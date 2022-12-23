<?php  
	if(!defined('SOURCES')) die("Error");

	if(isset($_GET['keyword']))
	{
		$tukhoa1 = htmlspecialchars($_GET['keyword']);
		$tukhoa = $func->changeTitle($tukhoa1);

		/* Tìm kiếm sản phẩm */
		$where = "";
		$where = "type in ('san-pham') and ( ten$lang LIKE ? or tenkhongdauvi LIKE ? or tenkhongdauen LIKE ? ) and hienthi=1";
		$params = array("%$tukhoa1%","%$tukhoa%","%$tukhoa%");

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,masp,photo2 from #_product where $where order by stt asc,id desc $limit";
		$product = $d->rawQuery($sql,$params);

		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt asc,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);


	}

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	$breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
?>