<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:57
 */
require_once("header.php");
?>
<link rel="stylesheet" type="text/css" href="css/registration.css">
<!-- ���� ��� ������ ��������� -->
<div class="block_for_messages">
    <?php

    if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
        echo $_SESSION["error_messages"];

        //���������� ����� �� ��������� ������ ��� ���������� ��������
        unset($_SESSION["error_messages"]);
    }

    if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
        echo $_SESSION["success_messages"];

        //���������� ����� �� ��������� ������ ��� ���������� ��������
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>

<?php
//���������, ���� ������������ �� �����������, �� ������� ����� �����������,
//����� ������� ��������� � ���, ��� �� ��� �����������
if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    ?>


<div class="ribbon"></div>
<div class="login">
    <h1>�����������</h1>
    <p>������� ��������������� ������ ������������</p>
        <form action="auth.php" method="post" name="form_auth">
            <div class="input">

                <div class="blockinput">
                    <input type="email" name="email" required="required" placeholder="E-mail">
                </div>

                <div class="blockinput">
                    <input type="password" name="password" placeholder="������" required="required"><br>
                    <span id="valid_password_message" class="mesage_error"></span>
                </div>

                <div class="blockinput">
                    <input type="text" name="captcha" placeholder="����������� ���" autocomplete="off">
                    <img src="captcha.php" alt="����������� �����" /> <br>
                </div>

            </div>

                        <input class="buttonReg" type="submit" name="btn_submit_auth" value="�����">

        </form>
</div>


    <?php
}else{
    ?>

    <div id="authorized">
        <br><br><h1>�� ��� ������������</h1>
    </div>

    <?php
}
?>

<?php
//����������� �������
require_once("footer.php");
?>
