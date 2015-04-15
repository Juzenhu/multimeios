<?
include "../include/conexao.php";

@ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();

 if(!isset($_SESSION['usuario'])){
	unset($_SESSION['usuario']);
	header('location:index.php');
	exit;
}else{
		
} 


 ?>
 <?
if(isset($_GET['pagina'])){
	$pagina = $_GET['pagina'];
}else{
	$pagina = 1;
}
 ?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CCSP - Arquivo Multimeios</title>
</head>
<body>
<? switch($pagina){

case 1:	?>
<h1>Lista de acervos</h1>
<?
$sql = "SELECT * FROM multi_tabelageral WHERE publicar = 1 ORDER BY nPacote DESC LIMIT 0,50";
$query = mysql_query($sql);
$numero = mysql_num_rows(mysql_query($sql));
?>

<p>Foram encontrados <? echo $numero; ?> registro(s)</p>

<table border='1'>
<tr>
<th width="40%">Nome do Evento</th>
<th>Tipo</th>
<th>Pacote</th>
<th width="5%"></th>
</tr>
<?
while($registro = mysql_fetch_array($query)){
	?>

	<tr>
	<td><? echo $registro['nomeEvento'] ?></td>
	<td><? echo $registro['tipoEvento'] ?></td>
	<td><? echo $registro['nPacote'] ?></td>
	<td>
	<a href="?pagina=3&registro=<? echo $registro['id']; ?>">Editar</a></td>
	
	</tr>
	
	
	<? } ?>


</table>

<? break;
case 2:
 ?>
 <? if(isset($_POST['inserir'])){
$nomeEvento = $_POST['nomeEvento'];
$dataEvento = $_POST['dataEvento'];
$tipoEvento = $_POST['tipoEvento'];
$descricao = $_POST['descricao'];
$nPacote = $_POST['nPacote'];
$equipeTecnica = $_POST['equipeTecnica'];
$assunto = $_POST['assunto'];

$sql_inserir = "INSERT INTO multi_tabelageral (`nomeEvento`, `dataEvento`, `tipoEvento`, `descricao`, `nPacote`, `equipeTecnica`, `assunto`, `id`, `publicar`) VALUES ('$nomeEvento', '$dataEvento', '$tipoEvento', '$descricao', '$nPacote', '$equipeTecnica', '$assunto', NULL, 0)"; 
$query_inserir = mysql_query($sql_inserir);	
		if($query_inserir){	
			echo "Inserido com Sucesso";

		}else{
			echo "Erro ao inserir.";
		}	 
 }else{
 
 ?>
 
 
<p>Inserir Registro</p>
<? ?>
<form method="POST" action="?pagina=2">
Nome do evento: 
<input type="texto" name="nomeEvento" size="45"><br />
Data do evento: 
<input type="texto" name="dataEvento" size="45"><br />
Tipo do evento: 
<input type="texto" name="tipoEvento" size="45"><br />
Descricao: 
<textarea name="descricao"></textarea><br />
Numero do pacote: 
<input type="texto" name="nPacote" size="45"><br />
Equipe Tecnica: 
<input type="texto" name="equipeTecnica" size="45"><br />
Assunto: 
<textarea name="assunto"></textarea><br />
<input type="hidden" name="inserir" value="1">
<input type="submit" value="Inserir">

</form>
 <? } ?>
<? break;
 case 3: 
 $id = $_GET['registro'];
 $sql_editar = "SELECT * FROM multi_tabelageral WHERE id = $id LIMIT 0,1";
 $query_editar = mysql_query($sql_editar);
 $dados = mysql_fetch_array($query_editar);
 
 
 ?>
 <h1>Editar registro</h1>
 
 <form method="POST" action="?pagina=3">
Nome do evento: 
<input type="texto" name="nomeEvento" size="45" value="<? echo $dados['nomeEvento'] ?>"><br />
Data do evento: 
<input type="texto" name="dataEvento" size="45" value="<? echo $dados['dataEvento'] ?>"><br />
Tipo do evento: 
<input type="texto" name="tipoEvento" size="45" value="<? echo $dados['tipoEvento'] ?>"><br />
Descricao: 
<textarea name="descricao"><? echo $dados['descricao'] ?></textarea><br />
Numero do pacote: 
<input type="texto" name="nPacote" size="45" value="<? echo $dados['nPacote'] ?>"><br />
Equipe Tecnica: 
<input type="texto" name="equipeTecnica" size="45" value="<? echo $dados['equipeTecnica'] ?>"><br />
Assunto: 
<textarea name="assunto"><? echo $dados['assunto'] ?></textarea><br />
<input type="hidden" name="inserir" value="1">
<input type="submit" value="Inserir">

</form>
 
 <? break; ?>
<? } //fecha a switch ?>
</body>
</html>
