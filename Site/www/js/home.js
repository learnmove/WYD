$(document).ready(function(){

	/*BANNER YOUTUBE*/
	$(".banner_youtube").colorbox({iframe:true, width:854,height:510});
    /*FIM BANNER YOUTUBE*/

	/*SS DA HOME*/
	$(".ss_do_mes_home").colorbox({iframe:true, innerWidth:"90%", innerHeight:"90%"});
	$(".ss_home").colorbox({iframe:true, width:1050,height:830});
	$(".video_home").colorbox({iframe:true, innerWidth:747, innerHeight:474});
	$(".video_home_chaos").colorbox({iframe:true, innerWidth:1180, innerHeight:700});
    /*SS DA HOME*/

    /*RANKING*/
    $('#btGeral').click(function(){
        mostraBox('#ranking_geral');
        escondeBox('#ranking_cla');
        trocaImage(1);
    });
    $('#btCla').click(function(){
        mostraBox('#ranking_cla');
        escondeBox('#ranking_geral');    
        trocaImage(2);
    });

    if( JOGO_NAME == 'aika' ){
    	// RANKING DE HOME
		$('#btPersonagemAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral_over.png)');
	    $('#btPersonagemAika').click(function(){
	        mostraBox('#ranking_personagem');
	        escondeBox('#ranking_guilda');
	        trocaImage(10);
	    });
	    $('#btGuildaAika').click(function(){
	        mostraBox('#ranking_guilda');
	        escondeBox('#ranking_personagem');
	        trocaImage(11);
	    });
	
	    $('#btArcanAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral_over.png)');
	    $('#btArcanAika').click(function(){
	        mostraBox('#ranking_arcan');
	        escondeBox('#ranking_krizon');
	        trocaImage(12);
	    });
	    $('#btKrizonAika').click(function(){
	        mostraBox('#ranking_krison');
	        escondeBox('#ranking_arcan');
	        trocaImage(13);
	    });
	    // RANKING DE HOME

		// RANKING DE RELÍQUIAS
	    $('#btArcanAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral_over.png)');
	    $('#btArcanAika').click(function(){
	        mostraBox('#ranking_arcan');
	        escondeBox('#ranking_krizon');
	        trocaImage(14);
	    });
	    $('#btKrizonAika').click(function(){
	        mostraBox('#ranking_krison');
	        escondeBox('#ranking_arcan');
	        trocaImage(15);
	    });
	    $('#btReliquiasArcan').css({'background-image':'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_bt_arcan.png)', 'background-position':'0px -21px'});
	    $('#btReliquiasArcan').click(function(){
	        mostraBox('#reliquia_arcan');
	        escondeBox('#reliquia_krizon');
	        trocaImage(16);
	    });
	    $('#btReliquiasKrizon').click(function(){
	        mostraBox('#reliquia_krizon');
	        escondeBox('#reliquia_arcan');
	        trocaImage(17);
	    });
	    // RANKING DE RELÍQUIAS
    }
    if( JOGO_NAME == 'wyd' ){
        $('#btMalech').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_malech_over.png)');
        $('#btMalech').click(function(){
            mostraBox('#ranking_malech');
            escondeBox('#ranking_sephira');
            escondeBox('#ranking_alastar');
            trocaImage(3);
        });
        $('#btSephira').click(function(){
            mostraBox('#ranking_sephira');
            escondeBox('#ranking_malech');
            escondeBox('#ranking_alastar');
            trocaImage(4);
        });
        $('#btAlastar').click(function(){
            mostraBox('#ranking_alastar');
            escondeBox('#ranking_malech');
            escondeBox('#ranking_sephira');
            trocaImage(5);
        });
    }

	if( JOGO_NAME == 'metin2' ){
	    $('#btPersonagem').css('background-image', 'url('+IMG_SITE+'home/ranking/metin2_aba_personagem_over.png)');
	    $('#btPersonagem').click(function(){
	        mostraBox('#ranking_personagem');
	        escondeBox('#ranking_guilda');
	        trocaImage(6);
	    });
	    $('#btGuilda').click(function(){
	        mostraBox('#ranking_guilda');
	        escondeBox('#ranking_personagem');
	        trocaImage(7);
	    });
	}

	if( JOGO_NAME == 'zone4' ){
		$('#btExperiencia').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral_over.png)');
		$('#btExperiencia').click(function(){
		    mostraBox('#ranking_experiencia');
		    escondeBox('#ranking_progressao');
		    trocaImage(8);
		});
		$('#btProgressao').click(function(){
		    mostraBox('#ranking_progressao');
		    escondeBox('#ranking_experiencia');
		    trocaImage(9);
		});
	}
    /*FIM RANKING*/ 

    /*GM RECOMENDA*/
    $('#gm_recomenda').jcarousel({
        wrap    : 'circular',
        scroll  : 1,
        auto    : 2
    });
    /*FIM GM RECOMENDA*/

    /*SCREENSHOT*/
    $('#screenshot').jcarousel({
        wrap    : 'circular',
        scroll  : 1,
        auto    : 2
    });
    /*FIM SCREENSHOT*/

    /*VÍDEOS*/
    $('#videos').jcarousel({
    	wrap    : 'circular',
        scroll  : 1,
        auto    : 2
    });
    /*FIM VÍDEOS*/

    /*NOTICIAS*/
    var cor = {};
    cor["pointblank"] 	= {0:"#FFF",1:"#B19A1A"}; //chave 0 cor inicial, chave 1 cor do hover
    cor["mercuryred"] 	= {0:"#E4CF96",1:"#BF5C35"};
    cor["aika"] 		= {0:"#CCCECB",1:"#5F6A86"};
    cor["wyd"] 			= {0:"#CCCECB",1:"#2C4647"};
    cor["metin2"] 		= {0:"#E4CF96",1:"#E4CF96"};
    cor["asda2"] 		= {0:"#E4CF96",1:"#E4CF96"};   
    cor["zone4"] 		= {0:"#FFF",1:"#16c427"};
    cor["chaos"] 		= {0:"#FFF",1:"#817d7e"};

    $(".titulo_lista li a").each(function(i){
        $(this).mouseover(function(){
            $('.titulo_lista li a').css('color',cor[JOGO_NAME][0]);
            $(this).css('color',cor[JOGO_NAME][1]);
            escondeBox('.noticias_conteudo');
            mostraBox('#noticias_conteudo'+i);
        });
    });
    /*FIM NOTICIAS*/
});

