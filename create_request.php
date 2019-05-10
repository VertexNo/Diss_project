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
else {
    if (isset($_POST["btn_create_request"]) && !empty($_POST["btn_create_request"])) {

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
        if (isset($_POST["fk_status_id"])) {

            //�������� ������� � ������ � � ����� ������
            $status = trim($_POST["fk_status_id"]);

            if (!empty($status)) {

                $status = htmlspecialchars($status, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("select status_id,status_name from status where status_id='" . $status . "'");

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

        /*111*/
        //�������� �� ������������� ��������� - ������������
        if (isset($_POST["fk_create_user_id"])) {

            //�������� ������� � ������ � � ����� ������
            $user = trim($_POST["fk_create_user_id"]);

            if (!empty($user)) {

                $user = htmlspecialchars($user, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.//


                $result_query = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and user_id ='" . $user . "'");

//���� ���-�� ���������� ����� ������ �������, ������ ������ email ���
                if ($result_query->num_rows < 1) {

                    //���� ���������� ��������� �� ����� false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        // ��������� � ������ ��������� �� ������.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������������, ��� ������� ��������� ��������� �� ����������!</p>";

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
            $_SESSION["error_messages"] .= "<p class='mesage_error'>����������� ��������� / ������������</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");

            //�������������  ������
            exit();
        }

        /*111*/

        //�������� �� ������������� ����������� - ������������
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


        //�������� �� ������������� �������
        if (isset($_POST["fk_status_id"])) {

            //�������� ������� � ������ � � ����� ������
            $status = trim($_POST["fk_status_id"]);

            if (!empty($status)) {

                $status = htmlspecialchars($status, ENT_QUOTES);

//��������� ��� �� ��� ������ ������ � ��.
                $result_query = $mysqli->query("select status_id,status_name from status where status_id='" . $status . "'");

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
        //if ($mysqli->connect_errno) { die('������ ����������: ' . $mysqli->connect_error); }else{echo 'Connect true';}



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

        //��������� (����� EMAIL ����� �� ��������)
        $userCreate = trim($_POST["fk_create_user_id"]);
        $userCreate = htmlspecialchars($userCreate, ENT_QUOTES);

        //����������� (����� EMAIL ����� �� ��������)
        $userRespons = trim($_POST["option3"]);
        $userRespons = htmlspecialchars($userRespons, ENT_QUOTES);

        //����� ������� �������� � �������, ����� ����� email �����������
        $userRespons = preg_match_all("/\(([^()]*)\)/", $userRespons, $matches);
        $userRespons = $matches[0][0];
        $userRespons = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $userRespons, $matches2);
        $userRespons = $matches2[0][0];

        $EmailUserResponse = $userRespons;

        $result_query_userRespons = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 
and fk_role_id =2 and email='" . $userRespons . "'");
        $userResponsID = mysqli_fetch_assoc($result_query_userRespons);
        $resultUserResponsID = $userResponsID['user_id'];

        //���� ��������
        $dateCreate = trim($_POST["date_create"]);

        //������
        $statusid = trim($_POST["fk_status_id"]);

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

        //��� ������������ ������ ������������ ������������
        $methodname = trim($_POST["option5"]);
        $methodname = htmlspecialchars($methodname, ENT_QUOTES);
        $result_query_method_id = $mysqli->query("select method_id,method_name from methods_set_responsible where method_id >0 and method_name='" . $methodname . "'");
        $methodid = mysqli_fetch_assoc($result_query_method_id);
        $resultMethodID = $methodid['method_id'];


        //�������� ������ �� ������������� ������ �� ��������� (����� �����-����� + ������ ����)*********************
        //$resultUserResponsID -> ������� ��������� �������� �����������
        $SelectedResponsible = $resultUserResponsID;


        //���������� ��� �������������
        switch ($resultMethodID)
        {
            case 1:
                {
                    //��� ����� � ��������������
                    $queryResponsible = $mysqli->query("
       select t.user_id as MostOptimalResponsible, t.koef as Koefitient from (
select user_id,count(request_id) as CountResolvedRequests,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime,sum(request_performance_evaluation.evaluation_score)/count(request_id) as AverageEvaluattion,
(count(request_id)*sum(request_performance_evaluation.evaluation_score)/count(request_id))/TIME_TO_SEC(SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id))) as koef
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
inner join request_performance_evaluation on request_performance_evaluation.evaluation_id = requests.evaluation_id
inner join service on service.service_id = requests.fk_service_id
and requests.fk_service_id =".$resultServiceID."
and requests.fk_status_id = 5
group by user_id
order by koef desc) t
 LIMIT 0,1");

                    if($queryResponsible != null)
                    {
                        $CalculatedOptimalResponsible = mysqli_fetch_assoc($queryResponsible);
                        $OptimalResponsibleID = $CalculatedOptimalResponsible['MostOptimalResponsible'];

                        if($OptimalResponsibleID != null){
                            $resultUserResponsID = $OptimalResponsibleID;
                        }
                    }
                }break;
            case 2:
                {
//����� �����-�����
                    $queryResponsible = $mysqli->query("
       select user_id,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
and requests.fk_status_id = 5
group by user_id
order by AverageExecutionTime asc
");


                    if($queryResponsible != null)
                    {
                        $result_query_num_Responsible = mysqli_num_rows($queryResponsible);

                        $result = array();
                        //����� ������ ������ �������� ������� (���� ��������)
                        for ($i=0; $i <($result_query_num_Responsible/2)-1; $i++)
                        {
                            $row = mysqli_fetch_array($queryResponsible);
                            $result[] = $row["user_id"];
                        }

                        //����� ���������� ��������
                        $rand_userResp = array_rand($result,1);

                        //������� ������� ���������� �������� � UserResp
                        $OptimalResponsibleID = $result[$rand_userResp];





                        if($OptimalResponsibleID != null){
                            $resultUserResponsID = $OptimalResponsibleID;
                        }
                    }
                }break;
            case 3:
                {
                    $resultUserResponsID = $SelectedResponsible;
                }
            default:
                {

                }break;
        }


       /*
       //��� ����� � ��������������
       $queryResponsible = $mysqli->query("
       select t.user_id as MostOptimalResponsible, t.koef as Koefitient from (
select user_id,count(request_id) as CountResolvedRequests,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime,sum(request_performance_evaluation.evaluation_score)/count(request_id) as AverageEvaluattion,
(count(request_id)*sum(request_performance_evaluation.evaluation_score)/count(request_id))/TIME_TO_SEC(SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id))) as koef
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
inner join request_performance_evaluation on request_performance_evaluation.evaluation_id = requests.evaluation_id
inner join service on service.service_id = requests.fk_service_id
and requests.fk_service_id =".$resultServiceID."
and requests.fk_status_id = 5
group by user_id
order by koef desc) t
 LIMIT 0,1");

        if($queryResponsible != null)
        {
            $CalculatedOptimalResponsible = mysqli_fetch_assoc($queryResponsible);
            $OptimalResponsibleID = $CalculatedOptimalResponsible['MostOptimalResponsible'];

            if($OptimalResponsibleID != null){
                $resultUserResponsID = $OptimalResponsibleID;
            }
        }

       */


       //����� �����-�����
       /* $queryResponsible = $mysqli->query("
       select user_id,SEC_TO_TIME(sum(TIME_TO_SEC(Timediff(date_resolve,date_start_work)))/Count(request_id)) as AverageExecutionTime
from users
inner join requests on requests.fk_responsible_user_id = users.user_id
and requests.fk_status_id = 5
group by user_id
order by AverageExecutionTime asc
");


        if($queryResponsible != null)
        {
            $result_query_num_Responsible = mysqli_num_rows($queryResponsible);

            $result = array();
            //����� ������ ������ �������� ������� (���� ��������)
            for ($i=0; $i <($result_query_num_Responsible/2)-1; $i++)
            {
                $row = mysqli_fetch_array($queryResponsible);
                $result[] = $row["user_id"];
            }

            //����� ���������� ��������
            $rand_userResp = array_rand($result,1);

            //������� ������� ���������� �������� � UserResp
            $OptimalResponsibleID = $result[$rand_userResp];





            if($OptimalResponsibleID != null){
                $resultUserResponsID = $OptimalResponsibleID;
            }
        }*/







        //����� ������ ������������� ������*********************************




//������ �� �������� ��������� � ��
        $result_query_insert = $mysqli->query("insert into requests (request_id,caption,short_description, description,
fk_create_user_id, fk_responsible_user_id, date_create, fk_status_id, fk_priority_id, fk_service_id) values(null,'" . $caption . "', '" . $short_description . "', '" . $description ."' , '".$userCreate . "', '" . $resultUserResponsID ."','".$dateCreate. "', '" . $statusid . "', '" . $resultPriorityID . "', '" . $resultServiceID . "' )");
        $CurrentInsertRequestID=mysqli_insert_id($mysqli);
        if (!$result_query_insert) {
            // ��������� � ������ ��������� �� ������.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >������ ������� �� �������� ��������� � ��</p>";

            //���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //�������������  ������
            exit();
        } else {

            /*������� �������� ������ � ���������� ������*/
            //$EmailUserResponse
            /*�������� ����� ������*/
            //��� ��������� / ������
            $createUserTemp = trim($_POST["fk_create_user_id"]);
            $createUserTemp = htmlspecialchars($createUserTemp, ENT_QUOTES);
            $result_query_CreateUserName = $mysqli->query("select first_name,last_name,email from users where user_id='" . $userCreate . "'");
            $UserCreateResult = mysqli_fetch_assoc($result_query_CreateUserName);
            $resultUserCreateData = $UserCreateResult['first_name']." ".$UserCreateResult['last_name']."(Email:".$UserCreateResult['email']. ")";



            $to = $EmailUserResponse;
            $subject = "�������������� �������� ����������� � ���������� ������";
            $message = "��� ���� ��������� ������ �".$CurrentInsertRequestID.": ".$caption."\nC ������� ���������: ".$short_description."\n���� �������� ������: ".date("d.m.Y H:i", strtotime($dateCreate)).
            "\n��������� ������: " .$priorityname."\n��� ���������: ".$servicename.
            "\n������������ ������������: ".$resultUserCreateData;
            $headers = "************";
            mail ($to, $subject, $message, $headers);

            /*�������� ������ �����*/


            $_SESSION["success_messages"] = "<p class='success_message'>��������� �".$CurrentInsertRequestID." ������� ������� <br /><br />��������� �".$CurrentInsertRequestID." �������</p>";

            /*//���������� ������������ �� �������� �����������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");*/

            //���������� ������������ �� �������� ���������
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_request.php");
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
values(null,'"."uploads/"."', '".$name . "', '" . $CurrentInsertRequestID."' )");
                } else {
                    echo '<p>' . $error . '</p>';
                }
            }
        }

        /*������ �� ���������� ������ �����*/

        /* ���������� ������� */
        $result_query_insert->close();


//��������� ����������� � ��
        $mysqli->close();


    } else {

        exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=" . $address_site . "> ������� �������� </a>.</p>");
    }
}
?>