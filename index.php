<?php
session_start();
include ("bd.php");
if (isset($_COOKIE['auto']) and isset($_COOKIE['login']) and isset($_COOKIE['password']))
{//���� ���� ����������� ����������
	if ($_COOKIE['auto'] == 'yes') { // ���� ������������ ������ ������� �������������, �� ��������� ������
		  $_SESSION['password']=strrev(md5($_COOKIE['password']))."b3p6f"; //� ����� ������ ��� �� �������������, � � ������� ������ ������ �������������
		  $_SESSION['login']=$_COOKIE['login'];//������ � �������
		  $_SESSION['id']=$_COOKIE['id'];//������������� ������������
		  $_SESSION['type']=$_COOKIE['type'];
		}	
	}

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//���� ��������� ����� � ������ � �������, �� ��������� �� � ��������� ������
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$type= $_SESSION['type'];
$result = mysql_query("SELECT id,avatar FROM users WHERE login='$login' AND password='$password' AND activation='1' AND type='$type'",$db); 
$myrow = mysql_fetch_array($result);

//��������� ������ ������ � ������������
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>��� ����</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><!-- <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /> -->
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="keywords" content="��� ����" />
<meta name="description" content="���� ����" />
<link href="verstka-div.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="MainFrame">
<div class="header">
<a href="http://localhost/test3/index.php"><img src="img/header.gif" alt="��� ����" /></a>
</div>

<div class="LeftMenu">
<a class="menu" href="http://localhost/test3/reg.php">�����������</a><br /><br />
<a class="menu" href="http://localhost/test3/send_pass.php">������ ������?</a><br /><br />
<a class="menu" href="http://localhost/test3/all_users.php">������ �������������</a><br /><br />

<a class="menu" href="http://localhost/test3/page.php?id=<?php print $_SESSION[id]?>">��� ��������</a><br /><br />

<a class="menu" href="http://localhost/test3/material.php">���������</a><br /><br />
<?php
// ��� ��������� �������� �� ������. ������ � ��� �������� ������ ������������, ���� �� ��������� �� �����. ����� ����� ��������� �� � ����� ������ ���������!!!
session_start();
?>

<?php if (!isset ($_SESSION['id'])) : ?>
<form action="testreg.php" method="post">
<!--**** testreg.php - ��� ����� �����������. �� ����, ����� ������� �� ������ "�����", ������ �� ����� ���������� �� ��������� testreg.php ������� "post" ***** -->
  <p>
    <label>��� �����:<br /></label>
    <input name="login" type="text" size="15" maxlength="15" />
  </p>
<!--**** � ��������� ���� (name="login" type="text") ������������ ������ ���� ����� ***** -->  
  <p>
    <label />��� ������:<br />
    <input name="password" type="password" size="15" maxlength="15" />
  </p>
<!--**** � ���� ��� ������� (name="password" type="password") ������������ ������ ���� ������ ***** -->  
<p>
<input type="submit" name="submit" value="�����" />
<!--**** �������� (type="submit") ���������� ������ �� ��������� testreg.php ***** --> 
<br />
</p></form>
<br />
<br />
<?php endif;  ?>
</div> 

<div class="WorkArea">
<h2>��� ����</h2>
<p>������ ����. ��� ������ ��� �� ����� �����.��� ����� ��� �������</p>
 
</form>

<div class="footer">Copyright &copy; <a href="http://localhost/test3/index.php" />2012 product</div>

</body>
</html>
