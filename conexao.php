<?php
//adiciona todos elementos do arquivo config nesse arquivo
require_once("config.php");

//fuso horario do sistema 
date_default_timezone_set('America/Sao_Paulo');

// conectando com banco de dados
try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
	
} catch (Exception $e) {
	echo "Erro ao conectar com o banco de dados! " . $e;
}

?>