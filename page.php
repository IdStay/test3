<?php
// ��� ��������� �������� �� �������. ������ � ��� �������� ������ ������������, ���� �� ��������� �� �����. ����� ����� ��������� �� � ����� ������ ���������!!!
session_start();

include ("bd.php");// ���� bd.php ������ ���� � ��� �� �����, ��� � ��� ���������, ���� ��� �� ���, �� ������ �������� ���� 
if (isset($_GET['id'])) {$id =$_GET['id']; } //id "�������" ���������
else
{ exit("�� ����� �� �������� ��� ���������!");} //���� �� ������� id, �� ������ ������
if (!preg_match("|^[\d]+$|", $id)) {
exit("<p>�������� ������ �������! ��������� URL</p>");//���� id �� �����, �� ������ ������
}

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//���� ���������� ����� � ������ � �������, �� ���������, ������������� �� ���
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //���� �� ������������� (����� �� ������� ����� ������������ �� ���� �� ������ ���������)
    exit("���� �� ��� �������� �������� ������ ������������������ �������������!");
   }
}
else {
//���������, ��������������� �� ��������
exit("���� �� ��� �������� �������� ������ ������������������ �������������!"); }
$result = mysql_query("SELECT * FROM users WHERE id='$id'",$db); 
$myrow = mysql_fetch_array($result);//��������� ��� ������ ������������ � ������ id

if (empty($myrow['login'])) { exit("������������ �� ����������! �������� �� ��� ������.");} //���� ������ �� ����������

?>
<html>
<head>

<body>


<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="keywords" content="��� ����">
<meta name="description" content="���� ����">

<link href="verstka-div.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="MainFrame">

<div class="header">
<a href="http://localhost/test3/index.php"><img src="img/header.gif" alt="��� ����"></a>
</div>

<div class="LeftMenu">
<br>
<a class="menu" href="http://localhost/test3/index.php">�������</a><br><br>
<a class="menu" href="http://localhost/test3/all_users.php">������ �������������</a><br><br>
<a class="menu" href="http://localhost/test3/exit.php">�����</a><br><br>

</div>


<div class="WorkArea">

<title><?php echo $myrow['login']; ?></title>
</head>
<body>
<h2>������������ "<?php echo $myrow['login']; ?>"</h2>


<?php
//print <<<HERE
//<a href='page.php?id=$myrow2[id]'>��� ��������</a></a><br><br>
HERE;
//���� ������ ����

if ($myrow['login'] == $login) {
//���� ��������� ����������� ���������, �� ���������� �������� ������ � ������� ������ ���������

print <<<HERE

<form action='update_user.php' method='post'>
��� ����� <strong>$myrow[login]</strong>. �������� �����:<br>
<input name='login' type='text'>
<input type='submit' name='submit' value='��������'>
</form>
<br>

<form action='update_user.php' method='post'>
�������� ������:<br>
<input name='password' type='password'>
<input type='submit' name='submit' value='��������'>
</form>
<br>

<form action='update_user.php' method='post' enctype='multipart/form-data'>
��� ������:<br>
<img alt='������' src='$myrow[avatar]'><br>
����������� ������ ���� ������� jpg, gif ��� png. �������� ������:<br>
<input type="FILE" name="fupload">
<input type='submit' name='submit' value='��������'>
</form>
<br>

<h2>������ ���������:</h2>

HERE;

$tmp = mysql_query("SELECT * FROM messages WHERE poluchatel='$login' ORDER BY id DESC",$db); 
$messages = mysql_fetch_array($tmp);//��������� ��������� ������������, ��������� �� �������������� � �������� �������, �.�. ����� ����� ��������� ����� ������

if (!empty($messages['id'])) {
do //������� ��� ��������� � �����
  {
$author = $messages['author'];
$result4 = mysql_query("SELECT avatar,id FROM users WHERE login='$author'",$db); //��������� ������ ������
$myrow4 = mysql_fetch_array($result4);

if (!empty($myrow4['avatar'])) {//���� �������� ���, �� ������� �����������(����� ����� ������������ ��� ����� �������)
$avatar = $myrow4['avatar'];
}
else {$avatar = "avatars/net-avatara.jpg";}

  printf("
  <table>
  <tr>
  <td><a href='page.php?id=%s'><img alt='������' src='%s'></a></td>
  
  <td>�����: <a href='page.php?id=%s'>%s</a><br>
      ����: %s<br>
	  ���������:<br>
	 %s<br>
	 <a href='drop_post.php?id=%s'>�������</a>
  
  </td>  
  </tr>
  </table><br>
  ",$myrow4['id'],$avatar,$myrow4['id'],$author,$messages['date'],$messages['text'],$messages['id']);
  //������� ���� ���������
  }
  while($messages = mysql_fetch_array($tmp));

                    }
					else {
					//���� ��������� �� �������
					echo "��������� ���";
					}
					
}

else
{
//���� ��������� �����, �� ������� ������ �������� ������ � ����� ��� �������� ������ ���������

print <<<HERE
<img alt='������' src='$myrow[avatar]'><br>
<form action='post.php' method='post'>
<br>
<h2>��������� ���� ���������:</h2>
<textarea cols='43' rows='4' name='text'></textarea><br>
<input type='hidden' name='poluchatel' value='$myrow[login]'>
<input type='hidden' name='id' value='$myrow[id]'>
<input type='submit' name='submit' value='���������'>
</form>
HERE;
}

?>
</div>

<div class="footer">Copyright &copy; <a href="http://localhost/test3/index.php">2012 product</a></div>

</div>


</body>
</html>
