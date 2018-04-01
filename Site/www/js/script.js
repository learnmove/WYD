$(document).ready(function(){
    $("#guiadojogo").click(function(){
        $(".menubox").fadeIn();
    });
	    $('.delnot').click(function(){
    return confirm("Tem certeza que quer excluir ["+$(this).attr("data-titulo")+"]?");
	});
	$(".menuclose").click(function(){
		$('.menubox').fadeOut();
	});
	$(".dropdown").click(function(){
		$(".dropdown ul").stop().fadeOut(150);
		$(this).find("ul").stop().fadeToggle(150);
	});
	$(".iconta").focus(function(){
	$(this).nextAll().fadeOut();
});
	function accsuccess(cerror) {
	cerror.next().next().fadeIn();
	cerror.parent().addClass("has-success");
}
//guildmark
function guildError(msg) {
$("#ierror").fadeIn();
$("#cierror").html(msg);
};
	$("#upfile1").click(function () {
    $("#imageLoader").trigger('click');
});
	function handleImage(e){
 $("#loading").fadeIn();
 var valx = $("#imageLoader").val();
if (!valx.match(/(?:bmp)$/)) {
guildError("Formato inv&aacute;lido!");
        $("#csend").fadeOut();
         $("#loading").fadeOut();


} else {
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
$("#csend").fadeIn();
$("#ierror").fadeOut();
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img,0,0);
        }
        img.src = event.target.result;

    }
    reader.readAsDataURL(e.target.files[0]);
$("#loading").fadeOut();
}
}
if (document.getElementById('imageLoader')) {
var imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
var canvas = document.getElementById('imageCanvas');
var ctx = canvas.getContext('2d');
}
	    $('#sguildmark').click(function(e){
    $.ajax( {
      url: 'ajax/receiveimage.php',
      type: 'POST',
      data: new FormData($("#gform")[0]),
      beforeSend: function(){
      $('#uploading').css({display:"inline"});
      $('#gform').css({display:"none"});
      },
      success: function (res) {
      if (res == 0) {
      $("#pguilds").fadeOut();
      $("#gsuccess").fadeIn();
      }
      else {
      $('#gform').css({display:"inline"});
      $('#uploading').css({display:"none"});
      switch(res){
      case "1":
      guildError("Erro ao enviar foto, tente novamente");
      break;
      case "2":
      guildError("Arquivo n&atilde;o &eacute; .bmp");
      break;
      case "3":
      guildError("Arquivo muito grande");
      break;
      case "4":
      guildError("Resolu&ccedil;&atilde;o deve ser exatamente 16x12");
      break;
      case "5":
      guildError("Erro ao enviar foto, tente novamente");
      break;
      case "6":
      guildError("Selecione um personagem");
      break;
      case "7":
      guildError("Escolha uma imagem");
      break;
      default:
      alert(res);
      guildError("Erro n&atilde;o identificado, tente novamente");
      }
      }
      },
      complete: function(){
                $('#uploading').css({display:"none"});
            },
      processData: false,
      contentType: false
    } );
    e.preventDefault();
  });
