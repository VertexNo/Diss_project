<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 027 27.10.18
 * Time: 15:35
 */
ini_set ("session.use_trans_sid", true);
session_start();
include ('../lib/connect.php'); //������������ � ��
include ('../lib/function_global.php'); //���������� ���������� �������

//��������, ���� ����� ������������ ��� �������������. ���� ��� ���, ������������ ��� �� ������� �������� �����
if (isset($_SESSION['id']) || (isset($_COOKIE['login']) && isset($_COOKIE['password'])))
{
    header('Location: http://localhost/new_project');
}
else
{
    if (isset($_POST['GO'])) //���� ���� ������ ������ �����������, �������� ������ �� ������������ �, ���� ������ ������� � ������� ���������, ������� ������ � ����� ������������� � ��
    {
        $correct = registrationCorrect(); //���������� � ���������� ��������� ������ ������� registrationCorrect(), ������� ���������� true, ���� �������� ������ ����� � false � ��������� ������
        if ($correct) //���� ������ �����, ������� �� � ���� ������
        {
            $login = htmlspecialchars($_POST['login']);
            $password = $_POST['password'];
            $mail = htmlspecialchars($_POST['mail']);
            $salt = mt_rand(100, 999);
            $tm = time();
            $password = md5(md5($password).$salt);
            if (mysql_query("INSERT INTO users (login,password,salt,mail_reg,mail,reg_date,last_act) VALUES ('".$login."','".$password."','".$salt."','".$mail."','".$mail."','".$tm."','".$tm."')")) //����� ������ � �� � �������������� ������������
            {
                setcookie ("login", $login, time() + 50000, '/');
                setcookie ("password", md5($login.$password), time() + 50000, '/');
                $rez = mysql_query("SELECT * FROM users WHERE login=".$login);
                @$row = mysql_fetch_assoc($rez);
                $_SESSION['id'] = $row['id'];
                $regged = true;
                include ("template/registration.php"); //���������� ������
            }
        }
        else
        {
            include_once ("template/registration.php"); //���������� ������ � ������ �������������� ������
        }
    }
    else
    {
        include_once ("template/registration.php"); //���������� ������ � ������ ���� ������ ����������� ������ �� ����, �� ����, ������������ ������ ������� �� �������� �����������
    }
}
?>