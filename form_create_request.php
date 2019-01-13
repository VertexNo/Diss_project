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
    $caption = '';
    $short_description = '';
    $description = '';
    $fk_create_user_id = $_SESSION['user_id'];
    $date_create = date("Y-m-d H:i:s");
    $fk_status_id = 1;
    ?>
    <!-- Сделать проверку. Если в статусе закрыто - то сделать поля неактивными -->
    <br><h1> Авторизованы</h1>
    <form action="create_request.php" id="form_request" method="post">
        <div class="input">            Создать обращение

            <!--Скрытые поля для того чтобы потом добавить в базу -->
            <div class="input" hidden><input type="text" hidden id="fk_create_user_id" required="required" name="fk_create_user_id" value="<?php echo $fk_create_user_id?>"/></div>
            <div class="input" hidden><input type="text" hidden id="date_create" required="required" name="date_create" value="<?php echo $date_create?>"/></div>
            <div class="input" hidden><input type="text" hidden id="fk_status_id" required="required" name="fk_status_id" value="<?php echo $fk_status_id?>"/></div>


            <div class="pole">
                <label>Заголовок:</label>
                <div class="input"><input type="text" id="caption" required="required" name="caption" value="<?php echo $caption?>"/></div>
                <span id="valid_caption_message" class="mesage_error"></span>
            </div>

            <div class="pole">
                <label>Краткое описание:</label>
                <div class="input"><input type="text"  id="short_description" required="required" name="short_description" value="<?php echo $short_description ?>"/></div>
                <span id="valid_short_description_message" class="mesage_error"></span>
            </div>
            <div class="pole">
                <label>Полное описание проблемы:</label>
                <div class="input"><textarea id="description" required="required" name="description"> <?php echo $description ?> </textarea></div>
                <span id="valid_description_message" class="mesage_error"></span>
            </div>
            <div class="pole">
                <label>Исполнитель:</label>
                <select name="option3" class="cellbut">
                <!--<select name="option3" class="cellbut">-->
                <?php //Option для выбора пользователя

                $result_query_users = $mysqli->query("select user_id,concat(last_name, \" \",first_name,\" \", \"(\",email,\")\") as userRespons from users where user_id >0 and fk_role_id =2");
                $result_query_num_users = mysqli_num_rows($result_query_users);
                for ($i=0; $i <$result_query_num_users; $i++)
                { /*Сделать проверку на текущий статус в заявке и выводимыми статусами*/
                    $result = mysqli_fetch_array($result_query_users);
                        echo '<option required="required"> ' . $result['userRespons'] . '</option>';

                }
                ?>
                </select>
            </div>


            <div class="pole">
                <label>Приоритет:</label>
                <?php
                    echo '<select name="option2" class="cellbut">';
                ?>
                <!--<select name="option2" class="cellbut">-->
                <?php //Option для выбора приоритета

                $result_query_priority = $mysqli->query("select priority_id,priority_name from priority where priority_id >0");
                $result_query_num_priority = mysqli_num_rows($result_query_priority);
                for ($i=0; $i <$result_query_num_priority; $i++)
                { /*Сделать проверку на текущий приоритет в заявке и выводимыми приоритетами*/
                    $result = mysqli_fetch_array($result_query_priority);
                        echo '<option required="required"> '.$result['priority_name'].'</option>';


                }
                ?>
                </select>
            </div>
            <div class="pole">
                <label>Тип проблемы / услуги:</label>
                <?php
                    echo '<select name="option4" class="cellbut">';
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

                                $tree .= "<option required=\"required\" >".$cat['service_name'];

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
            <input type="submit" name="btn_create_request" value="Сохранить">
            <input type="submit" name="cancel_request" value="Отмена">
            <input type="reset" name="reset_request" value="Сброс">

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
        <br><br><h1>Для создания обращений, требуется авторизация</h1>
    </div>
    <?php
}

//Подключение подвала
require_once("footer.php");
?>


