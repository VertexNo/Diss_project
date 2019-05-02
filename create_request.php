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
if(isset($_POST["cancel_request"]) && !empty($_POST["cancel_request"])){

    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $address_site . "/form_request.php");
}
else {
    if (isset($_POST["btn_create_request"]) && !empty($_POST["btn_create_request"])) {

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
        if (isset($_POST["fk_status_id"])) {

            //Обрезаем пробелы с начала и с конца строки
            $status = trim($_POST["fk_status_id"]);

            if (!empty($status)) {

                $status = htmlspecialchars($status, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("select status_id,status_name from status where status_id='" . $status . "'");

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

        /*111*/
        //Проверка на существование создателя - пользователя
        if (isset($_POST["fk_create_user_id"])) {

            //Обрезаем пробелы с начала и с конца строки
            $user = trim($_POST["fk_create_user_id"]);

            if (!empty($user)) {

                $user = htmlspecialchars($user, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.//


                $result_query = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and user_id ='" . $user . "'");

//Если кол-во полученных строк меньше единицы, значит такого email нет
                if ($result_query->num_rows < 1) {

                    //Если полученный результат не равен false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // Сохраняем в сессию сообщение об ошибке.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Такого пользователя, под которым создается обращение не существует!</p>";

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
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите создателя обращения</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует создатель / пользователь</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        }

        /*111*/

        //Проверка на существование ИСПОЛНИТЕЛЯ - пользователя
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


        //Проверка на существование статуса
        if (isset($_POST["fk_status_id"])) {

            //Обрезаем пробелы с начала и с конца строки
            $status = trim($_POST["fk_status_id"]);

            if (!empty($status)) {

                $status = htmlspecialchars($status, ENT_QUOTES);

//Проверяем нет ли уже такого адреса в БД.
                $result_query = $mysqli->query("select status_id,status_name from status where status_id='" . $status . "'");

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
        //if ($mysqli->connect_errno) { die('Ошибка соединения: ' . $mysqli->connect_error); }else{echo 'Connect true';}



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

        //создатель (поиск EMAIL такое же добавить)
        $userCreate = trim($_POST["fk_create_user_id"]);
        $userCreate = htmlspecialchars($userCreate, ENT_QUOTES);

        //исполнитель (поиск EMAIL такое же добавить)
        $userRespons = trim($_POST["option3"]);
        $userRespons = htmlspecialchars($userRespons, ENT_QUOTES);

        //поиск сначала значений в скобках, потом берем email регулярками
        $userRespons = preg_match_all("/\(([^()]*)\)/", $userRespons, $matches);
        $userRespons = $matches[0][0];
        $userRespons = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $userRespons, $matches2);
        $userRespons = $matches2[0][0];

        $EmailUserResponse = $userRespons;

        $result_query_userRespons = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 
and fk_role_id =2 and email='" . $userRespons . "'");
        $userResponsID = mysqli_fetch_assoc($result_query_userRespons);
        $resultUserResponsID = $userResponsID['user_id'];

        //дата создания
        $dateCreate = trim($_POST["date_create"]);

        //статус
        $statusid = trim($_POST["fk_status_id"]);

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

        //Тип распределния задачи относительно исполнителей
        $methodname = trim($_POST["option5"]);
        $methodname = htmlspecialchars($methodname, ENT_QUOTES);
        $result_query_method_id = $mysqli->query("select method_id,method_name from methods_set_responsible where method_id >0 and method_name='" . $methodname . "'");
        $methodid = mysqli_fetch_assoc($result_query_method_id);
        $resultMethodID = $methodid['method_id'];


        //Основная логика по распределению заявок на инженеров (метод Монте-Карло + стопка книг)*********************
        //$resultUserResponsID -> Текущий выбранный желаемый исполнитель
        $SelectedResponsible = $resultUserResponsID;


        //Определяем тип распределения
        switch ($resultMethodID)
        {
            case 1:
                {
                    //мой метод с коэффициентами
                    $queryResponsible = $mysqli->query("
       select t.user_id as MostOptimalResponsible, t.koef as Koefitient from (
select user_id,count(request_id) as CountResolvedRequests,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime,sum(request_performance_evaluation.evaluation_score)/count(request_id) as AverageEvaluattion,
(count(request_id)*sum(request_performance_evaluation.evaluation_score)/count(request_id))/TIME_TO_SEC(SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id))) as koef
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
inner join request_performance_evaluation on request_performance_evaluation.evaluation_id = requests.evaluation_id
inner join service on service.service_id = requests.fk_service_id
and requests.fk_service_id =".$resultServiceID."
and requests.fk_status_id = 5
group by user_id
order by koef desc) t
 LIMIT 0,1");

                    if($queryResponsible != null)
                    {
                        $CalculatedOptimalResponsible = mysqli_fetch_assoc($queryResponsible);
                        $OptimalResponsibleID = $CalculatedOptimalResponsible['MostOptimalResponsible'];

                        if($OptimalResponsibleID != null){
                            $resultUserResponsID = $OptimalResponsibleID;
                        }
                    }
                }break;
            case 2:
                {
//Метод монте-карло
                    $queryResponsible = $mysqli->query("
       select user_id,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
and requests.fk_status_id = 5
group by user_id
order by AverageExecutionTime asc
");


                    if($queryResponsible != null)
                    {
                        $result_query_num_Responsible = mysqli_num_rows($queryResponsible);

                        $result = array();
                        //Берем только первую половину записей (выше среднего)
                        for ($i=0; $i <($result_query_num_Responsible/2)-1; $i++)
                        {
                            $row = mysqli_fetch_array($queryResponsible);
                            $result[] = $row["user_id"];
                        }

                        //Берем рандомного инженера
                        $rand_userResp = array_rand($result,1);

                        //заносим данного рандомного инженера в UserResp
                        $OptimalResponsibleID = $result[$rand_userResp];





                        if($OptimalResponsibleID != null){
                            $resultUserResponsID = $OptimalResponsibleID;
                        }
                    }
                }break;
            case 3:
                {
                    $resultUserResponsID = $SelectedResponsible;
                }
            default:
                {

                }break;
        }


       /*
       //мой метод с коэффициентами
       $queryResponsible = $mysqli->query("
       select t.user_id as MostOptimalResponsible, t.koef as Koefitient from (
select user_id,count(request_id) as CountResolvedRequests,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime,sum(request_performance_evaluation.evaluation_score)/count(request_id) as AverageEvaluattion,
(count(request_id)*sum(request_performance_evaluation.evaluation_score)/count(request_id))/TIME_TO_SEC(SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id))) as koef
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
inner join request_performance_evaluation on request_performance_evaluation.evaluation_id = requests.evaluation_id
inner join service on service.service_id = requests.fk_service_id
and requests.fk_service_id =".$resultServiceID."
and requests.fk_status_id = 5
group by user_id
order by koef desc) t
 LIMIT 0,1");

        if($queryResponsible != null)
        {
            $CalculatedOptimalResponsible = mysqli_fetch_assoc($queryResponsible);
            $OptimalResponsibleID = $CalculatedOptimalResponsible['MostOptimalResponsible'];

            if($OptimalResponsibleID != null){
                $resultUserResponsID = $OptimalResponsibleID;
            }
        }

       */


       //Метод монте-карло
       /* $queryResponsible = $mysqli->query("
       select user_id,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
and requests.fk_status_id = 5
group by user_id
order by AverageExecutionTime asc
");


        if($queryResponsible != null)
        {
            $result_query_num_Responsible = mysqli_num_rows($queryResponsible);

            $result = array();
            //Берем только первую половину записей (выше среднего)
            for ($i=0; $i <($result_query_num_Responsible/2)-1; $i++)
            {
                $row = mysqli_fetch_array($queryResponsible);
                $result[] = $row["user_id"];
            }

            //Берем рандомного инженера
            $rand_userResp = array_rand($result,1);

            //заносим данного рандомного инженера в UserResp
            $OptimalResponsibleID = $result[$rand_userResp];





            if($OptimalResponsibleID != null){
                $resultUserResponsID = $OptimalResponsibleID;
            }
        }*/







        //Конец логики распределения заявок*********************************




//Запрос на создание обращения в БД
        $result_query_insert = $mysqli->query("insert into requests (request_id,caption,short_description, description,
fk_create_user_id, fk_responsible_user_id, date_create, fk_status_id, fk_priority_id, fk_service_id) values(null,'" . $caption . "', '" . $short_description . "', '" . $description ."' , '".$userCreate . "', '" . $resultUserResponsID ."','".$dateCreate. "', '" . $statusid . "', '" . $resultPriorityID . "', '" . $resultServiceID . "' )");

        if (!$result_query_insert) {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на создание обращения в БД</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Останавливаем  скрипт
            exit();
        } else {

            /*Сделать отправку письма о назначении заявки*/
            //$EmailUserResponse
            /*Отправка пьсма начало*/
            //тип обращения / услуги
            $createUserTemp = trim($_POST["fk_create_user_id"]);
            $createUserTemp = htmlspecialchars($createUserTemp, ENT_QUOTES);
            $result_query_CreateUserName = $mysqli->query("select first_name,last_name,email from users where user_id='" . $userCreate . "'");
            $UserCreateResult = mysqli_fetch_assoc($result_query_CreateUserName);
            $resultUserCreateData = $UserCreateResult['first_name']." ".$UserCreateResult['last_name']."(Email:".$UserCreateResult['email']. ")";



            $to = $EmailUserResponse;
            $subject = "Автоматическая отправка уведомлений о назначении заявки";
            $message = "Вам была назначена заявка: ".$caption."\nC кратким описанием: ".$short_description."\nДата создания заявки: ".$dateCreate.
            "\nПриоритет заявки:" .$priorityname."\nТип обращения: ".$servicename.
            "\nОбратившийся пользоваетль: ".$resultUserCreateData;
            $headers = "notification create requests";
            mail ($to, $subject, $message, $headers);

            /*Отправка письма конец*/


            $_SESSION["success_messages"] = "<p class='success_message'>Обращение создано успешно <br /><br />Обращение создано</p>";

            /*//Отправляем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //Отправляем пользователя на страницу обращений
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