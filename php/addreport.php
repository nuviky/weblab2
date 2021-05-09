<?php
    session_start();
    require_once 'operationWithDataBase.php';
    $report_title = $_POST['report_title'];
    setcookie("report_title", $report_title, time()+360, '/pages/useraddreport.php');
    $info_speaker = $_POST['info_speaker'];
    setcookie("info_speaker", $info_speaker, time()+360, '/pages/useraddreport.php');
    $themathics = $_POST['themathics'];
    $report_description = $_POST['report_description'];
    setcookie("report_description", $report_description, time()+360, '/pages/useraddreport.php');
    $mail = $_SESSION['logged_user'];

    if (empty($report_title) && empty($info_speaker) && empty($report_description))
    {
        $_SESSION['message'] = 'Заполните все поля';
        header('Location: ../pages/useraddreport.php');
        exit();
    }
    if( !isset($_FILES['file_text_speech']) || $_FILES['file_text_speech']['error'] == UPLOAD_ERR_NO_FILE || !isset($_FILES['file_presentation']) || $_FILES['file_presentation']['error'] == UPLOAD_ERR_NO_FILE) {
        $_SESSION['message'] = 'Выберите файлы';
        header('Location: ../pages/useraddreport.php');
        exit();
    }

    $file_types = array('doc', 'docx', 'pdf');
    $current_file_type = substr(strrchr($_FILES['file_text_speech']['name'], '.'), 1);
    if (!in_array($current_file_type, $file_types)) {
        $_SESSION['message'] = 'Неправильный формат файла с текстом выступления';
        header('Location: ../pages/useraddreport.php');
        exit();
    }
    $file_types = array('ppt', 'pptx', 'pdf');
    $current_file_type = substr(strrchr($_FILES['file_presentation']['name'], '.'), 1);
    if (!in_array($current_file_type, $file_types)) {
        $_SESSION['message'] = 'Неправильный формат файла с презентацией';
        header('Location: ../pages/useraddreport.php');
        exit();
    }

    $patht = 'files/'. time() . $_FILES['file_text_speech']['name'];
    if (!move_uploaded_file($_FILES['file_text_speech']['tmp_name'], '../'. $patht)) {
        $_SESSION['message'] = 'Ошибка при загруке файла с текстом выступления';
        header('Location: ../pages/useraddreport.php');
        exit();
    }

    $pathp = 'files/'. time() . $_FILES['file_presentation']['name'];
    if (!move_uploaded_file($_FILES['file_presentation']['tmp_name'], '../'. $pathp)) {
        $_SESSION['message'] = 'Ошибка при загруке файла с презентацией';
        header('Location: ../pages/useraddreport.php');
        exit();
    }

    $addRep = addReport($report_title, $info_speaker, $themathics, $report_description, $patht, $pathp, $mail);
    if(!$addRep){
        unlink('../'. $patht);
        unlink('../'. $pathp);
        $_SESSION['message'] = 'Ошибка записи в бд';
        header('Location: ../pages/useraddreport.php');
        exit();
    } else{
        $_SESSION['message'] = 'Успешная операция';
        setcookie("report_title", null, -1, '/pages/useraddreport.php');
        setcookie("info_speaker", null, -1, '/pages/useraddreport.php');
        setcookie("report_description", null, -1, '/pages/useraddreport.php');
        header('Location: ../pages/useraddreport.php');
    }