//--guildmark
function accerror(cerror, str) {
	cerror.fadeIn();
	cerror.find("span").html(str);
	cerror.parent().addClass("has-error");
}
	// Nick
    $("#cnick").blur(function(){
    var gethis = $(this).val();
	var cerror = $(this).next();
    if (!$(this).val()) {
		accerror(cerror, "Campo obrigat&oacute;rio");
        } else {
              $.ajax({
              url: baseurl+"ajax/validacc.php?do=1",
               cache: false,
               type: "POST",
               data: {valc:gethis},
               beforeSend: function(){
				cerror.next().css({display:"inline"});
            },
            complete: function(msg){
                cerror.next().css({display:"none"});
            },
               success:
               function(result){
               if (result == 3) {
				   accerror(cerror, "Nick/Apelido j&aacute; existe!");
               } else {
               if (result == 0) {
               accerror(cerror, "Nick/Apelido inv&aacute;lido!");

               } else {
				   if (result == 1) {
				accsuccess(cerror);
				   }
               }
               }
               }
               });
        }
    });
	
	// user
	    $("#cuser").blur(function(){
    var gethis = $(this).val();
	var cerror = $(this).next();
    if (!$(this).val()) {
		accerror(cerror, "Campo obrigat&oacute;rio");
        } else {
              $.ajax({
              url: baseurl+"ajax/validacc.php?do=2",
               cache: false,
               type: "POST",
               data: {valc:gethis},
               beforeSend: function(){
				cerror.next().css({display:"inline"});
            },
            complete: function(msg){
                cerror.next().css({display:"none"});
            },
               success:
               function(result){
               if (result == 3) {
				   accerror(cerror, "Usu&aacute;rio/Conta j&aacute; existe!");
               } else {
               if (result == 0) {
               accerror(cerror, "Usu&aacute;rio/Conta inv&aacute;lido!");

               } else {
				   if (result == 1) {
				accsuccess(cerror);
				   }
               }
               }
               }
               });
        }
    });
	//Senha
	$("#cpass").blur(function(){
    var gethis = $(this).val();
	var cerror = $(this).next();
    if (!$(this).val()) {
		accerror(cerror, "Campo obrigat&oacute;rio");
        } else {
              $.ajax({
              url: baseurl+"ajax/validacc.php?do=3",
               cache: false,
               type: "POST",
               data: {valc:gethis},
               beforeSend: function(){
				cerror.next().css({display:"inline"});
            },
            complete: function(msg){
                cerror.next().css({display:"none"});
            },
               success:
               function(result){
               if (result == 0) {
               accerror(cerror, "Senha inv&aacute;lida!");
               } else {
				   if (result == 1) {
				accsuccess(cerror);
				   }
               }
               }
               });
        }
    });
	    $("#cpass2").blur(function(){
    var gethis = $(this).val();
	var cerror = $(this).next();
    if (!$(this).val()) {
	accerror(cerror, "Campo obrigat&oacute;rio");
    } else {
    if ( $("#cpass").val() == $(this).val() ) {
    accsuccess(cerror);
    }
    else {
    accerror(cerror, "Senhas diferentes!");
    }
    }
    });
	//email
	$("#cemail").blur(function(){
    var gethis = $(this).val();
	var cerror = $(this).next();
    if (!$(this).val()) {
		accerror(cerror, "Campo obrigat&oacute;rio");
        } else {
              $.ajax({
              url: baseurl+"ajax/validacc.php?do=4",
               cache: false,
               type: "POST",
               data: {valc:gethis},
               beforeSend: function(){
				cerror.next().css({display:"inline"});
            },
            complete: function(msg){
                cerror.next().css({display:"none"});
            },
               success:
               function(result){
               if (result == 3) {
				   accerror(cerror, "Email j&aacute; est&aacute; sendo usado!");
               } else {
               if (result == 0) {
               accerror(cerror, "Email inv&aacute;lido!");
               } else {
				   if (result == 1) {
				accsuccess(cerror);
				   }
               }
               }
               }
               });
        }
    });
	 //admin
    $(".apagarpost").click(function(){
	  var datatitulo = $(this).attr("data-titulo");
	  if (confirm("Tem certeza que quer excluir o topico ["+datatitulo+"]?")) {
	  var dataid = $(this).attr("data-id");
	  $.ajax( {
      url: baseurl+'ajax/admin.php?do=1&id='+dataid,
      type: 'GET',
      success: function (res) {
		alert(res);
		location.reload(); 
      }
	  });
	  }
  });
  
      $(".exres").click(function(){
	  if (confirm("Tem certeza que quer excluir essa resposta?")) {
	  var dataid = $(this).attr("data-id");
	  $.ajax( {
      url: baseurl+'ajax/admin.php?do=2&id='+dataid,
      type: 'GET',
      success: function (res) {
		alert(res);
		location.reload(); 
      }
	  });
	  }
  });
  
  $(".editart").click(function() {
	  var datatitulo2 = $(this).attr("data-titulo");
	  var novotitulo = window.prompt("Novo titulo:", datatitulo2);
	  var dataid = $(this).attr("data-id");
	  if (novotitulo != null) {
		  	  $.ajax( {
      url: baseurl+'ajax/admin.php?do=5&id='+dataid+'&titulo='+novotitulo,
      type: 'GET',
      success: function (res) {
		alert(res);
		location.reload(); 
      }
	  });
	  }
  });
    $("#editpost").click(function() {
	  var editableText = $("<textarea />");
	  editableText.attr('id', 'txtd');
	  editableText.attr('rows', '5');
	  editableText.css('resize','none');
	  editableText.addClass("form-control");
	  var thediv = $("#tpost");
	  var hei = $(thediv).height()+100;
	  editableText.css("height", hei);
	  editableText.css("width", "90%");
	  var txt = $(thediv).html();
	  var ftest = txt.replace(/<br>/g,"");
	  $(this).hide();
	  $("#ap").fadeIn();
	  $("#ar").fadeIn();
	  editableText.val(ftest);
  $(thediv).replaceWith(editableText);
	});
$("#ar").click(function() {
location.reload();
});

