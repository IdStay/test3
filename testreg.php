<?php
session_start();// ��� ��������� �������� �� �������. ������ � ��� �������� ������ ������������, ���� �� ��������� �� �����. ����� ����� ��������� �� � ����� ������ ���������!!!
		  
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //������� ��������� ������������� ����� � ���������� $login, ���� �� ������, �� ���������� ����������
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//������� ��������� ������������� ������ � ���������� $password, ���� �� ������, �� ���������� ����������

if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
{
echo("�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!");
//exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!</body></html>"); //������������� ���������� ��������� � ������ ������������� ����� ������
}
//���� ����� � ������ �������,�� ������������ ��, ����� ���� � ������� �� ��������, ���� �� ��� ���� ����� ������
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//������� ������ �������
$login = trim($login);
$password = trim($password);


// ���������� �����********************************************

// ������������ � ����
include ("bd.php");// ���� bd.php ������ ���� � ��� �� �����, ��� � ��� ���������, ���� ��� �� ���, �� ������ �������� ���� 

// ������������ �� ������ �������
$ip=getenv("HTTP_X_FORWARDED_FOR");
if (empty($ip) || $ip=='unknown') { $ip=getenv("REMOTE_ADDR"); }

mysql_query ("DELETE FROM oshibka WHERE UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 900");//������� ip-������ ����������� ��� ����� ������������� ����� 15 �����.

$result = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);// ��������� �� ���� ����������� ��������� ������� ����� �� ��������� 15 ����� � ������������ � ������ ip
$myrow = mysql_fetch_array($result);

if ($myrow['col'] > 2) {
echo("�� ������� ����� ��� ������ ������� 3 ����. ��������� 15 ����� �� ��������� �������.");
//exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>�� ������� ����� ��� ������ ������� 3 ����. ��������� 15 ����� �� ��������� �������.</body></html>"); //������������� ���������� ���������


}

$password = md5($password);//������� ������
$password = strrev($password);// ��� ���������� ������� ������
$password = $password."b3p6f";
//����� �������� ��������� ����� �������� �� �����, ��������, ������ "b3p6f". ���� ���� ������ ����� ���������� ������� ������� � ���� �� ������� ���� �� md5,�� ���� ������ �������� �� ������. �� ������� ������� ������ �������, ����� � ������ ������ ��� � ��������.

//��� ���� ���������� ��������� ����� ���� password � ����. ������������� ������ ����� ��������� ������� �������� �������.


$result = mysql_query("SELECT * FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); //��������� �� ���� ��� ������ � ������������ � ��������� �������
//�� �������� �AND activation='1'�, �� ���� ������������ ����� �������� ������ ����� ��������������. ���������� �������� ��� ������� � ������ �������� ��������� ������ ������������
$myrow = mysql_fetch_array($result);
if (empty($myrow['id']))
{
//���� ������������ � ��������� ������� � ������� �� ����������,�� ���������� ip ������������ � � ����� ������

$select = mysql_query ("SELECT ip FROM oshibka WHERE ip='$ip'");
$tmp = mysql_fetch_row ($select);
if ($ip == $tmp[0]) {
//���������, ���� �� ������������ � ������� "oshibka"
$result52 = mysql_query("SELECT col FROM oshibka WHERE ip='$ip'",$db);
$myrow52 = mysql_fetch_array($result52);

$col = $myrow52[0] + 1;//���� ����,�� �������������� ��������� 
mysql_query ("UPDATE oshibka SET col=$col,date=NOW() WHERE ip='$ip'");
}

else {
//���� �� ��������� 15 ����� ������ �� ����, �� ��������� ����� ������ � ������� "oshibka"
mysql_query ("INSERT INTO oshibka (ip,date,col) VALUES ('$ip',NOW(),'1')");
}
echo("��������, �������� ���� ����� ��� ������ ��������.");
//exit ("<html><head><meta http-equiv='Refresh' content='2; URL=$_SERVER[HTTP_REFERER]'></head><body>��������, �������� ���� ����� ��� ������ ��������.</body></html>");//������������� ���������� ���������

}
else {

          //���� ������ ���������, �� ��������� ������������ ������! ������ ��� ����������, �� �����!
          $_SESSION['password']=$myrow['password']; 
		  $_SESSION['login']=$myrow['login']; 
          $_SESSION['id']=$myrow['id'];//��� ������ ����� ����� ������������, ��� �� � ����� "������ � �����" �������� ������������
		  
//����� �� ���������� ������ � ����, ��� ������������ �����.
//��������!!! ������� ��� �� ���� ����������, ��� ��� ������ �������� � ����� ��� ��������

if (isset($_POST['save'])){
//���� ������������ �����, ����� ��� ������ ����������� ��� ������������ �����, �� ��������� � ����� ��� ��������
setcookie("login", $_POST["login"], time()+9999999);
setcookie("password", $_POST["password"], time()+9999999);
setcookie("id", $myrow['id'], time()+9999999);
}

if (isset($_POST['autovhod'])){
//���� ������������ ����� ������� �� ���� �������������
setcookie("auto", "yes", time()+9999999);
setcookie("login", $_POST["login"], time()+9999999);
setcookie("password", $_POST["password"], time()+9999999);
setcookie("id", $myrow['id'], time()+9999999);}
}	

echo "<html><head><meta http-equiv='Refresh' content='0; URL=index.php'>�� ������ ����� � �������</head></html>";

//�������������� ������������ �� ������� ���������, ��� ��� � ������� �� ������� �����

?>