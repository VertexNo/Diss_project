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
        $organisation_name = htmlspecialchars($organisation_name, ENT_QUOTES);
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

//������ �� ��������� ��������� � ��
        $result_query_insert = $mysqli->query("update requests set caption='" . $caption . "', short_description='" . $short_description . "', description='" . $description . "', fk_responsible_user_id='" . $resultUserResponsID . "', fk_status_id='" . $resultStatusID . "', fk_priority_id='" . $resultPriorityID . "', fk_service_id='" . $resultServiceID . "'  where request_id='" . $_POST["request_id"] . "'");

        if (!$result_query_insert) {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� ��������� ������������ � ��</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //�������������  ������
            exit();
        } else {

            $_SESSION["success_messages"] = "<p class='success_message'>������ �������� ������� <br /><br />��������� ��������</p>";

            /*//���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");
        }

        /* ���������� ������� */
        $result_query_insert->close();

//��������� ����������� � ��
        $mysqli->close();


    } else {

        exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=" . $address_site . "> ������� �������� </a>.</p>");
    }
}
?>