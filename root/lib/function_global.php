<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 027 27.10.18
 * Time: 15:45
 */

@mysql_connect("localhost", "user", "user07001735")
or die ("Error for connect func golb");
@mysql_select_db("db_name");
function registrationCorrect()
{
    if ($_POST['login'] == "") return false; //�� ����� �� ���� ������
    if ($_POST['password'] == "") return false; //�� ����� �� ���� ������
    if ($_POST['password2'] == "") return false; //�� ����� �� ���� ������������� ������
    if ($_POST['mail'] == "") return false; //�� ����� �� ���� e-mail
    if ($_POST['lic'] != "ok") return false; //������� �� �������
    if (!preg_match('/^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/is', $_POST['mail'])) return false; //������������� �� ���� e-mail ����������� ���������
    if (!preg_match('/^([a-zA-Z0-9])(\w|-|_)+([a-z0-9])$/is', $_POST['login'])) return false; // ������������� �� ����� ����������� ���������
    if (strlen($_POST['password']) < 5) return false; //�� ������ �� 5 �������� ����� ������
    if ($_POST['password'] != $_POST['password2']) return false; //����� �� ������ ��� �������������
    $login = $_POST['login'];
    $rez = mysql_query("SELECT * FROM users WHERE login=$login");
    if (@mysql_num_rows($rez) != 0) return false; // �������� �� ������������� � �� ������ �� ������
    return true; //���� ���������� ������� ����� �� ����� �����, ���������� true
}
?>