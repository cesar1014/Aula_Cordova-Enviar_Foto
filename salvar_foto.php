<?php
$target_dir = "imagens/"; // Diretório onde a imagem será salva
$imageData = $_POST['foto']; // Recebe a imagem

// Cria um nome único para a imagem
$imageName = uniqid() . ".jpg";
$target_file = $target_dir . $imageName;

// Decodifica a imagem
if (file_put_contents($target_file, base64_decode($imageData))) {
    // Conexão com o banco de dados (substitua pelos seus dados)
    $conn = new mysqli("localhost", "usuario", "senha", "banco_de_dados");

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Insere o caminho da imagem no banco de dados
    $sql = "INSERT INTO fotos (caminho) VALUES ('$target_file')";
    if ($conn->query($sql) === TRUE) {
        echo "Imagem salva com sucesso.";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Erro ao salvar a imagem.";
}
?>