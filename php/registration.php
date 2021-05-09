<?php 
	session_start();
	require_once 'operationWithDataBase.php';
	$username = $_POST['username'];
    setcookie("username", $username, time()+360, '/pages/registration.php');
	$mail = $_POST['mail'];
    setcookie("mail", $mail, time()+360, '/pages/registration.php');
	$password = $_POST['password'];
    setcookie("password", $password, time()+360, '/pages/registration.php');
	$password_confirm = $_POST['password_confirm'];
	$admin = 0;
    if (!isset($_POST['processing'])) {
        $_SESSION['message'] = 'Вы не согласны на обработку персональных данных';
        header('Location: ../pages/registration.php');
        exit();
    }
    if ( empty($username) && empty($mail) && empty($password) && empty($password_confirm)) {
        $_SESSION['message'] = 'Заполните все поля';
        header('Location: ../pages/registration.php');
        exit();
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Некоректная электронная почта';
        header('Location: ../pages/registration.php');
        exit();
    }
    if (!preg_match('/^[-\ \а-яА-Я]+$/u', $username)){
        $_SESSION['message'] = 'В имени допустимы только русские буквы, пробелы и дефисы';
        header('Location: ../pages/registration.php');
        exit();
    }
    if ($password !== $password_confirm) {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../pages/registration.php');
        exit();
    }
    if (mb_strlen($password) < 6) {
        $_SESSION['message'] = 'Минимальная длина пароля 6 символов';
        header('Location: ../pages/registration.php');
        exit();
    }
    if (!preg_match('/[a-zA-z\а-яА-я]+/u', $password)) {
        $_SESSION['message'] = 'Пароль должен состоять не только из цифр';
        header('Location: ../pages/registration.php');
        exit();
    }

    $addNewUser = addUser($password, $username, $mail, $admin);
    if (!$addNewUser){
        $_SESSION['message'] = 'Ошибка при добавлении пользователя';
        header('Location: ../pages/registration.php');
        exit();
    }
    setcookie("username", null, -1, '/pages/registration.php');
    setcookie("mail", null, -1, '/pages/registration.php');
    setcookie("password", null, -1, '/pages/registration.php');
    header('Location: ../pages/authorization.php');




