<?php
session_start();
require './controllers/CURDCLass.php';
$crud = new CRUD();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/main.css">
    <title>Document</title>
</head>

<body>
    <a class="add_section" href="category.process.php?do=add">
        <ion-icon class='add-icon' name="add-circle-outline"></ion-icon>
    </a>
    <?php
    $sql = $crud->selectAll('categories');

    $sql->execute();
    $rows = $sql->fetchAll();
    $_SESSION['categories'] = $rows;
    foreach ($rows as $key => $row) {
    ?>


    <div class="card">
        <div class=" ">
            <div class="ycenter-xbetween">
                <h2 style="word-break: break-all;">
                    <?php
                        echo $row['category_title'];
                        ?>
                </h2>
                <div class="actions">
                    <a href="category.process.php?do=edit&categoryid= <?php echo $key ?>">
                        <ion-icon class="edit-icon" name="create-outline"></ion-icon>
                    </a>
                    <a class="delete-icon"
                        href='category.process.php?do=delete&cateid= <?php echo $row['category_id']; ?>'>
                        <ion-icon name="close-circle-outline"></ion-icon>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <?php
    }

    if (isset($_SESSION['model']) && $_SESSION['model'] == 'show_edit_cate') {
        $cate = isset($_GET['key']) ? $_SESSION['categories'][$_GET['key']] : '';

    ?>

    <div class="controll_section">
        <h2>Edit this category</h2>
        <form class="form" action="category.process.php?do=update" method='post' enctype="multipart/form-data">
            <input type="hidden" hidden name='cateid' value=<?php
                                                                echo $cate['category_id'];
                                                                ?> />
            <label for="title">Category Title</label>
            <input class='input' type="title" name="title" value=<?php
                                                                        echo $cate['category_title']
                                                                        ?> />

            <button class='btn' type="submit">Edit</button>
        </form>
    </div>
    <?php

    }
    if (isset($_SESSION['model']) && $_SESSION['model'] == 'show_cate') {
        $cate = isset($_GET['key']) ? $_SESSION['categories'][$_GET['key']] : '';

    ?>

    <div class="controll_section">
        <h2>Edit this category</h2>
        <form class="form" action="category.process.php?do=inset" method='post' enctype="multipart/form-data">

            <label for="title">Category Title</label>
            <input class='input' type="title" name="title" placeholder="Enter new cate" />

            <button class='btn' type="submit">Edit</button>
        </form>
    </div>
    <?php

    }
    ?>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>

</html>