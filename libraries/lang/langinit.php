<?php
	$columnarr = array(
		"title"=>'TEXT',
		"keywords"=>'TEXT',
		"description"=>'TEXT'
	);

	$columnLang = array(
		"lang"=>"TEXT"
	);
	$columnarr1 = array(
		"ten"=>'VARCHAR(255)',
		"tenkhongdau"=>'VARCHAR(255)',
		"mota"=>'TEXT',
		"noidung"=>'TEXT',
	);
	$table=array('product','product_list','product_cat','product_item','product_sub','photo','news','news_list','news_cat','news_item','news_sub','static','gallery');

	
	function createLangInit()
	{
		global $config, $d, $columnarr,$columnarr1,$columnLang,$table;

		foreach($config['website']['lang'] as $klang => $vlang){
			foreach ($table as $k_table => $v_table) {
				foreach($columnarr1 as $kcol => $vcol)
				{
					$col = $kcol.$klang;
					$rowcol = $d->rawQueryOne("show columns from #_".$v_table." like '$col'");
					if($rowcol==null) $d->rawQuery("alter table #_".$v_table." add $col $vcol character set utf8 collate utf8_unicode_ci");
				}
			}
		}  

		foreach($config['website']['lang'] as $klang => $vlang)
		{
			foreach($columnLang as $kcol => $vcol)
			{
				$col = $kcol.$klang;
				$rowcol = $d->rawQueryOne("SHOW COLUMNS FROM #_lang LIKE '$col'");

				if($rowcol==null) $d->rawQuery("ALTER TABLE #_lang ADD $col $vcol CHARACTER SET utf8 COLLATE utf8_unicode_ci ");
			}
		}
		foreach($config['website']['lang'] as $klang => $vlang)
		{
			foreach($columnarr as $kcol => $vcol)
			{
				$col = $kcol.$klang;
				$rowcol = $d->rawQueryOne("SHOW COLUMNS FROM #_seo LIKE '$col'");

				if($rowcol==null) $d->rawQuery("ALTER TABLE #_seo ADD $col $vcol CHARACTER SET utf8 COLLATE utf8_unicode_ci ");
			}
		}
		foreach($config['website']['lang'] as $klang => $vlang)
		{
			foreach($columnarr as $kcol => $vcol)
			{
				$col = $kcol.$klang;
				$rowcol = $d->rawQueryOne("SHOW COLUMNS FROM #_seopage LIKE '$col'");

				if($rowcol==null) $d->rawQuery("ALTER TABLE #_seopage ADD $col $vcol CHARACTER SET utf8 COLLATE utf8_unicode_ci ");
			}
		}
		foreach($config['website']['lang'] as $klang => $vlang)
		{
			foreach($columnarr as $kcol => $vcol)
			{
				$col = $kcol.$klang;
				$rowcol = $d->rawQueryOne("SHOW COLUMNS FROM #_setting LIKE '$col'");

				if($rowcol==null) $d->rawQuery("ALTER TABLE #_setting ADD $col $vcol CHARACTER SET utf8 COLLATE utf8_unicode_ci ");
			}
		}
		die("Thêm cột ngôn ngữ thành công.");
	}

	function deleteLangInit($lang)
	{
		if($lang!='')
		{
			global $config, $d, $columnarr, $columnLang;

			foreach($config['website']['lang'] as $vlang)
			{
				foreach($columnLang as $kcol => $vcol)
				{
					$col = $kcol.$lang;
					$row = $d->rawQueryOne("SHOW COLUMNS FROM #_lang LIKE '$col'");

					if($row!=null) $d->rawQuery("ALTER TABLE #_lang DROP $col");
				}
			}
			foreach($config['website']['lang'] as $vlang)
			{
				foreach($columnarr as $kcol => $vcol)
				{
					$col = $kcol.$lang;
					$row = $d->rawQueryOne("SHOW COLUMNS FROM #_seo LIKE '$col'");

					if($row!=null) $d->rawQuery("ALTER TABLE #_seo DROP $col");
				}
			}
			foreach($config['website']['lang'] as $vlang)
			{
				foreach($columnarr as $kcol => $vcol)
				{
					$col = $kcol.$lang;
					$row = $d->rawQueryOne("SHOW COLUMNS FROM #_seopage LIKE '$col'");

					if($row!=null) $d->rawQuery("ALTER TABLE #_seopage DROP $col");
				}
			}
			foreach($config['website']['lang'] as $vlang)
			{
				foreach($columnarr as $kcol => $vcol)
				{
					$col = $kcol.$lang;
					$row = $d->rawQueryOne("SHOW COLUMNS FROM #_setting LIKE '$col'");

					if($row!=null) $d->rawQuery("ALTER TABLE #_setting DROP $col");
				}
			}
			die("Xóa cột ngôn ngữ thành công.");
		}
	}

	// createLangInit();
	// deleteLangInit('cn');
?>