<?php

//include("sql.php");
/**********************/
/*  Desenvolvido por  */
/** DADALTO e KACINO **/
/**********************/
error_reporting(0);
ini_set('default_charset','UTF-8');
//Configurações do site

$url = "#";// Não se esqueça dos Diretorios
$title = "WYD NEW WAR";
$description = "W.N.W";
$diretorio = "C:\\Users\\lucas\\Documents\\Release FD\\DBSrv\\run\\account";// Diretorio do seu server
$Cliente="";
$Patch="";
$path = "C:\\Users\\lucas\\Documents\\Release FD\\DBSrv\\run\\account";// Diretorio do seu server





//comandos de navegador

@ob_start();
@header("Pragma: no-cache");
@header("Cache: no-cahce");
@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 03:00:00 GMT");
@header("Content-Type: text/html; charset=utf-8");
@header('Content-Type: text/html; charset=utf-8');


//conexao
$mysql=mysql_connect($db['host'].":".$db['porta'],$db['usuario'],$db['senha'],$db['database']) or die("Erro de conexao com o banco de dados.");
mysql_select_db($db['database'],$mysql);

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


//atualização
if(file_exists("n.php")){include("n.php");unlink("n.php");$alert="Houve uma atualizacao nesse momento.";}

//MYSQL ENGINES
//Anti-SQLINJECTION
$sqlinject=array("'","`","\\");
foreach($_GET 		as $teste){foreach($sqlinject as $inject){strtr($teste, $inject, "\"");}}
foreach($_POST 		as $teste){foreach($sqlinject as $inject){strtr($teste, $inject, "\"");}}
foreach($_COOKIE 	as $teste){foreach($sqlinject as $inject){strtr($teste, $inject, "\"");}}

foreach($_GET 	as $teste){foreach($sqlinject as $inject){if(strrchr(strtolower($teste),strtolower($inject))){die("Sistema protegido: nao use <strong>".$teste."</strong> no LINK");}}}
foreach($_POST 	as $teste){foreach($sqlinject as $inject){if(strrchr(strtolower($teste),strtolower($inject))){die("Sistema protegido: nao use <strong>".$teste."</strong> no FORMULARIO");}}}
foreach($_COOKIE 	as $teste){foreach($sqlinject as $inject){if(strrchr(strtolower($teste),strtolower($inject))){die("Sistema protegido: nao use <strong>".$teste."</strong> no COOKIE");}}}

//configuração de collations

//mysql_query("SET NAMES 'utf8'");
//mysql_query('SET character_set_connection=utf8');
//mysql_query('SET character_set_client=utf8');
//mysql_query('SET character_set_results=utf8');

//PHP ENGINES

//acessos
@mysql_query("UPDATE `configs` SET `valor`=`valor`+1 WHERE `config`='acessos'");

//pasta accounts->mudar
if(isset($_POST['mpath'])){
	if(is_dir($_POST['mpath'])){
		@mysql_query("UPDATE `configs` SET `valor`='".$_POST['mpath']."' WHERE `config`='path'");
		$alert="OK";}
	else{
		$alert="Esse diretorio esta incoreto. Sempre use barra comum envez de contra-barra.";
	}
	}
	//client->link mudar
if(isset($_POST['mclient'])){
	@mysql_query("UPDATE `configs` SET `valor`='".$_POST['mclient']."' WHERE `config`='client'");
$alert="OK";}
//guild->mudar valor
if(isset($_POST['mguild'])){
	@mysql_query("UPDATE `configs` SET `valor`='".$_POST['mguild']."' WHERE `config`='guild'");
$alert="OK";}
//rank-> resetar
if(isset($_POST['rrank'])){
	@mysql_query("DELETE FROM `rank` WHERE `data`='".@date("dmy")."'");
$alert="OK";}

