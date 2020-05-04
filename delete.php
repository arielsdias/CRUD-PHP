<?php
// Processar operação de exclusão após confirmação
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Incluir arquivo de configuração
    require_once "config.php";
    
    // Prepare uma instrução de exclusão
    $sql = "DELETE FROM empregados WHERE id = ?";


     if($stmt = mysqli_prepare($link, $sql)){
        // Vincular variáveis ​​à instrução preparada como parâmetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Definir parâmetros
        $param_id = trim($_POST["id"]);

        // Tentativa de executar a declaração preparada
        if(mysqli_stmt_execute($stmt)){
            // Registros excluídos com sucesso. Redirecionar para a página de destino
            header("location: index.php");
            exit();
        } else{
            echo "Opa! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
     
    // Fechar declaração
    mysqli_stmt_close($stmt);
    
    // Fechar conexão
    mysqli_close($link);
} else{
    // Checa se existe o parâmetro ID
    if(empty(trim($_GET["id"]))){
        // Se não existir, redireciona para a página de erro
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Dados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Deletar Dados</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Têm certeza que deseja remover este dado?</p><br>
                            <p>
                                <input type="submit" value="SIM" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>