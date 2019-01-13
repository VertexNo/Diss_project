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
    <button onclick="location.href='./form_create_request.php'">������� ���������</button>


    <!--/*����� ����� ���������*/-->
    <table>
        <thead><!-- �������������� ���-->
        <tr>
            <th>� ���������</th>
            <th>���������</th>
            <th>������� ��������</th>
            <th>���� ��������</th>
            <th>���� �������</th>
            <th>���������</th>
            <th>�����������</th>
            <th>������������ �����������</th>
            <th>������</th>
            <th>���������</th>
            <th>��� ������</th>
        </tr>
        </thead>
        <tbody><!--�������������� ���-->
    <?php //Option ��� ������ �����������

    $result_query_requests = $mysqli->query("
select req.request_id as request_id,
req.caption as caption,
req.short_description as short_description,
req.date_create as date_create,
IFNULL(req.date_resolve, '�� ������') as date_resolve, 
concat(userCreate.last_name, \" \",userCreate.first_name,\" \", \"(\",userCreate.email,\")\") as userCreate, 
userCreate.user_id as userCreateID, 
concat(userRespons.last_name, \" \",userRespons.first_name,\" \", \"(\",userRespons.email,\")\") as userRespons,
userRespons.user_id as userResponsID,
org.organisation_name as organisation_name,
status.status_name as status_name,
status.status_id as status_id,
priority.priority_name as priority_name,
priority.priority_id as priority_id,
service.service_name as service_name,
service.service_id as service_id
from requests req
inner join users userCreate on req.fk_create_user_id = userCreate.user_id
inner join users userRespons on req.fk_responsible_user_id = userRespons.user_id
inner join organisations org on org.id_organisation = userCreate.fk_organisation_id
inner join status status on req.fk_status_id = status.status_id
inner join priority priority on priority.priority_id = req.fk_priority_id
inner join service service on req.fk_service_id = service.service_id
where request_id > 0
order by status_id desc
");
    $result_query_num_requests = mysqli_num_rows($result_query_requests);
    for ($i=0; $i <$result_query_num_requests; $i++)
    {
        $result = mysqli_fetch_array($result_query_requests);

        //echo 'RequestId = '.$result['request_id'];
    ?>
    <tr onclick="window.location='./form_edit_request.php?request=<?php echo $result['request_id'] ?>'"> <!--�������� ID ���������-->
        <td>
            <?php echo $result['request_id']?>
        </td>

        <td>
            <?php echo $result['caption']?>
        </td>

        <td>
            <?php echo $result['short_description']?>
        </td>

        <td>
            <?php echo $result['date_create']?>
        </td>

        <td>
            <?php echo $result['date_resolve']?>
        </td>

        <td>
           <?php echo $result['userCreate']?>
        </td>

        <td>
            <?php echo $result['userRespons']?>
        </td>


        <td>
           <?php echo $result['organisation_name']?>
        </td>

        <td>
            <?php echo $result['status_name']?>
        </td>

        <td>
            <?php echo $result['priority_name']?>
        </td>

        <td>
            <?php echo $result['service_name']?>
        </td>

    </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
   <!-- <table>
        <thead>
        <tr>
            <th>������ ���������</th>
            <th>������ ���������</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>������ ������</td>
            <td>������ ������</td>
        </tr>
        <tr>
            <td>������ ������</td>
            <td>������ ������</td>
        </tr>
        </tbody>
    </table> -->


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


