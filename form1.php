<?php
require('conection.php');

$nome = $_GET['nome'];

$turma = $_GET['turma'];

$in = $_GET['in'];

$out = $_GET['out'];

$tabela = $_GET['tabela'];

$coluna = $_GET['coluna'];


#$query2="'".$nome."','".$turma."',".$in.", ".$out.", '".$tabela."','".$coluna."'</br>";




$sql = "UPDATE " . $tabela . " a SET a.id_user=(

        SELECT id 

        FROM cadastro_turma

        WHERE nome = '" . $nome . "' AND 

        turma = '" . $turma . "' AND 

        `in` = '" . $in . "' AND 

        `out` = '" . $out . "' AND 

        nome_tabela = '" . $tabela . "' AND 

        nome_coluna_avaliador = '" . $coluna . "') WHERE a.id_user is NULL AND a.id BETWEEN " . $in . " and " . $out . "";

//echo $sql;

// use exec() because no results are returned

$conn->exec($sql);

echo "New record created successfully 2";


$conn = null;


$query3 = "a=1&in=" . $in . "&out=" . $out . "&tabela=" . $tabela . "&coluna=" . $coluna;

//echo $query3

header('Location:index.php?' . $query3); #refresh:5;

?>



