<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active static */
	$arrCheck = array();
	foreach($config['static'] as $k => $v) $arrCheck[] = $k;
	if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);

	switch($act)
	{
		case "capnhat":
			get_static();
			$template = "static/man/item_add";
			break;
		case "save":
			save_static();
			break;

		default:
			$template = "404";
	}

	/* Get static */
	function get_static()
	{
		global $d, $item, $type,$gallery,$com;

		$item = $d->rawQueryOne("select * from #_static where type = ?",array($type));
		$gallery = $d->rawQuery("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($item['id'],$com,$type,'static',$type));

	}

	/* Save static */
	function save_static()
	{
		global $d, $config, $func, $com, $type;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=static&act=capnhat&type=".$type, false);

		$static = $d->rawQueryOne("select * from #_static where type = ?",array($type));

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		$data['tenkhongdauvi'] = (isset($data['tenvi'])) ? $func->changeTitle($data['tenvi']):'';
		$data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		/* Post Seo */
		if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo']==true)
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if(isset($_FILES['file'])){
			$file_name = $func->uploadName($_FILES['file']["name"]);
			if($photo = $func->uploadImage("file", $config['static'][$type]['img_type'],UPLOAD_NEWS,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_static where type = ?",array($type));
				if(!empty($row['id'])) $func->delete_file(UPLOAD_NEWS.$row['photo']);
			}
		}
		
		if(isset($_FILES['file-taptin'])){
			$file_name = $func->uploadName($_FILES['file-taptin']["name"]);
			if($taptin = $func->uploadImage("file-taptin", $config['static'][$type]['file_type'],UPLOAD_FILE,$file_name))
			{
				$data['taptin'] = $taptin;			
				
				$row = $d->rawQueryOne("select id, taptin from #_static where type = ?",array($type));

				if(!empty($row['id'])) $func->delete_file(UPLOAD_FILE.$row['taptin']);
			}
			}

		if($static['id'])
		{
			$d->where('type',$type);
			if($d->update('static',$data))
			{
				/* SEO */
				if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo']==true)
				{
					$d->rawQuery("delete from #_seo where com = ? and act = ? and type = ?",array($com,'capnhat',$type));

					$dataSeo['idmuc'] = 0;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'capnhat';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
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
								if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_NEWS."/".$file_name.".".$file_ext))
					            {
									$data1['photo'] = $file_name.".".$file_ext;
									$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
									$data1['tenvi'] = $_POST['ten-filer'][$dem];
									$data1['id_photo'] = $static['id'];
									$data1['com'] = $com;
									$data1['type'] = $type;
									$data1['kind'] = 'static';
									$data1['val'] = $type;
									$data1['hienthi'] = 1;
									$d->insert('gallery',$data1);
					            }
					            $dem++;
							}
			            }
		            }
		        }


				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=static&act=capnhat&type=".$type);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=static&act=capnhat&type=".$type, false);
		}
		else
		{
			if($data['tenvi']!='' || $data['tenen']!='' || $data['motavi']!='' || $data['noidungvi']!='' || $data['motaen']!='' || $data['noidungen']!='')
			{
				if($d->insert('static',$data))
				{
					$id_insert = $d->getLastInsertId();
					/* SEO */
					if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo']==true)
					{
						$dataSeo['idmuc'] = 0;
						$dataSeo['com'] = $com;
						$dataSeo['act'] = 'capnhat';
						$dataSeo['type'] = $type;
						$d->insert('seo',$dataSeo);
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
									if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_NEWS."/".$file_name.".".$file_ext))
						            {
										$data1['photo'] = $file_name.".".$file_ext;
										$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
										$data1['tenvi'] = $_POST['ten-filer'][$dem];		
										$data1['id_photo'] = $id_insert;
										$data1['com'] = $com;
										$data1['type'] = $type;
										$data1['kind'] = 'static';
										$data1['val'] = $type;
										$data1['hienthi'] = 1;
										$d->insert('gallery',$data1);
						            }
						            $dem++;
								}
				            }
			            }
			        }

					$func->transfer("Lưu dữ liệu thành công", "index.php?com=static&act=capnhat&type=".$type);
				}
				else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=static&act=capnhat&type=".$type, false);
			}
			$func->transfer("Dữ liệu rỗng", "index.php?com=static&act=capnhat&type=".$type, false);
		}
	}
?>