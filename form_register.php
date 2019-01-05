<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:35
 */
require_once("dbconnect.php"); // ���������� ���������� ����� text.php
require_once("header.php");

?>
<link rel="stylesheet" type="text/css" href="css/registration.css">
<link rel="stylesheet" type="text/css" href="css/SelectStyle.css">
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

    <div class="ribbon"></div>
    <div class="login">
        <h1>�����������</h1>
        <p>������� ��������������� ������ ������������</p>
        <form action="register.php" method="post" name="form_register" autocomplete="off">
            <div class="input">
                <div class="blockinput">
                    <input type="text" name="first_name" required="required" placeholder="���">
                </div>
                <div class="blockinput" >
                    <input type="text" name="last_name" required="required" placeholder="�������">
                </div>
                <div class="blockinput">
                    <input type="email" name="email" required="required" placeholder="E-mail"><br>
                    <span id="valid_email_message"></span>
                </div>

                <div class="blockinput">
                <input type="password" name="password" placeholder="������ (������� 6 ��������)" required="required"><br>
                <span id="valid_password_message" class="mesage_error"></span>
                </div>


                <div class="blockinput">
                    <input type="text" name="captcha" placeholder="����������� ���" required="required" autocomplete="off">
                    <img src="captcha.php" alt="�����" />
                </div>
                <div class="blockinput" >
                    <span class="custom-dropdown">
                    <select name="option2" class="cellbut">
                        <?php //Option ��� ������ �����������

                        $result_query_organisations = $mysqli->query("select organisation_name from organisations where id_organisation >0");
                        $result_query_num_organisations = mysqli_num_rows($result_query_organisations);
                        for ($i=0; $i <$result_query_num_organisations; $i++)
                        {
                            $result = mysqli_fetch_array($result_query_organisations);
                            echo '<option required="required"> '.$result['organisation_name'].' </option>';

                        }
                        ?>
                    </select>
                    </span>
                </div>
                <div class="blockinput" >
                    <span class="custom-dropdown">
                    <select name="option1" class="cellbut">
                        <?php //Option ��� ������ ������������

                        $result_query_roles = $mysqli->query("select Role_name from roles where Role_id >0");
                        $result_query_num_roles = mysqli_num_rows($result_query_roles);
                        for ($i=0; $i <$result_query_num_roles; $i++)
                        {
                            $result = mysqli_fetch_array($result_query_roles);
                            echo '<option required="required"> '.$result['Role_name'].' </option>';

                        }
                        ?>
                    </select>
                    </span>
                </div>
            </div>
            <input class="buttonReg" type="submit" name="btn_submit_register" value="�����������">
        </form>
    </div>

    <?php
    $mysqli->close();
    ?>
    <?php
}else{
    ?>
    <div id="authorized">
        <br><br><h1>� ��� ��� ���� ��� ����������� �������������</h1>
    </div>
    <?php
}

//����������� �������
//require_once("footer.php");
?>
