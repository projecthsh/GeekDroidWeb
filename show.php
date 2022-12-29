<?php

require_once 'config.php';

if (!isset($_GET['package'])) {
    // 跳换回 index.php
    header('Location: index.php');
}

// 查询
$d = $db->prepare("SELECT * FROM `geekdroid`.`apps` WHERE `package` = ?;");
$d->bind_param('s', $_GET['package']);
$d->execute();
$result = $d->get_result();
$app = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css" />
    <script src="https://kit.fontawesome.com/ca59f7439e.js" crossorigin="anonymous"></script>
    <title>GeekDroid - <?php echo $app['name']; ?></title>
    <style type="text/css">
body {
	background-image: url(bg.png);
	  background-repeat: no-repeat;
	background-attachment: fixed; 
	background-position: center center;
	 background-attachment: fixed;
	  background-size: cover;
}
</style>
</head>

<body class="mdui-drawer-body-left mdui-theme-primary-indigo mdui-theme-accent-pink mdui-theme-layout-auto mdui-appbar-with-toolbar">
    	<!--顶栏开始-->
        <header class="mdui-appbar mdui-appbar-fixed">
<div class="mdui-toolbar mdui-color-theme">
<span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></span>
<a href="./index.php" class="mdui-typo-headline">GeekDroid - <?php echo $app['name']; ?></a>
<div class="mdui-toolbar-spacer"></div>
</header>
	<!--顶栏结束-->
<!--左侧菜单栏-->
    <div class="mdui-drawer" id="drawer">
<!--普通菜单开始-->
<div class="mdui-list" mdui-collapse="{accordion: true}">
</form>
	<!--按钮区域-->
<a href="./index.php" class="mdui-list-item mdui-ripple" id="home-url">
<i class="mdui-list-item-icon mdui-icon material-icons">home</i>
<div class="mdui-list-item-content mdui-m-r-4">首页</div>
</a>

<a href="./show.php?package=github.znzsofficial.geekdroid" class="mdui-list-item mdui-ripple" id="home-url">
<i class="mdui-list-item-icon mdui-icon material-icons">android</i>
<div class="mdui-list-item-content mdui-m-r-4">GeekDroid 安卓客户端</div>
</a>

<a href="https://github.com/projecthsh" class="mdui-list-item mdui-ripple">
<i class="mdui-list-item-icon mdui-icon material-icons fa-brands fa-github"></i>
<div class="mdui-list-item-content mdui-m-r-4">GitHub</div>
</a>

<a href="https://jq.qq.com/?_wv=1027&k=h3ZUEWUn" class="mdui-list-item mdui-ripple">
<i class="mdui-list-item-icon mdui-icon material-icons fa-brands fa-qq"></i>
<div class="mdui-list-item-content mdui-m-r-4">QQ用户群</div>
</a>

<a href="https://t.me/geekdroid_group" class="mdui-list-item mdui-ripple">
<i class="mdui-list-item-icon mdui-icon material-icons fa-brands fa-telegram"></i>
<div class="mdui-list-item-content mdui-m-r-4">TG用户群</div>
</a>
</div>
</div>
</div>
	<!--普通菜单结束-->
    <div class="mdui-container" style="margin-top: 25px;">


        <img style="width: 7%;" src="<?php echo $app['logo'] ?>" />

        <h1><?php echo $app['name']; ?></h1>
        <span><?php echo $app['description']; ?></span>

        <br />
        <br />
        <a href="<?php echo $app['link'] ?>" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">下载</a>
        <br />
        <br />


        <!-- 截图(横向) -->
        <div style="overflow: scroll;">
            <?php foreach (json_decode($app['screenshots']) as $screenshot) : ?>
                <img style="width: 25%" src="<?php echo $screenshot; ?>" />
            <?php endforeach; ?>
        </div>



    </div>
    <a class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent mdui-fab-hide" id="scrolltop" href="#top"><i class="mdui-icon material-icons">expand_less</i></a>
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>

</html>