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
                <div class="ttile-account mb-0">
                    <h2><?=address?></h2>
                </div>
                <div class="order__table">
                    <div class="check__cp order__ser btn-add-address">
                        <a data-toggle="modal" data-target="#exampleModalAddress" class="rs-form btn-pri c-whi form__submit-small has-icon-add m-add-location popBtn">
                            <img class="icon-add" src="assets/images/plus.png" alt=""><?=themdiachimoi?>             
                        </a>
                    </div>
                    <div class="order__table__wrap">
                        <div class="m-list-locations">
                            <?php foreach ($rowAddress as $k => $v) {?>
                            <div class="item-location">
                                <div class="m-columns">
                                    <div class="column right">
                                        <div class="m-content-location">
                                            <div class="label-content">
                                                <p class="name"><?=hovanten?></p>
                                                <p class="phone"><?=sodienthoai?></p>
                                                <p class="address"><?=diachi?></p>
                                            </div>
                                            <div class="value-content">
                                                <p class="name"><?=$v['ten']?> <?php if($v['macdinh']==1){?><span class="tags-default"><?=macdinh?></span><?php }?></p>
                                                <p class="phone"><?=$v['dienthoai']?></p>
                                                <p class="address">
                                                    <?=$v['diachi']?> <br>
                                                    <?=$func->get_places("wards",$v['wards'])?> <br>
                                                    <?=$func->get_places("district",$v['district'])?> <br>
                                                    <?=$func->get_places("city",$v['city'])?> <br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column left">
                                        <div class="action">
                                            <a href="javascript:void(0)" onclick="EditAddressLoad(<?=$v['id']?>)" class="m-edit"><?=chinhsua?></a>
                                            <?php if($v['macdinh']==0){?><a href="javascript:void(0)" onclick="deleteAddress(<?=$v['id']?>)" class="m-edit m-delete"><?=xoa?></a><?php }?>
                                            <div class="default">
                                                <a href="javascript:void(0)" onclick="UpdateAddress(<?=$v['id']?>)" class="btn-sec hov-df m-set-default <?=($v['macdinh']==1)?'disabled':''?> m-btn-loading"><?=thietlapmacdinh?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModalAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalAddress" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <a href="javascript:void(0)" class="closeBtn" data-dismiss="modal" aria-label="Close">Close</a>
                <form id="add-location" class="m-btn-loading row box-loading f-add-location">
                    <div class="form d-flex flex-wrap ct__form fl-wrap">
                        <div class="col-12 col-lg-12"><h2 class="sec-title"><?=themdiachigiaohang?></h2></div>
                        <div class="col">
                            <input type="text" name="data[ten]" value="" size="40" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" class="rs-form form__inp" required="" placeholder="Your name*">
                        </div>
                        <div class="col-12 col-lg-12">
                            <input type="text" name="data[dienthoai]" value="" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" size="40" class="rs-form form__inp" required="" placeholder="Your phone*">
                        </div>
                        <div class="col-12 col-lg-12">
                            <input type="text" name="data[diachi]" value="" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" size="40" class="rs-form form__inp" required="" placeholder="Your address*">
                        </div>
                        <div class="col-12 col-sm-4" id="m-location-province">
                            <select class="field-input form-control" id="city" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" required name="data[city]" onchange="load_district(this.value);">
                                <option value="">  <?=chontinhthanh?> </option>
                                <?php foreach ($city as $key => $v) {?>
                                <option value="<?=$v['id']?>"><?=$v['ten']?></option>   
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4" id="m-location-district">
                            <select class="field-input form-control select-district" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" required id="district" name="data[district]" onchange="load_wards(this.value);">
                                <option value=""><?=chonquanhuyen?> </option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4" id="m-location-ward">
                            <select class="field-input form-control select-wards" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" required id="wards" name="data[wards]">
                                <option value=""><?=chonphuongxa?> </option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-12">
                            <input type="hidden" name="action" value="add-address">
                            <button type="submit" value="yes"><?=themmoi?></button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalAddressEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalAddressEdit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <a href="javascript:void(0)" class="closeBtn" data-dismiss="modal" aria-label="Close">Close</a>
                <form id="edit-location" class="m-btn-loading row box-loading f-add-location">
                    
                </form>
            </div>
        </div>
    </div>
</div>