$(document).ready(function(){
    $(".menu_jogo").each(function(i){
        $(this).mouseover(function(){     
            removeClasse('.menu_jogo','mouse_over');
            adicionaClasse(this,'mouse_over');
            escondeBox('.barra_jogo');            
            mostraBox('#barra_' + i + ', #menu_barra');              
        });        
    });
    $('#centro, #centro_conteudo').mouseover(function(){
        escondeBox('#menu_barra');
        removeClasse('.menu_jogo','mouse_over');
    });
});
function escondeBox(ids){
    $(ids).hide();
}
function mostraBox(id){
	$(id).fadeIn('slow');
}
function adicionaClasse(id, nome_classe){
    $(id).addClass(nome_classe);
}
function removeClasse(ids, nome_classe){
    $(ids).removeClass(nome_classe);
}
