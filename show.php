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
    <title>GeekDroid - <?php echo $app['name']; ?></title>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-theme-layout-auto">
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

    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>

</html>