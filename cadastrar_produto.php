<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("includes/db.php");

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $tipo = $_POST["tipo"];

    // Processar o upload da imagem
    $uploadDir = "uploads/";
    $nomeArquivo = uniqid() . "_" . $_FILES["imagem"]["name"];
    $caminhoArquivo = $uploadDir . $nomeArquivo;

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
        // Inserir dados no banco de dados
        $sql = "INSERT INTO produtos (nome, tipo, preco, descricao, imagem) VALUES ('$nome', '$tipo', $preco, '$descricao', '$caminhoArquivo')";
        $resultado = $conn->query($sql);

        if ($resultado) {
            echo "Lanche cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o lanche: " . $conn->error;
        }
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LancheFácil - Cadastro de Lanches</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Lanches</h1>
    </header>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="preco">Preço:</label>
        <input type="text" name="preco" required><br>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo" required>
            <option value="lanche">Lanche</option>
            <option value="bebida">Bebida</option>
        </select><br>
        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" accept="image/*" required><br>
        <input type="submit" value="Cadastrar">
    </form>
    <footer>
        <p>&copy; 2023 LancheFácil. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
