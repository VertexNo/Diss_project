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
        $organisation_name = addslashes($organisation_name);
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

        $EmailUserRespons = $userRespons;

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

        //оценка
        $evaluationname = trim($_POST["option5"]);
        $evaluationname = htmlspecialchars($evaluationname, ENT_QUOTES);
        $result_query_Evaluation_id = $mysqli->query("select evaluation_id,evaluation_name from request_performance_evaluation where evaluation_name='" .$evaluationname. "'");
        $evaluationid = mysqli_fetch_assoc($result_query_Evaluation_id);
        $resultEvaluationID = $evaluationid['evaluation_id'];




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


        /*Здесь нужно еще прописать установку дат при выборе статуса "в работе" (id = 2) и "решена" (id = 4)*/
        $date_start_work = $_POST["date_start_work"];
        $date_resolve = $_POST["date_resolve"];

        /*проверка, если они пустые, то просто null обратно проставляем*/
        if($date_start_work =='Не взята на исполнение' || $date_start_work == '0000-00-00 00:00:00')
        {
            $date_start_work = 'null';
        }
        if($date_resolve == 'Не решена' || $date_resolve == '0000-00-00 00:00:00')
        {
            $date_resolve = 'null';
        }

        /*проверка статусов. Если выбран соотв статус - ставим дату*/
        if($resultStatusID == 2)
        {
            $date_start_work = date("Y-m-d H:i:s");
            $date_resolve = 'null';
        }
        if($resultStatusID == 4)
        {
            $date_resolve = date("Y-m-d H:i:s");
        }

