<?php 

$dsn = "mysql:dbname=blog;host=localhost";
$dbuser = "root";
$dbpass = "";

try {
	$pdo = new PDO($dsn, $dbuser, $dbpass);

	$nome = "Testado";
	$email = 'testador@uol.com.br';
	$senha = md5("teste");

	$sql = "INSERT INTO usuarios SET nome = '$nome',email='$email',senha='$senha'";
	$sql = $pdo->query($sql);

	echo "Usuario inserido com sucesso!";

} catch (PDOException $e) {
	
	echo "Falhou:" .$e->getMessage();
}