<?php
session_start();

include ("bd.php");
if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//если существует логин и пароль в сессиях, то проверяем, действительны ли они
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //если данные пользователя не верны
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {
//Проверяем, зарегистрирован ли вошедший
exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>Вход на эту страницу разрешен только зарегистрированным пользователям!</body></html>"); }
?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="keywords" content="Сайт блог">
<meta name="description" content="Мой блог">

<link href="verstka-div.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="MainFrame">

<div class="header">
<a href="http://localhost/test3/index.php"><img src="img/header.gif" alt="Мой блог"></a>
</div>

<div class="LeftMenu">
<a class="menu" href="http://localhost/test3/index.php">Главная</a><br><br>

</div>


<div class="WorkArea">


<?php
//выводим меню


$result = mysql_query("SELECT login,id FROM users ORDER BY login",$db); //извлекаем логин и идентификатор пользователей
$myrow = mysql_fetch_array($result);
do
{
//выводим их в цикле
printf("<a href='page.php?id=%s'>%s</a><br>",$myrow['id'],$myrow['login']);
}
while($myrow = mysql_fetch_array($result));

?>

<div class="footer">Copyright &copy; <a href="http://localhost/test3/index.php">(с)2012 product</a></div>

</div>




</body>
</html>
