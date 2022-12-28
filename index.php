<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mdui@1.0.2/dist/css/mdui.min.css" />
    <title>GeekDroid</title>
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-theme-layout-auto">
    <div class="mdui-container">

        <h1>GeekDroid - 搜索</h1>
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


    </div>
    <foot>Copyright 2022 OtakusNetwork, All Rights Reserved. Made by iVampireSP & OtakusNetwork. Made with love.</foot>
    <script src="https://unpkg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>

</html>