<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 22:07
 */
//Запускаем сессию
session_start();

unset($_SESSION["email"]);
unset($_SESSION["password"]);

unset($_SESSION['fk_Role_id'] );
unset($_SESSION['user_id'] );

unset($_SESSION['filter_requests'] );
unset($_SESSION['order_request_column_name'] );
unset($_SESSION['order_request_type'] );

unset($_SESSION['current_page'] );


/*Поля для простановки в шапку фильтрации*/
unset($_SESSION['filter_request_id'] );
unset($_SESSION['filter_caption_request'] );
unset($_SESSION['filter_short_description_request'] );
unset($_SESSION['filter_user_create_request'] );
unset($_SESSION['filter_user_response_request'] );

unset($_SESSION['filter_date_create_begin_request']);
unset($_SESSION['filter_date_create_end_request'] );

unset($_SESSION['filter_date_resolve_begin_request'] );
unset($_SESSION['filter_date_resolve_end_request'] );

// Возвращаем пользователя на ту страницу, на которой он нажал на кнопку выход.
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>