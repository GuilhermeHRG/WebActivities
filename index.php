<?php
echo "hello word <br>";
print 'hello word 2';
print '<h1>Header</h1>';

// ============================================================================================================

$a = 21;
$b = 'guilherme';
$c ='anos';

echo "$b tem $a $c";
// ============================================================================================================

$g = "5";
$h = "4";
$i = $g + $h;

echo "<br> valor de $i";

// ============================================================================================================

$falsoOuVerdadeiro = TRUE;

if ($falsoOuVerdadeiro){
    echo " <br> ABACATE";
}
else{
    echo "<br> BANANA";
}

// ============================================================================================================
echo "<hr>";
$vetor = array('maçã','banana','abacate');

var_dump($vetor);
echo "<hr>";
print_r($vetor);
echo "<hr>";
// ============================================================================================================

foreach($vetor as $fruta){
    echo "$fruta <br>";
}
echo "<hr>";

// ============================================================================================================
DEFINE ('nome', 'guilherme');
DEFINE ('idade', 21);
echo 'nome: '.nome. ' <br> idade: '.idade; 

echo "<hr> URI: $_SERVER[REQUEST_URI]";
echo "IP Remoto $_SERVER[REMOTE_ADDR] <br>";

// ============================================================================================================
$x =  10;
echo ++$x; echo " $x <br>"; // sinal antes imprime já calculado
$x = 10;
echo $x++; echo " $x <br>"; // sinal depois imprime e depois calcula

$x =  10;
echo --$x; echo " $x <br>"; // sinal antes imprime já calculado
$x = 10;
echo $x--; echo " $x <br>"; // sinal depois imprime e depois calcula

// ============================================================================================================

$a = true;
$b = false;

if ($a and $b){
    echo "Ambos verdade <hr>";
    
}
if ($a && $b){
    echo "Ambos verdade <hr>";
    
}
if ($a or $b){
    echo "A ou B verdadeiro <hr>";
    
}
if($a || $b){
echo "A ou B verdadeiro <hr>";

}
// ============================================================================================================

$opcao = 'oi';

switch($opcao){
    case 'start':
        echo "opcao start";
        break;
    case 'stop':
        echo "opcao stop";
        break;
    case 'restart':
        echo "opcao restart";
        break;
    default:
        echo "Opcao nao encontrada";
        break;

}

?>

<h2>Header 2</h2>



