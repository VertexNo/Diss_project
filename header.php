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
    <!--<link rel="stylesheet" type="text/css" href="css/styles.css">-->
    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            "use strict";
            //================ �������� email ==================

            //���������� ��������� ��� �������� email
            var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
            $('input[name=email]').blur(function(){

                if($(this).val() != ''){

                    // ���������, ���� ��������� email ������������� ����������� ���������
                    if($(this).val().search(pattern) == 0){

                        // ����� ��� �������� �������� ���� email �� ������, ����� Ajax
                        $.ajax({

                            // �������� �����, � ������� ����� ��������� email �� ������������� � ���� ������
                            url: "check_email.php",

                            // ����������� ����� ������� ����� �������� ������
                            type: "POST",

                            // ����������� � ������� JSON ����� ������ ����� ��������
                            data: {
                                email: $(this).val()
                            },

                            // ��� ����������� �������� �� ������� �������� �� �������.
                            dataType: "html",

                            // ������� ������� ����� ���������� ����� ��������� ������
                            beforeSend: function(){

                                $('#valid_email_message').text('�����������...');
                            },

                            // ������� ������� ����� ���������� ����� ���� ��� ��� ������ ����� ������� ��������.
                            success: function(data){

                                //���������� ����� �������� ������ ���� span
                                $('#valid_email_message').html(data);
                            }
                        });

                        //���������� ������ ��������
                        $('input[type=submit]').attr('disabled', false);
                    }else{
                        //������� ��������� �� ������
                        $('#valid_email_message').html('<span class="mesage_error mesage_error_auth">�� ���������� Email</span>');

                        // ������������� ������ ��������
                        $('input[type=submit]').attr('disabled', true);
                    }

                }else{
                    $('#valid_email_message').html('<span class="mesage_error mesage_error_auth">������� ��� email</span>');
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
    <ul>
        <li><a href="./index.php">�������</a></li>

    <div id="auth_block">
        <?php
        //��������� ����������� �� ������������
        if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
            // ���� ���, �� ������� ���� � �������� �� �������� ����������� � �����������
            ?>

            <li> <a href="./form_auth.php">�����������</a></li>

            <?php
        }else{
            //���� ������������ �����������, �� ������� ������ �����
            ?>
            <?php
            if(($_SESSION['fk_Role_id'])==1) {
                ?>

                    <li> <a href="./form_register.php">�����������</a></li>


                <?php
            }
                ?>
            <li><a href="./logout.php">�����</a></li>

            <?php
        }
        ?>
    </div>
    <div class="clear"></div>
</div>
