<?php 
include "ajax_config.php";

function get_sizess()
{
	global $d;
    $row = $d->rawQuery("select tenen, id from #_product_size where type = ? order by stt,id desc",array('san-pham'));
    $str = '<select name="option_size[]" class="form-control select2"><option value="0">Danh mục size</option>';
    foreach($row as $v)
    {
        $str .= '<option value='.$v["id"].'>'.$v["tenen"].'</option>';
    }
    $str .= '</select>';

    return $str;
}
?>
<div class="row row-size">
	<div class="form-group col-xl-4 col-sm-4">
        <label class="d-block">Chọn size:</label>
        <?=get_sizess()?>
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