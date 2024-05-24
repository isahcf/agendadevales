<?php
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("SENHA", "");
define("BANCO", "agendadevales");
define("PORTA", "3306");

function abrirBanco() {
    $con = new mysqli(SERVIDOR, USUARIO, SENHA, BANCO, PORTA);

    if($con->connect_error){
        die("Falha de conexão:" . $con->connect-error);

    }

    return $con;
}
 
function fecharBanco($con){
    $con->close();
 }
