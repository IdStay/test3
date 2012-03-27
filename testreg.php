<?php
session_start();// вся процедура работает на сессиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале странички!!!
		  
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
echo("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
//exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>Вы ввели не всю информацию, вернитесь назад и заполните все поля!</body></html>"); //останавливаем выполнение сценариев и делаем переадресацию назад рефреш
}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);


// дописываем новое********************************************

// подключаемся к базе
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 

// минипроверка на подбор паролей
$ip=getenv("HTTP_X_FORWARDED_FOR");
if (empty($ip) || $ip=='unknown') { $ip=getenv("REMOTE_ADDR"); }

mysql_query ("DELETE FROM oshibka WHERE UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 900");//удаляем ip-адреса ошибавшихся при входе пользователей через 15 минут.

$result = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);// извлекаем из базы колличество неудачных попыток входа за последние 15 минут у пользователя с данным ip
$myrow = mysql_fetch_array($result);

if ($myrow['col'] > 2) {
echo("Вы набрали логин или пароль неверно 3 раза. Подождите 15 минут до следующей попытки.");
//exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>Вы набрали логин или пароль неверно 3 раза. Подождите 15 минут до следующей попытки.</body></html>"); //останавливаем выполнение сценариев


}

$password = md5($password);//шифруем пароль
$password = strrev($password);// для надежности добавим реверс
$password = $password."b3p6f";
//можно добавить несколько своих символов по вкусу, например, вписав "b3p6f". Если этот пароль будут взламывать методом подбора у себя на сервере этой же md5,то явно ничего хорошего не выйдет. Но советую ставить другие символы, можно в начале строки или в середине.

//При этом необходимо увеличить длину поля password в базе. Зашифрованный пароль может получится гораздо большего размера.


$result = mysql_query("SELECT * FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); //извлекаем из базы все данные о пользователе с введенным логином
//мы дописали «AND activation='1'», то есть пользователь будет искаться только среди активированных. Желательно добавить это условие к другим подобным проверкам данных пользователя
$myrow = mysql_fetch_array($result);
if (empty($myrow['id']))
{
//если пользователя с введенным логином и паролем не существует,то записываем ip пользователя и с датой ошибки

$select = mysql_query ("SELECT ip FROM oshibka WHERE ip='$ip'");
$tmp = mysql_fetch_row ($select);
if ($ip == $tmp[0]) {
//проверяем, есть ли пользователь в таблице "oshibka"
$result52 = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);
$myrow52 = mysql_fetch_array($result52);

$col = $myrow52[0] + 1;//Если есть,то приплюсовываем количесво 
mysql_query ("UPDATE oshibka SET col=$col,date=NOW() WHERE ip='$ip'");
}

else {
//если за последние 15 минут ошибок не было, то вставляем новую запись в таблицу "oshibka"
mysql_query ("INSERT INTO oshibka (ip,date,col) VALUES ('$ip',NOW(),'1')");
}
echo("Извините, введённый вами логин или пароль неверный.");
//exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>Извините, введённый вами логин или пароль неверный.</body></html>");//останавливаем выполнение сценариев

}
else {

          //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
          $_SESSION['password']=$myrow['password']; 
		  $_SESSION['login']=$myrow['login']; 
          $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
		  
//Далее мы запоминаем данные в куки, для последующего входа.
//ВНИМАНИЕ!!! ДЕЛАЙТЕ ЭТО НА ВАШЕ УСМОТРЕНИЕ, ТАК КАК ДАННЫЕ ХРАНЯТСЯ В КУКАХ БЕЗ ШИФРОВКИ

if (isset($_POST['save'])){
//Если пользователь хочет, чтобы его данные сохранились для последующего входа, то сохраняем в куках его браузера
setcookie("login", $_POST["login"], time()+9999999);
setcookie("password", $_POST["password"], time()+9999999);
setcookie("id", $myrow['id'], time()+9999999);
}

if (isset($_POST['autovhod'])){
//Если пользователь хочет входить на сайт автоматически
setcookie("auto", "yes", time()+9999999);
setcookie("login", $_POST["login"], time()+9999999);
setcookie("password", $_POST["password"], time()+9999999);
setcookie("id", $myrow['id'], time()+9999999);}
}	

echo "<html><head><meta http-equiv='Refresh' content='0; URL=index.php'>Вы удачно вошли в систему</head></html>";

//перенаправляем пользователя на главную страничку, там ему и сообщим об удачном входе

?>