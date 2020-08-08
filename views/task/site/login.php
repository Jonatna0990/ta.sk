<?php include(ROOT.'/views/layouts/header.php');?>
<main role="main" class="container">

    <div class="row">
        <form action="#" method="post" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Вход в админ.панель</h1>
            <label for="inputLogin" class="sr-only">Логин </label>
            <input type="text" name="login" id="inputLogin" value="<?=$login?>" class="form-control" placeholder="Например, admin" required autofocus>
            <label for="inputPassword" class="sr-only">Пароль</label>
            <input type="password" name="password" id="inputPassword" value="<?=$password?>" class="form-control" placeholder="Например, 123" required>
            <input name="submit" class="btn btn-lg btn-primary btn-block" value="Войти" type="submit"></input>
        </form>
    </div>
</main>
