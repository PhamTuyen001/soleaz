<?php
	$gallery_config = $config[$com][$type][$dfgallery][$val];
    $linkMan = "index.php?com=".$com."&act=man_photo&idc=".$idc."&kind=".$kind."&val=".$val."&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=".$com."&act=save_photo&idc=".$idc."&kind=".$kind."&val=".$val."&type=".$type."&p=".$curPage;


    function get_main_list($i)
    {
        global $d;

        $row = $d->rawQuery("select tenen, id from #_product_list where type = ? order by stt,id desc",array('san-pham'));

        $str = '<select id="id_list'.$i.'" name="json['.$i.'][id_list]" data-level="0" data-type="san-pham" data-table="#_product_cat" data-child="id_cat'.$i.'" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
        	$id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
            if($v["id"] == (int)$id_list) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	function get_main_cat($i)
	{
		global $d;

        $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
        $row = $d->rawQuery("select tenen, id from #_product_cat where id_list = ? and type = ? order by stt,id desc",array($id_list,'san-pham'));

		$str = '<select id="id_cat'.$i.'" name="json['.$i.'][id_cat]" data-level="1" data-type="san-pham" data-table="#_product" data-child="id_product'.$i.'" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
		foreach($row as $v)
        {
        	$id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
            if($v["id"] == (int)$id_cat) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}

	function get_main_item($i)
	{
		global $d;

        $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
        $id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
        $row = $d->rawQuery("select tenen, id from #_product_item where id_list = ? and id_cat = ? and type = ? order by stt,id desc",array($id_list,$id_cat,'san-pham'));

		$str = '<select id="id_item'.$i.'" name="json['.$i.'][id_item]" data-level="3" data-type="san-pham" data-table="#_product" data-child="id_product'.$i.'" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
		foreach($row as $v)
        {
        	$id_item = isset($_REQUEST['id_item']) ? $_REQUEST['id_item']:'';
            if($v["id"] == (int)$id_item) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}
	function get_main($i)
	{
		global $d;

        $id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
        $id_item = isset($_REQUEST['id_item']) ? $_REQUEST['id_item']:'';
        $row = $d->rawQuery("select tenen, id from #_product where id_item = ? and id_cat = ? and type = ? order by stt,id desc",array($id_item,$id_cat,'san-pham'));

		$str = '<select id="id_product'.$i.'" name="json['.$i.'][id_product]" class="form-control select2 select-category"><option value="0">Chọn sản phẩm</option>';
		foreach($row as $v)
        {
        	$id_product = isset($_REQUEST['id_product']) ? $_REQUEST['id_product']:'';
            if($v["id"] == (int)$id_product) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}
    


?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Thêm mới <?=$gallery_config['title_main_photo']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <?php if(!empty($gallery_config['cart_photo']) && $gallery_config['cart_photo']==true) { ?>
        	<?php
        		$mau = $d->rawQueryOne("SELECT id_mau FROM #_product WHERE id = ?",array($idc));
        		if($mau['id_mau']!='')
        		{
					$idMau = explode(",",$mau['id_mau']);
					$cols = ["tenvi","id","mau","loaihienthi"];
					$d->where('id', $idMau, 'IN');
					$d->where('type', $type);
					$resMau = $d->get("product_mau", null, $cols);
        		}
        	?>
	        <div class="card card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Danh mục màu sắc</h3>
	            </div>
	            <div class="card-body">
					<?php if(count($resMau)) { foreach($resMau as $k => $v) { ?>
	    				<div class="custom-control custom-radio d-inline-block mr-3 text-md">
							<input class="custom-control-input" type="radio" id="id_mau<?=$k?>" name="data[id_mau]" value="<?=$v['id']?>">
							<label for="id_mau<?=$k?>" class="custom-control-label font-weight-normal"><?=$v['tenvi']?></label>
						</div>
	    			<?php } } else { ?>
	    				<div class="alert alert-warning" role="alert">
				            <strong>Không có màu sắc</strong>
				        </div>
	    			<?php } ?>
	            </div>
	        </div>
	    <?php } ?>
		<?php $numberPhoto = $gallery_config['number_photo']; ?>
		<?php for($i=0;$i<$numberPhoto;$i++) { $stt = $i+1; ?>
			<div class="card card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title"><?=$gallery_config['title_main_photo'].": ".$stt?></h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
					<?php if(!empty($gallery_config['images_photo']) && $gallery_config['images_photo']==true) { ?>
	                    <div class="form-group">
						    <label class="change-photo" for="file<?=$i?>">
						        <p>Upload hình ảnh:</p>
						        <div class="rounded">
						            <img class="rounded img-upload" src="" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
						            <strong>
						                <b class="text-sm text-split"></b>
						                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
						            </strong>
						        </div>
						    </label>
						    <strong class="d-block mt-2 mb-2 text-sm"><?php echo "Width: ".$gallery_config['width_photo']." px - Height: ".$gallery_config['height_photo']." px (".$gallery_config['img_type_photo'].")" ?></strong>
						    <div class="custom-file my-custom-file d-none">
						        <input type="file" class="custom-file-input" name="file<?=$i?>" id="file<?=$i?>">
						        <label class="custom-file-label" for="file<?=$i?>">Chọn file</label>
						    </div>
						</div>
	                <?php } ?>
	                <?php if(!empty($gallery_config['file_photo']) && $gallery_config['file_photo']==true) { ?>
	                    <div class="form-group">
	                        <label class="change-file mb-1 mr-2" for="file-taptin<?=$i?>">
	                        	<p>Upload tập tin:</p>
	                        	<strong class="ml-2">
	                    			<span class="btn btn-sm bg-gradient-success"><i class="fas fa-file-upload mr-2"></i>Chọn tập tin</span>
	                    			<div><b class="text-sm text-split"></b></div>
	                    		</strong>
	                        </label>
	                        <strong class="d-block mt-2 mb-2 text-sm"><?php echo $gallery_config['file_type_photo']; ?></strong>
	                        <div class="custom-file my-custom-file d-none">
	                            <input type="file" class="custom-file-input" name="file-taptin<?=$i?>" id="file-taptin<?=$i?>">
	                            <label class="custom-file-label" for="file-taptin<?=$i?>">Chọn file</label>
	                        </div>
	                    </div>
	                <?php } ?>
	                <?php if(!empty($gallery_config['mausac_photo']) && $gallery_config['mausac_photo']==true) { ?>
		                <div class="form-group align-items-center row">
	                        <label for="mau<?=$i?>" class="d-inline-block align-middle col-md-2 mb-2">Màu sắc:</label>
	                        <div class="col-md-8 mb-2">
	                            <input type="text" class="form-control w-auto jscolor" name="dataMulti[<?=$i?>][mau]" id="mau<?=$i?>" maxlength="7" value="#000000">
	                        </div>
	                    </div>
	                <?php } ?>
	                <?php if(!empty($gallery_config['link_photo']) && $gallery_config['link_photo']==true) { ?>
		                <div class="form-group">
		                    <label for="link<?=$i?>">Link:</label>
		                    <input type="text" class="form-control" name="dataMulti[<?=$i?>][link]" id="link<?=$i?>" placeholder="Link">
		                </div>
		            <?php } ?>
		            <?php if(!empty($gallery_config['video_photo']) && $gallery_config['video_photo']==true) { ?>
		                <div class="form-group">
		                    <label for="link_video<?=$i?>">Video:</label>
		                    <input type="text" class="form-control" name="dataMulti[<?=$i?>][link_video]" id="link_video<?=$i?>" onchange="youtubePreview(this.value,'#loadVideo<?=$i?>');" placeholder="Video">
		                </div>
		                <div class="form-group">
		                    <label for="link_video">Video preview:</label>
		                    <div><iframe id="loadVideo<?=$i?>" width="0px" height="0px" frameborder="0" allowfullscreen></iframe></div>
		                </div>
		            <?php } ?>
		            <?php if(!empty($gallery_config['product_photo']) && $gallery_config['product_photo']==true) { ?>
		                <div class="form-group">
		                    <label for="id_list<?=$i?>">Danh mục cấp 1:</label>
		                    <?=get_main_list($i)?>
		                </div>
		                <div class="form-group">
		                    <label for="id_list<?=$i?>">Danh mục cấp 2:</label>
		                    <?=get_main_cat($i)?>
		                </div>
		               
		                <div class="form-group">
		                    <label for="id_list<?=$i?>">Danh mục sản phẩm:</label>
		                    <?=get_main($i)?>
		                </div>
		            <?php } ?>


		            <div class="form-group">
	                    <label for="hienthi<?=$i?>" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
	                    <div class="custom-control custom-checkbox d-inline-block align-middle">
	                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="dataMulti[<?=$i?>][hienthi]" id="hienthi-checkbox<?=$i?>" checked>
	                        <label for="hienthi-checkbox<?=$i?>" class="custom-control-label"></label>
	                    </div>
	                </div>
	                <div class="form-group">
						<label for="stt<?=$i?>" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
						<input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="dataMulti[<?=$i?>][stt]" id="stt<?=$i?>" placeholder="Số thứ tự" value="1">
					</div>
		            <?php if((!empty($gallery_config['tieude_photo']) && $gallery_config['tieude_photo']==true) || (!empty($gallery_config['mota_photo']) && $gallery_config['mota_photo']==true) || (!empty($gallery_config['noidung_photo']) && $gallery_config['noidung_photo']==true)) { ?>
		                <div class="card card-primary card-outline card-outline-tabs">
		                    <div class="card-header p-0 border-bottom-0">
		                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <li class="nav-item">
		                                    <a class="nav-link <?=($k==$config['website']['lang-doc'])?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>-<?=$i?>" role="tab" aria-controls="tabs-lang-<?=$k?>-<?=$i?>" aria-selected="true"><?=$v?></a>
		                                </li>
		                            <?php } ?>
		                        </ul>
		                    </div>
		                    <div class="card-body">
		                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <div class="tab-pane fade show <?=($k==$config['website']['lang-doc'])?'active':''?>" id="tabs-lang-<?=$k?>-<?=$i?>" role="tabpanel" aria-labelledby="tabs-lang">
		                                    <?php if(!empty($gallery_config['tieude_photo']) && $gallery_config['tieude_photo']==true) { ?>
		                                        <div class="form-group">
		                                            <label for="ten<?=$k?><?=$i?>">Tiêu đề (<?=$k?>):</label>
		                                            <input type="text" class="form-control" name="dataMulti[<?=$i?>][ten<?=$k?>]" id="ten<?=$k?><?=$i?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=(!empty($item['ten'.$k])) ? $item['ten'.$k]:''?>">
		                                        </div>
		                                    <?php } ?>
		                                    <?php if(!empty($gallery_config['mota_photo']) && $gallery_config['mota_photo']==true) { ?>
		                                        <div class="form-group">
		                                            <label for="mota<?=$k?><?=$i?>">Mô tả (<?=$k?>):</label>
		                                            <textarea class="form-control <?=($gallery_config['mota_cke_photo'])?'form-control-ckeditor':''?>" name="dataMulti[<?=$i?>][mota<?=$k?>]" id="mota<?=$k?><?=$i?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=(!empty($item['mota'.$k])) ? htmlspecialchars_decode($item['mota'.$k]):''?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                    <?php if(!empty($gallery_config['noidung_photo']) && $gallery_config['noidung_photo']==true) { ?>
		                                        <div class="form-group">
		                                            <label for="noidung<?=$k?><?=$i?>">Nội dung (<?=$k?>):</label>
		                                            <textarea class="form-control <?=($gallery_config['noidung_cke_photo'])?'form-control-ckeditor':''?>" name="dataMulti[<?=$i?>][noidung<?=$k?>]" id="noidung<?=$k?><?=$i?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=(!empty($item['noidung'.$k])) ? htmlspecialchars_decode($item['noidung'.$k]):''?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                </div>
		                            <?php } ?>
		                        </div>
		                    </div>
		                </div>
		            <?php } ?>
	            </div>
	        </div>
		<?php } ?>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
    </form>
</section>