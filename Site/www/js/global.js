var Headhunter = {

	Capturar: function(){
		$(".headhunter").remove();

	    $.ajax({
			url: URL_SITE + "eventos/headhunter-capturar",
			type: "POST",
			dataType: "JSON",
			success: function(result){

				$.colorbox({
					iframe:true, 
					innerWidth:475, 
					innerHeight:250,
					fastIframe:false, 
					href: URL_SITE + "eventos/headhunter-colorbox",
					onComplete: function(){
						var conteudo_colorbox = "#colorbox #cboxWrapper #cboxContent .cboxIframe";

						$(conteudo_colorbox).contents().find("#titulo-colorbox").html(result.titulo);
						$(conteudo_colorbox).contents().find("#mensagem-colorbox").html(result.mensagem);			
					},						
				    onClosed:function(){
				    	window.open(URL_SITE+"eventos/headhunter/ranking", '_blank');
				    }
				});	
	    	}
	    });			
	}
}

$(document).ready(function(){

	$(window).scroll(function () {
		if ($(this).scrollTop() > 989) {
			$('.botao_voltar_ao_topo').fadeIn();
		} else {
			$('.botao_voltar_ao_topo').fadeOut();
		}
	});

	$('.botao_voltar_ao_topo').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 'slow');

		return false;
	});
});