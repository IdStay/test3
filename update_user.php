<?php
session_start();
include ("bd.php");// ���� bd.php ������ ���� � ��� �� �����, ��� � ��� ���������, ���� ��� �� ���, �� ������ �������� ���� 

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//���� ���������� ����� � ������ � �������, �� ���������, ������������� �� ���
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //���� �� �������������, �� ��������� ������
    exit("���� �� ��� �������� �������� ������ ������������������ �������������!");
   }
}
else {
//���������, ��������������� �� ��������
exit("���� �� ��� �������� �������� ������ ������������������ �������������!"); }

$old_login = $_SESSION['login']; //������ ����� ��� �����������
$id = $_SESSION['id'];//������������� ������������ ���� �����
$ava = "avatars/net-avatara.jpg";//����������� ����������� ����� ������

////////////////////////
////////��������� ������
////////////////////////

if (isset($_POST['login']))//���� ���������� �����
      {
$login = $_POST['login'];
$login = stripslashes($login); $login = htmlspecialchars($login); $login = trim($login);//������� ��� ������
if ($login == '') { exit("�� �� ����� �����");} //���� ����� ������, �� ������������� ��������

if (strlen($login) < 3 or strlen($login) > 15) {//��������� ����
exit ("����� ������ �������� �� ����� ��� �� 3 �������� � �� ����� ��� �� 15."); //������������� ���������� ���������
}

// �������� �� ������������� ������������ � ����� �� �������
$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {
exit ("��������, �������� ���� ����� ��� ���������������. ������� ������ �����."); //������������� ���������� ���������
}

$result4 = mysql_query("UPDATE users SET login='$login' WHERE login='$old_login'",$db);//��������� � ���� ����� ������������
if ($result4=='TRUE') {//���� ��������� �����, �� ��������� ��� ���������, ������� ���������� ���
mysql_query("UPDATE messages SET author='$login' WHERE author='$old_login'",$db);
$_SESSION['login'] = $login;//��������� ����� � ������
if (isset($_COOKIE['login'])) {
setcookie("login", $login, time()+9999999);//��������� ����� � �����
}

echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$_SESSION['id']."'></head><body>��� ����� �������! �� ������ ���������� ����� 5 ���. ���� �� ������ �����, �� <a href='page.php?id=".$_SESSION['id']."'>������� ����.</a></body></html>";}//���������� ������������ �����

      } 

////////////////////////
////////��������� ������
////////////////////////

else if (isset($_POST['password']))//���� ���������� ������
      {
$password = $_POST['password'];
$password = stripslashes($password);$password = htmlspecialchars($password);$password = trim($password);//������� ��� ������
if ($password == '') { exit("�� �� ����� ������");} //���� ������ �� ������, �� ������ ������

if (strlen($password) < 3 or strlen($password) > 15) {//�������� �� ���������� ��������
exit ("������ ������ �������� �� ����� ��� �� 3 �������� � �� ����� ��� �� 15."); //������������� ���������� ���������
}

$password = md5($password);//������� ������
$password = strrev($password);// ��� ���������� ������� ������
$password = $password."b3p6f";
//����� �������� ��������� ����� �������� �� �����, ��������, ������ "b3p6f". ���� ���� ������ ����� ���������� ������� ������� � ���� �� ������� ���� �� md5,�� ���� ������ �������� �� ������. �� ������� ������� ������ �������, ����� � ������ ������ ��� � ��������.
//��� ���� ���������� ��������� ����� ���� password � ����. ������������� ������ ����� ��������� ������� �������� �������.


$result4 = mysql_query("UPDATE users SET password='$password' WHERE login='$old_login'",$db);//��������� ������
if ($result4=='TRUE') {//���� �����, �� ��������� ��� � ������
$_SESSION['password'] = $password;

if (isset($_COOKIE['password'])) {
setcookie("password",$_POST['password'], time()+9999999);//��������� ������ � �����, ���� ��� ����
}


echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$_SESSION['id']."'></head><body>��� ������ �������! �� ������ ���������� ����� 5 ���. ���� �� ������ �����, �� <a href='page.php?id=".$_SESSION['id']."'>������� ����.</a></body></html>";}//���������� ������� �� ��� ��������

      } 



////////////////////////
////////��������� �������
////////////////////////

