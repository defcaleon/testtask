<?php
//Проверка на пустые поля
if ((trim($_POST["login"])!=NULL) and (trim($_POST["password"])!=NULL)) 
{
    $xml = simplexml_load_file('users.xml');
    if (checking_user_in_data_base($_POST["login"],$_POST["password"], $xml))
   {
          $result = array(
      'error'=>10, //Сообщение об успешной авторизации
      'name'=>(string)$_SESSION['name']
    );
   }
   else
   {
   	$result = array(
      'error'=>4 //Сообщение о неправильно введенном логине или пароле
    );
   }

}
else
{
	$result = array(
      'error'=>3 // сообщение о том что Пустые поля
    );
}



 echo json_encode($result); 

function checking_user_in_data_base( $login, $password ,$xml) //Проверка существования пользователя в бд и последующая авторизация его  (в случае успешной авторизации возвращаем true)
{ 
 foreach($xml as $obj)
{
	if ($login==$obj->login)
	{
      $pas=md5($password."nadezno");
   
    if (($pas)==($obj->password))
      { 
        if (!(cookie_check_set($obj,$xml)))
          {return false;}

        
        
        if ((!(isset($_SESSION['key']))) or (!(isset($_SESSION['name']))))
        {
          if (!(isset($obj->Session_key)))
          {
            $obj->addchild('Session_key',md5($login."text".$pas));
            $xml->asXML("users.xml");
           } 

          $_SESSION['key']=$obj->Session_key;
          $_SESSION['name']=$obj->name;




        }
        
       if ( $_SESSION['key']!=$obj->session_key)
        {return false;} else{return true;}
      } 
      else {return false;}
	}

}
return false;
}



function cookie_check_set($obj,$xml)
{
 if (!(isset($obj->Cookie_key)))
  {
            $obj->addchild('Cookie_key',md5($login."cooker".$pas));
            $xml->asXML("users.xml");
           } 

 if (!(isset($_COOKIE['key'])))
 {
    SetCookie("key",$obj->Cookie_key,time()+3600*24*30);
    return true;
 }
 if($_COOKIE['key']==$obj->Cookie_key)
 {
  return true;
 }
 else{return false;}

}
?>

