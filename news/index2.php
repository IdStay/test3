<?
include "database.php";

@$page = $_GET['page'];
$result00 = mysql_query("SELECT COUNT(*) FROM data WHERE secret=0");
$temp = mysql_fetch_array($result00);
$posts = $temp[0];

$total = (($posts - 1) / $num) + 1;
$total =  intval($total);
$page = intval($page);
if(empty($page) or $page < 0) $page = 1;
if($page > $total) $page = $total;
// ��������� ������� � ������ ������
// ������� �������� ���������

$start = $page * $num - $num;

// �������� $num ��������� ������� � ������ $start


$result = mysql_query("SELECT * FROM `data` WHERE `secret`=0  ORDER BY `id` DESC LIMIT $start, $num");

if (!$result)
{
echo "<p>������ �� ������� ������ �� ���� �� ������. �������� �� ���� ��������������. <br> <strong>��� ������:</strong></p>";
exit(mysql_error());
}

if (mysql_num_rows($result) > 0)

{
$myrow = mysql_fetch_array($result);

do
{



echo ="
         <tr>
         <td ><strong class='titl'><a class='news' href='fullstory?id=".$myrow["id"]."'>".$myrow["title"]."</a> / ".$myrow["date"]."</strong></td>
         </tr>

         <tr>
         <td>".$myrow["description"]."</td>
       <hr style='border:#999999 dashed 1px;' />



             <br>";



}
while ($myrow = mysql_fetch_array($result));


// ��������� ����� �� ������� �����
if ($page != 1) $pervpage = '<a href=?page=1>������</a> | <a href=?page='. ($page - 1) .'>����������</a> | ';
// ��������� ����� �� ������� ������
if ($page != $total) $nextpage = ' | <a href=?page='. ($page + 1) .'>���������</a> | <a href=?page=' .$total. '>���������</a>';

// ������� ��� ��������� ������� � ����� �����, ���� ��� ����
if($page - 5 > 0) $page5left = ' <a href=?page='. ($page - 5) .'>'. ($page - 5) .'</a> | ';
if($page - 4 > 0) $page4left = ' <a href=?page='. ($page - 4) .'>'. ($page - 4) .'</a> | ';
if($page - 3 > 0) $page3left = ' <a href=?page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
if($page - 2 > 0) $page2left = ' <a href=?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href=?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';

if($page + 5 <= $total) $page5right = ' | <a href=?page='. ($page + 5) .'>'. ($page + 5) .'</a>';
if($page + 4 <= $total) $page4right = ' | <a href=?page='. ($page + 4) .'>'. ($page + 4) .'</a>';
if($page + 3 <= $total) $page3right = ' | <a href=?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
if($page + 2 <= $total) $page2right = ' | <a href=?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' | <a href=?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

// ����� ���� ���� ������� ������ �����

if ($total > 1)
{
Error_Reporting(E_ALL & ~E_NOTICE);
$content.= "<div class=\"pstrnav\">";
$content.=  $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
$content.=  "</div>";;
}



}

else
{
echo "<p>���������� �� ������� �� ����� ���� ��������� � ������� ��� �������.</p>";

}


?>