else if (isset($_FILES['fupload']['name'])) //������������ �� ����������
      {

if (empty($_FILES['fupload']['name']))
{
//���� ���������� ������ (������������ �� �������� �����������),�� ����������� ��� ������� �������������� �������� � �������� "��� �������"
$avatar = "avatars/net-avatara.jpg"; //������ ���������� net-avatara.jpg ��� ����� � ����������
$result7 = mysql_query("SELECT avatar FROM users WHERE login='$old_login'",$db);//��������� ������� ������
$myrow7 = mysql_fetch_array($result7);
if ($myrow7['avatar'] == $ava) {//���� ������ ��� �����������, �� �� ������� ���, ���� � �� ���� �������� �� ����.
$ava = 1;
}
else {unlink ($myrow7['avatar']);}//���� ������ ��� ����, �� ������� ���, ����� �������� ��������
}

else 
{
//����� - ��������� ����������� ������������ ��� ����������
$path_to_90_directory = 'avatars/';//�����, ���� ����� ����������� ��������� �������� � �� ������ �����

	
if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))//�������� ������� ��������� �����������
	 {	
	 	 	
		$filename = $_FILES['fupload']['name'];
		$source = $_FILES['fupload']['tmp_name'];	
		$target = $path_to_90_directory . $filename;
		move_uploaded_file($source, $target);//�������� ��������� � ����� $path_to_90_directory

	if(preg_match('/[.](GIF)|(gif)$/', $filename)) {
	$im = imagecreatefromgif($path_to_90_directory.$filename) ; //���� �������� ��� � ������� gif, �� ������� ����������� � ���� �� �������. ���������� ��� ������������ ������
	}
	if(preg_match('/[.](PNG)|(png)$/', $filename)) {
	$im = imagecreatefrompng($path_to_90_directory.$filename) ;//���� �������� ��� � ������� png, �� ������� ����������� � ���� �� �������. ���������� ��� ������������ ������
	}
	
	if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
		$im = imagecreatefromjpeg($path_to_90_directory.$filename); //���� �������� ��� � ������� jpg, �� ������� ����������� � ���� �� �������. ���������� ��� ������������ ������
	}
	


// �������� �������� 90x90
// dest - �������������� ����������� 
// w - ������ ����������� 
// ratio - ����������� ������������������ 

$w = 90;  // ���������� 90x90. ����� ��������� � ������ ������.

// ������ �������� ����������� �� ������ 
// ��������� ����� � ���������� ��� ������� 
$w_src = imagesx($im); //��������� ������
$h_src = imagesy($im); //��������� ������ �����������

         // ������ ������ ���������� �������� 
         // ����� ������ truecolor!, ����� ����� ����� 8-������ ��������� 
         $dest = imagecreatetruecolor($w,$w); 

         // �������� ���������� ��������� �� x, ���� ���� �������������� 
         if ($w_src>$h_src) 
         imagecopyresampled($dest, $im, 0, 0,
                          round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                          0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 

         // �������� ���������� �������� �� y, 
         // ���� ���� ������������ (���� ����� ���� ���������) 
         if ($w_src<$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                          min($w_src,$h_src), min($w_src,$h_src)); 

         // ���������� �������� �������������� ��� ������� 
         if ($w_src==$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src); 
		 

$date=time(); //��������� ����� � ��������� ������.
imagejpeg($dest, $path_to_90_directory.$date.".jpg");//��������� ����������� ������� jpg � ������ �����, ������ ����� ������� �����. �������, ����� � �������� �� ���� ���������� ����.

//������ ������ jpg? �� �������� ����� ���� ����� + ������������ ������������ gif �����������, ������� ��������� ������������. �� ����� ������� ������ ��� �����������, ����� ����� ����� ��������� �����-�� ��������.

$avatar = $path_to_90_directory.$date.".jpg";//������� � ���������� ���� �� �������.

$delfull = $path_to_90_directory.$filename; 
unlink ($delfull);//������� �������� ������������ �����������, �� ��� ������ �� �����. ������� ���� - �������� ���������.

$result7 = mysql_query("SELECT avatar FROM users WHERE login='$old_login'",$db);//��������� ������� ������ ������������
$myrow7 = mysql_fetch_array($result7);

if ($myrow7['avatar'] == $ava) {//���� �� �����������, �� �� ������� ���, ���� � ��� ���� �������� �� ����.
$ava = 1;
}
else {unlink ($myrow7['avatar']);}//���� ������ ��� ����, �� ������� ���


}
else 
        {
		//� ������ �������������� �������, ������ ��������������� ���������
        exit ("������ ������ ���� � ������� <strong>JPG,GIF ��� PNG</strong>");
		}

}

$result4 = mysql_query("UPDATE users SET avatar='$avatar' WHERE login='$old_login'",$db);//��������� ������ � ����
if ($result4=='TRUE') {//���� �����, �� ���������� �� ������ ���������
echo "<html><head><meta http-equiv='Refresh' content='5; URL=page.php?id=".$_SESSION['id']."'></head><body>���� �������� ��������! �� ������ ���������� ����� 5 ���. ���� �� ������ �����, �� <a href='page.php?id=".$_SESSION['id']."'>������� ����.</a></body></html>";}

      } 
?>