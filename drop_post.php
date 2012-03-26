<?php
session_start();//запускаем сессии
include ("bd.php");//подключаемс€ к базе

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//если существует логин и пароль в сесси€х, то провер€ем, действительны ли они
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //данные пользовател€ неверны. 
    exit("¬ход на эту страницу разрешен только зарегистрированным пользовател€м!");
   }
}
else {
//ѕровер€ем, зарегистрирован ли вошедший
exit("¬ход на эту страницу разрешен только зарегистрированным пользовател€м!"); }
$id2 = $_SESSION['id']; //получаем идентификатор своей страницы


if (isset($_GET['id'])) { $id = $_GET['id'];}//получаем через GET запрос идентификатор сообщени€, которое нужно удалить

$result = mysql_query("SELECT poluchatel FROM messages WHERE id='$id'",$db); 
$myrow = mysql_fetch_array($result); //нужно уточнить, кому сообщение отправлено
//ведь через GET запрос пользователь может ввести любой идентификатор и как следствие удалить сообщени€, которые отправл€ли не ему.

if ($login == $myrow['poluchatel']) {//если сообщение отправл€ли данному пользователю, то разрешаем его удалить

$result = mysql_query ("DELETE FROM messages WHERE id = '$id' LIMIT 1");//удал€ем сообщение
if ($result == 'true') {//если удалено - перенаправл€ем на страничку пользовател€
echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$id2."'></head><body>¬аше сообщение удалено! ¬ы будете перемещены через 5 сек. ≈сли не хотите ждать, то <a href='page.php?id=".$id2."'>нажмите сюда.</a></body></html>";
}
else {//если не удалено, то перенаправл€ем, но выдаем сообщение о неудаче
echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$id2."'></head><body>ќшибка! ¬аше сообщение не удалено. ¬ы будете перемещены через 5 сек. ≈сли не хотите ждать, то <a href='page.php?id=".$id2."'>нажмите сюда.</a></body></html>"; }

}
else {exit("¬ы пытаетесь удалить сообщение, отправленное не вам!");} //если сообщение отправлено не этому пользователю. «начит, он попыталс€ удалить его, введ€ в адресной строке какой-то другой идентификатор
?>