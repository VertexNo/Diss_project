<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 004 04.01.19
 * Time: 16:09
 */
require_once("dbconnect.php"); // ���������� ���������� ����� text.php
require_once("header.php");

?>
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
if(isset($_SESSION["email"]) && isset($_SESSION["password"]) /*&& ($_SESSION['fk_Role_id'])==1*/){ //����� "��"
    ?>

    <br><h1>������������</h1>

    <?php
    echo 'fk_Role_id'.$_SESSION['fk_Role_id'];
    echo 'user_id'.$_SESSION['user_id'];

    $mysqli->close();
    ?>
    <?php
}else{
    ?>
    <div id="authorized">
        <br><br><h1>��� ��������� ���������, ��������� �����������</h1>
    </div>
    <?php
}

//����������� �������
require_once("footer.php");
?>
