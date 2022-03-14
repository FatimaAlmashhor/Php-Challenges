<?php
session_start();
require './controllers/CURDCLass.php';

$cate = new CRUD();

if (isset($_GET['do']) && $_GET['do'] == 'add') {

    $_SESSION['model'] = 'show_cate';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_GET['do']) && $_GET['do'] == 'edit') {

    $_SESSION['model'] = 'show_edit_cate';
    $string = 'Location: index.php?key=' . trim($_GET['categoryid']);
    header($string);
}


if (isset($_GET['do']) && $_GET['do'] == 'delete') {
    $sql = $cate->delete("
    DELETE FROM categories WHERE category_id = :cateid  
    ");
    $sql->execute([
        ':cateid' => $_GET['cateid']
    ]);
    unset($_SESSION['model']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if (isset($_GET['do']) && $_GET['do'] == 'update') {
    if (isset($_POST['title'])) {
        echo '<h1>hi</h1>';
        $sql = $cate->update("
    UPDATE categories SET category_title  = :catetitle WHERE category_id = :cateid  
    ");
        $sql->execute([
            ':catetitle' => $_POST['title'],
            ':cateid' => $_POST['cateid']
        ]);
        unset($_SESSION['model']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
if (isset($_GET['do']) && $_GET['do'] == 'inset') {
    if (isset($_POST['title'])) {
        echo '<h1>hi</h1>';
        $sql = $cate->insert("
    INSERT INTO categories  (category_title , is_active)  VALUES  ( :catetitle  , true ) ; 
    ");
        $sql->execute([
            ':catetitle' => $_POST['title']
        ]);
        unset($_SESSION['model']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}