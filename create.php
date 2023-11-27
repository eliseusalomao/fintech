<?php
$conexao = new mysqli("localhost", "root", "", "crud_2711");

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$sql = "INSERT INTO registros (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";

if ($conexao->query($sql) === TRUE) {
    echo "Registro inserido com sucesso";
} else {
    echo "Erro ao inserir registro: " . $conexao->error;
}

$conexao->close();
?>
