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
		global $d, $func, $strUrl, $curPage, $item, $gallery, $type, $com,$id_product,$get_size;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_product where id = ?",array($id));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		/* Lấy hình ảnh con */
		$gallery = $d->rawQuery("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($id,$com,$type,'man',$type));
		$get_size = $d->rawQuery("select * from #_product_optionsize where id_product = ? order by stt,id desc",array($id));
	}

	/* Save man */
	function save_item()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $act, $type, $config_base, $cart,$id_product;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		$savehere = (isset($_POST['save-here'])) ? true : false;
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(!empty($data['id_product'])){
			$proinfo=$cart->get_product_info($data['id_product']);
			$proinfoColor = $d->rawQueryOne("select tenen,tentl from #_product_mau where id = ?",array($data['id_mau']));
			$data['tenen']=$proinfo['tenen'].' '.$proinfoColor['tenen'];
			$data['tentl']=$proinfo['tenen'].' '.$proinfoColor['tentl'];
		}
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['type'] = $type;
		if(empty($data['id_mau'])) $func->transfer("Chưa chọn màu sắc cho sản phẩm !", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
		
		

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
			if(!empty($_POST['option_size'])){
				$d->rawQuery("delete from #_product_optionsize where id_product = ? and id_mau = ?",array($id,$data['id_mau']));
				foreach ($_POST['option_size'] as $k_size => $v_size) {
					$data_size=array();
					if(empty($v_size) or empty($data['id_mau'])) continue;
					$data_size['id_product']=$id;
					$data_size['id_mau']=$data['id_mau'];
					$data_size['id_size']=$v_size;
					$data_size['soluong']=(!empty($_POST['soluong'][$k_size]))?$_POST['soluong'][$k_size]:0;
					$data_size['stt']=$_POST['stt'][$k_size];
					$d->insert('product_optionsize',$data_size);
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
		
			$data['ngaytao'] = time();

			if($d->insert('product',$data))
			{
				$id_insert = $d->getLastInsertId();
				if(!empty($_POST['option_size'])){
					$d->rawQuery("delete from #_product_optionsize where id_product = ? and id_mau = ?",array($id_insert,$data['id_mau']));
					foreach ($_POST['option_size'] as $k_size => $v_size) {
						$data_size=array();
						if(empty($v_size) or empty($data['id_mau'])) continue;
						$data_size['id_product']=$id_insert;
						$data_size['id_mau']=$data['id_mau'];
						$data_size['id_size']=$v_size;
						$data_size['soluong']=(!empty($_POST['soluong'][$k_size]))?$_POST['soluong'][$k_size]:0;
						$data_size['stt']=$_POST['stt'][$k_size];
						$d->insert('product_optionsize',$data_size);
					}
				}
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