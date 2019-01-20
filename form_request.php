<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 004 04.01.19
 * Time: 16:09
 */
require_once("dbconnect.php"); // подключаем содержимое файла text.php
require_once("header.php");

?>
<link rel="stylesheet" type="text/css" href="css/filter_request_style.css">
<div class="block_for_messages">
    <?php
    //Если в сессии существуют сообщения об ошибках, то выводим их
    if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
        echo $_SESSION["error_messages"];

        //Уничтожаем чтобы не выводились заново при обновлении страницы
        unset($_SESSION["error_messages"]);
    }

    //Если в сессии существуют радостные сообщения, то выводим их
    if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
        echo $_SESSION["success_messages"];

        //Уничтожаем чтобы не выводились заново при обновлении страницы
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>
<?php
//Проверяем, если пользователь не авторизован, то выводим форму регистрации,
//иначе выводим сообщение о том, что он уже зарегистрирован
if(isset($_SESSION["email"]) && isset($_SESSION["password"]) /*&& ($_SESSION['fk_Role_id'])==1*/){ //убрал "НЕ"
    ?>

    <br><h1>Авторизованы</h1>
    <button onclick="location.href='./form_create_request.php'">Создать обращение</button>
     <?php //ПРЕФИЛЬТР

    $query="
select req.request_id as request_id,
req.caption as caption,
req.short_description as short_description,
req.date_create as date_create,
IFNULL(req.date_resolve, 'Не решена') as date_resolve, 
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
where request_id > 0";

    //Префильтр дл конкретного типа роли пользователя
    $prefilter = '';
    switch ($_SESSION['fk_Role_id'])
    {
        case 1: $prefilter = ' '; break;
        case 2: $prefilter = ' and userRespons.user_id = '.$_SESSION['user_id']; break;
        case 3: $prefilter = ' and userCreate.user_id = '.$_SESSION['user_id']; break;
        default: $prefilter = ' '; break;
    }


    //Фильтр для выбранных значений

    //Номер обращения
    $filter_request_id= '';
    if(isset($_POST['filter_request_id']) and $_POST['filter_request_id']!='') {
        $filter_request_id =' And req.request_id='.$_POST['filter_request_id'];
    }

    //Заголовок обращения
    $filter_caption= '';
    if(isset($_POST['filter_caption']) and $_POST['filter_caption']!='') {
        $filter_caption =' And req.caption like \'%'.$_POST['filter_caption'].'%\'';
    }

    //Краткое описание filter_short_description
    $filter_short_description = '';
    if(isset($_POST['filter_short_description']) and $_POST['filter_short_description']!='') {
        $filter_caption =' And req.short_description like \'%'.$_POST['filter_short_description'].'%\'';
    }

    //Создатель обращения
     if(isset($_POST['option1']) and $_POST['option1']!='' and $_POST['option1']!='Все пользователи') {

         $userCreate = trim($_POST["option1"]);
         $userCreate = htmlspecialchars($userCreate, ENT_QUOTES);

         //поиск сначала значений в скобках, потом берем email регулярками
         $userCreate = preg_match_all("/\(([^()]*)\)/", $userCreate, $matches);
         $userCreate = $matches[0][0];
         $userCreate = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $userCreate, $matches2);
         $userCreate = $matches2[0][0];

         $result_query_userCreate = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userCreate from users where user_id >0 
and fk_role_id =3 and email='" . $userCreate . "'");
         $userCreateID = mysqli_fetch_assoc($result_query_userCreate);
         $resultUserCreateID = $userCreateID['user_id'];

         $filter_user_create_id= ' And req.fk_create_user_id='.$resultUserCreateID;
     }

    //Исполнитель обращения
    if(isset($_POST['option2']) and $_POST['option2']!='' and $_POST['option2']!='Все исполнители') {

        $userRespons = trim($_POST["option2"]);
        $userRespons = htmlspecialchars($userRespons, ENT_QUOTES);

        //поиск сначала значений в скобках, потом берем email регулярками
        $userRespons = preg_match_all("/\(([^()]*)\)/", $userRespons, $matches);
        $userRespons = $matches[0][0];
        $userRespons = preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $userRespons, $matches2);
        $userRespons = $matches2[0][0];

        $result_query_userRespons = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 
