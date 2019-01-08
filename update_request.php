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
if(isset($_POST["reopen_request"]) && !empty($_POST["reopen_request"])){
    $result_query = $mysqli->query("update requests set fk_status_id = 1  where request_id='".$_POST["request_id"]."'");
    if (!$result_query) {
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на изменение пользователя в БД</p>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_register.php");

        //Останавливаем  скрипт
        exit();
    } else {

        $_SESSION["success_messages"] = "<p class='success_message'>Данные изменены успешно <br /><br />Обращение переоткрыто</p>";

        /*//Отправляем пользователя на страницу авторизации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_auth.php");*/

        //Отправляем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_request.php");
    }

    /* Завершение запроса */
    $result_query->close();


}
else {
    if (isset($_POST["btn_update_request"]) && !empty($_POST["btn_update_request"])) {

        /* Проверяем если в глобальном массиве $_POST существуют данные отправленные из формы и заключаем переданные данные в обычные переменные.*/

//Проверяем заголовок
        if (isset($_POST["caption"]) && strlen($_POST["caption"]) >= 3) {

            //Обрезаем пробелы с начала и с конца строки
            $caption = trim($_POST["caption"]);

            if (!empty($caption)) {
                $caption = htmlspecialchars($caption, ENT_QUOTES);
            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите заголовок обращения. Заголовок не может быть меньше 3 символов</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода заголовка</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }


        //Проверяем краткое описание
        if (isset($_POST["short_description"]) && strlen($_POST["short_description"]) >= 3) {

            //Обрезаем пробелы с начала и с конца строки
            $short_description = trim($_POST["short_description"]);

            if (!empty($short_description)) {
                $short_description = htmlspecialchars($short_description, ENT_QUOTES);
            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите краткое описание проблемы. Оно не может быть меньше 3 символов</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода краткого описания проблемы</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

        //Проверяем описание
        if (isset($_POST["description"]) && strlen($_POST["description"]) >= 3) {

            //Обрезаем пробелы с начала и с конца строки
            $description = trim($_POST["description"]);

            if (!empty($description)) {
                $description = htmlspecialchars($description, ENT_QUOTES);
            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите описание проблемы. Оно не может быть меньше 3 символов</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода описания проблемы</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

        //Проверяем описание
        if (isset($_POST["description"]) && strlen($_POST["description"]) >= 3) {

            //Обрезаем пробелы с начала и с конца строки
            $description = trim($_POST["description"]);

            if (!empty($description)) {
                $description = htmlspecialchars($description, ENT_QUOTES);
            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите описание проблемы. Оно не может быть меньше 3 символов</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода описания проблемы</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

        //Проверка на существование статуса
        if (isset($_POST["option1"])) {

            //Обрезаем пробелы с начала и с конца строки
            $status = trim($_POST["option1"]);

            if (!empty($status)) {

                $status = htmlspecialchars($status, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("select status_id,status_name from status where status_name='" . $status . "'");

//Если кол-во полученных строк меньше единицы, значит такого статуса нет
                if ($result_query->num_rows < 1) {

                    //Если полученный результат не равен false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Такого статуса не существует!</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* закрытие выборки */
                    $result_query->close();

                    //Останавливаем  скрипт
                    exit();
                }

                /* закрытие выборки */
                $result_query->close();

            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите статус обращения</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует выбранный статус для установки в обращение</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

        //Проверка на существование приоритета
        if (isset($_POST["option2"])) {

            //Обрезаем пробелы с начала и с конца строки
            $priority = trim($_POST["option2"]);

            if (!empty($priority)) {

                $priority = htmlspecialchars($priority, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("select priority_id,priority_name from priority where priority_name='" . $priority . "'");

//Если кол-во полученных строк меньше единицы, значит такого приоритета нет
                if ($result_query->num_rows < 1) {

                    //Если полученный результат не равен false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Такого приоритета не существует!</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* закрытие выборки */
                    $result_query->close();

                    //Останавливаем  скрипт
                    exit();
                }

                /* закрытие выборки */
                $result_query->close();

            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите приоритет обращения</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует выбранный приоритет для установки в обращение</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

        //Проверка на существование пользователя
        if (isset($_POST["option3"])) {

            //Обрезаем пробелы с начала и с конца строки
            $user = trim($_POST["option3"]);

            if (!empty($user)) {

                $user = htmlspecialchars($user, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
//
                //поиск сначала значений в скобках, потом берем email регулярками
                $user = preg_match_all("/\(([^()]*)\)/", $user, $matches);
                $user = $matches[0][0];
                $user = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $user, $matches2);
                $user = $matches2[0][0];

                $result_query = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and email ='" . $user . "'");

//Если кол-во полученных строк меньше единицы, значит такого email нет
                if ($result_query->num_rows < 1) {

                    //Если полученный результат не равен false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Пользователя стаким email не существует!</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* закрытие выборки */
                    $result_query->close();

                    //Останавливаем  скрипт
                    exit();
                }

                /* закрытие выборки */
                $result_query->close();

            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите исполнителя обращения</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует выбранный пользователь</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

        //Проверка на существование типа услуги
        if (isset($_POST["option4"])) {

            //Обрезаем пробелы с начала и с конца строки
            $service = trim($_POST["option4"]);

            if (!empty($service)) {

                $service = htmlspecialchars($service, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("select service_id,service_name,fk_service_id from service where service_name='" . $service . "'");

//Если кол-во полученных строк меньше единицы, значит такого пункта услуг нет
                if ($result_query->num_rows < 1) {

                    //Если полученный результат не равен false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Такого типа проблемы не существует!</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";

                        //Возвращаем пользователя на страницу регистрации
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* закрытие выборки */
                    $result_query->close();

                    //Останавливаем  скрипт
                    exit();
                }

                /* закрытие выборки */
                $result_query->close();

            } else {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите тип приоблемы для обращения</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует выбранный тип обращения для установки</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }
        //if ($mysqli->connect_errno) { die('Ошибка соединения: ' . $mysqli->connect_error); }else{echo 'Connect true';}


        $rolename = trim($_POST["option1"]);
        $rolename = htmlspecialchars($rolename, ENT_QUOTES);
        $result_query_Role_id = $mysqli->query("select Role_id from Roles where Role_name='" . $rolename . "'");
        $roleid = mysqli_fetch_assoc($result_query_Role_id);
        $resultroleid = $roleid['Role_id'];

        $organisation_name = trim($_POST["option2"]);
        $organisation_name = htmlspecialchars($organisation_name, ENT_QUOTES);
        $result_query_organisation_id = $mysqli->query("select id_organisation from organisations where organisation_name='" . $organisation_name . "'");
        $idorganisation = mysqli_fetch_assoc($result_query_organisation_id);
        $resultidorganisationid = $idorganisation['id_organisation'];


        //формирование данных для записи в бд
        //заголовок
        $caption = trim($_POST["caption"]);
        $caption = htmlspecialchars($caption, ENT_QUOTES);

        //краткое описание
        $short_description = trim($_POST["short_description"]);
        $short_description = htmlspecialchars($short_description, ENT_QUOTES);

        //описание
        $description = trim($_POST["description"]);
        $description = htmlspecialchars($description, ENT_QUOTES);

        //исполнитель (поиск EMAIL такое же добавить)
        $userRespons = trim($_POST["option3"]);
        $userRespons = htmlspecialchars($userRespons, ENT_QUOTES);

        //поиск сначала значений в скобках, потом берем email регулярками
        $userRespons = preg_match_all("/\(([^()]*)\)/", $userRespons, $matches);
        $userRespons = $matches[0][0];
        $userRespons = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $userRespons, $matches2);
        $userRespons = $matches2[0][0];

        $result_query_userRespons = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 
and fk_role_id =2 and email='" . $userRespons . "'");
        $userResponsID = mysqli_fetch_assoc($result_query_userRespons);
        $resultUserResponsID = $userResponsID['user_id'];

        //статус
        $statusname = trim($_POST["option1"]);
        $statusname = htmlspecialchars($statusname, ENT_QUOTES);
        $result_query_Status_id = $mysqli->query("select status_id,status_name from status where status_iD >0 and status_name='" . $statusname . "'");
        $statusid = mysqli_fetch_assoc($result_query_Status_id);
        $resultStatusID = $statusid['status_id'];

        //приоритет
        $priorityname = trim($_POST["option2"]);
        $priorityname = htmlspecialchars($priorityname, ENT_QUOTES);
        $result_query_Priority_id = $mysqli->query("select priority_id,priority_name from priority where priority_id >0 and priority_name='" . $priorityname . "'");
        $priorityid = mysqli_fetch_assoc($result_query_Priority_id);
        $resultPriorityID = $priorityid['priority_id'];

        //тип обращения / услуги
        $servicename = trim($_POST["option4"]);
        $servicename = htmlspecialchars($servicename, ENT_QUOTES);
        $result_query_Service_id = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0 and service_name='" . $servicename . "'");
        $serviceid = mysqli_fetch_assoc($result_query_Service_id);
        $resultServiceID = $serviceid['service_id'];

//Запрос на изменение обращения в БД
        $result_query_insert = $mysqli->query("update requests set caption='" . $caption . "', short_description='" . $short_description . "', description='" . $description . "', fk_responsible_user_id='" . $resultUserResponsID . "', fk_status_id='" . $resultStatusID . "', fk_priority_id='" . $resultPriorityID . "', fk_service_id='" . $resultServiceID . "'  where request_id='" . $_POST["request_id"] . "'");

        if (!$result_query_insert) {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на изменение пользователя в БД</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Останавливаем  скрипт
            exit();
        } else {

            $_SESSION["success_messages"] = "<p class='success_message'>Данные изменены успешно <br /><br />Обращение изменено</p>";

            /*//Отправляем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //Отправляем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");
        }

        /* Завершение запроса */
        $result_query_insert->close();

//Закрываем подключение к БД
        $mysqli->close();


    } else {

        exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=" . $address_site . "> главную страницу </a>.</p>");
    }
}
?>