<html>
<head>
<title>BD</title>
<?php
define("DB_HOST", "localhost") //хост
define("DB_LOGIN", "user1"); // пользователь
define("DB_PASSWORD", "1234"); //пароль
define("DB_NAME", "registration");
$db = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("помилка");
mysql_select_db(DB_NAME,$db) or die(mysql_error());

function clearData($data){
    return trim(strip_tags($data));
}
if(!empty($_POST['name']) and !empty($_POST['email'])){
    $n=clearData($_POST['name']);
    $e=clearData($POST['email']);
    $m=clearData($_POST['msg']);
    $sql="INSERT INTO msgs (name,email,msg) VALUES('$n','$e','$m')";
    mysql_query($sql) or die(mysql_error());
    header("Location: http://localhost/test3/news/database.php");
}

$result = mysql_query("SELECT * FROM news",$db);
$myrow = mysql_fetch_array($result);
echo $myrow["text"]
?> 