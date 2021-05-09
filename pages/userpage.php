<?php
session_start();
if( !isset($_SESSION['logged_user'])){
    header('Location: ../index.php');
    exit;
}
include_once('header.php');
?>
        <div class="container">
            <?php
            if (!$_SESSION['logged_admin'])
                echo '<a href="useraddreport.php">Добавить доклад</a> <h1 class="text-center">Ваши доклады</h1>';
            else
                echo '<h1 class="text-center">Все доклады</h1>';
            require_once ('../php/operationWithDataBase.php');
            $reports = getListReport($_SESSION['logged_user'], $_SESSION['logged_admin']);
            if ($_SESSION['logged_admin']){
                foreach ($reports as $r) {
                    echo '<div class="card">
                          <div class="card-header">
                            <a href="userpagereport.php?id='.$r['r_id'].'" class="stretched-link h4">'.$r['r_report_title'].'</a>
                          </div>
                          <div class="card-body">
                            <h6 class="card-title">'.$r['r_themathics'].'</h6>
                            
                            <p class="card-text">'.$r['r_report_description'].'</p>
                          </div>
                        </div>'; }
            }
            else {
                foreach ($reports as $r) {
                    echo '<div class="card">
                      <div class="card-header">
                        <a href="userpagereport.php?id='.$r['r_id'].'" class="stretched-link h4">'.$r['r_report_title'].'</a>
                      </div>
                      <div class="card-body">
                        <h6 class="card-title">'.$r['r_themathics'].'</h6>
                        <p class="card-text">'.$r['r_report_description'].'</p>
                      </div>
                    </div>'; }
            } ?>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>
</html>