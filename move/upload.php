<?php
session_start();
include_once "../functions/conexao.php";

$id = 0;
$remetente =  mb_strtoupper( $_SESSION['nome'], 'UTF-8');
$destinatario = $_POST['destinatario'];
$id2 = $_POST['id2'];
$ativo = 2;
//$descricao = $_POST['link']);

//$senha2 = password_hash($senha1, PASSWORD_DEFAULT);

//$uploaddir = 'arquivos/';
//$uploadfile = $uploaddir . basename($_FILES['arquivo']['name']);



$arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
$nome1 = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
$extensao = pathinfo ( $nome1, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
$extensao = strtolower ( $extensao );
 
$novoNome = uniqid ( time () ) . '.' . $extensao;
$destino = 'arquivos/ ' . $novoNome;

echo '<pre>';
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $destino)) {
    echo "Arquivo válido e enviado com sucesso.\n";
} else {
    echo "Possível ataque de upload de arquivo!\n";
}

echo 'Aqui está mais informações de debug:';
print_r($_FILES);


$query = mysqli_query($conn, "INSERT INTO videos (id, url_video, remetente, destinatario ) VALUES ('$id','$destino', '$remetente', '$destinatario')");



$result_usuario = "UPDATE codigos SET enviado='$ativo' WHERE  id='$id2'";
$resultado_usuario = mysqli_query($conn, $result_usuario);

$_SESSION['enviado'] ="document.getElementById('id01').style.display='block';
";
echo "<script type=\'text/javascript\'>	alert(\'Imagem cadastrado com Sucesso.\');</script>";
header('location: ../principal-enviar.php');			
	