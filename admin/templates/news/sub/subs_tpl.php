<?php
	function get_main_list()
    {
        global $d, $type;

        $row = $d->rawQuery("select tenen, id from #_news_list where type = ? order by stt,id desc",array($type));

        $str = '<select id="id_list" name="id_list" onchange="onchangeList()" class="form-control select2"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
            $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
            if($v["id"] == (int)$id_list) $selected = "selected";
            else $selected = "";
            
            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

    function get_main_cat()
    {
        global $d, $type;

        $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
        $row = $d->rawQuery("select tenen, id from #_news_cat where id_list = ? and type = ? order by stt,id desc",array($id_list,$type));

        $str = '<select id="id_cat" name="id_cat" onchange="onchangeCat()" class="form-control select2"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
            $id_cat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
            if($v["id"] == (int)$id_cat) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	function get_main_item()
	{
		global $d, $type;

        $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
        $id_cat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
        $row = $d->rawQuery("select tenen, id from #_news_item where id_list = ? and id_cat = ? and type = ? order by stt,id desc",array($id_list,$id_cat,$type));

        $str = '<select id="id_item" name="id_item" onchange="onchangeItem()" class="form-control select2"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
            $id_item = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']):'';
            if($v["id"] == (int)$id_cat) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenen"].'</option>';
        }
        $str .= '</select>';

        return $str;
	}

	$linkMan = $linkFilter = "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage;
	$linkAdd = "index.php?com=news&act=add_sub&type=".$type."&p=".$curPage;
    $linkEdit = "index.php?com=news&act=edit_sub&type=".$type."&p=".$curPage;
    $linkDelete = "index.php?com=news&act=delete_sub&type=".$type."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý <?=$config['news'][$type]['title_main_sub']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
    	<a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?><?=$strUrl?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <div class="form-inline form-search d-inline-block align-middle ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?=(isset($_GET['keyword'])) ? $_GET['keyword']:''?>" onkeypress="doEnter(event,'keyword','<?=$linkMan?>')">
                <div class="input-group-append bg-primary rounded-right">
                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','<?=$linkMan?>')">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer form-group-category text-sm bg-light row">
        <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=get_main_list();?></div>
        <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=get_main_cat();?></div>
        <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=get_main_item();?></div>
    </div>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách <?=$config['news'][$type]['title_main_sub']?></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle text-center" width="10%">STT</th>
						<?php if(isset($config['news'][$type]['show_images_sub']) && $config['news'][$type]['show_images_sub']==true) { ?>
							<th class="align-middle">Hình</th>
						<?php } ?>
						<th class="align-middle" style="width:30%">Tiêu đề</th>
						<?php if(isset($config['news'][$type]['check_sub'])){ foreach($config['news'][$type]['check_sub'] as $key => $value) { ?>
							<th class="align-middle text-center"><?=$value?></th>
						<?php } } ?>
						<th class="align-middle text-center">Hiển thị</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                </thead>
                <?php if(empty($items)) { ?>
                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                <?php } else { ?>
                    <tbody>
                        <?php for($i=0;$i<count($items);$i++) {
                            $linkID = "";
                            if($items[$i]['id_list']) $linkID .= "&id_list=".$items[$i]['id_list'];
                            if($items[$i]['id_cat']) $linkID .= "&id_cat=".$items[$i]['id_cat'];
                            if($items[$i]['id_item']) $linkID .= "&id_item=".$items[$i]['id_item']; ?>
                            <tr>
                                <td class="align-middle">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="news_sub">
                                </td>
                                <?php if(isset($config['news'][$type]['show_images_sub']) && $config['news'][$type]['show_images_sub']==true) { ?>
                                    <td class="align-middle">
                                    	<a href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['ten'.$config['website']['lang-doc']]?>"><img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/<?=$config['news'][$type]['thumb_sub']?>/<?=UPLOAD_NEWS_L.$items[$i]['photo']?>" alt="<?=$items[$i]['ten'.$config['website']['lang-doc']]?>"></a>
                                    </td>
                                <?php } ?>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['ten'.$config['website']['lang-doc']]?>"><?=$items[$i]['ten'.$config['website']['lang-doc']]?></a>
                                </td>
                                <?php if(isset($config['news'][$type]['check_sub'])){ foreach($config['news'][$type]['check_sub'] as $key => $value) { ?>
								  	<td class="align-middle text-center">
	                                	<div class="custom-control custom-checkbox my-checkbox">
	                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" data-table="news_sub" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" <?=($items[$i][$key]==true)?'checked':''?>>
	                                        <label for="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" class="custom-control-label"></label>
	                                    </div>
	                                </td>
								<?php } } ?>
								<td class="align-middle text-center">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="news_sub" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                        <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">
                                    <a class="text-primary mr-2" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                    <a class="text-danger" id="delete-item" data-url="<?=$linkDelete?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php if(!empty($paging)) { ?>
        <div class="card-footer text-sm pb-0">
            <?=$paging?>
        </div>
    <?php } ?>
    <div class="card-footer text-sm">
    	<a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?><?=$strUrl?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
    </div>
</section>