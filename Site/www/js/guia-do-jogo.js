/*Função JS show/hide da sessão como-jogar*/
function box_passo_(id){
	$('html, body').animate({scrollTop: 0},'medium');
	$("#box_passo_"+id).show();
	for(var i=0;i<14;i++){
		if(i!=id){
			$("#box_passo_"+i).hide();
		}
	}
}


/* Função Js show/hide da sessão configuracao */

function box_conteudo_configuracao_c_p_(id){
    $(".box_conteudo_configuracao_"+id).show();
    $("#thumb_p"+id+" a").addClass('thumb_p'+id+'_hover');
    for(var i=0;i<20;i++){
    	if(i != id) {
    		$("#thumb_p"+i+" a").removeClass('thumb_p'+i+'_hover')
    		$(".box_conteudo_configuracao_"+i).hide();
    	}
    }
}

/* Função Js show/hide da sessão configuracao */

function box_conteudo_configuracao_(id){
	$('a.thumb_p'+id).addClass('thumb_p'+id+'_hover');
    $(".box_conteudo_configuracao_"+id).show();
    for(var i=0;i<18;i++){
    	if(i != id) {
    		$('a.thumb_p'+i).removeClass('thumb_p'+i+'_hover');
    		$(".box_conteudo_configuracao_"+i).hide();
    	}
    }
}

/* Função Js show/hide da sessão titulos */

function box_conteudo_titulos_(id){

	$('html, body').animate({scrollTop: 0},'medium');

    $(".box_conteudo_titulos_"+id).show();

	for(var i=0;i<15;i++){

		if(i != id) {

			$(".box_conteudo_titulos_"+i).hide();

		}

	}

}   

/*Função Js show/hide da sessão Opções*/

function box_conteudo_opcoes_(id){

	$('html, body').animate({scrollTop: 0}, 'medium');

	$(".box_conteudo_opcoes_"+id).show();

	for(var i=0;i<5;i++){

		if(i!=id){

			$(".box_conteudo_opcoes_"+i).hide();

		}

	}

}

/*Função JS show/hide da sessão Criar Sala*/

function box_conteudo_criar_sala_(id){

	$('html, body').animate({scrollTop: 0},'medium');

	$(".box_conteudo_criar_sala_"+id).show();

	for(var i=0;i<5;i++){

		if(i!=id){

			$(".box_conteudo_criar_sala_"+i).hide();

		}

	}

}

/*Função show/hide da sessão cla intermediario*/

function cla_box_(id){

	if ( id == '1' ){

        $(".cla_box_1").show();

        $(".cla_box_2").hide();

        $(".cla_box_3").hide();

        $(".cla_box_4").hide();

		$(".cla_box_5").hide();

		$(".cla_box_6").hide();

		$(".cla_box_7").hide();

    }

    if ( id == '2' ){

        $(".cla_box_1").hide();

        $(".cla_box_2").show();

        $(".cla_box_3").hide();

        $(".cla_box_4").hide();

		$(".cla_box_5").hide();

		$(".cla_box_6").hide();

		$(".cla_box_7").hide();

    }

	if ( id == '3' ){

        $(".cla_box_1").hide();

        $(".cla_box_2").hide();

		$(".cla_box_3").show();

        $(".cla_box_4").hide();

		$(".cla_box_5").hide();

		$(".cla_box_6").hide();

		$(".cla_box_7").hide();

    }

	if ( id == '4' ){

        $(".cla_box_1").hide();

        $(".cla_box_2").hide();

        $(".cla_box_3").hide();

		$(".cla_box_4").show();

		$(".cla_box_5").hide();

		$(".cla_box_6").hide();

		$(".cla_box_7").hide();

    }

	if ( id == '5' ){

        $(".cla_box_1").hide();

        $(".cla_box_2").hide();

        $(".cla_box_3").hide();

		$(".cla_box_4").hide();

		$(".cla_box_5").show();

		$(".cla_box_6").hide();

		$(".cla_box_7").hide();

    }

	if ( id == '6' ){

        $(".cla_box_1").hide();

        $(".cla_box_2").hide();

        $(".cla_box_3").hide();

		$(".cla_box_4").hide();

		$(".cla_box_5").hide();

		$(".cla_box_6").show();

		$(".cla_box_7").hide();

    }

	if ( id == '7' ){

        $(".cla_box_1").hide();

        $(".cla_box_2").hide();

        $(".cla_box_3").hide();

		$(".cla_box_4").hide();

		$(".cla_box_5").hide();

		$(".cla_box_6").hide();

		$(".cla_box_7").show();

    }

}

