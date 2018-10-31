<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:35
 */
require_once("header.php");
?>
<!-- ���� ��� ������ ��������� -->
<div class="block_for_messages">
    <?php
    //���� � ������ ���������� ��������� �� �������, �� ������� ��
    if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
        echo $_SESSION["error_messages"];

        //���������� ����� �� ���������� ������ ��� ���������� ��������
        unset($_SESSION["error_messages"]);
    }

    //���� � ������ ���������� ��������� ���������, �� ������� ��
    if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
        echo $_SESSION["success_messages"];

        //���������� ����� �� ���������� ������ ��� ���������� ��������
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>

<?php
//���������, ���� ������������ �� �����������, �� ������� ����� �����������,
//����� ������� ��������� � ���, ��� �� ��� ���������������
if(isset($_SESSION["email"]) && isset($_SESSION["password"]) && ($_SESSION['fk_Role_id'])==1){ //����� "��"
    ?>
    <div id="form_register">
        <h2>����� �����������</h2>

        <form action="register.php" method="post" name="form_register">
            <table>
                <tbody><tr>
                    <td> ���: </td>
                    <td>
                        <input type="text" name="first_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> �������: </td>
                    <td>
                        <input type="text" name="last_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> Email: </td>
                    <td>
                        <input type="email" name="email" required="required"><br>
                        <span id="valid_email_message"></span>
                    </td>
                </tr>

                <tr>
                    <td> ������: </td>
                    <td>
                        <input type="password" name="password" placeholder="������� 6 ��������" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td> ������� �����: </td>
                    <td>
                        <p>
                            <img src="captcha.php" alt="�����" /> <br><br>
                            <input type="text" name="captcha" placeholder="����������� ���" required="required">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_register" value="�����������������!">
                    </td>
                </tr>
                </tbody></table>
        </form>
    </div>
    <?php
}else{
    ?>
    <div id="authorized">
        <h2>� ��� ��� ���� ��� ����������� �������������</h2>
    </div>
    <?php
}

//����������� �������
require_once("footer.php");
?>
