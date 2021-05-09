<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPRES</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-expand-md navbar-light bg-light">
        <div class="container-xl">
            <?php
            if (isset($_SESSION['logged_user'])){
                echo '<a class="navbar-brand" href="../php/logout.php">Выход</a>';
            }else{
                echo '<a class="navbar-brand" href="../pages/authorization.php">Вход</a>
                                  <a class="navbar-brand" href="registration.php">Регистрация</a>';
            }
            ?>
        </div>
    </nav>
