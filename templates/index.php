<!DOCTYPE html>
<html lang="<?=$config['website']['lang-doc']?>">
<head>
    <?php include SOURCES."head.php"; ?>
    <?php include SOURCES."css.php"; ?>
</head>
<body>
    <?php
        include TEMPLATE.LAYOUT."seo.php";
        include TEMPLATE.LAYOUT."header.php";
        
        include TEMPLATE.LAYOUT."mmenu.php";
        if($source=='index') include TEMPLATE.LAYOUT."slide.php";
        //else include TEMPLATE.LAYOUT."breadcrumb.php";
    ?>
    <?php if($source=='index'){ ?>
    <div class="box-main">
        <?php include TEMPLATE.$template."_tpl.php"; ?>
    </div>
    <?php }else{ ?>
        <div class="wrap-main <?=($source=='index')?'wrap-home':''?> w-clear">
            <?php include TEMPLATE.$template."_tpl.php"; ?>
        </div>
    <?php } ?>
        
    <?php
        include TEMPLATE.LAYOUT."footer.php";
        include TEMPLATE.LAYOUT."strucdata.php";
        include TEMPLATE.LAYOUT."modal.php";
        include SOURCES."js.php";
    ?>
</body>
</html>