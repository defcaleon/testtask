
$( document ).ready(function()  {
       //отслеживание нажатия кнопки отправки
       $("#btn1").click(
		function(){
			sendAjaxForm('result_form_1', 'form1', 'form1.php');
			return false; 
			
		}
	);
       $("#btn2").click(
		function(){
			sendAjaxForm('result_form_2', 'form2', 'form2.php');
			return false; 
			
		}
	);
});
 //функция которая отправляет форму используя ajax
function sendAjaxForm(result_form, ajax_form, url) {

    $.ajax({
        url:     url, 
        type:     "POST", 
        dataType: "html", 
        data: $("#"+ajax_form).serialize(), 
        success: function(response) { //Данные отправлены успешно
        	result = $.parseJSON(response);
            
             //В зависимости от пришедшего ответа, выводим результат
            switch (result.error)
            {
                case 0: 
                 $("#"+result_form).html('Successfully registred');
                  break;
                case 1: 
                 $("#"+result_form).html('User with this email or login already exists');
                  break;
                case 2: 
                 $("#"+result_form).html('passwords mismatch');
                  break;
                case 3: 
                 $('#'+result_form).html('A field or several fields are empty');
                  break;
                case 4: 
                 $("#"+result_form).html('Incorrect login or password');
                  break;
                case 10: 
                
                 var form = document.getElementById('form1');
                 form.style.display = 'none';
                 form = document.getElementById('form2');
                 form.style.display = 'none';
                 $("#"+result_form).html('Hello '+result.name);
                  break; 
            }
           
    	},
    	error: function(response) { // Данные не отправлены
            $('#result_form_1').html('Data eror.');
           
    	}
 	});
}