function trocaImage(cd){    
    switch(cd){        
        case 1:
            $('#btGeral').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral_over.png)');
            $('#btCla').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_cla.png)');
        break;
        case 2:
            $('#btCla').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_cla_over.png)');
            $('#btGeral').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral.png)');
        break;
        case 3:
            $('#btMalech').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_malech_over.png)');
            $('#btSephira').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_sephira.png)');
            $('#btAlastar').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_alastar.png)');
        break;
        case 4:
            $('#btSephira').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_sephira_over.png)');
            $('#btMalech').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_malech.png)');
            $('#btAlastar').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_alastar.png)');
        break;
        case 5:
            $('#btAlastar').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_alastar_over.png)');
            $('#btMalech').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_malech.png)');
            $('#btSephira').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_sephira.png)');
        break;
        case 6:
            $('#btPersonagem').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_personagem_over.png)');
            $('#btGuilda').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_guilda.png)');
        break;
        case 7:
            $('#btGuilda').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_guilda_over.png)');
            $('#btPersonagem').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_personagem.png)');
        break;
        case 8:
            $('#btExperiencia').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral_over.png)');
            $('#btProgressao').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_cla.png)');
        break;
        case 9:
            $('#btProgressao').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_cla_over.png)');
            $('#btExperiencia').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_geral.png)');
        break;
        case 10:
            $('#btPersonagemAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_personagem_over.png)');
            $('#btGuildaAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_guilda.png)');
        break;
        case 11:
            $('#btGuildaAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_guilda_over.png)');
            $('#btPersonagemAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_personagem.png)');
        break;
        case 12:
            $('#btArcanAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_arcan_over.png)');
            $('#btKrizonAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_krizon.png)');
        break;
        case 13:
            $('#btKrizonAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_krizon_over.png)');
            $('#btArcanAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_arcan.png)');
        break;
        case 14:
            $('#btArcanAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_arcan_over.png)');
            $('#btKrizonAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_krizon.png)');
        break;
        case 15:
            $('#btKrizonAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_krizon_over.png)');
            $('#btArcanAika').css('background-image', 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_aba_arcan.png)');
        break;
        case 16:
            $('#btReliquiasArcan').css({'background-image': 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_bt_arcan.png)', 'background-position': '0 -21px' });
            $('#btReliquiasKrizon').css('background-position', '0px 0px');
        break;
        case 17:
            $('#btReliquiasKrizon').css({'background-image': 'url('+IMG_SITE+'home/ranking/'+JOGO_NAME+'_bt_krizon.png)', 'background-position': '0 -21px' });
            $('#btReliquiasArcan').css('background-position', '0px 0px');
        break;
    }
}

