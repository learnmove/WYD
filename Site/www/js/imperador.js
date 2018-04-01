function conta(){
	var max = 255; 
	document.form_candidatura_imperador.qtd_max.value = max - document.form_candidatura_imperador.text_motivo.value.length;
}

function getImgForum(){
    ajax(URL_SITE + 'imperador/retorna-img-forum/', 'img_forum_exibir');
}

function GetVotacaoImperador(servidor){
	$(".votacao_servidor_yami").removeClass('votacao_servidor_selection');
	$(".votacao_servidor_hikari").removeClass('votacao_servidor_selection');
    $("#servidor_"+servidor).addClass('votacao_servidor_selection');
    ajax(URL_SITE + 'imperador/votacao_listar/'+servidor, 'carrega_votacao_imperador');
}

$(document).ready(function(){
	$("#servidor").change(function() {
	    ajax(URL_SITE + 'imperador/verficar_personagem', 'div_registro', '', { servidor:this.value } );
	});
});

function buscar_imperador(url, value) {
	window.location = url+value;
}

function buscar_imperador_bt(url, value, e) {
	if (e.keyCode) // testa se � IE
		var tecla = e.keyCode; // variavel tecla � igualada ao valor da tecla pressionada no IE
	else if (e.which) // testa se � FF
		var tecla = e.which; // variavel tecla � igualada ao valor da tecla pressionada no FF
	if(tecla==13)
		window.location = url+value;
}

function ValidarFormCandidatura(){
	var MSG = '';
	if( document.form_candidatura_imperador.personagem.value == '' ){ MSG += '\nPersonagem n�o selecionado!'; }
	if( document.form_candidatura_imperador.id_eleicao.value == '' ){ MSG += '\nErro, favor recarregar p�gina!'; }
	if( document.form_candidatura_imperador.id_servidor.value == '' ){ MSG += '\nErro, favor recarregar p�gina!'; }
	if( document.form_candidatura_imperador.text_motivo.value.length <= '15' ){ MSG += '\nTexto menor que 15 caracteres!'; }
	if( document.form_candidatura_imperador.img_forum.value == '' && document.form_candidatura_imperador.imagem.value == ''){
		MSG += '\nA imagem n�o existe, favor inserir uma imagem!';
	}

	if( MSG ){
		alert(MSG);
	} else {
		document.form_candidatura_imperador.submit();
	}
}

function ValidarFormVotacao(){

	var RADIO = false;
	var MSG = '';

	for( var i = 0; i < document.getElementsByName('radio_votacao').length; i++){
		if( document.form_votacao_imperador_votar.elements['radio'+[i]].checked ){ RADIO = true; }
	}
	if( RADIO == false ){ MSG += '\nFavor, selecionar um candidato!'; }
	if( document.form_votacao_imperador_votar.personagem.value == '' ){ MSG += '\nErro, favor recarregar p�gina!'; }
	if( document.form_votacao_imperador_votar.id_servidor.value == '' ){ MSG += '\nErro, favor recarregar p�gina!'; }
	if( document.form_votacao_imperador_votar.id_reino.value == '' ){ MSG += '\nErro, favor recarregar p�gina!'; }

	if( MSG ){
		alert(MSG);
	} else {
		document.form_votacao_imperador_votar.submit();
	}
}

/*M�todo JS para limpar o campo Pesquisar quando o usu�rio clicar no campo na se��o noticias*/
$(function(){
	$('#busca_imperador').click(function(){
		if( $(this).val() == 'Nome do imperador'){
			$(this).val('');
	    }
	});
});