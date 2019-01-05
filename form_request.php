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

    <!--/*����� ����� ���������*/-->
    <?php //Option ��� ������ �����������

    $result_query_requests = $mysqli->query("
select request_id,caption,short_description,date_create,IFNULL(date_resolve, '��� ������')
, concat(userCreate.last_name,\" \",userCreate.first_name) as '������', concat(userRespons.last_name, \" \",userCreate.first_name) as '�������������',org.organisation_name,status.status_name,priority.priority_name,service.service_name
from requests req
inner join users userCreate on req.fk_create_user_id = userCreate.user_id
inner join users userRespons on req.fk_responsible_user_id = userRespons.user_id
inner join organisations org on org.id_organisation = userCreate.fk_organisation_id
inner join status status on req.fk_status_id = status.status_id
inner join priority priority on priority.priority_id = req.fk_priority_id
inner join service service on req.fk_service_id = service.service_id
where request_id > 0
");
    $result_query_num_requests = mysqli_num_rows($result_query_requests);
    for ($i=0; $i <$result_query_num_requests; $i++)
    {
        $result = mysqli_fetch_array($result_query_requests);

        echo 'RequestId = '.$result['request_id'];
    ?>
    <tr>
        <td>
            <input class="cellbut" type="submit" name="Requests_id" value=<?php echo $result['request_id']?>>
        </td>

    </tr>
    <?php
    }
    ?>

    <table>
        <thead><!-- �������������� ���-->
        <tr>
            <th>������ ���������</th>
            <th>������ ���������</th>
        </tr>
        </thead>
        <tbody><!--�������������� ���-->
        <tr>
            <td>������ ������</td>
            <td>������ ������</td>
        </tr>
        <tr>
            <td>������ ������</td>
            <td>������ ������</td>
        </tr>
        </tbody>
    </table>


    <!--����� ����� ��������� -->




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
