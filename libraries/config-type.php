<?php


    $nametype = "san-pham";
    $config['product'][$nametype]['title_main'] = "Sản Phẩm";
    $config['product'][$nametype]['dropdown'] = true;
    $config['product'][$nametype]['list'] = true;
    $config['product'][$nametype]['cat'] = true;
    $config['product'][$nametype]['item'] = true;
    $config['product'][$nametype]['sub'] = false;
    $config['product'][$nametype]['brand'] = false;
    $config['product'][$nametype]['schema'] = false;
    $config['product'][$nametype]['mau'] = true;
    $config['product'][$nametype]['size'] = true;
    $config['product'][$nametype]['tags'] = false;
    $config['product'][$nametype]['import'] = false;
    $config['product'][$nametype]['export'] = false;
    $config['product'][$nametype]['view'] = true;
    $config['product'][$nametype]['copy'] = true;
    $config['product'][$nametype]['copy_image'] = false;
    $config['product'][$nametype]['slug'] = true;
    $config['product'][$nametype]['check'] = array("moi" => "Mới", "noibat" => "Nổi bật","khuyenmai" => "Khuyến mãi");
    $config['product'][$nametype]['images'] = true;
    $config['product'][$nametype]['images2'] = true;
    $config['product'][$nametype]['show_images'] = true;
    $config['product'][$nametype]['show_gallery'] = false;
    $config['product'][$nametype]['gallery'] = array(
        $nametype => array
        (
            "title_main_photo" => "Hình ảnh sản phẩm",
            "title_sub_photo" => "Hình ảnh",
            "number_photo" => 3,
            "images_photo" => true,
            "cart_photo" => false,
            "avatar_photo" => true,
            "tieude_photo" => true,
            "width_photo" => 150*4,
            "height_photo" => 150*4,
            "thumb_photo" => '600x600x1',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
        )
    );
    $config['product'][$nametype]['link'] = false;
    $config['product'][$nametype]['file'] = false;
    $config['product'][$nametype]['ma'] = true;
    $config['product'][$nametype]['tinhtrang'] = false;
    $config['product'][$nametype]['video'] = false;
    $config['product'][$nametype]['gia'] = true;
    $config['product'][$nametype]['giamoi'] = true;
    $config['product'][$nametype]['giakm'] = true;
    $config['product'][$nametype]['mota'] = false;
    $config['product'][$nametype]['mota_cke'] = false;
    $config['product'][$nametype]['noidung'] = true;
    $config['product'][$nametype]['noidung_cke'] = true;
    $config['product'][$nametype]['seo'] = true;
    $config['product'][$nametype]['width'] = 300*2;
    $config['product'][$nametype]['height'] = 300*2;
    $config['product'][$nametype]['thumb'] = '600x600x1';
    $config['product'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['product'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

    /* Sản phẩm (Size) */
    $config['product'][$nametype]['size_gia'] = false;

    /* Sản phẩm (Màu) */
    $config['product'][$nametype]['mau_images'] = false;
    $config['product'][$nametype]['mau_gia'] = false;
    $config['product'][$nametype]['mau_mau'] = true;
    $config['product'][$nametype]['mau_loai'] = true;
    $config['product'][$nametype]['width_mau'] = 30;
    $config['product'][$nametype]['height_mau'] = 30;
    $config['product'][$nametype]['thumb_mau'] = '100x100x1';
    $config['product'][$nametype]['img_type_mau'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Sản phẩm (List) */
    $config['product'][$nametype]['title_main_list'] = "Sản phẩm cấp 1";
    $config['product'][$nametype]['images_list'] = true;
    $config['product'][$nametype]['show_images_list'] = true;
    $config['product'][$nametype]['slug_list'] = true;
    $config['product'][$nametype]['check_list'] = array();
    $config['product'][$nametype]['gallery_list'] = array();
    $config['product'][$nametype]['mota_list'] = false;
    $config['product'][$nametype]['seo_list'] = true;
    $config['product'][$nametype]['width_list'] = 65;
    $config['product'][$nametype]['height_list'] = 65;
    $config['product'][$nametype]['thumb_list'] = '65x65x2';
    $config['product'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG';

    /* Sản phẩm (Cat) */
    $config['product'][$nametype]['title_main_cat'] = "Sản phẩm cấp 2";
    $config['product'][$nametype]['images_cat'] = false;
    $config['product'][$nametype]['show_images_cat'] = false;
    $config['product'][$nametype]['slug_cat'] = true;
    $config['product'][$nametype]['check_cat'] = array();
    $config['product'][$nametype]['mota_cat'] = false;
    $config['product'][$nametype]['seo_cat'] = true;
    $config['product'][$nametype]['width_cat'] = 75*4;
    $config['product'][$nametype]['height_cat'] = 50*4;
    $config['product'][$nametype]['thumb_cat'] = '100x100x1';
    $config['product'][$nametype]['img_type_cat'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Sản phẩm (Item) */
    $config['product'][$nametype]['title_main_item'] = "Sản phẩm cấp 3";
    $config['product'][$nametype]['images_item'] = false;
    $config['product'][$nametype]['show_images_item'] = false;
    $config['product'][$nametype]['slug_item'] = true;
    $config['product'][$nametype]['check_item'] = array();
    $config['product'][$nametype]['mota_item'] = false;
    $config['product'][$nametype]['seo_item'] = true;
    $config['product'][$nametype]['width_item'] = 75*4;
    $config['product'][$nametype]['height_item'] = 50*4;
    $config['product'][$nametype]['thumb_item'] = '100x100x1';
    $config['product'][$nametype]['img_type_item'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    


    $nametype = "outfit";
    $config['product'][$nametype]['title_main'] = "Bộ sưu tập";
    $config['product'][$nametype]['dropdown'] = true;
    $config['product'][$nametype]['list'] = true;
    $config['product'][$nametype]['cat'] = true;
    $config['product'][$nametype]['item'] = false;
    $config['product'][$nametype]['sub'] = false;
    $config['product'][$nametype]['brand'] = false;
    $config['product'][$nametype]['schema'] = false;
    $config['product'][$nametype]['mau'] = false;
    $config['product'][$nametype]['size'] = false;
    $config['product'][$nametype]['tags'] = false;
    $config['product'][$nametype]['import'] = false;
    $config['product'][$nametype]['export'] = false;
    $config['product'][$nametype]['view'] = false;
    $config['product'][$nametype]['copy'] = true;
    $config['product'][$nametype]['id_product'] = true;
    $config['product'][$nametype]['copy_image'] = false;
    $config['product'][$nametype]['slug'] = true;
    $config['product'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['product'][$nametype]['images'] = true;
    $config['product'][$nametype]['images2'] = true;
    $config['product'][$nametype]['show_images'] = true;
    $config['product'][$nametype]['show_gallery'] = true;
    $config['product'][$nametype]['gallery'] = array(
        $nametype => array
        (
            "title_main_photo" => "Thêm Sản Phẩm",
            "title_sub_photo" => "Sản Phẩm",
            "number_photo" => 5,
            "product_photo" => true,
            "images_photo" => false,
            "cart_photo" => false,
            "avatar_photo" => false,
            "tieude_photo" => false,
            "width_photo" => 150*4,
            "height_photo" => 150*4,
            "thumb_photo" => '600x600x1',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
        )
    );
    $config['product'][$nametype]['link'] = false;
    $config['product'][$nametype]['file'] = false;
    $config['product'][$nametype]['ma'] = false;
    $config['product'][$nametype]['tinhtrang'] = false;
    $config['product'][$nametype]['video'] = false;
    $config['product'][$nametype]['gia'] = false;
    $config['product'][$nametype]['giamoi'] = false;
    $config['product'][$nametype]['giakm'] = false;
    $config['product'][$nametype]['mota'] = false;
    $config['product'][$nametype]['mota_cke'] = false;
    $config['product'][$nametype]['noidung'] = true;
    $config['product'][$nametype]['noidung_cke'] = true;
    $config['product'][$nametype]['seo'] = true;
    $config['product'][$nametype]['width'] = 450;
    $config['product'][$nametype]['height'] = 660;
    $config['product'][$nametype]['thumb'] = '450x660x2';
    $config['product'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['product'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';



    /* Sản phẩm (List) */
    $config['product'][$nametype]['title_main_list'] = "Sản phẩm cấp 1";
    $config['product'][$nametype]['images_list'] = false;
    $config['product'][$nametype]['show_images_list'] = false;
    $config['product'][$nametype]['slug_list'] = true;
    $config['product'][$nametype]['check_list'] = array();
    $config['product'][$nametype]['gallery_list'] = array();
    $config['product'][$nametype]['mota_list'] = false;
    $config['product'][$nametype]['seo_list'] = true;
    $config['product'][$nametype]['width_list'] = 65;
    $config['product'][$nametype]['height_list'] = 65;
    $config['product'][$nametype]['thumb_list'] = '65x65x2';
    $config['product'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG';

    /* Sản phẩm (Cat) */
    $config['product'][$nametype]['title_main_cat'] = "Sản phẩm cấp 2";
    $config['product'][$nametype]['images_cat'] = false;
    $config['product'][$nametype]['show_images_cat'] = false;
    $config['product'][$nametype]['slug_cat'] = true;
    $config['product'][$nametype]['check_cat'] = array();
    $config['product'][$nametype]['mota_cat'] = false;
    $config['product'][$nametype]['seo_cat'] = true;
    $config['product'][$nametype]['width_cat'] = 75*4;
    $config['product'][$nametype]['height_cat'] = 50*4;
    $config['product'][$nametype]['thumb_cat'] = '100x100x1';
    $config['product'][$nametype]['img_type_cat'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Đăng ký nhận tin */
    $nametype = "dangkynhantin";
    $config['newsletter'][$nametype]['title_main'] = "Đăng ký nhận tin";
    $config['newsletter'][$nametype]['email'] = true;
    $config['newsletter'][$nametype]['guiemail'] = true;
    $config['newsletter'][$nametype]['ten'] = true;
    $config['newsletter'][$nametype]['dienthoai'] = true;
    $config['newsletter'][$nametype]['diachi'] = true;
    $config['newsletter'][$nametype]['chude'] = true;
    $config['newsletter'][$nametype]['noidung'] = true;
    $config['newsletter'][$nametype]['ghichu'] = true;
    $config['newsletter'][$nametype]['tinhtrang'] = array("1" => "Đã xem", "2" => "Đã liên hệ", "3" => "Đã thông báo");
    $config['newsletter'][$nametype]['showten'] = true;
    $config['newsletter'][$nametype]['showdienthoai'] = true;
    $config['newsletter'][$nametype]['showngaytao'] = true;
    $config['newsletter'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

    
    $nametype = "blog";
    $config['news'][$nametype]['title_main'] = "Blog";
    $config['news'][$nametype]['dropdown'] = false;
    $config['news'][$nametype]['list'] = false;
    $config['news'][$nametype]['cat'] = false;
    $config['news'][$nametype]['item'] = false;
    $config['news'][$nametype]['schema'] = false;
    $config['news'][$nametype]['sub'] = false;
    $config['news'][$nametype]['tags'] = false;
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['copy_image'] = false;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['icon'] = false;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['show_gallery'] = true;
    $config['news'][$nametype]['gallery'] = array();
    $config['news'][$nametype]['link'] = false;
    $config['news'][$nametype]['file'] = false;
    $config['news'][$nametype]['video'] = false;
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 390;
    $config['news'][$nametype]['height'] = 290;
    $config['news'][$nametype]['width_icon'] = 30*2;
    $config['news'][$nametype]['height_icon'] = 30*2;
    $config['news'][$nametype]['thumb'] = '390x290x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

   


    $nametype = "gioi-thieu";
    $config['news'][$nametype]['title_main'] = "Giới thiệu";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['view'] = false;
    $config['news'][$nametype]['slug'] = false;
    $config['news'][$nametype]['icon'] = false;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = false;
    $config['news'][$nametype]['copy'] = false;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = false;
    $config['news'][$nametype]['width'] = 1280;
    $config['news'][$nametype]['height'] = 700;
    $config['news'][$nametype]['width_icon'] = 30*2;
    $config['news'][$nametype]['height_icon'] = 30*2;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    


    $nametype = "quy-trinh-thanh-lap";
    $config['news'][$nametype]['title_main'] = "Quy trình thành lập";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['view'] = false;
    $config['news'][$nametype]['slug'] = false;
    $config['news'][$nametype]['icon'] = false;
    $config['news'][$nametype]['images'] = false;
    $config['news'][$nametype]['show_images'] = false;
    $config['news'][$nametype]['copy'] = false;
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = false;
    $config['news'][$nametype]['seo'] = false;
    $config['news'][$nametype]['width'] = 1280;
    $config['news'][$nametype]['height'] = 700;
    $config['news'][$nametype]['width_icon'] = 30*2;
    $config['news'][$nametype]['height_icon'] = 30*2;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Chính sách */
    $nametype = "chinh-sach";
    $config['news'][$nametype]['title_main'] = "Chính sách";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['icon'] = false;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = false;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 570*1;
    $config['news'][$nametype]['height'] = 370*1;
    $config['news'][$nametype]['width_icon'] = 30*2;
    $config['news'][$nametype]['height_icon'] = 30*2;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Hình thức thanh toán */
    $nametype = "hinh-thuc-thanh-toan";
    $config['news']['hinh-thuc-thanh-toan']['title_main'] = "Hình thức thanh toán";
    $config['news']['hinh-thuc-thanh-toan']['check'] = array();
    $config['news']['hinh-thuc-thanh-toan']['mota'] = true;

  

    $nametype = "shop-on-instagram";
    $config['static'][$nametype]['title_main'] = "Shop on Instagram";
    $config['static'][$nametype]['link'] = true;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
    $config['static'][$nametype]['gallery'] = array(
        $nametype => array
        (
            "title_main_photo" => "Hình ảnh ",
            "title_sub_photo" => "Hình ảnh",
            "number_photo" => 3,
            "images_photo" => false,
            "cart_photo" => false,
            "avatar_photo" => false,
            "tieude_photo" => false,
            "width_photo" => 250*4,
            "height_photo" => 250*4,
            "thumb_photo" => '1000x1000',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
        )
    );

    /* Slogan */
    $nametype = "slogan";
    $config['static'][$nametype]['title_main'] = "Slogan top";
    $config['static'][$nametype]['tieude'] = true;

    /* Liên hệ */
    $nametype = "lienhe";
    $config['static'][$nametype]['title_main'] = "Liên hệ";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;

    /* Footer */
    $nametype = "footer-content1";
    $config['static'][$nametype]['title_main'] = "Thông tin Footer 1";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;

    $nametype = "footer-content2";
    $config['static'][$nametype]['title_main'] = "Thông tin Footer 2";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;

    $nametype = "footer-content3";
    $config['static'][$nametype]['title_main'] = "Thông tin Footer 3";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;

   

    /* Logo */
    $nametype = "logo";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Logo";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 110;
    $config['photo']['photo_static'][$nametype]['height'] = 49;
    $config['photo']['photo_static'][$nametype]['thumb'] = '110x49x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Favicon */
    $nametype = "favicon";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Favicon";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 25;
    $config['photo']['photo_static'][$nametype]['height'] = 25;
    $config['photo']['photo_static'][$nametype]['thumb'] = '25x25x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Slideshow */
    $nametype = "slide";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Slideshow";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 5;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 1440;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 640;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '1440x640x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Mạng xã hội */
    $nametype = "mangxahoi1";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Mạng xã hội footer";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 4;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 30;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 30;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '30x30x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    $nametype = "icon-lienhe";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Icon liên hệ";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 4;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 65;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 65;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '65x65x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG';


    $nametype = "popup";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Popup";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = true;
    $config['photo']['photo_static'][$nametype]['link'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 700;
    $config['photo']['photo_static'][$nametype]['height'] = 350;
    $config['photo']['photo_static'][$nametype]['thumb'] = '700x350x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    $nametype = "bn-contact-us";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Banner liên hệ";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = false;
    $config['photo']['photo_static'][$nametype]['link'] = false;
    $config['photo']['photo_static'][$nametype]['width'] = 1440;
    $config['photo']['photo_static'][$nametype]['height'] = 400;
    $config['photo']['photo_static'][$nametype]['thumb'] = '1440x400x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    $nametype = "bn-products";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Banner sản phẩm";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = false;
    $config['photo']['photo_static'][$nametype]['link'] = false;
    $config['photo']['photo_static'][$nametype]['width'] = 1440;
    $config['photo']['photo_static'][$nametype]['height'] = 400;
    $config['photo']['photo_static'][$nametype]['thumb'] = '1440x400x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    $nametype = "bn-blog";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Banner blog";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = false;
    $config['photo']['photo_static'][$nametype]['link'] = false;
    $config['photo']['photo_static'][$nametype]['width'] = 1440;
    $config['photo']['photo_static'][$nametype]['height'] = 400;
    $config['photo']['photo_static'][$nametype]['thumb'] = '1440x400x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    $nametype = "bn-user";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Banner trang thành viên";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = false;
    $config['photo']['photo_static'][$nametype]['link'] = false;
    $config['photo']['photo_static'][$nametype]['width'] = 1440;
    $config['photo']['photo_static'][$nametype]['height'] = 400;
    $config['photo']['photo_static'][$nametype]['thumb'] = '1440x400x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';





    /* Setting */
    $config['setting']['diachi'] = true;
    $config['setting']['dienthoai'] = true;
    $config['setting']['hotline'] = true;
    $config['setting']['zalo'] = true;
    $config['setting']['oaidzalo'] = true;
    $config['setting']['email'] = true;
    $config['setting']['website'] = true;
    $config['setting']['fanpage'] = true;
    $config['setting']['toado'] = true;
    $config['setting']['toado_iframe'] = true;

    /* Seo page */
    $config['seopage']['page'] = array(
        "trang-chu" => "Trang chủ",
        "blog" => "Blog",
        "san-pham" => "Sản phẩm",
        "new-collection" => "Sản phẩm mới",
        "featured-products" => "Sản phẩm nổi bật",
        "sale" => "Sản phẩm khuyễn mãi",
        "outfit" => "Outfit",
        "intro" => "Giới thiệu",
        "lien-he" => "Liên hệ"
    );
    $config['seopage']['width'] = 75*4;
    $config['seopage']['height'] = 50*4;
    $config['seopage']['thumb'] = '250x250x1';
    $config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Quản lý import */
    $config['import']['images'] = true;
    $config['import']['thumb'] = '100x100x1';
    $config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

    /* Quản lý export */
    $config['export']['category'] = true;

    /* Quản lý tài khoản */
    $config['user']['active'] = true;
    $config['user']['admin'] = true;
    $config['user']['visitor'] = true;

    /* Quản lý phân quyền */
    $config['permission'] = false;

    /* Quản lý địa điểm */
    $config['places']['active'] = true;
    $config['places']['placesship'] = false;

    /* Quản lý giỏ hàng */
    $config['order']['active'] = true;
    $config['order']['search'] = true;
    $config['order']['excel'] = false;
    $config['order']['word'] = false;
    $config['order']['excelall'] = false;
    $config['order']['wordall'] = false;
    $config['order']['thumb'] = '100x100x1';

    /* Quản lý mã ưu đãi */
    $config['coupon'] = true;

    /* Quản lý thông báo đẩy */
    $config['onesignal'] = false;

    /* Quản lý mục (Không cấp) */
    if(count($config['news']))
    {
        foreach ($config['news'] as $key => $value)
        {
            if(isset($value['dropdown']) && $value['dropdown']==false)
            { 
                $config['shownews'] = 1;
                break;
            }
        }
    }
?>