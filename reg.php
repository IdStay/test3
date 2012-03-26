<html>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="keywords" content="Мой блог">
<meta name="description" content="Сайт блог">

<link href="verstka-div.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="MainFrame">

<div class="header">
<a href="http://localhost/test3/index.php"><img src="img/header.gif" alt="Мой блог"></a>
</div>

<div class="LeftMenu">
<a class="menu" href="http://localhost/test3/index.php">Главная</a><br><br>

</div>


<div class="WorkArea">

<h1>Регистрация</h1>
<form action="save_user.php" method="post" enctype="multipart/form-data">
<!-- save_user.php - это адрес обработчика. То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей отправятся на страничку save_user.php методом "post" -->
  <p>
    <label>Ваш логин *:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
  </p>
<!-- В текстовое поле (name="login" type="text") пользователь вводит свой логин -->  
  <p>
    <label>Ваш пароль *:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
  </p>
<!-- В поле для паролей (name="password" type="password") пользователь вводит свой пароль -->  
  <p>
    <label>Ваш E-mail *:<br></label>
    <input name="email" type="text" size="15" maxlength="100">
  </p>
<!-- Вводим е-майл -->  
  
  <p>
    <label>Выберите аватар. Изображение должно быть формата jpg, gif или png:<br></label>
    <input type="FILE" name="fupload">
  </p>
<!-- В переменную fupload отправится изображение, которое выбрал пользователь. --> 
<p>Введите код с картинки *:<br>

<p><img src="code/my_codegen.php"></p>
<p><input type="text" name="code"></p>
<!-- В code/my_codegen.php генерируется код и рисуется изображение --> 

<p>
<input type="submit" name="submit" value="Зарегистрироваться">
<!-- Кнопочка (type="submit") отправляет данные на страничку save_user.php  -->  
</p></form>
Звездочками (*) обозначены поля, обязательные для заполнения.

<div class="footer">Copyright &copy; <a href="http://localhost/test3/index.php">2012 product</a></div>

</div>


</body>
</html>
