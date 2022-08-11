<?php 
require_once("../../conexao.php"); 

// pega dados do formulario
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];

//pega dados para ver ser se ja existe no formulario
$antigo = $_POST['antigo']; // pega valor do cpf
$antigo2 = $_POST['antigo2']; // pega valor do email
$id = $_POST['txtid2'];      // pega valor do id

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit(); // exit = para de rodar o codigo 
}

if($email == ""){
	echo 'O email é Obrigatório!';
	exit();
}

if($cpf == ""){
	echo 'O CPF é Obrigatório!';
	exit();
}

//apois de editar o campo ver se esse novo valor de cpf ja existe no banco
if($antigo != $cpf){
	$query = $pdo->query("SELECT * FROM secretarios where cpf = '$cpf' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O CPF já está Cadastrado!';
		exit();
	}
}


//apois de editar o campo ver se esse novo valor de email ja existe no banco
if($antigo2 != $email){
	$query = $pdo->query("SELECT * FROM secretarios where email = '$email' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O Email já está Cadastrado!';
		exit();
	}
}


if($id == ""){  // se id for vazio
	$res = $pdo->prepare("INSERT INTO secretarios SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone");	
	$res2 = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha, nivel = :nivel");	
	$res2->bindValue(":senha", '123');  // passa senha padrão de secretarios
	$res2->bindValue(":nivel", 'secretaria');  // passa nivel padrão de secretarios

}else{
	$res = $pdo->prepare("UPDATE secretarios SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone WHERE id = '$id'");

	$res2 = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email WHERE cpf = '$antigo'");	
	
}

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":endereco", $endereco);

$res2->bindValue(":nome", $nome);
$res2->bindValue(":cpf", $cpf);
$res2->bindValue(":email", $email);


$res->execute();
$res2->execute();

echo 'Salvo com Sucesso!';

?>