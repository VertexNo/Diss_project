<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 006 06.01.19
 * Time: 17:59
 */
require_once("dbconnect.php"); // ���������� ���������� ����� text.php
require_once("header.php");

?>
<link rel="stylesheet" type="text/css" href="css/create_edit_request_style.css">
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

    <?php
    $request_id = $_GET['request'];

    $result_query_select = $mysqli->query("select req.request_id as request_id,
req.caption as caption,
req.short_description as short_description,
req.description as description,
req.date_create as date_create,
IFNULL(req.date_resolve, '�� ������') as date_resolve, 
concat(userCreate.last_name,\" \",userCreate.first_name) as userCreate, 
userCreate.user_id as userCreateID, 
concat(userRespons.last_name, \" \",userCreate.first_name) as userRespons,
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
where request_id > 0 and request_id ='".$request_id."'");
    if($result_query_select->num_rows == 1){

        $row_request= mysqli_fetch_assoc($result_query_select);

        /*$_SESSION['fk_Role_id'] = $row_user['fk_Role_id'];*/

       /* header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/index.php");*/

    }else{

        // ��������� � ������ ��������� �� ������.
        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ��������� ���� �������</p>";

        //���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_auth.php");

        //������������� ������
        exit();
    }

    ?>
    <!-- ������� ��������. ���� � ������� ������� - �� ������� ���� ����������� -->
    <br><h1> ������������</h1>
    <form action="update_request.php" id="form_request" method="post">
        <div class="input">
        �������������� ���������
            <?php
            if($row_request['status_id']==5)
            {
                echo '<br> ������ ��������� ���� �������. �������������� ��������� <br> 
����� ������������� ���������, ������������ ��� ��������������� �������';
            }
            ?>
        <div class="pole">
                <label>�����:</label>
                <div class="input"><input readonly type="text" id="request_id" required="required" name="request_id" value="<?php echo $request_id ?>"/></div>

        </div>
        <div class="pole">
            <label>���������:</label>
            <div class="input"><input type="text" id="caption" required="required" name="caption" value="<?php echo $row_request['caption']?>"
                <?php
                if($row_request['status_id']==5)
                {
                    echo ' readonly';
                }
                ?>/></div>
            <span id="valid_caption_message" class="mesage_error"></span>
        </div>

        <div class="pole">
            <label>������� ��������:</label>
            <div class="input"><input type="text"  id="short_description" required="required" name="short_description" value="<?php echo $row_request['short_description'] ?>"
                    <?php
                    if($row_request['status_id']==5)
                    {
                        echo ' readonly';
                    }
                    ?>
                /></div>
            <span id="valid_short_description_message" class="mesage_error"></span>
        </div>
        <div class="pole">
            <label>������ �������� ��������:</label>
            <div class="input"><textarea id="description" required="required" name="description"
                    <?php
                    if($row_request['status_id']==5)
                    {
                        echo ' readonly';
                    }
                    ?>
                > <?php echo $row_request['description'] ?> </textarea></div>
            <span id="valid_description_message" class="mesage_error"></span>
        </div>
        <div class="pole">
            <label>�����������:</label>
            <?php
            if($row_request['status_id']==5)
            {
                echo '<select name="option3" class="cellbut" disabled>';
            }
            else
            {
                echo '<select name="option3" class="cellbut">';
            }
            ?>
            <!--<select name="option3" class="cellbut">-->
                <?php //Option ��� ������ ������������

                $result_query_users = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and fk_role_id =2");
                $result_query_num_users = mysqli_num_rows($result_query_users);
                for ($i=0; $i <$result_query_num_users; $i++)
                { /*������� �������� �� ������� ������ � ������ � ���������� ���������*/
                    $result = mysqli_fetch_array($result_query_users);

                    if($row_request['userCreateID'] == $result['user_id'])
                    {
                        echo '<option required="required" selected> ' . $result['userRespons'] . '</option>';
                    }
                    else {
                        echo '<option required="required"> ' . $result['userRespons'] . '</option>';
                    }

                }
                ?>
            </select>
        </div>

        <div class="pole">
            <label>������:</label>
            <?php
            if($row_request['status_id']==5)
            {
                echo '<select name="option1" class="cellbut" disabled>';
            }
            else
            {
                echo '<select name="option1" class="cellbut">';
            }
            ?>
            <!--<select name="option1" class="cellbut">-->
                <?php //Option ��� ������ �������

                $result_query_status = $mysqli->query("select status_id,status_name from status where status_iD >0");
                $result_query_num_status = mysqli_num_rows($result_query_status);
                for ($i=0; $i <$result_query_num_status; $i++)
                { /*������� �������� �� ������� ������ � ������ � ���������� ���������*/
                    $result = mysqli_fetch_array($result_query_status);

                    if($row_request['status_id'] == $result['status_id'])
                    {
                        echo '<option required="required" selected> '.$result['status_name'].'</option>';
                    }
                    else {
                        echo '<option required="required"> '.$result['status_name'].'</option>';
                    }


                }
                ?>
            </select>
        </div>
        <div class="pole">
            <label>���������:</label>
            <?php
            if($row_request['status_id']==5)
            {
                echo ' <select name="option2" class="cellbut" disabled>';
            }
            else
            {
                echo '<select name="option2" class="cellbut">';
            }
            ?>
            <!--<select name="option2" class="cellbut">-->
                <?php //Option ��� ������ ����������

                $result_query_priority = $mysqli->query("select priority_id,priority_name from priority where priority_id >0");
                $result_query_num_priority = mysqli_num_rows($result_query_priority);
                for ($i=0; $i <$result_query_num_priority; $i++)
                { /*������� �������� �� ������� ��������� � ������ � ���������� ������������*/
                    $result = mysqli_fetch_array($result_query_priority);

                    if($row_request['priority_id'] == $result['priority_id'])
                    {
                        echo '<option required="required" selected> '.$result['priority_name'].'</option>';
                    }
                    else {
                        echo '<option required="required"> '.$result['priority_name'].'</option>';
                    }


                }
                ?>
            </select>
        </div>
        <div class="pole">
            <label>��� �������� / ������:</label>
            <?php
            if($row_request['status_id']==5)
            {
                echo '<select name="option4" class="cellbut" disabled>';
            }
            else
            {
                echo '<select name="option4" class="cellbut">';
            }
            ?>
            <!--<select name="option4" class="cellbut">-->
                <?php //Option ��� ������ ������ / ��������


                $result = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0");

                $cats = array(); // ��� ����� ��� ������ � ����������� ��������
                // � ����� ��������� ������ ��� ������
                while($cat =  mysqli_fetch_assoc($result))
                    $cats[$cat['fk_service_id']][] =  $cat;
                // ����� ���� �������, ����������� �������, ������� ���������� ������ ���������

                function create_tree ($cats,$fk_service_id , $row_request){
                    if(is_array($cats) and  isset($cats[$fk_service_id])){
                        $tree = '';
                        foreach($cats[$fk_service_id] as $cat){
                            if($row_request == $cat['service_id'])
                            {
                                $tree .= "<option required=\"required\" selected>".$cat['service_name'];
                            }
                            else{
                                $tree .= "<option required=\"required\" >".$cat['service_name'];
                            }

                            $tree .= '</option>';
                            $tree .=  create_tree ($cats,$cat['service_id'], $row_request);

                        }
                    }
                    else return null;
                    return $tree;
                }

                // �������� ������� � ������ ������
                echo create_tree ($cats, 0, $row_request['service_id']);

                ?>
            </select>
        </div>
        </div>

        <div class="sub">
            <input type="submit" name="btn_update_request" value="���������">
            <input type="submit" name="cancel_request" value="������">
            <input type="reset" name="reset_request" value="�����">
            <?php
            if($row_request['status_id']==5)
            {
                echo '<input type="submit" name="reopen_request" value="�����������">';
            }
            else
            {
                echo '<input type="submit" name="reopen_request" value="�����������" hidden>';
            }
            ?>

        </div>
    </form>

    <?php
    echo 'fk_Role_id'.$_SESSION['fk_Role_id'];
    echo 'user_id'.$_SESSION['user_id'];

    $mysqli->close();
    ?>

    <?php
}else{
    ?>
    <div id="authorized">
        <br><br><h1>��� �������������� ���������, ��������� �����������</h1>
    </div>
    <?php
}

//����������� �������
require_once("footer.php");
?>


