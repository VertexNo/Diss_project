<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 006 06.01.19
 * Time: 17:59
 */
require_once("dbconnect.php"); // ���������� ���������� ����� text.php

?>
<?php
/*

$result = $mysqli->query("select service_id,service_name,fk_service_id from service where service_id >0");

$cats = array(); // ��� ����� ��� ������ � ����������� ��������
// � ����� ��������� ������ ��� ������
  while($cat =  mysqli_fetch_assoc($result))
        $cats[$cat['fk_service_id']][] =  $cat;
// ����� ���� �������, ����������� �������, ������� ���������� ������ ���������
function create_tree ($cats,$fk_service_id){
  if(is_array($cats) and  isset($cats[$fk_service_id])){
    $tree = '<ul>';
    foreach($cats[$fk_service_id] as $cat){
       $tree .= "<li><a href='catalog.html?catid=".$cat['service_id']."'>".$cat['service_name']."</a>";
       $tree .=  create_tree ($cats,$cat['service_id']);
       $tree .= '</li>';
    }
    $tree .= '</ul>';
  }
  else return null;
return $tree;
}

// �������� ������� � ������ ������
echo create_tree ($cats, 0);*/
$user = ' t2i@t2i.ru �������� ������� (ti@ti.ru)';



echo 'USEREMAILbefore='.$user;
$user=preg_match_all("/\(([^()]*)\)/", $user, $matches);
$user = $matches[0][0];
$user=preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i",$user, $matches2);
$user=$matches2[0][0];
echo 'USEREMAIL2='.$user;
?>

    <?php
    echo 'fk_Role_id'.$_SESSION['fk_Role_id'];
    echo 'user_id'.$_SESSION['user_id'];

    $mysqli->close();
    ?>




