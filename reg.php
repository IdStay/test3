<html>

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
<a class="menu" href="http://localhost/test3/index.php">�������</a><br><br>

</div>


<div class="WorkArea">

<h1>�����������</h1>
<form action="save_user.php" method="post" enctype="multipart/form-data">
<!-- save_user.php - ��� ����� �����������. �� ����, ����� ������� �� ������ "������������������", ������ �� ����� ���������� �� ��������� save_user.php ������� "post" -->
  <p>
    <label>��� ����� *:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
  </p>
<!-- � ��������� ���� (name="login" type="text") ������������ ������ ���� ����� -->  
  <p>
    <label>��� ������ *:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
  </p>
<!-- � ���� ��� ������� (name="password" type="password") ������������ ������ ���� ������ -->  
  <p>
    <label>��� E-mail *:<br></label>
    <input name="email" type="text" size="15" maxlength="100">
  </p>
<!-- ������ �-���� -->  
  
  <p>
    <label>�������� ������. ����������� ������ ���� ������� jpg, gif ��� png:<br></label>
    <input type="FILE" name="fupload">
  </p>
<!-- � ���������� fupload ���������� �����������, ������� ������ ������������. --> 
<p>������� ��� � �������� *:<br>

<p><img src="code/my_codegen.php"></p>
<p><input type="text" name="code"></p>
<!-- � code/my_codegen.php ������������ ��� � �������� ����������� --> 

<p>
<input type="submit" name="submit" value="������������������">
<!-- �������� (type="submit") ���������� ������ �� ��������� save_user.php  -->  
</p></form>
����������� (*) ���������� ����, ������������ ��� ����������.

<div class="footer">Copyright &copy; <a href="http://localhost/test3/index.php">2012 product</a></div>

</div>


</body>
</html>
