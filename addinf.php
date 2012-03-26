<?php
   session_start();
   header("Content-Type: text/html; charset=utf-8");


include ("bd.php");
if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//если существует логин и пароль в сессиях, то проверяем, действительны ли они
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1' AND type ='Administrator' or type='Redactor' ",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //если данные пользователя не верны
    exit("Вход на эту страницу разрешен только админам и редакторам");
   }
}
else {
//Проверяем, зарегистрирован ли вошедший
exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>Вход на эту страницу разрешен только администратору и редакторам!</body></html>"); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Мой блог</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="keywords" content="Мой блог" />
<meta name="description" content="Сайт блог" />
<link href="verstka-div.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="LeftMenu">
<br>
<br>
<br>
<br>
<a class="menu" href="http://localhost/test3/index.php">Главная Страница</a><br /><br />

<br /><br /><br /><br />
</div> 

<div class="WorkArea">
  <h1>Для добавления данных заполните форму:</h1>

<form name="form1" method="POST" action="database.php">

         <p>
           Название теми<br>
            <input type="text" style="border:1px silver solid; width:160px;" name="title" id="title">

         </p>
<p>
           Дата <br>
           <input name="date" style="border:1px silver solid; width:160px;" id="date" value='23/03/2012' >
 
         </p>

         <p>
           Автор <br>
           <input name="author" style="border:1px silver solid; width:160px;" type="text" id="author" value="Admin">

         </p>

<br>
  </p>
         <p>
           Ваш текст<br>
           <textarea name="text" style="border:1px silver solid; width:300px; cols="80" ></textarea>

       </p>

     <input name="submit" type="submit" value="Отправить">


</form>

<div class="footer"><center>Copyright &copy; <a href="http://localhost/test3/index.php" />2012 product</center></div>

</body>
</html>
