<?php
require("core.php");
$con = conectarSF();

if($_GET['tipo'] == "incidente"){
 //print_r($_POST);
 criarIncidente($_POST, $con);
}

if($_GET['tipo'] == "changereq"){
 criarChange($_POST, $con);
}


?>