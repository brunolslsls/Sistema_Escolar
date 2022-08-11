<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];  // pega id do secretario
$query = $pdo->query("SELECT * FROM secretarios where id = '$id' "); // seleciona secretario que tem esse id
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$cpf_usu = $res[0]['cpf']; // pega cpf do usuario
$query_id = $pdo->query("SELECT * FROM usuarios where cpf = '$cpf_usu' "); // seleciona usuario que tem esse cpf
$res_id = $query_id->fetchAll(PDO::FETCH_ASSOC); 

$id_usu = $res_id[0]['id']; // pega id do usuario
$pdo->query("DELETE FROM secretarios WHERE id = '$id'"); // deleta secretario com esse id
$pdo->query("DELETE FROM usuarios WHERE id = '$id_usu'");// deleta usuario com esse id

echo 'Excluído com Sucesso!';

?>