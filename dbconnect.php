<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:23
 */
// ��������� ���������
header('Content-Type: text/html; charset=windows-1251');

$server = "localhost"; /* ��� ����� */
$username = "user"; /* ��� ������������ �� */
$password = "user07001735"; /* ������ ������������, ���� � ������������ ��� ������ ��, ��������� ������ */
$database = "nodis"; /* ��� ���� ������, ������� ������� */

// ����������� � ���� ������ ����� MySQLi
$mysqli = new mysqli($server, $username, $password, $database);

// ���������, ���������� ����������.
if (mysqli_connect_errno()) {
    echo "<p><strong>������ ����������� � ��</strong>. �������� ������: ".mysqli_connect_error()."</p>";
    exit();
}

// ������������� ��������� �����������
$mysqli->set_charset('windows-1251');

//��� ��������, ������� ����� ����������, ������� ����� ��������� �������� ������ �����
$address_site = "http://localhost/new_project";
?>