<?php
	function randomCoupon()
	{
		global $func;
		
		$f = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvwxyz", 5)), 0, 3);
		$m = substr(md5(time()),0,3);
		$l = $func->digitalRandom(0,9,3);

		return $f.$m.$l;
	}
	
	function checkCoupon($cp)
	{
		global $d;
		
		$tmp = $d->rawQuery("select id from #_coupon where ma = ?",array($cp));
		
		if($tmp['id']!="") return 1;
		else return 0;
	}


	function get_thanhvien($list_thanhvien="")
	{
		global $d, $type;

		if(!empty($list_thanhvien))
		{
			$temps = explode(',',$list_thanhvien);
		}

		$row_tags = $d->rawQuery("select ten,dienthoai from #_member where hienthi = 1 order by stt,id desc");

		$str = '<select id="id_user" name="id_user[]" class="select multiselect" multiple="multiple" >';
		for($i=0;$i<count($row_tags);$i++)
		{
			if(!empty($temp))
			{	
				if(in_array($row_tags[$i]['id'],$temp)) $selected = 'selected="selected"';
				else $selected = '';
			}
			$str .= '<option value="'.$row_tags[$i]["id"].'" '.$selected.' /> '.$row_tags[$i]["tenen"].'</option>';
		}
		$str .= '</select>';

		return $str;
	}


	$quanitycode = 1;
	$linkMan = "index.php?com=coupon&act=man&p=".$curPage;
    $linkSave = "index.php?com=coupon&act=save&quanitycode=".$quanitycode."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý mã ưu đãi">Quản lý mã ưu đãi</a></li>
                <li class="breadcrumb-item active"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> mã ưu đãi</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung <?=$config['news'][$type]['title_main']?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?=($k==$config['website']['lang-doc'])?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="card-body card-article">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                        <div class="tab-pane fade show <?=($k==$config['website']['lang-doc'])?'active':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
                                            <div class="form-group">
                                                <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=(!empty($item['ten'.$k])) ? $item['ten'.$k]:''?>" <?=($k==$config['website']['lang-doc'])?'required':''?>>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Chi tiết mã ưu đãi</h3>
            </div>
            <div class="card-body">
            	<div class="form-group-category row">
	                <?php if($act=='edit') { ?>
						<div class="form-group col-md-4">
							<label for="ma">Mã ưu đãi: <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="data[ma]" id="ma" placeholder="Mã ưu đãi" value="<?=@$item['ma']?>" readonly required>
						</div>
					<?php } ?>
					<div class="form-group col-md-4">
						<label for="chietkhau">Giá trị: <span class="text-danger">*</span></label>
						<div class="row">
							<div class="col-7">
								<input type="text" class="form-control" name="data[chietkhau]" id="chietkhau" placeholder="Giá trị" value="<?=@$item['chietkhau']?>" required>
							</div>
							<div class="col-5">
								<select class="form-control" name="data[loai]">
									<option <?=(isset($item['loai']) && $item['loai']==1)?"selected":""?> value="1">%</option>
									<option <?=(isset($item['loai']) && $item['loai']==2)?"selected":""?> value="2">VNĐ</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group col-md-4">
                        <label class="d-block" for="gia">Giá trị đơn hàng tối thiêu:</label>
                        <div class="input-group">
                        	<input type="text" class="form-control gia_ban" name="data[gia]" id="gia" placeholder="" value="<?=(!empty($item['gia'])) ? $item['gia']:''?>">
                        	<div class="input-group-append">
                        		<div class="input-group-text"><strong>USD</strong></div>
                        	</div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="d-block" for="thanhvien">Chọn thành viên áp dụng:</label>
                        <?=get_thanhvien($item['id_user'])?>
                    </div>

					<div class="form-group col-md-3">
						<label for="ngaybatdau">Ngày bắt đầu: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[ngaybatdau]" id="ngaybatdau" placeholder="Ngày bắt đầu" value="<?=($item['ngaybatdau'])?date('d/m/Y',$item['ngaybatdau']):"";?>" required readonly>
					</div>
					<div class="form-group col-md-3">
						<label for="ngayketthuc">Ngày kết thúc: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[ngayketthuc]" id="ngayketthuc" placeholder="Ngày kết thúc" value="<?=($item['ngayketthuc'])?date('d/m/Y',$item['ngayketthuc']):"";?>" required readonly>
					</div>
					
				</div>
				<?php if($act=='add') { ?>
					<div class="row">
						<?php for($i=0;$i<$quanitycode;$i++) {
							$ck=1;
							while($ck!=0)
							{
								$ma = randomCoupon();
								$ck = checkCoupon($ma);
							} ?>
					    	<div class="form-group col-sm-12">
		                        <label class="d-block">Mã :</label>
		                        <input type="text" class="form-control" name="ma<?=$i?>" id="ma" placeholder="Mã ưu đãi" value="<?=$ma?>" >
		                    </div>
					    <?php } ?>
					</div>
				<?php } ?>
			    <?php if($act=='edit') { ?>
				    <div class="form-group">
	                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
	                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
	                </div>
	            <?php } ?>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=@$item['id']?>">
        </div>
    </form>
</section>

<!-- Coupon js -->
<script type="text/javascript">
	$(document).ready(function(){
	    $('#ngaybatdau, #ngayketthuc').datetimepicker({
	        timepicker:false,
	        format:'d/m/Y',
	        formatDate:'d/m/Y',
	        minDate:'<?=date("Y/m/d",time())?>',
	        // maxDate:''
	    });
	});
</script>