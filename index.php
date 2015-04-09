



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CCSP - Arquivo Multimeios</title>
</head>
<body>
<? 
//Imprime erros com o banco
@ini_set('display_errors', '1');
error_reporting(E_ALL);

if(isset($_POST["busca"])){
	$busca = $_POST["busca"];
		
	// Conecta-se com o MySQL 
mysql_connect("", "", ""); 
// Converte caracteres utf8 para evitar erros no banco
mysql_query("SET NAMES 'utf8';");
// Seleciona banco de dados 
mysql_select_db("multimeios"); 

$sql ="SELECT * FROM multi_tabelageral WHERE nomeEvento LIKE '%$busca%' OR descricao LIKE '%$busca%'";
$query = mysql_query($sql);
$numero = mysql_num_rows($query);


?>
	
		<p>Vocë esta buscando por <? echo $busca ?> e foram encontrados <? echo $numero ?> resultados</p>
		<p><a href="index.php">Fazer nova busca</a></p>
	<? while($lista = mysql_fetch_array($query)){
		echo "Nome do Evento: ".$lista["nomeEvento"]."<br />";
		echo "Data: ".$lista["dataEvento"]."<br />";
		echo "Descricao: ".$lista["descricao"]."<br />";
		echo "------------<br />";
		}   ?>	
		
<? }else{ ?>

		<br />
		<br />
		<center>
		<p>Procura</p>
		<form method="POST" action="index.php">
		<input type="text" name="busca" size="60"/><br />

		<input type="submit" value="Valendo!" />
		</form>
		</center>
<? } ?>
</body>


</html>
