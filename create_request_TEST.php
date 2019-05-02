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

        echo "resultMethodID=".$resultMethodID;

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
            default:
                {

                }break;
        }





        //����� ������ ������������� ������*********************************




//������ �� �������� ��������� � ��

//��������� ����������� � ��
        $mysqli->close();


    } else {

        exit("<p><strong>������!</strong> �� ����� �� ��� �������� ��������, ������� ��� ������ ��� ���������. �� ������ ������� �� <a href=" . $address_site . "> ������� �������� </a>.</p>");
    }
}
?>