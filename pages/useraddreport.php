<?php
session_start();
if( !isset($_SESSION['logged_user'])){
    header('Location: ../index.php');
    exit;
}
include_once('header.php');
?>
    <div class="container">
        <a href="userpage.php">Список докладов</a>
        <h1>Добавление доклада</h1>
        <form action="../php/addreport.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <label class="form-label">Название доклада</label>
            <input type="text" class="form-control" name="report_title" placeholder="Введите название доклада" <? if (isset($_COOKIE['report_title'])) echo 'value="'.$_COOKIE['report_title'].'"'?>>
            </div>
            <div class="row">
                <label class="form-label">Краткая информация о докладчике (место работы/учебы, должность, достижения)</label>
                <textarea class="form-control" name="info_speaker" placeholder="Введите краткую инофрмацию о докладе" rows="3"><? if (isset($_COOKIE['info_speaker'])) echo $_COOKIE['info_speaker']?></textarea>
            </div>
            <div class="row">
                <label class="form-label">Тематика</label>
                <select class="form-select" name="themathics">
                    <?php
                    $file = file('../config/conf.txt');
                    var_dump($file);
                    foreach($file as $f){
                        echo '<option value="'.$f.'">'.$f.'</option>';
                    }?>
                </select>
            </div>
            <div class="row">
                <label class="form-label">Краткое описание доклада</label>
                <textarea class="form-control" name="report_description" placeholder="Введите краткое описание доклада" rows="3"><? if (isset($_COOKIE['report_description'])) echo $_COOKIE['report_description']?></textarea>
            </div>
            <div class="row">
                <label class="form-label">Файл с текстом выступления</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                <input type="file" class="form-control" name="file_text_speech" accept = ".doc, .docx, .pdf">
            </div>
            <div class="row">
                <label class="form-label">Файл с презентацией</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="31457280">
                <input type="file" class="form-control" name="file_presentation" accept = ".ppt, .pptx, .pdf">
            </div>
            <button class="btn btn-primary mb-3">Отправить</button>
            <?php
            if(isset($_SESSION['message'])){
                echo '<p class = "msg"> ' . $_SESSION['message'] .' </p>';
                unset($_SESSION['message']);
            }
            ?>
        </form>
    </div>
</body>
</html>