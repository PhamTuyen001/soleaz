<?php
    $linkMan = "index.php?com=user&act=man&p=".$curPage;
    $linkSave = "index.php?com=user&act=save&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết tài khoản khách</li>
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
                <h3 class="card-title"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> tài khoản</h3>
            </div>
            <div class="card-body">
            	<div class="row">
					<div class="form-group col-12">
                        <label class="change-photo" for="file">
                            <p>Upload hình ảnh: <strong class="mt-2 mb-2 text-sm text-danger"><?php echo "Width: 150px, Height: 150px (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)" ?></strong></p>
                            <div class="rounded">
                                <img class="rounded img-upload" src="<?=UPLOAD_USER.$item['avatar']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                <strong class="justify-content-start flex-row mt-2">
                                    <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                                    <b class="text-sm text-split d-block ml-3"></b>
                                </strong>
                            </div>
                        </label>
                        
                        <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="file" id="file">
                            <label class="custom-file-label" for="file">Chọn file</label>
                        </div>
                    </div>
					<div class="form-group col-md-4">
						<label for="ten">Họ tên: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="email">Email:</label>
						<input type="email" class="form-control" <?=($act=="edit")?'readonly':'';?> name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="dienthoai">Điện thoại:</label>
						<input type="text" class="form-control" <?=($act=="edit")?'readonly':'';?> name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="gioitinh">Giới tính:</label>
						<select class="form-control" name="data[gioitinh]" id="gioitinh">
							<option value="0">Chọn giới tính</option>
							<option <?=(@$item['gioitinh']==1)?"selected":""?> value="1">Nam</option>
							<option <?=(@$item['gioitinh']==2)?"selected":""?> value="2">Nữ</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="ngaysinh">Ngày sinh:</label>
						<input type="text" class="form-control" name="data[ngaysinh]" id="ngaysinh" placeholder="Ngày sinh" value="<?=(@$item['ngaysinh'])?date('d/m/Y',@$item['ngaysinh']):"";?>">
					</div>
				</div>
				<div class="row align-items-center">
					<div class="form-group col-md-6">
						<label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
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
        <div class="card card-primary card-outline text-sm">
        	<div class="card-header">
                <h3 class="card-title">Thông tin mật khẩu</h3>
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="form-group col-md-6">
						<label for="password">Mật khẩu:</label>
						<input type="password" class="form-control" name="data[password]" id="password" placeholder="Mật khẩu" <?=($act=="add")?'required':'';?>>
					</div>
					<div class="form-group col-md-6">
						<label for="confirm_password">Nhập lại mật khẩu:</label>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu" <?=($act=="add")?'required':'';?>>
					</div>
            	</div>
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

<!-- User js -->
<script type="text/javascript">
	$(document).ready(function(){
	    $('#ngaysinh').datetimepicker({
	        timepicker: false,
	        format: 'd/m/Y',
	        formatDate: 'd/m/Y',
	        // minDate: '1950/01/01',
	        maxDate: '<?=date("Y/m/d",time())?>'
	    });
	});
</script>