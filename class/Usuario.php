<?php 
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setIdusuario($idusuario){
		$this->idusuario = $idusuario;
	}

	public function setDeslogin($deslogin){
		$this->deslogin = $deslogin;
	}

	public function setDessenha($dessenha){
		$this->dessenha = $dessenha;
	}

	public function setDtcadastro($dtcadastro){
		$this->dtcadastro = $dtcadastro;
	}

	//pega um usuário com aquele $id
	public function loadById($id){
		$sql = new Sql();
		//usei a variável $query para passar somente um argumento no select, pois ele estava acusando dois argumentos
		$query = "SELECT * FROM tb_usuarios WHERE idusuario = ".$id;

		$results = $sql->select($query);
		if (count($results) > 0) {
			$this->setData($results[0]);
		}
	}

	//traz uma lista de todos os usuários
	public static function getList(){
		$sql = new Sql();
		$query = "SELECT * FROM tb_usuarios ORDER BY deslogin;";

		return $sql->select($query);

	}

	public static function searchUsuario($login){
		$sql = new Sql();
		$query = "SELECT * FROM tb_usuarios WHERE deslogin LIKE '%".$login."%';";

		return $sql->select($query);
	}

	public function login($login, $password){
		$sql = new Sql();
		$query = "SELECT * FROM tb_usuarios WHERE deslogin = '".$login."' AND dessenha = '". $password."'";

		$results = $sql->select($query);
		if (count($results) > 0) {
			$this->setData($results[0]);
		} else {

			throw new Exception("Login e/ou senha inválidos.");
		}
	}

	public function setData($data){
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();
		$query = "CALL sp_usuarios_insert('".$this->getDeslogin()."', '".$this->getDessenha()."')";

		$results =  $sql->select($query);
		if (count($results)) {
			$this->setData($results[0]);
		}


	}

	public function update($login, $password){
		$this->setDeslogin($login);
		$this->setDessenha($password);
		$sql = new Sql();

		$query = "UPDATE tb_usuarios SET deslogin = '{$this->getDeslogin()}', dessenha = '{$this->getDessenha()}' WHERE idusuario = {$this->getIdusuario()}";
		$sql->query($query);
	}

	public function delete(){
		$sql = new Sql();
		$query = "DELETE FROM tb_usuarios WHERE idusuario = {$this->getIdusuario()}";

		$sql->query($query);
		$this->setIdusuario(0);
		$this->setDessenha("");
		$this->setDeslogin("");
		$this->setDtcadastro(new DateTime());
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

	//CONSTRUTOR JÁ CRIA UM USUÁRIO COM LOGIN E SENHA
	//AO CRIAR UM CONSTRUTOR COM PARAMETROS ELE DESATIVA O PADRÃO, ENTÃO COLOCA ="" PRA ELE ACEITAR SEM PARÂMETROS TAMBÉM
	public function __construct($login ="", $senha=""){
		$this->setDeslogin($login);
		$this->setDessenha($senha);
	}
}
 ?>