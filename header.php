<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:28
 */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Система подачи и обработки обращений</title>
    <meta charset="windows-1251">
    <!--<link rel="stylesheet" type="text/css" href="css/styles.css">-->
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            "use strict";
            //================ Проверка email ==================

            //регулярное выражение для проверки email
            var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
            $('input[name=email]').blur(function(){

                if($(this).val() != ''){

                    // Проверяем, если введенный email соответствует регулярному выражению
                    if($(this).val().search(pattern) == 0){

                        // Место для отправки значения поля email на сервер, через Ajax
                        $.ajax({

                            // Название файла, в котором будем проверять email на существование в базе данных
                            url: "check_email.php",

                            // Указывываем каким методом будут переданы данные
                            type: "POST",

                            // Указывываем в формате JSON какие данные нужно передать
                            data: {
                                email: $(this).val()
                            },

                            // Тип содержимого которого мы ожидаем получить от сервера.
                            dataType: "html",

                            // Функция которая будет выполнятся перед отправкой данных
                            beforeSend: function(){

                                $('#valid_email_message').text('Проверяется...');
                            },

                            // Функция которая будет выполнятся после того как все данные будут успешно получены.
                            success: function(data){

                                //Полученный ответ помещаем внутри тега span
                                $('#valid_email_message').html(data);
                            }
                        });

                        //Активируем кнопку отправки
                        $('input[type=submit]').attr('disabled', false);
                    }else{
                        //Выводим сообщение об ошибке
                        $('#valid_email_message').html('<span class="mesage_error mesage_error_auth">Не правильный Email</span>');

                        // Дезактивируем кнопку отправки
                        $('input[type=submit]').attr('disabled', true);
                    }

                }else{
                    $('#valid_email_message').html('<span class="mesage_error mesage_error_auth">Введите Ваш email</span>');
                }
            });

            //================ Проверка длины пароля ==================
            var password = $('input[name=password]');

            password.blur(function(){
                if(password.val() != ''){

                    //Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
                    if(password.val().length < 6){
                        //Выводим сообщение об ошибке
                        $('#valid_password_message').text('Минимальная длина пароля 6 символов');

                        // Дезактивируем кнопку отправки
                        $('input[type=submit]').attr('disabled', true);


                    }else{
                        // Убираем сообщение об ошибке
                        $('#valid_password_message').text('');

                        //Активируем кнопку отправки
                        $('input[type=submit]').attr('disabled', false);
                    }
                }else{
                    $('#valid_password_message').text('Введите пароль');
                }
            });

            //================ Проверка длины заголовка обращения ==================
            var caption = $('input[name=caption]');

            caption.blur(function(){
                if(caption.val() != ''){

                    //Если длина введенного заголовка меньше 3 символов, то выводим сообщение об ошибке
                    if(caption.val().length < 3){
                        //Выводим сообщение об ошибке
                        $('#valid_caption_message').text('Минимальная длина заголовка 3 символа');

                        // Дезактивируем кнопку отправки
                        $('button[type=submit]').attr('disabled', true);

                    }else{
                        // Убираем сообщение об ошибке
                        $('#valid_caption_message').text('');

                        //Активируем кнопку отправки
                        $('button[type=submit]').attr('disabled', false);
                    }
                }else{
                    $('#valid_caption_message').text('Введите заголовок');
                }
            });

            //================ Проверка длины краткого описания проблемы обращения ==================
            var short_description = $('input[name=short_description]');

            short_description.blur(function(){
                if(short_description.val() != ''){

                    //Если длина введенного заголовка меньше 3 символов, то выводим сообщение об ошибке
                    if(short_description.val().length < 3){
                        //Выводим сообщение об ошибке
                        $('#valid_short_description_message').text('Минимальная длина краткого описания проблемы - 3 символа');

                        // Дезактивируем кнопку отправки
                        $('button[type=submit]').attr('disabled', true);

                    }else{
                        // Убираем сообщение об ошибке
                        $('#valid_short_description_message').text('');

                        //Активируем кнопку отправки
                        $('button[type=submit]').attr('disabled', false);
                    }
                }else{
                    $('#valid_short_description_message').text('Введите краткое описание проблемы');
                }
            });

            //================ Проверка длины описания проблемы обращения ==================
            var description = $('input[name=description]');

            description.blur(function(){
                if(description.val() != ''){

                    //Если длина введенного заголовка меньше 3 символов, то выводим сообщение об ошибке
                    if(description.val().length < 3){
                        //Выводим сообщение об ошибке
                        $('#valid_description_message').text('Минимальная длина описания проблемы - 3 символа');

                        // Дезактивируем кнопку отправки
                        $('button[type=submit]').attr('disabled', true);

                    }else{
                        // Убираем сообщение об ошибке
                        $('#valid_description_message').text('');

                        //Активируем кнопку отправки
                        $('input[type=submit]').attr('disabled', false);
                    }
                }else{
                    $('#valid_description_message').text('Введите описание проблемы');
                }
            });
        });
    </script>
</head>
<body>

<div id="header">
    <ul>
        <li><a href="./index.php">Главная</a></li>


        <?php
        //Проверяем авторизован ли пользователь
        if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
            // если нет, то выводим блок с ссылками на страницу регистрации и авторизации
            ?>
            <div id="auth_block">
            <li> <a href="./form_auth.php">Авторизация</a></li>

            <?php
        }else{
            //Если пользователь авторизован, то выводим ссылку Выход
            ?>
                <li> <a href="./form_request.php">Обращения</a></li>
                <div id="auth_block">
            <?php
            if(($_SESSION['fk_Role_id'])==1) {
                ?>

                    <li> <a href="./form_register.php">Регистрация нового пользователя</a></li>


                <?php
            }
                ?>
            <li><a href="./logout.php">Выход</a></li>

            <?php
        }
        ?>
    </div>
    <div class="clear"></div>
</div>
    </ul>
</div>
</body>
