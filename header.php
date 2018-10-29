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
    <title>������� ������ � ��������� ���������</title>
    <meta charset="windows-1251">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            "use strict";
            //================ �������� email ==================

            //���������� ��������� ��� �������� email
            var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
            var mail = $('input[name=email]');

            mail.blur(function(){
                if(mail.val() != ''){

                    // ���������, ���� ��������� email ������������� ����������� ���������
                    if(mail.val().search(pattern) == 0){
                        // ������� ��������� �� ������
                        $('#valid_email_message').text('');

                        //���������� ������ ��������
                        $('input[type=submit]').attr('disabled', false);
                    }else{
                        //������� ��������� �� ������
                        $('#valid_email_message').text('�� ���������� Email');

                        // ������������� ������ ��������
                        $('input[type=submit]').attr('disabled', true);
                    }
                }else{
                    $('#valid_email_message').text('������� ��� email');
                }
            });

            //================ �������� ����� ������ ==================
            var password = $('input[name=password]');

            password.blur(function(){
                if(password.val() != ''){

                    //���� ����� ���������� ������ ������ ����� ��������, �� ������� ��������� �� ������
                    if(password.val().length < 6){
                        //������� ��������� �� ������
                        $('#valid_password_message').text('����������� ����� ������ 6 ��������');

                        // ������������� ������ ��������
                        $('input[type=submit]').attr('disabled', true);

                    }else{
                        // ������� ��������� �� ������
                        $('#valid_password_message').text('');

                        //���������� ������ ��������
                        $('input[type=submit]').attr('disabled', false);
                    }
                }else{
                    $('#valid_password_message').text('������� ������');
                }
            });
        });
    </script>
</head>
<body>

<div id="header">
    <h2>����� �����</h2>

    <a href="./index.php">�������</a>

    <div id="auth_block">
        <?php
        //��������� ����������� �� ������������
        if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
            // ���� ���, �� ������� ���� � �������� �� �������� ����������� � �����������
            ?>
            <div id="link_register">
                <a href="./form_register.php">�����������</a>
            </div>

            <div id="link_auth">
                <a href="./form_auth.php">�����������</a>
            </div>
            <?php
        }else{
            //���� ������������ �����������, �� ������� ������ �����
            ?>
            <div id="link_logout">
                <a href="./logout.php">�����</a>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="clear"></div>
</div>
