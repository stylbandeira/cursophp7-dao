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
/*$usuario = new Usuario();
$usuario->login("brenoCosta", "amaizaia"); 
echo $usuario;
*/

//INSERT DE NOVO USUÁRIO COM CONSTRUTOR PADRÃO
/*$aluno = new Usuario();
$aluno->setDeslogin("aluno");
$aluno->setDessenha("senhadoaluno");
$aluno->insert();
*/

//INSERT DE NOVO USUÁRIO COM CONSTRUTOR PASSANDO LOGIN E SENHA COMO PARÂMETROS
/*$aluno = new Usuario("construtor","comParametros");
$aluno->insert();
*/

//ALTERANDO USUARIO/SENHA
$usuario = new Usuario();
$usuario->loadById(8);

$usuario->update("testeUpdate", "Usuario8");

echo $usuario;

 ?>