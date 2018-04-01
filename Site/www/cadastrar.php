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
if(isset($_POST['rlogin']) or isset($_POST['rsenha']) or isset($_POST['remail']) or isset($_POST['rps'])){
	$user=$_POST['rlogin'];
	$pass=$_POST['rsenha'];
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
	  $_POST['login']=$user;
	  $_POST['senha']=$pass;
	  }
	  else{{echo "<script type='text/javascript'> alert('Erro ao Criar conta na base.');</script>";}
	  }
		}
	}
	
	
	//login->sair
	if(@$_GET['acao']=="logout"){setcookie("login","",0);setcookie("senha","",0);}
	elseif(isset($_COOKIE['login']) and isset($_COOKIE['senha'])){
		$_POST['login']=hex2bin($_COOKIE['login']);
		$_POST['senha']=hex2bin($_COOKIE['senha']);}		
		
	//login->logando		
		if(isset($_POST['login']) and isset($_POST['senha'])){
			$login=$_POST['login'];
			$senha=$_POST['senha'];
		$bh2=abrirconta($login);
 if($bh2!=0 && !empty($login)){
		if($senha==trim(hex2bin(substr($bh2,32,28)))){
		$logado=true;	
	  setcookie("login",bin2hex($login),time()+60*15);
	  setcookie("senha",bin2hex($senha),time()+60*15);
	  $player=@mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `login`='".$login."'"));
		}
		else{setcookie("login","",0);setcookie("senha","",0);$alert="Senha incorreta.";}
		}
		else{setcookie("login","",0);setcookie("senha","",0);$alert="Essa conta nao existe.";}
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
<html>
<head>

<title>Forsaken Destiny - Cadastro</title>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/style4e44.css">
<link rel="stylesheet" href="css/slider.css">

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<script src='https://www.google.com/recaptcha/api.js'></script>
	
</head>
<body>
<div id="whitepage-bg">
<div class="content">
<center><br>
<a href="index.php" style="color:gray;font-size:85%"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Voltar para P&aacute;gina Inicial</a>
</center>
<header>

<div><img src="images/acc.jpg">
<font color="#d818"> Criar Conta </font><span>- Preencha os Dados</span>
</div>
</header>
<div id="theform">
<form role="form" id="facc" method="post">
<table class="tableacc">
 
  <tr>
    <td class="tableaccf">Usu&aacute;rio/Conta:</td><td class="tableacc2">
    <input type="text" placeholder="4 a 12 caracteres (A-Z 0-9)"  name="rlogin"  maxlength="12"  value="<?php echo @$_POST['rlogin']; ?>"> 
	<div class="cerror"><i class="fa fa-times"></i><span></span></div>
	<div class="cloading"><img src="images/loading.gif"/></div>
	<div class="csuccess"><i class="fa fa-check"></i></div>
	
  </td></tr>
  
  <tr>
    <td class="tableaccf">Senha:</td><td class="tableacc2">
    <input type="password" placeholder="6 a 14 caracteres (A-Z 0-9)"  name="rsenha" value=""  maxlength="13"/>
	<div class="cerror"><i class="fa fa-times"></i><span></span></div>
	<div class="cloading"><img src="images/loading.gif"/></div>
	<div class="csuccess"><i class="fa fa-check"></i></div>
  </td></tr>
  <tr>

    <td class="tableaccf">Nick:</td><td class="tableacc2">
    <input type="text" placeholder="4 a 20 caracteres (A-Z 0-9)" name="rnick" value="<?php echo @$_POST['rnick']; ?>"  maxlength="20"/>
	<div class="cerror"><i class="fa fa-times"></i><span></span></div>
	<div class="cloading"><img src="images/loading.gif"/></div>
	<div class="csuccess"><i class="fa fa-check"></i></div>
  </td></tr><br>
  <tr>

    <td class="tableaccf">E-mail:</td><td class="tableacc2">
    <input type="text"  placeholder="Seu Email, ex: meuemail@mail.com" name="remail" value="<?php echo @$_POST['remail']; ?>"  maxlength="255"/>
	<div class="cerror"><i class="fa fa-times"></i><span></span></div>
	<div class="cloading"><img src="images/loading.gif"/></div>
	<div class="csuccess"><i class="fa fa-check"></i></div>
  </td></tr><br>
</table>
<center>
	<div style="font-size:75%;text-align:left;width:300px;" class="obs"><i class="fa fa-info"></i> Use um e-mail verdadeiro, pois no futuro ele <br>podera ser usado pra recuperar sua conta caso<br> voce perca o acesso</div>
<div class="g-recaptcha" data-sitekey="6LddEx8UAAAAAM3hSOsxQaj8Voaj0235FwXQUKk4"></div>
	<BR><button id="register_button" type="submit" class="btn-create"   value="Enviar"/>Criar conta</button>
</center>
</form>
</div>

<div class="contentres">
<center>
</center>
</div>
</div>

<footer id="rodape-ongame" class="footer-jogo-4"><style>
footer#rodape-ongame *{font-family:'Open Sans',sans-serif;box-sizing:border-box;color:#999}footer#rodape-ongame{height: 287px;width:100%;display:inline-block;text-align:center;background-color:#000;margin-top:40px;padding-top:28px;border-top:2px solid #FF7E00}footer#rodape-ongame.footer-jogo-4{border-top:2px solid #d81823}footer#rodape-ongame.footer-jogo-9{border-top:2px solid #5f6a86}footer#rodape-ongame.footer-jogo-10{border-top:2px solid #B19A1A}footer#rodape-ongame.footer-jogo-14{border-top:2px solid #817d7e}footer#rodape-ongame .footer-centro{width:100%;max-width:730px;padding:5px 10px;margin:0 auto;display:table}footer#rodape-ongame h5{font-size:16px;color:#fff;text-align:left;margin:4px 0px;color:#FF7E00}footer#rodape-ongame.footer-jogo-4 h5{color:#d81823}footer#rodape-ongame.footer-jogo-9 h5{color:#5f6a86}footer#rodape-ongame.footer-jogo-10 h5{color:#B19A1A}footer#rodape-ongame.footer-jogo-14 h5{color:#817d7e}footer#rodape-ongame .box-esquerda{float:left;width:52%}footer#rodape-ongame.footer-jogo-0 .box-esquerda{width:78%}@media(max-width:600px){footer#rodape-ongame .box-esquerda{width:100%}}footer#rodape-ongame .links-footer{float:left;width:50%;margin-bottom:10px}@media(max-width:600px){footer#rodape-ongame .links-footer{width:100%}}footer#rodape-ongame #menu-jogo{}footer#rodape-ongame ul.rodape-link{text-align:left;list-style:none;padding-left:0px;margin:0px}footer#rodape-ongame ul.rodape-link li{padding-left:2px;font-size:12px;margin-top:1px}footer#rodape-ongame ul.rodape-link li a{text-align:left;color:#fff;text-decoration:none;font-size:12px}footer#rodape-ongame ul.rodape-link li a:hover{text-decoration:none;color:#FF7E00}footer#rodape-ongame.footer-jogo-4 ul.rodape-link li a:hover{color:#d81823}footer#rodape-ongame.footer-jogo-9 ul.rodape-link li a:hover{color:#5f6a86}footer#rodape-ongame.footer-jogo-10 ul.rodape-link li a:hover{color:#B19A1A}footer#rodape-ongame.footer-jogo-14 ul.rodape-link li a:hover{color:#817d7e}footer#rodape-ongame #links-uteis{}footer#rodape-ongame .box-direita{float:left;width:48%}footer#rodape-ongame.footer-jogo-0 .box-direita{width:22%}@media(max-width:600px){footer#rodape-ongame .box-direita,footer#rodape-ongame.footer-jogo-0 .box-direita{width:100%}}footer#rodape-ongame #comunidade{width:56%;height:108px}footer#rodape-ongame.footer-jogo-0 #comunidade{width:100%}footer.rodape-ongame #comunidade{height:108px}footer#rodape-ongame #comunidade h5{text-align:center}@media(max-width:600px){footer#rodape-ongame #comunidade h5{text-align:left}}footer#rodape-ongame ul.ul-redes-sociais{min-height:28px;padding:0px;list-style:none;display:table;margin:3px auto;max-width:109px}@media(max-width:600px){footer#rodape-ongame ul.ul-redes-sociais{float:left}}footer#rodape-ongame ul.ul-redes-sociais li{float:left;height:30px;margin:0 3px 8px;width:30px}footer#rodape-ongame ul.ul-redes-sociais li a{float:left;width:30px;height:30px;text-align:center;color:#fff}footer#rodape-ongame ul.ul-redes-sociais li.face a{background-color:#3559A4;transition:background-color 300ms ease 0s;display:none}footer#rodape-ongame ul.ul-redes-sociais li.face a:hover{background-color:#0A1E69;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.twitter a{background-color:#63CDF1;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.twitter a:hover{background-color:#25A5E4;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.youtube a{background-color:#E42827;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.youtube a:hover{background-color:#CC0505;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.instagram a{background-color:#6A453B;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.instagram a:hover{background-color:#2C130E;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.twitch a{background-color:#6843AC;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.twitch a:hover{background-color:#3A2276;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.forum a{background-color:#F46624;transition:background-color 300ms ease 0s}footer#rodape-ongame ul.ul-redes-sociais li.forum a:hover{background-color:#E52703;transition:background-color 300ms ease 0s}footer#rodape-ongame.footer-jogo-9 ul.ul-redes-sociais li.face a#face-ak{display:block}footer#rodape-ongame.footer-jogo-14 ul.ul-redes-sociais li.face a#face-co{display:block}footer#rodape-ongame.footer-jogo-4 ul.ul-redes-sociais li.face a#face-m2{display:block}footer#rodape-ongame.footer-jogo-10 ul.ul-redes-sociais li.face a#face-pb{display:block}footer#rodape-ongame.footer-jogo-0 ul.ul-redes-sociais li.face a#face-og{display:block}footer#rodape-ongame ul.ul-redes-sociais li a i{font-size:19px;margin-top:6px;color:#fff;font-family:FontAwesome}footer#rodape-ongame ul.ul-redes-sociais li.face a i{margin-top:7px}footer#rodape-ongame ul.ul-redes-sociais li.youtube a i{margin-top:7px;font-size:18px}footer#rodape-ongame ul.ul-redes-sociais li.twitch a i{margin-top:7px}footer#rodape-ongame ul.ul-redes-sociais li.forum a i{margin-top:5px}footer#rodape-ongame ul.ul-redes-sociais li.instagram a i{margin-top:5px;font-size:20px}footer#rodape-ongame ul.ul-redes-sociais li.twitch a i{margin-top:7px}footer#rodape-ongame #box-assinatura{width:44%;height:108px;float:left}footer#rodape-ongame.footer-jogo-0 #box-assinatura{display:none}footer#rodape-ongame #box-assinatura .assinatura-footer{width:100%;display:block;margin:0 auto;background-position:center;background-repeat:no-repeat}footer#rodape-ongame #box-assinatura .assinatura-footer#logo-ongame{background-image:url("https://imagem.ongame.net/global/logo-branco.svg");max-width:87px;height:40px}footer#rodape-ongame.footer-jogo-4 #logo-desenvolvedora{background-image:url('https://imagem.ongame.net/site_novo/global/footer/assinatura/logo_ymir_webzen.png');max-width:71px;height:40px}footer#rodape-ongame.footer-jogo-9 #logo-desenvolvedora{background-image:url('https://imagem.ongame.net/site_novo/global/footer/assinatura/logo_hanbitsoft.png');max-width:92px;height:40px}footer#rodape-ongame.footer-jogo-10 #logo-desenvolvedora{background-image:url('https://imagem.ongame.net/site_novo/global/footer/assinatura/logo_zepetto.png');max-width:80px;height:40px}footer#rodape-ongame.footer-jogo-14 #logo-desenvolvedora{background-image:url('https://imagem.ongame.net/site_novo/global/footer/assinatura/logo_neoact.png');max-width:117px;height:40px}footer#rodape-ongame .box-classificacao{width:100%;float:left;height:65px;position:relative}footer#rodape-ongame.footer-jogo-0 .box-classificacao{display:none}footer#rodape-ongame .classificacao{background-color:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.2);width:380px;height:59px;float:right;display:none;position:relative;transform-origin:top right}footer#rodape-ongame.footer-jogo-4 #classificacao-m2{display:block}footer#rodape-ongame.footer-jogo-9 #classificacao-ak{display:block}footer#rodape-ongame.footer-jogo-10 #classificacao-pb{display:block}footer#rodape-ongame.footer-jogo-14 #classificacao-co{display:block}@media(max-width:600px){footer#rodape-ongame .box-classificacao{overflow:hidden;position:relative;height:68px}footer#rodape-ongame .classificacao{position:absolute;left:50%;margin-left:-190px}}@media(max-width:400px){footer#rodape-ongame .box-classificacao{height:50px}footer#rodape-ongame .classificacao{margin-left:-149px;transform:scale(0.78,0.78);transform-origin:0 0}}footer#rodape-ongame .classificacao .classificacao-idade{width:52px;height:52px;text-align:center;display:block;float:left;margin:3px 2px;border-radius:3px}footer#rodape-ongame .classificacao .classificacao-idade#classificacao-idade-12{background-color:#FDCD01}footer#rodape-ongame .classificacao .classificacao-idade#classificacao-idade-14{background-color:#EB7710}footer#rodape-ongame .classificacao .classificacao-idade#classificacao-idade-16{background-color:#FE0000}footer#rodape-ongame .classificacao .classificacao-idade p{margin-top:7px;margin-left:-3px;font-size:30px;color:#FFFFFF;font-family:fantasy}footer#rodape-ongame .classificacao .classificacao-texto{color:#FFFFFF;width:320px;text-align:center;float:left;display:block;font-family:'Open Sans',sans-serif}footer#rodape-ongame .classificacao .classificacao-texto h6{margin-top:6px;margin-bottom:2px;font-weight:700;color:#fff}footer#rodape-ongame #classificacao-co .classificacao-texto h6{margin-top:23px}footer#rodape-ongame .classificacao .classificacao-texto p{font-size:10px;margin:3px 0px 0px;line-height:1.2;color:#ddd}footer#rodape-ongame #linha-info{float:left;clear:both;width:100%;font-size:10px;padding:8px 0px;color:#999;overflow:hidden}footer#rodape-ongame #linha-info span.box-parceria{text-align:right;display:block;margin-top:7px}footer#rodape-ongame #copyright{width:100%;color:#444;background-color:#222222}footer#rodape-ongame #copyright p{color:#fff;font-size:12px;padding:10px 0px;display:none;margin:0px}footer#rodape-ongame #copyright p *{font-size:12px;color:#fff}footer#rodape-ongame.footer-jogo-4 #copyright p#webzen-ymir{display:block}footer#rodape-ongame.footer-jogo-9 #copyright p#hanbisoft{display:block}footer#rodape-ongame.footer-jogo-10 #copyright p#zepetto{display:block}footer#rodape-ongame.footer-jogo-14 #copyright p#neoact{display:block}footer#rodape-ongame.footer-jogo-0 #copyright p#copyright-ongame{display:block}footer#rodape-ongame.footer-jogo-0 #copyright p#copyright-ongame img{height:16px;margin:-3px 12px 0px 0px}@media(max-width:600px){footer#rodape-ongame #copyright p{font-size:9px}}
</style>
    <div class="footer-centro">
        <div class="box-esquerda">
            <div class="links-footer" id="menu-jogo">
                <h5>Metin 2</h5>
                <ul class="rodape-link"><li><a href="https://m2.ongame.net/download-jogo/" target="_blank">Baixe Grátis</a></li><li><a href="https://m2.ongame.net/guia-do-jogo-iniciante/historia/" target="_blank">Guia do Jogo</a></li><li><a href="https://m2.ongame.net/noticias/" target="_blank">Notícias</a></li><li><a href="https://m2.ongame.net/blog/" target="_blank">GM Blog</a></li><li><a href="http://status.ongame.net/metin-2/" target="_blank">Status do Serviço</a></li></ul>
            </div>
            <div class="links-footer" id="links-uteis">
                <h5>Links Úteis</h5>
                <ul class="rodape-link"><li><a href="https://ongame.net/o-que-e-cash/" target="_blank">O que é cash?</a></li><li><a href="https://ongame.net/pais/" target="_blank">Informações aos Pais</a></li><li><a href="https://ongame.net/termos-de-uso/" target="_blank">Termos de Uso</a></li><li><a href="https://suporte.ongame.net/" target="_blank">Suporte</a></li><li><a href="https://m2.ongame.net/loja/" target="_blank">Loja</a></li></ul>
            </div>
        </div>
        <div class="box-direita">
            <div class="links-footer" id="comunidade">
                <h5>Comunidade</h5>
                <ul class="ul-redes-sociais">
                    <li class="face">
                        <a id="face-og" href="https://www.facebook.com/metin2brasil" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a id="face-m2" href="https://www.facebook.com/metin2brasil" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a id="face-ak" href="https://www.facebook.com/metin2brasil" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a id="face-pb" href="https://www.facebook.com/metin2brasil" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="youtube">
                        <a href="https://www.youtube.com/user/OngameTube" target="_blank"><i class="fa fa-youtube-play"></i></a>
                    </li>
                    <li class="twitch">
                        <a href="https://twitch.tv/ongamebrasil" target="_blank"><i class="fa fa-twitch"></i></a>
                    </li>
                    <li class="forum">
                        <a href="https://m2.ongame.net/forum/" target="_blank"><i class="fa fa-commenting"></i></a>
                    </li>
                    <li class="instagram">
                        <a href="https://instagram.com/ongamebrasil" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li class="twitter">
                        <a href="https://twitter.com/ongame" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                </ul>
            </div>

            <div id="box-assinatura">
                <a class="assinatura-footer" id="logo-ongame" href="https://ongame.net/" target="_blank"></a>
                <a class="assinatura-footer" id="logo-desenvolvedora" href="https://ongame.net/" target="_blank"></a>
            </div>

            
            <div class="box-classificacao">
                <div class="classificacao" id="classificacao-wd">
                    <div class="classificacao-idade" id="classificacao-idade-12"><p>12</p></div>
                    <div class="classificacao-texto">
                        <h6>NÃO RECOMENDADO PARA MENORES DE 12 ANOS</h6>
                        <p>Tema: Jogo Eletrônico - Estratégia</p>
                    </div>
                </div>

                <div class="classificacao" id="classificacao-m2">
                    <div class="classificacao-idade" id="classificacao-idade-14"><p>14</p></div>
                    <div class="classificacao-texto">
                        <h6>NÃO RECOMENDADO PARA MENORES DE 14 ANOS</h6>
                        <p>Tema: Jogo Eletrônico - Estratégia</p>
                    </div>
                </div>

                <div class="classificacao" id="classificacao-ak">
                    <div class="classificacao-idade" id="classificacao-idade-12"><p>12</p></div>
                    <div class="classificacao-texto">
                        <h6>NÃO RECOMENDADO PARA MENORES DE 12 ANOS</h6>
                        <p>Tema: Jogo Eletrônico - Estratégia</p>
                    </div>
                </div>

                <div class="classificacao" id="classificacao-pb">
                    <div class="classificacao-idade" id="classificacao-idade-16"><p>16</p></div>
                    <div class="classificacao-texto">
                        <h6>NÃO RECOMENDADO PARA MENORES DE 16 ANOS</h6>
                        <p>Tema: Jogo Eletrônico - Tiro em primeira pessoa</p>
                    </div>
                </div>

                <div class="classificacao" id="classificacao-co">
                    <div class="classificacao-idade" id="classificacao-idade-12"><p>12</p></div>
                    <div class="classificacao-texto">
                        <h6>NÃO RECOMENDADO PARA MENORES DE 12 ANOS</h6>
                    </div>
                </div>

                <div class="classificacao" id="classificacao-z4">
                    <div class="classificacao-idade" id="classificacao-idade-12"><p>12</p></div>
                    <div class="classificacao-texto">
                        <h6>NÃO RECOMENDADO PARA MENORES DE 12 ANOS</h6>
                        <p>Tema: Jogo Eletrônico - Luta 3ª pessoa</p>
                        <p>Contém: Agressão Física Animada</p>
                    </div>
                </div>
            </div>
        </div>
 </footer>
    </body>
</html>
        