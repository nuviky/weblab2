<?php
    session_start();
    require_once 'operationWithDataBase.php';
    $mail = $_POST['mail'];
    setcookie("mail", $mail, time()+360, '/pages/authorization.php');
    $password = $_POST['password'];
    setcookie("password", $password, time()+360, '/pages/authorization.php');
    if ($mail == '' && $password == '') {
        $_SESSION['message'] = 'Заполните все поля';
        header('Location: ../pages/authorization.php');
        exit();
    }

    $check = checkUser($mail, $password);

    if ($check['err'] === false) {
        $_SESSION['message'] = 'Неправильный логин или пароль';
        header('Location: ../pages/authorization.php');
        exit();
    }

    $_SESSION['logged_user'] = $mail;
    if ($check['admin']) {
        $_SESSION['logged_admin'] = true;
    } else {
        $_SESSION['logged_admin'] = false;
    }
    setcookie("mail", null, -1, '/pages/authorization.php');
    setcookie("password", null, -1, '/pages/authorization.php');
    header('Location: ../pages/userpage.php');
