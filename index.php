<?php
session_start();
if (isset($_SESSION['logged_user'])){
    header('Location: /pages/userpage.php');
}
include_once('pages/header.php');
?>
	<div class="container-lg">
		<h1>Здравствуй пользователь</h1>
		<p>Данный сайт это платформа для призентаций</p>
        <p><a href="/pages/authorization.php">Авторизоваться</a></p>
        <p><a href="/pages/registration.php">Зарегистрироваться</a></p>
		</form>
	</div>
</body>
</html>