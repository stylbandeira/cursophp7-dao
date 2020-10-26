<?php 
require_once("config.php");
/*
//CARREGA UM USUÁRIO:

$root = new Usuario();
$root->loadById(6);
echo $root;
*/

//CARREGA UMA LISTA DE USUÁRIOS:
//O método pode ser chamado usando :: por ser Static (e também por não depender de nenhum parâmetro)
/*$lista = Usuario::getList();
echo json_encode($lista);
*/

//CARREGA LISTA DE USUÁRIOS BUSCANDO PELO LOGIN:
/*$search = Usuario::searchUsuario("bre");
echo json_encode($search);*/

//CARREGA UM USUÁRIO COM LOGIN E SENHA
$usuario = new Usuario();
$usuario->login("brenoCosta", "amaizaia"); 

echo $usuario;
 ?>