<?php
include_once 'conexao.php';
?>
<!DOCTYPE html>
<a href="2020"></a>
<a href="http://127.0.0.1:5500/segunda.html"><button>Login</button></a>
</a>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar</title>
        
    </head>
    <body>
        <style>
            body{
                background-color: blueviolet;
                text-align: center;
                font-family: Arial, Helvetica, sans-serif;
                height: 100px;
                text-underline-position: 100px;
            }
            .cad{
                text-align: right;
                border-radius: 10px;
                text-decoration: dashed;
            
            }
            h1{
                color: skyblue;
            }
            label{
                color: skyblue;
            }
            .barra{
                border-radius: 10px;
            }
            button{
                background-color: skyblue;
                color: black;
                text-align: right;
                animation: infinite;
            }

        </style>
        <h1>Cadastrar</h1>
        <?php
        //Receber os dados do formulário
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Verificar se o usuário clicou no botão
        if (!empty($dados['CadUsuario'])) {
            //var_dump($dados);

            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }

            if (!$empty_input) {
                $query_usuario = "INSERT INTO cadastrando (nome, email) VALUES (:nome, :email) ";
                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $cad_usuario->execute();
                if ($cad_usuario->rowCount()) {
                    echo "<p style='color: skyblue;'>Usuário cadastrado com sucesso!</p>";
                    unset($dados);
                } else {
                    echo "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
                }
            }
        }
        ?>
        <form name="cad-usuario" method="POST" action="">
            <label>Nome: </label>
            <input class="barra" type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php
            if (isset($dados['nome'])) {
                echo $dados['nome'];
            }
            ?>"><br><br>

            <label>E-mail: </label>
            <input class="barra" type="email" name="email" id="email" placeholder="Seu melhor e-mail" value="<?php
            if (isset($dados['email'])) {
                echo $dados['email'];
            }
            ?>"><br><br>
        <form action="index.html" method="$_POST">
        <input class="cad" type="submit" value="Cadastrar" name="CadUsuario">
        </form>
    </body>
</html>

