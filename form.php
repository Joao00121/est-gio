<?php

require('conection.php');

$nome = $_POST['nome'];

$turma = $_POST['turma'];

$in = $_POST['in'];

$out = $_POST['out'];

$tabela = $_POST['tabela'];

$coluna = $_POST['coluna'];

$cpf = $_POST['cpf'];

$sql = "INSERT INTO cadastro_turma (nome,turma, `in`, `out`, nome_tabela, nome_coluna_avaliador, cpf) VALUES ('{$nome}', '{$turma}', '{$in}', '{$out}', '{$tabela}', '{$coluna}', '{$cpf}')";


$conn->exec($sql);

echo "New record created successfully 1";


$query2 = "nome=" . $nome . "&turma=" . $turma . "&in=" . $in . "&out=" . $out . "&tabela=" . $tabela . "&coluna=" . $coluna ."&a=1";


header("Location:index.php?{$query2}");

?>