and fk_role_id =2 and email='" . $userRespons . "'");
        $userResponsID = mysqli_fetch_assoc($result_query_userRespons);
        $resultUserResponsID = $userResponsID['user_id'];

        $filter_user_respons_id= ' And req.fk_responsible_user_id='.$resultUserResponsID;
    }

    //Дата создания от
    $filter_date_create_begin = '';
    if(isset($_POST['filter_date_create_begin']) and $_POST['filter_date_create_begin']!='' and $_POST['filter_date_create_begin']!='дд.мм.гггг') {
        $filter_date_create_begin =' And req.date_create >=\''.$_POST['filter_date_create_begin'].'T00:00:00\' ';
    }

    //Дата создания до
    $filter_date_create_end = '';
    if(isset($_POST['filter_date_create_end']) and $_POST['filter_date_create_end']!='' and $_POST['filter_date_create_end']!='дд.мм.гггг') {
        $filter_date_create_end =' And req.date_create <=\''.$_POST['filter_date_create_end'].'T23:59:59\' ';
    }

    //Дата решения от
    $filter_date_resolve_begin = '';
    if(isset($_POST['filter_date_resolve_begin']) and $_POST['filter_date_resolve_begin']!='' and $_POST['filter_date_resolve_begin']!='дд.мм.гггг') {
        $filter_date_resolve_begin =' And req.date_resolve >=\''.$_POST['filter_date_resolve_begin'].'T00:00:00\' ';
    }

    //Дата решения до
    $filter_date_resolve_end = '';
    if(isset($_POST['filter_date_resolve_end']) and $_POST['filter_date_resolve_end']!='' and $_POST['filter_date_resolve_end']!='дд.мм.гггг') {
        $filter_date_resolve_end =' And req.date_resolve <=\''.$_POST['filter_date_resolve_end'].'T23:59:59\' ';
    }


    //Статус
     if(isset($_POST['status']) and $_POST['status']!='') {

         $selected_status = $_POST['status'];
         $filter_status_id = ' And req.fk_status_id in(';
         foreach($selected_status AS $key=>$values)
         {
             if($values!= 'Все статусы')
             {
                 $filtr_statusname = $arr;
                 $filtr_statusname = htmlspecialchars($filtr_statusname, ENT_QUOTES);
                 $result_query_Status_id = $mysqli->query("select status_id,status_name from status where status_iD >0 and status_name='" . $values . "'");
                 $statusid = mysqli_fetch_assoc($result_query_Status_id);
                 $resultStatusID = $statusid['status_id'];
                 $filter_status_id .= $resultStatusID.',';
             }
             else {
                 $result_query_Status_id = $mysqli->query("select status_id,status_name from status where status_iD >0");
                 $statusid = mysqli_fetch_assoc($result_query_Status_id);
                 $resultStatusID = $statusid['status_id'];
                 $filter_status_id .= $resultStatusID.',';


                 $result_query_status = $mysqli->query("select status_id,status_name from status where status_iD >0");
                 $result_query_num_status = mysqli_num_rows($result_query_status);
                 for ($i=0; $i <$result_query_num_status; $i++)
                 { /*Сделать проверку на текущий статус в заявке и выводимыми статусами*/
                     $result = mysqli_fetch_array($result_query_status);
                     $filter_status_id.=$result['status_id'].',';
                 }
                 break;
             }
         }
         $filter_status_id = trim($filter_status_id, ',');
         $filter_status_id .= ')';
     }


    //Приоритет
    if(isset($_POST['priority']) and $_POST['priority']!='') {

        $selected_priority = $_POST['priority'];
        $filter_priority_id = ' And req.fk_priority_id in(';
        foreach($selected_priority AS $key=>$values)
        {
            if($values!= 'Все приоритеты')
            {
                $filtr_priorityname = $arr;
                $filtr_priorityname = htmlspecialchars($filtr_priorityname, ENT_QUOTES);
                $result_query_Priority_id = $mysqli->query("select priority_id,priority_name from priority where priority_id >0 and priority_name='" . $values . "'");
                $priorityid = mysqli_fetch_assoc($result_query_Priority_id);
                $resultPriorityID = $priorityid['priority_id'];
                $filter_priority_id .= $resultPriorityID.',';
            }
            else {
                $result_query_Priority_id = $mysqli->query("select priority_id,priority_name from priority where priority_id >0");
                $priorityid = mysqli_fetch_assoc($result_query_Priority_id);
                $resultPriorityID = $priorityid['priority_id'];
                $filter_priority_id .= $resultPriorityID.',';


                $result_query_priority = $mysqli->query("select priority_id,priority_name from priority where priority_id >0");
                $result_query_num_priority = mysqli_num_rows($result_query_priority);
                for ($i=0; $i <$result_query_num_priority; $i++)
                { /*Сделать проверку на текущий статус в заявке и выводимыми статусами*/
                    $result = mysqli_fetch_array($result_query_priority);
                    $filter_priority_id.=$result['priority_id'].',';
                }
                break;
            }
        }
        $filter_priority_id = trim($filter_priority_id, ',');
        $filter_priority_id .= ')';
    }


    //Тип услуги
    if(isset($_POST['service']) and $_POST['service']!='') {

        $selected_service = $_POST['service'];
        $filter_service_id = ' And req.fk_service_id in(';
        foreach($selected_service AS $key=>$values)
        {
            if($values!= 'Все типы услуг')
            {
                $filtr_servicename = $arr;
                $filtr_servicename = htmlspecialchars($filtr_servicename, ENT_QUOTES);
                $result_query_Service_id = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0 and service_name='" . $values . "'");
                $serviceid = mysqli_fetch_assoc($result_query_Service_id);
                $resultServiceID = $serviceid['service_id'];
                $filter_service_id .= $resultServiceID.',';
            }
            else {
                $result_query_Service_id = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0");
                $serviceid = mysqli_fetch_assoc($result_query_Service_id);
                $resultServiceID = $serviceid['service_id'];
                $filter_service_id .= $resultServiceID.',';


                $result_query_service = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0");
                $result_query_num_service = mysqli_num_rows($result_query_service);
                for ($i=0; $i <$result_query_num_service; $i++)
                { /*Сделать проверку на текущий статус в заявке и выводимыми статусами*/
                    $result = mysqli_fetch_array($result_query_service);
                    $filter_service_id.=$result['service_id'].',';
                }
                break;
            }
        }
        $filter_service_id = trim($filter_service_id, ',');
        $filter_service_id .= ')';
    }

    //Префильтр для OrderBy
    $orderBy = '';
    $orderBy = ' order by status_id desc';


    //Проставляем условия префильтра
    $query.=$prefilter;



    //Проверяем были ли нажаты кнопки фильтрации или сброса фильтра
     if (isset($_POST["filter_submit"]) && !empty($_POST["filter_submit"])) {
         //Проставляем условия выбранных фильтров и очищаем
         $filtr .= $filter_request_id; $filter_request_id= '';
         $filtr .= $filter_caption; $filter_caption= '';
         $filtr .= $filter_short_description; $filter_short_description= '';
         $filtr .= $filter_user_create_id; $filter_user_create_id= '';
         $filtr .= $filter_user_respons_id; $filter_user_respons_id= '';
         $filtr .= $filter_date_create_begin; $filter_date_create_begin= '';
         $filtr .= $filter_date_create_end; $filter_date_create_end= '';
         $filtr .= $filter_date_resolve_begin; $filter_date_resolve_begin= '';
         $filtr .= $filter_date_resolve_end; $filter_date_resolve_end= '';
         $filtr .= $filter_status_id; $filter_status_id= '';
         $filtr .= $filter_priority_id; $filter_priority_id= '';
         $filtr .= $filter_service_id; $filter_service_id= '';
         $query.= $filtr;
     }
     //можно если что еще ELSE запилить если надо будет






    //в конце сортировка для префильтра / фильтра
    $query.=$orderBy;
    echo $filter_request_id;
    echo $query;


    ?>
    <!-- Скрипт для скрывающей панели -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.spoiler_links').click(function(){
                $(this).parent().children('div.spoiler_body').toggle('normal');
                return false;
            });
        });
    </script>
    <!-- ФОРМА ФИЛЬТРАЦИИ ОБРАЩЕНИЙ  -->
    <div>
        <a href="" class="spoiler_links">Фильтрация обращений</a>
        <div class="spoiler_body">
            <form action="form_request.php" method="post" id="form_request">

                <div class="input">Фильтрация обращений
                    <div class="pole">
                        <label>Номер:</label>
                        <div class="input"><input type="text" id="filter_request_id" name="filter_request_id"/></div>
                    </div>
                    <div class="pole">
                        <label>Заголовок:</label>
                        <div class="input"><input type="text" id="filter_caption" name="filter_caption"/></div>
                    </div>
                    <div class="pole">
                        <label>Краткое описание:</label>
                        <div class="input"><input type="text" id="filter_short_description" name="filter_short_description"/></div>
                    </div>

                    <div class="pole">
                        <label>Создатель:</label>
                        <select name="option1" class="cellbut">
                            <option selected >Все пользователи</option>
                            <?php //Option для выбора фильтра по создавшему заявку пользователю

                            $result_query_users = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userCreate from users where user_id >0 and fk_role_id =3");
                            $result_query_num_users = mysqli_num_rows($result_query_users);
                            for ($i=0; $i <$result_query_num_users; $i++)
                            {
                                $result = mysqli_fetch_array($result_query_users);
                                echo '<option > ' . $result['userCreate'] . '</option>';

                            }
                            ?>
                        </select>
                    </div>
                    <div class="pole">
                        <label>Исполнитель:</label>
                        <select name="option2" class="cellbut">
                            <option selected >Все исполнители</option>
                            <?php //Option для выбора фильтра по создавшему заявку пользователю

                            $result_query_users = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and fk_role_id =2");
                            $result_query_num_users = mysqli_num_rows($result_query_users);
                            for ($i=0; $i <$result_query_num_users; $i++)
                            {
                                $result = mysqli_fetch_array($result_query_users);
                                echo '<option > ' . $result['userRespons'] . '</option>';

                            }
                            ?>
                        </select>
                    </div>
                    <div class="pole">
                        <label>Дата создания от:</label>
                        <div class="input"><input type="date" id="filter_date_create_begin" name="filter_date_create_begin"/></div>
                        <label>Дата создания до:</label>
                        <div class="input"><input type="date" id="filter_date_create_end" name="filter_date_create_end"/></div>
                    </div>
                    <div class="pole">
                        <label>Дата решения от:</label>
                        <div class="input"><input type="date" id="filter_date_resolve_begin" name="filter_date_resolve_begin"/></div>
                        <label>Дата решения до:</label>
                        <div class="input"><input type="date" id="filter_date_resolve_end" name="filter_date_resolve_end"/></div>

                    </div>
                    <div class="pole">
                        <label>Статус:</label>
                        <select name="status[]" class="cellbut" multiple="yes" >
                        <option selected >Все статусы</option>
                        <?php //Option для выбора статуса
                        $result_query_status = $mysqli->query("select status_id,status_name from status where status_iD >0");
                        $result_query_num_status = mysqli_num_rows($result_query_status);
                        for ($i=0; $i <$result_query_num_status; $i++)
                        { /*Сделать проверку на текущий статус в заявке и выводимыми статусами*/
                            $result = mysqli_fetch_array($result_query_status);
                                echo '<option> '.$result['status_name'].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="pole">
                        <label>Приоритет:</label>
                        <select name="priority[]" class="cellbut" multiple="yes">
                        <option selected >Все приоритеты</option>
                        <?php //Option для выбора приоритета
                        $result_query_priority = $mysqli->query("select priority_id,priority_name from priority where priority_id >0");
                        $result_query_num_priority = mysqli_num_rows($result_query_priority);
                        for ($i=0; $i <$result_query_num_priority; $i++)
                        { /*Сделать проверку на текущий приоритет в заявке и выводимыми приоритетами*/
                            $result = mysqli_fetch_array($result_query_priority);
                            echo '<option> '.$result['priority_name'].'</option>';
                        }
                        ?>
                        </select>
                    </div>

                    <div class="pole">
                        <label>Тип проблемы / услуги:</label>
                        <select name="service[]" class="cellbut" multiple="yes">
                        <option selected >Все типы услуг</option>
                        <!--<select name="option4" class="cellbut">-->
                        <?php //Option для выбора услуги / проблемы
                        $result = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0");

                        $cats = array(); // тут будет наш массив с категориями каталога
                        // в цикле формируем нужный нам массив
                        while($cat =  mysqli_fetch_assoc($result))
                            $cats[$cat['fk_service_id']][] =  $cat;
                        // далее наша главная, рекурсивная функция, которая сформирует дерево категорий

                        function create_tree ($cats,$fk_service_id , $row_request){
                            if(is_array($cats) and  isset($cats[$fk_service_id])){
                                $tree = '';
                                foreach($cats[$fk_service_id] as $cat){
                                    $tree .= "<option>".$cat['service_name'];

                                    $tree .= '</option>';
                                    $tree .=  create_tree ($cats,$cat['service_id'], $row_request);

                                }
                            }
                            else return null;
                            return $tree;
                        }

                        // вызываем функцию и строим дерево
                        echo create_tree ($cats, 0, $row_request['service_id']);

                        ?>
                        </select>
                    </div>




                </div>

                <div class="sub">
                    <input name="filter_submit" type="submit" value="Отфильтровать"/>
                    <input name="filter_reset" type="submit" value="Сбросить фильтр"/>
                </div>

            </form>
        </div>
    </div>
    <br>
    <!--//-->
    <!--<div>
        <a href="" class="spoiler_links">Спойлер №2 (кликните для показа/скрытия)</a>
        <div class="spoiler_body">
            А это уже другой спойлер!<br>
            И он тоже работает!
        </div>
        <input type="button" value="Закрыть все"
               onclick=$("div[class^='spoiler_body']").hide('normal')>
        <input type="button" value="Открыть все"
               onclick=$("div[class^='spoiler_body']").show('normal')>
    </div>-->



    <!--/*Старт формы обращений*/-->
    <table>
        <thead><!-- необязательный тег-->
        <tr>
            <th>№ обращения</th>
            <th>Заголовок</th>
            <th>Краткое описание</th>
            <th>Дата создания</th>
            <th>Дата решения</th>
            <th>Обратился</th>
            <th>Исполнитель</th>
            <th>Обратившаяся организация</th>
            <th>Статус</th>
            <th>Приоритет</th>
            <th>Тип услуги</th>
        </tr>
        </thead>
        <tbody><!--необязательный тег-->
    <?php //Option для выбора организации

    //выполняем запрос
    //echo $query;
    $result_query_requests = $mysqli->query($query);


    $result_query_num_requests = mysqli_num_rows($result_query_requests);
    for ($i=0; $i <$result_query_num_requests; $i++)
    {
        $result = mysqli_fetch_array($result_query_requests);

        //echo 'RequestId = '.$result['request_id'];
    ?>
    <tr onclick="window.location='./form_edit_request.php?request=<?php echo $result['request_id'] ?>'"> <!--Передаем ID обращения-->
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
            <th>Ячейка заголовка</th>
            <th>Ячейка заголовка</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Ячейка данных</td>
            <td>Ячейка данных</td>
        </tr>
        <tr>
            <td>Ячейка данных</td>
            <td>Ячейка данных</td>
        </tr>
        </tbody>
    </table> -->


    <!--Конец формы обращений -->




    <?php
    echo 'fk_Role_id'.$_SESSION['fk_Role_id'];
    echo 'user_id'.$_SESSION['user_id'];

    $mysqli->close();
    ?>
    <?php
}else{
    ?>
    <div id="authorized">
        <br><br><h1>Для просмотра обращений, требуется авторизация</h1>
    </div>
    <?php
}

//Подключение подвала
require_once("footer.php");
?>


