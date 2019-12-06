<?php

require('conection.php');

$a = 0;
$listar = 0;
if (isset($_GET['nome']) && isset($_GET['turma']) &&
    isset($_GET['in']) && isset($_GET['out']) &&
    isset($_GET['tabela']) && isset($_GET['coluna']) &&
    isset($_GET['a'])) {

    $nome = $_GET['nome'];

    $turma = $_GET['turma'];

    $in = $_GET['in'];

    $out = $_GET['out'];

    $tabela = $_GET['tabela'];

    $coluna = $_GET['coluna'];

    $a = $_GET['a'];

    $listar = 1;
}


?>


<!DOCTYPE html>

<head>

    <meta http-equiv="Content-type" content="text/html">

    <meta charset="UTF-8">

    <title>Análise interpretativa de documentos científicos</title>

    <link rel="shortcut icon" href="http://additio.local/wp-content/uploads/2017/04/cropped-favicon.png">

    <link rel="icon" type="image/gif" href="http://additio.local/wp-content/uploads/2017/04/cropped-favicon.png">

    <style>

        table {

            font-family: arial, sans-serif;

            border-collapse: collapse;

            width: 100%;

        }


        td, th {

            border: 1px solid black;

            text-align: left;

            padding: 0px;

            height: auto;

        }


        tr:nth-child(even) {

            background-color: #eb9f2d;

        }

    </style>


</head>

<html>

<body>


<h3>Atividade:</h3>


<p>My first paragraph.</p>


<h3>Objetivo:</h3>


<p>My first paragraph.</p>


<hr/>


<h3 align="center"> Configuração-Professor</h3>


<form name="selecao" action="" method="post">

    <b><label>Informe o intervalo</label>:</b>&nbsp;&nbsp;<input name="in" type="text">&nbsp;até&nbsp;<input name="out" type="text">

    <b><label>Tabela</label>:</b>&nbsp;&nbsp;

    <select name="tabela">

        <option value='none' selected disabled hidden>Selecione a opção:</option>

        <option value='tab_1'>tab_1: Extensão Universitária</option>

        <option value='tab_2'>tab_2: Treinamento Ministrado</option>

        <option value='tab_3'>tab_3: Servico Tecnico Especializado</option>

        <option value='tab_4'>tab_4: Outra Atividade TecnicoCientifica</option>


    </select>

    <b><label>Coluna</label>:</b>&nbsp;&nbsp;

    <select name="coluna">

        <option value='none' selected disabled hidden>Selecione a opção:</option>

        <option value="avaliador_1">avaliador_1</option>

        <option value="avaliador_2">avaliador_2</option>

    </select>


    <br/><br/>


    <br/><br/>

    <hr/>


    <h3 align="center"> Configuração-Aluno</h3>


    <b><label>Informe seu nome</label>:</b>&nbsp;&nbsp;<input name="nome" type="text">&nbsp;&nbsp;

    <b><label>Informe sua turma</label>:</b>&nbsp;&nbsp;<input name="turma" type="text">

    <b><label>Informe seu cpf</label>:</b>&nbsp;&nbsp;<input name="cpf" type="text">

    <br/><br/>


    <input nome="frist" type="submit" value="ok" style=<?php if ($a == 1) {
        echo '"visibility: hidden;"';
    } else {
        echo '"visibility:visible;"';
    } ?>/>

</form>

<br/><br/>

<hr/>


<h3>Avalie as senteças abaixo conforme orientação em sala:</h3>

<form name="tabela" action="" method="post">

    <table>

        <tr>

            <th>ID</th>

            <th>Descrição</th>

            <th>Avaliação</th>

        </tr>


        <?php

        //criar variavl para pegar o valor $avaliador reornado da configuraçao do professor

        if ($listar)
        {
            $sql = "SELECT id, descricao, id_user, $coluna FROM $tabela WHERE id BETWEEN '$in' AND '$out'";

            $result = $conn->prepare($sql);




                $count1 = $result->rowCount();


                while ($row = $result->fetch()) {

                    $text = $row["descricao"];

                    $text = utf8_encode($text);

                    $id_user = $row["id_user"];


                    // echo"L 89 - ". $text);

                    echo "    

                    <tr>

                        <td>" . $row["id"] . "</td>

                        <td>" . $text . "</td>

                        <td>

                        <select style='width: 100%;

                        height: 100%;

                        min-height: 45px;

                        padding: 0px;

                        border: 0px;

                        text-align: center;

                        font-size: 18pt;'

                        name='avaliador_" . $row["id"] . "'>

                            <option value='none' selected disabled hidden>Selecione a opção:</option>

                            <option value='1'>Acadêmica</option>]

                            <option value='2'>Tecnológica</option>

                            <option value='0'>Não é possivel classificar</option>

                        </select>

                        </td>

                    </tr>";

                }

            }

            $conn = null;


        ?>
    </table>

    <br/><br/><input nome="second" type="submit" value="ok" style=<?php if ($a == 2) {
        echo '"visibility: hidden;"';
    } else {
        echo '"visibility:visible;"';
    } ?>/>

</form>

<?php

if ($listar)
{

    for ($i = $in; $i <= $out; $i++) {

        $id = "avaliador_" . $i;

        $nome = $_POST[$id];


        if ($nome !== '') { //se não estiver vazio, vamos atualizar


            $consulta = "UPDATE " . $tabela . " SET " . $coluna . " = '" . $nome . "' WHERE  id_user=" . $id_user . " AND id =" . $i . ";</br>";

            // use exec() because no results are returned

            // echo $consulta;

            $conn->exec($consulta);

            //echo "New record created successfully 1";


//            $conn = null;

            // e agora execute a consulta aqui...

        }

    }
}

?>

</body>

</html>