/*Função show/hide da sessão cla intermediario match*/

function cla_match_box_(id){

	$('html, body').animate({scrollTop: 0},'medium');

	$(".cla_match_box_"+id).show();

	for(var i=0;i<5;i++){

		if(i!=id){

			$(".cla_match_box_"+i).hide();

		}

	}

}

/*Função JS show/hide sobre as Informações dos Títulos*/

function Titulo(id){

	escondeBox('.escondeTable');

	if(id == '1'){

		mostraBox('#soldado');

	}

	if(id == '2'){

		mostraBox('#soldado_senior');

	}

	if(id == '3'){

		mostraBox('#soldado_veterano');

	}

	if(id == '4'){

		mostraBox('#forca_de_operacoes_especiais');

	}

	if(id == '5'){

		mostraBox('#divisao_de_assalto');

	}

	if(id == '6'){

		mostraBox('#divisao_de_reconhecimento');

	}

	if(id == '7'){

		mostraBox('#divisao_de_infiltracao');

	}

	if(id == '8'){

		mostraBox('#fuzileiros');

	}

	if(id == '9'){

		mostraBox('#unidade_furtiva');

	}

	if(id == '10'){

		mostraBox('#franco_atirador');

	}

	if(id == '11'){

		mostraBox('#pistoleiro');

	}

	if(id == '12'){

		mostraBox('#invasor_tatico');

	}

	if(id == '13'){

		mostraBox('#espec_explosivos');

	}

	if(id == '14'){

		mostraBox('#unidade_de_apoio');

	}

	if(id == '15'){

		mostraBox('#fuzileiros_jr');

	}

	if(id == '16'){

		mostraBox('#unidade_furtivo_senior');

	}

	if(id == '17'){

		mostraBox('#franco_atirador_jr');

	}

	if(id == '18'){

		mostraBox('#pistoleiro_senior');

	}

	if(id == '19'){

		mostraBox('#invasor_tatico_jr');

	}

	if(id == '20'){

		mostraBox('#espec_explosivos_jr');

	}

	if(id == '21'){

		mostraBox('#unidade_de_apoio_senior');

	}

	if(id == '22'){

		mostraBox('#fuzileiro_senior');

	}

	if(id == '23'){

		mostraBox('#unidade_furtiva_veterana');

	}

	if(id == '24'){

		mostraBox('#franco_atirador_senior');

	}

	if(id == '25'){

		mostraBox('#pistoleiro_veterano');

	}

	if(id == '26'){

		mostraBox('#invasor_tatico_senior');

	}

	if(id == '27'){

		mostraBox('#espec_explosivo_senior');

	}

	if(id == '28'){

		mostraBox('#unidade_de_apoio_veterano');

	}

	if(id == '29'){

		mostraBox('#fuzileiro_oficial_veterano');

	}

	if(id == '30'){

		mostraBox('#franco_atirador_veterano');

	}

	if(id == '31'){

		mostraBox('#invasor_tatico_veterano');

	}

	if(id == '32'){

		mostraBox('#espec_explosivos_veterano');

	}

	if(id == '33'){

		mostraBox('#comandante_fuzileiro');

	}

	if(id == '34'){

		mostraBox('#comandante_furtivo');

	}

	if(id == '35'){

		mostraBox('#comandante_franco_atirador');

	}

	if(id == '36'){

		mostraBox('#comandante_pistoleiro');

	}

	if(id == '37'){

		mostraBox('#comandante_invasor');

	}

	if(id == '38'){

		mostraBox('#comandante_espec_explosivos');

	}

	if(id == '39'){

		mostraBox('#comandante_de_apoio');

	}

	if(id == '40'){

		mostraBox('#fuzileiro_implacavel');

	}

	if(id == '41'){

		mostraBox('#atirador_de_elite');

	}

	if(id == '42'){

		mostraBox('#pistoleiro_lendario');

	}

	if(id == '43'){

		mostraBox('#especialista_tatico');

	}

	if(id == '44'){

		mostraBox('#lider_de_combate');

	}

}

