<?php
    $countNotify = 0;
    $contactNotify = $d->rawQuery("SELECT id FROM #_contact WHERE hienthi=0");

    $countNotify += count($contactNotify);
    if(isset($config['newsletter']) && count($config['newsletter'])>0)
    {
        foreach($config['newsletter'] as $k => $v) 
        {
            $emailNotify = $d->rawQuery("SELECT id FROM #_newsletter WHERE hienthi=0 AND type = ?",array($k));
            $countNotify += count($emailNotify);
        }
    }

    if($config['order']['active'])
    {
        $orderNotify = $d->rawQuery("SELECT id FROM #_order WHERE tinhtrang=1");
        $countNotify += count($orderNotify);
    }
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm pl-0">
    <ul class="navbar-nav">
        <li class="nav-item left">
            <a class="nav-link  text-left pl-0" data-widget="pushmenu" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <rect x="30" width="30" height="30" rx="15" transform="rotate(90 30 0)" fill="#F08700"/>
                    <path d="M9.1875 15.2054L20.4375 15.2054" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.725 19.7238L9.18748 15.2058L13.725 10.687" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-sm-inline-block">
            <a href="../" target="_blank" class="nav-link d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="url(#paint0_linear_131:300)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 22V12H15V22" stroke="url(#paint1_linear_131:300)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <defs>
                        <linearGradient id="paint0_linear_131:300" x1="12" y1="2" x2="12" y2="22" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F0831E"/>
                            <stop offset="1" stop-color="#F8AC15"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_131:300" x1="12" y1="12" x2="12" y2="22" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F0831E"/>
                            <stop offset="1" stop-color="#F8AC15"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span>Trở lại website của bạn</span>
            </a>
        </li>
        <li class="nav-item dropdown d-sm-inline-block">
            <a id="dropdownSubMenu-info" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  class="nav-link d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                    <path d="M15.7768 6.43476C15.5454 6.67082 15.4158 6.98819 15.4158 7.31874C15.4158 7.64929 15.5454 7.96666 15.7768 8.20272L17.7973 10.2232C18.0333 10.4546 18.3507 10.5842 18.6813 10.5842C19.0118 10.5842 19.3292 10.4546 19.5652 10.2232L24.3261 5.46238C24.9611 6.86562 25.1534 8.42906 24.8773 9.94434C24.6012 11.4596 23.8699 12.8548 22.7808 13.9439C21.6916 15.033 20.2965 15.7643 18.7812 16.0404C17.2659 16.3165 15.7025 16.1242 14.2992 15.4892L5.5731 24.2154C5.07072 24.7178 4.38934 25 3.67886 25C2.96838 25 2.287 24.7178 1.78462 24.2154C1.28224 23.713 1 23.0316 1 22.3211C1 21.6107 1.28224 20.9293 1.78462 20.4269L10.5108 11.7008C9.87577 10.2975 9.6835 8.73407 9.95959 7.21879C10.2357 5.70351 10.967 4.30835 12.0561 3.21925C13.1452 2.13014 14.5404 1.39881 16.0557 1.12273C17.5709 0.846639 19.1344 1.0389 20.5376 1.6739L15.7894 6.42213L15.7768 6.43476Z" stroke="url(#paint0_linear_131:304)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <defs>
                        <linearGradient id="paint0_linear_131:304" x1="1" y1="25" x2="25" y2="5" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F7A716"/>
                            <stop offset="1" stop-color="#F1881D"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span>Cài đặt</span>
            </a>
            <ul aria-labelledby="dropdownSubMenu-info" class="dropdown-menu dropdown-menu-right border-0 shadow">
                <?php if(isset($config['website']['debug-developer']) && $config['website']['debug-developer']==true) { ?>
                    <li>
                        <a href="index.php?com=lang&act=man" class="dropdown-item">
                            <i class="fas fa-language"></i>
                            <span>Quản lý ngôn ngữ</span>
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                <?php } ?>
                <li>
                    <a href="index.php?com=user&act=admin_edit" class="dropdown-item">
                        <i class="fas fa-user-cog"></i>
                        <span>Thông tin admin</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li>
                    <a href="index.php?com=user&act=admin_edit&changepass=1" class="dropdown-item">
                        <i class="fas fa-key"></i>
                        <span>Đổi mật khẩu</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li>
                    <a href="index.php?com=cache&act=delete" class="dropdown-item">
                        <i class="far fa-trash-alt"></i>
                        <span>Xóa bộ nhớ tạm</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown d-sm-inline-block">
            <a id="dropdownSubMenu-info" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  class="nav-link d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8C6 15 3 17 3 17H21C21 17 18 15 18 8Z" stroke="url(#paint0_linear_131:311)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="url(#paint1_linear_131:311)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <defs>
                <linearGradient id="paint0_linear_131:311" x1="12" y1="2" x2="12" y2="17" gradientUnits="userSpaceOnUse">
                <stop stop-color="#F8AC15"/>
                <stop offset="1" stop-color="#F0841E"/>
                </linearGradient>
                <linearGradient id="paint1_linear_131:311" x1="12" y1="21" x2="12" y2="21.9965" gradientUnits="userSpaceOnUse">
                <stop stop-color="#F8AC15"/>
                <stop offset="1" stop-color="#F0841E"/>
                </linearGradient>
                </defs>
                </svg>
                Thông báo
                <span class="badge badge-danger"><?=$countNotify?></span>
            </a>
             <div class="dropdown-menu dropdown-menu-right shadow">
                <div class="dropdown-divider"></div>
                <a href="index.php?com=contact&act=man" class="dropdown-item"><i class="fas fa-envelope mr-2"></i><span class="badge badge-danger mr-1"><?=count($contactNotify)?></span> Liên hệ</a>
                <?php if(isset($config['order']['active']) && $config['order']['active']==true) { ?>
                    <div class="dropdown-divider"></div>
                    <a href="index.php?com=order&act=man" class="dropdown-item"><i class="fas fa-shopping-bag mr-2"></i><span class="badge badge-danger mr-1"><?=count($orderNotify)?></span> Đơn hàng</a>
                <?php } ?>
                <?php if(isset($config['newsletter']) && count($config['newsletter'])>0) { ?>
                    <div class="dropdown-divider"></div>
                    <?php foreach($config['newsletter'] as $k => $v) { 
                        $emailNotify = $d->rawQuery("SELECT id FROM #_newsletter WHERE hienthi=0 AND type = ?",array($k)); ?>
                        <a href="index.php?com=newsletter&act=man&type=<?=$k?>" class="dropdown-item"><i class="fas fa-mail-bulk mr-2"></i></i><span class="badge badge-danger mr-1 "><?=count($emailNotify)?></span> <?=$v['title_main']?></a>
                        <div class="dropdown-divider"></div>
                    <?php } ?>
                <?php } ?>
            </div>
        </li>
        
        <li class="nav-item d-sm-inline-block">
            <a href="index.php?com=user&act=logout" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="url(#paint0_linear_131:317)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17L21 12L16 7" stroke="url(#paint1_linear_131:317)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 12H9" stroke="url(#paint2_linear_131:317)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <defs>
                        <linearGradient id="paint0_linear_131:317" x1="6" y1="3" x2="6" y2="21" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F1871E"/>
                            <stop offset="1" stop-color="#F0861E"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_131:317" x1="11.5" y1="12" x2="18.5" y2="17" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F1871E"/>
                            <stop offset="1" stop-color="#F0851E"/>
                        </linearGradient>
                        <linearGradient id="paint2_linear_131:317" x1="15" y1="12" x2="15" y2="13" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F1871E"/>
                            <stop offset="1" stop-color="#F0861E"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</nav>