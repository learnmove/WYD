<style type="text/css">
<!--
body,td,th {
	color: #ffffff;
font-family: Arial;
}
body {
	
	background-image: url();
}
-->
</style>

<?php
error_reporting(0);

/*
Logica Guild Marck:

b030(00000+$guildid).bmp
b030(00000+$guildid).bmp
*/
    $guildid = $_POST['guildid'];

    $img = "./imags_guilds/b0".(3000000+$guildid).".bmp";

    if (isset($_FILES['arquivo']['name']))
    {
        $uploaddir = '.\\imags_guilds\\';

        $arquivo = $uploaddir."b0".(3000000+$guildid).".bmp";

        $dimensao = getimagesize($_FILES['arquivo']['tmp_name']);
        if($_FILES['arquivo']["type"] == "image/bmp")
        {
            if(($dimensao[0] <= 16) && ($dimensao[1] <= 12))
            {
                if($_FILES['arquivo']["size"] <= 2000)
                {
                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo))
                    {
                        copy($arquivo,$uploaddir."b0".(2000000+$guildid).".bmp");
                        copy($arquivo,$uploaddir."b0".(1000000+$guildid).".bmp");
                        echo "O arquivo foi enviado com sucesso.<br>";
                        $img = "imags_guilds/b0".(3000000+$guildid).".bmp";
                    }
                    else
                    {
                        echo "[Error]: O arquivo não foi enviado.<br>";
                    }
                }
                else
                {
                    echo "[Error]: Imagem muito pesada.<br>";
                }
            }
            else
            {
                echo "[Error]: Imagem muito grande.<br>";
            }
        }
        else
        {
            echo "[Error]: Formato de imagem invalida.<br>";
        }
    }
?>
<br>
<form method="post" enctype="multipart/form-data">
<table width="452" border="0">
<font color="#CEB798"><b>A Imagem deve ser 16x12 formato BMP 24bits </b><br /></font>
<br>
<br>
  <tr>
    <td width="147" align="center"><b>Guild ID:</b></td>
    <td width="218" align="center"><input name="guildid" type="text" /></td>
    <td width="73" align="center"></td>
  </tr>
  <tr>
    <td align="center"><b>Imagem:<b></td>
    <td align="center"><input name="arquivo" type="file" /></td>
	<p>

    <td align="center"><input type="submit" value="Confirmar" /></td>
  </tr>
</table>
</form><br />
<br />
<br />
<font color="#CEB798"><b>Para descobrir seu GuildID digite /nomedoseupersonagem, e ira aparecer [Name Guild] [Guild ID].</b><br /></font>
<br />
<br />
