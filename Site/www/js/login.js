$(document).ready(function(){	

	$.post(URL_SITE + 'login/',
	    {
	     login: 'login'
	    },
	        function(data){
	          $("#login").html(data);
	        }
	);	
	$("#submit_logar").click(function(){

	}); 
	
  	$("#s").keypress(function(e){        
        if(e.which == 13){
           Submit_login();
        }        
    });

});

function Submit_login() {
	$.post(URL_SITE + 'login/logar/',
	    {
	     id_usuario: $("#u").val(), senha: $("#s").val(), redict: 'true'
	    },
	        function(data){
	          $("#valid_login").html(data);
	        }
	);
}

function Submit_login_facebook_new() {
	$.post(URL_SITE + 'login/facebook-new-user/',
	    {
	     id_usuario: $("#u").val(), senha: $("#s").val(), redict: 'true'
	    },
	        function(data){
	          $("#valid_login").html(data);
	        }
	);
}

function login_item_mall(){
	window.open(URL_SITE+'loja/item-mall','Item Mall - Metin2', 'height=768,width=645,scrollbars=yes');
}