/*AIKA - Guia do jogo - Intermediário - Nação */

function box_nacao_(id){

	if(id == '1'){

//Menu com hover		

		$('.thumb2').attr('class','thumb2');

		$('.thumb3').attr('class','thumb3');

		$('.thumb4').attr('class','thumb4');

		$('.thumb5').attr('class','thumb5');

		$('.thumb1').addClass("thumb1_hover");

//Box show/hide

		$('#box_nacao_ellora').show();

		$('#box_nacao_odeon').hide();

		$('#box_nacao_tiberica').hide();

		$('#box_nacao_elsinore').hide();

		$('#box_nacao_basilica').hide();

	}

	if(id == '2'){

//Menu com hover

		$('.thumb1').attr('class','thumb1');

		$('.thumb3').attr('class','thumb3');

		$('.thumb4').attr('class','thumb4');

		$('.thumb5').attr('class','thumb5');

		$('.thumb2').addClass("thumb2_hover");

//Box show/hide

		$('#box_nacao_odeon').show();

		$('#box_nacao_ellora').hide();

		$('#box_nacao_tiberica').hide();

		$('#box_nacao_elsinore').hide();

		$('#box_nacao_basilica').hide();

	}

	if(id == '3'){

//Menu com hover

		$('.thumb1').attr('class','thumb1');

		$('.thumb2').attr('class','thumb2');

		$('.thumb4').attr('class','thumb4');

		$('.thumb5').attr('class','thumb5');

		$('.thumb3').addClass("thumb3_hover");

//Box show/hide

		$('#box_nacao_tiberica').show();

		$('#box_nacao_ellora').hide();

		$('#box_nacao_odeon').hide();

		$('#box_nacao_elsinore').hide();

		$('#box_nacao_basilica').hide();

	}

	if(id == '4'){

//Menu com hover

		$('.thumb1').attr('class','thumb1');

		$('.thumb2').attr('class','thumb2');

		$('.thumb3').attr('class','thumb3');

		$('.thumb5').attr('class','thumb5');

		$('.thumb4').addClass("thumb4_hover");

//Box show/hide

		$('#box_nacao_elsinore').show();

		$('#box_nacao_ellora').hide();

		$('#box_nacao_odeon').hide();

		$('#box_nacao_tiberica').hide();

		$('#box_nacao_basilica').hide();

	}

	if(id == '5'){

//Menu com hover

		$('.thumb1').attr('class','thumb1');

		$('.thumb2').attr('class','thumb2');

		$('.thumb3').attr('class','thumb3');

		$('.thumb4').attr('class','thumb4');

		$('.thumb5').addClass("thumb5_hover");

//Box show/hide

		$('#box_nacao_basilica').show();

		$('#box_nacao_ellora').hide();

		$('#box_nacao_odeon').hide();

		$('#box_nacao_tiberica').hide();

		$('#box_nacao_elsinore').hide();

	}

}

/*Guia do jogo Mercury*/

function muda_(id){

	

	$('#personagem'+id).show();

	for(var i=0;i<20;i++){

		if(i!=id){

			$('#personagem'+i).hide();

		}

	}

}

function pagina_(id){

	$('html, body').animate({scrollTop: 0},'medium');

	$("#pagina_"+id).show();

	for(var i=0;i<20;i++){

		if(i!=id){

			$("#pagina_"+i).hide();

		}

	}

}