//Запрос на изменение обращения в БД



        $result_query_insert = $mysqli->query("update requests set caption='" . $caption . "', short_description='" . $short_description . "', description='" . $description . "', fk_responsible_user_id='" . $resultUserResponsID ."' , date_start_work='".$date_start_work."', date_resolve='".$date_resolve. "', fk_status_id='" . $resultStatusID . "', fk_priority_id='" . $resultPriorityID . "', fk_service_id='" . $resultServiceID . "', evaluation_id='" .$resultEvaluationID. "'  where request_id='" . $_POST["request_id"] . "'");

        /*коэффициенты для пользователя*/
        $User_isBusyIngeneer = null;
        $User_evaluationAverage = 0;
        $User_isNewIgneneer = 0;
        $User_distanceWork = null;
        $User_workTime = null;

        /*TODO: реализовать запись коэффициентов инженеров в зависимости от прогресса решения задач*/


        /*Проверяем есть ли еще открытые задачи помимо этой. Если есть - то не ставим признак свободного инженера*/
        $result_query_Count_open_requests = $mysqli->query("select count(Request_Id) as CountOpenRequests from requests where fk_status_ID in (2,3) and fk_responsible_user_id = '" . $resultUserResponsID . "' and Request_Id <> ".$_POST["request_id"]);
        $CountOpenRequests = mysqli_fetch_assoc($result_query_Count_open_requests);
        $resultCountOpenRequests = $CountOpenRequests['CountOpenRequests'];

        /*Если помимо этой задаче нет еще открытых задач, проверяем статус и ставим признак свободности / занятости инженера*/
        if($resultCountOpenRequests < 1) {
            switch ($resultStatusID) {
                case 0:
                    $User_isBusyIngeneer = null; //незизвестно
                case 1:
                    $User_isBusyIngeneer = null; //ожидает исполнения
                case 2:
                    $User_isBusyIngeneer = 1; //в работе
                case 3:
                    $User_isBusyIngeneer = 1; //Требует уточнения
                case 4:
                    $User_isBusyIngeneer = null; //Решена
                case 5:
                    $User_isBusyIngeneer = null; //закрыта
            }
        }
        else
        {
            $User_isBusyIngeneer = 1;
        }

        /*Рассчитываем новый коэффициент качества исполнения задач*/
        $result_query_QualityWork = $mysqli->query("select sum(request_performance_evaluation.evaluation_score)/count(Request_Id) as NewQualityWork from requests 
inner join request_performance_evaluation on requests.evaluation_id = request_performance_evaluation.evaluation_id
where fk_status_ID in (4,5) and fk_responsible_user_id = ".$resultUserResponsID);
        $CoefQualityWork = mysqli_fetch_assoc($result_query_QualityWork);
        $User_evaluationAverage = $CoefQualityWork['NewQualityWork'];

        /*Рассчитываем время исполнения последней / текущей заявки*/
        if($resultStatusID == 4)
        {
            $result_query_TimeWork = $mysqli->query("select TIMEDIFF(date_resolve,date_start_work) as TimeWork from requests 
where fk_status_ID in (4,5) and fk_responsible_user_id = ".$resultUserResponsID. " and request_id =".$_POST["request_id"]);
            $TimeWork = mysqli_fetch_assoc($result_query_TimeWork);
            $User_workTime = $TimeWork['TimeWork'];

           // $User_workTime = $date_resolve->diff( $date_start_work )->format("%h:%i:%s");



           // $User_workTime = $User_workTime -> format("H:i:s");
        }

        /*Рассчитываем расстояние до места исполнения заявки*/
        //TODO: Если статус в "ожидает исполнения" или "в работе" ставим километраж. Если другой статус - ставим Null.

        /*Если пользователи от одной организации то рассчитываем дистанцию. Т.к можем. Иначе - нет*/
        /*TODO: сделать проверку что юзер и инженер от одной организации*/

        //Ищем ID пользователя, создавшего заявку
        $result_query_user_create = $mysqli->query("select fk_create_user_id from requests
where request_id = ".$_POST["request_id"]);
        $UserCr = mysqli_fetch_assoc($result_query_user_create);
        $UserCreateID = $UserCr['fk_create_user_id'];


        $result_query_user_createEmail = $mysqli->query("select email from users
where user_id = ".$UserCreateID);
        $UserCrEmail = mysqli_fetch_assoc($result_query_user_createEmail);
        $UserCreateEmail = $UserCrEmail['email'];



        /*ищем расстояние от головного офиса для пользователя создавшего заявку (П1)*/
        $result_query_user_org = $mysqli->query("select fk_organisation_id from users
where user_id = ".$UserCreateID);
        $UserOrg = mysqli_fetch_assoc($result_query_user_org);
        $User_Organisation = $UserOrg['fk_organisation_id'];

        /*ищем расстояние от головного офиса для инженера, взявшего в работу заявку (И1)*/
        $result_query_ingener_org = $mysqli->query("select fk_organisation_id from users
where user_id = ".$resultUserResponsID);
        $IngenerOrg = mysqli_fetch_assoc($result_query_ingener_org);
        $Ingener_Organisation = $IngenerOrg['fk_organisation_id'];

        if($User_Organisation == $Ingener_Organisation)
        {
            if ($resultStatusID == 2 || $resultStatusID == 3)
            {
                /*ищем расстояние от головного офиса для пользователя создавшего заявку (П1)*/
                $result_query_user_distance = $mysqli->query("select mo_distance from users
inner join office on users.fk_office_id = office.office_id
where Users.User_id = " . $UserCreateID);
                $CoefUserDistance = mysqli_fetch_assoc($result_query_user_distance);
                $User_DistanceResult = $CoefUserDistance['mo_distance'];

                /*ищем расстояние от головного офиса для инженера, взявшего в работу заявку (И1)*/
                $result_query_ingener_distance = $mysqli->query("select mo_distance from users
inner join office on users.fk_office_id = office.office_id
where Users.User_id =" . $resultUserResponsID);
                $CoefIngenerDistance = mysqli_fetch_assoc($result_query_ingener_distance);
                $Ingener_DistanceResult = $CoefIngenerDistance['mo_distance'];

                /*TODO: рассчитываем расстояние: abs(Расстояние П1 -  Расстояние И1)*/
                $User_distanceWork = abs($User_DistanceResult - $Ingener_DistanceResult);
            }
            else
                {
                $k4_distance_work = null;
            }
        }


        /*Здесь обновление коэфициентов на новые*/
        $result_query_insert_user = $mysqli->query("update users set 	k1_busy_employee='" . $User_isBusyIngeneer . "', k2_quality_work='" . $User_evaluationAverage . "', k3_new_employee='" . $User_isNewIgneneer . "', k4_distance_work='" . $User_distanceWork ."' , k5_execution_time='".$User_workTime."'  where user_id='" . $resultUserResponsID . "'");


        if (!$result_query_insert) {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на изменение обращения в БД</p>";

            //Возвращаем пользователя на страницу обращений
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //Останавливаем  скрипт
            exit();
        } else {

            /*Сделать отправку письма о назначении заявки*/
            //$EmailUserResponse
            /*Отправка пьсма начало*/


            if(!empty($_POST["current_comment"]))
            {
                $Comment = "Добавлен комментарий: ".$_POST["current_comment"];
            }
            else $Comment="";

            $to = $EmailUserRespons;
            $subject = "Автоматическая отправка уведомлений об изменении заявок";
            $message = "Была изменена заявка с номером: ".$_POST["request_id"]."\nЗаголовком: ".$caption."\nКратким описанием: ".$short_description.
            "\nТекущий статус заявки: ".$statusname."\nТекущий приоритет заявки: ".$priorityname."\n".$Comment;
            $headers = "*************";
            mail ($to, $subject, $message, $headers);

            //Отправляем так же письмо пользователю, создавшему заявку $UserCreateEmail
            mail ($UserCreateEmail, $subject, $message, $headers);

            /*Отправка письма конец*/

            $_SESSION["success_messages"] = "<p class='success_message'>Данные изменены успешно <br /><br />Обращение №".$_POST["request_id"]." изменено</p>";

            /*//Отправляем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //Отправляем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_edit_request.php?request=".$_POST["request_id"]);
        }


        /*Логика по добавлению файлов*/

        // Название <input type="file">
        $input_name = 'file';

// Разрешенные расширения файлов.
        $allow = array();

// Запрещенные расширения файлов.
        $deny = array(
            'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
            'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
            'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
        );

// Директория куда будут загружаться файлы.
        $path = __DIR__ . '/uploads/';

        if (isset($_FILES[$input_name])) {
            // Проверим директорию для загрузки.
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
            $files = array();
            $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
            if ($diff == 0) {
                $files = array($_FILES[$input_name]);
            } else {
                foreach($_FILES[$input_name] as $k => $l) {
                    foreach($l as $i => $v) {
                        $files[$i][$k] = $v;
                    }
                }
            }

            foreach ($files as $file) {
                $error = $success = '';

                // Проверим на ошибки загрузки.
                if (!empty($file['error']) || empty($file['tmp_name'])) {
                    switch (@$file['error']) {
                        case 1:
                        case 2: $error = 'Превышен размер загружаемого файла.'; break;
                        case 3: $error = 'Файл был получен только частично.'; break;
                        case 4: $error = 'Файл не был загружен.'; break;
                        case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
                        case 7: $error = 'Не удалось записать файл на диск.'; break;
                        case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
                        case 9: $error = 'Файл не был загружен - директория не существует.'; break;
                        case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
                        case 11: $error = 'Данный тип файла запрещен.'; break;
                        case 12: $error = 'Ошибка при копировании файла.'; break;
                        default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
                    }
                } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл.';
                } else {
                    // Оставляем в имени файла только буквы, цифры и некоторые символы.
                    $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name = str_replace($pattern, '-', $file['name']);
                    $name = str_replace('[-]+', '-', $name);
                    $name = str_replace(' ', '_', $name);

                    // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
                    // Сделаем их транслит:
                    $converter = array(
                        'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
                        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
                        'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
                        'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
                        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
                        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

                        'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
                        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
                        'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
                        'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
                        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
                        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
                    );

                    $name = strtr($name, $converter);
                    $parts = pathinfo($name);

                    if (empty($name) || empty($parts['extension'])) {
                        $error = 'Недопустимое тип файла';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        $error = 'Недопустимый тип файла';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        $error = 'Недопустимый тип файла';
                    } else {
                        // Чтобы не затереть файл с таким же названием, добавим префикс.
                        $i = 0;
                        $prefix = '';
                        while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                            $prefix = '(' . ++$i . ')';
                        }
                        $name = $parts['filename'] . $prefix . '.' . $parts['extension'];

                        // Перемещаем файл в директорию.
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            // Далее можно сохранить название файла в БД и т.п.
                            $success = 'Файл «' . $name . '» успешно загружен.';
                        } else {
                            $error = 'Не удалось загрузить файл.';
                        }
                    }
                }

                // Выводим сообщение о результате загрузки.
                if (!empty($success)) {
                    $result_query_insert = $mysqli->query("insert into Attachments (attachment_id,attachment_url,attachment_name, fk_request_id)
values(null,'"."uploads/"."', '".$name . "', '" . $_POST["request_id"]."' )");
                } else {
                    echo '<p>' . $error . '</p>';
                }
            }
        }

        /*Логика по добавлению факлов конец*/

        /*Логика добавления комментов начало*/

        if(!empty($_POST["current_comment"]))
        {
            $result_query_insert = $mysqli->query("insert into comments (comment_id,comment_text,comment_date, rf_user_id, rf_request_id)
values(null,'".$_POST["current_comment"]."', '".date("Y-m-d H:i:s")."', '".$_SESSION['user_id']."', '" . $_POST["request_id"]."' )");
        }

        /*Логика добавления комментов конец*/




        /* Завершение запроса */
        $result_query_insert->close();

//Закрываем подключение к БД
        $mysqli->close();


    } else {

        exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=" . $address_site . "> главную страницу </a>.</p>");
    }
}
?>