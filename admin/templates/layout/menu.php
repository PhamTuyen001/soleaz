<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Logo -->
    <a class="brand-link" href="index.php">
        <img class="brand-image" src="assets/images/logo-2.svg" alt="">
        <span>Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <div class="group-menu">
                    <p>Tổng quan</p>
                    <?php
                        $active = "";
                        if($com=='index' || $com=='') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?>">
                        <a class="nav-link <?=$active?>" href="index.php" title="Bảng điều khiển">
                            <img src="assets/images/Category.png" alt="" class="nav-icon text-sm">
                            <p>Bảng điều khiển</p>
                        </a>
                    </li>
                    <?php
                        $none = "";
                        $active = "";
                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('setting', 'capnhat', '', null, 'phrase-1')) $none = "d-none";
                        if($com=='setting') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=setting&act=capnhat" title="Thiết lập thông tin">
                            <img src="assets/images/ShieldDone.png" alt="" class="nav-icon text-sm">
                            <p>Thiết lập thông tin</p>
                        </a>
                    </li>
                </div>
                <div class="group-menu">
                    <p>Quản lý sản phẩm</p>
                     <?php if(isset($config['product'])) { ?>
                    <?php foreach($config['product'] as $k => $v) { if(!isset($disabled['product'][$k])) { ?>
                        <?php
                            $none = "";
                            $active = "";
                            $menuopen = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_list', $k, null, 'phrase-1') && $func->check_access('product', 'man_cat', $k, null, 'phrase-1') && $func->check_access('product', 'man_item', $k, null, 'phrase-1') && $func->check_access('product', 'man_sub', $k, null, 'phrase-1') && $func->check_access('product', 'man_brand', $k, null, 'phrase-1') && $func->check_access('product', 'man', $k, null, 'phrase-1') && $func->check_access('import', 'man', $k, null, 'phrase-1') && $func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                            if((($com=='product') || ($com=='import') || ($com=='export')) && ($k==$_GET['type']))
                            {
                                $active = 'active';
                                $menuopen = 'menu-open';
                            }
                        ?>
                        <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                            <a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$v['title_main']?>">
                                <img src="assets/images/Category.png" alt="" class="nav-icon text-sm">
                                <p>
                                    Quản lý <?=$v['title_main']?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if(isset($v['list']) && $v['list'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_list' || $act=='add_list' || $act=='edit_list' || $kind=='man_list') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=product&act=man_list&type=<?=$k?>" title="Danh mục cấp 1"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0">Danh mục cấp 1</p></a></li>
                                <?php } ?>
                                <?php if(isset($v['cat']) && $v['cat'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_cat' || $act=='add_cat' || $act=='edit_cat' || $kind=='man_cat') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=product&act=man_cat&type=<?=$k?>" title="Danh mục cấp 2"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0">Danh mục cấp 2</p></a></li>
                                <?php } ?>
                                <?php if(isset($v['item']) && $v['item'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_item' || $act=='add_item' || $act=='edit_item' || $kind=='man_item') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=product&act=man_item&type=<?=$k?>" title="Nhóm sản phẩm"><i class="nav-icon text-sm fas fa-circle"></i><p>Danh mục cấp 3</p></a></li>
                                <?php } ?>
                                <?php if(isset($v['mau']) && $v['mau'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_mau', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_mau' || $act=='add_mau' || $act=='edit_mau') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=product&act=man_mau&type=<?=$k?>" title="Danh mục màu sắc"><i class="nav-icon text-sm fas fa-circle"></i><p>Danh mục màu sắc</p></a></li>
                                <?php } ?>
                                <?php if(isset($v['size']) && $v['size'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_size', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_size' || $act=='add_size' || $act=='edit_size') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=product&act=man_size&type=<?=$k?>" title="Danh mục kích thước"><i class="nav-icon text-sm fas fa-circle"></i><p>Danh mục kích thước</p></a></li>
                                <?php } ?>
                                 
                                <?php
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                ?>
                                <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=product&act=man&type=<?=$k?>" title="<?=$v['title_main']?>"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0"><?=$v['title_main']?></p></a></li>
                            </ul>
                        </li>
                    <?php } } ?>
                <?php } ?>
                
                <?php if(isset($config['order']['active']) && $config['order']['active'] == true) { ?>
                    <?php
                        $none = "";
                        $active = "";
                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('order', 'man', '', null, 'phrase-1')) $none = "d-none";
                        if($com=='order') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=order&act=man" title="Quản lý đơn hàng">
                            <img src="assets/images/Wallet.png" alt="" class="nav-icon text-sm">
                            <p>Quản lý đơn hàng</p>
                        </a>
                    </li>
                <?php } ?>
      
                <?php if(isset($config['coupon']) && $config['coupon'] == true) { ?>
                    <?php
                        $none = "";
                        $active = "";
                        if(!empty($kiemtra)) if($func->check_access('coupon', 'man', '', null, 'phrase-1')) $none = "d-none";
                        if($com=='coupon') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                       <a class="nav-link <?=$active?>" href="index.php?com=coupon&act=man" title="Quản lý mã ưu đãi">
                            <img src="assets/images/Wallet.png" alt="" class="nav-icon text-sm">
                            <p>Quản lý mã ưu đãi</p>
                        </a>
                    </li>
                <?php } ?>
                </div>

                <div class="group-menu">
                    <p>Quản lý thư viện</p>
                     <?php if(isset($config['photo'])) { ?>
                    <?php
                        $none = "";
                        $active = "";
                        $menuopen = "";
                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'photo_static', '', $config['photo']['photo_static'], 'phrase-2') && $func->check_access('photo', 'man_photo', '', $config['photo']['man_photo'], 'phrase-2')) $none = "d-none";
                        if($com=='photo' && !isset($disabled['photo'][$_GET['type']]) && !isset($disabled['photo_static'][$_GET['type']]))
                        {
                            $active = 'active';
                            $menuopen = 'menu-open';
                        }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý thư viện ảnh">
                            <img src="assets/images/Game.png" alt="" class="nav-icon text-sm">
                            <p>
                                Quản lý thư viện ảnh
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($config['photo']['photo_static'])) { ?>
                                <?php foreach($config['photo']['photo_static'] as $k => $v) { if(!isset($disabled['photo_static'][$k])) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'photo_static', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='photo' && $_GET['type']==$k && $act=='photo_static') $active = "active"; ?>
                                    <li class="nav-item <?=$none?>">
                                        <a class="nav-link <?=$active?>" href="index.php?com=photo&act=photo_static&type=<?=$k?>" title="<?=$v['title_main']?>"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0"><?=$v['title_main']?></p></a>
                                    </li>
                                <?php } } ?>
                            <?php } ?>
                            <?php if(isset($config['photo']['man_photo'])) { ?>
                                <?php foreach($config['photo']['man_photo'] as $k => $v) { if(!isset($disabled['photo'][$k])) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'man_photo', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='photo' && $_GET['type']==$k && ($act=='man_photo' || $act=='add_photo' || $act=='edit_photo')) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>">
                                        <a class="nav-link <?=$active?>" href="index.php?com=photo&act=man_photo&type=<?=$k?>" title="<?=$v['title_main_photo']?>"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0"><?=$v['title_main_photo']?></p></a>
                                    </li>
                                <?php } } ?>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                </div>
                <div class="group-menu">
                    <p>Quản lý bài viết</p>
                     <?php if(isset($config['news'])) { ?>
                    <?php foreach($config['news'] as $k => $v) { if(!isset($disabled['news'][$k])) { if(isset($v['dropdown']) && $v['dropdown'] == true) { ?>
                        <?php
                            $none = "";
                            $active = "";
                            $menuopen = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                            if(($com=='news') && ($k==$_GET['type']))
                            {
                                $active = 'active';
                                $menuopen = 'menu-open';
                            }
                        ?>
                        <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                            <a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$v['title_main']?>">
                                <img src="assets/images/Document.png" alt="" class="nav-icon text-sm">
                                <p>
                                    Quản lý <?=$v['title_main']?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if(isset($v['list']) && $v['list'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_list' || $act=='add_list' || $act=='edit_list' || $kind=='man_list' || $kind=='man_list') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=news&act=man_list&type=<?=$k?>" title="Danh mục cấp 1"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0">Danh mục cấp 1</p></a></li>
                                <?php } ?>
                                <?php if(isset($v['cat']) && $v['cat'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_cat' || $act=='add_cat' || $act=='edit_cat' || $kind=='man_cat' || $kind=='man_cat') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=news&act=man_cat&type=<?=$k?>" title="Danh mục cấp 2"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0">Danh mục cấp 2</p></a></li>
                                <?php } ?>
                                <?php if(isset($v['item']) && $v['item'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_item' || $act=='add_item' || $act=='edit_item' || $kind=='man_item' || $kind=='man_item') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=news&act=man_item&type=<?=$k?>" title="Danh mục cấp 3"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0">Danh mục cấp 3</p></a></li>
                                <?php } ?>
                                <?php if(isset($v['sub']) && $v['sub'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_sub' || $act=='add_sub' || $act=='edit_sub' || $kind=='man_sub' || $kind=='man_sub') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=news&act=man_sub&type=<?=$k?>" title="Danh mục cấp 4"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0">Danh mục cấp 4</p></a></li>
                                <?php } ?>
                                <?php
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                ?>
                                <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>" href="index.php?com=news&act=man&type=<?=$k?>" title="<?=$v['title_main']?>"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0"><?=$v['title_main']?></p></a></li>
                            </ul>
                        </li>
                    <?php } } } ?>
                <?php } ?>
                <?php if(isset($config['shownews']) && $config['shownews'] == true) { ?>
                    <?php
                        $none = "";
                        $active = "";
                        $menuopen = "";
                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man', '', $config['news'], 'phrase-2', false)) $none = "d-none";
                        if(($com=='news') && !isset($disabled['news'][$_GET['type']]) && (!isset($config['news'][$_GET['type']]['dropdown']) || (isset($config['news'][$_GET['type']]['dropdown']) && $config['news'][$_GET['type']]['dropdown'] == false)))
                        {
                            $active = 'active';
                            $menuopen = 'menu-open';
                        }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý bài viết">
                            <img src="assets/images/Document.png" alt="" class="nav-icon text-sm">
                            <p>
                                Quản lý bài viết
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($config['news'] as $k => $v) { if(!isset($disabled['news'][$k]) && (!isset($v['dropdown']) || (isset($v['dropdown']) && $v['dropdown'] == false))) { ?>
                                <?php
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                ?>
                                <li class="nav-item <?=$none?>">
                                    <a class="nav-link <?=$active?>" href="index.php?com=news&act=man&type=<?=$k?>" title="<?=$v['title_main']?>"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0"><?=$v['title_main']?></p></a>
                                </li>
                            <?php } } ?>
                        </ul>
                    </li>
                <?php } ?>
                 <?php if(isset($config['static'])) { ?>
                    <?php
                        $none = "";
                        $active = "";
                        $menuopen = "";
                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('static', 'capnhat', '', $config['static'], 'phrase-2')) $none = "d-none";
                        if($com=='static' && !isset($disabled['static'][$_GET['type']]))
                        {
                            $active = 'active';
                            $menuopen = 'menu-open';
                        }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý trang tĩnh">
                            <img src="assets/images/Document.png" alt="" class="nav-icon text-sm">
                            <p>
                                Quản lý trang tĩnh
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($config['static'] as $k => $v) { if(!isset($disabled['static'][$k])) { ?>
                                <?php
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('static', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='static' && $k==$_GET['type']) $active = "active";
                                ?>
                                <li class="nav-item <?=$none?>">
                                    <a class="nav-link <?=$active?>" href="index.php?com=static&act=capnhat&type=<?=$k?>" title="<?=$v['title_main']?>"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0"><?=$v['title_main']?></p></a>
                                </li>
                            <?php } } ?>
                        </ul>
                    </li>
                <?php } ?>
                </div>
                

                <div class="group-menu">
                    <p>Quản lý SEO PAGE</p>
                    <?php if(isset($config['seopage']) && count($config['seopage']['page']) > 0) { ?>
                        <?php
                            $none = "";
                            $active = "";
                            $menuopen = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('seopage', 'capnhat', '', $config['seopage']['page'], 'phrase-2')) $none = "d-none";
                            if($com=='seopage')
                            {
                                $active = 'active';
                                $menuopen = 'menu-open';
                            }
                        ?>
                        <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                            <a class="nav-link <?=$active?>" href="#" title="Quản lý SEO page">
                                <img src="assets/images/Setting.png" alt="" class="nav-icon text-sm">
                                <p>
                                    Quản lý SEO PAGE
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php foreach($config['seopage']['page'] as $k => $v) { ?>
                                    <?php
                                        $none = "";
                                        $active = "";
                                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('seopage', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                        if($com=='seopage' && $k==$_GET['type']) $active = "active";
                                    ?>
                                    <li class="nav-item <?=$none?>">
                                        <a class="nav-link <?=$active?>" href="index.php?com=seopage&act=capnhat&type=<?=$k?>" title="<?=$v?>"><i class="nav-icon text-sm fas fa-circle"></i><p class="ml-0"><?=$v?></p></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </div>
            </ul>
        </nav>
    </div>
</aside>

<script type="text/javascript">
    $(document).ready(function(){
        if($(".menu-group").length)
        {
            var navlink = $(".menu-group").find(".nav-link.active").first();
            if(navlink.length)
            {
                var menugroup = navlink.parents(".menu-group");
                menugroup.addClass("menu-open");
                menugroup.find(">.nav-link").addClass("active");
            }
        }
    })
</script>