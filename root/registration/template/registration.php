<meta http-equiv="Content-Type" content="text/html; charset=utf-8 " />
<form method="post" action="index.php">
    Логин: <input id="login" type="text" name="login" /><br />
    Пароль: <input id="pass" type="password" name="password" /><br />
    Подтверждение: <input id="re_pass" type="password" name="password2" /><br />
    Email: <input id="mail" type="text" name="mail" /><br />
    <label><input id="no_xyz" type="checkbox" name="lic" value="ok" /> Чекбокс<br /></label><br />
    <input type="submit" name="GO" value="Регистрация">
</form>
<?php
mysql_query("SET NAMES cp1251");
/**
 * Created by PhpStorm.
 * User: User
 * Date: 027 27.10.18
 * Time: 16:21
 */
?>
