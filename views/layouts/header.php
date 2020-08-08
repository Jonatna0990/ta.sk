<?php
?>


<!doctype html>
<html lang="en">
<head>
    <title>Главная</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Bootstrap core CSS -->
    <link href="/web/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../web/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../web/css/main.css" rel="stylesheet">
    <link href="../web/css/form-validation.css" rel="stylesheet">

</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a class="p-2 text-dark" href="/">
            Главная
        </a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="/add">Добавить задачу</a>
    </nav>
    <?
    if(User::isGuest()) {
        ?>
            <a class="btn btn-outline-primary" href="/login">Вход</a>
        <?
    } else {
        ?>
        <a class="p-2 text-dark" href="/admin">Список задач</a>

        <a class="btn btn-outline-primary" href="/logout">Выход</a>
    <?}
    ?>
</div>
<?
$flash = Flash::getFlash();
if($flash) {
    ?>
    <div class="alert alert-<?=$flash['type']?>" role="alert">
        <?=$flash['message']?>
    </div>
<?}

?>


