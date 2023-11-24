<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "crud_ejlr";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Banco conectado com sucesso";
} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}

$nome = $telefone = $email = $senha = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $nome = $row["nome"];
        $email = $row["email"];
        $senha = $row["senha"];
    } else {
        echo "Registro não encontrado.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["atualizar_registro"])) {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email, senha = :senha WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<br>Registro atualizado com sucesso.";
    } else {
        echo "<br>Erro na atualização do registro.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta e atualização</title>
</head>
<body>
    <h2>Consultar e Atualizar Registro</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        ID do Registro:<br>
        <input type="text" name="id"><br>
        <input type="submit" value="Consultar">
    </form>

    <?php if ($nome) { ?>
        <h3>Registro Encontrado:</h3>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            Nome:<br>
            <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
            Telefone:<br>
            <input type="text" name="telefone" value="<?php echo $telefone; ?>"><br>
            E-mail:<br>
            <input type="email" name="email" value="<?php echo $email; ?>"><br>
            Senha:<br>
            <input type="password" name="senha" value="<?php echo $senha; ?>"><br>
            <input type="submit" name="atualizar_registro" value="Atualizar registro">
        </form>
    <?php } ?>
</body>
</html>
