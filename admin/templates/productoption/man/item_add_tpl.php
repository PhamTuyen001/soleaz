<?php
	$product_type = $config['product'][$type];

	function get_mau($id="")
	{
		global $d, $type;

        $row = $d->rawQuery("select tenen, id from #_product_mau where type = ? order by stt,id desc",array('san-pham'));

        $str = '<select id="id_mau" name="data[id_mau]" class="form-control select2"><option value="0">Danh mục màu</option>';
        foreach($row as $v)
        {
        	$id_mau = isset($_REQUEST['id_mau']) ? $_REQUEST['id_mau']:'';
            if($v["id"] == (int)$id_mau) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

        return $str;
	}


	function get_size($id)
	{
		global $d, $type;

        $row = $d->rawQuery("select tenen, id from #_product_size where type = ? order by stt,id desc",array('san-pham'));

        $str = '<select name="option_size[]" class="form-control select2"><option value="0">Danh mục màu</option>';
        foreach($row as $v)
        {
            if($v["id"] == (int)$id) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

        return $str;
	}


	if($act=="add") $labelAct = "Thêm mới";
	else if($act=="edit") $labelAct = "Chỉnh sửa";
	else if($act=="copy")  $labelAct = "Sao chép";

	$linkMan = "index.php?com=product&act=man&type=".$type."&p=".$curPage;
	if($act=='add') $linkFilter = "index.php?com=product&act=add&type=".$type."&p=".$curPage;
	else if($act=='edit') $linkFilter = "index.php?com=product&act=edit&type=".$type."&p=".$curPage."&id=".$id;
    if($act=="copy") $linkSave = "index.php?com=product&act=save_copy&type=".$type."&p=".$curPage;
    else $linkSave = "index.php?com=product&act=save&type=".$type."&p=".$curPage;

    /* Check cols */
    if(!empty($product_type['gallery'])){
    	foreach($product_type['gallery'] as $key => $value){
	        if($key==$type)
	        {
	            $flagGallery=true;
	            break;
	        }
	    }
    }
    
    if((isset($product_type['dropdown']) && $product_type['dropdown']==true) || (isset($product_type['brand']) && $product_type['brand']==true) || (isset($product_type['mau']) && $product_type['mau']==true) || (isset($product_type['size']) && $product_type['size']==true) || (isset($product_type['tags']) && $product_type['tags']==true) || (isset($product_type['images']) && $product_type['images']==true) || (isset($flagGallery) && $flagGallery=true)){
    	$colLeft = "col-xl-8";
    	$colRight = "col-xl-4";
    }else{
    	$colLeft = "col-12";
    	$colRight = "d-none";	
    }
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?=$labelAct?> <?=$product_type['title_main']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
        	<div class="<?=$colLeft?>">
	        	<div class="card card-primary card-outline text-sm">
		            <div class="card-header">
		                <h3 class="card-title">Thông tin size</h3>
		                <div class="card-tools">
		                	<button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
		                	<a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-size" title="Thêm Size">Thêm Size</a>
		                </div>
		            </div>
		            <div class="card-body">
		                <div id="load_size">
		                	<div class="row">
		                		<div class="form-group col-xl-4 col-sm-4">
				                    <label class="d-block">Chọn size:</label>
				                    <?=get_size(0)?>
				                </div>
				                <div class="form-group col-xl-4 col-sm-4">
			                        <label class="d-block">Số lượng:</label>
			                        <input type="text" class="form-control" name="soluong[]"  placeholder="Số lượng" value="">
			                    </div>
			                    <div class="form-group col-xl-2 col-sm-2">
			                        <label class="d-block">STT:</label>
			                        <input type="text" class="form-control" name="stt[]"  placeholder="Số thứ tự" value="">
			                    </div>
			                    <div class="form-group col-xl-2 col-sm-2">
			                    	<label class="d-block" style="opacity: 0">STT:</label>
			                        <a class="btn bg-gradient-success d-block text-white delete-size">Xóa Size</a>
			                    </div>
		                	</div>
		                </div>
		            </div>
		        </div>
		        <?php if(!empty($flagGallery) && $flagGallery==true) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Bộ sưu tập <?=$product_type['title_main']?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
			                <div class="form-group">
			                    <label for="filer-gallery" class="label-filer-gallery mb-3">Album hình: (<?=$product_type['gallery'][$key]['img_type_photo']?>)</label>
			                    <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
			                    <input type="hidden" class="col-filer" value="col-xl-2 col-sm-4 col-6">
			                    <input type="hidden" class="act-filer" value="man">
			                </div>
			                <?php if(!empty($gallery) && count($gallery) > 0) { ?>
			                    <div class="form-group form-group-gallery">
			                    	<label class="label-filer">Album hiện tại:</label>
			                    	<div class="action-filer mb-3">
					                    <a class="btn btn-sm bg-gradient-primary text-white check-all-filer mr-1"><i class="far fa-square mr-2"></i>Chọn tất cả</a>
					                    <button type="button" class="btn btn-sm bg-gradient-success text-white sort-filer mr-1"><i class="fas fa-random mr-2"></i>Sắp xếp</button>
					                	<a class="btn btn-sm bg-gradient-danger text-white delete-all-filer" data-folder="product"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
					                </div>
					                <div class="alert my-alert alert-sort-filer alert-info text-sm text-white bg-gradient-info"><i class="fas fa-info-circle mr-2"></i>Có thể chọn nhiều hình để di chuyển</div>
			                        <div class="jFiler-items my-jFiler-items jFiler-row">
			                            <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
			                                <?php foreach($gallery as $v) $func->galleryFiler($v['stt'],$v['id'],$v['photo'],$v['tenen'],'product','col-xl-2 col-sm-4 col-6'); ?>
			                            </ul>
			                        </div>
			                    </div>
			                <?php } ?>
			        	</div>
			        </div>
			    <?php } ?>
	        </div>
        	<div class="<?=$colRight?>">
        		<?php if((isset($product_type['dropdown']) && $product_type['dropdown']==true) || (isset($product_type['brand']) && $product_type['brand']==true) || (isset($product_type['tags']) && $product_type['tags']==true) || (isset($product_type['mau']) && $product_type['mau']==true) || (isset($product_type['size']) && $product_type['size']==true)) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Danh mục <?=$product_type['title_main']?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
		            		<div class="form-group-category row">
							    <?php if(!empty($product_type['mau']) && $product_type['mau']) { ?>
							    	<div class="form-group col-xl-12 col-sm-12">
					                    <label class="d-block" for="id_mau">Danh mục màu sắc:</label>
					                    <?=(!empty($item)) ? get_mau($item['id']):get_mau(0)?>
					                </div>
							    <?php } ?>
							</div>
			            </div>
			        </div>
			    <?php } ?>
				<div class="card card-primary card-outline text-sm">
		            <div class="card-header">
		                <h3 class="card-title">Thông tin <?=$product_type['title_main']?></h3>
		                <div class="card-tools">
		                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		            </div>
		            <div class="card-body">
						
		            	<?php if(!empty($product_type['file']) && $product_type['file']) { ?>
		                    <div class="form-group">
		                        <label class="change-file mb-1 mr-2" for="file-taptin">
		                        	<p>Upload tập tin:</p>
		                        	<strong class="ml-2">
		                    			<span class="btn btn-sm bg-gradient-success"><i class="fas fa-file-upload mr-2"></i>Chọn tập tin</span>
		                    			<div><b class="text-sm text-split"></b></div>
		                    		</strong>
		                        </label>
		                        <strong class="d-block mt-2 mb-2 text-sm"><?php echo $product_type['file_type']; ?></strong>
		                        <div class="custom-file my-custom-file d-none">
		                            <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
		                            <label class="custom-file-label" for="file-taptin">Chọn file</label>
		                        </div>
		                        <?php if(!empty($item['taptin'])) { ?>
		                            <a class="btn btn-sm bg-gradient-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?=UPLOAD_FILE.$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
		                        <?php } ?>
		                    </div>
		                <?php } ?>
		                
						<div class="row align-items-center">
							<div class="form-group col-md-6">
			                    <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle">
			                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
			                        <label for="hienthi-checkbox" class="custom-control-label"></label>
			                    </div>
			                </div>
			                <div class="form-group col-md-6">
			                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
			                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
			                </div>
						</div>
		            </div>
		        </div>
				<?php if(!empty($product_type['images']) && $product_type['images']==true) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Hình ảnh 1 <?=$product_type['title_main']?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
	                    	<?php
	                    		$photoDetail = (!empty($item['photo'])) ? UPLOAD_PRODUCT.$item['photo']:'';
	                    		$dimension = "Width: ".$product_type['width']." px - Height: ".$product_type['height']." px (".$product_type['img_type'].")";
	                    		include TEMPLATE.LAYOUT."image.php";
	                    	?>
			            </div>
			        </div>
		        <?php } ?>
	        </div>
	    </div>

        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=@$item['id']?>">
        </div>
    </form>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		$('a.create-size').click(function(event) {
			$.ajax({
				url: 'ajax/ajax_loadsize.php',
				type: 'GET',
				success:function(data){
					$('#load_size').html(data);
				}
			})
		});
	});
</script>
<?php if(!empty($product_type['giakm']) && $product_type['giakm']) { ?>
	<script type="text/javascript">
		function roundNumber(rnum, rlength)
		{
			return Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);
		}
		$(document).ready(function(){

			$(".gia_ban, .gia_moi").keyup(function(){
				var gia_ban = $('.gia_ban').val();
				var gia_moi = $('.gia_moi').val();
				var gia_km = 0;

				if(gia_ban=='' || gia_ban=='0' || gia_moi=='' || gia_moi=='0')
				{
					gia_km=0;
				}
				else
				{
					gia_ban = gia_ban.replace(/,/g,"");
					gia_moi = gia_moi.replace(/,/g,"");
					gia_ban = parseInt(gia_ban);
					gia_moi = parseInt(gia_moi);

					if(gia_moi < gia_ban)
					{
						gia_km = 100-((gia_moi * 100) / gia_ban);
						gia_km = roundNumber(gia_km,0);
					}
					else
					{
						gia_km=0;
					}
				}
				$('.gia_km').val(gia_km);
			})
		})
	</script>
<?php } ?>