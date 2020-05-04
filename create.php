<?php
// Incluir arquivo de configuração
require_once "config.php";
 
// Definir variáveis ​​e inicializar com valores vazios
$nome = $endereco = $salario = "";
$nome_erro = $endereco_erro = $salario_erro = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Valida nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_erro = "Por favor, entre com um nome.";
    } elseif(!filter_var($input_nome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[A-Z\s]+$/")))){
        $nome_erro = "Por favor, entre com um nome válido.";
    } else{
        $nome = $input_nome;
    }
    
    // Validate endereco
    $input_endereco = trim($_POST["endereco"]);
    if(empty($input_endereco)){
        $endereco_erro = "Por favor, entre com um endereço.";     
    } else{
        $endereco = $input_endereco;
    }
    
    // Validate salario
    $input_salario = trim($_POST["salario"]);
    if(empty($input_salario)){
        $salario_erro = "Por favor, entre com um valor numérico referente ao salário.";     
    } elseif(!ctype_digit($input_salario)){
        $salario_erro = "Por favor, entre com um valor positivo inteiro.";
    } else{
        $salario = $input_salario;
    }
    
    // Verifique os erros de entrada antes de inserir no banco de dados
    if(empty($nome_erro) && empty($endereco_erro) && empty($salario_erro)){
        // Prepare uma instrução de inserção
        $sql = "INSERT INTO empregados (nome, endereco, salario) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variáveis ​​à instrução preparada como parâmetros
            mysqli_stmt_bind_param($stmt, "sss", $param_nome, $param_endereco, $param_salario);
            
            // Definir parâmetros
            $param_nome = $nome;
            $param_endereco = $endereco;
            $param_salario = $salario;
            
            // Tentativa de executar a declaração preparada
            if(mysqli_stmt_execute($stmt)){
                // Registros criados com sucesso. Redirecionar para a página de destino
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
         
        // Fecha declaração
        mysqli_stmt_close($stmt);
    }
    
    // Fecha conexão
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Insere dados</title>
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
                        <h2>Insere Dados</h2>
                    </div>
                    <p>Preencha este formulário e envie-o para adicionar um registro de funcionário ao banco de dados.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_erro)) ? 'has-error' : ''; ?>">
                            <label>nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_erro;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($endereco_erro)) ? 'has-error' : ''; ?>">
                            <label>endereco</label>
                            <textarea name="endereco" class="form-control"><?php echo $endereco; ?></textarea>
                            <span class="help-block"><?php echo $endereco_erro;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salario_erro)) ? 'has-error' : ''; ?>">
                            <label>salario</label>
                            <input type="text" name="salario" class="form-control" value="<?php echo $salario; ?>">
                            <span class="help-block"><?php echo $salario_erro;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>