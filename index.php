<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-1">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Detalhe sobre os empregados</h2>
                        <a href="create.php" class="btn btn-success pull-right">Adicionar novo empregado</a>
                    </div>
                    <?php
                    // Incluir arquivo de configuração
                    require_once "config.php";
                    
                    // Tentativa de selecionar a execução da consulta
                    $sql = "SELECT * FROM empregados";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Endereço</th>";
                                        echo "<th>Salário</th>";
                                        echo "<th>Ação</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['endereco'] . "</td>";
                                        echo "<td>" . $row['salario'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='Visualizar Dados' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Atualizar Dados' data-toggle='tooltip'><span class='glyphicon glyphicon-cog'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Deletar Dados' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Não há dados para serem apresentados.</em></p>";
                        }
                    } else{
                        echo "ERRO: Não foi possível executar $sql. " . mysqli_error($link);
                    }
 
                    // Fecha conexão
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>