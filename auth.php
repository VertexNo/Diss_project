<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 22:00
 */
//��������� ������
session_start();

//��������� ���� ����������� � ��
require_once("dbconnect.php");
//��������� ������ ��� ���������� ������, ������� ����� ���������� ��� ��������� �����.
$_SESSION["error_messages"] = '';

//��������� ������ ��� ���������� �������� ���������
$_SESSION["success_messages"] = '';
ini_set('session.bug_compat_warn', 0);
/*
    ��������� ���� �� ���������� �����, �� ���� ���� �� ������ ������ �����. ���� ��, �� ��� ������, ���� ���, �� ������� ������������ ��������� �� ������, � ��� ��� �� ����� �� ��� �������� ��������.
*/
if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){

    //��������� ���������� �����
    if(isset($_POST["captcha"])){

        //�������� ������� � ������ � � ����� ������
        $captcha = trim($_POST["captcha"]);

        if(!empty($captcha)){

            //���������� ���������� �������� � ��������� �� ������.
            if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){

                // ���� ����� �� �����, �� ���������� ������������ �� �������� �����������, � ��� ������� ��� ��������� �� ������ ��� �� ��� ������������ �����.

                $error_message = "<p class='mesage_error'><strong>������!</strong> �� ����� ������������ ����� </p>";

                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] = $error_message;

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_auth.php");

                //������������� ������
                exit();
            }

        }else{

            $error_message = "<p class='mesage_error'><strong>������!</strong> ���� ��� ����� ����� �� ������ ���� ������. </p>";

            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] = $error_message;

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");

            //������������� ������
            exit();

        }

        //�������� ������� � ������ � � ����� ������
        $email = trim($_POST["email"]);
        if(isset($_POST["email"])){

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
                    header("Location: ".$address_site."/form_auth.php");

                    //������������� ������
                    exit();
                }
            }else{
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >���� ��� ����� ��������� ������(email) �� ������ ���� ������.</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //������������� ������
                exit();
            }


        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >����������� ���� ��� ����� Email</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");

            //������������� ������
            exit();
        }

        if(isset($_POST["password"])){

            //�������� ������� � ������ � � ����� ������
            $password = trim($_POST["password"]);

            if(!empty($password)){
                $password = htmlspecialchars($password, ENT_QUOTES);

                //������� ������
                $password = md5($password."top_secret");
            }else{
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >������� ��� ������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_auth.php");

                //������������� ������
                exit();
            }

        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >����������� ���� ��� ����� ������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");

            //������������� ������
            exit();
        }
        //������ � �� �� ������� ������������.
        $result_query_select = $mysqli->query("SELECT * FROM `users` WHERE email_status =1 AND email = '".$email."' AND password = '".$password."'");

        if(!$result_query_select){
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� ������� ������������ �� ��</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");

            //������������� ������
            exit();
        }else{

            //���������, ���� � ���� ��� ������������ � ������ �������, �� ������� ��������� �� ������
            if($result_query_select->num_rows == 1){

                // ���� ��������� ������ ��������� � ������� �� ����, �� ��������� ����� � ������ � ������ ������.
                /*$result_role_id = $mysqli->query("SELECT fk_Role_id FROM `users` WHERE email = '".$email."' AND password = '".$password."'");
                $row_role_id = mysqli_fetch_assoc($result_role_id);

                $result_user_id = $mysqli->query("SELECT user_id FROM `users` WHERE email = '".$email."' AND password = '".$password."'");
                $row_user_id = mysqli_fetch_assoc($result_user_id);*/

                $row_user = mysqli_fetch_assoc($result_query_select);

                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['fk_Role_id'] = $row_user['fk_Role_id'];
                $_SESSION['user_id'] = $row_user['user_id'];

                $_SESSION['filter_requests'] = '';
                $_SESSION['order_request_column_name'] = 'fk_status_id';
                $_SESSION['order_request_type'] = 'desc';

                $_SESSION['current_page'] = 1;


                /*���� ��� ����������� � ����� ����������*/
                $_SESSION['filter_request_id'] = null;
                $_SESSION['filter_caption_request'] = null;
                $_SESSION['filter_short_description_request'] = null;
                $_SESSION['filter_user_create_request'] = null;
                $_SESSION['filter_user_response_request'] = null;

                $_SESSION['filter_date_create_begin_request'] = null;
                $_SESSION['filter_date_create_end_request'] = null;

                $_SESSION['filter_date_resolve_begin_request'] = null;
                $_SESSION['filter_date_resolve_end_request'] = null;

                //���������� ������������ �� ������� ��������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/index.php");

            }else{

                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >������������ ����� �/��� ������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_auth.php");

                //������������� ������
                exit();
            }
        }
    }else{
        //���� ����� �� ��������
        exit("<p><strong>������!</strong> ����������� ����������� ���, �� ���� ��� �����. �� ������ ������� �� <a href=".$address_site."> ������� �������� </a>.</p>");
    }

}else{
    exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=".$address_site."> ������� �������� </a>.</p>");
}

//***