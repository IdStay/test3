<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>��������</title>
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
<br>
<br>
<br>
<?php
include ("bd.php");
if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
$z = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1' AND type ='User' or type='Guest' ",$db);
$type1 = "User";
$type2 = "Guest";
}
?>
<br>
<a class="menu" href="http://localhost/test3/index.php">������� ��������</a><br /><br />
<?php if (!isset ($_SESSION['type']) or  ($_SESSION['type'] == $type1) or ($_SESSION['type'] == $type2 )) : ?>
<a class="menu" href="http://localhost/test3/addinf.php">�������� ��������</a><br /><br />
<?php endif;  ?>
<br /><br /><br /><br />
</div> 

<div class="WorkArea">
<h1>��� ����</h1>
<p>������ ����. ��� ������ ��� �� ����� �����.��� ����� ��� �������</p>
 
</form>

<div class="footer">Copyright &copy; <a href="http://localhost/test3/index.php" />2012 product</div>

</body>
</html>
