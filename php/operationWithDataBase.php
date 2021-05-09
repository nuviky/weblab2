<?php
    function connect() { // Подключение
        $dbconfig = parse_ini_file("../config/dbconfig.ini");
        try {
            $pdo = new PDO('mysql:host='.$dbconfig['host'].';dbname='.$dbconfig['name'], $dbconfig['login'], $dbconfig['password']);
            return $pdo;
        } catch (PDOExeption $e) {
            die('Error connect db');
        }
    }

    function addUser($password, $username, $mail, $admin): bool { // Регистрация
        $pdo = connect();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users(u_name, u_mail, u_password, u_admin) VALUES(:username, :mail, :password, :admin)';
        $stmt = $pdo->prepare($sql);
        $params = [ 'username' => $username, 'mail' => $mail, 'password' => $password, 'admin' => $admin ];
        return $stmt->execute($params);
    }

    function checkUser($mail, $password): array { // Авторизация
        $pdo = connect();
        $sql = 'SELECT u_mail, u_password, u_admin FROM users WHERE u_mail = :mail';
        $params = [ 'mail' => $mail ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$user or !password_verify($password, $user->u_password)){
            $ret['err'] = false;
            return $ret;
        }
        $ret['admin'] = $user->u_admin;
        return $ret;
    }

    function getReport($id){ // Получение доклада с определенным id
        $pdo = connect();
        $sql = 'SELECT r_report_title, r_themathics, r_report_description, r_file_text_speech, r_file_presentation FROM requests WHERE r_id = :id';
        $params = [ 'id' => $id ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    function addReport($report_title, $info_speaker, $themathics, $report_description, $patht, $pathp, $mail): bool {// Добавление доклада
        $pdo = connect();
        $sql = 'INSERT INTO requests (r_report_title, r_info_speaker, r_themathics, r_report_description, '.
            'r_file_text_speech, r_file_presentation, u_mail) VALUES(:report_title, :info_speaker, :themathics, '.
            ':report_description, :patht ,:pathp, :mail)';
        $stmt = $pdo->prepare($sql);
        $params = [ 'report_title' => $report_title, 'info_speaker' => $info_speaker, 'themathics' => $themathics,
            'report_description' => $report_description, 'patht' => $patht, 'pathp' => $pathp, 'mail' => $mail];
        return $stmt->execute($params);
    }

    function getListReport($mail, $admin): array {// Все доклады пользователя / пользователей
        $pdo = connect();
        if ($admin){
            $sql = 'SELECT r_id, r_report_title, r_themathics, r_report_description, u_mail FROM requests';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } else {
            $sql = 'SELECT r_id, r_report_title, r_themathics, r_report_description FROM requests WHERE u_mail = :mail';
            $params = [ 'mail' => $mail ];
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserName($mail){ // Получить имя пользователя ???
        $pdo = connect();
        $sql = 'SELECT u_name FROM users WHERE u_mail = :mail';
        $params = [ 'mail' => $mail ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

