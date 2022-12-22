<!DOCTYPE html>
<html lang="<?=$config['website']['lang-doc']?>" class="flexbox">
<head>
    <?php include SOURCES."head.php"; ?>
    <link href='assets/css/checkouts.css?t=<?=time()?>' rel='stylesheet' type='text/css'/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body ondragstart="return false;" ondrop="return false;">
    <?php include TEMPLATE.LAYOUT."seo.php";?>
    <?php include TEMPLATE.$template."_tpl.php";?>
    <?php include SOURCES."js.php";?>
</body>
</html>