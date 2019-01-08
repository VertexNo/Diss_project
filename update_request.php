<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:44
 */
//��������� ������
require_once("dbconnect.php");
session_start();

//��������� ���� ����������� � ��


//��������� ������ ��� ���������� ������, ������� ����� ���������� ��� ��������� �����.
$_SESSION["error_messages"] = '';

//��������� ������ ��� ���������� �������� ���������
$_SESSION["success_messages"] = '';

/*
        ��������� ���� �� ���������� �����, �� ���� ���� �� ������ ������ ������������������. ���� ��, �� ��� ������, ���� ���, �� ������� ������������ ��������� �� ������, � ��� ��� �� ����� �� ��� �������� ��������.
    */
if(isset($_POST["btn_update_request"]) && !empty($_POST["btn_update_request"])){

        /* ��������� ���� � ���������� ������� $_POST ���������� ������ ������������ �� ����� � ��������� ���������� ������ � ������� ����������.*/

//��������� ���������
    if(isset($_POST["caption"]) && strlen($_POST["caption"])>= 3 ){

        //�������� ������� � ������ � � ����� ������
        $caption = trim($_POST["caption"]);

        if(!empty($caption)){
            $caption = htmlspecialchars($caption, ENT_QUOTES);
        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ��������� ���������. ��������� �� ����� ���� ������ 3 ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //�������������  ������
            exit();
        }

    }else{
        // ��������� � ������ ��������� �� ������.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� ���������</p>";

        //���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //�������������  ������
        exit();
    }


    //��������� ������� ��������
    if(isset($_POST["short_description"]) && strlen($_POST["short_description"])>= 3){

        //�������� ������� � ������ � � ����� ������
        $short_description = trim($_POST["short_description"]);

        if(!empty($short_description)){
            $short_description = htmlspecialchars($short_description, ENT_QUOTES);
        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ������� �������� ��������. ��� �� ����� ���� ������ 3 ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //�������������  ������
            exit();
        }

    }else{
        // ��������� � ������ ��������� �� ������.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� �������� �������� ��������</p>";

        //���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //�������������  ������
        exit();
    }

    //��������� ��������
    if(isset($_POST["description"]) && strlen($_POST["description"])>= 3){

        //�������� ������� � ������ � � ����� ������
        $description = trim($_POST["description"]);

        if(!empty($description)){
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>������� �������� ��������. ��� �� ����� ���� ������ 3 ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //�������������  ������
            exit();
        }

    }else{
        // ��������� � ������ ��������� �� ������.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� �������� ��������</p>";

        //���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //�������������  ������
        exit();
    }

    //��������� ��������
    if(isset($_POST["description"]) && strlen($_POST["description"])>= 3){

        //�������� ������� � ������ � � ����� ������
        $description = trim($_POST["description"]);

        if(!empty($description)){
            $description = htmlspecialchars($description, ENT_QUOTES);
        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>������� �������� ��������. ��� �� ����� ���� ������ 3 ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_request.php");

            //�������������  ������
            exit();
        }

    }else{
        // ��������� � ������ ��������� �� ������.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� �������� ��������</p>";

        //���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_request.php");

        //�������������  ������
        exit();
    }
        //if ($mysqli->connect_errno) { die('������ ����������: ' . $mysqli->connect_error); }else{echo 'Connect true';}

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
//������ �� ���������� ������������ � ��
        $result_query_insert = $mysqli->query("INSERT INTO `users` (first_name, last_name, email, password, fk_Role_id,fk_organisation_id) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."'," .$resultroleid.",".$resultidorganisationid.")");

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

    exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=".$address_site."> ������� �������� </a>.</p>");
}
?>