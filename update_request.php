<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:44
 */
//Запускаем сессию
require_once("dbconnect.php");
session_start();

//Добавляем файл подключения к БД


//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["error_messages"] = '';

//Объявляем ячейку для добавления успешных сообщений
$_SESSION["success_messages"] = '';

/*
        Проверяем была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
    */
if(isset($_POST["btn_update_request"]) && !empty($_POST["btn_update_request"])){

        /* Проверяем если в глобальном массиве $_POST существуют данные отправленные из формы и заключаем переданные данные в обычные переменные.*/

//Проверяем заголовок
    if(isset($_POST["caption"]) && strlen($_POST["caption"])>= 3 ){

        //Обрезаем пробелы с начала и с конца строки
        $caption = trim($_POST["caption"]);

        if(!empty($caption)){
            $caption = htmlspecialchars($caption, ENT_QUOTES);
        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите заголовок обращения. Заголовок не может быть меньше 3 символов</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

    }else{
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода заголовка</p>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //Останавливаем  скрипт
        exit();
    }


    //Проверяем краткое описание
    if(isset($_POST["short_description"]) && strlen($_POST["short_description"])>= 3){

        //Обрезаем пробелы с начала и с конца строки
        $short_description = trim($_POST["short_description"]);

        if(!empty($short_description)){
            $short_description = htmlspecialchars($short_description, ENT_QUOTES);
        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите краткое описание проблемы. Оно не может быть меньше 3 символов</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

    }else{
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода краткого описания проблемы</p>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //Останавливаем  скрипт
        exit();
    }

    //Проверяем описание
    if(isset($_POST["description"]) && strlen($_POST["description"])>= 3){

        //Обрезаем пробелы с начала и с конца строки
        $description = trim($_POST["description"]);

        if(!empty($description)){
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите описание проблемы. Оно не может быть меньше 3 символов</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

    }else{
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода описания проблемы</p>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //Останавливаем  скрипт
        exit();
    }

    //Проверяем описание
    if(isset($_POST["description"]) && strlen($_POST["description"])>= 3){

        //Обрезаем пробелы с начала и с конца строки
        $description = trim($_POST["description"]);

        if(!empty($description)){
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите описание проблемы. Оно не может быть меньше 3 символов</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

    }else{
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода описания проблемы</p>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //Останавливаем  скрипт
        exit();
    }
        //if ($mysqli->connect_errno) { die('Ошибка соединения: ' . $mysqli->connect_error); }else{echo 'Connect true';}

        $rolename = trim($_POST["option1"]);
        $rolename = htmlspecialchars($rolename, ENT_QUOTES);
        $result_query_Role_id = $mysqli->query("select Role_id from Roles where Role_name='".$rolename."'");
        $roleid = mysqli_fetch_assoc($result_query_Role_id);
        $resultroleid = $roleid['Role_id'];

        $organisation_name = trim($_POST["option2"]);
        $organisation_name = htmlspecialchars($organisation_name, ENT_QUOTES);
        $result_query_organisation_id = $mysqli->query("select id_organisation from organisations where organisation_name='".$organisation_name."'");
        $idorganisation = mysqli_fetch_assoc($result_query_organisation_id);
        $resultidorganisationid = $idorganisation['id_organisation'];
//Запрос на добавления пользователя в БД
        $result_query_insert = $mysqli->query("INSERT INTO `users` (first_name, last_name, email, password, fk_Role_id,fk_organisation_id) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."'," .$resultroleid.",".$resultidorganisationid.")");

        if(!$result_query_insert){
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем  скрипт
            exit();
        }else{

            $_SESSION["success_messages"] = "<p class='success_message'>Регистрация пользователя прошла успешно <br />Пользователь зарегистрирован</p>";

            /*//Отправляем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //Отправляем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");
        }

        /* Завершение запроса */
        $result_query_insert->close();

//Закрываем подключение к БД
        $mysqli->close();



}else{

    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
}
?>