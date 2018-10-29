<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:23
 */
// Указываем кодировку
header('Content-Type: text/html; charset=windows-1251');

$server = "localhost"; /* имя хоста */
$username = "user"; /* Имя пользователя БД */
$password = "user07001735"; /* Пароль пользователя, если у пользователя нет пароля то, оставляем пустым */
$database = "nodis"; /* Имя базы данных, которую создали */

// Подключение к базе данный через MySQLi
$mysqli = new mysqli($server, $username, $password, $database);

// Проверяем, успешность соединения.
if (mysqli_connect_errno()) {
    echo "<p><strong>Ошибка подключения к БД</strong>. Описание ошибки: ".mysqli_connect_error()."</p>";
    exit();
}

// Устанавливаем кодировку подключения
$mysqli->set_charset('windows-1251');

//Для удобства, добавим здесь переменную, которая будет содержать название нашего сайта
$address_site = "http://localhost/new_project";
?>