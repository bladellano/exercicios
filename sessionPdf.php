<?php 

session_start();

// echo '<pre>';

$_SESSION['tipodocumentos'] = [37,445,67];

$_SESSION['respostas'] = [35,37,554];

// print_r($_SESSION);
$html = "";
$html .= "<h2>Cabeçalho das Questões</h2>";
foreach ($_SESSION['tipodocumentos'] as $key => $value) {
		
	$html .= "Questões{$key} - {$value}".(in_array($value, $_SESSION['respostas']) ? " &#10003;":" &#10006;")."<br>";
 
}

echo $html;

?>