<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuração da conexão com o banco de dados
    $host = 'localhost';
    $dbname = 'crud_ejlr';
    $username = 'root';
    $password = '';
    try {
        // Cria uma conexão PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Define o modo de erro do PDO para exceções
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Dados do usuário a serem inseridos
        $nome       = $_POST['nome'];
        $email      = $_POST['email'];
        $senha      = $_POST['senha']; // Lembre-se de criptografar a senha antes de armazená-la no banco

        // Prepara a instrução SQL para inserção
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);

        // Associa os valores aos parâmetros da instrução
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

        // Executa a instrução SQL
        $stmt->execute();

        echo "Usuário inserido com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Conexão não estabelecida";
}

?>
