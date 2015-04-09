<?
//Imprime erros com o banco
@ini_set('display_errors', '1');
error_reporting(E_ALL);
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CCSP - Arquivo Multimeios</title>
</head>
<body>
<?


if(isset($_POST["usuario"])){
	$usuario = $_POST["usuario"];
	$senha = md5($_POST["senha"]);

	// Conecta-se com o MySQL 
mysql_connect("", "", ""); 
// Converte caracteres utf8 para evitar erros no banco
mysql_query("SET NAMES 'utf8';");
// Seleciona banco de dados 
mysql_select_db("multimeios"); 
	
	$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' LIMIT 0,1";
	$query = mysql_query($sql);
	$numero = mysql_num_rows($query);
	if($numero == 0){
		echo "Nao existe usuario.";
	}else{
		$pass = mysql_fetch_array($query);
		if($senha == $pass["senha"]){
			session_start();
			$_SESSION["usuario"] = $pass["usuario"];
			$_SESSION["permissao"] = 1;
			$data_hoje = date(now);
			$sql_log = "INSERT log (id, log, data) VALUES (NULL, 'O $usuario logou.', $data_hoje ))"
			if(mysql_query($sql_log)){
				echo "log criado";
			}else{
				echo "deu merda no log";
			}
			echo "<a href='administracao.php'>Entrar</a>";
			
		}
	}
	
}else{
 ?>

<form method="POST" action="index.php">
Usuário:<br />
<input type="text" name="usuario" size="15" /><br />
Senha:<br />
<input type="text" name="senha" size="15" /><br />
<br />
<input type="submit" value="Entrar" />
</form>
<? } ?>
</body>