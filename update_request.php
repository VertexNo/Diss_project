<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:44
 */
//��������� ������
require_once("dbconnect.php");
session_start();

//��������� ���� ����������� � ��


//��������� ������ ��� ���������� ������, ������� ����� ���������� ��� ��������� �����.
$_SESSION["error_messages"] = '';

//��������� ������ ��� ���������� �������� ���������
$_SESSION["success_messages"] = '';

/*
        ��������� ���� �� ���������� �����, �� ���� ���� �� ������ ������ ������������������. ���� ��, �� ��� ������, ���� ���, �� ������� ������������ ��������� �� ������, � ��� ��� �� ����� �� ��� �������� ��������.
    */
if(isset($_POST["cancel_request"]) && !empty($_POST["cancel_request"])){

    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $address_site . "/form_request.php");
}
if(isset($_POST["reopen_request"]) && !empty($_POST["reopen_request"])){
    $result_query = $mysqli->query("update requests set fk_status_id = 1  where request_id='".$_POST["request_id"]."'");
    if (!$result_query) {
        // ��������� � ������ ��������� �� ������.
        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� ��������� ������������ � ��</p>";

        //���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_register.php");

        //�������������  ������
        exit();
    } else {

        $_SESSION["success_messages"] = "<p class='success_message'>������ �������� ������� <br /><br />��������� �����������</p>";

        /*//���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_auth.php");*/

        //���������� ������������ �� �������� �����������
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_request.php");
    }

    /* ���������� ������� */
    $result_query->close();


}
else {
    if (isset($_POST["btn_update_request"]) && !empty($_POST["btn_update_request"])) {

        /* ��������� ���� � ���������� ������� $_POST ���������� ������ ������������ �� ����� � ��������� ���������� ������ � ������� ����������.*/

//��������� ���������
        if (isset($_POST["caption"]) && strlen($_POST["caption"]) >= 3) {

            //�������� ������� � ������ � � ����� ������
            $caption = trim($_POST["caption"]);

            if (!empty($caption)) {
                $caption = htmlspecialchars($caption, ENT_QUOTES);
            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ��������� ���������. ��������� �� ����� ���� ������ 3 ��������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� ���������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }


        //��������� ������� ��������
        if (isset($_POST["short_description"]) && strlen($_POST["short_description"]) >= 3) {

            //�������� ������� � ������ � � ����� ������
            $short_description = trim($_POST["short_description"]);

            if (!empty($short_description)) {
                $short_description = htmlspecialchars($short_description, ENT_QUOTES);
            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ������� �������� ��������. ��� �� ����� ���� ������ 3 ��������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� �������� �������� ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }

        //��������� ��������
        if (isset($_POST["description"]) && strlen($_POST["description"]) >= 3) {

            //�������� ������� � ������ � � ����� ������
            $description = trim($_POST["description"]);

            if (!empty($description)) {
                $description = htmlspecialchars($description, ENT_QUOTES);
            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� �������� ��������. ��� �� ����� ���� ������ 3 ��������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� �������� ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }

        //��������� ��������
        if (isset($_POST["description"]) && strlen($_POST["description"]) >= 3) {

            //�������� ������� � ������ � � ����� ������
            $description = trim($_POST["description"]);

            if (!empty($description)) {
                $description = htmlspecialchars($description, ENT_QUOTES);
            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� �������� ��������. ��� �� ����� ���� ������ 3 ��������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ���� ��� ����� �������� ��������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }

        //�������� �� ������������� �������
        if (isset($_POST["option1"])) {

            //�������� ������� � ������ � � ����� ������
            $status = trim($_POST["option1"]);

            if (!empty($status)) {

                $status = htmlspecialchars($status, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("select status_id,status_name from status where status_name='" . $status . "'");

//���� ���-�� ���������� ����� ������ �������, ������ ������ ������� ���
                if ($result_query->num_rows < 1) {

                    //���� ���������� ��������� �� ����� false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� ����������!</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* �������� ������� */
                    $result_query->close();

                    //�������������  ������
                    exit();
                }

                /* �������� ������� */
                $result_query->close();

            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ������ ���������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ��������� ������ ��� ��������� � ���������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }

        //�������� �� ������������� ����������
        if (isset($_POST["option2"])) {

            //�������� ������� � ������ � � ����� ������
            $priority = trim($_POST["option2"]);

            if (!empty($priority)) {

                $priority = htmlspecialchars($priority, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("select priority_id,priority_name from priority where priority_name='" . $priority . "'");

//���� ���-�� ���������� ����� ������ �������, ������ ������ ���������� ���
                if ($result_query->num_rows < 1) {

                    //���� ���������� ��������� �� ����� false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ���������� �� ����������!</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* �������� ������� */
                    $result_query->close();

                    //�������������  ������
                    exit();
                }

                /* �������� ������� */
                $result_query->close();

            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ��������� ���������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ��������� ��������� ��� ��������� � ���������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }

        //�������� �� ������������� ������������
        if (isset($_POST["option3"])) {

            //�������� ������� � ������ � � ����� ������
            $user = trim($_POST["option3"]);

            if (!empty($user)) {

                $user = htmlspecialchars($user, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.
//
                //����� ������� �������� � �������, ����� ����� email �����������
                $user = preg_match_all("/\(([^()]*)\)/", $user, $matches);
                $user = $matches[0][0];
                $user = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $user, $matches2);
                $user = $matches2[0][0];

                $result_query = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and email ='" . $user . "'");

//���� ���-�� ���������� ����� ������ �������, ������ ������ email ���
                if ($result_query->num_rows < 1) {

                    //���� ���������� ��������� �� ����� false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������������ ������ email �� ����������!</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* �������� ������� */
                    $result_query->close();

                    //�������������  ������
                    exit();
                }

                /* �������� ������� */
                $result_query->close();

            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ����������� ���������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ��������� ������������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }

        //�������� �� ������������� ���� ������
        if (isset($_POST["option4"])) {

            //�������� ������� � ������ � � ����� ������
            $service = trim($_POST["option4"]);

            if (!empty($service)) {

                $service = htmlspecialchars($service, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("select service_id,service_name,fk_service_id from service where service_name='" . $service . "'");

//���� ���-�� ���������� ����� ������ �������, ������ ������ ������ ����� ���
                if ($result_query->num_rows < 1) {

                    //���� ���������� ��������� �� ����� false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ���� �������� �� ����������!</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");

                    } else {
                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ � ������� � ��</p>";

                        //���������� ������������ �� �������� �����������
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_request.php");
                    }

                    /* �������� ������� */
                    $result_query->close();

                    //�������������  ������
                    exit();
                }

                /* �������� ������� */
                $result_query->close();

            } else {
                // ��������� � ������ ��������� �� ������.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>������� ��� ��������� ��� ���������</p>";

                //���������� ������������ �� �������� �����������
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_request.php");

                //�������������  ������
                exit();
            }

        } else {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ��������� ��� ��������� ��� ���������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }
        //if ($mysqli->connect_errno) { die('������ ����������: ' . $mysqli->connect_error); }else{echo 'Connect true';}


        $rolename = trim($_POST["option1"]);
        $rolename = htmlspecialchars($rolename, ENT_QUOTES);
        $result_query_Role_id = $mysqli->query("select Role_id from Roles where Role_name='" . $rolename . "'");
        $roleid = mysqli_fetch_assoc($result_query_Role_id);
        $resultroleid = $roleid['Role_id'];

        $organisation_name = trim($_POST["option2"]);
        $organisation_name = addslashes($organisation_name);
        $result_query_organisation_id = $mysqli->query("select id_organisation from organisations where organisation_name='" . $organisation_name . "'");
        $idorganisation = mysqli_fetch_assoc($result_query_organisation_id);
        $resultidorganisationid = $idorganisation['id_organisation'];


        //������������ ������ ��� ������ � ��
        //���������
        $caption = trim($_POST["caption"]);
        $caption = htmlspecialchars($caption, ENT_QUOTES);

        //������� ��������
        $short_description = trim($_POST["short_description"]);
        $short_description = htmlspecialchars($short_description, ENT_QUOTES);

        //��������
        $description = trim($_POST["description"]);
        $description = htmlspecialchars($description, ENT_QUOTES);

        //����������� (����� EMAIL ����� �� ��������)
        $userRespons = trim($_POST["option3"]);
        $userRespons = htmlspecialchars($userRespons, ENT_QUOTES);

        //����� ������� �������� � �������, ����� ����� email �����������
        $userRespons = preg_match_all("/\(([^()]*)\)/", $userRespons, $matches);
        $userRespons = $matches[0][0];
        $userRespons = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $userRespons, $matches2);
        $userRespons = $matches2[0][0];

        $EmailUserRespons = $userRespons;

        $result_query_userRespons = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 
and fk_role_id =2 and email='" . $userRespons . "'");
        $userResponsID = mysqli_fetch_assoc($result_query_userRespons);
        $resultUserResponsID = $userResponsID['user_id'];

        //������
        $statusname = trim($_POST["option1"]);
        $statusname = htmlspecialchars($statusname, ENT_QUOTES);
        $result_query_Status_id = $mysqli->query("select status_id,status_name from status where status_iD >0 and status_name='" . $statusname . "'");
        $statusid = mysqli_fetch_assoc($result_query_Status_id);
        $resultStatusID = $statusid['status_id'];

        //������
        $evaluationname = trim($_POST["option5"]);
        $evaluationname = htmlspecialchars($evaluationname, ENT_QUOTES);
        $result_query_Evaluation_id = $mysqli->query("select evaluation_id,evaluation_name from request_performance_evaluation where evaluation_name='" .$evaluationname. "'");
        $evaluationid = mysqli_fetch_assoc($result_query_Evaluation_id);
        $resultEvaluationID = $evaluationid['evaluation_id'];




        //���������
        $priorityname = trim($_POST["option2"]);
        $priorityname = htmlspecialchars($priorityname, ENT_QUOTES);
        $result_query_Priority_id = $mysqli->query("select priority_id,priority_name from priority where priority_id >0 and priority_name='" . $priorityname . "'");
        $priorityid = mysqli_fetch_assoc($result_query_Priority_id);
        $resultPriorityID = $priorityid['priority_id'];

        //��� ��������� / ������
        $servicename = trim($_POST["option4"]);
        $servicename = htmlspecialchars($servicename, ENT_QUOTES);
        $result_query_Service_id = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0 and service_name='" . $servicename . "'");
        $serviceid = mysqli_fetch_assoc($result_query_Service_id);
        $resultServiceID = $serviceid['service_id'];


        /*����� ����� ��� ��������� ��������� ��� ��� ������ ������� "� ������" (id = 2) � "������" (id = 4)*/
        $date_start_work = $_POST["date_start_work"];
        $date_resolve = $_POST["date_resolve"];

        /*��������, ���� ��� ������, �� ������ null ������� �����������*/
        if($date_start_work =='�� ����� �� ����������' || $date_start_work == '0000-00-00 00:00:00')
        {
            $date_start_work = 'null';
        }
        if($date_resolve == '�� ������' || $date_resolve == '0000-00-00 00:00:00')
        {
            $date_resolve = 'null';
        }

        /*�������� ��������. ���� ������ ����� ������ - ������ ����*/
        if($resultStatusID == 2)
        {
            $date_start_work = date("Y-m-d H:i:s");
            $date_resolve = 'null';
        }
        if($resultStatusID == 4)
        {
            $date_resolve = date("Y-m-d H:i:s");
        }

//������ �� ��������� ��������� � ��



        $result_query_insert = $mysqli->query("update requests set caption='" . $caption . "', short_description='" . $short_description . "', description='" . $description . "', fk_responsible_user_id='" . $resultUserResponsID ."' , date_start_work='".$date_start_work."', date_resolve='".$date_resolve. "', fk_status_id='" . $resultStatusID . "', fk_priority_id='" . $resultPriorityID . "', fk_service_id='" . $resultServiceID . "', evaluation_id='" .$resultEvaluationID. "'  where request_id='" . $_POST["request_id"] . "'");

        /*������������ ��� ������������*/
        $User_isBusyIngeneer = null;
        $User_evaluationAverage = 0;
        $User_isNewIgneneer = 0;
        $User_distanceWork = null;
        $User_workTime = null;

        /*TODO: ����������� ������ ������������� ��������� � ����������� �� ��������� ������� �����*/


        /*��������� ���� �� ��� �������� ������ ������ ����. ���� ���� - �� �� ������ ������� ���������� ��������*/
        $result_query_Count_open_requests = $mysqli->query("select count(Request_Id) as CountOpenRequests from requests where fk_status_ID in (2,3) and fk_responsible_user_id = '" . $resultUserResponsID . "' and Request_Id <> ".$_POST["request_id"]);
        $CountOpenRequests = mysqli_fetch_assoc($result_query_Count_open_requests);
        $resultCountOpenRequests = $CountOpenRequests['CountOpenRequests'];

        /*���� ������ ���� ������ ��� ��� �������� �����, ��������� ������ � ������ ������� ����������� / ��������� ��������*/
        if($resultCountOpenRequests < 1) {
            switch ($resultStatusID) {
                case 0:
                    $User_isBusyIngeneer = null; //�����������
                case 1:
                    $User_isBusyIngeneer = null; //������� ����������
                case 2:
                    $User_isBusyIngeneer = 1; //� ������
                case 3:
                    $User_isBusyIngeneer = 1; //������� ���������
                case 4:
                    $User_isBusyIngeneer = null; //������
                case 5:
                    $User_isBusyIngeneer = null; //�������
            }
        }
        else
        {
            $User_isBusyIngeneer = 1;
        }

        /*������������ ����� ����������� �������� ���������� �����*/
        $result_query_QualityWork = $mysqli->query("select sum(request_performance_evaluation.evaluation_score)/count(Request_Id) as NewQualityWork from requests 
inner join request_performance_evaluation on requests.evaluation_id = request_performance_evaluation.evaluation_id
where fk_status_ID in (4,5) and fk_responsible_user_id = ".$resultUserResponsID);
        $CoefQualityWork = mysqli_fetch_assoc($result_query_QualityWork);
        $User_evaluationAverage = $CoefQualityWork['NewQualityWork'];

        /*������������ ����� ���������� ��������� / ������� ������*/
        if($resultStatusID == 4)
        {
            $result_query_TimeWork = $mysqli->query("select TIMEDIFF(date_resolve,date_start_work) as TimeWork from requests 
where fk_status_ID in (4,5) and fk_responsible_user_id = ".$resultUserResponsID. " and request_id =".$_POST["request_id"]);
            $TimeWork = mysqli_fetch_assoc($result_query_TimeWork);
            $User_workTime = $TimeWork['TimeWork'];

           // $User_workTime = $date_resolve->diff( $date_start_work )->format("%h:%i:%s");



           // $User_workTime = $User_workTime -> format("H:i:s");
        }

        /*������������ ���������� �� ����� ���������� ������*/
        //TODO: ���� ������ � "������� ����������" ��� "� ������" ������ ����������. ���� ������ ������ - ������ Null.

        /*���� ������������ �� ����� ����������� �� ������������ ���������. �.� �����. ����� - ���*/
        /*TODO: ������� �������� ��� ���� � ������� �� ����� �����������*/

        //���� ID ������������, ���������� ������
        $result_query_user_create = $mysqli->query("select fk_create_user_id from requests
where request_id = ".$_POST["request_id"]);
        $UserCr = mysqli_fetch_assoc($result_query_user_create);
        $UserCreateID = $UserCr['fk_create_user_id'];


        $result_query_user_createEmail = $mysqli->query("select email from users
where user_id = ".$UserCreateID);
        $UserCrEmail = mysqli_fetch_assoc($result_query_user_createEmail);
        $UserCreateEmail = $UserCrEmail['email'];



        /*���� ���������� �� ��������� ����� ��� ������������ ���������� ������ (�1)*/
        $result_query_user_org = $mysqli->query("select fk_organisation_id from users
where user_id = ".$UserCreateID);
        $UserOrg = mysqli_fetch_assoc($result_query_user_org);
        $User_Organisation = $UserOrg['fk_organisation_id'];

        /*���� ���������� �� ��������� ����� ��� ��������, �������� � ������ ������ (�1)*/
        $result_query_ingener_org = $mysqli->query("select fk_organisation_id from users
where user_id = ".$resultUserResponsID);
        $IngenerOrg = mysqli_fetch_assoc($result_query_ingener_org);
        $Ingener_Organisation = $IngenerOrg['fk_organisation_id'];

        if($User_Organisation == $Ingener_Organisation)
        {
            if ($resultStatusID == 2 || $resultStatusID == 3)
            {
                /*���� ���������� �� ��������� ����� ��� ������������ ���������� ������ (�1)*/
                $result_query_user_distance = $mysqli->query("select mo_distance from users
inner join office on users.fk_office_id = office.office_id
where Users.User_id = " . $UserCreateID);
                $CoefUserDistance = mysqli_fetch_assoc($result_query_user_distance);
                $User_DistanceResult = $CoefUserDistance['mo_distance'];

                /*���� ���������� �� ��������� ����� ��� ��������, �������� � ������ ������ (�1)*/
                $result_query_ingener_distance = $mysqli->query("select mo_distance from users
inner join office on users.fk_office_id = office.office_id
where Users.User_id =" . $resultUserResponsID);
                $CoefIngenerDistance = mysqli_fetch_assoc($result_query_ingener_distance);
                $Ingener_DistanceResult = $CoefIngenerDistance['mo_distance'];

                /*TODO: ������������ ����������: abs(���������� �1 -  ���������� �1)*/
                $User_distanceWork = abs($User_DistanceResult - $Ingener_DistanceResult);
            }
            else
                {
                $k4_distance_work = null;
            }
        }


        /*����� ���������� ������������ �� �����*/
        $result_query_insert_user = $mysqli->query("update users set 	k1_busy_employee='" . $User_isBusyIngeneer . "', k2_quality_work='" . $User_evaluationAverage . "', k3_new_employee='" . $User_isNewIgneneer . "', k4_distance_work='" . $User_distanceWork ."' , k5_execution_time='".$User_workTime."'  where user_id='" . $resultUserResponsID . "'");


        if (!$result_query_insert) {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� ��������� ��������� � ��</p>";

            //���������� ������������ �� �������� ���������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        } else {

            /*������� �������� ������ � ���������� ������*/
            //$EmailUserResponse
            /*�������� ����� ������*/


            if(!empty($_POST["current_comment"]))
            {
                $Comment = "�������� �����������: ".$_POST["current_comment"];
            }
            else $Comment="";

            $to = $EmailUserRespons;
            $subject = "�������������� �������� ����������� �� ��������� ������";
            $message = "���� �������� ������ � �������: ".$_POST["request_id"]."\n����������: ".$caption."\n������� ���������: ".$short_description.
            "\n������� ������ ������: ".$statusname."\n������� ��������� ������: ".$priorityname."\n".$Comment;
            $headers = "*************";
            mail ($to, $subject, $message, $headers);

            //���������� ��� �� ������ ������������, ���������� ������ $UserCreateEmail
            mail ($UserCreateEmail, $subject, $message, $headers);

            /*�������� ������ �����*/

            $_SESSION["success_messages"] = "<p class='success_message'>������ �������� ������� <br /><br />��������� �".$_POST["request_id"]." ��������</p>";

            /*//���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_edit_request.php?request=".$_POST["request_id"]);
        }


        /*������ �� ���������� ������*/

        // �������� <input type="file">
        $input_name = 'file';

// ����������� ���������� ������.
        $allow = array();

// ����������� ���������� ������.
        $deny = array(
            'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
            'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
            'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
        );

// ���������� ���� ����� ����������� �����.
        $path = __DIR__ . '/uploads/';

        if (isset($_FILES[$input_name])) {
            // �������� ���������� ��� ��������.
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // ����������� ������ $_FILES � ������� ��� ��� �������� � foreach.
            $files = array();
            $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
            if ($diff == 0) {
                $files = array($_FILES[$input_name]);
            } else {
                foreach($_FILES[$input_name] as $k => $l) {
                    foreach($l as $i => $v) {
                        $files[$i][$k] = $v;
                    }
                }
            }

            foreach ($files as $file) {
                $error = $success = '';

                // �������� �� ������ ��������.
                if (!empty($file['error']) || empty($file['tmp_name'])) {
                    switch (@$file['error']) {
                        case 1:
                        case 2: $error = '�������� ������ ������������ �����.'; break;
                        case 3: $error = '���� ��� ������� ������ ��������.'; break;
                        case 4: $error = '���� �� ��� ��������.'; break;
                        case 6: $error = '���� �� �������� - ����������� ��������� ����������.'; break;
                        case 7: $error = '�� ������� �������� ���� �� ����.'; break;
                        case 8: $error = 'PHP-���������� ���������� �������� �����.'; break;
                        case 9: $error = '���� �� ��� �������� - ���������� �� ����������.'; break;
                        case 10: $error = '�������� ����������� ���������� ������ �����.'; break;
                        case 11: $error = '������ ��� ����� ��������.'; break;
                        case 12: $error = '������ ��� ����������� �����.'; break;
                        default: $error = '���� �� ��� �������� - ����������� ������.'; break;
                    }
                } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                    $error = '�� ������� ��������� ����.';
                } else {
                    // ��������� � ����� ����� ������ �����, ����� � ��������� �������.
                    $pattern = "[^a-z�-��0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name = str_replace($pattern, '-', $file['name']);
                    $name = str_replace('[-]+', '-', $name);
                    $name = str_replace(' ', '_', $name);

                    // �.�. ���� �������� � ���������� � ��������� ������ (����� ���������� ����������).
                    // ������� �� ��������:
                    $converter = array(
                        '�' => 'a',   '�' => 'b',   '�' => 'v',    '�' => 'g',   '�' => 'd',   '�' => 'e',
                        '�' => 'e',   '�' => 'zh',  '�' => 'z',    '�' => 'i',   '�' => 'y',   '�' => 'k',
                        '�' => 'l',   '�' => 'm',   '�' => 'n',    '�' => 'o',   '�' => 'p',   '�' => 'r',
                        '�' => 's',   '�' => 't',   '�' => 'u',    '�' => 'f',   '�' => 'h',   '�' => 'c',
                        '�' => 'ch',  '�' => 'sh',  '�' => 'sch',  '�' => '',    '�' => 'y',   '�' => '',
                        '�' => 'e',   '�' => 'yu',  '�' => 'ya',

                        '�' => 'A',   '�' => 'B',   '�' => 'V',    '�' => 'G',   '�' => 'D',   '�' => 'E',
                        '�' => 'E',   '�' => 'Zh',  '�' => 'Z',    '�' => 'I',   '�' => 'Y',   '�' => 'K',
                        '�' => 'L',   '�' => 'M',   '�' => 'N',    '�' => 'O',   '�' => 'P',   '�' => 'R',
                        '�' => 'S',   '�' => 'T',   '�' => 'U',    '�' => 'F',   '�' => 'H',   '�' => 'C',
                        '�' => 'Ch',  '�' => 'Sh',  '�' => 'Sch',  '�' => '',    '�' => 'Y',   '�' => '',
                        '�' => 'E',   '�' => 'Yu',  '�' => 'Ya',
                    );

                    $name = strtr($name, $converter);
                    $parts = pathinfo($name);

                    if (empty($name) || empty($parts['extension'])) {
                        $error = '������������ ��� �����';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        $error = '������������ ��� �����';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        $error = '������������ ��� �����';
                    } else {
                        // ����� �� �������� ���� � ����� �� ���������, ������� �������.
                        $i = 0;
                        $prefix = '';
                        while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                            $prefix = '(' . ++$i . ')';
                        }
                        $name = $parts['filename'] . $prefix . '.' . $parts['extension'];

                        // ���������� ���� � ����������.
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            // ����� ����� ��������� �������� ����� � �� � �.�.
                            $success = '���� �' . $name . '� ������� ��������.';
                        } else {
                            $error = '�� ������� ��������� ����.';
                        }
                    }
                }

                // ������� ��������� � ���������� ��������.
                if (!empty($success)) {
                    $result_query_insert = $mysqli->query("insert into Attachments (attachment_id,attachment_url,attachment_name, fk_request_id)
values(null,'"."uploads/"."', '".$name . "', '" . $_POST["request_id"]."' )");
                } else {
                    echo '<p>' . $error . '</p>';
                }
            }
        }

        /*������ �� ���������� ������ �����*/

        /*������ ���������� ��������� ������*/

        if(!empty($_POST["current_comment"]))
        {
            $result_query_insert = $mysqli->query("insert into comments (comment_id,comment_text,comment_date, rf_user_id, rf_request_id)
values(null,'".$_POST["current_comment"]."', '".date("Y-m-d H:i:s")."', '".$_SESSION['user_id']."', '" . $_POST["request_id"]."' )");
        }

        /*������ ���������� ��������� �����*/




        /* ���������� ������� */
        $result_query_insert->close();

//��������� ����������� � ��
        $mysqli->close();


    } else {

        exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=" . $address_site . "> ������� �������� </a>.</p>");
    }
}
?>