$("#ap").click(function() {
	if (confirm("Tem certeza que quer alterar este topico?")) {
		var dataid = $(this).attr("data-id");
		
		var datac = $("#txtd").val();
		datac.replace("\n", "<br />");
		$.ajax( {
      url: baseurl+'ajax/admin.php?do=6&id='+dataid,
      type: 'POST',
	  data: {
		  'c':datac
	  },
      success: function (res) {
		alert(res);
		location.reload(); 
      }
	  });
	}
});
  $(".editp").click(function() {
	  var novop = window.prompt("Prioridade \npara fixar um topico coloque 1\n para deixar normal coloque 0:");
	  var dataid = $(this).attr("data-id");
	  if (novop != null) {
		  	  $.ajax( {
      url: baseurl+'ajax/admin.php?do=7&id='+dataid+'&p='+novop,
      type: 'GET',
      success: function (res) {
		alert(res);
		location.reload(); 
      }
	  });
	  }
  });
  
  $(".tclose").click(function(){
	  if (confirm("Tem certeza que quer fechar este topico?")) {
	  var dataid = $(this).attr("data-id");
	  $.ajax( {
      url: baseurl+'ajax/admin.php?do=8&id='+dataid,
      type: 'GET',
      success: function (res) {
		alert(res);
		location.reload(); 
      }
	  });
	  }
  });
        $(".evex").click(function(){
	  if (confirm("Tem certeza que quer excluir esse evento?")) {
		  return true;
	  }else {return false;}
  });
    $(".topen").click(function(){
	  if (confirm("Tem certeza que quer abrir este topico?")) {
	  var dataid = $(this).attr("data-id");
	  $.ajax( {
      url: baseurl+'ajax/admin.php?do=9&id='+dataid,
      type: 'GET',
      success: function (res) {
		alert(res);
		location.reload(); 
      }
	  });
	  }
  });
  $("#tadbox").change(function(){
        var valf = $(this).val();
		var dir = '/DataBase/ItemIco_by_ItemID/'+valf+'.png';
		$("#tadimg").attr('src', dir);
    });
	//tabs
	$(".hnots li a").click(function(){
		if (!$(this).hasClass("nactive")) {
			$(".hnots li a").removeClass("nactive");
			$(this).addClass("nactive");
			$(".ncanvas").css("display","none");
			$("#"+$(this).attr("data-id")).stop().fadeIn();
		}
	});
	// guiadojogo
	$(".guiadown").click(function(){
		$(this).siblings("div").children("ul").css("display","none");
		$(this).children("ul").stop().fadeToggle();
	});
	$(".menuguia").click(function() {
		window.history.pushState("","",baseurl+'guiadojogo/'+$(".inguia").attr("data-param1")+'/'+$(this).attr("data-myid"));
		var dataid = $(this).attr("data-id");
		var datasubc = $(this).attr("data-subc");
		$(this).parent().siblings("li").removeClass("active");
		$(this).parent().addClass("active");
		$(this).parents(".guiadown").children(".guiatext").text($(this).text());
		if (datasubc != null || datasubc != "") {
			
			if (datasubc == "no") {
				$("#guiapaginas").children().css("display","none");
			} else {
				var tdiv = $("#"+datasubc);
				if (tdiv != null) {
					tdiv.siblings("div").css("display","none");
					tdiv.siblings("span").fadeIn();
					tdiv.fadeIn().css("display","inline");
				}
			}
			
		}
		
	$.ajax( {
      url: baseurl+'ajax/getguia.php?guiaid='+dataid,
      type: 'GET',
	  beforeSend: function(){
		  
		  $("#guiacanvas .conteudo").html('<img id="guiaload" src="'+baseurl+'/images/loadingd.gif">');
      },
      success: function (res) {
		  if (res != "noguia") {
			  if(datasubc != "no") {
				  var tdiv = $("#"+datasubc);
				  var tchi = tdiv.children("ul").children("li");
				  tchi.removeClass("active");
				  tchi.first().addClass("active");
				  tdiv.children(".guiatext").html(res["h2titulo"]);
			  }
			  $("#guiacanvas").html("<h1>"+res["h1titulo"]+"</h1><h2>"+res["h2titulo"]+'</h2><hr><div class="conteudo">'+res["conteudo"]+'</div>');
				
	  }
	  }
	  });
	});
	$( document ).on( 'click', '.instalacao a', function() {
		var tindex = $(this).index();
		$(this).siblings("div").css("display","none");
		$(this).siblings("div").eq(tindex).fadeIn();
		$(this).siblings("a").removeClass("active");
		$(this).addClass("active");
	});

});
function showResult(str) {
  if (str.length<3) { 
    document.getElementById("livesearch").innerHTML="";
	$("#livesearch").fadeOut();
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
	  $("#livesearch").fadeIn();
    }
  }
  xmlhttp.open("GET",baseurl+"ajax/buscarnot.php?q="+str,true);
  xmlhttp.send();
}