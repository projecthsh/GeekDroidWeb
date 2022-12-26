<?php

require_once 'config.php';

$d = $db->prepare("INSERT INTO `geekdroid`.`apps` (`package`, `name`, `logo`, `link`, `screenshots`, `description`, `tags`) VALUES (?, ?, ?, ?, ?, ?, ?);");

// 绑定参数
$d->bind_param('sssssss', $package, $name, $logo, $link, $screenshots, $description, $tags);

// 读取文件
$json = file_get_contents('index-1.json');

// 解析JSON
$data = json_decode($json, true);

// 循环
foreach ($data as $app) {

    // 检测数据库中是否已经存在
    $check = $db->prepare("SELECT * FROM `geekdroid`.`apps` WHERE `package` = ?;");
    $check->bind_param('s', $app['package']);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        echo $app['package'] . ' 已存在，跳过。' . PHP_EOL;
        continue;
    }

    $package = $app['package'];
    $name = $app['name'];
    $logo = $app['logo'];
    $link = $app['link'];
    $screenshots = json_encode($app['screenshots']);
    $description = $app['description'];
    $tags = json_encode($app['tags']);

    // 执行
    $d->execute();
}

// 关闭
$d->close();
