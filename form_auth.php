<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:57
 */
require_once("header.php");
?>
<link rel="stylesheet" type="text/css" href="css/registration.css">
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php

    if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
        echo $_SESSION["error_messages"];

        //Уничтожаем чтобы не появилось заново при обновлении страницы
        unset($_SESSION["error_messages"]);
    }

    if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
        echo $_SESSION["success_messages"];

        //Уничтожаем чтобы не появилось заново при обновлении страницы
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>

<?php
//Проверяем, если пользователь не авторизован, то выводим форму авторизации,
//иначе выводим сообщение о том, что он уже авторизован
if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    ?>


<div class="ribbon"></div>
<div class="login">
    <h1>Авторизация</h1>
    <p>Введите авторизационные данные пользователя</p>
        <form action="auth.php" method="post" name="form_auth">
            <div class="input">

                <div class="blockinput">
                    <input type="email" name="email" required="required" placeholder="E-mail">
                </div>

                <div class="blockinput">
                    <input type="password" name="password" placeholder="Пароль" required="required"><br>
                    <span id="valid_password_message" class="mesage_error"></span>
                </div>

                <div class="blockinput">
                    <input type="text" name="captcha" placeholder="Проверочный код" autocomplete="off">
                    <img src="captcha.php" alt="Изображение капчи" /> <br>
                </div>

            </div>

                        <input class="buttonReg" type="submit" name="btn_submit_auth" value="Войти">

        </form>
</div>


    <?php
}else{
    ?>

    <div id="authorized">
        <br><br><h1>Вы уже авторизованы</h1>
    </div>

    <?php
}
?>

<?php
//Подключение подвала
require_once("footer.php");
?>
