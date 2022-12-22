<div class="form__wrap con py-5">
    <h2 class="sec-title form__title"><?=taotaikhoan?></h2>
    <form action="" id="mona-register-popup">
        <div class="form">
            <input type="text" autocomplete name="data[ten]" required="" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" class="rs-form form__inp" placeholder="<?=hovaten?>">
            <input type="email" autocomplete name="data[email]" required="" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" class="rs-form form__inp" placeholder="<?=email?>">
            <input type="tel" autocomplete name="data[dienthoai]" minlength="10" maxlength="10" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" required="" class="rs-form form__inp" placeholder="<?=sodienthoai?>">
            <input type="text" autocomplete name="data[ngaysinh]" onclick="(this.type='date')" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" required="" class="rs-form form__inp form__date" placeholder="<?=ngaysinh?>">
            <input type="password" autocomplete name="data[password]" required="" class="rs-form form__inp" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" placeholder="<?=matkhau?>">
            <input type="password" autocomplete name="register_repass" required="" class="rs-form form__inp" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" placeholder="<?=xacnhanmatkhau?>">
            <div class="form__check">
                <label for="policy" class="fl-con">
                    <input type="checkbox" name="policy" value="yes" id="policy" required="" class="dp-none">
                    <div class="form__cbox"></div>
                    <div class="form__ctxt hov-df"> <?=okchinhsach?> </div>
                </label>
            </div>
            <div class="form__bot form__mb m-cus-btn-f-register"> 
                <input type="hidden" name="action" value="login">
                <button class="rs-form btn-pri c-whi form__submit-small m-btn-loading disabled"><?=dangky?></button>
            </div>
            <span class="d-block form__bot m-cus-text-regis"><?=txt1?> <a href="account/login" class=""> <?=txt2?> </a> <?=txt3?> </span>
            <div id="response-register mt-3"></div>
        </div>
    </form>
</div>