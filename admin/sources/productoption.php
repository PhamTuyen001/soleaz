<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active product */
	$arrCheck = array();
	foreach($config['product'] as $k => $v) $arrCheck[] = $k;
	if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Cấu hình đường dẫn trả về */
	$strUrl = "";
	$arrUrl = array('id_list','id_cat','id_item','id_sub','id_product');
	if(isset($_POST['data']))
	{
		$dataUrl = isset($_POST['data']) ? $_POST['data']:null;
		foreach($arrUrl as $k => $v)
		{
			if(!empty($dataUrl[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($dataUrl[$arrUrl[$k]]);
		}
	}
	else
	{
		foreach($arrUrl as $k => $v)
		{
			if(!empty($_REQUEST[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($_REQUEST[$arrUrl[$k]]);
		}
		if(!empty($_REQUEST['keyword'])) $strUrl .= "&keyword=".htmlspecialchars($_REQUEST['keyword']);
	}

	switch($act)
	{
		/* Man */
		case "man":
			get_items();
			$template = "productoption/man/items";
			break;
		case "add":
			$template = "productoption/man/item_add";
			break;
		case "edit":
			get_item();
			$template = "productoption/man/item_add";
			break;
		case "save":
		case "save_copy":
			save_item();
			break;
		case "delete":
			delete_item();
			break;

		/* Gallery */
		case "man_photo":
		case "add_photo":
		case "edit_photo":
		case "save_photo":
		case "delete_photo":
			include "gallery.php";
			break;

		default:
			$template = "404";
	}

	/* Get man */
	function get_items()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type,$id_product;

		$where = "";
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
		$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
		$iditem = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']):'';
		$idsub = (isset($_REQUEST['id_sub'])) ? htmlspecialchars($_REQUEST['id_sub']):'';
		$idbrand = (isset($_REQUEST['id_brand'])) ? htmlspecialchars($_REQUEST['id_brand']):'';
		$id_product = (isset($_REQUEST['id_brand'])) ? htmlspecialchars($_REQUEST['id_product']):'';
		$id_product = (isset($_REQUEST['id_product'])) ? htmlspecialchars($_REQUEST['id_product']):'';

		if(!empty($idlist)) $where .= " and id_list=$idlist";
		if(!empty($idcat)) $where .= " and id_cat=$idcat";
		if(!empty($iditem)) $where .= " and id_item=$iditem";
		if(!empty($idsub)) $where .= " and id_sub=$idsub";
		if(!empty($idbrand)) $where .= " and id_brand=$idbrand";
		if(!empty($id_product)) $where .= " and id_product=$id_product";
		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit man */
	function get_item()
	{
		global $d, $func, $strUrl, $curPage, $item, $gallery, $type, $com,$id_product;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_product where id = ? and type = ? and id_product=?",array($id,$id_product));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		/* Lấy hình ảnh con */
		$gallery = $d->rawQuery("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($id,$com,$type,'man',$type));
	}

	/* Save man */
	function save_item()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $act, $type, $config_base, $setting,$id_product;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		$savehere = (isset($_POST['save-here'])) ? true : false;
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
		else $data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
		if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
		else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		if(isset($config['product'][$type]['size']) && $config['product'][$type]['size']==true) 
		{
			if(!empty($_POST['size_group']) && $_POST['size_group']!='') $data['id_size'] = implode(",", $_POST['size_group']);
			else $data['id_size'] = "";
		}
		if(isset($config['product'][$type]['mau']) && $config['product'][$type]['mau']==true) 
		{
			if(!empty($_POST['mau_group']) && $_POST['mau_group']!='') $data['id_mau'] = implode(",", $_POST['mau_group']);
			else $data['id_mau'] = "";
		}
		if(isset($config['product'][$type]['tags']) && $config['product'][$type]['tags']==true) 
		{
			if(!empty($_POST['tags_group']) && $_POST['tags_group']!='') $data['id_tags'] = implode(",", $_POST['tags_group']);
			else $data['id_tags'] = "";
		}
		if(isset($config['product'][$type]['id_product']) && $config['product'][$type]['id_product']==true) 
		{
			if(!empty($_POST['id_product']) && $_POST['id_product']!='') $data['id_product'] = implode(",", $_POST['id_product']);
			else $data['id_product'] = "";
		}
		$data['gia'] = (isset($data['gia']) && $data['gia'] != '') ? str_replace(",","",$data['gia']) : 0;
		$data['giamoi'] = (isset($data['giamoi']) && $data['giamoi'] != '') ? str_replace(",","",$data['giamoi']) : 0;
		$data['giakm'] = (isset($data['giakm']) && $data['giakm'] != '') ? $data['giakm'] : 0;
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['type'] = $type;

		/* Post seo */
		if(isset($config['product'][$type]['seo']) && $config['product'][$type]['seo']==true)
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if($id && $act!='save_copy')
		{	
			if(isset($_FILES['file'])){
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['product'][$type]['img_type'], UPLOAD_PRODUCT,$file_name)){
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_product where id = ? and type = ?",array($id,$type));
					if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				}
			}

			if(isset($_FILES['file2'])){
				$file_name = $func->uploadName($_FILES['file2']["name"]);
				if($photo2 = $func->uploadImage("file2", $config['product'][$type]['img_type'], UPLOAD_PRODUCT,$file_name)){
					$data['photo2'] = $photo2;
					$row = $d->rawQueryOne("select id, photo2 from #_product where id = ? and type = ?",array($id,$type));
					if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo2']);
				}
			}
			
			if(isset($_FILES['file-taptin'])){
				$file_name = $func->uploadName($_FILES['file-taptin']["name"]);
				if($taptin = $func->uploadImage("file-taptin", $config['product'][$type]['file_type'],UPLOAD_FILE,$file_name)){
					$data['taptin'] = $taptin;
					$row = $d->rawQueryOne("select id, taptin from #_product where id = ? and type = ?",array($id,$type));
					if(!empty($row['id'])) $func->delete_file(UPLOAD_FILE.$row['taptin']);
				}	
			}
			

			/* Cập nhật hình ảnh con */
			if(isset($_FILES['files'])) 
			{
				if(isset($_POST['jfiler-items-exclude-files-0'])){
					$arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
					$arr_chuoi = str_replace('[','',$arr_chuoi);
					$arr_chuoi = str_replace(']','',$arr_chuoi);
					$arr_chuoi = str_replace('\\','',$arr_chuoi);
					$arr_chuoi = str_replace('0://','',$arr_chuoi);
					$arr_file_del = explode(',',$arr_chuoi);
				}
				$dem = 0;
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);

	            for($i=0;$i<$fileCount;$i++) 
	            {
	            	if($_FILES['files']['name'][$i]!='')
					{
						if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
						{
							$file_name = $func->uploadName($myFile["name"][$i]);
							$file_ext = pathinfo($myFile["name"][$i], PATHINFO_EXTENSION);
							if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_PRODUCT."/".$file_name.".".$file_ext))
				            {
								$data1['photo'] = $file_name.".".$file_ext;
								$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
								$data1['tenvi'] = $_POST['ten-filer'][$dem];
								$data1['id_photo'] = $id;
								$data1['com'] = $com;
								$data1['type'] = $type;
								$data1['kind'] = 'man';
								$data1['val'] = $type;
								$data1['hienthi'] = 1;
								$d->insert('gallery',$data1);
				            }
				            $dem++;
						}
		            }
	            }
	        }

			$data['ngaysua'] = time();

			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product',$data))
			{
				/* SEO */
				if(isset($config['product'][$type]['seo']) && $config['product'][$type]['seo']==true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}
				if(isset($config['product'][$type]['schema']) && $config['product'][$type]['schema'] == true)
				{
					//Kiểm tra nếu tạo Schema tự động
					if($buildSchema) {
						foreach($config['website']['seo'] as $k => $v) {
							//lấy tên danh mục
							$pro_list = $d->rawQueryOne("select id,ten$k as ten from #_product_list where id = ? and type = ? limit 0,1",array($data['id_list'],$type));
							//lấy url thuộc vi,en 
							if($k=='vi' || $k=='en'){
								$url_pro=$config_base.$data['tenkhongdau'.$k];
							}else{
								$url_pro=$config_base.$data['tenkhongdauvi'];
							}
							//Kiểm tra hình ảnh
							if($data['photo']!=''){
								$url_img_pro=$config_base.UPLOAD_PRODUCT_L.$data['photo'];
							}else{
								$img_pro = $d->rawQueryOne("select id, photo from #_product where id = ? and type = ? limit 0,1",array($id,$type));
								$url_img_pro=$config_base.UPLOAD_PRODUCT_L.$img_pro['photo'];
							}
							//Tiến hành build schema product
							$dataSchema['schema'.$k]=$func->buildSchemaProduct($id,$data['ten'.$k],$url_img_pro,$dataSeo['description'.$k],$data['masp'],$pro_list['ten'],$setting['ten'.$k],$url_pro,$data['gia']);
						}
					}else{
						$dataSchema = (isset($_POST['dataSchema'])) ? $_POST['dataSchema'] : null;
						if($dataSchema)
						{
							foreach($dataSchema as $column => $value)
							{
								$dataSchema[$column] = htmlspecialchars($value);
							}
						}
					}
					$d->where('idmuc', $id);
					$d->where('com', $com);
					$d->where('act', 'man');
					$d->where('type', $type);
					$d->update('seo',$dataSchema);
				}
				if($savehere) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id);
				else $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
			}
			else
			{
				if($savehere) $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id, false);
				else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
			}
		}
		else
		{
			if(isset($_FILES['file'])){
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['product'][$type]['img_type'], UPLOAD_PRODUCT,$file_name))
				{
					$data['photo'] = $photo;
				}
			}
			if(isset($_FILES['file2'])){
				$file_name = $func->uploadName($_FILES['file2']["name"]);
				if($photo2 = $func->uploadImage("file2", $config['product'][$type]['img_type'], UPLOAD_PRODUCT,$file_name))
				{
					$data['photo2'] = $photo2;
				}
			}

			if(isset($_FILES['file-taptin'])){
				$file_name = $func->uploadName($_FILES['file-taptin']["name"]);
				if($taptin = $func->uploadImage("file-taptin", $config['product'][$type]['file_type'],UPLOAD_FILE,$file_name))
				{
					$data['taptin'] = $taptin;		
				}
				}
		
			$data['ngaytao'] = time();

			if($d->insert('product',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(isset($config['product'][$type]['seo']) && $config['product'][$type]['seo']==true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}
				/* Schema */
				if(isset($config['product'][$type]['schema']) && $config['product'][$type]['schema'] == true)
				{
					//Kiểm tra nếu tạo Schema tự động
					if($buildSchema) {
						foreach($config['website']['seo'] as $k => $v) {
							//lấy tên danh mục
							$pro_list = $d->rawQueryOne("select id,ten$k as ten from #_product_list where id = ? and type = ? limit 0,1",array($data['id_list'],$type));
							//lấy url thuộc vi,en 
							if($k=='vi' || $k=='en'){
								$url_pro=$config_base.$data['tenkhongdau'.$k];
							}else{
								$url_pro=$config_base.$data['tenkhongdauvi'];
							}
							//Tiến hành build schema product
							$dataSchema['schema'.$k]=$func->buildSchemaProduct($id_insert,$data['ten'.$k],$config_base.UPLOAD_PRODUCT_L.$data['photo'],$dataSeo['description'.$k],$data['masp'],$pro_list['ten'],$setting['ten'.$k],$url_pro,$data['gia']);
						}
					}else{
						$dataSchema = (isset($_POST['dataSchema'])) ? $_POST['dataSchema'] : null;
						if($dataSchema)
						{
							foreach($dataSchema as $column => $value)
							{
								$dataSchema[$column] = htmlspecialchars($value);
							}
						}
					}
					$d->where('idmuc', $id_insert);
					$d->where('com', $com);
					$d->where('act', 'man');
					$d->where('type', $type);
					$d->update('seo',$dataSchema);
				}
				/* Lưu hình ảnh con */
				if(isset($_FILES['files'])) 
				{
					if(isset($_POST['jfiler-items-exclude-files-0'])){
						$arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
						$arr_chuoi = str_replace('[','',$arr_chuoi);
						$arr_chuoi = str_replace(']','',$arr_chuoi);
						$arr_chuoi = str_replace('\\','',$arr_chuoi);
						$arr_chuoi = str_replace('0://','',$arr_chuoi);
						$arr_file_del = explode(',',$arr_chuoi);
					}
					

					$dem = 0;
		            $myFile = $_FILES['files'];
		            $fileCount = count($myFile["name"]);

		            for($i=0;$i<$fileCount;$i++) 
		            {
		            	if($_FILES['files']['name'][$i]!='')
				    	{
							if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
							{
								$file_name = $func->uploadName($myFile["name"][$i]);
								$file_ext = pathinfo($myFile["name"][$i], PATHINFO_EXTENSION);
								if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_PRODUCT."/".$file_name.".".$file_ext))
					            {
									$data1['photo'] = $file_name.".".$file_ext;
									$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
									$data1['tenvi'] = $_POST['ten-filer'][$dem];		
									$data1['id_photo'] = $id_insert;
									$data1['com'] = $com;
									$data1['type'] = $type;
									$data1['kind'] = 'man';
									$data1['val'] = $type;
									$data1['hienthi'] = 1;
									$d->insert('gallery',$data1);
					            }
					            $dem++;
							}
			            }
		            }
		        }

				if($act=='save_copy')
				{
					if($savehere) $func->transfer("Sao chép dữ liệu thành công", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert);
					else $func->transfer("Sao chép dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
				}
				else
				{
					if($savehere) $func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert);
					else $func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
				}
			}
			else
			{
				if($act=='save_copy')
				{
					if($savehere) $func->transfer("Sao chép dữ liệu bị lỗi", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert, false);
					else $func->transfer("Sao chép dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
				}
				else
				{
					if($savehere) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert, false);
					else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
				}
			}
		}
	}

	/* Delete man */
	function delete_item()
	{
		global $d, $strUrl, $func, $curPage, $com, $type,$id_product;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo, taptin,photo2 from #_product where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				$func->delete_file(UPLOAD_PRODUCT.$row['photo2']);
				$func->delete_file(UPLOAD_FILE.$row['taptin']);
				$d->rawQuery("delete from #_product where id = ?",array($id));

				/* Xóa gallery */
				$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));

				if(count($row)>0)
				{
					foreach($row as $v)
					{
						$func->delete_file(UPLOAD_PRODUCT.$v['photo']);
						$func->delete_file(UPLOAD_FILE.$v['taptin']);
					}

					$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));
				}

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo, taptin,photo2 from #_product where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
					$func->delete_file(UPLOAD_PRODUCT.$row['photo2']);
					$func->delete_file(UPLOAD_FILE.$row['taptin']);
					$d->rawQuery("delete from #_product where id = ?",array($id));

					/* Xóa gallery */
					$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));

					if(count($row)>0)
					{
						foreach($row as $v)
						{
							$func->delete_file(UPLOAD_PRODUCT.$v['photo']);
							$func->delete_file(UPLOAD_FILE.$v['taptin']);
						}

						$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));
					}
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
		} 
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
	}

?>