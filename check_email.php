<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 030 30.10.18
 * Time: 20:44
 */
//��������� ���� ����������� � ��
require_once("dbconnect.php");

if(isset($_POST["email"])) {

    $email =  trim($_POST["email"]);

    $email = htmlspecialchars($email, ENT_QUOTES);

    //���������, ��� �� ��� ������ ������ � ��.
    $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

    //���� ���-�� ���������� ����� ����� �������, ������, ������������ � ����� �������� ������� ��� ���������������
    if($result_query->num_rows == 1){

        echo "<span class='mesage_error'>������������ � ����� �������� ������� ��� ���������������</span>";

    }else{
        echo "<span class='success_message'>�������� ����� ��������</span>";
    }

    // �������� �������
    $result_query->close();
}
?>