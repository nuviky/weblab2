<?php
session_start();
if( isset($_SESSION['logged_user'])){
    header('Location: userpage.php');
    exit;
}
include_once('header.php'); ?>
    <div class="container">
        <h1 class="text-center">Авторизация</h1>
        <form action="../php/authorization.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label>Mail</label>
                <input class="form-control" type="text" name="mail" placeholder="Введите эл. почту" <? if (isset($_COOKIE['mail'])) echo 'value="'.$_COOKIE['mail'].'"'?>>
            </div>
            <div class="row mb-3 is-invalid">
                <label>Пароль</label>
                <input class="form-control" type="password" name="password" placeholder="Введите пароль" <? if (isset($_COOKIE['password'])) echo 'value="'.$_COOKIE['password'].'"'?>>
            </div>
            <button class="btn btn-primary">Войти</button>
            <?php
            if(isset($_SESSION['message'])){
                echo '<p class = "msg"> ' . $_SESSION['message'] .' </p>';
                unset($_SESSION['message']);
            } ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>