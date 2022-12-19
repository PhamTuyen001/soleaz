<section class="warp-banner-inpage">
    <p class="text-center">
        <img src="assets/images/bg-sanpham.png" alt="">
    </p>
</section>
<div class="show_list_prodduct py-5">
    <div class="container">
        <div class="title-product text-center mb-5">
            <h2 class="font-weight-normal"><?=fashionnole?></h2>
        </div>
        <div class="row-product-list">
            <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="0" data-autoplay='1' data-slidesDefault="6:1" data-lg-items='6:1' data-md-items='6:1' data-sm-items='6:1' data-xs-items="6:1" data-vertical="0">
                <?php foreach ($splistmenu as $k => $v) {?>
                <div class="col-product-list">
                    <div class="box-product-list">
                        <a href="<?=$v[$sluglang]?>">
                            <span>
                                <img src="<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten']?>">
                            </span>
                            <p><?=$v['ten']?></p>
                        </a>
                    </div>
                </div> 
                <?php }?>
            </div>
        </div>
    </div>
</div>

<section class="product-noibat py-5">
    <div class="container">
        <div class="title-product mb-5">
            <h6 class="font-weight-normal"><?=sanphamnoibat?></h6>
        </div>
        <div class="row-products row-arrows">
            <div class="slick in-page" data-dots="0" data-infinite="0" data-arrows="1" data-autoplay='1' data-slidesDefault="4:1" data-lg-items='4:1' data-md-items='4:1' data-sm-items='4:1' data-xs-items="4:1" data-vertical="0">
                <div class="col-product">
                    <div class="box-product">
                        <div class="img-product">
                            
                            <a href="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835474330214_3097975e2d8f1a6826e019382bd06c0c_df9bfec51e224ba2ae69c88a14df1fe7.jpg" alt="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835473589564_b78c19d7de3deefb60fd2c0b333a46a6_4fd1604a95d642dfa13b757bf46bce34-1000x1000.jpg" alt="">
                            </a>
                        </div>
                        <div class="colors-product">
                            <ul>
                                <li style="--color:#114997"></li>
                                <li style="--color:#8EACB7"></li>
                            </ul>
                        </div>
                        <div class="info-products">
                            <h3>
                                <a href="">Incipience Black T-Shirt</a>
                            </h3>
                            <div class="price-product">
                                <span class="price-new">150.00 USD</span>
                                <span class="price-old">170.00 USD</span>
                                <!-- <?php if($v['giakm']) { ?>
                                    <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                                    <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                                <?php } else { ?>
                                    <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                                <?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-product">
                    <div class="box-product">
                        <div class="img-product">

                            <a href="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835474330214_3097975e2d8f1a6826e019382bd06c0c_df9bfec51e224ba2ae69c88a14df1fe7.jpg" alt="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835473589564_b78c19d7de3deefb60fd2c0b333a46a6_4fd1604a95d642dfa13b757bf46bce34-1000x1000.jpg" alt="">
                            </a>
                        </div>
                        <div class="colors-product">
                            <ul>
                                <li style="--color:#114997"></li>
                                <li style="--color:#8EACB7"></li>
                            </ul>
                        </div>
                        <div class="info-products">
                            <h3>
                                <a href="">Incipience Black T-Shirt</a>
                            </h3>
                            <div class="price-product">
                                <span class="price-new">150.00 USD</span>
                                <span class="price-old">170.00 USD</span>
                                <!-- <?php if($v['giakm']) { ?>
                                    <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                                    <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                                <?php } else { ?>
                                    <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                                <?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-product">
                    <div class="box-product">
                        <div class="img-product">
                            <a href="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835474330214_3097975e2d8f1a6826e019382bd06c0c_df9bfec51e224ba2ae69c88a14df1fe7.jpg" alt="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835473589564_b78c19d7de3deefb60fd2c0b333a46a6_4fd1604a95d642dfa13b757bf46bce34-1000x1000.jpg" alt="">
                            </a>
                        </div>
                        <div class="colors-product">
                            <ul>
                                <li style="--color:#114997"></li>
                                <li style="--color:#8EACB7"></li>
                            </ul>
                        </div>
                        <div class="info-products">
                            <h3>
                                <a href="">Incipience Black T-Shirt</a>
                            </h3>
                            <div class="price-product">
                                <span class="price-new">150.00 USD</span>
                                <span class="price-old">170.00 USD</span>
                                <!-- <?php if($v['giakm']) { ?>
                                    <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                                    <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                                <?php } else { ?>
                                    <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                                <?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-product">
                    <div class="box-product">
                        <div class="img-product">
                            <a href="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835474330214_3097975e2d8f1a6826e019382bd06c0c_df9bfec51e224ba2ae69c88a14df1fe7.jpg" alt="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835473589564_b78c19d7de3deefb60fd2c0b333a46a6_4fd1604a95d642dfa13b757bf46bce34-1000x1000.jpg" alt="">
                            </a>
                        </div>
                        <div class="colors-product">
                            <ul>
                                <li style="--color:#114997"></li>
                                <li style="--color:#8EACB7"></li>
                            </ul>
                        </div>
                        <div class="info-products">
                            <h3>
                                <a href="">Incipience Black T-Shirt</a>
                            </h3>
                            <div class="price-product">
                                <span class="price-new">150.00 USD</span>
                                <span class="price-old">170.00 USD</span>
                                <!-- <?php if($v['giakm']) { ?>
                                    <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                                    <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                                <?php } else { ?>
                                    <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                                <?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-product">
                    <div class="box-product">
                        <div class="img-product">
                            <a href="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835474330214_3097975e2d8f1a6826e019382bd06c0c_df9bfec51e224ba2ae69c88a14df1fe7.jpg" alt="">
                                <img src="https://levents.asia/wp-content/uploads/2022/10/z3835473589564_b78c19d7de3deefb60fd2c0b333a46a6_4fd1604a95d642dfa13b757bf46bce34-1000x1000.jpg" alt="">
                            </a>
                        </div>
                        <div class="colors-product">
                            <ul>
                                <li style="--color:#114997"></li>
                                <li style="--color:#8EACB7"></li>
                            </ul>
                        </div>
                        <div class="info-products">
                            <h3>
                                <a href="">Incipience Black T-Shirt</a>
                            </h3>
                            <div class="price-product">
                                <span class="price-new">150.00 USD</span>
                                <span class="price-old">170.00 USD</span>
                                <!-- <?php if($v['giakm']) { ?>
                                    <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                                    <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                                <?php } else { ?>
                                    <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                                <?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
