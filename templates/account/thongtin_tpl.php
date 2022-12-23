<section class="warp-banner-inpage">
    <p class="text-center">
        <img class="w-100" src="<?=UPLOAD_PHOTO_L.$banner['photo']?>" alt="<?=$setting['ten'.$lang]?>">
    </p>
</section>
<?php include TEMPLATE.LAYOUT."breadcrumb.php" ?>
<section class="page-account py-5">
    <div class="container">
        <div class="row row-account">
            <div class="col-12 col-lg-2 col-account col-left-account">
                <?php include TEMPLATE.LAYOUT."left-account.php" ?>
            </div>
            <div class="col-12 col-lg-10 col-account col-right-account">
                <div class="ttile-account">
                    <h2><?=thongtincanhan?></h2>
                </div>

                <div class="info">
                    <form id="m-edit-account">
                        <div class="form">
                            <div class="info-account">
                                <p>First and last name</p>
                                <input type="text" required="" name="data[ten]" value="<?=$rowUser['ten']?>" placeholder="First and last name">
                            </div>
                            <div class="info-account">
                                <p>Email</p>
                                <input type="email" required="" disabled placeholder="Email" value="<?=$rowUser['email']?>">
                            </div>
                            <div class="info-account">
                                <p>Phone Number</p>
                                <input type="text" required="" disabled placeholder="Phone Number" value="<?=$rowUser['dienthoai']?>">
                            </div>
                            <div class="info-account">
                                <p>Date of birth</p>
                                <input type="date" required="" data-date="true" name="data[ngaysinh]" value="<?=(@$rowUser['ngaysinh'])?date('Y-m-d',@$rowUser['ngaysinh']):"";?>" placeholder="Date of birth">
                            </div>
                            <div class="info-account">
                                <p>Sex</p>
                                <select name="data[gioitinh]" required="">
                                    <option value="0"><?=chongioithinhcuaban?></option>
                                    <option value="1" <?=($rowUser['gioitinh']==1)?'selected':''?>><?=nam?></option>
                                    <option value="2" <?=($rowUser['gioitinh']==2)?'selected':''?>><?=nu?></option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="myinfo">
                        <button type="submit" value="yes">Save change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>