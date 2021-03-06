<?php

header("Content-Type: application/json; charset=UTF-8");
@session_start();
$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";

//Require das constantes
require_once($_SESSION["importInclude"]);

//Require da classe funcionário
require_once(IMPORT_CLIENTE_CONTROLLER);

//Pegar as variáveis da url
$modo = (isset($_GET["modo"]) ? strtoupper($_GET["modo"]) : null);
//  $email = (isset($_POST["email"]) ? $POST["email"] : null);
//  $senha = (isset($_POST["senha"]) ? $POST["senha"] : null);

//  if(isset($_POST)){
//     $email = $_POST['email'];
//     $senha = $_POST['senha'];
//  }

//Inicia a controller
$controllerCliente = new controllerCliente();

$result = array(
    "Mensagem" => "Modo Inexistente"
);

if($modo == "LOGAR"){

    //Já recebe um array com id e nome do cliente
    $result = $controllerCliente->logar();

    if($result == null){
        $result = array(

            "idCliente" => 0,
            "nomeCliente" => ""            

        );
    }

}else if($modo == "INSERIR"){
    $status = $controllerCliente->inserirCliente(2);

    $result = array(
        "status" => $status
    );
}

//Converter para o JSON a variavel result q é gerada pelas ações
echo(json_encode($result));

?>