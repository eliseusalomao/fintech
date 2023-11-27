<?php
// Conexão com o banco de dados (substitua os valores conforme necessário)
$host = 'localhost/crud_2711';
$db = 'crud_2711';
$user = 'seu_usuario';
$pass = 'sua_senha';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica as credenciais no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica a senha
    if ($user && password_verify($password, $user['password'])) {
        // Login bem-sucedido
        echo 'Login bem-sucedido!';
    } else {
        // Login falhou
        echo 'Credenciais inválidas';
    }
}
?>