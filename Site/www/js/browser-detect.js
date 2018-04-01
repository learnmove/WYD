var BrowserDetect={
    init:function(){
        this.browser=this.searchString(this.dataBrowser)||"An unknown browser";
        this.version=this.searchVersion(navigator.userAgent)||this.searchVersion(navigator.appVersion)||"an unknown version";
        this.OS=this.searchString(this.dataOS)||"an unknown OS";
    },

    searchString:function(data){
        for(var i=0;i<data.length;i++){
            var dataString=data[i].string;
            var dataProp=data[i].prop;
            this.versionSearchString=data[i].versionSearch||data[i].identity;
            if(dataString){
                if(dataString.indexOf(data[i].subString)!=-1)
                    return data[i].identity;}
                else if(dataProp)
                    return data[i].identity;
        }
    },

    searchVersion:function(dataString){
        var index=dataString.indexOf(this.versionSearchString);
        if(index==-1)return;
        return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
    },

    dataBrowser:[
        {string:navigator.userAgent,subString:"Chrome",identity:"Chrome"},
        {string:navigator.userAgent,subString:"OmniWeb",versionSearch:"OmniWeb/",identity:"OmniWeb"},
        {string:navigator.vendor,subString:"Apple",identity:"Safari"},
        {prop:window.opera,identity:"Opera"},
        {string:navigator.vendor,subString:"iCab",identity:"iCab"},
        {string:navigator.vendor,subString:"KDE",identity:"Konqueror"},
        {string:navigator.userAgent,subString:"Firefox",identity:"Firefox"},
        {string:navigator.vendor,subString:"Camino",identity:"Camino"},
        {string:navigator.userAgent,subString:"Netscape",identity:"Netscape"},
        {string:navigator.userAgent,subString:"MSIE",identity:"Internet Explorer",versionSearch:"MSIE"},
        {string:navigator.userAgent,subString:"Gecko",identity:"Mozilla",versionSearch:"rv"},
        {string:navigator.userAgent,subString:"Mozilla",identity:"Netscape",versionSearch:"Mozilla"}
    ],

    dataOS:[
        {string:navigator.platform,subString:"Win",identity:"Windows"},
        {string:navigator.platform,subString:"Mac",identity:"Mac"},
        {string:navigator.platform,subString:"Linux",identity:"Linux"}
    ]
};

BrowserDetect.init();

var UpdateYourBrowserInit = function() {
    var asn_resize=null;
    $(document).ready(function(){
       
		winplatform=navigator.platform;
        winappversion=navigator.appVersion;
        winOS=BrowserDetect.OS;

        if (
            // última versão de cada navegador atualizado em 17/09/2014 - versão mínima de 2 anos atrás para navegadroes de verdade.
            ((BrowserDetect.browser=="Internet Explorer") && (parseInt(BrowserDetect.version) <= 9)) || //9 - 11
            ((BrowserDetect.browser=="Chrome") && (parseInt(BrowserDetect.version) <=25))|| //25 - 37
            ((BrowserDetect.browser=="Opera") && (parseInt(BrowserDetect.version) <= 13))|| //13 - 24
            ((BrowserDetect.browser=="Safari") && (parseInt(BrowserDetect.version) <= 4))|| //4 - 5
            ((BrowserDetect.browser=="Firefox") && (parseInt(BrowserDetect.version) <= 19 ))) { //19 - 32

		    	HTML.init();

                $('#browser-update').slideDown(1000);
 
        } 
    });
};
 
var HTML = {
    init: function(){

       link = Array (
            Array('Chrome','https://google.com/chrome', IMG_SITE_GLOBAL+ '/browser_detect/chrome.png'),
            Array('Firefox','http://www.mozilla.org/download', IMG_SITE_GLOBAL+ '/browser_detect/firefox.png'),
            Array('Safari','http://support.apple.com/downloads/#safari', IMG_SITE_GLOBAL+ '/browser_detect/safari.png'),
            Array('Opera','http://www.opera.com/download', IMG_SITE_GLOBAL+ '/browser_detect/opera.png')
        );

        html = "<div class='warning'>Hey, parece que você está usando um navegador desatualizado =(</div>";
        html += "<p>Que tal atualizar seu navegador para um mais moderno que lhe deixará com uma experiência melhor em toda a web?</p>";
        html += "<ul>";
        $.each(link, function(i,v) {
            html += "<li>";
            html += "<a title='Baixar " + link[i][0] + "' href='" + link[i][1] + "' target='_blank'>";
            html += "<img alt='Baixar " + link[i][0] + "' width='64' src='" + link[i][2] + "' />";
            html += "<span>" + link[i][0] + "</span>";
            html += "</a>";
            html += "</li>";
        });
        html += "</ul>";

        $('body').prepend('<div id="browser-update"></div>');
        $('#browser-update').append(html);
    }
};

UpdateYourBrowserInit();