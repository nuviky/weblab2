<?php
session_start();
if( !isset($_SESSION['logged_user'])){
    header('Location: ../index.php');
    exit;
}
include_once('header.php');
?>
<div class="container">
    <a href="userpage.php">Главная страница</a><br/>
    <div class="container-lg">
        <?php
        require_once ('../php/operationWithDataBase.php');
        $report = getReport($_GET['id']);
        echo '
        <label class="h5">Название доклада:</label><br/>
        <label>'.$report->r_report_title.'</label><br/>
        <label class="h5">Тематика:</label><br/>
        <label>'.$report->r_themathics.'</label><br/>
        <label class="h5">Краткое описание доклада:</label><br/>
        <label>'.$report->r_report_description.'</label><br/>
        <a href=../'.$report->r_file_text_speech.'>Файл с текстом выступления</a><br/>
        <a href=../'.$report->r_file_presentation.'>Файл с презентацией</a>'; ?>
    </div>
</div>
</body>
</html>