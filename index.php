<!DOCTYPE html>
<html>
	<head>
    <link rel="stylesheet" href="style.css">
  	<meta charset="utf-8">
  	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="ajax.js"></script>

    <!--Если js отключен то выводим сообщение об этом при этом скрывая формы -->
    <noscript><h2>JavaScript is disabled! Why you want to do so?
          Please enable JavaScript in your web browser!</h2>
          <style type="text/css">
          form { display:none; }
           </style></noscript>
  		
  	</head>

  	<body>
    <!--Форма регистрации -->
  	<form  id="form1"    > <!-- method="post" action="form1.php"  -->
  		<p><b> Registration</b></p>
  		<p>login:<br>
  		<p><input type="text"  name="login" required ></p>
  		<p>password:<br>
  		<p><input type="password" name="password" required  ></p>
  		<p>confirm password:<br>
  		<p><input type="password" name="conf_password" required ></p>
  		<p>e-mail:<br>
  		<p><input type="e-mail" name="email" required ></p>
  		<p>name:<br>
  		<p><input type="text"  name="first_name" required ></p>
  		<p><input id='btn1' type="submit" value ="Sign up" ></p>
 	</form>
 
    <!--Форма авторизации -->
 	<form id="form2"  >
  		<p><b> Sign in</b></p>
  		<p>login:<br>
  		<p><input type="text" name="login" required></p> 
  		<p>password:<br>
  		<p><input type="password" name="password" required ></p>
  		<p><input type="submit" id='btn2' value ="Sign in" </p>
 	</form>
 

  <div id="result_form_1"></div> 
  <div id="result_form_2"></div> 

  	</body>
</html>