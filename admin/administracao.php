<?
@ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();

$user = $_SESSION["usuario"];
$permissa = $_SESSION["permissao"];
echo $user;
echo $permissa;
 ?>