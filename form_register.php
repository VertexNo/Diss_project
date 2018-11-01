<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 029 29.10.18
 * Time: 21:35
 */
require_once("dbconnect.php"); // подключаем содержимое файла text.php
require_once("header.php");

?>

<!-- Блок для вывода сообщений -->
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
if(isset($_SESSION["email"]) && isset($_SESSION["password"]) && ($_SESSION['fk_Role_id'])==1){ //убрал "НЕ"
    ?>
    <div id="form_register">
        <h2>Форма регистрации</h2>

        <form action="register.php" method="post" name="form_register">
            <table>
                <tbody><tr>
                    <td> Имя: </td>
                    <td>
                        <input type="text" name="first_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> Фамилия: </td>
                    <td>
                        <input type="text" name="last_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> Email: </td>
                    <td>
                        <input type="email" name="email" required="required"><br>
                        <span id="valid_email_message"></span>
                    </td>
                </tr>

                <tr>
                    <td> Пароль: </td>
                    <td>
                        <input type="password" name="password" placeholder="минимум 6 символов" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td> Введите капчу: </td>
                    <td>
                        <p>
                            <img src="captcha.php" alt="Капча" /> <br><br>
                            <input type="text" name="captcha" placeholder="Проверочный код" required="required">
                        </p>
                    </td>
                </tr>

                <tr>
                    <td> Роль регистрируемого пользователя: </td>
                    <td>
                        <select name="option1" class="cellbut">
                            <?php //Option для выбора пользователя

                            $result_query_roles = $mysqli->query("select Role_name from roles where Role_id >0");
                            $result_query_num_roles = mysqli_num_rows($result_query_roles);
                            for ($i=0; $i <$result_query_num_roles; $i++)
                            {
                                $result = mysqli_fetch_array($result_query_roles);
                                echo '<option required="required"> '.$result['Role_name'].' </option>';

                            }
                            ?>
                            </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_register" value="Зарегистрироватся!">
                    </td>
                </tr>
                </tbody></table>
        </form>
    </div>
    <?php
    $mysqli->close();
    ?>
    <?php
}else{
    ?>
    <div id="authorized">
        <h2>У вас нет прав для регистрации пользователей</h2>
    </div>
    <?php
}

//Подключение подвала
require_once("footer.php");
?>
