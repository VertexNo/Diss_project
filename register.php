<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:44
 */
//��������� ������
session_start();

//��������� ���� ����������� � ��
require_once("dbconnect.php");

//��������� ������ ��� ���������� ������, ������� ����� ���������� ��� ��������� �����.
$_SESSION["error_messages"] = '';

//��������� ������ ��� ���������� �������� ���������
$_SESSION["success_messages"] = '';

/*
        ��������� ���� �� ���������� �����, �� ���� ���� �� ������ ������ ������������������. ���� ��, �� ��� ������, ���� ���, �� ������� ������������ ��������� �� ������, � ��� ��� �� ����� �� ��� �������� ��������.
    */
if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){

    //��������� ���������� �����
//�������� ������� � ������ � � ����� ������
    $captcha = trim($_POST["captcha"]);

    if(isset($_POST["captcha"]) && !empty($captcha)){

        //���������� ���������� �������� � ��������� �� ������.
        if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){

            // ���� ����� �� �����, �� ���������� ������������ �� �������� �����������, � ��� ������� ��� ��������� �� ������ ��� �� ��� ������������ �����.
            $error_message = "<p class='mesage_error'><strong>������!</strong> �� ����� ������������ ����� </p>";

            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] = $error_message;

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //������������� ������
            exit();
        }

        /* ��������� ���� � ���������� ������� $_POST ���������� ������ ������������ �� ����� � ��������� ���������� ������ � ������� ����������.*/

        if(isset($_POST["first_name"])){

            //�������� ������� � ������ � � ����� ������
            $first_name = trim($_POST["first_name"]);

            //��������� ���������� �� �������
            if(!empty($first_name)){
                // ��� ������������, ����������� ����������� ������� � HTML-��������
                $first_name = htmlspecialchars($first_name, ENT_QUOTES);
            }else{
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ���� ���</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //������������� ������
                exit();
            }


        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� � ������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //������������� ������
            exit();
        }


        if(isset($_POST["last_name"])){

            //�������� ������� � ������ � � ����� ������
            $last_name = trim($_POST["last_name"]);

            if(!empty($last_name)){
                // ��� ������������, ����������� ����������� ������� � HTML-��������
                $last_name = htmlspecialchars($last_name, ENT_QUOTES);
            }else{

                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ���� �������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //�������������  ������
                exit();
            }


        }else{

            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� � ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //�������������  ������
            exit();
        }


        if(isset($_POST["email"])){

            //�������� ������� � ������ � � ����� ������
            $email = trim($_POST["email"]);

            if(!empty($email)){

                $email = htmlspecialchars($email, ENT_QUOTES);

                //��������� ������ ����������� ��������� ������ � ������� ����������� ���������
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

//���� ������ ����������� ��������� ������ �� ������������� ����������� ���������
                if( !preg_match($reg_email, $email)){
                    // ��������� � ������ ��������� �� ������.
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >�� ����� ������������ email</p>";

                    //���������� ������������ �� �������� �����������
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    //�������������  ������
                    exit();
                }

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

//���� ���-�� ���������� ����� ����� �������, ������ ������������ � ����� �������� ������� ��� ���������������
                if($result_query->num_rows == 1){

                    //���� ���������� ��������� �� ����� false
                    if(($row = $result_query->fetch_assoc()) != false){

                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������������ � ����� �������� ������� ��� ���������������</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");

                    }else{
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");
                    }

                    /* �������� ������� */
                    $result_query->close();

                    //�������������  ������
                    exit();
                }

                /* �������� ������� */
                $result_query->close();

            }else{
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ��� email</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //�������������  ������
                exit();
            }

        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� Email</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //�������������  ������
            exit();
        }


        if(isset($_POST["password"])){

            //�������� ������� � ������ � � ����� ������
            $password = trim($_POST["password"]);

            if(!empty($password)){
                $password = htmlspecialchars($password, ENT_QUOTES);

                //������� �������
                $password = md5($password."top_secret");
            }else{
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ��� ������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //�������������  ������
                exit();
            }

        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� ������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //�������������  ������
            exit();
        }

//������ �� ���������� ������������ � ��
        $result_query_insert = $mysqli->query("INSERT INTO `users` (first_name, last_name, email, password) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."')");

        if(!$result_query_insert){
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� ���������� ������������ � ��</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //�������������  ������
            exit();
        }else{

            $_SESSION["success_messages"] = "<p class='success_message'>����������� ������������ ������ ������� <br />������������ ���������������</p>";

            /*//���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");
        }

        /* ���������� ������� */
        $result_query_insert->close();

//��������� ����������� � ��
        $mysqli->close();

    }else{
        //���� ����� �� �������� ���� ��� �������� ������
        exit("<p><strong>������!</strong> ����������� ����������� ���, �� ���� ��� �����. �� ������ ������� �� <a href=".$address_site."> ������� �������� </a>.</p>");
    }

}else{

    exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=".$address_site."> ������� �������� </a>.</p>");
}
?>