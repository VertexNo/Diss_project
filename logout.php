<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 22:07
 */
//��������� ������
session_start();

unset($_SESSION["email"]);
unset($_SESSION["password"]);

// ���������� ������������ �� �� ��������, �� ������� �� ����� �� ������ �����.
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>