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
if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){

    //��������� ���������� �����
//�������� ������� � ������ � � ����� ������
    $captcha = trim($_POST["captcha"]);

    if(isset($_POST["captcha"]) && !empty($captcha)){
echo '<br>asda1';
        //���������� ���������� �������� � ��������� �� ������.
        if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){
            echo '<br>asda2';
            // ���� ����� �� �����, �� ���������� ������������ �� �������� �����������, � ��� ������� ��� ��������� �� ������ ��� �� ��� ������������ �����.
            $error_message = "<p class='mesage_error'><strong>������!</strong> �� ����� ������������ ����� </p>";

            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] = $error_message;



            //������������� ������
            exit();
        }

        /* ��������� ���� � ���������� ������� $_POST ���������� ������ ������������ �� ����� � ��������� ���������� ������ � ������� ����������.*/

        if(isset($_POST["first_name"])){
            echo '<br>asda2';
            //�������� ������� � ������ � � ����� ������
            $first_name = trim($_POST["first_name"]);

            //��������� ���������� �� �������
            if(!empty($first_name)){
                // ��� ������������, ����������� ����������� ������� � HTML-��������
                $first_name = htmlspecialchars($first_name, ENT_QUOTES);
            }else{
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ���� ���</p>";



                //������������� ������
                exit();
            }


        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� � ������</p>";



            //������������� ������
            exit();
        }


        if(isset($_POST["last_name"])){
            echo '<br>asda3';
            //�������� ������� � ������ � � ����� ������
            $last_name = trim($_POST["last_name"]);

            if(!empty($last_name)){
                // ��� ������������, ����������� ����������� ������� � HTML-��������
                $last_name = htmlspecialchars($last_name, ENT_QUOTES);
            }else{

                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ���� �������</p>";


                //�������������  ������
                exit();
            }


        }else{

            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� � ��������</p>";


            //�������������  ������
            exit();
        }


        if(isset($_POST["email"])){
            echo '<br>asda4';
            //�������� ������� � ������ � � ����� ������
            $email = trim($_POST["email"]);

            if(!empty($email)){
                echo '<br>asda5';
                $email = htmlspecialchars($email, ENT_QUOTES);

                //��������� ������ ����������� ��������� ������ � ������� ����������� ���������
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

//���� ������ ����������� ��������� ������ �� ������������� ����������� ���������
                if( !preg_match($reg_email, $email)){

                    echo '<br>asda6';
                    // ��������� � ������ ��������� �� ������.
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >�� ����� ������������ email</p>";


                    //�������������  ������
                    exit();
                }

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

//���� ���-�� ���������� ����� ����� �������, ������ ������������ � ����� �������� ������� ��� ���������������
                if($result_query->num_rows >= 1){
                    echo '<br>asda7';
                    //���� ���������� ��������� �� ����� false
                    if(($row = $result_query->fetch_assoc()) != false){

                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������������ � ����� �������� ������� ��� ���������������</p>";


                    }else{
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

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


                //�������������  ������
                exit();
            }

        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� Email</p>";


            //�������������  ������
            exit();
        }


        if(isset($_POST["password"]) && strlen($_POST["password"])>=6){

            echo '<br>asda7';
//echo $_POST["password"].length;
            //�������� ������� � ������ � � ����� ������
            $password = trim($_POST["password"]);

            if(!empty($password)){
                $password = htmlspecialchars($password, ENT_QUOTES);

                //������� �������
                $password = md5($password."top_secret");
            }else{
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ��� ������. ������ �� ����� ���� ������ 6 ��������</p>";


                //�������������  ������
                exit();
            }

        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� ������</p>";



            //�������������  ������
            exit();
        }


        //�������� �� ������������� ����
        if(isset($_POST["option1"])){
            echo '<br>asda8';
            //�������� ������� � ������ � � ����� ������
            $role = trim($_POST["option1"]);

            if(!empty($role)){

                $role = htmlspecialchars($role, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("select Role_id from Roles where Role_name='".$role."'");

//���� ���-�� ���������� ����� ������ �������, ������ ����� ���� ���
                if($result_query->num_rows < 1){

                    //���� ���������� ��������� �� ����� false
                    if(($row = $result_query->fetch_assoc()) != false){
                        echo '<br>asda8';
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >����� ���� �� ����������!</p>";



                    }else{
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

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
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ���� ������������</p>";


                //�������������  ������
                exit();
            }

        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� ����</p>";


            //�������������  ������
            exit();
        }

        //�������� �� ������������� �����������
        if(isset($_POST["option2"])){
            echo '<br>asda9';
            //�������� ������� � ������ � � ����� ������
            $organisation = trim($_POST["option2"]);

            if(!empty($organisation)){
                echo '<br>asda10';
                echo '<br>$organisation'.$organisation;
                echo '<br>$organisation'.$organisation;
                $organisation= addslashes($organisation);
//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("select id_organisation from organisations where organisation_name='".$organisation."'");
//���� ���-�� ���������� ����� ������ �������, ������ ����� ����������� ���
                if($result_query->num_rows < 1){
                    echo '<br>asda11111';
                    echo "select id_organisation from organisations where organisation_name='".mysqli_real_escape_string($mysqli,$organisation)."'";
                    //���� ���������� ��������� �� ����� false
                    if(($row = $result_query->fetch_assoc()) != false){
                        echo '<br>asda12';
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >����� ����������� �� ����������!</p>";


                    }else{
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

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
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ����������� ������������</p>";


                //�������������  ������
                exit();
            }

        }else{
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� �����������</p>";


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
        $result_query_organisation_id = $mysqli->query("select id_organisation from organisations where organisation_name='".$organisation_name."'");
        $idorganisation = mysqli_fetch_assoc($result_query_organisation_id);
        $resultidorganisationid = $idorganisation['id_organisation'];
//������ �� ���������� ������������ � ��

        echo 'ada='."INSERT INTO `users` (first_name, last_name, email, password, fk_Role_id,fk_organisation_id, k3_new_employee, email_status) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."'," .$resultroleid.",".$resultidorganisationid.", 1, 1)";

         $result_query_insert = $mysqli->query("INSERT INTO `users` (first_name, last_name, email, password, fk_Role_id,fk_organisation_id, k3_new_employee, email_status) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."'," .$resultroleid.",".$resultidorganisationid.", 1, 1)");

        if(!$result_query_insert){
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� ���������� ������������ � ��</p>";


            //�������������  ������
            exit();
        }else{

            $_SESSION["success_messages"] = "<p class='success_message'>����������� ������������ ������ ������� <br />������������ ���������������</p>";



        }

        /* ���������� ������� */
        $result_query_insert->close();

//��������� ����������� � ��
        $mysqli->close();

        echo $_SESSION["error_messages"];

    }else{
        //���� ����� �� �������� ���� ��� �������� ������
        exit("<p><strong>������!</strong> ����������� ����������� ���, �� ���� ��� �����. �� ������ ������� �� <a href=".$address_site."> ������� �������� </a>.</p>");
    }

}else{

    exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=".$address_site."> ������� �������� </a>.</p>");
}
?>