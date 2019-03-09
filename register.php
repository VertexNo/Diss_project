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
if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){

    //Проверяем полученную капчу
//Обрезаем пробелы с начала и с конца строки
    $captcha = trim($_POST["captcha"]);

    if(isset($_POST["captcha"]) && !empty($captcha)){

        //Сравниваем полученное значение с значением из сессии.
        if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){

            // Если капча не верна, то возвращаем пользователя на страницу регистрации, и там выведем ему сообщение об ошибке что он ввёл неправильную капчу.
            $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>";

            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] = $error_message;

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем скрипт
            exit();
        }

        /* Проверяем если в глобальном массиве $_POST существуют данные отправленные из формы и заключаем переданные данные в обычные переменные.*/

        if(isset($_POST["first_name"])){

            //Обрезаем пробелы с начала и с конца строки
            $first_name = trim($_POST["first_name"]);

            //Проверяем переменную на пустоту
            if(!empty($first_name)){
                // Для безопасности, преобразуем специальные символы в HTML-сущности
                $first_name = htmlspecialchars($first_name, ENT_QUOTES);
            }else{
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваше имя</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //Останавливаем скрипт
                exit();
            }


        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с именем</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем скрипт
            exit();
        }


        if(isset($_POST["last_name"])){

            //Обрезаем пробелы с начала и с конца строки
            $last_name = trim($_POST["last_name"]);

            if(!empty($last_name)){
                // Для безопасности, преобразуем специальные символы в HTML-сущности
                $last_name = htmlspecialchars($last_name, ENT_QUOTES);
            }else{

                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Вашу фамилию</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //Останавливаем  скрипт
                exit();
            }


        }else{

            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с фамилией</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем  скрипт
            exit();
        }


        if(isset($_POST["email"])){

            //Обрезаем пробелы с начала и с конца строки
            $email = trim($_POST["email"]);

            if(!empty($email)){

                $email = htmlspecialchars($email, ENT_QUOTES);

                //Проверяем формат полученного почтового адреса с помощью регулярного выражения
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

//Если формат полученного почтового адреса не соответствует регулярному выражению
                if( !preg_match($reg_email, $email)){
                    // Сохраняем в сессию сообщение об ошибке.
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";

                    //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    //Останавливаем  скрипт
                    exit();
                }

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

//Если кол-во полученных строк ровно единице, значит пользователь с таким почтовым адресом уже зарегистрирован
                if($result_query->num_rows == 1){

                    //Если полученный результат не равен false
                    if(($row = $result_query->fetch_assoc()) != false){

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Пользователь с таким почтовым адресом уже зарегистрирован</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");

                    }else{
                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");
                    }

                    /* закрытие выборки */
                    $result_query->close();

                    //Останавливаем  скрипт
                    exit();
                }

                /* закрытие выборки */
                $result_query->close();

            }else{
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш email</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //Останавливаем  скрипт
                exit();
            }

        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода Email</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем  скрипт
            exit();
        }


        if(isset($_POST["password"]) && strlen($_POST["password"])>=6){
//echo $_POST["password"].length;
            //Обрезаем пробелы с начала и с конца строки
            $password = trim($_POST["password"]);

            if(!empty($password)){
                $password = htmlspecialchars($password, ENT_QUOTES);

                //Шифруем папроль
                $password = md5($password."top_secret");
            }else{
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш пароль. Пароль не может быть меньше 6 символов</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
               header("Location: ".$address_site."/form_register.php");

                //Останавливаем  скрипт
                exit();
            }

        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода пароля</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем  скрипт
            exit();
        }


        //Проверка на существование роли
        if(isset($_POST["option1"])){

            //Обрезаем пробелы с начала и с конца строки
            $role = trim($_POST["option1"]);

            if(!empty($role)){

                $role = htmlspecialchars($role, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("select Role_id from Roles where Role_name='".$role."'");

//Если кол-во полученных строк меньше единицы, значит такой роли нет
                if($result_query->num_rows < 1){

                    //Если полученный результат не равен false
                    if(($row = $result_query->fetch_assoc()) != false){

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Такой роли не существует!</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");

                    }else{
                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");
                    }

                    /* закрытие выборки */
                    $result_query->close();

                    //Останавливаем  скрипт
                    exit();
                }

                /* закрытие выборки */
                $result_query->close();

            }else{
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите роль пользователя</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //Останавливаем  скрипт
                exit();
            }

        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода роли</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем  скрипт
            exit();
        }

        //Проверка на существование организации
        if(isset($_POST["option2"])){

            //Обрезаем пробелы с начала и с конца строки
            $organisation = trim($_POST["option2"]);

            if(!empty($organisation)){

                $organisation = htmlspecialchars($organisation, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("select id_organisation from organisations where organisation_name='".$organisation."'");

//Если кол-во полученных строк меньше единицы, значит такой организации нет
                if($result_query->num_rows < 1){

                    //Если полученный результат не равен false
                    if(($row = $result_query->fetch_assoc()) != false){

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Такой организации не существует!</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");

                    }else{
                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");
                    }

                    /* закрытие выборки */
                    $result_query->close();

                    //Останавливаем  скрипт
                    exit();
                }

                /* закрытие выборки */
                $result_query->close();

            }else{
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите организацию пользователя</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //Останавливаем  скрипт
                exit();
            }

        }else{
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода Организации</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

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
         $result_query_insert = $mysqli->query("INSERT INTO `users` (first_name, last_name, email, password, fk_Role_id,fk_organisation_id, k3_new_employee, email_status) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."'," .$resultroleid.",".$resultidorganisationid.", 1, 1)");

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
        //Если капча не передана либо оно является пустой
        exit("<p><strong>Ошибка!</strong> Отсутствует проверечный код, то есть код капчи. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
    }

}else{

    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
}
?>