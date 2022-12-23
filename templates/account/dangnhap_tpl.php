<div class="form__wrap con py-5">
    <h2 class="sec-title form__title"><?=dangnhap?></h2>
    <form action="" id="mona-login-form">
        <div class="form">
            <div class="form__txt"><?=banchuacotaikhoan?><a href="account/register" class="form__link"><?=dangky?></a>
            </div>
            <input type="text" name="data[username]" required="" class="rs-form form__inp" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" placeholder="<?=emailhoacsodienthoai?>">
            <input type="password" name="data[password]" required="" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" class="rs-form form__inp" placeholder="<?=matkhau?>">
            <div class="form__check">
                <label for="user_remember" class="fl-con">
                    <input type="checkbox" name="user_remember" value="yes" id="user_remember" class="dp-none">
                    <div class="form__cbox"></div>
                    <div class="form__ctxt hov-df"><?=ghinhotaikhoan?></div>
                </label>
            </div>
            <div class="fl-wrap aln-ct form__bot form__mb">
                <input type="hidden" name="action" value="login">
                <!-- <a href="account/forgot-password" class="dp-block form__link">
                    <?=quenmatkhau?> ?
                </a> -->
                <button class="rs-form btn-pri c-whi form__submit-small m-btn-loading"><?=dangnhap?></button>
            </div>
            <div id="response-login" class="mt-3"></div>
        </div>
    </form>
</div>