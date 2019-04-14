<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 030 30.10.18
 * Time: 20:44
 */
//Добавляем файл подключения к БД
require_once("dbconnect.php");

if(isset($_POST["id"])) {


    //echo '$_POST["id"]='.iconv('utf-8', 'Windows-1251', $_POST["id"]);
    $status =  trim(iconv('utf-8', 'Windows-1251', $_POST["id"]));

    $status = htmlspecialchars($status, ENT_QUOTES);

    $request_id =  trim(iconv('utf-8', 'Windows-1251', $_POST["reqid"]));

    $request_id= htmlspecialchars($request_id, ENT_QUOTES);


    //Проверяем, нет ли уже такого адреса в БД.
    $result_query = $mysqli->query("select status_id,status_name from status where status_iD >0 and status_name='" . $status . "'");

    $result_query_req = $mysqli->query("select evaluation_id from requests where request_id='".$request_id."'");

    if($result_query_req->num_rows == 1) {
        $row_evaluation_id = mysqli_fetch_assoc($result_query_req);
        $evaluation_id = $row_evaluation_id['evaluation_id'];
    }
    else $evaluation_id = 0;

        //Если кол-во полученных строк ровно единице, значит, пользователь с таким почтовым адресом уже зарегистрирован
    if($result_query->num_rows == 1){

        $row_status = mysqli_fetch_assoc($result_query);

        if($row_status['status_id'] != 4)
        {
            echo '<select name="option5" class="cellbut" style=\'display: none\'>';
            $result_query_evaluation = $mysqli->query("select evaluation_id,evaluation_name from request_performance_evaluation");
            $result_query_num_evaluation = mysqli_num_rows($result_query_evaluation);
            for ($i=0; $i <$result_query_num_evaluation; $i++)
            {
                $result = mysqli_fetch_array($result_query_evaluation);

                if($evaluation_id == $result['evaluation_id'])
                {
                    echo '<option selected>'.$result['evaluation_name'].'</option>';
                }
                else {
                    echo '<option>'.$result['evaluation_name'].'</option>';
                }
            }
        }
        else
        {
            echo '<label>Оцените исполнение заявки:</label>';
            echo '<select name="option5" class="cellbut">';

                $result_query_evaluation = $mysqli->query("select evaluation_id,evaluation_name from request_performance_evaluation");
                $result_query_num_evaluation = mysqli_num_rows($result_query_evaluation);
                for ($i=0; $i <$result_query_num_evaluation; $i++)
                {
                    $result = mysqli_fetch_array($result_query_evaluation);

                    if($evaluation_id == $result['evaluation_id'])
                    {
                        echo '<option selected>'.$result['evaluation_name'].'</option>';
                    }
                    else {
                        echo '<option>'.$result['evaluation_name'].'</option>';
                    }
                }

        }




    }else{
    }

    // закрытие выборки
    $result_query->close();
}
?>