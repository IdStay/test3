<?php
session_start();
include ("bd.php");
if (isset($_COOKIE['auto']) and isset($_COOKIE['login']) and isset($_COOKIE['password']))
{//если есть необходимые переменные
	if ($_COOKIE['auto'] == 'yes') { // если пользователь желает входить автоматически, то запускаем сессии
		  $_SESSION['password']=strrev(md5($_COOKIE['password']))."b3p6f"; //в куках пароль был не зашифрованный, а в сессиях обычно храним зашифрованный
		  $_SESSION['login']=$_COOKIE['login'];//сессия с логином
		  $_SESSION['id']=$_COOKIE['id'];//идентификатор пользователя
		  $_SESSION['type']=$_COOKIE['type'];
		}	
	}

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//если существет логин и пароль в сессиях, то проверяем их и извлекаем аватар
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$type= $_SESSION['type'];
$result = mysql_query("SELECT id,avatar FROM users WHERE login='$login' AND password='$password' AND activation='1' AND type='$type'",$db); 
$myrow = mysql_fetch_array($result);

//извлекаем нужные данные о пользователе
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Мой блог</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><!-- <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /> -->
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="keywords" content="Мой блог" />
<meta name="description" content="Сайт блог" />
<link href="verstka-div.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="MainFrame">
<div class="header">
<a href="http://localhost/test3/index.php"><img src="img/header.gif" alt="Мой блог" /></a>
</div>

<div class="LeftMenu">
<a class="menu" href="http://localhost/test3/reg.php">Регистрация</a><br /><br />
<a class="menu" href="http://localhost/test3/send_pass.php">Забыли пароль?</a><br /><br />
<a class="menu" href="http://localhost/test3/all_users.php">Список пользователей</a><br /><br />

<a class="menu" href="http://localhost/test3/page.php?id=<?php print $_SESSION[id]?>">Моя Страница</a><br /><br />

<a class="menu" href="http://localhost/test3/material.php">Материали</a><br /><br />
<?php
// вся процедура работает на сесиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале странички!!!
session_start();
?>

<?php if (!isset ($_SESSION['id'])) : ?>
<form action="testreg.php" method="post">
<!--**** testreg.php - это адрес обработчика. То есть, после нажатия на кнопку "Войти", данные из полей отправятся на страничку testreg.php методом "post" ***** -->
  <p>
    <label>Ваш логин:<br /></label>
    <input name="login" type="text" size="15" maxlength="15" />
  </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->  
  <p>
    <label />Ваш пароль:<br />
    <input name="password" type="password" size="15" maxlength="15" />
  </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** -->  
<p>
<input type="submit" name="submit" value="Войти" />
<!--**** Кнопочка (type="submit") отправляет данные на страничку testreg.php ***** --> 
<br />
</p></form>
<br />
<br />
<?php endif;  ?>
</div> 

<div class="WorkArea">
<h2>Мой блог</h2>
<p>Привет всем. Рад видеть вас на своем сайте.Тут будут мои новости</p>
 
</form>

<div class="footer">Copyright &copy; <a href="http://localhost/test3/index.php" />2012 product</div>

</body>
</html>
