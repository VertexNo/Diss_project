<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 030 30.10.18
 * Time: 20:44
 */
//Добавляем файл подключения к БД
require_once("dbconnect.php");

if(isset($_POST["email"])) {

    $email =  trim($_POST["email"]);

    $email = htmlspecialchars($email, ENT_QUOTES);

    //Проверяем, нет ли уже такого адреса в БД.
    $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

    //Если кол-во полученных строк ровно единице, значит, пользователь с таким почтовым адресом уже зарегистрирован
    if($result_query->num_rows == 1){

        echo "<span class='mesage_error'>Пользователь с таким почтовым адресом уже зарегистрирован</span>";

    }else{
        echo "<span class='success_message'>Почтовый адрес свободен</span>";
    }

    // закрытие выборки
    $result_query->close();
}
?>