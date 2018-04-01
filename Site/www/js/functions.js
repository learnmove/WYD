function popupCentralizadoTermo(name, url, w, h)
{
	var winl = (screen.width - w) / 2;
	var win2 = (screen.height - h) / 2;  
    window.open(url, name, 'left='+winl+',top='+win2+',width='+w+',height='+h+',toolbar=no,menubar=no,status=no,resizable=no,scrollbars=yes');		
}
function limpaCampo(id_campo){   
    $(id_campo).val('');    
}
function preencheCampo(id_campo){
    if($(id_campo).val() == ''){
        $(id_campo).val("LOGIN");
    }
}
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
function ajax(pagina,lugar,oFrm,parametros,loader) { //v2.1
    try {
        var lugares        = lugar.split(",");
        var lugar_1        = lugares[0];
        var lugar_2        = lugares[1];
        var pagina        = pagina;
        var ds_loader    = "<img src='https://imagem.ongame.net/site_novo/global/loader.gif'/>";
        if (!lugar_2) lugar_2 = lugar_1;  
        if (loader != 1) $("#"+lugar_2).html(ds_loader);
        if (!parametros && oFrm) parametros = getFormValues(oFrm);
        $.ajax({
            url: pagina,
            type: "POST",
            data: parametros,
            success: function(data){
                $("#"+lugar_2).html("");
                $("#"+lugar_1).html(data);
            },
            error: function (){
                $(lugar).html("Ocorreu um erro ao carregar a p�gina. Tente novamente mais tarde!");
              }
        });
    } catch(e) {alert(e)}
}
function popupCentralizado(name, url, w, h)
{
	var winl = (screen.width - w) / 2;
	var win2 = (screen.height - h) / 2;  
	
		window.open(url, name, 'left='+winl+',top='+win2+',width='+w+',height='+h+',toolbar=no,menubar=no,status=no,resizable=no,scrollbars=yes');		
}