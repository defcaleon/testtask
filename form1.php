<?php


 //Проверка на пустые поля или если поле заполнено пробелами
if ( (trim($_POST["login"])!=NULL) and (trim($_POST["password"])!=NULL) and (trim($_POST["conf_password"])!=NULL) and (trim($_POST["email"])!=NULL) and (trim($_POST["first_name"])!=NULL) ) 
{
   //Проверка на совпадение введенных паролей при регистрации
 if($_POST["password"]==$_POST["conf_password"])
 {
    
    $xml = simplexml_load_file('users.xml');
    if (checking_user_in_data_base($_POST["login"], $xml,$_POST["email"]))
   { 
    //Создание новой записи в бд
    $user =$xml->addchild('user');
    $user->addchild('login',$_POST["login"]);

    $pas=md5($_POST["password"]."nadezno");
    $user->addchild('password',$pas);
    $user->addchild('email',$_POST["email"]);
    $user->addchild('name',$_POST["first_name"]);
    $xml->asXML("users.xml");

	$result = array(  
   		'error'=>0 //Сообщение об успехе
   	);
   }

   
   else
   {
   	$result = array( 
   		'error'=>1 //Сообщение о том что логин или емаил не уникален
   	);
   }


}
else
{
 	$result = array(
   		'error'=>2 //пароль и подтверждение пароля не совпали
   	);
}

}
else
{
	$result = array(
   		'error'=>3 //Сообщение о том что поле(-я) пустое(-ые)
   	);
}



 echo json_encode($result); 



function checking_user_in_data_base( $login, $xml, $email )  //Проверка логина и емаила на уникальность 
{
	foreach ($xml as $obj) {

		if ($login==$obj->login)
    {
        return false;
    }
    else
    {
        if ($email==$obj->email)
      {
        return false;
       }
	}


	}
return true;
}

?>

