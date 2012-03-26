<?
include "database.php";
    if(isset($_POST['go_add']))
    {
        if (isset($_POST['title']))        {$title = $_POST['title']; if ($title == '') {unset($title);}}

        if (isset($_POST['date']))        {$date = $_POST['date']; if ($date == '') {unset($date);}}
        if (isset($_POST['description'])) {$description = $_POST['description']; if ($description == '') {unset($description);}}
        if (isset($_POST['text']))        {$text = $_POST['text']; if ($text == '') {unset($text);}}
        if (isset($_POST['author']))      {$author = $_POST['author']; if ($author == '') {unset($author);}}
        if (isset($_POST['id']))      {$id = $_POST['id'];}
        

        if ($_POST['title']!=null && $_POST['date']!="" && $_POST['description']!=null && $_POST['author']!="" )

        {

            if (mysql_query ("INSERT INTO news SET
            title='".$title."',
            date='".$date."',
            text='".$text."',
            author='".$author."'"))
            {
                echo "<div class='clean-ok'>Новость успешно добавлена!<br><a href='/index.php?f=news&mod=add'>Добавить ещё.</a></p></div>";
            }
            else
            {
                echo "<div class='clean-gray'>Неудалось обработать базой<div>";
                        $dar=mysql_error();
                echo $der;
            }


        }
        else
        {
            echo "<div class='clean-error'><p>Незаполнена вся инфа.</p></div>";
        }



    } ?>

  