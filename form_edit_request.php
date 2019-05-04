<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 006 06.01.19
 * Time: 17:59
 */
require_once("dbconnect.php"); // подключаем содержимое файла text.php
require_once("header.php");

?>
<link rel="stylesheet" type="text/css" href="css/create_edit_request_style.css">
<link rel="stylesheet" type="text/css" href="css/comments_style.css">
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

    <?php
    $request_id = $_GET['request'];

    $result_query_select = $mysqli->query("select req.request_id as request_id,
req.caption as caption,
req.short_description as short_description,
req.description as description,
req.date_create as date_create,
IFNULL(req.date_start_work, 'Не взята на исполнение') as date_start_work, 
IFNULL(req.date_resolve, 'Не решена') as date_resolve, 
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

        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Данное обращение было удалено</p>";

        //Возвращаем пользователя на страницу авторизации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_auth.php");

        //Останавливаем скрипт
        exit();
    }

    ?>
    <!-- Сделать проверку. Если в статусе закрыто - то сделать поля неактивными -->
    <br><br>
    <form action="update_request.php" id="form_request" method="post" enctype="multipart/form-data">
        <div class="input">
            <label class = "MainHeaderLabel">Редактирование обращения</label><br><br>
            <hr><br>
            <?php
            if($row_request['status_id']==5)
            {
                echo '<br> Данное обрашение было закрыто. Редактирование запрещено <br> 
чтобы редактировать обращение, переоткройте его соответсвутющей кнопкой';
            }
            ?>
            <div class="input"><input type="text" hidden id="date_start_work" name="date_start_work" value="<?php echo $row_request['date_start_work'] ?>"/></div>
            <div class="input"><input type="text" hidden id="date_resolve" name="date_resolve" value="<?php echo $row_request['date_resolve'] ?>"/></div>

            <div class="pole">
                <label class = "HeadersLabel">Номер:</label>
                <div class="input"><input readonly type="text" id="request_id" required="required" name="request_id" value="<?php echo $request_id ?>"/></div>

        </div>
        <div class="pole">
            <label class = "HeadersLabel">Заголовок:</label>
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
            <label class = "HeadersLabel">Краткое описание:</label>
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
            <label class = "HeadersLabel">Полное описание проблемы:</label>
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
            <label class = "HeadersLabel">Текущий исполнитель:</label>
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
                <?php //Option для выбора пользователя

                $result_query_users = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and fk_role_id =2");
                $result_query_num_users = mysqli_num_rows($result_query_users);
                for ($i=0; $i <$result_query_num_users; $i++)
                { /*Сделать проверку на текущий статус в заявке и выводимыми статусами*/
                    $result = mysqli_fetch_array($result_query_users);

                    if($row_request['userResponsID'] == $result['user_id'])
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
            <label>Статус:</label>
            <?php
            if($row_request['status_id']==5)
            {
                echo '<select name="option1" id="option1" class="cellbut" disabled>';
            }
            else
            {
                echo '<select name="option1" id="option1" class="cellbut">';
            }
            ?>
            <!--<select name="option1" class="cellbut">-->
                <?php //Option для выбора статуса

                $result_query_status = $mysqli->query("select status_id,status_name from status where status_iD >0");
                $result_query_num_status = mysqli_num_rows($result_query_status);
                for ($i=0; $i <$result_query_num_status; $i++)
                { /*Сделать проверку на текущий статус в заявке и выводимыми статусами*/
                    $result = mysqli_fetch_array($result_query_status);

                    if($row_request['status_id'] == $result['status_id'])
                    {
                        echo '<option value="'.$result['status_name'].'" required="required" selected> '.$result['status_name'].'</option>';
                    }
                    else {
                        echo '<option value="'.$result['status_name'].'" required="required"> '.$result['status_name'].'</option>';
                    }


                }
                ?>
            </select>
        </div>

            <script>
                $(document).ready(function(){
                    $("#option1").click(function(){
                        var a = $("#option1").val();
                        var b = $("#request_id").val();
                        $.post('check_status.php', {id:a, reqid:b}, function(data){
                            $("#block").html(data);
                        });
                    });
                });
            </script>

            <div class="pole">
                <div id="block"></div>

            </div>



        <div class="pole">
            <label class = "HeadersLabel">Приоритет:</label>
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
                <?php //Option для выбора приоритета

                $result_query_priority = $mysqli->query("select priority_id,priority_name from priority where priority_id >0");
                $result_query_num_priority = mysqli_num_rows($result_query_priority);
                for ($i=0; $i <$result_query_num_priority; $i++)
                { /*Сделать проверку на текущий приоритет в заявке и выводимыми приоритетами*/
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
            <label class = "HeadersLabel">Тип проблемы / услуги:</label>
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

                // вызываем функцию и строим дерево
                echo create_tree ($cats, 0, $row_request['service_id']);

                ?>
            </select>
        </div>
            <div class="pole">
                <label class = "HeadersLabel">Напишите ваш комментарий к задаче:</label>
                <div class="input"><textarea id="current_comment" name="current_comment"></textarea></div>
                <span id="valid_description_message" class="mesage_error"></span>
            </div>

            <div class="pole">
                <label class = "HeadersLabel">Прикрепления:</label>
            <?php //Вывод ссылок на прикрепления
            $result_query_attachments = $mysqli->query("select attachment_url,attachment_name from Attachments where fk_request_id = ".$request_id);
            $result_query_num_attachments = mysqli_num_rows($result_query_attachments);
            for ($i=0; $i <$result_query_num_attachments; $i++)
            {
                $result = mysqli_fetch_array($result_query_attachments);
                echo '<a href='.$result['attachment_url'].$result['attachment_name'].'>'.$result['attachment_name'].'</a><br>';
            }
            ?>
            </div>
            <input type="file" name="file[]" multiple>

        </div>

        <div class="sub">
            <input type="submit" name="btn_update_request" value="Сохранить">
            <input type="submit" name="cancel_request" value="Отмена">
            <input type="reset" name="reset_request" value="Сброс">
            <?php
            if($row_request['status_id']==5)
            {
                echo '<input type="submit" name="reopen_request" value="Переоткрыть">';
            }
            else
            {
                echo '<input type="submit" name="reopen_request" value="Переоткрыть" hidden>';
            }
            ?>

        </div>
    </form>
    <!--/*Старт формы комментов*/-->
        <?php

        $query = "select comment_id,comment_text,comment_date, rf_user_id,users.last_name as last_name,users.first_name as first_name,users.email as email, rf_request_id 
from comments 
inner join users on comments.rf_user_id = users.user_id
where rf_request_id=".$request_id." ORDER BY comment_id DESC ";


        $result_query_requests = $mysqli->query($query);


        $result_query_num_requests = mysqli_num_rows($result_query_requests);
        ?>
    <form action="update_request.php" id="form_comment" method="post" enctype="multipart/form-data">
        <div class="input">
            <div class="header">
                <label class = "MainHeaderLabel">Комментарии к заявке</label><br><br></div>
            <hr>

        <?php
        for ($i=0; $i <$result_query_num_requests; $i++)
        {
            $result = mysqli_fetch_array($result_query_requests);

            //echo 'RequestId = '.$result['request_id'];
            ?>
            <div class="layout">
                <div class="comm_date">
                    <?php echo date("d.m.Y H:i:s", strtotime($result['comment_date']))?>
                </div>
                <div class="comm_user">
                    <?php echo $result['last_name'].' '.$result['first_name'].' ('.$result['email'].')'?>
                </div>
                <div class="comm_text">
                    <?php echo $result['comment_text']?>
                </div>
            </div>
            <hr>
            <br>
            <?php
        }
        ?>

        </div>
    </form>
    <?php

    $mysqli->close();
    ?>

    <?php
}else{
    ?>
    <div id="authorized">
        <br><br><h1>Для редактирования обращений, требуется авторизация</h1>
    </div>
    <?php
}

//Подключение подвала
require_once("footer.php");
?>


