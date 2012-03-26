<?php
header("Content-Type: text/html; charset=utf-8");
?>
<html>
<head>
<title>Новости</title>
</head>

<body>

<?php
include("bd.php");
mysql_query("set character_set_client='utf8'");

mysql_query("set character_set_results='utf8'");

mysql_query("set collation_connection='utf8_general_ci'");
//print $db;
//var_dump($_POST);
if (isset($_POST['title'])); 
{
$title = $_POST['title'];
if ($title == '') { unset($title);}   
}
if (isset($_POST['text']));
{
$text = $_POST['text'];
if ($text == '') { unset($text);} 
}
if (isset($_POST['author']));
if ($author == '') { unset($author);} 
{
$author = $_POST['author'];    
}
if (isset($_POST['date']));
{
$date = $_POST['date'];
if ($date == '') { unset($date);} 
}


//if (empty($title) or empty($text)or empty($author) or empty($date)); //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
//{
//
//exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>Вы ввели не всю информацию, вернитесь назад и заполните все поля!</body></html>");//останавливаем выполнение сценариев

$insert_string = "INSERT INTO `news` (`title`, `text`, `author`, `date`) VALUES ('{$title}', '{$text}', '{$author}', '{$date}')";
//$insert_string2 = "INSERT INTO `news` (title, text, author, date) VALUES ($title, $text, $author`, $date)";

$result = mysql_query($insert_string,$db);

?>
</body>
</html>