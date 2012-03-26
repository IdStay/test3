<?php
//  error_reporting(E_ALL);
/* $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("code_dir", $DOCUMENT_ROOT."/code/my_codegen/");
*/
//выше вариант, который надо использывать при расположении сайта в интернете, а не на ПК.

//на локале
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("code_dir", "my_codegen/");



function generate_code() //генерируем код
{
                
    $hours = date("H"); // час       
    $minuts = substr(date("H"), 0 , 1);// минута 
    $mouns = date("m");    // месяц             
    $year_day = date("z"); // день в году

    $str = $hours . $minuts . $mouns . $year_day; //создаем строку
    $str = md5(md5($str)); //дважды шифруем в md5
	$str = strrev($str);// реверс строки
	$str = substr($str, 3, 6); // извлекаем 6 символов, начиная с 3
	// Вам конечно же можно постваить другие значения, так как, если взломщики узнают, каким именно способом это все генерируется, то в защите не будет смысла.
	

    $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    srand ((float)microtime()*1000000);
    shuffle ($array_mix);
	//Тщательно перемешиваем, соль, сахар по вкусу!!!
    return implode("", $array_mix);
}

function img_code() //Берем карандаши и рисуем картинку :)
{

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");                   
header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);           
header("Pragma: no-cache");                                           
header("Content-Type:image/png");
//защита от кэширования...кстати сказать не очень надежная...

$linenum = 2; //линии
$img_arr = array(
                 "codegen.png",//фон изображения. Можете сами нарисовать
                 "codegen0.png"//фон изображения. Можете сами нарисовать
                );

$font_arr = array();
$font_arr[0]["fname"] = "verdana.ttf"; //ttf шрифты, можно заменить на свои
$font_arr[0]["size"] = 16;//размер
$font_arr[1]["fname"] = "times.ttf"; //ttf шрифты, можно заменить на свои
$font_arr[1]["size"] = 16;//размер

$n = rand(0,sizeof($font_arr)-1);
$img_fn = $img_arr[rand(0, sizeof($img_arr)-1)];
$im = imagecreatefrompng (code_dir . $img_fn); //создаем изображение со случайным фоном

for ($i=0; $i<$linenum; $i++)
{
//рисуем линии
    $color = imagecolorallocate($im, rand(0, 150), rand(0, 100), rand(0, 150));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

$color = imagecolorallocate($im, rand(0, 200), 0, rand(0, 200));
imagettftext ($im, $font_arr[$n]["size"], rand(-4, 4), rand(10, 45), rand(20, 35), $color, code_dir.$font_arr[$n]["fname"], generate_code());//накладываем код

for ($i=0; $i<$linenum; $i++)//еще раз линии! Уже сверху.
{
    $color = imagecolorallocate($im, rand(0, 255), rand(0, 200), rand(0, 255));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

ImagePNG ($im);
ImageDestroy ($im);//ну вот и создано изображение!
}

img_code();
?>