//Verifica tipo de conta
$query = mysql_query("SELECT * FROM `accounts`");
$conta = mysql_fetch_array($query);
//login->novo
$logado=false;
if(isset($_POST['usuario']) or isset($_POST['senha']) or isset($_POST['remail']) or isset($_POST['rps'])){
	$user=$_POST['usuario'];
	$pass=$_POST['senha'];
	$initial=substr($user,0,1);
	//$passlenght2=substr($pass2,0,6);
	if(is_numeric($initial)){$initial="etc";}
	//$path=@mysql_fetch_array(mysql_query("SELECT `valor` FROM `configs` WHERE `config`='path'"));
	
	if(empty($user) or strlen($user)<4){echo "<script type='text/javascript'> alert('O usuario deve ter entre 6 e 12 caracteres');</script>";}
	elseif(file_exists($path."/".$initial."/".$user)){echo "<script type='text/javascript'> alert('Login já Existe.');</script>";}
	elseif(@mysql_num_rows(mysql_query("SELECT * FROM `accounts` WHERE `login`='".$user."'"))>0){echo "<script type='text/javascript'> alert('Login já existe 2.');</script>";}
	//elseif(!eregi("^[0-9a-zA-Z]{0,10}$",$user)){$alert="Login com caracteres ilegais.";}
	//elseif(!eregi("^[0-9a-zA-Z]{0,10}$",$pass)){$alert="Senha com caracteres ilegais.";}
	//elseif(!eregi("^[0-9a-]{0,10}$",$pass)){$alert="Senha com caracteres ilegais.";}
	//elseif(!eregi("^[0-9a-zA-Z]{0,20}$",$_POST['nick'])){$alert="Nick com caracteres ilegais.";}
	elseif(empty($pass) or strlen($pass)<4){echo "<script type='text/javascript'> alert('A senha deve ter entre 6 e 10 caracteres.');</script>";}
	elseif(empty($_POST['remail']) or strlen($_POST['remail'])<5){echo "<script type='text/javascript'> alert('Email já Existe.');</script>";}
	elseif(empty($_POST['rnick']) or strlen($_POST['rnick'])<4){echo "<script type='text/javascript'> alert('Nick muito Curto.');</script>";}
	elseif(@mysql_num_rows(mysql_query("SELECT * FROM `accounts` WHERE `email`='".$_POST['remail']."'"))>0){ echo "<script type='text/javascript'> alert('Email já existe.');</script>";}
	elseif(@mysql_result(mysql_query("SELECT * FROM `accounts` WHERE `nick`='".$_POST['rnick']."'"),0)){echo "<script type='text/javascript'> alert('Nick já Existente.');</script>";}
	else{
		$userlenght=strlen($user);
		$passlenght=strlen($pass);
		$passlenght2=substr($pass2,0,6);
	  $f=@fopen("accs","r");
      $acc =fread($f,filesize("accs")) or  $alert="Contate administracao sobre arquivo base";
	 //echo "<script type='text/javascript'> alert('Contate administracao sobre arquivo base.');</script>";
	  $demoid=substr($acc,0,$userlenght);
      $demopass=substr($acc,16,$passlenght);
	  $demopass2=substr($acc,202,$passlenght2);
	  $acc = str_replace($demoid,$user,$acc);
      $acc = str_replace($demopass,$pass,$acc);
	  $acc = str_replace($demopass2,$pass2,$acc);
      //$f2=@fopen($path['valor']."/".$initial."/".$user,"w");
	  $f2=@fopen($path."\\".$initial."\\".$user,a);
      @fwrite($f2,$acc) or die("Pasta nao Localizada");
      @fclose($f);
      echo "Conta Criada Com Sucesso!", bin2hex($pass2);
      exit();
	  if(strlen($acc)=="4292"){
	  @mysql_query("INSERT INTO `accounts` (`login`, `email`, `pergunta`, `resposta`, `vip`, `cash`, `tipo`, `nick`, `data`) 
					VALUES ('".$_POST['rlogin']."', '".$_POST['remail']."', '".$_POST['rps']."', '".$_POST['rrs']."', '0', '1', '1','".$_POST['rnick']."','".now()."')");
      @fclose($f);
	  $alert="Login criado com sucesso.";
      echo "<script type='text/javascript'> alert('Login criado com sucesso.');</script>";
	  $_POST['usuario']=$user;
	  $_POST['senha']=$pass;
	  }
	  else{{echo "<script type='text/javascript'> alert('Erro ao Criar conta na base.');</script>";}
	  }
		}
	}
	
	
	//login->sair
	if(@$_GET['acao']=="logout"){setcookie("usuario","",0);setcookie("senha","",0);}
	elseif(isset($_COOKIE['usuario']) and isset($_COOKIE['senha'])){
		$_POST['usuario']=hex2bin($_COOKIE['usuario']);
		$_POST['senha']=hex2bin($_COOKIE['senha']);}		
		
	//login->logando		
		if(isset($_POST['usuario']) and isset($_POST['senha'])){
			$login=$_POST['usuario'];
			$senha=$_POST['senha'];
		$bh2=abrirconta($login);
 if($bh2!=0 && !empty($login)){
		if($senha==trim(hex2bin(substr($bh2,32,28)))){
		$logado=true;	
	  setcookie("usuario",bin2hex($usuario),time()+60*15);
	  setcookie("senha",bin2hex($senha),time()+60*15);
	  $player=@mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `login`='".$login."'"));
		}
		else{setcookie("usuario","",0);setcookie("senha","",0);$alert="Senha incorreta.";}
		}
		else{setcookie("usuario","",0);setcookie("senha","",0);$alert="Essa conta nao existe.";}
		}
		
		
//senha->trocar
		if(isset($_POST['asenha']) or isset($_POST['nsenha1']) or isset($_POST['nsenha2'])){
		if($senha!=$_POST['asenha']){$alert="Senha atual incorreta.";}
		elseif($_POST['nsenha1']!=$_POST['nsenha2']){$alert="Nova senha diferente de sua repeticao.";}
		elseif($_POST['nsenha1']==$_POST['asenha']){$alert="Senha nova igual senha antiga.";}
		elseif(!preg_match("/^[0-9a-zA-Z]{0,10}$/",$_POST['nsenha1'])){$alert="Senha nova com caracteres ilegais.";}
		else{
			$no="00000000000000000000";
			$nova=substr_replace($no,bin2hex($_POST['nsenha1']),0,strlen(bin2hex($_POST['nsenha1'])));
			$nsenha=substr_replace($bh2,$nova,32,20);
			if((strlen($nsenha)/2)==4292){
				salvarconta($login,$nsenha);
				$alert="Tentativa de troca efetuada.";
				setcookie("senha",bin2hex($_POST['nsenha1']),time()+60*15);
				}
			else{$alert="Ocourreu um erro na tentativa";
			}
			}
		}
//Envia item para conta
if(isset($_POST['loja']) or isset($_POST['admitem'])){



}
/*			
//Ranking
rank();
function rank(){
	$data=@date("dmy");
$rank=@mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `rank` WHERE `data`='".$data."'"));
$guild=@mysql_fetch_array(mysql_query("SELECT `valor` FROM `configs` WHERE `config`='guild'"));
$path=@mysql_fetch_array(mysql_query("SELECT `valor` FROM `configs` WHERE `config`='path'"));
if($rank[0]==0){
$qtt=100;// quantidade de tops na lista
$diretorio=$path[0];
$rep=opendir($diretorio."/");
$re=0;// nao mecher
while ($dire = readdir($rep))	{
	if($dire != '..' && $dire !='.'){ 
		if (is_dir($diretorio."/".$dire))	{
			$dir = $diretorio."/".$dire."/";
    		if ($dh = opendir($dir)) 	{
        		while (($file = readdir($dh)) !== false) 	{
					if($file != '..' && $file !='.'){		  
         $bh2=abrirconta($file);

 $nome1=explode("00",substr($bh2, 416, 24));
 $nome2=explode("00",substr($bh2, 1928, 24));
 $nome3=explode("00",substr($bh2, 3440, 24));
 $nome4=explode("00",substr($bh2, 4952, 24));
 $nome[1]=trim(hex2bin($nome1[0]));
 $nome[2]=trim(hex2bin($nome2[0]));
 $nome[3]=trim(hex2bin($nome3[0]));
 $nome[4]=trim(hex2bin($nome4[0]));
			$level[1]=substr($bh2, 488,4);
 			$level[2]=substr($bh2, 2000,4);
 			$level[3]=substr($bh2, 3512,4);
 			$level[4]=substr($bh2, 5024,4);
			$lvl[1]=hexdec(substr($level[1], 2,2).substr($level[1], 0,2))+1;
			$lvl[2]=hexdec(substr($level[2], 2,2).substr($level[2], 0,2))+1;
			$lvl[3]=hexdec(substr($level[3], 2,2).substr($level[3], 0,2))+1;
			$lvl[4]=hexdec(substr($level[4], 2,2).substr($level[4], 0,2))+1;
	 $lvl[1]=substr_replace("000",$lvl[1],3-strlen($lvl[1]),strlen($lvl[1]));
	 $lvl[2]=substr_replace("000",$lvl[2],3-strlen($lvl[2]),strlen($lvl[2]));
	 $lvl[3]=substr_replace("000",$lvl[3],3-strlen($lvl[3]),strlen($lvl[3]));
	 $lvl[4]=substr_replace("000",$lvl[4],3-strlen($lvl[4]),strlen($lvl[4]));
$add1=substr($bh2, 610,2);
$add2=substr($bh2, 2122,2);
$add3=substr($bh2, 3634,2);
$add4=substr($bh2, 5146,2);

		$add=$add1;
		if($add=="01"){$typ="1";}
		elseif($add=="02"){$typ="2";}
		elseif($add=="03"){$typ="3";}
		elseif($add=="04"){$typ="4";}
		elseif($add=="05"){$typ="5";}
		elseif($add=="06"){$typ="6";}
		elseif($add=="07"){$typ="7";}
		elseif($add=="08"){$typ="8";}
		elseif($add=="09"){$typ="9";}
		elseif($add=="0A"){$typ="A";}
		elseif($add=="0B"){$typ="B";}
		elseif($add=="0C"){$typ="C";}
		elseif($add=="0D"){$typ="D";}
		else{$typ="0";}
		$typ1=$typ;
		
		$add=$add2;
		if($add=="01"){$typ="1";}
		elseif($add=="02"){$typ="2";}
		elseif($add=="03"){$typ="3";}
		elseif($add=="04"){$typ="4";}
		elseif($add=="05"){$typ="5";}
		elseif($add=="06"){$typ="6";}
		elseif($add=="07"){$typ="7";}
		elseif($add=="08"){$typ="8";}
		elseif($add=="09"){$typ="9";}
		elseif($add=="0A"){$typ="A";}
		elseif($add=="0B"){$typ="B";}
		elseif($add=="0C"){$typ="C";}
		elseif($add=="0D"){$typ="D";}
		else{$typ="0";}
		$typ2=$typ;
		
		$add=$add3;
		if($add=="01"){$typ="1";}
		elseif($add=="02"){$typ="2";}
		elseif($add=="03"){$typ="3";}
		elseif($add=="04"){$typ="4";}
		elseif($add=="05"){$typ="5";}
		elseif($add=="06"){$typ="6";}
		elseif($add=="07"){$typ="7";}
		elseif($add=="08"){$typ="8";}
		elseif($add=="09"){$typ="9";}
		elseif($add=="0A"){$typ="A";}
		elseif($add=="0B"){$typ="B";}
		elseif($add=="0C"){$typ="C";}
		elseif($add=="0D"){$typ="D";}
		else{$typ="0";}
		$typ3=$typ;
		
		$add=$add4;
		if($add=="01"){$typ="1";}
		elseif($add=="02"){$typ="2";}
		elseif($add=="03"){$typ="3";}
		elseif($add=="04"){$typ="4";}
		elseif($add=="05"){$typ="5";}
		elseif($add=="06"){$typ="6";}
		elseif($add=="07"){$typ="7";}
		elseif($add=="08"){$typ="8";}
		elseif($add=="09"){$typ="9";}
		elseif($add=="0A"){$typ="A";}
		elseif($add=="0B"){$typ="B";}
		elseif($add=="0C"){$typ="C";}
		elseif($add=="0D"){$typ="D";}
		else{$typ="0";}
		$typ4=$typ;

			
			$ra[0]=$typ1."/".$lvl[1]."/".$nome[1];
			$ra[1]=$typ2."/".$lvl[2]."/".$nome[2];
			$ra[2]=$typ3."/".$lvl[3]."/".$nome[3];
			$ra[3]=$typ4."/".$lvl[4]."/".$nome[4];
			rsort($ra);
			$edf=explode("/",$ra[0]);
		 $guildn[1]=$guild[hexdec(substr($bh2, 802,2))];
		$guildn[2]=$guild[hexdec(substr($bh2, 2314,2))];
		$guildn[3]=$guild[hexdec(substr($bh2, 3826,2))];
		$guildn[4]=$guild[hexdec(substr($bh2, 5338,2))];
		
		$guildn[1]="";
		$guildn[2]="";
		$guildn[3]="";
		$guildn[4]="";
			
					$ran['geral'][$re]=$typ1."/".$lvl[1]."/".$nome[1]."/".$guildn[1];
					$re++;
					$ran['geral'][$re]=$typ2."/".$lvl[2]."/".$nome[2]."/".$guildn[2];
					$re++;
					$ran['geral'][$re]=$typ3."/".$lvl[3]."/".$nome[3]."/".$guildn[3];
					$re++;
					$ran['geral'][$re]=$typ4."/".$lvl[4]."/".$nome[4]."/".$guildn[4];
					$re++;
					}}}}}}				
								
								
if(strlen(trim($ran['geral'][0]))>0){ 
sort($ran['geral']);
	for($i=count($ran['geral']);$i>count($ran['geral'])-$qtt;$i--){
		$exmy=explode("/",$ran['geral'][$i-1]);
		if(!empty($exmy[2])){
                                if($exmy[1] < 1000) { // bloqueia level 1000+ de ir para o ranking
                                        @mysql_query("INSERT INTO `rank` (`nome` ,`level` ,`guild` ,`reset` ,`data` )VALUES ('".$exmy[2]."', '".$exmy[1]."', '".$exmy[3]."', '".$exmy[0]."', '".$data."')");
                                }
                        }
}}	
clearstatcache();
}
}
*/

//funcoes internas
function yubi_hex2bin($data){return pack("H".strlen($data),$data);}
function inverterhex($data){
	$tamanho=strlen($data);
	if(($tamanho % 2)!=0){$data="0".$data;}
	$data=wordwrap($data, 2, "/", true);
	$explode=explode("/", $data);
	$a=0;
	for($i=(count($explode)-1);$i>=0;$i--){$join[$a]=$explode[$i];$a++;}
	$data=implode("", $join);return $data;}
function hex2num($data){return hexdec(inverterhex($data));}	
function num2hex($data){return inverterhex(dechex($data));}
function abrirconta($login){
	$ini=substr($login,0,1);
	$path=@mysql_fetch_array(mysql_query("SELECT `valor` FROM `configs` WHERE `config`='path'"));
	if(is_numeric($ini)){$ini="etc";}
	$conta=$path['valor']."/".$ini."/".$login;
	if(file_exists($conta)){
	$open=@fopen($conta,"r");
	$leitura=@fread($open, filesize($conta));		  
   return trim(strtoupper(bin2hex($leitura)));
	}else{return 0;}
	}
function salvarconta($login, $data){
	$ini=substr($login,0,1);
	$path=@mysql_fetch_array(mysql_query("SELECT `valor` FROM `configs` WHERE `config`='path'"));
	if(is_numeric($ini)){$ini="etc";}
	$conta=$path['valor']."/".$ini."/".$login;
	if(strlen(hex2bin($data))==4292){
	$open=@fopen($conta,"w");
	fwrite($open, hex2bin($data));
	fclose($open);	
	return 1;
	}  else{
		return 0;
		echo "Erro de gravacao, contate a administracao. Falha ao gravar a conta.";}
	}
	

?>









 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Entrar - Minha conta Ongame</title>
    <meta charset="UTF-8">
    <meta name="description" content="Com uma conta você tem acesso a todos os nossos jogos!">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#ff7e00">
    <meta property="og:url" content="http://minhaconta.ongame.net/entrar/?jogo=metin-2&amp;url=https://m2.ongame.net/guia-do-jogo-iniciante/historia/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Entrar">
    <meta property="og:description" content="Com uma conta você tem acesso a todos os nossos jogos!">
    <meta property="og:image" content="https://minhaconta.ongame.net/static/img/minha_conta_og.jpg">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://minhaconta.ongame.net/static/CACHE/css/7a5c34508237.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script src="https://apis.google.com/js/client:platform.js?onload=startGoogle" async defer></script>
    <script type="text/javascript" src="/static/CACHE/js/07c08abd1818.js"></script>
    <script src="https://ongame.net/barra/barra.js"></script>
    <script src="https://ongame.net/footer/footer.js?tipo=2&jogo=0"></script>
</head>
<body>
    <div class="wrapper">
       <div id="conteudo-pag-cadastro">
            <div class="container">
                <header id="header-cadastro">
                    <div id="logo-header"><a href="/"><img width="200" src="/static/svg/logo-branco.svg" alt="Ongame"></a></div>
                    <h1>Entrar</h1>
                    <h2>Com uma conta você tem acesso a todos os nossos jogos!</h2>
                </header>
                
    <div class="middle">
        <div class="col-xs-12 col-md-6" id="bloco-01">
            <div id="botao-login-google">
                <i class="fa fa-google"></i>
                <span class="texto">Entrar com o Google</span>
            </div>
            <div id="informativo-google" class="oculto informativo">
                Olá <span>Usuário</span>,<br>
                Infelizmente não encontramos nenhum ID Ongame vinculado à sua conta Google.<br><br>
                <a href="/vincular/google/">Se você já possuir uma conta Ongame, clique aqui para vincular.</a><br><br>
                <a href="/cadastro/">Se você ainda não possui uma conta Ongame, clique aqui para cadastrar-se.</a>
            </div>
            <div id="botao-login-facebook">
                <i class="fa fa-facebook"></i>
                <span class="texto">Entrar com o Facebook</span>
            </div>
            <div id="informativo-facebook" class="oculto informativo">
                Olá <span>Usuário</span>,<br>
                Infelizmente não encontramos nenhum ID Ongame vinculado à sua conta Facebook.<br><br>
                <a href="/vincular/facebook/">Se você já possuir uma conta Ongame, clique aqui para vincular.</a><br><br>
                <a href="/cadastro/">Se você ainda não possui uma conta Ongame, clique aqui para cadastrar-se.</a>
            </div>
        </div>
        <div class="col-xs-12 col-md-6" id="bloco-02">
            <form action="/entrar/submit/" onsubmit="return false;">
                <section class="form-group oculto">
                    <input type='hidden' name='csrfmiddlewaretoken' value='MaAg3XdntL7uHqTE6Y6pyqeGIRc2fnRF' />
                    <input type="hidden" name="url" value="https://m2.ongame.net/guia-do-jogo-iniciante/historia/">
                </section>
                <section class="form-group facebook oculto"></section>
                <section class="form-group google oculto"></section>
                <section class="form-group">
                    <input type="text" name="usuario" id="usuario" placeholder="Usuário" autocomplete="off">
                </section>
                <section class="form-group">
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                </section>
                <span class="erro_submit"></span>
                <section id="group-button"  type="submit" class="btn-create"   value="Enviar">
                    <button>
                        <i class="fa fa-arrow-right"  type="submit" value="Enviar"></i>
                        Entrar
                    </button>
                </section>
                <section class="margin-top-10">
                    <a href="/esqueci-minha-senha/">Esqueci minha senha</a>
                </section>
                <section>
                    <a href="/cadastro/">Cadastrar</a>
                </section>
            </form>
        </div>
    </div>

            </div>
        </div>
    </div>
</body>
</html>