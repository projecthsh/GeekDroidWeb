<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css" />
    <script src="https://kit.fontawesome.com/ca59f7439e.js" crossorigin="anonymous"></script>
    <title>GeekDroid</title>
</head>

<body class="mdui-drawer-body-left mdui-theme-primary-indigo mdui-theme-accent-pink mdui-theme-layout-auto mdui-appbar-with-toolbar">
    	<!--顶栏开始-->
<header class="mdui-appbar mdui-appbar-fixed">
<div class="mdui-toolbar mdui-color-theme">
<span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></span>
<a href="网址"target="_blank" class="mdui-typo-headline">GeekDroid - 搜索</a>
<div class="mdui-toolbar-spacer"></div>
<em class="mdui-icon material-icons" id="dark_toggle_icon"></em></div>
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
</div>
</div>
</div>
	<!--普通菜单结束-->


    <div class="mdui-container">
        <h2>在下方搜索框搜索开始使用</h2>

            <form method="get" action="#">
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">软件名或包名</label>
                    <input class="mdui-textfield-input" type="text" name="search" required value="<?php echo $_GET['search'] ?? ''; ?>" />
                </div>

                <!-- button -->
                <button class=" mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">搜索</button>
            </form>


            <?php
            if (isset($_GET['search'])) :

                require_once 'config.php';
                $search = $_GET['search'];
                $search = $db->real_escape_string($search);
                $search = '%' . $search . '%';
                $d = $db->prepare("SELECT * FROM `geekdroid`.`apps` WHERE `name` LIKE ? OR `package` LIKE ?;");
                $d->bind_param('ss', $search, $search);
                $d->execute();
                $result = $d->get_result();
            ?>


                <ul class="mdui-list">

                    <!-- 如果没有结果，则提示 -->
                    <?php if ($result->num_rows == 0) : ?>
                        <li>没有结果</li>
                    <?php endif; ?>

                    <!-- 循环输出结果 -->
                    <?php while ($row = $result->fetch_assoc()) : ?>

                        <a href="/show.php?package=<?php echo $row['package']; ?>">
                            <li class="mdui-list-item mdui-ripple">
                                <div class="mdui-list-item-avatar">
                                    <img src="<?php echo $row['logo']; ?>" alt="<?php echo $row['name']; ?>" />
                                </div>
                                <div class="mdui-list-item-content">
                                    <div class="mdui-list-item-title"><?php echo $row['name']; ?></div>
                                    <div class="mdui-list-item-text mdui-list-item-one-line">
                                        <span class="mdui-text-color-theme-text"><?php echo $row['description']; ?>
                                    </div>
                                </div>
                            </li>
                        </a>
                    <?php endwhile; ?>

                </ul>

                <!-- 输出有多少结果 -->
                <div class="mdui-typo-caption-opacity">共 <?php echo $result->num_rows; ?> 个结果</div>

            <?php endif; ?>
            <br><br>
            <foot>Copyright © 2022 OtakusNetwork, All Rights Reserved.<br>Made by iVampireSP & OtakusNetwork.<br>Made with love.</foot>
    </div>
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>

</html>